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
        
        <div class="mt-12 bg-(--primary-2) text-white rounded-[20px] p-8">
            <h3 class="text-2xl font-medium mb-4">Join Our Community</h3>
            <p class="mb-6">Become part of our growing community. Fill out the form below to stay connected with our activities and events.</p>
            
            @if(session('success'))
                <div class="bg-green-600/50 border border-green-400 text-white px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('success_community'))
                <div class="bg-green-600/50 border border-green-400 text-white px-4 py-3 rounded-lg mb-6">
                    {{ session('success_community') }}
                </div>
            @endif

            <form action="{{ route('masjid.join_community') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Name</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 border border-white/20 rounded-lg bg-white/10 text-white placeholder-white/70 focus:outline-none focus:border-white" placeholder="Your Name">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium mb-2">Email</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 border border-white/20 rounded-lg bg-white/10 text-white placeholder-white/70 focus:outline-none focus:border-white" placeholder="your@email.com">
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Phone</label>
                    <input type="tel" name="phoneNumber" required class="w-full px-4 py-3 border border-white/20 rounded-lg bg-white/10 text-white placeholder-white/70 focus:outline-none focus:border-white" placeholder="+358 09 123 4567">
                </div>
                
                <button type="submit" class="bg-(--primary-1) text-white py-3 px-8 rounded-lg hover:bg-green-900 transition-colors font-medium">
                    Join Community
                </button>
            </form>
        </div>
    </div>
</section>
@endsection