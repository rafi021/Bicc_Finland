<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClassRegistrationRequest;
use App\Http\Requests\ServiceRequestRequest;
use App\Http\Requests\CommunityMemberRequest;
use App\Http\Requests\DonorRequest;
use App\Models\MosqueSetting;
use App\Models\Donor;
use App\Models\PrayerSchedule;
use App\Models\IslamicClass;
use App\Models\ClassRegistration;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\EventPopup;
use Carbon\Carbon;
use App\Models\About;
use App\Models\CommunityMember;

class MosqueController extends Controller
{
    /**
     * Display the mosque home page.
     */
    public function home()
    {
        $setting = MosqueSetting::first();
        if (!$setting) {
            $setting = new MosqueSetting();
            $setting->hero_title = "Help Us Build Our Permanent Mosque";
            $setting->hero_subtitle = "Join our community in creating a sacred space for worship, learning, and unity. Every donation brings us closer to our goal.";
            $setting->video_id = "tQHAwV9B8hQ";
            $setting->donation_raised = 30000;
            $setting->donation_goal = 30000;
        }

        // Add donor amounts to the base raised amount
        $donorAmount = Donor::sum('amount');
        $setting->donation_raised += $donorAmount;

        // Fetch visible donors
        $donors = Donor::where('is_visible', true)->latest()->take(10)->get();

        // Fetch prayer times for today
        $today = Carbon::today()->format('Y-m-d');
        $schedule = PrayerSchedule::where('date', $today)->first();

        $prayerTimes = [];
        if ($schedule) {
            $prayerTimes['fajr'] = $schedule->fajr;
            $prayerTimes['dhuhr'] = $schedule->dhuhr;
            $prayerTimes['asr'] = $schedule->asr;
            $prayerTimes['maghrib'] = $schedule->maghrib;
            $prayerTimes['isha'] = $schedule->isha;
        } else {
            // Fallback to static setting (Using Azan field as the primary Time field)
            $prayerTimes['fajr'] = $setting->fajr_azan;
            $prayerTimes['dhuhr'] = $setting->dhuhr_azan;
            $prayerTimes['asr'] = $setting->asr_azan;
            $prayerTimes['maghrib'] = $setting->maghrib_azan;
            $prayerTimes['isha'] = $setting->isha_azan;
        }

        // Fetch classes
        $classes = IslamicClass::latest()->get();

        // Fetch gallery images
        $galleryImages = Gallery::with('category')->latest()->take(6)->get();

        // Fetch services (limit to 6 for homepage)
        $services = Service::latest()->take(6)->get();

        // Fetch active event popup
        $eventPopup = EventPopup::where('is_active', true)
            ->where('event_datetime', '>', now())
            ->latest()
            ->first();

        return view('masjid.home', compact('setting', 'donors', 'prayerTimes', 'classes', 'galleryImages', 'services', 'eventPopup'));
    }

    public function storeRegistration(ClassRegistrationRequest $request)
    {
        ClassRegistration::create($request->all());

        return redirect()->to(url()->previous() . '#class')->with('success', 'Thank you for registering! We will contact you soon.');
    }

    /**
     * Display the about page.
     */
    public function about()
    {
        $setting = MosqueSetting::first();
        if (!$setting) {
            $setting = new MosqueSetting();
            $setting->video_id = "tQHAwV9B8hQ";
        }
        
        // Fetch about section
        $about = About::first();
        
        return view('masjid.about', compact('setting', 'about'));
    }

    /**
     * Display the services page.
     */
    public function services()
    {
        $setting = MosqueSetting::first();
        if (!$setting) {
            $setting = new MosqueSetting();
        }
        
        $services = Service::latest()->take(6)->get();
        return view('masjid.services', compact('services', 'setting'));
    }

    /**
     * Display service details.
     */
    public function serviceDetail($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $setting = MosqueSetting::first();
        return view('masjid.service-detail', compact('service', 'setting'));
    }

    public function storeServiceRequest(ServiceRequestRequest $request)
    {
        ServiceRequest::create($request->all());

        return redirect()->to(url()->previous() . '#service-request')->with('success', 'Thank you for your request! We will contact you soon.');
    }

    /**
     * Display the gallery page.
     */
    public function gallery(Request $request)
    {
        $setting = MosqueSetting::first();
        $categories = GalleryCategory::withCount('galleries')->get();
        
        $query = Gallery::with('category');
        
        if ($request->has('category')) {
            $category = GalleryCategory::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }
        
        $galleries = $query->latest()->paginate(4);
        
        return view('masjid.gallery', compact('setting', 'categories', 'galleries'));
    }

    /**
     * Display the contact page.
     */
    public function contact()
    {
        $setting = MosqueSetting::first();
        if (!$setting) {
            $setting = new MosqueSetting();
        }
        
        return view('masjid.contact', compact('setting'));
    }

    public function storeContactMessage(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phoneNumber' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\ContactMessage::create([
            'name' => $request->firstName . ' ' . $request->lastName,
            'email' => $request->email,
            'phone' => $request->phoneNumber,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Thank you for your message! We will contact you soon.');
    }

    public function storeCommunityMember(CommunityMemberRequest $request)
    {
        CommunityMember::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phoneNumber,
        ]);

        return redirect()->to(url()->previous() . '#community')->with('success_community', 'Welcome to our community! You have successfully joined.');
    }

    public function storeDonor(DonorRequest $request)
    {
        Donor::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phoneNumber,
            'amount' => $request->amount,
            'message' => $request->message,
            'is_visible' => false,
        ]);

        return redirect()->back()->with('success_community', 'Thank you for your donation notification! We will verify it soon.');
    }
}