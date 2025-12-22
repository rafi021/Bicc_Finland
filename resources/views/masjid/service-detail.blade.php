@extends('masjid.layout')

@section('title', $service->title)

@section('content')
<section class="max-w-[1320px] mt-6 md:mt-[130px] px-5 xl:px-0 mx-auto overflow-hidden">
    <div class="mb-8">
        <a href="{{ route('masjid.services') }}" class="text-(--primary-1) hover:text-(--primary-2) flex items-center gap-2">
            <i class="ti ti-arrow-left"></i>
            <span>Back to Services</span>
        </a>
    </div>
    
    <div class="bg-white border border-(--grey-200) rounded-[20px] overflow-hidden shadow-sm">
        <div class="w-full h-[300px] md:h-[450px] overflow-hidden">
            <img src="{{ image($service->image, null, '1320x450', 'Service Image') }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
        </div>

        <div class="p-8 md:p-12">
            <h1 class="text-3xl md:text-5xl font-bold text-(--primary-2) mb-8">{{ $service->title }}</h1>
            
            <div class="text-(--grey-600) mb-12 w-full">
                <p class="text-xl leading-relaxed w-full wrap-break-word">{{ $service->description }}</p>
            </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t border-(--grey-200)">
            <div>
                <h3 class="text-xl font-medium text-(--primary-2) mb-4">Service Highlights</h3>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <i class="ti ti-check text-(--primary-1) mt-1"></i>
                        <span class="text-(--grey-600)">Professional and experienced staff</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="ti ti-check text-(--primary-1) mt-1"></i>
                        <span class="text-(--grey-600)">Comprehensive service support</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="ti ti-check text-(--primary-1) mt-1"></i>
                        <span class="text-(--grey-600)">Community-focused approach</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="ti ti-check text-(--primary-1) mt-1"></i>
                        <span class="text-(--grey-600)">Flexible scheduling options</span>
                    </li>
                </ul>
            </div>
            
            <div>
                <h3 class="text-xl font-medium text-(--primary-2) mb-4">Contact Information</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <i class="ti ti-phone text-(--primary-1) text-xl"></i>
                        <div>
                            <p class="font-medium text-(--grey-800)">Phone</p>
                            <p class="text-(--grey-600)">{{ @$setting->phone ?? '(555) 123-4567' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <i class="ti ti-mail text-(--primary-1) text-xl"></i>
                        <div>
                            <p class="font-medium text-(--grey-800)">Email</p>
                            <p class="text-(--grey-600)">{{ @$setting->email ?? 'info@biccfinland.org' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <i class="ti ti-clock text-(--primary-1) text-xl"></i>
                        <div>
                            <p class="font-medium text-(--grey-800)">Office Hours</p>
                            <p class="text-(--grey-600)">{{ @$setting->office_hours ?? 'Monday - Friday: 9:00 AM - 5:00 PM' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!---request service-->
        <section id="service-request" class="bg-[var(--grey-50)] w-full py-7 lg:py-[60px] mt-12 rounded-[20px] border border-[var(--grey-200)]">
            <h3 class="capitalize text-xl md:text-[32px] text-center font-medium text-[var(--primary-2)]">
                Request This Service
            </h3>
            <div class="max-w-[1320px] px-5 xl:px-0 mx-auto w-full mt-10">
                @if(session('success'))
                    <div class="max-w-[760px] mx-auto mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="max-w-[760px] mx-auto mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('masjid.services.request') }}" method="POST" class="max-w-[760px] mx-auto px-6 py-6 bg-white rounded-[10px] space-y-4">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">

                    <div class="flex flex-col gap-y-1">
                        <label for="name" class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Your Name" required class="py-2 sm:py-3 px-4 border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-xs sm:text-base text-[var(--grey-600)] sm:rounded-[16px] rounded-lg placeholder:text-[var(--grey-400)]" />
                    </div>

                    <div class="flex flex-col gap-y-1">
                        <label for="email" class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="your@email.com" required class="py-2 sm:py-3 px-4 text-xs sm:text-base border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-[var(--grey-600)] rounded-lg sm:rounded-[16px] placeholder:text-[var(--grey-400)]" />
                    </div>

                    <div class="flex flex-col gap-y-1">
                        <label for="phone" class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize">Phone Number <span class="text-red-500">*</span></label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+358 09 123 4567" required class="py-2 sm:py-3 px-4 text-xs sm:text-base border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-[var(--grey-600)] rounded-lg sm:rounded-[16px] placeholder:text-[var(--grey-400)]" />
                    </div>

                    <div class="flex flex-col gap-y-1">
                        <label for="message" class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize">Additional Message</label>
                        <textarea id="message" name="message" placeholder="Briefly describe your request..." class="py-2 sm:py-3 px-4 text-xs sm:text-base border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-[var(--grey-600)] rounded-lg sm:rounded-[16px] placeholder:text-[var(--grey-400)] min-h-[100px]">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="text-center bg-[var(--primary-1)] w-full py-2 sm:py-3 text-white text-xs sm:text-base font-medium flex justify-center items-center cursor-pointer gap-x-1 hover:bg-[var(--primary-2)] text-center rounded-lg sm:rounded-[16px]">
                        <span>Submit Request</span>
                        <i class="ti ti-arrow-right text-white text-xl"></i>
                    </button>
                </form>
            </div>
        </section>
    </div>
</section>
@endsection