<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MosqueSetting;
use App\Models\About;
use App\Models\IslamicClass;
use App\Models\GalleryCategory;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\EventPopup;
use App\Models\Donor;
use App\Models\CommunityMember;
use App\Models\ContactMessage;
use Carbon\Carbon;

class MosqueSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks for truncation
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 1. Mosque Settings
        MosqueSetting::updateOrCreate(['id' => 1], [
            'site_name' => 'BICC FINLAND',
            'site_logo' => 'masjid/images/logo.png',
            'favicon' => 'favicon.png',
            'hero_logo' => 'masjid/images/arbilogo2.png',
            'hero_title' => 'Help Us Build Our Permanent Mosque',
            'hero_subtitle' => 'Join our community in creating a sacred space for worship, learning, and unity. Every donation brings us closer to our goal.',
            'video_thumbnail' => 'masjid/images/heroimg.png',
            'video_id' => 'tQHAwV9B8hQ',
            'donation_raised' => 35000,
            'donation_goal' => 100000,
            'fajr_azan' => '05:45 AM',
            'fajr_iqamah' => '06:15 AM',
            'dhuhr_azan' => '12:30 PM',
            'dhuhr_iqamah' => '01:00 PM',
            'asr_azan' => '03:15 PM',
            'asr_iqamah' => '03:45 PM',
            'maghrib_azan' => '04:20 PM',
            'maghrib_iqamah' => '04:25 PM',
            'isha_azan' => '07:30 PM',
            'isha_iqamah' => '08:00 PM',
            'jummah_time' => '1:30 PM',
            'jummah_live_link' => 'https://youtube.com/live/example',
            'quote' => 'Wealth does not come from having great riches; wealth comes from contentment.',
            'quote_author' => 'Prophet Muhammad (PBUH)',
            'phone' => '+358 09 123 4567',
            'email' => 'info@biccfinland.org',
            'address' => 'Malminkaari 9 A (3rd floor), Helsinki',
            'office_hours' => 'Monday - Friday: 9:00 AM - 5:00 PM',
            'facebook' => 'https://facebook.com/biccfinland',
            'twitter' => 'https://twitter.com/biccfinland',
            'whatsapp' => '+358401234567',
            'instagram' => 'https://instagram.com/biccfinland',
            'youtube' => 'https://youtube.com/biccfinland',
            'bank_name' => 'OP Bank Helsinki',
            'account_name' => 'BICC Finland Ry',
            'account_number' => 'FI12 3456 7890 1234 56',
            'branch_name' => 'Helsinki Central',
            'swift_code' => 'OKOYFIHH'
        ]);

        // 2. About Us
        About::updateOrCreate(['id' => 1], [
            'title' => 'Our Journey of Faith and Community',
            'content' => 'The Bangladesh Islamic Cultural Centre (BICC) in Finland was established with a vision to serve the spiritual and social needs of the Muslim community. We are dedicated to providing a place of worship, Islamic education, and cultural integration. Our mission is to promote the true values of Islam—peace, tolerance, and brotherhood—while actively contributing to the welfare of Finnish society.',
            'image' => 'masjid/images/heroimg.png',
            'video_id' => 'tQHAwV9B8hQ',
            'video_thumbnail' => 'masjid/images/heroimg.png',
        ]);

        // 3. Islamic Classes
        IslamicClass::truncate();
        IslamicClass::create([
            'title' => 'Adult Quran Studies',
            'description' => 'Comprehensive Quranic recitation and Tajweed classes for adults of all levels.',
            'category' => 'adult',
            'days' => 'Saturdays & Sundays',
            'time' => '10:00 AM - 12:00 PM',
            'image' => 'masjid/images/classimg1.png',
        ]);
        IslamicClass::create([
            'title' => 'Sunday Madrasah for Kids',
            'description' => 'Islamic history, basic Arabic, and character building for children aged 5-15.',
            'category' => 'children',
            'days' => 'Sundays',
            'time' => '02:00 PM - 05:00 PM',
            'image' => 'masjid/images/classimg2.png',
        ]);

        // 4. Gallery Categories & Images
        GalleryCategory::truncate();
        $cat1 = GalleryCategory::create(['name' => 'Events', 'slug' => 'events']);
        $cat2 = GalleryCategory::create(['name' => 'Construction', 'slug' => 'construction']);
        $cat3 = GalleryCategory::create(['name' => 'Community', 'slug' => 'community']);

        Gallery::truncate();
        Gallery::create([
            'category_id' => $cat1->id,
            'title' => 'Eid-ul-Fitr Celebration 2024',
            'event_name' => 'Eid Prayer',
            'event_time' => 'April 10, 2024',
            'image' => 'masjid/images/gallary1.png'
        ]);
        Gallery::create([
            'category_id' => $cat2->id,
            'title' => 'New Site Foundation Work',
            'event_name' => 'Construction Phase 1',
            'event_time' => 'June 15, 2024',
            'image' => 'masjid/images/gallary2.png'
        ]);
        Gallery::create([
            'category_id' => $cat3->id,
            'title' => 'Annual Community Iftar',
            'event_name' => 'Ramadan Gathering',
            'event_time' => 'March 20, 2024',
            'image' => 'masjid/images/gallary3.png'
        ]);

        // 5. Services
        Service::truncate();
        Service::create([
            'title' => 'Matrimonial Service',
            'slug' => 'matrimonial-service',
            'icon' => 'ti-heart',
            'description' => 'Connecting families and helping individuals find righteous spouses according to Islamic values.',
            'content' => 'Our matrimonial service is designed to help Muslim brothers and sisters find their life partners in a halal and respectful manner.',
            'image' => 'masjid/images/serviceimage.png'
        ]);
        Service::create([
            'title' => 'Janazah / Funeral Service',
            'slug' => 'funeral-service',
            'icon' => 'ti-separator',
            'description' => 'Providing dignified funeral arrangements and support for bereaved families according to Sunnah.',
            'content' => 'We offer complete Janazah services including ghusl, kafan, and coordination with local cemeteries.',
            'image' => 'masjid/images/serviceimage.png'
        ]);
        Service::create([
            'title' => 'Islamic Counseling',
            'slug' => 'islamic-counseling',
            'icon' => 'ti-users',
            'description' => 'Professional and spiritual guidance for marital, youth, and personal matters.',
            'content' => 'Our counseling service provides a safe space for community members to seek advice based on the Quran and Sunnah.',
            'image' => 'masjid/images/serviceimage.png'
        ]);

        // 6. Donors
        Donor::truncate();
        Donor::create([
            'name' => 'Abdullah Al-Mamun',
            'email' => 'abdullah@example.com',
            'phone' => '+358 40 111 2222',
            'amount' => 500,
            'message' => 'For the sake of Allah.',
            'is_visible' => true,
        ]);
        Donor::create([
            'name' => 'Fatima Rahman',
            'email' => 'fatima@example.com',
            'phone' => '+358 40 333 4444',
            'amount' => 1000,
            'message' => 'Lillah donation for the new mosque.',
            'is_visible' => true,
        ]);

        // 7. Community Members
        CommunityMember::truncate();
        CommunityMember::create(['name' => 'Sydul Amin', 'email' => 'sydul@example.com', 'phone' => '+358 40 555 6666']);
        CommunityMember::create(['name' => 'Karim Ullah', 'email' => 'karim@example.com', 'phone' => '+358 40 777 8888']);

        // 8. Event Popup
        EventPopup::truncate();
        EventPopup::create([
            'event_name' => 'Grand Mosque Fundraiser 2025',
            'event_datetime' => Carbon::parse('2025-01-15 18:00:00'),
            'message' => 'Join us for a special evening to raise funds for our permanent home in Helsinki. Your presence matters!',
            'is_active' => true
        ]);

        // 9. Contact Messages
        ContactMessage::truncate();
        ContactMessage::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '123456789',
            'message' => 'I would like to know more about the children madrasah enrollment.'
        ]);

        // Re-enable foreign key checks
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
