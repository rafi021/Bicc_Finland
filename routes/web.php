<?php

use App\Http\Controllers\MosqueController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\MosqueSettingController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\CommunityMemberController;
use App\Http\Controllers\Admin\IslamicClassController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceRequestController;


Route::get('/', [MosqueController::class, 'home'])->name('mosque.home');

// Redirect public resource URLs to admin equivalents so /homes, /journeys, /concerns
// always show the admin UI (requires auth)
Route::middleware('auth')->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::redirect('/homes', '/admin/homes');
    Route::redirect('/journeys', '/admin/journeys');
    Route::redirect('/concerns', '/admin/concerns');
    Route::redirect('/awards', '/admin/awards');

    // Mosque Settings
    Route::get('/admin/mosque-settings', [MosqueSettingController::class, 'edit'])->name('admin.mosque.settings');
    Route::post('/admin/mosque-settings', [MosqueSettingController::class, 'update'])->name('admin.mosque.settings.update');
    Route::get('/admin/mosque-settings/quote', [MosqueSettingController::class, 'editQuote'])->name('admin.mosque.quote.edit');
    Route::post('/admin/mosque-settings/quote', [MosqueSettingController::class, 'updateQuote'])->name('admin.mosque.quote.update');
    Route::get('/admin/mosque-settings/contact', [MosqueSettingController::class, 'editContact'])->name('admin.mosque.contact.edit');
    Route::post('/admin/mosque-settings/contact', [MosqueSettingController::class, 'updateContact'])->name('admin.mosque.contact.update');
    Route::get('/admin/mosque-settings/social-payment', [MosqueSettingController::class, 'editSocialPayment'])->name('admin.mosque.social_payment.edit');
    Route::post('/admin/mosque-settings/social-payment', [MosqueSettingController::class, 'updateSocialPayment'])->name('admin.mosque.social_payment.update');
    Route::get('/admin/mosque-settings/branding', [MosqueSettingController::class, 'editBranding'])->name('admin.mosque.branding.edit');
    Route::post('/admin/mosque-settings/branding', [MosqueSettingController::class, 'updateBranding'])->name('admin.mosque.branding.update');

    // Azan/Prayer Time Settings
    Route::get('/admin/azan', [MosqueSettingController::class, 'editAzan'])->name('admin.azan.time');
    Route::post('/admin/azan', [MosqueSettingController::class, 'updateAzan'])->name('admin.azan.time.update');
    Route::post('/admin/prayer-schedule/import', [MosqueSettingController::class, 'importCsv'])->name('admin.prayer.import');
    Route::put('/admin/prayer-schedule/{id}', [MosqueSettingController::class, 'updateSchedule'])->name('admin.prayer.update');
    Route::delete('/admin/prayer-schedule/{id}', [MosqueSettingController::class, 'destroySchedule'])->name('admin.prayer.destroy');
    Route::post('/admin/prayer-schedule/clear', [MosqueSettingController::class, 'clearSchedule'])->name('admin.prayer.clear');
    Route::get('/admin/prayer-schedule/download-demo', [MosqueSettingController::class, 'downloadDemoCsv'])->name('admin.prayer.download_demo');

    // About Us
    Route::resource('/admin/about', AboutController::class)->names('admin.about');


    // Islamic Classes
    Route::resource('/admin/classes', IslamicClassController::class)->names('admin.classes');
    Route::get('/admin/class-registrations', [IslamicClassController::class, 'registrations'])->name('admin.classes.registrations');

    // Community Members
    Route::get('/admin/community', [CommunityMemberController::class, 'index'])->name('admin.community.index');
    Route::delete('/admin/community/{id}', [CommunityMemberController::class, 'destroy'])->name('admin.community.destroy');

    // Donors
    Route::resource('/admin/donors', DonorController::class)->names('admin.donors');

    // Gallery
    Route::resource('/admin/gallery-categories', GalleryCategoryController::class)->names('admin.gallery-categories');
    Route::resource('/admin/galleries', GalleryController::class)->names('admin.galleries');

    // Services
    Route::resource('/admin/services', ServiceController::class)->names('admin.services');
    Route::get('/admin/service-requests', [ServiceRequestController::class, 'index'])->name('admin.service-requests.index');
    Route::delete('/admin/service-requests/{serviceRequest}', [ServiceRequestController::class, 'destroy'])->name('admin.service-requests.destroy');

    // Event Popups
    Route::resource('/admin/event-popups', \App\Http\Controllers\Admin\EventPopupController::class)->names('admin.event-popups');

    // Contact Messages
    Route::get('/admin/contact-messages', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('admin.contact-messages.index');
    Route::delete('/admin/contact-messages/{id}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('admin.contact-messages.destroy');
});

// Guest-only routes for admin auth
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    // Standard alias expected by Authenticate middleware
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
});


// Mosque public routes
Route::prefix('mosque')->name('masjid.')->group(function () {
    Route::get('/about', [MosqueController::class, 'about'])->name('about');
    Route::get('/services', [MosqueController::class, 'services'])->name('services');
    Route::get('/services/{service}', [MosqueController::class, 'serviceDetail'])->name('services.detail');
    Route::post('/services/request', [MosqueController::class, 'storeServiceRequest'])->name('services.request');
    Route::get('/gallery', [MosqueController::class, 'gallery'])->name('gallery');
    Route::get('/contact', [MosqueController::class, 'contact'])->name('contact');
    Route::post('/contact', [MosqueController::class, 'storeContactMessage'])->name('contact.post');

    // Class Registration
    Route::post('/join-class', [MosqueController::class, 'storeRegistration'])->name('join_class');
    // Community Join
    Route::post('/join-community', [MosqueController::class, 'storeCommunityMember'])->name('join_community'); // keep for backward compatibility
    Route::post('/join-community', [MosqueController::class, 'storeCommunityMember'])->name('join_community');
    // Donor Notification
    Route::post('/donate', [MosqueController::class, 'storeDonor'])->name('store_donor');
});

// Alias logout for non-prefixed route
Route::middleware('auth')->post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

// Temporary redirect to the static masjid homepage copied into public/masjid
Route::get('/mosjid_min', function () {
    return redirect('/masjid/index.html');
});
