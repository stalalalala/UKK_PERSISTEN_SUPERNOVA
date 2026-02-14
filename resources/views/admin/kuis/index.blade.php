<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persisten Dashboard - Manajemen Kuis</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(74, 114, 212, 0.2);
            border-radius: 10px;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Memastikan container tabel bisa scroll horizontal di mobile */
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>

<body class="bg-[#E9EFFF] h-screen flex overflow-hidden text-[#2D3B61]" x-data="{
    activeMenu: 'Manajemen Kuis',
    mobileMenuOpen: false,
    showImportModal: false,
    activeTab: 'list',

    currentPage: 1,
    itemsPerPage: 10,

    allKuis: [
        { id: 1, judul: 'Kuis Fundamental', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif', tanggal: '2024-02-10' },
        { id: 2, judul: 'Kuis Fundamental', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif', tanggal: '2024-02-10' },
        { id: 3, judul: 'Kuis Fundamental', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Draft', tanggal: '2024-02-10' },
        { id: 4, judul: 'Kuis Fundamental', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif', tanggal: '2024-02-10' },
        { id: 5, judul: 'Kuis Fundamental', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif', tanggal: '2024-02-10' },
        { id: 6, judul: 'Kuis Fundamental', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif', tanggal: '2024-02-10' },
        { id: 7, judul: 'Kuis Fundamental', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif', tanggal: '2024-02-10' },
        { id: 8, judul: 'Kuis Fundamental', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif', tanggal: '2024-02-10' },
        { id: 9, judul: 'Kuis Fundamental', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif', tanggal: '2024-02-10' },
        { id: 10, judul: 'Kuis Fundamental', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Draft', tanggal: '2024-02-10' },
        { id: 11, judul: 'Kuis Fundamental', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif', tanggal: '2024-02-10' },
        { id: 12, judul: 'Kuis Fundamental', kategori: 'Pengetahuan Kuantitatif', soal: 20, durasi: 45, status: 'Aktif', tanggal: '2024-02-10' },
    ],

    historyData: [],

    deleteToHistory(id) {
        const index = this.allKuis.findIndex(item => item.id === id);
        if (index !== -1) {
            this.historyData.push(this.allKuis[index]);
            this.allKuis.splice(index, 1);
        }
    },

    restoreFromHistory(id) {
        const index = this.historyData.findIndex(item => item.id === id);
        if (index !== -1) {
            this.allKuis.push(this.historyData[index]);
            this.historyData.splice(index, 1);
        }
    },

    permanentDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus permanen data ini?')) {
            this.historyData = this.historyData.filter(item => item.id !== id);
        }
    },

    get totalPages() {
        let currentData = this.activeTab === 'list' ? this.allKuis : this.historyData;
        return Math.ceil(currentData.length / this.itemsPerPage) || 1;
    },

    get pagedKuis() {
        let start = (this.currentPage - 1) * this.itemsPerPage;
        let end = start + this.itemsPerPage;
        return this.allKuis.slice(start, end);
    },

    get pagedHistory() {
        let start = (this.currentPage - 1) * this.itemsPerPage;
        let end = start + this.itemsPerPage;
        return this.historyData.slice(start, end);
    }
}">

    <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed inset-y-0 left-0 z-50 w-72 bg-[#4A72D4] text-white flex flex-col p-6 shadow-xl transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shrink-0 h-full">

        <div class="flex items-center justify-between mb-10 px-2">
            <div class="flex items-center gap-3">
                <div class="bg-white p-2 rounded-xl">
                    <svg class="w-6 h-6 text-[#4A72D4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
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

        <nav class="flex-1 space-y-1 overflow-y-auto pr-2 custom-scrollbar">
            <a href="#"
                class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                <div
                    class="w-5 h-5 border-2 border-white/50 rounded group-hover:border-white transition-colors shrink-0">
                </div>
                <span class="text-md font-regular">Dashboard</span>
            </a>
            <a href="#"
                class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                <i class="fa-solid fa-users text-lg w-6 shrink-0 text-center"></i>
                <span class="text-md font-regular">Manajemen user</span>
            </a>
            <a href="#"
                class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                <i class="fa-solid fa-bolt text-lg w-6 shrink-0 text-center"></i>
                <span class="text-md font-regular">Manajemen streak</span>
            </a>
            <a href="#"
                class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                <i class="fa-solid fa-file-signature text-lg w-6 shrink-0 text-center"></i>
                <span class="text-md font-regular">Manajemen tryout</span>
            </a>
            <a href="#"
                class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7] text-[#2E3B66] transition-all duration-200 group text-left">
                <i class="fa-solid fa-book-open text-lg w-6 shrink-0 text-center"></i>
                <span class="text-md font-regular">Manajemen kuis</span>
            </a>
            <a href="#"
                class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                <i class="fa-solid fa-pencil text-lg w-6 shrink-0 text-center"></i>
                <span class="text-md font-regular">Manajemen latihan soal</span>
            </a>
            <a href="#"
                class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                <i class="fa-solid fa-video text-lg w-6 shrink-0 text-center"></i>
                <span class="text-md font-regular">Manajemen video</span>
            </a>
            <a href="#"
                class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                <i class="fa-solid fa-brain text-lg w-6 shrink-0 text-center"></i>
                <span class="text-md font-regular">Manajemen minat bakat</span>
            </a>
            <a href="#"
                class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                <i class="fa-solid fa-graduation-cap text-lg w-6 shrink-0 text-center"></i>
                <span class="text-md font-regular">Manajemen peluang PTN</span>
            </a>
            <a href="#"
                class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                <i class="fa-solid fa-chart-line text-lg w-6 shrink-0 text-center"></i>
                <span class="text-md font-regular">Monitoring dan laporan</span>
            </a>
        </nav>

        <button
            class="mt-4 w-full flex items-center bg-white/10 hover:bg-white/20 px-6 py-3 rounded-2xl transition-all group border border-white/20 backdrop-blur-sm shrink-0">
            <i class="fa-solid fa-right-from-bracket text-lg"></i>
            <span class="text-white text-md font-medium tracking-wide ml-4">Logout</span>
        </button>
    </aside>

    <div x-show="mobileMenuOpen" x-transition:enter="transition opacity-ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition opacity-ease-in duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="mobileMenuOpen = false"
        class="fixed inset-0 bg-black/50 z-40 lg:hidden">
    </div>

    <main class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">

        <header
            class="flex flex-col md:flex-row items-center justify-between p-4 lg:px-8 lg:pt-8 lg:pb-4 gap-4 flex-shrink-0">
            <div class="flex items-center w-full gap-4">
                <button @click="mobileMenuOpen = true" class="lg:hidden p-3 bg-white rounded-xl shadow-sm">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="relative w-full group flex items-center gap-2">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                        </div>
                        <input type="text" placeholder="Search...."
                            class="w-full bg-white border-none rounded-full py-3 pl-12 pr-4 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all">
                    </div>
                    <button
                        class="bg-[#4A72D4] hover:bg-blue-600 text-white px-6 py-3 rounded-full text-sm font-medium shadow-sm transition-all active:scale-95 shrink-0">
                        Cari
                    </button>
                </div>
            </div>

            <div
                class="flex items-center gap-3 bg-white p-1 pr-4 pl-1 rounded-full shadow-sm shrink-0 self-end md:self-auto">
                <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden border-2 border-white">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Admin">
                </div>
                <span class="font-bold text-sm hidden sm:block text-gray-700">Admin</span>
                <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto custom-scrollbar p-4 lg:px-8 lg:pb-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-50 flex items-center gap-5">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-[#4A72D4]">
                        <i class="fa-solid fa-layer-group text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400 font-medium">Total Set Kuis</p>
                        <h4 class="text-2xl font-bold text-gray-800" x-text="allKuis.length"></h4>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-50 flex items-center gap-5">
                    <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500">
                        <i class="fa-solid fa-circle-check text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400 font-medium">Kuis Aktif</p>
                        <h4 class="text-2xl font-bold text-gray-800"
                            x-text="allKuis.filter(k => k.status === 'Aktif').length"></h4>
                    </div>
                </div>
                <div
                    class="bg-white p-6 rounded-xl shadow-sm border border-blue-50 flex items-center gap-5 sm:col-span-2 md:col-span-1">
                    <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-500">
                        <i class="fa-solid fa-trash-can text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400 font-medium">Sampah (History)</p>
                        <h4 class="text-2xl font-bold text-gray-800" x-text="historyData.length"></h4>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-blue-50 overflow-hidden flex flex-col">

                <div
                    class="p-6 md:p-8 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800"
                            x-text="activeTab === 'list' ? 'Daftar Set Kuis' : 'History / Tempat Sampah'"></h3>
                        <p class="text-sm text-gray-400"
                            x-text="activeTab === 'list' ? 'Kelola soal, waktu, dan kategori kuis' : 'Data yang dihapus sementara dapat dipulihkan di sini'">
                        </p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <button @click="activeTab = activeTab === 'list' ? 'history' : 'list'; currentPage = 1"
                            class="flex-1 md:flex-none bg-orange-500 hover:bg-orange-600 text-white px-5 py-3 rounded-xl font-semibold text-xs transition-all flex items-center justify-center gap-2 shadow-lg shadow-orange-100 active:scale-95">
                            <i
                                :class="activeTab === 'list' ? 'fa-solid fa-clock-rotate-left' : 'fa-solid fa-list'"></i>
                            <span x-text="activeTab === 'list' ? 'History' : 'Daftar'"></span>
                        </button>
                        <button
                            class="flex-1 md:flex-none bg-[#4A72D4] hover:bg-blue-600 text-white px-5 py-3 rounded-xl font-semibold text-xs transition-all flex items-center justify-center gap-2 shadow-lg shadow-blue-100 active:scale-95">
                            <i class="fa-solid fa-plus"></i> Buat Baru
                        </button>
                    </div>
                </div>

                <div class="table-responsive custom-scrollbar">
                    <table x-show="activeTab === 'list'"
                        class="w-full text-left border-separate border-spacing-0 min-w-[800px]">
                        <thead class="bg-gray-50/50 sticky top-0 z-10 backdrop-blur-sm">
                            <tr>
                                <th
                                    class="px-28 md:px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                    Set & Judul</th>
                                <th
                                    class="px-24 md:px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                    Kategori</th>
                                <th
                                    class="px-16 md:px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                    Soal</th>
                                <th
                                    class="px-16 md:px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                    Durasi</th>
                                <th
                                    class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                    Status</th>
                                <th
                                    class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <template x-for="(kuis, index) in pagedKuis" :key="kuis.id">
                                <tr class="hover:bg-blue-50/30 transition-colors group">
                                    <td class="px-8 py-5">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-gray-800 group-hover:text-[#4A72D4]"
                                                x-text="'Set ' + kuis.id + ': ' + kuis.judul"></span>
                                            <span class="text-xs text-gray-400"
                                                x-text="'Dibuat: ' + kuis.tanggal"></span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-sm font-medium text-gray-600" x-text="kuis.kategori">
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <span
                                            class="bg-blue-50 text-[#4A72D4] text-xs font-bold px-3 py-1 rounded-full border border-blue-100"
                                            x-text="kuis.soal + ' Soal'"></span>
                                    </td>
                                    <td class="px-8 py-5 text-center text-sm font-semibold text-gray-700"
                                        x-text="kuis.durasi + ' Menit'"></td>
                                    <td class="px-8 py-5 text-center">
                                        <span
                                            :class="kuis.status === 'Aktif' ? 'bg-emerald-100 text-emerald-600' :
                                                'bg-gray-100 text-gray-500'"
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase">
                                            <span
                                                :class="kuis.status === 'Aktif' ? 'bg-emerald-500 animate-pulse' :
                                                    'bg-gray-400'"
                                                class="w-1.5 h-1.5 rounded-full"></span>
                                            <span x-text="kuis.status"></span>
                                        </span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center justify-center gap-2">
                                            <button
                                                class="p-2 text-blue-400 hover:bg-blue-50 rounded-lg transition-all"
                                                title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <button
                                                class="p-2 text-orange-400 hover:bg-orange-50 rounded-lg transition-all"
                                                title="Preview"><i class="fa-solid fa-eye"></i></button>
                                            <button @click="deleteToHistory(kuis.id)"
                                                class="p-2 text-rose-400 hover:bg-rose-50 rounded-lg transition-all"
                                                title="Hapus"><i class="fa-solid fa-trash-can"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <tr x-show="allKuis.length === 0">
                                <td colspan="6" class="px-8 py-10 text-center text-gray-400 italic">Tidak ada kuis
                                    aktif.</td>
                            </tr>
                        </tbody>
                    </table>

                    <table x-show="activeTab === 'history'"
                        class="w-full text-left border-separate border-spacing-0 min-w-[800px]">
                        <thead class="bg-orange-50/50 sticky top-0 z-10 backdrop-blur-sm">
                            <tr>
                                <th class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                    Judul Kuis (Terhapus)</th>
                                <th class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                    Kategori</th>
                                <th
                                    class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                    Status Terakhir</th>
                                <th
                                    class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                    Aksi Pemulihan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <template x-for="hist in pagedHistory" :key="hist.id">
                                <tr class="hover:bg-orange-50/30 transition-colors group">
                                    <td class="px-8 py-5">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-gray-800" x-text="hist.judul"></span>
                                            <span class="text-[10px] text-rose-400 font-bold uppercase">Data di
                                                History</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-sm font-medium text-gray-600" x-text="hist.kategori">
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <span
                                            class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-[10px] font-bold uppercase"
                                            x-text="hist.status"></span>
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <button @click="restoreFromHistory(hist.id)"
                                                class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-xs font-bold transition-all shadow-md active:scale-95">
                                                <i class="fa-solid fa-rotate-left"></i> Pulihkan
                                            </button>
                                            <button @click="permanentDelete(hist.id)"
                                                class="px-4 py-2 bg-rose-500 hover:bg-rose-600 text-white rounded-xl text-xs font-bold transition-all shadow-md active:scale-95">
                                                <i class="fa-solid fa-circle-xmark"></i> Hapus Permanen
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <tr x-show="historyData.length === 0">
                                <td colspan="4" class="px-8 py-10 text-center text-gray-400 italic">History kosong.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div
                    class="p-6 md:p-8 border-t border-gray-50 flex flex-col sm:flex-row items-center justify-between gap-4 bg-white">
                    <p class="text-sm text-gray-400 font-medium">
                        Menampilkan
                        <span x-text="((currentPage - 1) * itemsPerPage) + 1"></span> -
                        <span
                            x-text="activeTab === 'list' ? Math.min(currentPage * itemsPerPage, allKuis.length) : Math.min(currentPage * itemsPerPage, historyData.length)"></span>
                        dari <span x-text="activeTab === 'list' ? allKuis.length : historyData.length"></span> Item
                    </p>

                    <div class="flex items-center gap-2">
                        <button @click="if(currentPage > 1) currentPage--" :disabled="currentPage === 1"
                            class="w-10 h-10 flex items-center justify-center rounded-xl border border-gray-100 hover:bg-gray-50 text-gray-400 disabled:opacity-50">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </button>

                        <div class="flex gap-2">
                            <template x-for="page in totalPages" :key="page">
                                <button @click="currentPage = page"
                                    :class="currentPage === page ? 'bg-[#4A72D4] text-white shadow-blue-100' :
                                        'border border-gray-100 text-gray-600 hover:bg-gray-50'"
                                    class="w-10 h-10 flex items-center justify-center rounded-xl font-bold transition-all shadow-md"
                                    x-text="page">
                                </button>
                            </template>
                        </div>

                        <button @click="if(currentPage < totalPages) currentPage++"
                            :disabled="currentPage === totalPages"
                            class="w-10 h-10 flex items-center justify-center rounded-xl border border-gray-100 hover:bg-gray-50 text-gray-400 disabled:opacity-50">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div x-show="showImportModal" class="fixed inset-0 z-[100] overflow-y-auto" x-cloak>
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" @click="showImportModal = false">
        </div>
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-white w-full max-w-lg rounded-[35px] shadow-2xl p-8 transform transition-all"
                x-show="showImportModal" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-8"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                        <i class="fa-solid fa-file-import text-emerald-500"></i> Import Data Kuis
                    </h3>
                    <button @click="showImportModal = false"
                        class="text-gray-400 hover:text-red-500 transition-colors">
                        <i class="fa-solid fa-circle-xmark text-2xl"></i>
                    </button>
                </div>

                <div
                    class="border-4 border-dashed border-gray-100 rounded-[25px] p-10 flex flex-col items-center justify-center group hover:border-emerald-200 transition-all bg-gray-50/50 text-center">
                    <div
                        class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-cloud-arrow-up text-3xl text-emerald-500"></i>
                    </div>
                    <p class="text-sm font-bold text-gray-600">Klik atau seret file Excel</p>
                    <p class="text-[10px] text-gray-400 mt-2">Format: .xlsx, .xls (Maks 5MB)</p>
                    <input type="file" class="hidden" id="excel_upload">
                    <button onclick="document.getElementById('excel_upload').click()"
                        class="mt-6 px-6 py-2 bg-emerald-500 text-white rounded-xl text-xs font-bold hover:bg-emerald-600 transition-all">Pilih
                        File</button>
                </div>

                <div class="mt-8 p-4 bg-blue-50 rounded-2xl flex items-center justify-between gap-2">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-info text-blue-500"></i>
                        <span class="text-[10px] font-bold text-blue-700 uppercase tracking-tight">Belum punya
                            format?</span>
                    </div>
                    <a href="#"
                        class="text-[10px] font-black text-[#4A72D4] hover:underline whitespace-nowrap">DOWNLOAD
                        TEMPLATE</a>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-8">
                    <button @click="showImportModal = false"
                        class="py-4 rounded-2xl text-sm font-bold text-gray-400 hover:bg-gray-50 transition-all">Batalkan</button>
                    <button
                        class="py-4 bg-[#4A72D4] text-white rounded-2xl text-sm font-bold shadow-lg shadow-blue-100 hover:bg-blue-700 transition-all">Proses
                        Import</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
