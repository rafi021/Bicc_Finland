@extends('masjid.layout')

@section('title', 'Services')

@section('content')
<section>
    <!-----hero section-->
    <section class="max-w-[1320px] mt-2 sm:mt-0 mb-6 md:mb-[130px] px-5 xl:px-0 mx-auto overflow-hidden">
        <div class="relative mt-2 sm:mt-5">
            <div class="w-full h-auto rounded-[20px]">
                <img src="{{ image('masjid/images/gallaryhero.png', null, '1320x300', 'Hero') }}" alt="image" class="w-full object-cover rounded-[10px] sm:rounded-[20px]" />
            </div>
            <div class="flex flex-col text-white absolute bottom-2 sm:bottom-5 lg:bottom-16 left-6">
                <span class="text-[10px] sm:text-sm"><a href="{{ route('mosque.home') }}">Home</a> / Our Services</span>
                <span class="text-xl sm:text-[32px] font-medium">Our Services</span>
            </div>
        </div>
    </section>
    <section class="max-w-[1320px] mb-6 md:mb-[130px] px-5 xl:px-0 mx-auto overflow-hidden">
        <h3 class="capitalize text-xl md:text-[32px] text-center font-medium text-[var(--primary-2)]">
            Our Services
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-8 gap-x-[102px] mt-10">
            <!--------span-right-->
            <div class="w-full h-full">
                <img src="{{ image('masjid/images/serviceimage.png', '600x400', 'Service') }}" alt="image" class="object-cover rounded-[20px] shadow-lg w-full" />
            </div>
            <div class="flex flex-col gap-y-10">
                @forelse($services as $service)
                <div class="flex flex-col sm:flex-row text-center sm:text-start items-center gap-x-6 group">
                    <div class="flex justify-center items-center min-w-[112px] min-h-[112px] rounded-full bg-[var(--grey-200)] group-hover:bg-[var(--primary-1)] group-hover:text-white transition-all">
                        <i class="ti {{ $service->icon }} text-[54px] {{ $service->icon ? '' : 'ti-help' }}"></i>
                    </div>
                    <div class="flex flex-col gap-y-4">
                        <span class="text-lg sm:text-[28px] font-medium text-[var(--primary-1)]">{{ $service->title }}</span>
                        <span class="text-xs sm:text-base text-[var(--grey-500)]">
                            {{ $service->description }}
                        </span>
                        <a href="{{ route('masjid.services.detail', $service->slug) }}">
                            <div class="flex items-start w-full sm:w-[157px]">
                                <div class="flex items-center w-full justify-center gap-x-[10px] py-3 px-4 rounded-[10px] bg-[var(--primary-1)] cursor-pointer hover:bg-[var(--primary-2)] transition-colors">
                                    <span class="text-xs sm:text-base text-white capitalize font-medium">Read More</span>
                                    <i class="ti ti-arrow-right text-white text-sm sm:text-xl"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                    <div class="py-10 text-center text-gray-500 italic">No services available.</div>
                @endforelse
            </div>
        </div>
    </section>
    <!------video section-->
    <section class="max-w-[1320px] mb-6 md:mb-[130px] px-5 xl:px-0 mx-auto overflow-hidden">
        <h3 class="text-xl text-center sm:text-[32px] text-[var(--primary-2)] font-medium">
            Video About Our Activities
        </h3>
        @php $serviceVideoId = 'oIy3wlIfv7I'; @endphp
        <div class="w-full h-auto mt-10 rounded-[10px] sm:rounded-[20px] overflow-hidden relative cursor-pointer group" onclick="playVideo('{{ $serviceVideoId }}')">
            <img src="{{ image('masjid/images/servicevideo.png', null, '1320x743', 'Video') }}" class="w-full h-full object-cover rounded-[10px] sm:rounded-[20px]" alt="Video Thumbnail">
            <div class="absolute inset-0 flex justify-center items-center bg-black/20 group-hover:bg-black/40 transition-all">
                <div class="w-16 h-16 bg-white/90 rounded-full flex justify-center items-center pl-1 group-hover:scale-110 transition-transform shadow-lg">
                    <i class="ti ti-player-play-filled text-[var(--primary-1)] text-3xl"></i>
                </div>
            </div>
        </div>
    </section>
    <!---join our community-->
    <section id="community" class="bg-class-container w-full py-7 lg:py-[60px]">
        <h3 class="capitalize text-xl md:text-[32px] text-center font-medium text-[var(--primary-2)]">
            join our community
        </h3>
        <div class="max-w-[1320px] px-5 xl:px-0 mx-auto w-full mt-10">
            <form action="" class="max-w-[760px] mx-auto px-6 py-6 bg-white rounded-[10px] space-y-4">
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