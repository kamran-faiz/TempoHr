<template>
  <div class="min-h-screen bg-[#F5F0E8] font-['Manrope'] text-[#1d1c17] antialiased">
    <header class="fixed top-0 z-50 flex h-16 w-full items-center justify-between border-b border-[#E8E0D5] bg-[#F5F0E8] px-8">
      <div class="flex items-center gap-8">
        <span class="font-['Epilogue'] text-xl font-bold tracking-tight text-[#2D2A26]">Lumina HR</span>
        <nav class="hidden md:flex gap-6">
          <a href="#" class="border-b-2 border-[#F5D142] pb-1 font-['Manrope'] text-sm font-bold text-[#2D2A26]">Directory</a>
          <a href="#" class="font-['Manrope'] text-sm text-[#2D2A26]/60 hover:text-[#2D2A26]">Dashboard</a>
          <a href="#" class="font-['Manrope'] text-sm text-[#2D2A26]/60 hover:text-[#2D2A26]">Payroll</a>
        </nav>
      </div>
      <div class="flex items-center gap-4">
        <button class="rounded-full p-2 hover:bg-white/50 transition-colors">
          <span class="material-symbols-outlined text-xl">notifications</span>
        </button>
        <div class="h-8 w-8 overflow-hidden rounded-full bg-[#dad2c7]">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCUIXQuNNmnSse90fmnoZM01Ln6F6y8rFCquqQrLr0dd6oWgJkRy8YUcUVekH8gMGNqJVxJ3Ec-_As0XahEt_NxGu8m3dk_RkK3LqrcW1WA3ECbtEYKMU6Oeqtxv1TOZaNzratislT5YbNXCVIQEFxBDDrrBVO_OjuUb1ysznrfCm3bupAb3ELlCUxlh9UB1Xg6UjdYlYHVAyLOI6x88a1VBGhhBvyjdybNmYlat-reldbfrMqzgmP0xGf-YhBHY11rYqVt4o1hT3Qj" class="h-full w-full object-cover" />
        </div>
      </div>
    </header>

    <aside class="fixed left-0 top-0 hidden h-full w-72 flex-col border-r border-[#E8E0D5] bg-white p-6 pt-24 md:flex">
      <div class="mb-8 flex items-center gap-4 p-2">
        <div class="h-12 w-12 overflow-hidden rounded-xl bg-[#f5d142]">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDekvRnxYuGi1QuX5VUb9uy7n79u0-ANAaRncpFIsFUcRsxpOxmcscN1z-yX5l7mPATSzQT9KwNCCxIu0BvNIbF9dmYTCPqZgi8FN7tq_Th8B_Mf4ScLk4Zu1j5rYXGfVSGUcY-T8Lx1G-5Xcjjw2RrzFb0_HvwuL2zJcrx-00x3fMaZWO4K4c08upNkCSXcQm3qh5otqz2kvp3Zd1Dt7T_tTbTfvOBXKYxcfeETcGHPaUbX9WMpNYY90zy3vGQlG13PO4s8VWXetGH" class="h-full w-full object-cover" />
        </div>
        <div>
          <p class="font-['Epilogue'] text-sm font-bold text-[#2D2A26]">Sarah Jenkins</p>
          <p class="text-[10px] font-bold uppercase tracking-widest text-[#2D2A26]/50">HR Admin</p>
        </div>
      </div>
      <nav class="flex flex-col gap-2">
        <a href="#" class="flex items-center gap-3 rounded-lg px-4 py-3 text-xs font-bold uppercase tracking-widest text-[#2D2A26]/70 hover:bg-[#F5F0E8] transition-all">
          <span class="material-symbols-outlined">grid_view</span> Dashboard
        </a>
        <a href="#" class="flex items-center gap-3 rounded-lg bg-[#F5D142] px-4 py-3 text-xs font-bold uppercase tracking-widest text-[#2D2A26] shadow-sm transition-transform active:scale-[0.98]">
          <span class="material-symbols-outlined">person_search</span> Directory
        </a>
        </nav>
      <button class="mt-auto rounded-xl bg-[#F5D142] py-4 text-[10px] font-black uppercase tracking-[0.2em] text-[#2D2A26] shadow-md hover:brightness-95 transition-all">
        New Request
      </button>
    </aside>

    <main class="min-h-screen pt-16 md:ml-72">
      <div class="mx-auto max-w-6xl p-8 space-y-8">
        
        <div class="flex items-center gap-2 text-[#2D2A26]/50 cursor-pointer hover:text-[#2D2A26] transition-colors">
          <span class="material-symbols-outlined text-sm">arrow_back</span>
          <span class="text-[11px] font-bold uppercase tracking-widest">Back to Directory</span>
        </div>

        <section class="relative overflow-hidden rounded-[2rem] border border-[#E8E0D5] bg-white p-8">
          <div class="flex flex-col items-center gap-8 md:flex-row md:items-start">
            <div class="h-32 w-32 flex-shrink-0 overflow-hidden rounded-full border-4 border-[#F5F0E8]">
              <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBJrDerRMan-dBNQ6nBydya3jnS1_ax2AEbGI2EuZ-d4b8o6uSx_DkMvRx1Uo8pWAo_zQHxrkMG5LR86lOHh__pnnzEqWRgOhxTWzflZG1zHVsxR9bF-FCeAJWiAAbHmA1PMc2EQ0SVUFRQHK2Z02g6msSCtfdZItWxYP8lVB8sYOKnFmPr6WDeThmg8IC3KqItTyOuu3dMfuZB540kfCh68ZzfpuBQWetcbOq97OAhuEywITmyGtvHU-lfbSn2ZGsJyIQk7-RS0EJn" class="h-full w-full object-cover" />
            </div>
            <div class="flex-grow text-center md:text-left">
              <div class="mb-4 flex flex-col items-center gap-3 md:flex-row md:items-center">
                <h1 class="font-['Epilogue'] text-3xl font-black text-[#2D2A26]">Alexandra Rivera</h1>
                <span class="rounded-full border border-[#C8E6C9] bg-[#E8F5E9] px-3 py-1 text-[10px] font-black uppercase tracking-widest text-[#2E7D32]">Active</span>
              </div>
              <div class="flex flex-wrap justify-center gap-x-6 gap-y-2 text-sm text-[#2D2A26]/60 md:justify-start">
                <div class="flex items-center gap-2"><span class="material-symbols-outlined text-lg">badge</span> Senior Product Designer</div>
                <div class="flex items-center gap-2"><span class="material-symbols-outlined text-lg">corporate_fare</span> Product</div>
                <div class="flex items-center gap-2"><span class="material-symbols-outlined text-lg">fingerprint</span> ID: LMN-082</div>
              </div>
            </div>
            <div class="flex gap-3">
              <button class="rounded-xl border border-[#2D2A26] px-6 py-2.5 text-xs font-bold uppercase tracking-widest text-[#2D2A26] hover:bg-[#F5F0E8] transition-all">Edit</button>
              <button class="rounded-xl bg-[#f2ede5] px-6 py-2.5 text-xs font-bold uppercase tracking-widest text-[#2D2A26] hover:bg-[#e7e2da] transition-all">Deactivate</button>
            </div>
          </div>
          <div class="absolute -right-8 -top-8 h-24 w-24 rounded-bl-full bg-[#f5d142]/10"></div>
        </section>

        <nav class="flex gap-10 border-b border-[#E8E0D5]">
          <button class="relative pb-4 text-xs font-black uppercase tracking-[0.15em] text-[#2D2A26]">
            Personal Info
            <div class="absolute bottom-0 left-0 h-0.5 w-full bg-[#F5D142]"></div>
          </button>
          <button class="pb-4 text-xs font-black uppercase tracking-[0.15em] text-[#2D2A26]/30 hover:text-[#2D2A26] transition-colors">Job Details</button>
          <button class="pb-4 text-xs font-black uppercase tracking-[0.15em] text-[#2D2A26]/30 hover:text-[#2D2A26] transition-colors">Documents</button>
        </nav>

        <div class="grid grid-cols-12 gap-6">
          
          <div class="col-span-12 rounded-[2rem] border border-[#E8E0D5] bg-white p-8 lg:col-span-8">
            <h3 class="mb-8 text-[11px] font-black uppercase tracking-[0.2em] text-[#2D2A26]/40">General Information</h3>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
              <div v-for="label in ['Email Address', 'Phone Number', 'National ID', 'Date of Birth', 'Gender']" :key="label">
                <label class="mb-1 block text-[10px] font-bold uppercase tracking-widest text-[#2D2A26]/40">{{ label }}</label>
                <p class="font-['Epilogue'] font-bold text-[#2D2A26]">Data Point</p>
              </div>
              <div class="md:col-span-2">
                <label class="mb-1 block text-[10px] font-bold uppercase tracking-widest text-[#2D2A26]/40">Residential Address</label>
                <p class="font-['Epilogue'] font-bold text-[#2D2A26]">123 Design Lane, Creative District, New York, NY</p>
              </div>
            </div>
          </div>

          <div class="col-span-12 flex flex-col rounded-[2rem] border border-[#E8E0D5] bg-white p-8 lg:col-span-4">
            <div class="mb-8 flex items-center justify-between">
              <h3 class="text-[11px] font-black uppercase tracking-[0.2em] text-[#2D2A26]/40">Emergency</h3>
              <span class="material-symbols-outlined text-[#ba1a1a]">emergency_home</span>
            </div>
            <div class="rounded-2xl border border-[#E8E0D5]/50 bg-[#f8f3eb] p-6">
              <div class="mb-4 flex items-center gap-4">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#e5ded8] font-['Epilogue'] text-sm font-bold">JR</div>
                <div>
                  <p class="text-sm font-black text-[#2D2A26]">Julian Rivera</p>
                  <p class="text-[10px] font-bold uppercase tracking-widest text-[#2D2A26]/40">Brother</p>
                </div>
              </div>
              <div class="flex items-center gap-3 border-t border-[#E8E0D5] pt-4 text-[#2D2A26]">
                <span class="material-symbols-outlined text-lg">call</span>
                <span class="text-sm font-bold">+1 555-0199</span>
              </div>
            </div>
            <p class="mt-auto pt-6 text-[11px] italic leading-relaxed text-[#2D2A26]/50">
              "Alexandra is allergic to peanuts. In case of medical emergency, contact Julian."
            </p>
          </div>

          <div class="col-span-12 rounded-[2rem] border border-[#E8E0D5] bg-[#FAF8F5] p-8">
            <div class="mb-10 flex items-center justify-between">
              <h3 class="text-[11px] font-black uppercase tracking-[0.2em] text-[#2D2A26]/40">Career Milestones</h3>
              <button class="text-[10px] font-black uppercase tracking-widest underline">View Full History</button>
            </div>
            <div class="flex flex-col gap-8 md:flex-row">
              <div v-for="n in 3" :key="n" class="flex flex-1 gap-4" :class="{'opacity-40': n > 1}">
                <div class="flex flex-col items-center">
                  <div class="h-4 w-4 rounded-full" :class="n === 1 ? 'bg-[#F5D142] ring-4 ring-[#F5D142]/20' : 'bg-[#E8E0D5]'"></div>
                  <div v-if="n < 3" class="h-full w-0.5 bg-[#E8E0D5]"></div>
                </div>
                <div>
                  <p class="mb-1 text-[9px] font-black uppercase tracking-widest text-[#2D2A26]/50">Jan 2024</p>
                  <p class="font-['Epilogue'] text-sm font-bold text-[#2D2A26]">Milestone Title</p>
                  <p class="text-[11px] text-[#2D2A26]/60">Brief description of the achievement.</p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
/* Scoped for subtle scroll behavior */
::-webkit-scrollbar { width: 4px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: #dad2c7; border-radius: 10px; }
</style>