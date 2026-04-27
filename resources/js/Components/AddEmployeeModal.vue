<template>
  <div class="fixed inset-0 z-[60] flex items-center justify-center bg-[#2D2A26]/40 backdrop-blur-sm p-4 antialiased">
    
    <div class="bg-[#F5F0E8] w-full max-w-6xl max-h-[95vh] overflow-y-auto rounded-[2.5rem] shadow-2xl border border-[#E8E0D5] flex flex-col">
      
      <header class="sticky top-0 z-10 bg-white/90 backdrop-blur-md border-b border-[#E8E0D5] px-10 py-6 flex justify-between items-center">
        <div>
          <h2 class="font-['Epilogue'] text-2xl font-black text-[#2D2A26] tracking-tight">Create Employee Profile</h2>
          <p class="font-['Manrope'] text-sm text-[#2D2A26]/50">Process step: <span class="text-[#705d00] font-bold uppercase tracking-widest text-[10px]">Financials & Documentation</span></p>
        </div>
        <button class="w-12 h-12 rounded-full hover:bg-[#F5F0E8] flex items-center justify-center transition-all active:scale-90">
          <span class="material-symbols-outlined text-[#2D2A26]">close</span>
        </button>
      </header>

      <main class="p-10 space-y-12">
        
        <nav class="grid grid-cols-4 gap-6">
          <div class="space-y-3">
            <div class="h-1.5 w-full bg-[#F5D142] rounded-full"></div>
            <div class="flex items-center gap-2">
              <span class="material-symbols-outlined text-[#705d00] text-sm" style="font-variation-settings: 'FILL' 1;">check_circle</span>
              <span class="font-['Manrope'] text-[10px] font-bold uppercase tracking-widest text-[#2D2A26]">1: Identity</span>
            </div>
          </div>
          <div class="space-y-3">
            <div class="h-1.5 w-full bg-[#F5D142] rounded-full"></div>
            <div class="flex items-center gap-2">
              <span class="material-symbols-outlined text-[#705d00] text-sm" style="font-variation-settings: 'FILL' 1;">check_circle</span>
              <span class="font-['Manrope'] text-[10px] font-bold uppercase tracking-widest text-[#2D2A26]">2: Role</span>
            </div>
          </div>
          <div class="space-y-3">
            <div class="h-1.5 w-full bg-[#F5D142] rounded-full shadow-[0_0_15px_rgba(245,209,66,0.4)]"></div>
            <div class="flex items-center gap-2">
              <span class="w-5 h-5 bg-[#2D2A26] text-[#F5D142] rounded-full flex items-center justify-center text-[10px] font-bold">3</span>
              <span class="font-['Manrope'] text-[10px] font-bold uppercase tracking-widest text-[#2D2A26]">3: Salary</span>
            </div>
          </div>
          <div class="space-y-3 opacity-30">
            <div class="h-1.5 w-full bg-[#E8E0D5] rounded-full"></div>
            <div class="flex items-center gap-2">
              <span class="w-5 h-5 bg-white border border-[#E8E0D5] rounded-full flex items-center justify-center text-[10px] font-bold">4</span>
              <span class="font-['Manrope'] text-[10px] font-bold uppercase tracking-widest text-[#2D2A26]">4: Documents</span>
            </div>
          </div>
        </nav>

        <div class="grid grid-cols-12 gap-8">
          <div class="col-span-12 lg:col-span-8 bg-white border border-[#E8E0D5] rounded-[2rem] p-8">
            <div class="flex items-center gap-4 mb-10">
              <div class="w-12 h-12 bg-[#F5D142]/20 rounded-2xl flex items-center justify-center text-[#705d00]">
                <span class="material-symbols-outlined">account_balance_wallet</span>
              </div>
              <h4 class="font-['Epilogue'] text-xl font-bold text-[#2D2A26]">Compensation Structure</h4>
            </div>
            
            <div class="grid grid-cols-2 gap-8">
              <div class="col-span-2 space-y-3">
                <label class="font-['Manrope'] text-[11px] font-bold uppercase tracking-widest text-[#2D2A26]/50">Monthly Basic Salary</label>
                <div class="relative group">
                  <span class="absolute left-5 top-1/2 -translate-y-1/2 font-bold text-[#2D2A26]/30 transition-colors group-focus-within:text-[#705d00]">$</span>
                  <input type="number" class="w-full pl-12 pr-6 py-5 bg-[#F5F0E8]/40 border-2 border-transparent rounded-2xl outline-none focus:border-[#F5D142] focus:bg-white transition-all font-['Epilogue'] text-lg" placeholder="0.00">
                </div>
              </div>
              <div class="space-y-3">
                <label class="font-['Manrope'] text-[11px] font-bold uppercase tracking-widest text-[#2D2A26]/50">House Allowance</label>
                <input type="text" class="w-full px-6 py-4 bg-[#F5F0E8]/40 border-2 border-transparent rounded-2xl outline-none focus:border-[#F5D142] focus:bg-white transition-all" placeholder="Amount">
              </div>
              <div class="space-y-3">
                <label class="font-['Manrope'] text-[11px] font-bold uppercase tracking-widest text-[#2D2A26]/50">Tax Percentage</label>
                <input type="text" class="w-full px-6 py-4 bg-[#F5F0E8]/40 border-2 border-transparent rounded-2xl outline-none focus:border-[#F5D142] focus:bg-white transition-all" placeholder="e.g. 15%">
              </div>
            </div>
          </div>

          <div class="col-span-12 lg:col-span-4 flex flex-col gap-6">
            <div class="bg-[#2D2A26] text-white rounded-[2rem] p-8 flex-grow shadow-xl shadow-[#2D2A26]/10">
              <span class="font-['Manrope'] text-[10px] font-bold uppercase tracking-widest opacity-50">Estimated Take-Home</span>
              <div class="text-5xl font-['Epilogue'] font-black mt-6 mb-10 tracking-tighter text-[#F5D142]">$0.00</div>
              <div class="space-y-4 border-t border-white/10 pt-8">
                <div class="flex justify-between text-sm">
                  <span class="opacity-60 font-['Manrope']">Gross Salary</span>
                  <span class="font-bold font-['Epilogue']">$0.00</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="opacity-60 font-['Manrope']">Deductions</span>
                  <span class="text-red-400 font-bold font-['Epilogue']">-$0.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="bg-white border border-[#E8E0D5] rounded-3xl p-6 text-center hover:border-[#F5D142] transition-all cursor-pointer group">
            <div class="w-full aspect-[1.6/1] border-2 border-dashed border-[#E8E0D5] bg-[#F5F0E8] rounded-[1.5rem] flex flex-col items-center justify-center gap-3 mb-5 group-hover:bg-white transition-colors">
              <span class="material-symbols-outlined text-4xl text-[#2D2A26]/20 group-hover:text-[#F5D142] group-hover:scale-110 transition-all">add_a_photo</span>
              <p class="font-['Manrope'] text-[10px] font-bold uppercase tracking-widest text-[#2D2A26]/40">Profile Photo</p>
            </div>
            <h5 class="font-['Epilogue'] font-bold text-[#2D2A26]">Headshot</h5>
            <p class="text-[11px] text-[#2D2A26]/50 mt-1">PNG, JPG up to 5MB</p>
          </div>
          
          <div class="bg-white border border-[#E8E0D5] rounded-3xl p-6 text-center">
            <div class="w-full aspect-[1.6/1] border-2 border-dashed border-[#E8E0D5] bg-[#F5F0E8] rounded-[1.5rem] flex flex-col items-center justify-center gap-3 mb-5">
              <span class="material-symbols-outlined text-4xl text-[#2D2A26]/20">badge</span>
              <p class="font-['Manrope'] text-[10px] font-bold uppercase tracking-widest text-[#2D2A26]/40">CNIC Front</p>
            </div>
            <button class="px-6 py-2.5 border-2 border-[#2D2A26] rounded-full font-['Manrope'] text-[10px] font-black uppercase tracking-widest hover:bg-[#2D2A26] hover:text-white transition-all">Upload File</button>
          </div>

          <div class="bg-white border border-[#E8E0D5] rounded-3xl p-6 text-center">
            <div class="w-full aspect-[1.6/1] border-2 border-dashed border-[#E8E0D5] bg-[#F5F0E8] rounded-[1.5rem] flex flex-col items-center justify-center gap-3 mb-5">
              <span class="material-symbols-outlined text-4xl text-[#2D2A26]/20">security</span>
              <p class="font-['Manrope'] text-[10px] font-bold uppercase tracking-widest text-[#2D2A26]/40">CNIC Back</p>
            </div>
            <button class="px-6 py-2.5 border-2 border-[#2D2A26] rounded-full font-['Manrope'] text-[10px] font-black uppercase tracking-widest hover:bg-[#2D2A26] hover:text-white transition-all">Upload File</button>
          </div>
        </div>

        <footer class="flex justify-between items-center pt-10 border-t border-[#E8E0D5]">
          <button class="flex items-center gap-3 px-8 py-4 border-2 border-[#2D2A26] text-[#2D2A26] rounded-2xl font-['Manrope'] font-black text-[11px] uppercase tracking-widest hover:bg-[#2D2A26] hover:text-white transition-all active:scale-95">
            <span class="material-symbols-outlined text-lg">arrow_back</span>
            Prev Step
          </button>
          
          <div class="flex gap-4">
            <button class="px-8 py-4 bg-white border border-[#E8E0D5] text-[#2D2A26] rounded-2xl font-['Manrope'] font-black text-[11px] uppercase tracking-widest hover:bg-[#F5F0E8] transition-all">
              Save as Draft
            </button>
            <button class="flex items-center gap-3 px-12 py-4 bg-[#F5D142] text-[#2D2A26] rounded-2xl font-['Manrope'] font-black text-[11px] uppercase tracking-widest shadow-xl shadow-[#F5D142]/20 hover:scale-[1.03] active:scale-95 transition-all">
              Next Step
              <span class="material-symbols-outlined text-lg">arrow_forward</span>
            </button>
          </div>
        </footer>
      </main>
    </div>
  </div>
</template>

<style scoped>
/* You can add custom scrollbar styling here if needed */
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: #F5F0E8; }
::-webkit-scrollbar-thumb { background: #E8E0D5; border-radius: 10px; }
</style>