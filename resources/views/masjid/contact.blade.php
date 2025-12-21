@extends('masjid.layout')

@section('title', 'Contact')

@section('content')
<section>
      <!-----hero section-->
      <section
        class="max-w-[1320px] mt-2 sm:mt-0  bg-white mb-6 md:mb-[80px] px-5 xl:px-0 mx-auto overflow-hidden"
      >
        <div class="relative mt-2 sm:mt-5">
          <div class="w-full h-auto rounded-[20px]">
            <img
              src="{{ image('masjid/images/gallaryhero.png', null, '1320x300', 'Hero') }}"
              alt="image"
              class="w-full object-cover rounded-[10px] sm:rounded-[20px]"
            />
          </div>
          <div
            class="flex flex-col text-white absolute bottom-2 sm:bottom-5 lg:bottom-16 left-6"
          >
            <span class="text-[10px] sm:text-sm"
              ><a href="{{ route('mosque.home') }}">Home</a> / Contact Us</span
            >
            <span class="text-xl sm:text-[32px] font-medium">Contact Us</span>
          </div>
        </div>
      </section>
      <section
        class="max-w-[1320px] mb-6 md:mb-[130px] px-5 xl:px-0 mx-auto overflow-hidden"
      >
        <h3
          class="capitalize text-xl md:text-[32px] text-center font-medium text-[var(--primary-2)]"
        >
      Contact Us
        </h3>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-y-6  gap-x-4 lg:gap-x-[0px] mt-10 items-start">
          <div class=" flex flex-col lg:max-w-[354px]">
          <img src="{{ image(@$setting->site_logo, 'masjid/images/logo.png', '124x40', 'Logo') }}" alt="image" class="w-[124px]">
          <span class="text-sm sm:text-lg text-[var(--grey-500)] mt-4">
            Bangladesh Islamic Cultural Centre - Building a stronger Muslim community through faith, education, and unity.
          </span>
              <div class="flex gap-x-1 items-center mt-4">
            <i class="ti ti-phone text-[var(--grey-500)] text-2xl"></i>
            <span class="text-xs sm:text-base text-[var(--grey-500)]"> (555) 123-4567</span>
          </div>
          <div class="flex gap-x-1 items-center mt-1">
            <i class="ti ti-home text-[var(--grey-500)] text-2xl"></i>
            <span class="text-xs sm:text-base text-[var(--grey-500)]"
              >Malminkaari 9 A (3rd floor)</span
            >
          </div>
          <div class="flex gap-x-1 items-center mt-1">
            <i class="ti ti-mail text-[var(--grey-500)] text-2xl"></i>
            <span class="text-xs sm:text-base text-[var(--grey-500)]"> info@biccfinland.org</span>
          </div>
          </div>
          <div class="w-full">
             @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
             @endif

             @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
             @endif

             <form
            action="{{ route('masjid.contact.post') }}"
            method="POST"
            class="px-6 py-6 w-full bg-[var(--grey-50)] border border-[var(--grey-200)] rounded-[10px] space-y-4"
          >
            @csrf
            <div class="flex flex-col gap-y-1">
              <label
                for="first-name"
                class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize"
                >First Name <span class="text-red-500">*</span></label
              >
              <input
                type="text"
                id="first-name"
                name="firstName"
                value=""
                placeholder="Enter First Your Name"
                required
                class="py-2 sm:py-3 px-4 border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-xs sm:text-base text-[var(--grey-600)] sm:rounded-[16px] rounded-lg placeholder:text-[var(--grey-400)]"
              />
            </div>
             <div class="flex flex-col gap-y-1">
              <label
                for="last-name"
                class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize"
                >Last Name <span class="text-red-500">*</span></label
              >
              <input
                type="text"
                id="last-name"
                name="lastName"
                value=""
                placeholder="Enter Your Last Name"
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
            <div class="flex flex-col gap-y-1">
              <label
                for="message"
                class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize"
                >Message <span class="text-red-500">*</span></label
              >
              <textarea
                type="text"
                id="message"
                name="message"
                value=""
                placeholder="Write Here....."
                required
                class="py-2 sm:py-3 px-4 text-xs sm:text-base border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-[var(--grey-600)] rounded-lg sm:rounded-[16px] placeholder:text-[var(--grey-400)]"
              ></textarea>
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
                  <span class="block sm:inline">{{ session('success_community') }}</span>
              </div>
          @endif

          @if($errors->any())
              <div class="max-w-[760px] mx-auto mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                  <ul>
                      @foreach($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
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