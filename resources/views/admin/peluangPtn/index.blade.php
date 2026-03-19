<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - PERSISTEN</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; letter-spacing: -0.01em; }
        [x-cloak] { display: none !important; }
        
        /* Scrollbar untuk daftar prodi */
        .prodi-scroll-container::-webkit-scrollbar { width: 5px; height: 5px; }
        .prodi-scroll-container::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        
        .admin-layout { display: flex; height: 100vh; overflow: hidden; width: 100%; }
        .main-content-scroll::-webkit-scrollbar { width: 5px; height: 5px; }
        .main-content-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#1E293B]" 
      x-data="{ 
        currentPage: 'peluang_ptn', 
        mobileMenuOpen: false,
        historyTab: 'univ', 
        expandedUniv: null, 
        showModalUniv: false, 
        showModalProdi: false, 
        showConfirm: false, 
        showImportModal: false,
        isEditModeUniv: false,
        showValidationErrors: false,
        showProdiError: false,
        prodiMode: 'manual',
        showRestoreModal: false, 
        showForceDeleteModal: false,
        actionId: null,
        actionName: '',
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

        prepareRestore(id, name) {
            this.actionId = id;
            this.actionName = name;
            this.showRestoreModal = true;
        },

        prepareForceDelete(id, name) {
            this.actionId = id;
            this.actionName = name;
            this.showForceDeleteModal = true;
        },

        confirmRestore() {
            fetch(`/admin/peluangPtn/${this.actionId}/restore`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                if(response.ok) window.location.reload();
            });
        },

        confirmPermanentDelete() {
            fetch(`/admin/peluangPtn/${this.actionId}/force`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                if(response.ok) window.location.reload();
            });
        },

        openAddUniv() { this.isEditModeUniv = false; this.newUnivName = ''; this.newUnivLocation = ''; this.showModalUniv = true; },
        openEditUniv(univ) { this.isEditModeUniv = true; this.selectedUnivId = univ.id; this.newUnivName = univ.name; this.newUnivLocation = univ.location; this.showModalUniv = true; },
        openAddProdi(univ) { this.selectedUnivId = univ.id; this.selectedUnivName = univ.name; this.newUnivLocation = univ.location; this.newProdiName = ''; this.prodiMode = 'manual'; this.showModalProdi = true; }
      }">

    <div class="admin-layout">
        <aside x-data="{ currentPage: 'peluang' }" :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-50 w-72 bg-[#4A72D4] text-white flex flex-col p-6 shadow-xl transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shrink-0 h-full">

    <div class="flex items-center justify-between mb-10 px-2">
        <div class="flex items-center gap-3">
            <div class="bg-white p-2 rounded-xl">
                <svg class="w-6 h-6 text-[#4A72D4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold tracking-tight">P E R S I S T E N</h1>
        </div>
        <button @click="mobileMenuOpen = false" class="lg:hidden p-2 hover:bg-white/10 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto pr-2 
                [&::-webkit-scrollbar]:w-1 
                [&::-webkit-scrollbar-track]:bg-transparent 
                [&::-webkit-scrollbar-thumb]:bg-white/20 
                [&::-webkit-scrollbar-thumb]:rounded-full">
        
        <a href="{{ route('admin.dashboard.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
            <span class="text-md font-regular">Dashboard</span>
        </a>

        <a href="{{ route('admin.user.index') }}"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl  transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen user</span>
        </a>

        <a href="{{ route('admin.streak.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
            </svg>
            <span class="text-md font-regular">Manajemen streak</span>
        </a>

         <a href="{{ route('admin.tryout.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            <span class="text-md font-regular">Manajemen tryout</span>
        </a>

         <a href="{{ route('admin.kuis.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
            </svg>
            <span class="text-md font-regular">Manajemen kuis</span>
        </a>

         <a href="{{ route('admin.latihan.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
            </svg>
            <span class="text-md font-regular">Manajemen latihan
soal</span>
        </a>

         <a href="{{ route('admin.videoPembelajaran.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-9">
            <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
            <span class="text-md font-regular">Manajemen video
pembelajaran</span>
        </a>

         <a href="{{ route('admin.minatBakat.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
            </svg>
            <span class="text-md font-regular">Manajemen minat 
bakat</span>
        </a>

        

         <a href="{{ route('admin.peluang.index') }}" x-init="if(currentPage === 'peluang') { $el.scrollIntoView({ block: 'center' }) }"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left bg-[#D4DEF7]  text-[#2E3B66]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
            </svg>
            <span class="text-md font-regular">Manajemen peluang
PTN</span>
        </a>

         <a href="{{ route('admin.laporan.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
            </svg>
            <span class="text-md font-regular">Monitoring dan
laporan</span>
        </a>

        
        </nav>

    <form action="{{ route('logout') }}" method="POST" class="w-full inline">
    @csrf
    <button type="submit" class="mt-4 w-full flex items-center bg-white/10 hover:bg-white/20 px-6 py-3 rounded-2xl transition-all group border border-white/20 backdrop-blur-sm shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 md:size-6 text-white">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
        </svg>
        <span class="text-white text-md font-medium tracking-wide ml-4">Logout</span>
    </button>
    </form>
</aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            <header class="flex flex-col md:flex-row items-center justify-between p-4 lg:px-8 lg:pt-8 lg:pb-4 gap-4 flex-shrink-0">
                <div class="flex items-center w-full gap-4">
                    <button @click="mobileMenuOpen = true" class="lg:hidden p-3 bg-white rounded-xl shadow-sm">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                  <div 
                    x-data="{
                        keyword: '',
                        routes: {
                            'dashboard': '{{ route('admin.dashboard.index') }}',
                            'user': '{{ route('admin.user.index') }}',
                            'streak': '{{ route('admin.streak.index') }}',
                            'monitoring': '{{ route('admin.laporan.index') }}',
                            'video': '{{ route('admin.videoPembelajaran.index') }}',
                            'peluang': '{{ route('admin.peluang.index') }}',
                            'tryout': '{{ route('admin.tryout.index') }}',
                            'minat bakat': '{{ route('admin.minatBakat.index') }}',
                            'kuis': '{{ route('admin.kuis.index') }}',
                            'latihan': '{{ route('admin.latihan.index') }}'
                        },
                        goToPage(){
                            let search = this.keyword.toLowerCase()

                            for (let key in this.routes) {
                                if (key.includes(search)) {
                                    window.location.href = this.routes[key]
                                    return
                                }
                            }

                            alert('Halaman tidak ditemukan')
                        }
                    }"
                    class="relative w-full group flex items-center gap-2"
                    >

                        <div class="relative w-full">
                            
                            <!-- ICON -->
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                    class="w-5 h-5 text-gray-500" 
                                    fill="none"
                                    viewBox="0 0 24 24" 
                                    stroke="currentColor" 
                                    stroke-width="2">
                                    <path stroke-linecap="round" 
                                        stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </div>

                            <input 
                                type="text"
                                x-model="keyword"
                                placeholder="Cari halaman..."
                                @keydown.enter="goToPage()"
                                class="w-full bg-white border-none rounded-full py-3 pl-12 pr-4 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all">
                        </div>

                        <button 
                            @click="goToPage()"
                            class="bg-[#4A72D4] hover:bg-blue-600 text-white px-6 py-3 rounded-full text-sm font-medium shadow-sm transition-all active:scale-95 shrink-0">
                            Cari
                        </button>

                    </div>
                </div>

                @php
                use Illuminate\Support\Facades\Auth;
                $user = Auth::user();
            @endphp
                    <div x-data="{ open: false }" class="relative flex w-full md:w-auto md:inline-block">
    
                    <div @click="open = !open" 
                        class="flex items-center gap-3 bg-white p-1 pr-4 pl-1 rounded-full shadow-sm shrink-0 
                                ml-auto md:ml-0 cursor-pointer">
                        
                        <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden border-2 border-white">
                            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=Admin&background=random' }}" alt="Admin">
                        </div>
                        
                        <span class="font-bold text-sm hidden sm:block text-gray-700">Admin</span>
                        
                        <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                    </div>

                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 z-50"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <div class="p-4">
                            <p class="font-semibold text-gray-700">{{ $user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            <p class="text-sm text-gray-500">{{ $user->no_hp ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="px-6 lg:px-14 py-2 shrink-0 overflow-x-auto no-scrollbar">
                <div class="flex items-center justify-between lg:justify-end gap-3 min-w-max pr-4">
                    <button @click="currentPage = (currentPage === 'peluang_ptn' ? 'history' : 'peluang_ptn')" class="bg-white border text-[#4A72D4] px-5 py-2.5 rounded-full font-black text-[10px] uppercase tracking-widest shadow-sm whitespace-nowrap">
                        <span x-text="currentPage === 'peluang_ptn' ? 'Riwayat / History' : 'Kembali ke Daftar'"></span>
                    </button>
                    <div x-show="currentPage === 'peluang_ptn'" class="flex gap-2">
                        <button @click="showImportModal = true" class="bg-emerald-500 text-white px-5 py-2.5 rounded-full font-black text-[10px] uppercase tracking-widest shadow-lg whitespace-nowrap">Import Excel</button>
                        <button @click="openAddUniv()" class="bg-[#4A72D4] text-white px-5 py-2.5 rounded-full font-black text-[10px] uppercase tracking-widest shadow-lg whitespace-nowrap">Tambah PTN Baru</button>
                    </div>
                </div>
            </div>

            <div x-show="currentPage === 'peluang_ptn'" class="flex-1 overflow-y-auto main-content-scroll p-4 lg:p-10 pb-20">
                <div class="max-w-none mx-auto space-y-4">
                    <template x-for="univ in univList" :key="univ.id">
                        <div class="bg-white rounded-[1.5rem] lg:rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden flex flex-col">
                            <div @click="expandedUniv = (expandedUniv === univ.id ? null : univ.id)" class="p-4 lg:p-8 flex items-center justify-between cursor-pointer hover:bg-gray-50/50 transition-all shrink-0">
                                <div class="flex items-center gap-3 lg:gap-6">
                                    <div class="w-10 h-10 lg:w-14 lg:h-14 bg-blue-50 rounded-xl lg:rounded-2xl flex items-center justify-center text-[#4A72D4]">
                                        <svg :class="expandedUniv === univ.id ? 'rotate-180' : ''" class="w-5 h-5 lg:w-6 lg:h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="3" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                                    </div>
                                    <div>
                                        <h3 class="font-black text-gray-800 text-xs lg:text-base uppercase" x-text="univ.name"></h3>
                                        <p class="text-[8px] lg:text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5 lg:mt-1" x-text="univ.location"></p>
                                    </div>
                                </div>
                                <div class="flex gap-1 lg:gap-2">
                                    <button @click.stop="openEditUniv(univ)" class="p-2 lg:p-3 text-gray-300 hover:text-blue-500"><svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg></button>
                                    <button @click.stop="triggerDelete('univ', univ)" class="p-2 lg:p-3 text-red-300 hover:text-red-500"><svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                    <button @click.stop="openAddProdi(univ)" class="p-2 lg:p-3 bg-[#4A72D4] text-white rounded-xl lg:rounded-2xl shadow-md"><svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="3" d="M12 4.5v15m7.5-7.5h-15" /></svg></button>
                                </div>
                            </div>
                            
                            <div x-show="expandedUniv === univ.id" x-collapse class="border-t bg-gray-50/30">
                                <div class="max-h-[300px] overflow-y-auto prodi-scroll-container">
                                    <div class="overflow-x-auto">
                                        <table class="w-full min-w-[500px] text-left">
                                            <thead class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-widest sticky top-0 z-10">
                                                <tr>
                                                    <th class="px-6 lg:px-10 py-4 w-full">Nama Prodi</th>
                                                    <th class="px-6 lg:px-10 py-4 text-center">Kuota</th>
                                                    <th class="px-6 lg:px-10 py-4 text-center">Peminat</th>
                                                    <th class="px-6 lg:px-10 py-4 text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y bg-white">
                                                <template x-for="prodi in univ.prodis">
                                                    <tr class="hover:bg-blue-50/40 transition-all">
                                                        <td class="px-6 lg:px-10 py-5 font-bold text-[10px] lg:text-xs text-gray-700 uppercase whitespace-nowrap" x-text="prodi.nama"></td>
                                                        <td class="px-6 lg:px-10 py-5 text-center font-black text-[10px] lg:text-xs text-blue-600 whitespace-nowrap" x-text="prodi.kuota"></td>
                                                        <td class="px-6 lg:px-10 py-5 text-center font-black text-[10px] lg:text-xs text-indigo-500 whitespace-nowrap" x-text="prodi.peminat"></td>
                                                        <td class="px-6 lg:px-10 py-5 text-center">
                                                            <button @click="triggerDelete('prodi', prodi)" class="text-[10px] font-black text-red-400 uppercase">Hapus</button>
                                                        </td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div x-show="currentPage === 'history'" x-cloak class="flex-1 overflow-y-auto p-4 lg:p-10 pb-20">
                <div class="max-w-none mx-auto bg-white rounded-[1.5rem] lg:rounded-[2.5rem] shadow-sm border overflow-hidden">
                    <div class="flex border-b bg-gray-50/50">
                        <button @click="historyTab = 'univ'" :class="historyTab === 'univ' ? 'bg-white border-b-2 border-[#4A72D4] text-[#4A72D4]' : 'text-gray-400'" class="flex-1 py-4 lg:py-6 font-black uppercase text-[10px] lg:text-xs">Riwayat Univ</button>
                        <button @click="historyTab = 'prodi'" :class="historyTab === 'prodi' ? 'bg-white border-b-2 border-[#4A72D4] text-[#4A72D4]' : 'text-gray-400'" class="flex-1 py-4 lg:py-6 font-black uppercase text-[10px] lg:text-xs">Riwayat Prodi</button>
                    </div>
                    <div x-show="historyTab === 'univ'" class="divide-y">
                        <template x-for="log in historyUnivList" :key="log.id">
                            <div class="p-4 lg:p-8 flex items-center justify-between hover:bg-gray-50/50 transition-all gap-4">
                                <div class="flex items-center gap-3 lg:gap-4">
                                    <div class="bg-amber-100 text-amber-600 w-10 h-10 lg:w-12 lg:h-12 rounded-xl flex items-center justify-center font-black text-xs">U</div>
                                    <div>
                                        <p class="font-bold text-xs lg:text-sm uppercase text-gray-700" x-text="log.name"></p>
                                        <p class="text-[8px] lg:text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1" x-text="'Dihapus: ' + log.time"></p>
                                    </div>
                                </div>
                                <div class="flex gap-1 lg:gap-2">
                                    <button @click="prepareRestore(log.id, log.name)" class="bg-emerald-50 text-emerald-600 px-3 lg:px-6 py-2 rounded-lg lg:rounded-xl text-[8px] lg:text-[9px] font-black uppercase tracking-widest whitespace-nowrap">Pulihkan</button>
                                    <button @click="prepareForceDelete(log.id, log.name)" class="bg-red-50 text-red-500 px-3 lg:px-6 py-2 rounded-lg lg:rounded-xl text-[8px] lg:text-[9px] font-black uppercase tracking-widest whitespace-nowrap">Hapus</button>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div x-show="historyTab === 'prodi'" class="divide-y">
                        <template x-for="log in historyProdiList" :key="log.id">
                            <div class="p-4 lg:p-8 flex items-center justify-between hover:bg-gray-50/50 transition-all gap-4">
                                <div class="flex items-center gap-3 lg:gap-4">
                                    <div class="bg-indigo-100 text-indigo-600 w-10 h-10 lg:w-12 lg:h-12 rounded-xl flex items-center justify-center font-black text-xs">P</div>
                                    <div>
                                        <p class="font-bold text-xs lg:text-sm uppercase text-gray-700" x-text="log.name"></p>
                                        <p class="text-[8px] lg:text-[10px] text-[#4A72D4] font-black uppercase tracking-widest" x-text="log.univ_name"></p>
                                    </div>
                                </div>
                                <div class="flex gap-1 lg:gap-2">
                                    <button @click="prepareRestore(log.id, log.name)" class="bg-emerald-50 text-emerald-600 px-3 lg:px-6 py-2 rounded-lg lg:rounded-xl text-[8px] lg:text-[9px] font-black uppercase tracking-widest whitespace-nowrap">Pulihkan</button>
                                    <button @click="prepareForceDelete(log.id, log.name)" class="bg-red-50 text-red-500 px-3 lg:px-6 py-2 rounded-lg lg:rounded-xl text-[8px] lg:text-[9px] font-black uppercase tracking-widest whitespace-nowrap">Hapus Permanen</button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div x-show="showImportModal" x-transition x-cloak class="fixed inset-0 z-[200] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
        <div class="bg-white rounded-[2rem] w-full max-w-[320px] lg:max-w-sm overflow-hidden shadow-2xl">
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
    <div class="bg-white rounded-[2rem] w-full max-w-[320px] lg:max-w-sm overflow-hidden shadow-2xl">
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
                <input x-model="newProdiName" type="text" placeholder="Nama Prodi" 
                    class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 font-bold text-sm focus:ring-2 focus:ring-[#4A72D4]"
                    :class="{'ring-2 ring-red-500': !newProdiName && showProdiError}">
                
                <div class="grid grid-cols-2 gap-3">
                    <input x-model="newProdiKuota" type="number" placeholder="Kuota" 
                        class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 font-black text-center text-blue-600 focus:ring-2 focus:ring-[#4A72D4]"
                        :class="{'ring-2 ring-red-500': (!newProdiKuota || newProdiKuota <= 0) && showProdiError}">
                    
                    <input x-model="newProdiPeminat" type="number" placeholder="Peminat" 
                        class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 font-black text-center text-indigo-500 focus:ring-2 focus:ring-[#4A72D4]"
                        :class="{'ring-2 ring-red-500': (!newProdiPeminat || newProdiPeminat <= 0) && showProdiError}">
                </div>

                <template x-if="showProdiError && (!newProdiName || !newProdiKuota || !newProdiPeminat)">
                    <p class="text-[10px] text-red-500 font-bold text-center uppercase tracking-tighter">* Semua data manual wajib diisi!</p>
                </template>

                <button @click="if(newProdiName && newProdiKuota > 0 && newProdiPeminat > 0) { saveProdi(); showProdiError = false; } else { showProdiError = true; }" 
                    class="w-full bg-[#4A72D4] text-white py-3 rounded-xl font-black uppercase text-[9px] tracking-widest shadow-lg mt-2">
                    Simpan Prodi
                </button>
            </div>

            <div x-show="prodiMode === 'excel'" class="space-y-4 text-center">
                <button @click="unduhTemplate('prodi')" class="w-full bg-emerald-50 border border-dashed border-emerald-200 py-3 rounded-xl text-emerald-600 font-bold text-[9px] uppercase">Unduh Template Prodi</button>
                <div class="relative">
                    <input type="file" @change="importExcel($event)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div class="w-full bg-emerald-500 text-white py-3 rounded-xl font-black text-center uppercase text-[9px] tracking-widest">Upload Excel Prodi</div>
                </div>
            </div>

            <button @click="showModalProdi = false; showProdiError = false;" class="w-full font-black text-gray-400 uppercase text-[9px] tracking-widest mt-4">Batal</button>
        </div>
    </div>
</div>

    <div x-show="showModalUniv" x-transition x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
    <div class="bg-white rounded-[2rem] w-full max-w-[320px] lg:max-w-sm overflow-hidden shadow-2xl">
        <div class="bg-[#4A72D4] p-6 text-white text-center">
            <h4 class="text-lg font-black italic uppercase" x-text="isEditModeUniv ? 'Edit PTN' : 'Tambah PTN'"></h4>
        </div>
        <div class="p-6 space-y-3">
            <input x-model="newUnivName" 
                   type="text" 
                   placeholder="Nama Universitas" 
                   class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 font-bold text-sm focus:ring-2 focus:ring-[#4A72D4]"
                   :class="{'ring-2 ring-red-500': !newUnivName && showValidationErrors}">
            
            <input x-model="newUnivLocation" 
                   type="text" 
                   placeholder="Lokasi" 
                   class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 font-bold text-sm focus:ring-2 focus:ring-[#4A72D4]"
                   :class="{'ring-2 ring-red-500': !newUnivLocation && showValidationErrors}">

            <template x-if="showValidationErrors && (!newUnivName || !newUnivLocation)">
                <p class="text-[10px] text-red-500 font-bold text-center uppercase tracking-tighter">* Semua field wajib diisi!</p>
            </template>

            <button @click="if(newUnivName && newUnivLocation) { saveUniv(); showValidationErrors = false; } else { showValidationErrors = true; }" 
                    class="w-full bg-[#4A72D4] py-3 rounded-xl font-black text-white uppercase text-[9px] tracking-widest shadow-lg mt-2">
                Simpan
            </button>
            
            <button @click="showModalUniv = false; showValidationErrors = false;" 
                    class="w-full font-black text-gray-400 uppercase text-[9px] tracking-widest">
                Batal
            </button>
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

    @if(session('success'))
<div 
    x-data
    x-init="
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',

            width: '340px',
            padding: '1.8rem',

            background: '#ffffff',
            color: '#334155',

            confirmButtonText: 'Oke',
            confirmButtonColor: '#4A72D4',

            customClass: {
                popup: 'rounded-3xl shadow-xl',
                title: 'text-lg font-bold',
                confirmButton: 'rounded-xl px-6 py-2'
            },

            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
    "
></div>
@endif

@if(session('error'))
<div 
    x-data
    x-init="
        Swal.fire({
            icon: 'error',
            title: '{{ session('error') }}',

            width: '340px',
            padding: '1.8rem',

            background: '#ffffff',
            color: '#334155',

            confirmButtonText: 'Coba Lagi',
            confirmButtonColor: '#ef4444',

            customClass: {
                popup: 'rounded-3xl shadow-xl',
                title: 'text-lg font-bold',
                confirmButton: 'rounded-xl px-6 py-2'
            },

            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        })
    "
></div>
@endif


@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                popup: 'rounded-[2rem]', 
            }
        });
    </script>
@endif

{{-- MODAL PULIHKAN --}}
<div x-show="showRestoreModal" x-cloak class="fixed inset-0 z-[999] flex items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" @click="showRestoreModal = false"></div>
    <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full relative z-[1000] text-center shadow-2xl" x-show="showRestoreModal" x-transition>
        <div class="w-20 h-20 bg-emerald-100 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
            <i class="fa-solid fa-clock-rotate-left"></i>
        </div>
        <h3 class="text-xl font-black text-[#2E3B66] mb-2 uppercase italic">Pulihkan Data?</h3>
        <p class="text-gray-500 text-xs font-bold uppercase mb-8" x-text="actionName"></p>
        <div class="flex gap-3">
            <button @click="showRestoreModal = false" class="flex-1 py-3 rounded-xl font-black uppercase text-[9px] bg-gray-100 text-gray-400">Batal</button>
            <button @click="confirmRestore()" class="flex-1 py-3 rounded-xl font-black uppercase text-[9px] bg-emerald-500 text-white">Ya, Pulihkan</button>
        </div>
    </div>
</div>

{{-- MODAL HAPUS PERMANEN --}}
<div x-show="showForceDeleteModal" x-cloak class="fixed inset-0 z-[999] flex items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" @click="showForceDeleteModal = false"></div>
    <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full relative z-[1000] text-center shadow-2xl" x-show="showForceDeleteModal" x-transition>
        <div class="w-20 h-20 bg-rose-100 text-rose-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <h3 class="text-xl font-black text-[#2E3B66] mb-2 uppercase italic">Hapus Permanen?</h3>
        <p class="text-gray-500 text-[10px] font-bold uppercase mb-8">Data <span class="text-rose-600 font-black" x-text="actionName"></span> akan dihapus selamanya.</p>
        <div class="flex gap-3">
            <button @click="showForceDeleteModal = false" class="flex-1 py-3 rounded-xl font-black uppercase text-[9px] bg-gray-100 text-gray-400">Batal</button>
            <button @click="confirmPermanentDelete()" class="flex-1 py-3 rounded-xl font-black uppercase text-[9px] bg-rose-600 text-white">Hapus!</button>
        </div>
    </div>
</div>

</body>
</html>