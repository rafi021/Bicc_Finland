
<!------classModal-->
<div id="classes-container" class="w-full bg-black/70 h-full z-[100] fixed top-0 left-0 flex justify-center items-center hidden px-5 xl:px-0 backdrop-blur-sm transition-all duration-300">
    <div class="w-full max-w-[600px] mx-auto z-50 bg-white border border-[var(--grey-200)] rounded-[24px] relative shadow-2xl p-6 sm:p-8 animate-in fade-in zoom-in duration-300">
        <i onclick="closeClassModal()" class="ti ti-x text-2xl text-[var(--grey-500)] absolute top-4 right-4 cursor-pointer hover:text-red-500 transition-colors bg-gray-100 p-1 rounded-full"></i>
        
        <form action="{{ route('masjid.join_class') }}" method="POST" class="w-full space-y-5">
            @csrf
            <input type="hidden" name="islamic_class_id" id="modal_class_id">
            <div class="text-center space-y-2">
                <h3 class="text-2xl sm:text-3xl font-black text-[var(--primary-2)]">Class Registration</h3>
                <p class="text-gray-500 text-sm italic">Join our educational initiatives to strengthen your faith.</p>
            </div>

            <div class="space-y-4 pt-4">
                <div class="flex flex-col gap-y-1">
                    <label for="reg_name" class="text-slate-500 text-[10px] font-black uppercase tracking-widest ml-1">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" id="reg_name" name="name" required placeholder="Enter Your Name" class="py-3 px-4 border-2 border-slate-50 outline-none focus:border-green-600 rounded-xl bg-slate-50 shadow-sm transition-all font-medium">
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-y-1">
                        <label for="reg_email" class="text-slate-500 text-[10px] font-black uppercase tracking-widest ml-1">Email <span class="text-red-500">*</span></label>
                        <input type="email" id="reg_email" name="email" required placeholder="Email Address" class="py-3 px-4 border-2 border-slate-50 outline-none focus:border-green-600 rounded-xl bg-slate-50 shadow-sm transition-all font-medium">
                    </div>
                    <div class="flex flex-col gap-y-1">
                        <label for="reg_phone" class="text-slate-500 text-[10px] font-black uppercase tracking-widest ml-1">Phone Number <span class="text-red-500">*</span></label>
                        <input type="text" id="reg_phone" name="phone" required placeholder="Phone" class="py-3 px-4 border-2 border-slate-50 outline-none focus:border-green-600 rounded-xl bg-slate-50 shadow-sm transition-all font-medium">
                    </div>
                </div>

                <div class="flex flex-col gap-y-1">
                    <label for="reg_message" class="text-slate-500 text-[10px] font-black uppercase tracking-widest ml-1">Message (Optional)</label>
                    <textarea id="reg_message" name="message" rows="3" placeholder="Anything we should know?" class="py-3 px-4 border-2 border-slate-50 outline-none focus:border-green-600 rounded-xl bg-slate-50 shadow-sm transition-all font-medium resize-none"></textarea>
                </div>
            </div>

            <button class="bg-[var(--primary-1)] w-full py-4 text-white font-black rounded-xl hover:bg-[var(--primary-2)] transition-all flex justify-center items-center gap-3 shadow-lg shadow-green-100 active:scale-95" type="submit">
                <span>Submit Registration</span>
                <i class="ti ti-arrow-right text-2xl"></i>
            </button>
        </form>
    </div>
</div>
