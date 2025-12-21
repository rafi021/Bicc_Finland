@extends('admin.layout')

@section('title', 'Social Media & Payment Settings')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manage Social & Payment Info</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @include('admin.partials.errors')

    <form action="{{ route('admin.mosque.social_payment.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <!-- Social Media Section -->
        <div class="border-b pb-6">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                <i class="ti ti-share text-primary-600"></i> Social Media Links
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Facebook -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Facebook URL</label>
                    <input type="url" name="facebook" value="{{ old('facebook', @$setting->facebook) }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2" 
                        placeholder="https://facebook.com/your-page">
                </div>

                <!-- Twitter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Twitter URL</label>
                    <input type="url" name="twitter" value="{{ old('twitter', @$setting->twitter) }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2" 
                        placeholder="https://twitter.com/your-handle">
                </div>

                <!-- WhatsApp -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">WhatsApp Number</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', @$setting->whatsapp) }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2" 
                        placeholder="e.g. +358 123456789">
                </div>

                <!-- Instagram -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Instagram URL</label>
                    <input type="url" name="instagram" value="{{ old('instagram', @$setting->instagram) }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2" 
                        placeholder="https://instagram.com/your-profile">
                </div>
            </div>
        </div>

        <!-- Payment Info Section -->
        <div>
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                <i class="ti ti-credit-card text-primary-600"></i> Payment & Donation Details
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Mobile Banking QR -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Mobile Banking QR Code</label>
                    <div class="flex flex-col items-center w-full">
                        <input type="file" name="mobile_banking_qr" 
                            class="dropify" 
                            data-default-file="{{ image(@$setting->mobile_banking_qr) }}"
                            accept="image/*">
                        <p class="text-[10px] text-gray-400 mt-2 italic text-center">Used for bKash/Nagad/Rocket qr payments.</p>
                    </div>
                </div>

                <!-- Bank QR -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Bank QR Code (Optional)</label>
                    <div class="flex flex-col items-center w-full">
                        <input type="file" name="bank_qr" 
                            class="dropify" 
                            data-default-file="{{ image(@$setting->bank_qr) }}"
                            accept="image/*">
                        <p class="text-[10px] text-gray-400 mt-2 italic text-center">Used for direct bank app scan payments.</p>
                    </div>
                </div>

                <!-- Bank Info -->
                <div class="md:col-span-2 bg-gray-50 p-6 rounded-lg border border-gray-200">
                    <h4 class="font-bold text-gray-700 mb-4 text-center border-b pb-2">Manual Bank Account Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Bank Name</label>
                        <input type="text" name="bank_name" value="{{ old('bank_name', @$setting->bank_name) }}" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2" 
                            placeholder="e.g. Islami Bank Bangladesh Limited">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Account Name</label>
                        <input type="text" name="account_name" value="{{ old('account_name', @$setting->account_name) }}" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2" 
                            placeholder="e.g. mosque Name Charity Fund">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Account Number</label>
                        <input type="text" name="account_number" value="{{ old('account_number', @$setting->account_number) }}" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2" 
                            placeholder="e.g. 1234 5678 9012">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Branch Name</label>
                            <input type="text" name="branch_name" value="{{ old('branch_name', @$setting->branch_name) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2" 
                                placeholder="Dhanmondi Branch">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Routing/Swift Code</label>
                            <input type="text" name="swift_code" value="{{ old('swift_code', @$setting->swift_code) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm border p-2" 
                                placeholder="IBBKBDDH">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition font-bold shadow-lg">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
