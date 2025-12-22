@extends('masjid.layout')

@section('title', 'Gallery')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" />
<style>
    /* Hide the Lightbox Close Button */
    .lb-closeContainer, .lb-close {
        display: none !important;
    }
</style>
@endpush

@section('content')
<section>
    <!-----hero section-->
    <section class="max-w-[1320px] mt-2 sm:mt-0 mb-6 md:mb-[60px] px-5 xl:px-0 mx-auto overflow-hidden">
        <div class="relative mt-2 sm:mt-5">
            <div class="w-full h-auto rounded-[20px]">
                <img src="{{ image('masjid/images/gallaryhero.png', null, '1320x300', 'Hero') }}" alt="image" class="w-full object-cover rounded-[10px] sm:rounded-[20px]" />
            </div>
            <div class="flex flex-col text-white absolute bottom-3 lg:bottom-16 left-6">
                <span class="text-[10px] sm:text-sm"><a href="{{ route('mosque.home') }}">Home</a> / Our Gallary</span>
                <span class="text-xl sm:text-[32px] font-medium">Our Gallery</span>
            </div>
        </div>
    </section>
    <section class="max-w-[1320px] mb-6 md:mb-[130px] px-5 xl:px-0 mx-auto relative overflow-hidden">
        <h3 class="capitalize text-xl md:text-[32px] text-center font-medium text-[var(--primary-2)]">
            Our Gallery
        </h3>
        <div class="grid grid-cols-12 mt-10 md:gap-x-12">
            <div class="col-span-12 md:col-span-4 hidden md:block">
                <div class="w-full py-6 px-6 bg-[var(--grey-50)] border border-[var(--grey-200)] rounded-[20px]">
                    <h3 class="capitalize text-lg md:text-[28px] font-medium text-[var(--primary-2)]">
                        Images
                    </h3>
                    <div class="flex flex-col mt-4 space-y-2">
                        <a href="{{ route('masjid.gallery') }}" class="flex justify-between items-center w-full cursor-pointer group pb-2 {{ !request('category') ? 'text-[var(--primary-1)]' : 'text-[var(--grey-500)] hover:text-[var(--primary-1)]' }}">
                            <span class="text-sm sm:text-lg capitalize font-medium">All Images</span>
                            <i class="ti ti-chevron-right text-sm"></i>
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('masjid.gallery', ['category' => $cat->slug]) }}" class="flex justify-between items-center w-full cursor-pointer group pb-2 {{ request('category') == $cat->slug ? 'text-[var(--primary-1)]' : 'text-[var(--grey-500)] hover:text-[var(--primary-1)]' }}">
                                <span class="text-sm sm:text-lg capitalize font-medium">{{ $cat->name }} ({{ $cat->galleries_count }})</span>
                                <i class="ti ti-chevron-right text-sm"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @forelse($galleries as $image)
                        <div class="flex flex-col items-start w-full group">
                            <a href="{{ image($image->image) }}" data-lightbox="gallery" data-title="{{ $image->title }} - {{ $image->event_name }}" class="w-full h-full">
                                <div class="w-full max-[360px]:h-[200px] h-[291px] lg:h-[200px] xl:h-[291px] rounded-[16px] overflow-hidden shadow-sm">
                                    <img src="{{ image($image->image, null, '400x291', 'Gallery') }}" alt="{{ $image->title }}" class="w-full h-full object-cover rounded-[16px] transition-transform duration-500 group-hover:scale-105" />
                                </div>
                            </a>
                            <div class="flex flex-col mt-3">
                                <span class="text-sm sm:text-base text-[var(--grey-600)] font-semibold">{{ $image->title }}</span>
                                <span class="text-xs text-[var(--primary-2)] font-medium">
                                    {{ $image->event_name }} • {{ $image->event_time }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center text-gray-500 italic">
                            No images found in this category.
                        </div>
                    @endforelse
                </div>
                
                <!---pagination-->
                <div class="mt-10 flex justify-center">
                    {{ $galleries->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
        <i onclick="showGallaryDrawer()" class="ti ti-menu-2 text-2xl block sm:hidden text-[var(--grey-50)] bg-[var(--primary-1)] p-2 rounded-lg absolute top-1 left-5 z-20"></i>
    </section>
    <!-----draweroverlay-->
    <div id="gallery-drawer" onclick="closeGallaryDrawer()" class="w-full h-full fixed top-0 bg-black/50 z-50 hidden"></div>
    <div id="gallary-menubar" class="w-3/4 px-5 pt-5 h-full fixed top-0 bg-white z-50 -translate-x-[100%] transition-all duration-500">
        <h3 class="capitalize text-lg md:text-[28px] font-medium text-[var(--primary-2)]">
            Categories
        </h3>
        <div class="flex flex-col mt-4 space-y-2">
            <a href="{{ route('masjid.gallery') }}" onclick="closeGallaryDrawer()" class="flex justify-between items-center w-full cursor-pointer group pb-2 border-b border-gray-100">
                <span class="text-sm sm:text-lg capitalize text-[var(--grey-500)] group-hover:text-[var(--primary-1)]">All Images</span>
                <i class="ti ti-chevron-right text-[var(--grey-500)] group-hover:text-[var(--primary-1)]"></i>
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('masjid.gallery', ['category' => $cat->slug]) }}" onclick="closeGallaryDrawer()" class="flex justify-between items-center w-full cursor-pointer group pb-2 border-b border-gray-100">
                    <span class="text-sm sm:text-lg capitalize text-[var(--grey-500)] group-hover:text-[var(--primary-1)]">{{ $cat->name }}</span>
                    <i class="ti ti-chevron-right text-[var(--grey-500)] group-hover:text-[var(--primary-1)]"></i>
                </a>
            @endforeach
        </div>
    </div>
    <!---join our community-->
    <section id="community" class="bg-class-container w-full py-7 lg:py-[60px]">
        <h3 class="capitalize text-xl md:text-[32px] text-center font-medium text-[var(--primary-2)]">
            join our community
        </h3>
        <div class="max-w-[1320px] px-5 xl:px-0 mx-auto w-full mt-10">
            @if(session('success_community'))
                <div class="max-w-[760px] mx-auto mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center" role="alert">
                    <span class="font-bold">Success!</span>
                    <span class="block sm:inline">{{ session('success_community') }}</span>
                </div>
            @endif
            <form action="{{ route('masjid.join_community') }}" method="POST" class="max-w-[760px] mx-auto px-6 py-6 bg-white rounded-[10px] space-y-4">
                @csrf
                <div class="flex flex-col gap-y-1">
                    <label for="name" class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize">Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="" placeholder="Enter Your Name" required class="py-2 sm:py-3 px-4 border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-xs sm:text-base text-[var(--grey-600)] sm:rounded-[16px] rounded-lg placeholder:text-[var(--grey-400)]" />
                </div>
                <div class="flex flex-col gap-y-1">
                    <label for="email" class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="" placeholder="Enter Your Email" required class="py-2 sm:py-3 px-4 text-xs sm:text-base border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-[var(--grey-600)] rounded-lg sm:rounded-[16px] placeholder:text-[var(--grey-400)]" />
                </div>
                <div class="flex flex-col gap-y-1">
                    <label for="phone-number" class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize">phone number <span class="text-red-500">*</span></label>
                    <input type="text" id="phone-number" name="phoneNumber" value="" placeholder="Enter Your PhoneNumber" required class="py-2 sm:py-3 px-4 text-xs sm:text-base border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-[var(--grey-600)] rounded-lg sm:rounded-[16px] placeholder:text-[var(--grey-400)]" />
                </div>
                <button class="text-center bg-[var(--primary-1)] w-full py-2 sm:py-3 text-white text-xs sm:text-base font-medium flex justify-center items-center cursor-pointer gap-x-1 hover:bg-[var(--primary-2)] text-center rounded-lg sm:rounded-[16px]" type="submit">
                    <span>Submit</span>
                    <i class="ti ti-arrow-right text-white text-xl"></i>
                </button>
            </form>
        </div>
    </section>
</section>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox-plus-jquery.min.js"></script>
<script>
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true,
      'alwaysShowNavOnTouchDevices': true,
      'albumLabel': "Image %1 of %2"
    })
</script>
@endpush