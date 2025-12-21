<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeCrudx extends Command
{
    protected $signature = 'make:crudx {model : StudlyCase model name} {--fields=} {--search=} {--filter=} {--seed=} {--force}';
    protected $description = 'Scaffold admin CRUD (web UI) with search, filter, sort, pagination';

    public function handle(): int
    {
        $model = Str::studly($this->argument('model'));
        $table = Str::snake(Str::pluralStudly($model));
        $slug = Str::kebab(Str::pluralStudly($model));
        $var = Str::camel($model);
        $fieldsOpt = (string) ($this->option('fields') ?? '');
        $searchOpt = array_filter(array_map('trim', explode(',', (string) ($this->option('search') ?? ''))));
        $filterOpt = array_filter(array_map('trim', explode(',', (string) ($this->option('filter') ?? ''))));
        $useAuth = false;
        $force = (bool) $this->option('force');
        $seedCount = (int) ($this->option('seed') ?? 10);

        $ensureDir = function (string $path) {
            if (!is_dir($path)) mkdir($path, 0777, true);
        };

        $parseFields = function (string $fieldsCsv): array {
            $fields = [];
            if ($fieldsCsv) {
                // Split by comma or semicolon
                $parts = preg_split('/[;,]/', $fieldsCsv) ?: [];
                foreach ($parts as $chunk) {
                    $chunk = trim($chunk);
                    if ($chunk === '') continue;
                    // Accept "name#type|rules" or "name:type|rules"
                    $name = '';
                    $rest = '';
                    if (str_contains($chunk, '#')) {
                        [$name, $rest] = array_pad(explode('#', $chunk, 2), 2, 'string');
                    } else {
                        [$name, $rest] = array_pad(explode(':', $chunk, 2), 2, 'string');
                    }
                    $name = trim($name);
                    $rest = trim($rest);
                    $type = $rest !== '' ? $rest : 'string';
                    $ruleParts = [];
                    if (str_contains($rest, '|')) {
                        [$type, $ruleStr] = explode('|', $rest, 2);
                        $type = trim($type) !== '' ? trim($type) : 'string';
                        $ruleParts = array_filter(array_map('trim', explode('|', $ruleStr)));
                    }
                    if ($name !== '') {
                        $fields[] = [$name, $type, $ruleParts];
                    }
                }
            }
            return $fields;
        };

        $fields = $parseFields($fieldsOpt);
        $rulesForStore = [];
        $rulesForUpdate = [];
        $casts = [];
        $normalizeType = function (string $t): string {
            $t = strtolower($t);
            if ($t === 'text') return 'string';
            if ($t === 'float' || $t === 'double') return 'numeric';
            return $t !== '' ? $t : 'string';
        };
        foreach ($fields as [$name, $type, $rules]) {
            $vType = $normalizeType($type);
            $storeRules = $rules ?: ['nullable'];
            $updateRules = array_values(array_diff($storeRules, ['required']));
            $rulesForStore[$name] = array_merge([$vType], $storeRules);
            $rulesForUpdate[$name] = array_merge([$vType], $updateRules ?: ['sometimes']);
            $casts[$name] = in_array($type, ['integer','boolean','array','json','float','double']) ? $type : null;
        }

        $fillableStr = implode(",\n", array_map(fn($f)=>"        '".$f[0]."'", $fields));
        $castsStr = implode("\n", array_map(function($k) use ($casts){ return $casts[$k] ? "        '".$k."' => '".$casts[$k]."'," : ''; }, array_keys($casts)));
        $castsStr = trim($castsStr) !== '' ? $castsStr : '';

        $rulesToPhp = function (array $rules): string {
            $out = '';
            foreach ($rules as $field => $arr) {
                $arr = array_values(array_filter($arr));
                $out .= "            '".$field."' => '".implode('|', $arr)."',\n";
            }
            return $out;
        };
        $storeRulesPhp = $rulesToPhp($rulesForStore);
        $updateRulesPhp = $rulesToPhp($rulesForUpdate);

        $searchCols = '['.implode(', ', array_map(fn($c)=>"'".$c."'", $searchOpt)).']';
        $filterCols = '['.implode(', ', array_map(fn($c)=>"'".$c."'", $filterOpt)).']';
        $display = ucfirst(str_replace('-', ' ', $slug));

        // Blade view helper strings
        $fieldNames = array_map(fn($f)=>$f[0], $fields);
        $tableHeaders = implode("\n", array_map(fn($n)=>"                <th class=\"px-3 py-2 text-left\">".ucfirst(str_replace('_',' ',$n))."</th>", $fieldNames));
        $tableCells = implode("\n", array_map(fn($n)=>"                <td class=\"px-3 py-2 border-t\">{{ ".'$item->'."$n }}</td>", $fieldNames));

        $formFields = '';
        foreach ($fields as [$name, $type]) {
            $label = ucfirst(str_replace('_',' ',$name));
            $input = '';
            $old = '{{ old("'.$name.'", $item->'.$name.' ?? "") }}';
            if (in_array($type, ['text'])) {
                $input = "<textarea name=\"$name\" id=\"$name\" class=\"border rounded w-full p-2\">".$old."</textarea>";
            } else {
                $inputType = in_array($type, ['integer','float','double']) ? 'number' : 'text';
                $step = in_array($type, ['float','double']) ? ' step="0.01"' : '';
                $input = "<input type=\"$inputType\"$step name=\"$name\" id=\"$name\" value=\"$old\" class=\"border rounded w-full p-2\">";
            }
            $formFields .= "            <div class=\"mb-4\">\n                <label for=\"$name\" class=\"block font-medium mb-1\">$label</label>\n                $input\n            </div>\n";
        }

        // Model
        $modelPath = app_path("Models/{$model}.php");
        if (!file_exists($modelPath) || $force) {
            $ensureDir(dirname($modelPath));
            $content = $this->stub('model');
            $content = $this->fill($content, [
                'Model' => $model,
                'fillable' => $fillableStr,
                'casts' => $castsStr,
            ]);
            file_put_contents($modelPath, $content);
            $this->info("Model created: app/Models/{$model}.php");
        }

        // Migration
        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);

        // Service
        $servicePath = app_path("Services/{$model}Service.php");
        if (!file_exists($servicePath) || $force) {
            $ensureDir(dirname($servicePath));
            $content = $this->stub('service');
            $content = $this->fill($content, [
                'Model' => $model,
                'searchCols' => $searchCols,
                'filterCols' => $filterCols,
            ]);
            file_put_contents($servicePath, $content);
            $this->info("Service created: app/Services/{$model}Service.php");
        }

        // Requests
        $reqDir = app_path("Http/Requests/{$model}");
        $ensureDir($reqDir);
        $singleReqPath = "$reqDir/{$model}Request.php";
        if (!file_exists($singleReqPath) || $force) {
            $content = $this->stub('request');
            $content = $this->fill($content, [
                'Model' => $model,
                'store_rules' => $storeRulesPhp,
                'update_rules' => $updateRulesPhp,
            ]);
            file_put_contents($singleReqPath, $content);
            $this->info("Request created: app/Http/Requests/{$model}/{$model}Request.php");
        }

        // Resource
        $resPath = app_path("Http/Resources/{$model}Resource.php");
        if (!file_exists($resPath) || $force) {
            $ensureDir(dirname($resPath));
            $content = $this->stub('resource');
            $content = $this->fill($content, [
                'Model' => $model,
            ]);
            file_put_contents($resPath, $content);
            $this->info("Resource created: app/Http/Resources/{$model}Resource.php");
        }

        // Controllers
        $webControllerPath = app_path("Http/Controllers/Web/{$model}Controller.php");
        $ensureDir(dirname($webControllerPath));
        if (!file_exists($webControllerPath) || $force) {
            $content = $this->stub('web_controller');
            $content = $this->fill($content, [
                'Model' => $model,
                'modelVar' => $var,
                'slug' => $slug,
            ]);
            file_put_contents($webControllerPath, $content);
            $this->info("Web Controller created: app/Http/Controllers/Web/{$model}Controller.php");
        }

        // Routes
        $webRoutes = base_path('routes/web.php');
        $webLine = "Route::resource('{$slug}', \\App\\Http\\Controllers\\Web\\{$model}Controller::class);";
        $appendIfMissing = function ($file, $line) {
            $contents = file_get_contents($file);
            if (str_contains($contents, $line)) return;
            file_put_contents($file, "\n{$line}\n", FILE_APPEND);
        };
        $appendIfMissing($webRoutes, $webLine);

        // Views
        $viewsDir = resource_path('views/'.$slug);
        $ensureDir($viewsDir);
        foreach (['index','create','edit','show'] as $view) {
            $vf = "$viewsDir/{$view}.blade.php";
            if (!file_exists($vf) || $force) {
                $content = $this->stub('view_'.$view);
                $content = $this->fill($content, [
                    'Model' => $model,
                    'slug' => $slug,
                    'display' => $display,
                    'table_headers' => $tableHeaders,
                    'table_cells' => $tableCells,
                    'form_fields' => $formFields,
                ]);
                file_put_contents($vf, $content);
            }
        }

        // Factory
        $factoryPath = base_path("database/factories/{$model}Factory.php");
        if (!file_exists($factoryPath) || $force) {
            $factoryFields = '';
            foreach ($fields as [$name, $type]) {
                $gen = 'fake()->word()';
                $lname = strtolower($name);
                if ($type === 'text' || str_contains($lname,'description') || $lname==='concern') {
                    $gen = 'fake()->paragraph()';
                } elseif ($type === 'integer') {
                    $gen = 'fake()->numberBetween(1, 9999)';
                } elseif (in_array($type, ['float','double'])) {
                    $gen = 'fake()->randomFloat(2, 1, 9999)';
                } elseif ($lname === 'title' || $lname === 'subtitle') {
                    $gen = 'fake()->sentence(4)';
                } elseif ($lname === 'year') {
                    $gen = 'fake()->numberBetween(2000, 2035)';
                } elseif ($lname === 'image' || str_contains($lname,'image')) {
                    $gen = "fake()->imageUrl(800, 600, 'business', true)";
                } elseif ($lname === 'partner') {
                    $gen = 'fake()->company()';
                } elseif ($lname === 'member' || str_contains($lname,'name')) {
                    $gen = 'fake()->name()';
                } else {
                    $gen = 'fake()->word()';
                }
                $factoryFields .= "            '$name' => $gen,\n";
            }
            $factory = <<<PHP
<?php

namespace Database\Factories;

use App\Models\{$model};
use Illuminate\Database\Eloquent\Factories\Factory;

class {$model}Factory extends Factory
{
    protected $model = {$model}::class;

    public function definition(): array
    {
        return [
{$factoryFields}        ];
    }
}
PHP;
            file_put_contents($factoryPath, $factory);
            $this->info("Factory created: database/factories/{$model}Factory.php");
        }

        // Seeder
        $seederPath = base_path("database/seeders/{$model}Seeder.php");
        if (!file_exists($seederPath) || $force) {
            $seeder = <<<PHP
<?php

namespace Database\Seeders;

use App\Models\{$model};
use Illuminate\Database\Seeder;

class {$model}Seeder extends Seeder
{
    public function run(): void
    {
        {$model}::factory($seedCount)->create();
    }
}
PHP;
            file_put_contents($seederPath, $seeder);
            $this->info("Seeder created: database/seeders/{$model}Seeder.php");
        }

        // Update DatabaseSeeder to call the new seeder
        $databaseSeeder = base_path('database/seeders/DatabaseSeeder.php');
        if (file_exists($databaseSeeder)) {
            $contents = file_get_contents($databaseSeeder);
            $callLine = '$this->call(' . $model . 'Seeder::class);';
            if (!str_contains($contents, $callLine)) {
                $contents = preg_replace_callback(
                    '/public function run\(\): void\s*\{([\s\S]*?)\}/',
                    function ($m) use ($callLine) {
                        $inner = rtrim($m[1]);
                        if ($inner !== '') {
                            $inner .= "\n        {$callLine}\n";
                        } else {
                            $inner = "\n        {$callLine}\n";
                        }
                        return "public function run(): void\n    {" . $inner . "    }";
                    },
                    $contents,
                    1
                );
                file_put_contents($databaseSeeder, $contents);
                $this->info('DatabaseSeeder updated to call '.$model.'Seeder');
            }
        }

        $this->info('CRUDX scaffolding complete.');
        return self::SUCCESS;
    }

    protected function stub(string $name): string
    {
        $path = base_path('stubs/crudx/'.$name.'.stub');
        return file_get_contents($path);
    }

    protected function fill(string $stub, array $replacements): string
    {
        foreach ($replacements as $key => $value) {
            $stub = str_replace('{{'.$key.'}}', $value, $stub);
        }
        return $stub;
    }
}
