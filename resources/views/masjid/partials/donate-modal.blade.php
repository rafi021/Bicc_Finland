
<div id="donate-modal" class="w-full h-full z-[100] hidden px-5 xl:px-0 fixed top-0 left-0 bg-black/70 flex justify-center items-center backdrop-blur-sm transition-all duration-300">
    <div class="w-full max-w-[734px] max-h-[95vh] overflow-y-auto px-6 py-6 mx-auto bg-white border border-[var(--grey-200)] rounded-[24px] relative shadow-2xl transform transition-all scale-100">
        <i onclick="closeDonateModal()" class="ti ti-x text-2xl text-[var(--grey-500)] absolute top-4 right-4 cursor-pointer hover:text-red-500 transition-colors bg-gray-100 p-1 rounded-full"></i>
        
        <div class="flex flex-col gap-y-6">
            <h2 class="text-2xl sm:text-3xl font-black text-[var(--primary-2)] text-center">Support Our Mission</h2>
            
            <div class="flex flex-wrap gap-3 justify-center items-center">
                <div id="active-qr-code" onclick="showQrCode()" class="px-6 py-3 rounded-xl cursor-pointer bg-green-600 text-white text-xs sm:text-base text-center font-bold uppercase shadow-lg transition-all hover:scale-105 active:scale-95">
                    Qr code process
                </div>
                <div id="active-mobile-banking" onclick="showMoblileBanking()" class="px-6 py-3 rounded-xl cursor-pointer hover:bg-green-50 text-xs sm:text-base text-center text-[var(--grey-500)] font-bold uppercase transition-all border border-gray-200 hover:border-green-600 shadow-sm active:scale-95">
                    BANK TRANSFER
                </div>
            </div>

            <!-- QR Code Container -->
            <div id="qr-code-container" class="flex flex-col items-center animate-in fade-in zoom-in duration-300">
                <h3 class="text-xl sm:text-2xl text-center text-gray-800 font-bold mb-4">
                    Scan & Secure Payment
                </h3>
                <div class="w-64 h-64 p-3 bg-white border-4 border-[var(--primary-1)] rounded-3xl shadow-xl flex items-center justify-center relative overflow-hidden group">
                    @php 
                        $qrPath = @$setting->mobile_banking_qr;
                        $hasQr = $qrPath && file_exists(public_path($qrPath));
                    @endphp
                    <img src="{{ image($qrPath, 'masjid/images/qr.png', '256x256', 'QR') }}" alt="QR Code" class="w-full h-full object-contain {{ !$hasQr ? 'opacity-30 blur-[2px]' : '' }}" />
                    @if(!$hasQr)
                        <div class="absolute inset-0 flex flex-col items-center justify-center bg-white/40">
                             <span class="text-sm font-black text-gray-400 rotate-[-12deg] border-2 border-gray-400 px-2 rounded">SAMPLE ONLY</span>
                        </div>
                    @endif
                </div>
                <p class="mt-4 text-[var(--grey-500)] text-sm italic font-medium flex items-center gap-2">
                    <i class="ti ti-camera text-[var(--primary-1)]"></i>
                    Scan using any payment app
                </p>
            </div>

            <!-- Bank Transfer Container -->
            <div id="mobile-banking-container" class="hidden flex flex-col items-center animate-in fade-in zoom-in duration-300">
                <h3 class="text-xl sm:text-2xl text-gray-800 text-center font-bold mb-6">
                    Bank Scan & Pay
                </h3>
                
                <!-- Bank QR -->
                <div class="w-64 h-64 p-3 bg-white border-4 border-blue-600 rounded-3xl shadow-xl flex items-center justify-center mb-6 relative group overflow-hidden">
                    @php 
                        $bankQrPath = @$setting->bank_qr;
                        $hasBankQr = $bankQrPath && file_exists(public_path($bankQrPath));
                    @endphp
                    <img src="{{ image($bankQrPath, 'masjid/images/qr.png', '256x256', 'Bank QR') }}" alt="Bank QR" class="w-full h-full object-contain {{ !$hasBankQr ? 'opacity-30 blur-[1px]' : '' }}" />
                    @if(!$hasBankQr)
                        <div class="absolute inset-0 flex flex-col items-center justify-center bg-white/40">
                             <span class="text-sm font-black text-blue-400 rotate-[12deg] border-2 border-blue-400 px-2 rounded uppercase">Sample Bank QR</span>
                        </div>
                    @endif
                </div>

                <div class="w-full flex justify-center mb-6">
                    <button onclick="toggleBankDetails()" id="toggle-bank-btn" class="px-8 py-3 bg-blue-50 text-blue-700 font-black rounded-full border-2 border-blue-200 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all flex items-center gap-2 shadow-sm active:scale-95">
                        <i class="ti ti-building-bank"></i> View Account Details
                    </button>
                </div>
                
                <div id="bank-details-info" class="w-full bg-slate-50 p-6 rounded-[24px] border-2 border-slate-100 mb-6 hidden animate-in fade-in slide-in-from-top-4 duration-300 shadow-inner">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <span class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Bank Name</span>
                            <span class="text-slate-800 font-bold text-lg leading-tight">{{ @$setting->bank_name ?? 'Islami Bank Bangladesh PLC' }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Account Name</span>
                            <span class="text-slate-800 font-bold text-lg leading-tight">{{ @$setting->account_name ?? 'BICC Finland Charity Fund' }}</span>
                        </div>
                        <div class="flex flex-col md:col-span-2 bg-white p-4 rounded-2xl border-2 border-dashed border-green-200 group relative">
                            <span class="text-green-600 text-[10px] font-black uppercase tracking-widest">Account Number / IBAN</span>
                            <div class="flex justify-between items-center mt-1">
                                <span class="text-xl sm:text-2xl font-black text-slate-900 tracking-tighter sm:tracking-normal break-all select-all">{{ @$setting->account_number ?? '2050 1450 2000 0000' }}</span>
                                <button onclick="copyToClipboard('{{ @$setting->account_number ?? '2050 1450 2000 0000' }}', this)" class="w-10 h-10 flex items-center justify-center bg-green-50 text-green-600 rounded-full hover:bg-green-600 hover:text-white transition-all shadow-sm">
                                    <i class="ti ti-copy text-xl"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Branch</span>
                            <span class="text-slate-800 font-bold">{{ @$setting->branch_name ?? 'Helsinki Main' }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Swift / BIC</span>
                            <span class="text-slate-800 font-bold">{{ @$setting->swift_code ?? 'IBBKBDDHXXX' }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col w-full text-center">
                    <p class="text-[var(--grey-500)] text-sm font-bold flex items-center justify-center gap-2">
                         Reveal donor information?
                        <span class="inline-flex items-center gap-4 ml-2">
                             <label class="flex items-center gap-1 cursor-pointer group">
                                 <input type="radio" name="reveal" onclick="showInputName()" class="accent-green-600 w-4 h-4">
                                 <span class="group-hover:text-green-600 transition-colors">Yes</span>
                             </label>
                             <label class="flex items-center gap-1 cursor-pointer group">
                                 <input type="radio" name="reveal" onclick="closeInputName()" checked class="accent-slate-400 w-4 h-4">
                                 <span class="group-hover:text-slate-600 transition-colors">No</span>
                             </label>
                        </span>
                    </p>
                    
                    <div id="input" class="pt-6 hidden w-full animate-in zoom-in duration-300">
                        <form action="{{ route('masjid.store_donor') }}" method="POST" class="w-full space-y-5 bg-slate-50 p-6 rounded-[24px] border border-slate-200">
                            @csrf
                            <input type="hidden" name="paymentMethod" value="Bank/QR">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="flex flex-col gap-y-1 text-left">
                                    <label class="text-slate-500 text-[10px] font-black uppercase tracking-widest ml-1">Full Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" required class="py-3 px-4 border-2 border-white outline-none focus:border-green-600 rounded-xl bg-white shadow-sm transition-all" placeholder="Enter Name" />
                                </div>
                                <div class="flex flex-col gap-y-1 text-left">
                                    <label class="text-slate-500 text-[10px] font-black uppercase tracking-widest ml-1">Phone <span class="text-red-500">*</span></label>
                                    <input type="text" name="phoneNumber" required class="py-3 px-4 border-2 border-white outline-none focus:border-green-600 rounded-xl bg-white shadow-sm transition-all" placeholder="Phone Number" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-y-1 text-left">
                                <label class="text-slate-500 text-[10px] font-black uppercase tracking-widest ml-1">Amount ($) <span class="text-red-500">*</span></label>
                                <input type="number" step="0.01" name="amount" required class="py-3 px-4 border-2 border-white outline-none focus:border-green-600 rounded-xl bg-white shadow-sm transition-all font-black text-xl" placeholder="0.00" />
                            </div>
                            <button class="bg-[var(--primary-1)] w-full py-4 text-white font-black rounded-xl hover:bg-[var(--primary-2)] transition-all flex justify-center items-center gap-3 shadow-lg shadow-green-200" type="submit">
                                <span>I've Donated Now</span>
                                <i class="ti ti-circle-check text-2xl"></i>
                            </button>
                            <p class="text-[10px] text-center text-slate-400 font-medium italic">Mosque administration will verify your donation shortly.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

