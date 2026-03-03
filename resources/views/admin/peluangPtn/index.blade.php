<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - PERSISTEN</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; letter-spacing: -0.01em; }
        [x-cloak] { display: none !important; }
        .prodi-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
        .prodi-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .admin-layout { display: grid; grid-template-columns: 280px 1fr; height: 100vh; overflow: hidden; }
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#1E293B]" 
      x-data="{ 
        currentPage: 'peluang_ptn', 
        historyTab: 'univ', 
        expandedUniv: null, 
        showModalUniv: false, 
        showModalProdi: false, 
        showConfirm: false, 
        showImportModal: false,
        isEditModeUniv: false,
        prodiMode: 'manual',
        confirmData: { type: '', id: null, title: '', message: '' },
        newUnivName: '', newUnivLocation: '', selectedUnivId: null, selectedUnivName: '',
        newProdiName: '', newProdiKuota: '', newProdiPeminat: '',

        univList: {{ $univs->map(fn($u) => [
            'id' => $u->id, 'name' => $u->nama_univ, 'location' => $u->lokasi,
            'prodis' => $u->prodis->map(fn($p) => ['id' => $p->id, 'nama' => $p->nama_prodi, 'kuota' => $p->kuota, 'peminat' => $p->peminat])
        ])->values()->toJson() }},
        
        historyUnivList: {{ $historyUniv->map(fn($h) => ['id' => $h->id, 'name' => $h->nama_univ, 'time' => $h->updated_at->format('d M Y, H:i')])->toJson() }},
        historyProdiList: {{ $historyProdi->map(fn($p) => ['id' => $p->id, 'name' => $p->nama_prodi, 'univ_name' => $p->universitas->nama_univ ?? 'N/A', 'time' => $p->updated_at->format('d M Y, H:i')])->toJson() }},

        unduhTemplate(type) {
            const wb = XLSX.utils.book_new();
            let header, data, fileName;
            if(type === 'utama') {
                header = [['Nama Universitas', 'Lokasi', 'Nama Prodi', 'Kuota', 'Peminat']];
                data = [['Universitas Gadjah Mada', 'Yogyakarta', 'Kedokteran', '100', '2500']];
                fileName = 'Template_PTN_Lengkap.xlsx';
            } else {
                header = [['Nama Universitas', 'Nama Prodi', 'Kuota', 'Peminat']];
                data = [[this.selectedUnivName, 'Sains Data', '50', '500']];
                fileName = 'Template_Prodi_Massal.xlsx';
            }
            const ws = XLSX.utils.aoa_to_sheet([...header, ...data]);
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
            XLSX.writeFile(wb, fileName);
        },

        async importExcel(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = async (e) => {
                const bstr = e.target.result;
                const workbook = XLSX.read(bstr, { type: 'binary' });
                const jsonData = XLSX.utils.sheet_to_json(workbook.Sheets[workbook.SheetNames[0]]);
                const res = await fetch('{{ route('admin.peluang.import') }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
                    body: JSON.stringify({ data: jsonData })
                });
                if (res.ok) window.location.reload();
            };
            reader.readAsBinaryString(file);
        },

        async saveUniv() {
            let payload = { id: this.isEditModeUniv ? this.selectedUnivId : null, nama_univ: this.newUnivName, lokasi: this.newUnivLocation };
            const res = await fetch('{{ route('admin.peluang.store') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
                body: JSON.stringify(payload)
            });
            if(res.ok) window.location.reload();
        },

        async saveProdi() {
            let payload = { 
                id: this.selectedUnivId, 
                nama_univ: this.selectedUnivName, 
                lokasi: this.newUnivLocation, 
                prodis: [{ nama: this.newProdiName, kuota: this.newProdiKuota, peminat: this.newProdiPeminat }] 
            };
            const res = await fetch('{{ route('admin.peluang.store') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
                body: JSON.stringify(payload)
            });
            if(res.ok) window.location.reload();
        },

        triggerDelete(type, data) {
            this.confirmData = { type: type, id: data.id, title: type === 'univ' ? 'Hapus Universitas?' : 'Hapus Prodi?', message: 'Pindahkan ke riwayat?' };
            this.showConfirm = true;
        },

        async executeDelete() {
            const res = await fetch(`/admin/peluangPtn/${this.confirmData.id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } });
            if(res.ok) window.location.reload();
        },

        async restoreData(id) {
            const res = await fetch(`/admin/peluangPtn/${id}/restore`, { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } });
            if(res.ok) window.location.reload();
        },

        async permanentDelete(id) {
            if(confirm('Hapus permanen?')) {
                const res = await fetch(`/admin/peluangPtn/${id}/force`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } });
                if(res.ok) window.location.reload();
            }
        },

        openAddUniv() { this.isEditModeUniv = false; this.newUnivName = ''; this.newUnivLocation = ''; this.showModalUniv = true; },
        openEditUniv(univ) { this.isEditModeUniv = true; this.selectedUnivId = univ.id; this.newUnivName = univ.name; this.newUnivLocation = univ.location; this.showModalUniv = true; },
        openAddProdi(univ) { this.selectedUnivId = univ.id; this.selectedUnivName = univ.name; this.newUnivLocation = univ.location; this.newProdiName = ''; this.prodiMode = 'manual'; this.showModalProdi = true; }
      }">

    <div class="admin-layout">
        <aside class="bg-[#4A72D4] text-white flex flex-col p-6 shadow-xl h-screen overflow-y-auto">
            <div class="flex items-center gap-3 mb-10 px-2">
                <div class="bg-white p-2 rounded-xl text-[#4A72D4]"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg></div>
                <h1 class="text-2xl font-bold italic uppercase tracking-tighter">PERSISTEN</h1>
            </div>
            <nav class="flex-1 space-y-1">
                <a href="{{ route('admin.dashboard.index') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-white/10 transition-all">Dashboard</a>
                <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7] text-[#2E3B66] font-bold">Peluang PTN</a>
            </nav>
            <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit" class="w-full bg-white/10 p-3 rounded-2xl text-[10px] uppercase font-bold text-white mt-4 tracking-widest">Logout</button></form>
        </aside>

        <main class="flex flex-col h-screen overflow-hidden">
            <header class="flex items-center justify-between px-10 py-6 shrink-0">
                <div class="relative w-1/3"><input type="text" placeholder="Search...." class="w-full bg-white border-none rounded-full py-3 pl-12 shadow-sm text-sm"></div>
                <div class="flex items-center gap-3">
                    <button @click="currentPage = (currentPage === 'peluang_ptn' ? 'history' : 'peluang_ptn')" class="bg-white border text-[#4A72D4] px-6 py-3 rounded-full font-black text-[10px] uppercase tracking-widest shadow-sm">
                        <span x-text="currentPage === 'peluang_ptn' ? 'History' : 'Kembali'"></span>
                    </button>
                    <button x-show="currentPage === 'peluang_ptn'" @click="showImportModal = true" class="bg-emerald-500 text-white px-6 py-3 rounded-full font-black text-[10px] uppercase tracking-widest shadow-lg">Import Excel</button>
                    <button x-show="currentPage === 'peluang_ptn'" @click="openAddUniv()" class="bg-[#4A72D4] text-white px-6 py-3 rounded-full font-black text-[10px] uppercase tracking-widest shadow-lg">Tambah PTN</button>
                </div>
            </header>

            <div x-show="currentPage === 'peluang_ptn'" class="flex-1 overflow-y-auto p-10 pb-20">
                <div class="max-w-6xl mx-auto space-y-4">
                    <template x-for="univ in univList" :key="univ.id">
                        <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
                            <div @click="expandedUniv = (expandedUniv === univ.id ? null : univ.id)" class="p-8 flex items-center justify-between cursor-pointer hover:bg-gray-50/50 transition-all">
                                <div class="flex items-center gap-6">
                                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-[#4A72D4]">
                                        <svg :class="expandedUniv === univ.id ? 'rotate-180' : ''" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="3" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                                    </div>
                                    <div><h3 class="font-black text-gray-800 text-base uppercase" x-text="univ.name"></h3><p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1" x-text="univ.location"></p></div>
                                </div>
                                <div class="flex gap-2">
                                    <button @click.stop="openEditUniv(univ)" class="p-3 text-gray-300 hover:text-blue-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg></button>
                                    <button @click.stop="triggerDelete('univ', univ)" class="p-3 text-red-300 hover:text-red-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                    <button @click.stop="openAddProdi(univ)" class="p-3 bg-[#4A72D4] text-white rounded-2xl shadow-md"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="3" d="M12 4.5v15m7.5-7.5h-15" /></svg></button>
                                </div>
                            </div>
                            <div x-show="expandedUniv === univ.id" x-collapse class="border-t bg-gray-50/30">
                                <div class="overflow-x-auto prodi-scroll">
                                    <table class="w-full text-left">
                                        <thead class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                            <tr><th class="px-10 py-4">Nama Prodi</th><th class="px-10 py-4 text-center">Kuota</th><th class="px-10 py-4 text-center">Peminat</th><th class="px-10 py-4 text-center">Aksi</th></tr>
                                        </thead>
                                        <tbody class="divide-y bg-white">
                                            <template x-for="prodi in univ.prodis">
                                                <tr class="hover:bg-blue-50/40 transition-all">
                                                    <td class="px-10 py-5 font-bold text-xs text-gray-700 uppercase" x-text="prodi.nama"></td>
                                                    <td class="px-10 py-5 text-center font-black text-xs text-blue-600" x-text="prodi.kuota"></td>
                                                    <td class="px-10 py-5 text-center font-black text-xs text-indigo-500" x-text="prodi.peminat"></td>
                                                    <td class="px-10 py-5 text-center"><button @click="triggerDelete('prodi', prodi)" class="text-[10px] font-black text-red-400 uppercase">Hapus</button></td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div x-show="currentPage === 'history'" x-cloak class="flex-1 overflow-y-auto p-10 pb-20">
                <div class="max-w-4xl mx-auto bg-white rounded-[2.5rem] shadow-sm border overflow-hidden">
                    <div class="flex border-b bg-gray-50/50">
                        <button @click="historyTab = 'univ'" :class="historyTab === 'univ' ? 'bg-white border-b-2 border-[#4A72D4] text-[#4A72D4]' : 'text-gray-400'" class="flex-1 py-6 font-black uppercase text-xs">Riwayat Univ</button>
                        <button @click="historyTab = 'prodi'" :class="historyTab === 'prodi' ? 'bg-white border-b-2 border-[#4A72D4] text-[#4A72D4]' : 'text-gray-400'" class="flex-1 py-6 font-black uppercase text-xs">Riwayat Prodi</button>
                    </div>
                    <div x-show="historyTab === 'univ'" class="divide-y">
                        <template x-for="log in historyUnivList" :key="log.id">
                            <div class="p-8 flex items-center justify-between hover:bg-gray-50/50 transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="bg-amber-100 text-amber-600 w-12 h-12 rounded-xl flex items-center justify-center font-black text-xs">U</div>
                                    <div><p class="font-bold text-sm uppercase text-gray-700" x-text="log.name"></p><p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1" x-text="'Dihapus: ' + log.time"></p></div>
                                </div>
                                <div class="flex gap-2">
                                    <button @click="restoreData(log.id)" class="bg-emerald-50 text-emerald-600 px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest">Pulihkan</button>
                                    <button @click="permanentDelete(log.id)" class="bg-red-50 text-red-500 px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest">Hapus</button>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div x-show="historyTab === 'prodi'" class="divide-y">
                        <template x-for="log in historyProdiList" :key="log.id">
                            <div class="p-8 flex items-center justify-between hover:bg-gray-50/50 transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="bg-indigo-100 text-indigo-600 w-12 h-12 rounded-xl flex items-center justify-center font-black text-xs">P</div>
                                    <div><p class="font-bold text-sm uppercase text-gray-700" x-text="log.name"></p><p class="text-[10px] text-[#4A72D4] font-black uppercase tracking-widest" x-text="log.univ_name"></p></div>
                                </div>
                                <div class="flex gap-2">
                                    <button @click="restoreData(log.id)" class="bg-emerald-50 text-emerald-600 px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest">Pulihkan</button>
                                    <button @click="permanentDelete(log.id)" class="bg-red-50 text-red-500 px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest">Hapus</button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div x-show="showImportModal" x-transition x-cloak class="fixed inset-0 z-[200] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div class="bg-white rounded-[2rem] w-full max-w-sm overflow-hidden shadow-2xl">
            <div class="bg-emerald-500 p-6 text-white text-center"><h4 class="text-lg font-black italic uppercase">Import PTN & Prodi</h4></div>
            <div class="p-8 space-y-4">
                <button @click="unduhTemplate('utama')" class="w-full bg-gray-50 border-2 border-dashed border-gray-200 p-4 rounded-xl flex flex-col items-center gap-2">
                    <span class="text-[9px] font-black uppercase text-gray-500">Unduh Template Lengkap</span>
                </button>
                <div class="relative">
                    <input type="file" @change="importExcel($event)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div class="w-full bg-[#4A72D4] text-white py-3 rounded-xl font-black text-center uppercase text-[9px] tracking-widest">Pilih File Excel</div>
                </div>
                <button @click="showImportModal = false" class="w-full font-black text-gray-400 uppercase text-[9px] tracking-widest mt-2">Batal</button>
            </div>
        </div>
    </div>

    <div x-show="showModalProdi" x-transition x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div class="bg-white rounded-[2rem] w-full max-w-sm overflow-hidden shadow-2xl">
            <div class="bg-[#4A72D4] p-6 text-white text-center">
                <h4 class="text-lg font-black italic uppercase">Tambah Prodi</h4>
                <p class="text-[9px] opacity-70 font-bold uppercase tracking-widest mt-1" x-text="selectedUnivName"></p>
            </div>
            <div class="flex border-b">
                <button @click="prodiMode = 'manual'" :class="prodiMode === 'manual' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-400'" class="flex-1 py-3 font-black text-[9px] uppercase">Manual</button>
                <button @click="prodiMode = 'excel'" :class="prodiMode === 'excel' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-400'" class="flex-1 py-3 font-black text-[9px] uppercase">Excel</button>
            </div>
            <div class="p-6">
                <div x-show="prodiMode === 'manual'" class="space-y-3">
                    <input x-model="newProdiName" type="text" placeholder="Nama Prodi" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 font-bold text-sm">
                    <div class="grid grid-cols-2 gap-3">
                        <input x-model="newProdiKuota" type="number" placeholder="Kuota" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 font-black text-center text-blue-600">
                        <input x-model="newProdiPeminat" type="number" placeholder="Peminat" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 font-black text-center text-indigo-500">
                    </div>
                    <button @click="saveProdi()" class="w-full bg-[#4A72D4] text-white py-3 rounded-xl font-black uppercase text-[9px] tracking-widest shadow-lg mt-2">Simpan Prodi</button>
                </div>
                <div x-show="prodiMode === 'excel'" class="space-y-4 text-center">
                    <button @click="unduhTemplate('prodi')" class="w-full bg-emerald-50 border border-dashed border-emerald-200 py-3 rounded-xl text-emerald-600 font-bold text-[9px] uppercase">Unduh Template Prodi</button>
                    <div class="relative">
                        <input type="file" @change="importExcel($event)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="w-full bg-emerald-500 text-white py-3 rounded-xl font-black text-center uppercase text-[9px] tracking-widest">Upload Excel Prodi</div>
                    </div>
                </div>
                <button @click="showModalProdi = false" class="w-full font-black text-gray-400 uppercase text-[9px] tracking-widest mt-4">Batal</button>
            </div>
        </div>
    </div>

    <div x-show="showModalUniv" x-transition x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div class="bg-white rounded-[2rem] w-full max-w-sm overflow-hidden shadow-2xl">
            <div class="bg-[#4A72D4] p-6 text-white text-center"><h4 class="text-lg font-black italic uppercase" x-text="isEditModeUniv ? 'Edit PTN' : 'Tambah PTN'"></h4></div>
            <div class="p-6 space-y-3">
                <input x-model="newUnivName" type="text" placeholder="Nama Universitas" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 font-bold text-sm">
                <input x-model="newUnivLocation" type="text" placeholder="Lokasi" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 font-bold text-sm">
                <button @click="saveUniv()" class="w-full bg-[#4A72D4] py-3 rounded-xl font-black text-white uppercase text-[9px] tracking-widest shadow-lg mt-2">Simpan</button>
                <button @click="showModalUniv = false" class="w-full font-black text-gray-400 uppercase text-[9px] tracking-widest">Batal</button>
            </div>
        </div>
    </div>

    <div x-show="showConfirm" x-transition x-cloak class="fixed inset-0 z-[250] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div class="bg-white rounded-[2rem] w-full max-w-xs p-6 text-center shadow-2xl">
            <h4 class="text-lg font-black text-gray-800 uppercase" x-text="confirmData.title"></h4>
            <p class="text-[10px] text-gray-500 mt-2 font-bold" x-text="confirmData.message"></p>
            <div class="flex gap-3 mt-6">
                <button @click="showConfirm = false" class="flex-1 py-3 font-black text-gray-400 uppercase text-[9px]">Batal</button>
                <button @click="executeDelete()" class="flex-[2] bg-red-500 text-white py-3 rounded-xl font-black uppercase text-[9px] shadow-lg">Pindahkan</button>
            </div>
        </div>
    </div>
</body>
</html>