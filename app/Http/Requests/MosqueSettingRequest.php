<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MosqueSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Different rules based on the action
        if ($this->routeIs('admin.prayer.import')) {
            return [
                'csv_file' => 'required|file|mimes:csv,txt|max:2048',
            ];
        }

        if ($this->routeIs('admin.azan.time.update')) {
            return [
                'fajr_azan' => 'nullable|string',
                'fajr_iqamah' => 'nullable|string',
                'dhuhr_azan' => 'nullable|string',
                'dhuhr_iqamah' => 'nullable|string',
                'asr_azan' => 'nullable|string',
                'asr_iqamah' => 'nullable|string',
                'maghrib_azan' => 'nullable|string',
                'maghrib_iqamah' => 'nullable|string',
                'isha_azan' => 'nullable|string',
                'isha_iqamah' => 'nullable|string',
                'jummah_time' => 'nullable|string',
                'jummah_live_link' => 'nullable|string',
                'monthly_schedule_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            ];
        }

        if ($this->routeIs('admin.mosque.quote.update')) {
            return [
                'quote' => 'nullable|string',
                'quote_author' => 'nullable|string',
            ];
        }

        if ($this->routeIs('admin.mosque.contact.update')) {
            return [
                'phone' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'address' => 'nullable|string|max:255',
                'office_hours' => 'nullable|string|max:255',
            ];
        }

        if ($this->routeIs('admin.mosque.social_payment.update')) {
            return [
                'facebook' => 'nullable|url|max:255',
                'twitter' => 'nullable|url|max:255',
                'whatsapp' => 'nullable|string|max:255',
                'instagram' => 'nullable|url|max:255',
                'youtube' => 'nullable|url|max:255',
                'payment_link' => 'nullable|url|max:255',
                'mobile_banking_qr' => 'nullable|image|max:2048',
                'bank_qr' => 'nullable|image|max:2048',
                'bank_name' => 'nullable|string|max:255',
                'account_name' => 'nullable|string|max:255',
                'account_number' => 'nullable|string|max:255',
                'branch_name' => 'nullable|string|max:255',
                'swift_code' => 'nullable|string|max:255',
            ];
        }

        if ($this->routeIs('admin.mosque.branding.update')) {
            return [
                'site_name' => 'nullable|string|max:255',
                'site_logo' => 'nullable|image|max:2048',
                'favicon' => 'nullable|image|max:1024',
            ];
        }

        // Default for main update
        return [
            'hero_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hero_title' => 'required|string',
            'hero_subtitle' => 'required|string',
            'video_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_id' => 'required|string',
            'donation_goal' => 'required|numeric|min:0',
        ];
    }
}
