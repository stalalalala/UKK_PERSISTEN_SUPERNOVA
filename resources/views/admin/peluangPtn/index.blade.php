<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Peluang PTN - Admin | PERSISTEN</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.svg') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            letter-spacing: -0.01em;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Scrollbar untuk daftar prodi */
        .prodi-scroll-container::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        .prodi-scroll-container::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .admin-layout {
            display: flex;
            height: 100vh;
            overflow: hidden;
            width: 100%;
        }

        .main-content-scroll::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        .main-content-scroll::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-[#F8FAFC] text-[#1E293B]" x-data="{
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

    confirmData: { type: '', id: null, title: '', message: '' },

    newUnivName: '',
    newUnivLocation: '',
    selectedUnivId: null,
    selectedUnivName: '',
    newProdiName: '',
    newProdiKuota: '',
    newProdiPeminat: '',

    univList: {{ $univs->map(
            fn($u) => [
                'id' => $u->id,
                'name' => $u->nama_univ,
                'location' => $u->lokasi,
                'prodis' => $u->prodis->map(
                    fn($p) => [
                        'id' => $p->id,
                        'nama' => $p->nama_prodi,
                        'kuota' => $p->kuota,
                        'peminat' => $p->peminat,
                    ],
                ),
            ],
        )->values()->toJson() }},

    historyUnivList: {{ $historyUniv->map(
            fn($h) => [
                'id' => $h->id,
                'name' => $h->nama_univ,
                'time' => $h->updated_at->format('d M Y, H:i'),
            ],
        )->toJson() }},

    historyProdiList: {{ $historyProdi->map(
            fn($p) => [
                'id' => $p->id,
                'name' => $p->nama_prodi,
                'univ_name' => $p->universitas->nama_univ ?? 'N/A',
                'time' => $p->updated_at->format('d M Y, H:i'),
            ],
        )->toJson() }},

    unduhTemplate(type) {
        const wb = XLSX.utils.book_new();
        let header, data, fileName;

        if (type === 'utama') {
            header = [
                ['Nama Universitas', 'Lokasi', 'Nama Prodi', 'Kuota', 'Peminat']
            ];
            data = [
                ['Universitas Gadjah Mada', 'Yogyakarta', 'Kedokteran', '100', '2500']
            ];
            fileName = 'Template_PTN_Lengkap.xlsx';
        } else {
            header = [
                ['Nama Universitas', 'Nama Prodi', 'Kuota', 'Peminat']
            ];
            data = [
                [this.selectedUnivName, 'Sains Data', '50', '500']
            ];
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
            const workbook = XLSX.read(e.target.result, { type: 'binary' });
            const jsonData = XLSX.utils.sheet_to_json(workbook.Sheets[workbook.SheetNames[0]]);

            const res = await fetch('{{ route('admin.peluang.import') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({ data: jsonData })
            });

            if (res.ok) window.location.reload();
        };

        reader.readAsBinaryString(file);
    },

    async saveUniv() {
        let payload = {
            id: this.isEditModeUniv ? this.selectedUnivId : null,
            nama_univ: this.newUnivName,
            lokasi: this.newUnivLocation
        };

        const res = await fetch('{{ route('admin.peluang.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },
            body: JSON.stringify(payload)
        });

        if (res.ok) window.location.reload();
    },

    async saveProdi() {
        let payload = {
            id: this.selectedUnivId,
            nama_univ: this.selectedUnivName,
            lokasi: this.newUnivLocation,
            prodis: [{
                nama: this.newProdiName,
                kuota: this.newProdiKuota,
                peminat: this.newProdiPeminat
            }]
        };

        const res = await fetch('{{ route('admin.peluang.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },
            body: JSON.stringify(payload)
        });

        if (res.ok) window.location.reload();
    },

    async executeDelete() {
        const res = await fetch(`/admin/peluangPtn/${this.confirmData.id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            }
        });

        if (res.ok) window.location.reload();
    },

    openAddUniv() {
        this.isEditModeUniv = false;
        this.newUnivName = '';
        this.newUnivLocation = '';
        this.showModalUniv = true;
    },

    openEditUniv(univ) {
        this.isEditModeUniv = true;
        this.selectedUnivId = univ.id;
        this.newUnivName = univ.name;
        this.newUnivLocation = univ.location;
        this.showModalUniv = true;
    },

    openAddProdi(univ) {
        this.selectedUnivId = univ.id;
        this.selectedUnivName = univ.name;
        this.newUnivLocation = univ.location;
        this.newProdiName = '';
        this.prodiMode = 'manual';
        this.showModalProdi = true;
    }
}">

    <div class="admin-layout">
        <aside x-data="{ currentPage: 'peluang' }" :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-[#4A72D4] text-white flex flex-col p-6 shadow-xl transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shrink-0 h-full">

            <div class="flex items-center justify-between mb-10 px-2">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/logo.svg') }}" alt="Logo" class="w-14 h-14">
                    <h1 class="text-2xl font-bold tracking-tight">P E R S I S T E N</h1>
                </div>
                <button @click="mobileMenuOpen = false" class="lg:hidden p-2 hover:bg-white/10 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <nav
                class="flex-1 space-y-1 overflow-y-auto pr-2 
                [&::-webkit-scrollbar]:w-1 
                [&::-webkit-scrollbar-track]:bg-transparent 
                [&::-webkit-scrollbar-thumb]:bg-white/20 
                [&::-webkit-scrollbar-thumb]:rounded-full">

                <a href="{{ route('admin.dashboard.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>
                    <span class="text-md font-regular">Dashboard</span>
                </a>

                <a href="{{ route('admin.user.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl  transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen user</span>
                </a>

                <a href="{{ route('admin.streak.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen streak</span>
                </a>

                <a href="{{ route('admin.tryout.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen tryout</span>
                </a>

                <a href="{{ route('admin.kuis.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen kuis</span>
                </a>

                <a href="{{ route('admin.latihan.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                    <span class="text-md font-regular">Manajemen latihan
                        soal</span>
                </a>

                <a href="{{ route('admin.videoPembelajaran.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-9">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen video
                        pembelajaran</span>
                </a>

                <a href="{{ route('admin.minatBakat.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                    </svg>
                    <span class="text-md font-regular">Manajemen minat
                        bakat</span>
                </a>



                <a href="{{ route('admin.peluang.index') }}" x-init="if (currentPage === 'peluang') { $el.scrollIntoView({ block: 'center' }) }"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left bg-[#D4DEF7]  text-[#2E3B66]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen peluang
                        PTN</span>
                </a>

                <a href="{{ route('admin.laporan.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                    </svg>
                    <span class="text-md font-regular">Monitoring dan
                        laporan</span>
                </a>


            </nav>

            <form action="{{ route('logout') }}" method="POST" class="w-full inline">
                @csrf
                <button type="submit"
                    class="mt-4 w-full flex items-center bg-white/10 hover:bg-white/20 px-6 py-3 rounded-2xl transition-all group border border-white/20 backdrop-blur-sm shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-5 md:size-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    <span class="text-white text-md font-medium tracking-wide ml-4">Logout</span>
                </button>
            </form>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            <header class="flex flex-col lg:flex-row lg:items-center justify-between p-4 lg:px-8 lg:pt-8 lg:pb-4 gap-4 flex-shrink-0 w-full">
    <div class="flex items-center justify-between w-full lg:w-auto gap-4 lg:order-2">
        <button @click="mobileMenuOpen = true" class="lg:hidden p-3 bg-white rounded-xl shadow-sm shrink-0">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        @php
            use Illuminate\Support\Facades\Auth;
            $user = Auth::user();
            // Mengambil nama depan saja untuk tampilan ringkas di bar
            $firstName = explode(' ', trim($user->name))[0];
        @endphp

        <div x-data="{ open: false }" class="relative flex-1 lg:flex-initial">
            <div @click="open = !open" 
                class="flex items-center justify-between lg:justify-start gap-3 bg-white p-1 pr-4 pl-1 rounded-full shadow-sm cursor-pointer border border-transparent hover:border-blue-100 transition-all w-full lg:w-auto ml-auto">
                
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-gray-100 rounded-full overflow-hidden border-2 border-white shrink-0">
                        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=4A72D4&color=fff' }}" 
                             alt="{{ $user->name }}" class="w-full h-full object-cover">
                    </div>
                    <span class="font-bold text-sm text-gray-700 truncate">{{ $firstName }}</span>
                </div>
                
                <i class="fa-solid fa-chevron-down text-gray-400 text-[10px]"></i>
            </div>

            <div x-show="open" 
                x-cloak
                @click.away="open = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                class="absolute right-0 mt-3 w-64 bg-white rounded-[20px] shadow-2xl border border-gray-100 z-[100] overflow-hidden">
                
                <div class="p-5 bg-gradient-to-br from-gray-50 to-white border-b border-gray-100">
                    <p class="font-extrabold text-gray-800 leading-tight">{{ $user->name }}</p>
                    <p class="text-[11px] text-gray-400 mt-1 truncate">{{ $user->email }}</p>
                </div>
                
                <div class="p-4 flex flex-col gap-2 bg-white">
                    <div class="flex items-center gap-3 text-xs text-gray-500 p-2 bg-gray-50 rounded-xl border border-gray-100">
                        <i class="fa-solid fa-phone text-blue-400"></i>
                        <span>{{ $user->no_hp ?? 'No HP belum diatur' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-data="{
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
                let search = this.keyword.toLowerCase().trim();
                if(!search) return;
                for (let key in this.routes) {
                    if (key.includes(search)) {
                        window.location.href = this.routes[key];
                        return;
                    }
                    alert('Halaman tidak ditemukan')
                }
                alert('Halaman tidak ditemukan');
            }
        }"
        class="relative w-full lg:flex-grow flex items-center gap-2 lg:order-1"
    >
        <div class="relative w-full group">
            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-focus-within:text-[#4A72D4] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
            <input 
                type="text" 
                x-model="keyword" 
                placeholder="Cari halaman..." 
                @keydown.enter="goToPage()"
                class="w-full bg-white border-none rounded-full py-3.5 pl-14 pr-4 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all text-sm placeholder:text-gray-400 font-medium"
            >
        </div>

        <button 
            @click="goToPage()" 
            class="bg-[#4A72D4] hover:bg-blue-600 text-white px-7 py-3.5 rounded-full text-sm font-extrabold shadow-lg shadow-blue-100 transition-all active:scale-95 shrink-0"
        >
            Cari
        </button>
    </div>
</header>

            <div class="px-6 lg:px-14 py-2 shrink-0 overflow-x-auto no-scrollbar">
                <div class="flex items-center justify-between lg:justify-end gap-3 min-w-max pr-4">
                    <button @click="currentPage = (currentPage === 'peluang_ptn' ? 'history' : 'peluang_ptn')"
                        class="bg-white border text-[#4A72D4] px-5 py-2.5 rounded-full font-black text-[10px] uppercase tracking-widest shadow-sm whitespace-nowrap">
                        <span
                            x-text="currentPage === 'peluang_ptn' ? 'Riwayat / History' : 'Kembali ke Daftar'"></span>
                    </button>
                    <div x-show="currentPage === 'peluang_ptn'" class="flex gap-2">
                        <button @click="showImportModal = true"
                            class="bg-emerald-500 text-white px-5 py-2.5 rounded-full font-black text-[10px] uppercase tracking-widest shadow-lg whitespace-nowrap">Import
                            Excel</button>
                        <button @click="openAddUniv()"
                            class="bg-[#4A72D4] text-white px-5 py-2.5 rounded-full font-black text-[10px] uppercase tracking-widest shadow-lg whitespace-nowrap">Tambah
                            PTN Baru</button>
                    </div>
                </div>
            </div>

            <div x-show="currentPage === 'peluang_ptn'"
                class="flex-1 overflow-y-auto main-content-scroll p-4 lg:p-10 pb-20">
                <div class="max-w-none mx-auto space-y-4">
                    <template x-for="univ in univList" :key="univ.id">
                        <div
                            class="bg-white rounded-[1.5rem] lg:rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden flex flex-col">
                            <div @click="expandedUniv = (expandedUniv === univ.id ? null : univ.id)"
                                class="p-4 lg:p-8 flex items-center justify-between cursor-pointer hover:bg-gray-50/50 transition-all shrink-0">
                                <div class="flex items-center gap-3 lg:gap-6">
                                    <div
                                        class="w-10 h-10 lg:w-14 lg:h-14 bg-blue-50 rounded-xl lg:rounded-2xl flex items-center justify-center text-[#4A72D4]">
                                        <svg :class="expandedUniv === univ.id ? 'rotate-180' : ''"
                                            class="w-5 h-5 lg:w-6 lg:h-6 transition-transform duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-width="3" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-black text-gray-800 text-xs lg:text-base uppercase"
                                            x-text="univ.name"></h3>
                                        <p class="text-[8px] lg:text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5 lg:mt-1"
                                            x-text="univ.location"></p>
                                    </div>
                                </div>
                                <div class="flex gap-1 lg:gap-2">
                                    <button @click.stop="openEditUniv(univ)"
                                        class="p-2 lg:p-3 text-gray-300 hover:text-blue-500"><svg
                                            class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg></button>
                                    <button
                                        @click="
                            Swal.fire({
                            title: 'Hapus Universitas?',
                            text: 'Universitas akan dipindahkan ke History',
                            icon: 'warning',
                            width: '340px',
                            showCancelButton: true,
                            confirmButtonColor: '#ef4444',
                            confirmButtonText: 'Ya, Hapus!',
                        customClass: { popup: 'rounded-3xl shadow-xl', title: 'text-lg font-bold', confirmButton: 'px-5 py-2.5 rounded-xl text-sm',   cancelButton: 'px-5 py-2.5 rounded-xl text-sm bg-gray-100 text-gray-600 hover:bg-gray-200' }
                            }).then(async (result) => {
                                if(result.isConfirmed){
                                    const res = await fetch(`/admin/peluangPtn/${univ.id}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                                        }
                                    })

                                    if(res.ok){
                                        location.reload()
                                    }
                                }
                            })
                            "
                                        class="text-red-500 px-3 py-1.5 rounded-lg text-xs hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                    <button @click.stop="openAddProdi(univ)"
                                        class="p-2 lg:p-3 bg-[#4A72D4] text-white rounded-xl lg:rounded-2xl shadow-md"><svg
                                            class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-width="3" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg></button>
                                </div>
                            </div>

                            <div x-show="expandedUniv === univ.id" x-collapse class="border-t bg-gray-50/30">
                                <div class="max-h-[300px] overflow-y-auto prodi-scroll-container">
                                    <div class="overflow-x-auto">
                                        <table class="w-full min-w-[500px] text-left">
                                            <thead
                                                class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-widest sticky top-0 z-10">
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
                                                        <td class="px-6 lg:px-10 py-5 font-bold text-[10px] lg:text-xs text-gray-700 uppercase whitespace-nowrap"
                                                            x-text="prodi.nama"></td>
                                                        <td class="px-6 lg:px-10 py-5 text-center font-black text-[10px] lg:text-xs text-blue-600 whitespace-nowrap"
                                                            x-text="prodi.kuota"></td>
                                                        <td class="px-6 lg:px-10 py-5 text-center font-black text-[10px] lg:text-xs text-indigo-500 whitespace-nowrap"
                                                            x-text="prodi.peminat"></td>
                                                        <td class="px-6 lg:px-10 py-5 text-center">
                                                        <td class="px-6 lg:px-10 py-5 text-center">
                                                            <button
                                                                @click="
                            Swal.fire({
                            title: 'Hapus Prodi?',
                            text: 'Prodi akan dipindahkan ke History',
                            icon: 'warning',
                            width: '340px',
                            showCancelButton: true,
                            confirmButtonColor: '#ef4444',
                            confirmButtonText: 'Ya, Hapus!',
                            cancelButtonText: 'Batal',
                        customClass: { popup: 'rounded-3xl shadow-xl', title: 'text-lg font-bold', confirmButton: 'px-5 py-2.5 rounded-xl text-sm',   cancelButton: 'px-5 py-2.5 rounded-xl text-sm bg-gray-100 text-gray-600 hover:bg-gray-200' }
                            }).then(async (result) => {
                                if(result.isConfirmed){
                                    const res = await fetch(`/admin/peluangPtn/${prodi.id}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                                        }
                                    })

                                    if(res.ok){
                                        location.reload()
                                    }
                                }
                            })
                            "
                                                                class="text-red-500 px-3 py-1.5 rounded-lg text-xs hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="2"
                                                                    stroke="currentColor" class="size-5">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                </svg>
                                                            </button>
                                                        </td>
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
                <div
                    class="max-w-none mx-auto bg-white rounded-[1.5rem] lg:rounded-[2.5rem] shadow-sm border overflow-hidden">
                    <div class="flex border-b bg-gray-50/50">
                        <button @click="historyTab = 'univ'"
                            :class="historyTab === 'univ' ? 'bg-white border-b-2 border-[#4A72D4] text-[#4A72D4]' :
                                'text-gray-400'"
                            class="flex-1 py-4 lg:py-6 font-black uppercase text-[10px] lg:text-xs">Riwayat
                            Univ</button>
                        <button @click="historyTab = 'prodi'"
                            :class="historyTab === 'prodi' ? 'bg-white border-b-2 border-[#4A72D4] text-[#4A72D4]' :
                                'text-gray-400'"
                            class="flex-1 py-4 lg:py-6 font-black uppercase text-[10px] lg:text-xs">Riwayat
                            Prodi</button>
                    </div>
                    <div x-show="historyTab === 'univ'" class="divide-y">
                        <template x-for="log in historyUnivList" :key="log.id">
                            <div
                                class="p-4 lg:p-8 flex items-center justify-between hover:bg-gray-50/50 transition-all gap-4">
                                <div class="flex items-center gap-3 lg:gap-4">
                                    <div
                                        class="bg-amber-100 text-amber-600 w-10 h-10 lg:w-12 lg:h-12 rounded-xl flex items-center justify-center font-black text-xs">
                                        U</div>
                                    <div>
                                        <p class="font-bold text-xs lg:text-sm uppercase text-gray-700"
                                            x-text="log.name"></p>
                                        <p class="text-[8px] lg:text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1"
                                            x-text="'Dihapus: ' + log.time"></p>
                                    </div>
                                </div>
                                <div class="flex gap-1 lg:gap-2">
                                    <button
                                        @click="
                            Swal.fire({
                            title: 'Pulihkan Universitas?',
                            text: 'Data akan dikembalikan ke daftar Universitas',
                            icon: 'question',
                            width: '340px',
                            showCancelButton: true,
                            confirmButtonColor: '#22c55e',
                            confirmButtonText: 'Ya, Pulihkan!',
                            cancelButtonText: 'Batal',
                            customClass: { popup: 'rounded-3xl shadow-xl', title: 'text-lg font-bold', confirmButton: 'px-5 py-2.5 rounded-xl text-sm',   cancelButton: 'px-5 py-2.5 rounded-xl text-sm bg-gray-100 text-gray-600 hover:bg-gray-200' }
       
                            }).then((result) => {
                                if(result.isConfirmed){
                                    fetch(`/admin/peluangPtn/${log.id}/restore`, {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    }).then(res => {
                                        if(res.ok) window.location.reload()
                                    })
                                }
                            })
                        "
                                        class="text-blue-500 px-2 py-1 rounded-lg text-xs hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 4v6h6M20 20v-6h-6M4 10a8 8 0 0116 0 8 8 0 01-16 0z" />
                                        </svg>
                                    </button>
                                    <button
                                        @click="
                                Swal.fire({
                            title: 'Hapus Permanen?',
                            text: 'Data tidak bisa dikembalikan!',
                            width: '340px',
                            icon: 'error',
                            showCancelButton: true,
                            confirmButtonColor: '#ef4444',
                            confirmButtonText: 'Ya, Hapus!',
                            cancelButtonText: 'Batal',
                            customClass: { popup: 'rounded-3xl shadow-xl', title: 'text-lg font-bold', confirmButton: 'px-5 py-2.5 rounded-xl text-sm',   cancelButton: 'px-5 py-2.5 rounded-xl text-sm bg-gray-100 text-gray-600 hover:bg-gray-200' }
        
                            }).then((result) => {
                                if(result.isConfirmed){
                                    fetch(`/admin/peluangPtn/${log.id}/force`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    }).then(res => {
                                        if(res.ok) window.location.reload()
                                    })
                                }
                            })
                        "
                                        class="text-red-500 px-3 py-1.5 rounded-lg text-xs hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div x-show="historyTab === 'prodi'" class="divide-y">
                        <template x-for="log in historyProdiList" :key="log.id">
                            <div
                                class="p-4 lg:p-8 flex items-center justify-between hover:bg-gray-50/50 transition-all gap-4">
                                <div class="flex items-center gap-3 lg:gap-4">
                                    <div
                                        class="bg-indigo-100 text-indigo-600 w-10 h-10 lg:w-12 lg:h-12 rounded-xl flex items-center justify-center font-black text-xs">
                                        P</div>
                                    <div>
                                        <p class="font-bold text-xs lg:text-sm uppercase text-gray-700"
                                            x-text="log.name"></p>
                                        <p class="text-[8px] lg:text-[10px] text-[#4A72D4] font-black uppercase tracking-widest"
                                            x-text="log.univ_name"></p>
                                    </div>
                                </div>
                                <div class="flex gap-1 lg:gap-2">
                                    <button
                                        @click="
                            Swal.fire({
                            title: 'Pulihkan Prodi?',
                            text: 'Data akan dikembalikan ke daftar Prodi',
                            icon: 'question',
                            width: '340px',
                            showCancelButton: true,
                            confirmButtonColor: '#22c55e',
                            confirmButtonText: 'Ya, Pulihkan!',
                            cancelButtonText: 'Batal',
                            customClass: { popup: 'rounded-3xl shadow-xl', title: 'text-lg font-bold', confirmButton: 'px-5 py-2.5 rounded-xl text-sm',   cancelButton: 'px-5 py-2.5 rounded-xl text-sm bg-gray-100 text-gray-600 hover:bg-gray-200' }
       
                            }).then((result) => {
                                if(result.isConfirmed){
                                    fetch(`/admin/peluangPtn/${log.id}/restore`, {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    }).then(res => {
                                        if(res.ok) window.location.reload()
                                    })
                                }
                            })
                        "
                                        class="text-blue-500 px-2 py-1 rounded-lg text-xs hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 4v6h6M20 20v-6h-6M4 10a8 8 0 0116 0 8 8 0 01-16 0z" />
                                        </svg>
                                    </button>
                                    <button
                                        @click="
                            Swal.fire({
                            title: 'Hapus Permanen?',
                            text: 'Data tidak bisa dikembalikan!',
                            width: '340px',
                            icon: 'error',
                            showCancelButton: true,
                            confirmButtonColor: '#ef4444',
                            confirmButtonText: 'Ya, Hapus!',
                            cancelButtonText: 'Batal',
                            customClass: { popup: 'rounded-3xl shadow-xl', title: 'text-lg font-bold', confirmButton: 'px-5 py-2.5 rounded-xl text-sm',   cancelButton: 'px-5 py-2.5 rounded-xl text-sm bg-gray-100 text-gray-600 hover:bg-gray-200' }
       
                            }).then((result) => {
                                if(result.isConfirmed){
                                    fetch(`/admin/peluangPtn/${log.id}/force`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    }).then(res => {
                                        if(res.ok) window.location.reload()
                                    })
                                }
                            })
                        "
                                        class="text-red-500 px-3 py-1.5 rounded-lg text-xs hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div x-show="showImportModal" x-cloak class="fixed inset-0 z-[100] overflow-y-auto">

        <!-- BACKDROP -->
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" @click="showImportModal = false"></div>

        <!-- CONTENT -->
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-white w-full max-w-lg rounded-[35px] shadow-2xl p-8" x-show="showImportModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-8"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0">

                <!-- HEADER -->
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                        <i class="fa-solid fa-file-excel text-emerald-500"></i>
                        Import PTN & Prodi
                    </h3>

                    <button @click="showImportModal = false" class="text-gray-400 hover:text-red-500">
                        <i class="fa-solid fa-circle-xmark text-2xl"></i>
                    </button>
                </div>

                <!-- UPLOAD AREA -->
                <div
                    class="border-4 border-dashed border-gray-100 rounded-[25px] p-10 flex flex-col items-center justify-center group hover:border-emerald-300 transition-all bg-gray-50/50">

                    <div
                        class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-cloud-arrow-up text-3xl text-emerald-500"></i>
                    </div>

                    <p class="text-sm font-bold text-gray-600">Klik untuk upload</p>
                    <p class="text-[10px] text-gray-400 mt-2">
                        Maksimal 100MB (.xlsx, .xls)
                    </p>

                    <!-- INPUT -->
                    <input type="file" class="hidden" x-ref="excelInput" @change="importExcel($event)"
                        accept=".xlsx,.xls">

                    <button @click="$refs.excelInput.click()"
                        class="mt-6 px-6 py-2 bg-emerald-500 text-white rounded-xl text-xs font-bold hover:bg-emerald-600 transition-all">
                        Pilih File
                    </button>
                </div>

                <!-- TEMPLATE -->
                <div class="mt-8 p-4 bg-emerald-50 rounded-2xl flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-info text-emerald-500"></i>
                        <span class="text-[11px] font-bold text-emerald-700 uppercase">
                            Butuh template?
                        </span>
                    </div>

                    <button @click="unduhTemplate('utama')"
                        class="text-[11px] font-black text-emerald-600 hover:underline uppercase">
                        Unduh
                    </button>
                </div>

                <!-- FOOTER -->
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <button @click="showImportModal = false"
                        class="py-4 rounded-2xl text-sm font-bold text-gray-400 hover:bg-gray-50 transition-all">
                        Batalkan
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div x-show="showModalProdi" x-cloak
        class="fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div @click.away="showModalProdi = false" class="bg-white w-full max-w-md rounded-[32px] p-8 shadow-2xl">

            <!-- HEADER -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-xl font-extrabold text-slate-800">Tambah Prodi</h3>
                    <p class="text-[10px] text-slate-400 uppercase tracking-widest mt-1" x-text="selectedUnivName">
                    </p>
                </div>

                <button @click="showModalProdi = false" class="text-gray-300 hover:text-red-500">
                    <i class="fa-solid fa-circle-xmark text-2xl"></i>
                </button>
            </div>

            <!-- FORM -->
            <div class="space-y-3">

                <!-- Nama Prodi -->
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-slate-400 uppercase ml-1 tracking-widest">
                        Nama Prodi
                    </label>
                    <input x-model="newProdiName" type="text"
                        class="w-full bg-[#F3F6FF] rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none">
                </div>

                <!-- Kuota & Peminat -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase ml-1 tracking-widest">
                            Kuota
                        </label>
                        <input x-model="newProdiKuota" type="number"
                            class="w-full bg-[#F3F6FF] rounded-2xl p-3 text-sm text-center text-blue-600 focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase ml-1 tracking-widest">
                            Peminat
                        </label>
                        <input x-model="newProdiPeminat" type="number"
                            class="w-full bg-[#F3F6FF] rounded-2xl p-3 text-sm text-center text-indigo-500 focus:ring-2 focus:ring-blue-400">
                    </div>
                </div>

                <!-- ERROR -->
                <template x-if="showProdiError && (!newProdiName || !newProdiKuota || !newProdiPeminat)">
                    <p class="text-[10px] text-red-500 mt-1">
                        Semua field wajib diisi.
                    </p>
                </template>

                <!-- BUTTON -->
                <div class="flex gap-3 pt-2">
                    <button type="button" @click="showModalProdi = false"
                        class="flex-1 bg-slate-50 text-slate-400 font-bold py-3.5 rounded-2xl hover:bg-slate-100">
                        Batal
                    </button>

                    <button
                        @click="if(newProdiName && newProdiKuota && newProdiPeminat){ saveProdi(); showProdiError=false } else { showProdiError=true }"
                        class="flex-1 bg-[#4A72D4] text-white font-bold py-3.5 rounded-2xl hover:bg-blue-600 shadow-lg shadow-blue-100 active:scale-95">
                        Simpan
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div x-show="showModalUniv" x-cloak
        class="fixed inset-0 z-[100] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div @click.away="showModalUniv = false" class="bg-white w-full max-w-md rounded-[32px] p-8 shadow-2xl">

            <!-- HEADER -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-extrabold text-slate-800"
                    x-text="isEditModeUniv ? 'Ubah Universitas' : 'Tambah Universitas'"></h3>

                <button @click="showModalUniv = false" class="text-gray-300 hover:text-red-500">
                    <i class="fa-solid fa-circle-xmark text-2xl"></i>
                </button>
            </div>

            <!-- FORM -->
            <div class="space-y-3">

                <!-- Nama Univ -->
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-slate-400 uppercase ml-1 tracking-widest">
                        Nama Universitas
                    </label>
                    <input x-model="newUnivName" type="text"
                        class="w-full bg-[#F3F6FF] rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none"
                        placeholder="Masukkan nama universitas..."
                        :class="{ 'ring-2 ring-red-500': !newUnivName && showValidationErrors }">
                </div>

                <!-- Lokasi -->
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-slate-400 uppercase ml-1 tracking-widest">
                        Lokasi
                    </label>
                    <input x-model="newUnivLocation" type="text"
                        class="w-full bg-[#F3F6FF] rounded-2xl p-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none"
                        placeholder="Masukkan lokasi..."
                        :class="{ 'ring-2 ring-red-500': !newUnivLocation && showValidationErrors }">
                </div>

                <!-- ERROR -->
                <template x-if="showValidationErrors && (!newUnivName || !newUnivLocation)">
                    <p class="text-[10px] text-red-500 mt-1">
                        Semua field wajib diisi.
                    </p>
                </template>

                <!-- BUTTON -->
                <div class="flex gap-3 pt-2">
                    <button type="button" @click="showModalUniv = false"
                        class="flex-1 bg-slate-50 text-slate-400 font-bold py-3.5 rounded-2xl hover:bg-slate-100">
                        Batal
                    </button>

                    <button
                        @click="if(newUnivName && newUnivLocation){ saveUniv(); showValidationErrors=false } else { showValidationErrors=true }"
                        class="flex-1 bg-[#4A72D4] text-white font-bold py-3.5 rounded-2xl hover:bg-blue-600 shadow-lg shadow-blue-100 active:scale-95">
                        Simpan
                    </button>
                </div>

            </div>
        </div>
    </div>



    @if (session('success'))
        <div x-data x-init="Swal.fire({
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
        })"></div>
    @endif

    @if (session('error'))
        <div x-data x-init="Swal.fire({
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
        })"></div>
    @endif



</body>

</html>