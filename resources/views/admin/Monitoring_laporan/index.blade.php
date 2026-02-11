<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Rinci - Persisten</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; overflow: hidden; }
        [x-cloak] { display: none !important; }
        .log-scroll::-webkit-scrollbar { width: 4px; }
        .log-scroll::-webkit-scrollbar-track { background: transparent; }
        .log-scroll::-webkit-scrollbar-thumb { background: #E2E8F0; border-radius: 10px; }
        .admin-layout { display: grid; grid-template-columns: 260px 1fr; height: 100vh; }
    </style>
</head>
<body class="bg-[#F8FAFC]" 
      x-data="{ 
        currentPage: 'monitoring',
        currentAdmin: 'Admin Utama',
        openYear: 2026,
        openMonth: null,
        showDraftDetail: false,
        selectedDraftTitle: '',

        /* DATA AKTIVITAS RINCI */
        allLogs: [
            { 
                admin: 'Admin Utama', 
                aksi: 'Update Kuota', 
                objek: 'Kedokteran - UI', 
                detail: 'Mengubah kuota dari 50 menjadi 75',
                waktu: '11 Feb 2026', 
                jam: '14:20:45' 
            },
            { 
                admin: 'Admin 2', 
                aksi: 'Hapus Prodi', 
                objek: 'Sastra Mesin - ITB', 
                detail: 'Menghapus prodi karena tidak aktif',
                waktu: '11 Feb 2026', 
                jam: '13:05:12' 
            },
            { 
                admin: 'Admin Utama', 
                aksi: 'Edit Lokasi', 
                objek: 'UNAIR', 
                detail: 'Mengubah lokasi: Surabaya Kampus A -> Kampus C',
                waktu: '10 Feb 2026', 
                jam: '09:45:03' 
            },
            { 
                admin: 'Admin 3', 
                aksi: 'Tambah Univ', 
                objek: 'UGM Yogyakarta', 
                detail: 'Mendaftarkan universitas baru ke sistem',
                waktu: '10 Feb 2026', 
                jam: '08:30:59' 
            }
        ],

        archiveData: [
            {
                tahun: 2026,
                bulan: [{ nama: 'Februari', minggu: ['Minggu 1', 'Minggu 2'] }]
            }
        ],

        openDraft(year, month, week) {
            this.selectedDraftTitle = `Laporan ${week} - ${month} ${year}`;
            this.showDraftDetail = true;
        }
      }">

    <div class="admin-layout">
        <aside class="bg-[#0F172A] text-white p-6 flex flex-col border-r border-white/5">
            <h1 class="text-xl font-black uppercase tracking-tighter mb-10 text-blue-400 italic">Persisten</h1>
            <nav class="space-y-1">
                <button @click="currentPage = 'database'" class="w-full text-left px-5 py-3 rounded-xl font-bold text-gray-500 hover:text-white transition-all text-[10px] uppercase tracking-[0.2em]">Database PTN</button>
                <button @click="currentPage = 'monitoring'" class="w-full text-left px-5 py-3 rounded-xl font-bold bg-blue-600 shadow-lg text-[10px] uppercase tracking-[0.2em]">Monitoring</button>
            </nav>
        </aside>

        <main class="flex flex-col h-screen overflow-hidden">
            <header class="bg-white border-b h-20 px-10 flex items-center justify-between shrink-0">
                <h2 class="text-lg font-black text-slate-800 uppercase tracking-tighter">Log Aktivitas Rinci</h2>
                <div class="flex items-center gap-3 bg-slate-50 px-4 py-2 rounded-full border border-slate-100">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest" x-text="currentAdmin"></p>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8 space-y-10 bg-[#F8FAFC]">
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm flex flex-col h-[450px]">
                        <div class="p-6 border-b flex justify-between items-center bg-slate-50/50">
                            <h3 class="text-[10px] font-black uppercase text-slate-500 tracking-widest">Aktivitas Saya (Real-time)</h3>
                        </div>
                        <div class="flex-1 overflow-y-auto log-scroll p-4 space-y-4">
                            <template x-for="log in allLogs.filter(l => l.admin === currentAdmin)">
                                <div class="p-5 bg-white border border-slate-100 rounded-3xl shadow-sm hover:border-blue-300 transition-all">
                                    <div class="flex justify-between items-start mb-2">
                                        <span class="text-[10px] font-black px-2 py-1 bg-blue-600 text-white rounded-lg uppercase" x-text="log.aksi"></span>
                                        <span class="text-[10px] font-mono font-bold text-slate-400" x-text="log.jam"></span>
                                    </div>
                                    <p class="text-xs font-black text-slate-800 mb-1" x-text="log.objek"></p>
                                    <p class="text-[11px] text-slate-500 leading-relaxed italic" x-text="'» ' + log.detail"></p>
                                    <p class="text-[9px] text-slate-300 font-bold mt-2" x-text="log.waktu"></p>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm flex flex-col h-[450px]">
                        <div class="p-6 border-b flex justify-between items-center bg-slate-50/50">
                            <h3 class="text-[10px] font-black uppercase text-slate-500 tracking-widest">Aktivitas Seluruh Admin</h3>
                        </div>
                        <div class="flex-1 overflow-y-auto log-scroll p-4 space-y-3">
                            <template x-for="log in allLogs">
                                <div class="p-4 bg-slate-50 rounded-[1.5rem] border border-transparent hover:border-slate-200 transition-all">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-[10px] font-black text-slate-400" x-text="log.admin[0]"></div>
                                            <div>
                                                <p class="text-[11px] font-black text-slate-700" x-text="log.admin"></p>
                                                <p class="text-[10px] text-blue-500 font-bold" x-text="log.aksi + ': ' + log.objek"></p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-[9px] font-mono font-bold text-slate-400" x-text="log.jam"></p>
                                            <p class="text-[8px] text-slate-300 uppercase font-black" x-text="log.waktu"></p>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="space-y-6 pb-20">
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-amber-400 rounded-full"></div>
                        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400">Arsip Folder Draf</h3>
                    </div>

                    <template x-for="item in archiveData">
                        <div class="bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden shadow-sm">
                            <button @click="openYear = (openYear === item.tahun ? null : item.tahun)" class="w-full flex items-center justify-between p-6 hover:bg-slate-50 transition-all">
                                <span class="text-xl font-black text-slate-800" x-text="item.tahun"></span>
                                <svg class="w-5 h-5" :class="openYear === item.tahun ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <div x-show="openYear === item.tahun" x-collapse class="p-6 grid grid-cols-1 md:grid-cols-4 gap-4 bg-slate-50/30">
                                <template x-for="bln in item.bulan">
                                    <div class="bg-white p-2 rounded-3xl border border-slate-100">
                                        <button @click="openMonth = (openMonth === bln.nama ? null : bln.nama)" class="w-full p-4 flex items-center gap-3 hover:bg-amber-50 rounded-2xl transition-all">
                                            <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path></svg>
                                            <span class="text-[11px] font-black text-slate-700 uppercase" x-text="bln.nama"></span>
                                        </button>
                                        <div x-show="openMonth === bln.nama" x-collapse class="space-y-1 p-2">
                                            <template x-for="mgg in bln.minggu">
                                                <button @click="openDraft(item.tahun, bln.nama, mgg)" class="w-full text-left p-3 pl-6 text-[10px] font-bold text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all">
                                                    <span x-text="mgg"></span>
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </main>
    </div>

    <div x-show="showDraftDetail" x-transition x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-900/80 backdrop-blur-md">
        <div @click.away="showDraftDetail = false" class="bg-white rounded-[3rem] w-full max-w-2xl overflow-hidden shadow-2xl">
            <div class="bg-slate-900 p-10 text-white flex justify-between items-center">
                <div>
                    <h4 class="text-2xl font-black uppercase italic tracking-tighter" x-text="selectedDraftTitle"></h4>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mt-2">Data Aktivitas Terverifikasi</p>
                </div>
                <button @click="showDraftDetail = false" class="text-slate-500 hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-10">
                <div class="max-h-[350px] overflow-y-auto log-scroll space-y-6 pr-4">
                    <template x-for="i in [1,2,3,4]">
                        <div class="flex gap-6 pb-6 border-b border-slate-100 last:border-0">
                            <span class="text-[10px] font-mono font-black text-slate-300 mt-1" x-text="'08:15:22' + i"></span>
                            <div>
                                <p class="text-xs font-black text-slate-800 uppercase">Perubahan Data Masif oleh Admin</p>
                                <p class="text-[11px] text-slate-500 mt-1 italic">» Update database prodi kedokteran di seluruh universitas wilayah barat.</p>
                                <div class="mt-2 flex gap-2">
                                    <span class="text-[8px] font-black px-2 py-0.5 bg-green-50 text-green-600 rounded uppercase">Success</span>
                                    <span class="text-[8px] font-black px-2 py-0.5 bg-slate-50 text-slate-400 rounded uppercase">ID: 99231</span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <div class="mt-10 flex gap-4">
                    <button class="flex-1 bg-blue-600 text-white py-5 rounded-[1.5rem] font-black text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-blue-200 hover:translate-y-[-2px] transition-all">Cetak Laporan</button>
                    <button @click="showDraftDetail = false" class="flex-1 bg-slate-50 text-slate-400 py-5 rounded-[1.5rem] font-black text-[10px] uppercase tracking-[0.2em]">Kembali</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>