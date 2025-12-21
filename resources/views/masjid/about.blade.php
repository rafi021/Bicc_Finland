@extends('masjid.layout')

@section('title', 'About')

@section('content')
<section>
  <!-----hero section-->
  <section
    class="max-w-[1320px] mt-2 sm:mt-0 mb-6 md:mb-[80px] px-5 xl:px-0 mx-auto overflow-hidden"
  >
    <div class="relative mt-2 sm:mt-5">
      <div class="w-full h-auto rounded-[20px]">
        <img
          src="{{ image($about->image ?? null, 'masjid/images/gallaryhero.png', '1320x300', 'About') }}"
          alt="image"
          class="w-full object-cover rounded-[10px] sm:rounded-[20px] min-h-[200px]"
        />
      </div>
      <div
        class="flex flex-col text-white absolute bottom-2 sm:bottom-5 lg:bottom-16 left-6"
      >
        <span class="text-[10px] sm:text-sm"
          ><a href="{{ route('mosque.home') }}">Home</a> / About Us</span
        >
        <span class="text-xl sm:text-[32px] font-medium">{{ $about->title ?? 'About Us' }}</span>
      </div>
    </div>
  </section>


  <section
    class="max-w-[1320px] mb-6 md:mb-[130px] px-5 xl:px-0 mx-auto overflow-hidden"
  >
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-y-6 gap-x-[100px] mt-10 items-center">
      <div>
        <h3 class="capitalize text-xl md:text-[32px] font-medium text-[var(--primary-2)] mb-6">
          {{ $about->title ?? 'About CBG Mosque' }}
        </h3>
        <div class="text-xs sm:text-lg text-[var(--grey-500)] leading-relaxed">
          {!! $about->content ?? 'We are a dedicated community organization committed to providing spiritual, educational, and social services to our members.' !!}
        </div>
      </div>
      
      @php 
        $videoId = ($about && $about->video_id) ? $about->video_id : (@$setting->video_id ?? 'tQHAwV9B8hQ');
        $videoThumbPath = ($about && $about->video_thumbnail) ? $about->video_thumbnail : (@$setting->video_thumbnail ?? 'masjid/images/heroimg.png');
      @endphp
      <div class="max-w-[743px] w-full mt-6 mx-auto rounded-[30px] overflow-hidden relative cursor-pointer group" onclick="playVideo('{{ $videoId }}')">
          <img src="{{ image($videoThumbPath, 'masjid/images/heroimg.png', '743x418', 'Video') }}" class="w-full h-full object-cover rounded-[30px]" alt="Video Thumbnail">
          <div class="absolute inset-0 flex justify-center items-center bg-black/20 group-hover:bg-black/40 transition-all">
              <div class="w-16 h-16 bg-white/90 rounded-full flex justify-center items-center pl-1 group-hover:scale-110 transition-transform shadow-lg">
                  <i class="ti ti-player-play-filled text-[var(--primary-1)] text-3xl"></i>
              </div>
          </div>
      </div>
    </div>
  </section>

  <!---join our community-->
  <section
    id="community"
    class="bg-class-container w-full py-7 lg:py-[60px]"
  >
    <h3
      class="capitalize text-xl md:text-[32px] text-center font-medium text-[var(--primary-2)]"
    >
      join our community
    </h3>
    <div class="max-w-[1320px] px-5 xl:px-0 mx-auto w-full mt-10">
        @if(session('success_community'))
            <div class="max-w-[760px] mx-auto mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center" role="alert">
                <span class="font-bold">Success!</span>
                <span class="block sm:inline">{{ session('success_community') }}</span>
            </div>
        @endif
      <form
        action="{{ route('masjid.join_community') }}"
        method="POST"
        class="max-w-[760px] mx-auto px-6 py-6 bg-white rounded-[10px] space-y-4"
      >
        @csrf
        <div class="flex flex-col gap-y-1">
          <label
            for="name"
            class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize"
            >Name <span class="text-red-500">*</span></label
          >
          <input
            type="text"
            id="name"
            name="name"
            value=""
            placeholder="Enter Your Name"
            required
            class="py-2 sm:py-3 px-4 border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-xs sm:text-base text-[var(--grey-600)] sm:rounded-[16px] rounded-lg placeholder:text-[var(--grey-400)]"
          />
        </div>
        <div class="flex flex-col gap-y-1">
          <label
            for="email"
            class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize"
            >Email <span class="text-red-500">*</span></label
          >
          <input
            type="email"
            id="email"
            name="email"
            value=""
            placeholder="Enter Your Email"
            required
            class="py-2 sm:py-3 px-4 text-xs sm:text-base border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-[var(--grey-600)] rounded-lg sm:rounded-[16px] placeholder:text-[var(--grey-400)]"
          />
        </div>
        <div class="flex flex-col gap-y-1">
          <label
            for="phone-number"
            class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize"
            >phone number <span class="text-red-500">*</span></label
          >
          <input
            type="text"
            id="phone-number"
            name="phoneNumber"
            value=""
            placeholder="Enter Your PhoneNumber"
            required
            class="py-2 sm:py-3 px-4 text-xs sm:text-base border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-[var(--grey-600)] rounded-lg sm:rounded-[16px] placeholder:text-[var(--grey-400)]"
          />
        </div>
        <button
          class="text-center bg-[var(--primary-1)] w-full py-2 sm:py-3 text-white text-xs sm:text-base font-medium flex justify-center items-center cursor-pointer gap-x-1 hover:bg-[var(--primary-2)] text-center rounded-lg sm:rounded-[16px]"
          type="submit"
        >
          <span>Submit</span>
          <i class="ti ti-arrow-right text-white text-xl"></i>
        </button>
      </form>
    </div>
  </section>
</section>
@endsection