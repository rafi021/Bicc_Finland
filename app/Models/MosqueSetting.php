<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MosqueSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_logo',
        'favicon',
        'hero_logo',
        'hero_title',
        'hero_subtitle',
        'video_thumbnail',
        'video_id',
        'donation_raised',
        'donation_goal',
        'fajr_azan', 'fajr_iqamah',
        'dhuhr_azan', 'dhuhr_iqamah',
        'asr_azan', 'asr_iqamah',
        'maghrib_azan', 'maghrib_iqamah',
        'isha_azan', 'isha_iqamah',
        'jummah_time', 'jummah_live_link', 'monthly_schedule_file',
        'quote', 'quote_author',
        'phone', 'email', 'address', 'office_hours',
        'facebook', 'twitter', 'whatsapp', 'instagram', 'youtube',
        'mobile_banking_qr', 'bank_qr', 'bank_name', 'account_name', 'account_number', 'branch_name', 'swift_code'
    ];
}
