<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minat Bakat - Persisten Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(74, 114, 212, 0.2); border-radius: 10px; }
        [x-cloak] { display: none !important; }
        .active-page { background-color: #4A72D4 !important; color: white !important; }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-[#E9EFFF] h-screen overflow-hidden text-[#2D3B61]" x-data="{
    activeMenu: 'minat-bakat',
    currentPage: 'minat_bakat',
    searchQuery: '',
    searchParticipants: '',
    mobileMenuOpen: false,
    showModal: false,
    showAllParticipants: false,
    isEdit: false,
    
    pagiCurrentPage: 1,
    pagiItemsPerPage: 5,
    
    formData: {
        id: null,
        name: '',
        color: '#4A72D4',
        description: ''
    },

    categories: {{ $categories->toJson() }},
    participants: {{ $participants->toJson() }},

    get totalSoalAktif() {
        return this.categories.reduce((acc, cat) => acc + (parseInt(cat.soals_count) || 0), 0);
    },

    get filteredParticipants() {
        return this.participants.filter(p => 
            p.name.toLowerCase().includes(this.searchParticipants.toLowerCase()) || 
            (p.hasil && p.hasil.toLowerCase().includes(this.searchParticipants.toLowerCase()))
        );
    },
    get paginatedParticipants() {
        let start = (this.pagiCurrentPage - 1) * this.pagiItemsPerPage;
        return this.filteredParticipants.slice(start, start + this.pagiItemsPerPage);
    },
    get totalParticipantPages() {
        return Math.ceil(this.filteredParticipants.length / this.pagiItemsPerPage) || 1;
    },

    exportData() {
        window.location.href = '{{ route('admin.minatbakat.export') }}';
    },

    async resetData() {
        if(confirm('PERINGATAN: Pastikan Anda sudah membackup data! Hapus semua data peserta sekarang?')) {
            try {
                const response = await fetch('{{ route('admin.minatbakat.reset') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });
                if(response.ok) {
                    alert('Database berhasil dibersihkan');
                    window.location.reload();
                }
            } catch (e) { alert('Gagal mereset data'); }
        }
    },

    openAddModal() {
        this.isEdit = false;
        this.formData = { id: null, name: '', color: '#4A72D4', description: '' };
        this.showModal = true;
    },

    openEditModal(cat) {
        this.isEdit = true;
        this.formData = { 
            id: cat.id, 
            name: cat.name, 
            color: cat.color, 
            description: cat.description || '' 
        };
        this.showModal = true;
    },

    async saveCategory() {
        let url = this.isEdit 
            ? '{{ route("admin.minatbakat.kategori.update", ":id") }}'.replace(':id', this.formData.id)
            : '{{ route("admin.minatbakat.kategori.store") }}';
        
        let method = this.isEdit ? 'PUT' : 'POST';

        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify(this.formData)
        });

        if (response.ok) {
            window.location.reload(); 
        } else {
            const error = await response.json();
            alert('Gagal menyimpan: ' + (error.message || 'Terjadi kesalahan'));
        }
    },

    async deleteCategory(id) {
        if(confirm('Hapus kategori ini secara permanen?')) {
            let url = '{{ route("admin.minatbakat.kategori.destroy", ":id") }}'.replace(':id', id);
            const response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                this.categories = this.categories.filter(c => c.id !== id);
            } else {
                alert('Gagal menghapus kategori.');
            }
        }
    },

    goToSoal(name) {
        const baseUrl = '{{ route("admin.minatbakat.manajemen") }}';
        window.location.href = `${baseUrl}?category=${encodeURIComponent(name)}`;
    }
}">

    <div class="flex h-full w-full">
        <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-50 w-72 bg-[#4A72D4] text-white flex flex-col p-6 shadow-xl transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shrink-0 h-screen overflow-y-auto">

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
        
        <a href="#"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <div class="w-5 h-5 border-2 border-white/50 rounded group-hover:border-white transition-colors shrink-0"></div>
            <span class="text-md font-regular">Dashboard</span>
        </a>

        <a href="#"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl  transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen user</span>
        </a>

        <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen streak</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen tryout</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen kuis</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen latihan soal</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen video pembelajaran</span>
        </a>

         <a href="#" 
         x-init="if(currentPage === 'minat_bakat') { $el.scrollIntoView({ block: 'center' }) }"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left bg-[#D4DEF7]  text-[#2E3B66]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen minat  bakat</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen  perangkingan</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen peluang PTN</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Monitoring dan laporan</span>
        </a>

         <a href="#" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="text-md font-regular">Manajemen sistem dan konten</span>
        </a>

        </nav>

    <button class="mt-4 w-full flex items-center bg-white/10 hover:bg-white/20 px-6 py-3 rounded-2xl transition-all group border border-white/20 backdrop-blur-sm shrink-0">
        <svg xmlns="http://www.w3.org/2000/xml" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 md:size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
        </svg>
        <span class="text-white text-md font-medium tracking-wide ml-4">Logout</span>
    </button>
</aside>

        <main class="flex-1 flex flex-col min-w-0 bg-[#F8FAFF] overflow-hidden p-4 lg:p-8">
            <header class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
                <div class="flex items-center w-full gap-4">
                    <button @click="mobileMenuOpen = true" class="lg:hidden p-3 bg-white rounded-xl shadow-sm">
                        <i class="fa-solid fa-bars text-gray-600"></i>
                    </button>
                    <div class="relative w-full">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" placeholder="Cari data..." class="w-full bg-white border-none rounded-full py-3 pl-12 pr-4 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none transition-all">
                    </div>
                </div>

                <div class="flex items-center gap-3 bg-white p-1 pr-4 pl-1 rounded-full shadow-sm shrink-0">
                    <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden border-2 border-white shadow-sm">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=4A72D4&color=fff" alt="Admin">
                    </div>
                    <span class="font-bold text-sm hidden sm:block text-gray-700">Administrator</span>
                    <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                </div>
            </header>

            <div class="flex-1 pb-8 overflow-y-auto custom-scrollbar">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-50 flex items-center gap-6 group hover:shadow-md transition-all">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-xl bg-blue-50 text-blue-500">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Peserta Tes</p>
                            <h3 class="text-xl font-bold text-gray-800" x-text="participants.length"></h3>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-50 flex items-center gap-6 group hover:shadow-md transition-all">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-xl bg-emerald-50 text-emerald-500">
                            <i class="fa-solid fa-brain"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Kategori Minat Bakat</p>
                            <h3 class="text-xl font-bold text-gray-800" x-text="categories.length"></h3>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-50 flex items-center gap-6 group hover:shadow-md transition-all">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-xl bg-orange-50 text-orange-500">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Soal Aktif</p>
                            <h3 class="text-xl font-bold text-gray-800" x-text="totalSoalAktif"></h3>
                        </div>
                    </div>
                </div>

                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-widest">Kategori Minat Bakat</h3>
                        <p class="text-[10px] text-gray-400 font-medium mt-1">Kelola kategori dan deskripsi Minat bakat</p>
                    </div>
                    <button @click="openAddModal()"
                        class="px-6 py-3 bg-[#4A72D4] text-white rounded-xl text-[10px] font-bold uppercase tracking-widest shadow-lg shadow-blue-100 hover:scale-105 active:scale-95 transition-all">
                        <i class="fa-solid fa-plus mr-2"></i> Tambah Kategori
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                    <template x-for="cat in categories" :key="cat.id">
                        <div class="bg-white p-6 rounded-2xl border-2 border-transparent hover:border-[#4A72D4] transition-all relative group overflow-hidden cursor-pointer shadow-sm">
                            
                            <div @click="goToSoal(cat.name)" class="absolute inset-0 bg-[#2D3B61]/80 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 flex items-center justify-center">
                                <span class="text-white text-[10px] font-bold uppercase tracking-widest border border-white/30 px-4 py-2 rounded-full">Atur Soal</span>
                            </div>

                            <div class="absolute top-3 right-3 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex gap-2">
                                <button @click.stop="openEditModal(cat)" class="w-8 h-8 bg-white text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all shadow-md flex items-center justify-center">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </button>
                                <button @click.stop="deleteCategory(cat.id)" class="w-8 h-8 bg-white text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all shadow-md flex items-center justify-center">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </div>

                            <div class="flex flex-col gap-3 relative z-0">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shrink-0 shadow-sm" :style="`background-color: ${cat.color}`">
                                        <i class="fa-solid fa-brain text-sm"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="text-xs font-bold text-gray-800 truncate" x-text="cat.name"></h4>
                                        <p class="text-[9px] font-bold text-blue-500 uppercase" x-text="(cat.soals_count || 0) + ' Soal'"></p>
                                    </div>
                                </div>
                                <p class="text-[10px] leading-relaxed text-gray-500 line-clamp-2 italic" 
                                   x-text="cat.description || 'Belum ada deskripsi untuk kategori ini.'"></p>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="bg-white rounded-2xl border border-blue-50 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                        <h3 class="text-xs font-bold text-gray-800 uppercase tracking-widest">Peserta Tes Terbaru</h3>
                        <button @click="showAllParticipants = true; pagiCurrentPage = 1" class="text-[10px] font-bold text-blue-500 uppercase hover:underline">Lihat Semua</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nama Peserta</th>
                                    <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Hasil Dominan</th>
                                    <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <template x-for="user in participants.slice(0, 5)" :key="user.id">
                                    <tr class="hover:bg-blue-50/30 transition-all">
                                        <td class="px-6 py-4">
                                            <p class="text-sm font-bold text-gray-800" x-text="user.name"></p>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-bold uppercase" x-text="user.hasil"></span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a :href="'/admin/minat-bakat/pdf/' + user.id" 
                                               target="_blank"
                                               class="text-gray-400 hover:text-blue-500 transition-all">
                                                <i class="fa-solid fa-file-pdf text-sm"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div x-show="showModal" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div @click="showModal = false" class="absolute inset-0 bg-[#2D3B61]/40 backdrop-blur-sm"></div>
        <div class="bg-white rounded-[28px] w-full max-w-md p-8 relative shadow-2xl" 
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90">
            
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-800 uppercase tracking-widest" x-text="isEdit ? 'Edit Kategori' : 'Tambah Kategori'"></h3>
                <button @click="showModal = false" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>

            <div class="space-y-5">
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase block mb-2 tracking-widest">Nama Kategori</label>
                    <input type="text" x-model="formData.name" class="w-full px-5 py-3 bg-gray-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-[#4A72D4] outline-none">
                </div>

                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase block mb-2 tracking-widest">Deskripsi Minat Bakat</label>
                    <textarea x-model="formData.description" rows="3" class="w-full px-5 py-3 bg-gray-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-[#4A72D4] outline-none resize-none"></textarea>
                </div>

                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase block mb-2 tracking-widest">Warna Identitas</label>
                    <div class="flex gap-3">
                        <input type="color" x-model="formData.color" class="h-12 w-20 rounded-xl border-none cursor-pointer bg-transparent">
                        <div class="flex-1 px-5 py-3 bg-gray-50 rounded-2xl text-[10px] font-bold uppercase text-gray-400 flex items-center" x-text="formData.color"></div>
                    </div>
                </div>

                <button @click="saveCategory()" class="w-full py-4 bg-[#4A72D4] text-white rounded-2xl text-xs font-bold uppercase tracking-widest hover:bg-blue-600 transition-all shadow-lg active:scale-95">
                    <span x-text="isEdit ? 'Simpan Perubahan' : 'Buat Kategori Baru'"></span>
                </button>
            </div>
        </div>
    </div>

    <div x-show="showAllParticipants" x-cloak class="fixed inset-0 z-[110] flex items-center justify-center lg:p-10">
        <div @click="showAllParticipants = false" class="absolute inset-0 bg-[#2D3B61]/60 backdrop-blur-md"></div>
        <div class="bg-white lg:rounded-[40px] w-full h-full max-w-6xl flex flex-col relative shadow-2xl overflow-hidden" 
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-20">
            
            <div class="p-8 border-b border-gray-100 flex items-center justify-between shrink-0">
                <div>
                    <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tight">Database Peserta</h2>
                    <p class="text-[9px] font-bold text-blue-400 uppercase mt-1">Total <span x-text="filteredParticipants.length"></span> Peserta</p>
                </div>
                <div class="flex items-center gap-3">
                    <button @click="exportData()" 
                        class="hidden md:flex items-center gap-2 px-4 py-3 bg-emerald-50 text-emerald-600 rounded-2xl text-[10px] font-bold uppercase tracking-widest hover:bg-emerald-500 hover:text-white transition-all shadow-sm border border-emerald-100">
                        <i class="fa-solid fa-file-csv text-sm"></i> Backup CSV
                    </button>

                    <button @click="resetData()" 
                        class="hidden md:flex items-center gap-2 px-4 py-3 bg-red-50 text-red-500 rounded-2xl text-[10px] font-bold uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all shadow-sm border border-red-100">
                        <i class="fa-solid fa-trash-can text-sm"></i> Reset Data
                    </button>

                    <div class="relative hidden md:block">
                        <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 text-xs"></i>
                        <input type="text" x-model="searchParticipants" @input="pagiCurrentPage = 1" placeholder="Cari nama..."
                            class="pl-12 pr-6 py-4 bg-gray-50 border-none rounded-2xl text-xs font-medium w-48 focus:ring-2 focus:ring-blue-400 outline-none transition-all shadow-inner">
                    </div>
                    <button @click="showAllParticipants = false" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-gray-100 text-gray-400 hover:bg-red-500 hover:text-white transition-all">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-4 md:p-10 custom-scrollbar bg-gray-50/50">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/80">
                            <tr>
                                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama</th>
                                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Hasil</th>
                                <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <template x-for="user in paginatedParticipants" :key="user.id">
                                <tr class="hover:bg-blue-50/50 transition-all">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center font-black text-xs" x-text="user.name.charAt(0)"></div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-800" x-text="user.name"></p>
                                                <p class="text-[9px] font-bold text-gray-400 uppercase" x-text="user.created_at ? new Date(user.created_at).toLocaleDateString() : ''"></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <span class="px-4 py-2 bg-blue-50 text-[#4A72D4] rounded-xl text-[10px] font-black uppercase" x-text="user.hasil"></span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <a :href="'/admin/minat-bakat/pdf/' + user.id" 
                                           target="_blank"
                                           class="w-8 h-8 rounded-lg bg-blue-50 text-blue-500 hover:bg-blue-500 hover:text-white transition-all inline-flex items-center justify-center">
                                            <i class="fa-solid fa-file-pdf text-xs"></i>
                                        </a>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex items-center justify-between px-4" x-show="totalParticipantPages > 1">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Halaman <span x-text="pagiCurrentPage"></span> dari <span x-text="totalParticipantPages"></span></p>
                    <div class="flex items-center gap-2">
                        <button @click="pagiCurrentPage--" :disabled="pagiCurrentPage === 1" class="w-10 h-10 rounded-xl bg-white text-blue-500 shadow-sm disabled:opacity-20 flex items-center justify-center">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <button @click="pagiCurrentPage++" :disabled="pagiCurrentPage === totalParticipantPages" class="w-10 h-10 rounded-xl bg-white text-blue-500 shadow-sm disabled:opacity-20 flex items-center justify-center">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>