<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MosqueSetting;
use App\Models\Donor;
use App\Models\PrayerSchedule;
use Illuminate\Http\Request;
use App\Http\Requests\MosqueSettingRequest;

class MosqueSettingController extends Controller
{
    // General Home Settings
    public function edit()
    {
        $setting = MosqueSetting::first();
        if (!$setting) {
            $setting = new MosqueSetting();
            $setting->hero_title = "Help Us Build Our Permanent Mosque";
            $setting->hero_subtitle = "Join our community in creating a sacred space for worship, learning, and unity. Every donation brings us closer to our goal.";
            $setting->video_id = "tQHAwV9B8hQ";
            $setting->donation_raised = 30000;
            $setting->donation_goal = 30000;
            $setting->save();
        }

        $donorTotal = Donor::sum('amount');

        return view('admin.mosque_settings.edit', compact('setting', 'donorTotal'));
    }

    public function update(MosqueSettingRequest $request)
    {
        $setting = MosqueSetting::first();
        $data = $request->all();

        // Handle File Uploads to public/upload
        if ($request->hasFile('hero_logo')) {
            $file = $request->file('hero_logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload'), $filename);
            $data['hero_logo'] = 'upload/' . $filename;
        }

        if ($request->hasFile('video_thumbnail')) {
            $file = $request->file('video_thumbnail');
            $filename = 'thumbnail_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload'), $filename);
            $data['video_thumbnail'] = 'upload/' . $filename;
        }

        $setting->fill($data);
        $setting->save();
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    // Azan / Prayer Time Settings
    public function editAzan()
    {
        $setting = MosqueSetting::first();
        if (!$setting) {
            $setting = new MosqueSetting();
            $setting->save();
        }
        $todaySchedule = PrayerSchedule::where('date', now()->format('Y-m-d'))->first();
        $schedules = PrayerSchedule::where('date', '>=', now()->format('Y-m-d'))
            ->orderBy('date', 'asc')
            ->take(30)
            ->get();
        return view('admin.mosque_settings.azan', compact('setting', 'schedules', 'todaySchedule'));
    }

    public function destroySchedule($id)
    {
        $schedule = PrayerSchedule::findOrFail($id);
        $schedule->delete();
        return redirect()->back()->with('success', 'Schedule entry deleted successfully.');
    }

    public function clearSchedule()
    {
        PrayerSchedule::truncate();
        return redirect()->back()->with('success', 'All prayer schedules cleared successfully.');
    }

    public function updateSchedule(Request $request, $id)
    {
        $request->validate([
            'fajr' => 'required|string',
            'dhuhr' => 'required|string',
            'asr' => 'required|string',
            'maghrib' => 'required|string',
            'isha' => 'required|string',
        ]);

        $schedule = PrayerSchedule::findOrFail($id);
        $schedule->update($request->all());

        return redirect()->back()->with('success', 'Schedule updated successfully.');
    }

    public function updateAzan(MosqueSettingRequest $request)
    {
        $setting = MosqueSetting::first();
        $data = $request->all();
        if ($request->hasFile('monthly_schedule_file')) {
            $file = $request->file('monthly_schedule_file');
            $filename = 'schedule_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload'), $filename);
            $data['monthly_schedule_file'] = 'upload/' . $filename;
        }
        $setting->fill($data);
        $setting->save();
        return redirect()->back()->with('success', 'Prayer Times updated successfully.');
    }

    // Create a new method for importing CSV
    public function importCsv(MosqueSettingRequest $request)
    {

        $file = $request->file('csv_file');
        $csvData = array_map('str_getcsv', file($file->getRealPath()));
        
        // Remove header row if exists
        if (isset($csvData[0][0]) && stripos($csvData[0][0], 'date') !== false) {
            array_shift($csvData);
        }

        foreach ($csvData as $row) {
            // Ensure at least 6 columns: Date, Fajr, Dhuhr, Asr, Maghrib, Isha
            if (count($row) < 6) continue;
            
            // Try to parse date
            try {
                $dateObj = \Carbon\Carbon::parse($row[0]);
                $date = $dateObj->format('Y-m-d');
            } catch (\Exception $e) {
                continue;
            }

            \App\Models\PrayerSchedule::updateOrCreate(
                ['date' => $date],
                [
                    'fajr' => $row[1] ?? null,
                    'dhuhr' => $row[2] ?? null,
                    'asr' => $row[3] ?? null,
                    'maghrib' => $row[4] ?? null,
                    'isha' => $row[5] ?? null,
                ]
            );
        }

        return redirect()->back()->with('success', 'Prayer schedule imported successfully. Daily times will now auto-update based on dates.');
    }

    public function downloadDemoCsv()
    {
        $filePath = base_path('prayer_schedule_demo.csv');
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Sample CSV file not found.');
        }
        return response()->download($filePath, 'prayer_schedule_template.csv');
    }

    // Quote Settings
    public function editQuote()
    {
        $setting = MosqueSetting::first();
        if (!$setting) {
             $setting = new MosqueSetting();
             $setting->save();
        }
        return view('admin.mosque_settings.quote', compact('setting'));
    }

    public function updateQuote(MosqueSettingRequest $request)
    {
        
        $setting = MosqueSetting::first();
        $setting->fill($request->all());
        $setting->save();
        return redirect()->back()->with('success', 'Quote updated successfully.');
    }

    // Contact Settings
    public function editContact()
    {
        $setting = MosqueSetting::first();
        if (!$setting) {
             $setting = new MosqueSetting();
             $setting->save();
        }
        return view('admin.mosque_settings.contact', compact('setting'));
    }

    public function updateContact(MosqueSettingRequest $request)
    {
        
        $setting = MosqueSetting::first();
        $setting->fill($request->all());
        $setting->save();
        return redirect()->back()->with('success', 'Contact information updated successfully.');
    }

    // Social and Payment Settings
    public function editSocialPayment()
    {
        $setting = MosqueSetting::first();
        if (!$setting) {
             $setting = new MosqueSetting();
             $setting->save();
        }
        return view('admin.mosque_settings.social_payment', compact('setting'));
    }

    public function updateSocialPayment(MosqueSettingRequest $request)
    {
        
        $setting = MosqueSetting::first();
        $data = $request->all();
        if ($request->hasFile('mobile_banking_qr')) {
            $file = $request->file('mobile_banking_qr');
            $filename = 'qr_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload'), $filename);
            $data['mobile_banking_qr'] = 'upload/' . $filename;
        }
        if ($request->hasFile('bank_qr')) {
            $file = $request->file('bank_qr');
            $filename = 'bank_qr_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload'), $filename);
            $data['bank_qr'] = 'upload/' . $filename;
        }
        $setting->fill($data);
        $setting->save();
        return redirect()->back()->with('success', 'Social and Payment settings updated successfully.');
    }

    public function editBranding()
    {
        $setting = MosqueSetting::first();
        if (!$setting) {
            $setting = new MosqueSetting();
            $setting->save();
        }
        return view('admin.mosque_settings.branding', compact('setting'));
    }

    public function updateBranding(MosqueSettingRequest $request)
    {

        $setting = MosqueSetting::first();
        $data = $request->all();
        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $filename = 'site_logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload'), $filename);
            $data['site_logo'] = 'upload/' . $filename;
        }
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $filename = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload'), $filename);
            $data['favicon'] = 'upload/' . $filename;
        }
        $setting->fill($data);
        $setting->save();
        return redirect()->back()->with('success', 'Branding settings updated successfully.');
    }
}
