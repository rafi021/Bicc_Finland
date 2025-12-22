
<!------classModal-->
<div id="classes-container" class="w-full bg-black/70 h-full z-[100] fixed top-0 left-0 flex justify-center items-center hidden px-5 xl:px-0 backdrop-blur-sm transition-all duration-300">
    <div class="w-full max-w-[600px] mx-auto z-50 bg-white border border-[var(--grey-200)] rounded-[24px] relative shadow-2xl p-6 sm:p-8 animate-in fade-in zoom-in duration-300">
        <i onclick="closeClassModal()" class="ti ti-x text-2xl text-[var(--grey-500)] absolute top-4 right-4 cursor-pointer hover:text-red-500 transition-colors bg-gray-100 p-1 rounded-full"></i>
        
        <form action="{{ route('masjid.join_class') }}" method="POST" class="w-full space-y-4">
            @csrf
            <input type="hidden" name="islamic_class_id" id="modal_class_id">
            
            <div class="text-center space-y-1 mb-4">
                <h3 class="text-xl md:text-[28px] font-medium text-[var(--primary-2)]">Class Registration</h3>
                <p class="text-[var(--grey-500)] text-xs sm:text-sm">Join our educational initiatives to strengthen your faith.</p>
            </div>

            <div class="flex flex-col gap-y-1 w-full">
                <label for="reg_name" class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize">Name <span class="text-red-500">*</span></label>
                <input type="text" id="reg_name" name="name" value="" placeholder="Enter Your Name" required class="py-2 sm:py-3 px-4 border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-xs sm:text-base text-[var(--grey-600)] sm:rounded-[16px] rounded-lg placeholder:text-[var(--grey-400)]" />
            </div>

            <div class="flex flex-col gap-y-1 w-full">
                <label for="reg_email" class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize">Email <span class="text-red-500">*</span></label>
                <input type="email" id="reg_email" name="email" value="" placeholder="Enter Your Email" required class="py-2 sm:py-3 px-4 border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-xs sm:text-base text-[var(--grey-600)] sm:rounded-[16px] rounded-lg placeholder:text-[var(--grey-400)]" />
            </div>

            <div class="flex flex-col gap-y-1 w-full">
                <label for="reg_phone" class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize">PhoneNumber <span class="text-red-500">*</span></label>
                <input type="text" id="reg_phone" name="phone" value="" placeholder="Enter Your PhoneNumber" required class="py-2 sm:py-3 px-4 border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-xs sm:text-base text-[var(--grey-600)] sm:rounded-[16px] rounded-lg placeholder:text-[var(--grey-400)]" />
            </div>

            <div class="flex flex-col gap-y-1 w-full">
                <label for="reg_message" class="text-[var(--grey-500)] text-xs sm:text-base font-medium capitalize">Message (Optional)</label>
                <textarea id="reg_message" name="message" placeholder="Anything we should know?" class="py-2 sm:py-3 px-4 border border-[var(--grey-300)] outline-none focus:outline-none focus:border-amber-600 text-xs sm:text-base text-[var(--grey-600)] sm:rounded-[16px] rounded-lg placeholder:text-[var(--grey-400)] min-h-[80px]"></textarea>
            </div>

            <button class="text-center bg-[var(--primary-1)] w-full py-2 sm:py-3 text-white text-xs sm:text-base font-medium flex justify-center items-center cursor-pointer gap-x-1 hover:bg-[var(--primary-2)] text-center rounded-lg sm:rounded-[16px]" type="submit">
                <span>Submit Registration</span>
                <i class="ti ti-arrow-right text-white text-xl"></i>
            </button>
        </form>
    </div>
</div>
