<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Soal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }
        .active-page { background-color: #4A72D4 !important; color: white !important; transform: scale(1.1); box-shadow: 0 4px 12px rgba(74, 114, 212, 0.3); }
        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #BFDBFE; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#E9EFFF] min-h-screen p-3 sm:p-6 md:p-8">

    <div class="max-w-4xl mx-auto" x-data="soalApp()">
        
        <div class="mb-6">
            <button onclick="window.history.back()" class="group flex items-center gap-2 text-blue-500 font-bold text-xs uppercase tracking-widest hover:text-blue-700">
                <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-all">
                    <i class="fa-solid fa-arrow-left"></i>
                </div>
                <span>Kembali</span>
            </button>
        </div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <h1 class="text-xl md:text-2xl font-extrabold text-[#2D3B61] tracking-tight flex items-center gap-2">
                MANAJEMEN SOAL
                <span class="text-blue-500 text-sm bg-blue-100/50 px-3 py-1 rounded-lg" x-text="categoryName"></span>
            </h1>
            
            <div class="flex gap-2">
                <label class="cursor-pointer flex items-center justify-center w-12 h-12 bg-emerald-500 text-white rounded-2xl shadow-lg hover:bg-emerald-600 transition-all group relative">
                    <i class="fa-solid fa-file-csv"></i>
                    <input type="file" class="hidden" @change="importCSV($event)" accept=".csv">
                    <span class="absolute -bottom-10 scale-0 group-hover:scale-100 transition-all bg-gray-800 text-white text-[10px] py-1 px-2 rounded whitespace-nowrap shadow-xl z-50">Import CSV</span>
                </label>

                <button @click="showHistory = true" class="relative w-12 h-12 bg-white rounded-2xl shadow-sm border border-blue-50 flex items-center justify-center">
                    <i class="fa-solid fa-clock-rotate-left text-blue-400"></i>
                    <template x-if="history.length > 0">
                        <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-[10px] flex items-center justify-center rounded-full border-2 border-[#E9EFFF]" x-text="history.length"></span>
                    </template>
                </button>
                <button @click="showFormAdd = !showFormAdd" class="px-6 bg-[#4A72D4] text-white rounded-2xl font-bold text-xs uppercase shadow-lg hover:bg-[#3A5BB2]">
                    + Soal Baru
                </button>
            </div>
        </div>

        <div class="relative mb-6">
            <input type="text" x-model="searchQuery" @input="currentPage = 1" placeholder="Cari pertanyaan..." 
                class="w-full pl-12 pr-6 py-4 bg-white rounded-2xl border-none shadow-sm focus:ring-2 focus:ring-blue-400 outline-none">
            <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-blue-300"></i>
        </div>

        <div x-show="showFormAdd" x-cloak class="mb-8">
            <div class="bg-white p-6 rounded-3xl shadow-xl border-b-8 border-blue-400">
                <textarea x-model="newText" class="w-full p-4 bg-blue-50/50 border-none rounded-2xl focus:ring-2 focus:ring-blue-400 outline-none mb-4" placeholder="Tulis soal baru..." rows="3"></textarea>
                <div class="flex justify-end gap-3">
                    <button @click="showFormAdd = false" class="text-xs font-bold text-blue-400 px-4">Batal</button>
                    <button @click="saveNew()" class="px-8 py-3 bg-[#4A72D4] text-white rounded-xl text-xs font-bold shadow-lg">Simpan</button>
                </div>
            </div>
        </div>

        <div class="space-y-4 min-h-[300px]">
            <template x-for="(soal, index) in paginatedQuestions" :key="soal.id">
                <div class="group bg-white p-6 rounded-[2.5rem] shadow-sm border border-transparent hover:border-blue-200 flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-500 flex items-center justify-center rounded-2xl font-black shrink-0" 
                         x-text="((currentPage - 1) * itemsPerPage) + (index + 1)"></div>
                    <div class="flex-1">
                        <p class="text-slate-700 font-medium leading-relaxed" x-text="soal.text"></p>
                    </div>
                    <button @click="deleteSoal(soal)" class="w-12 h-12 bg-red-50 text-red-400 rounded-2xl hover:bg-red-500 hover:text-white transition-all flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </template>
            <template x-if="filteredQuestions.length === 0">
                <div class="text-center py-20 bg-white/50 rounded-[3rem] border-2 border-dashed border-blue-200">
                    <p class="text-blue-400 font-medium">Belum ada soal.</p>
                </div>
            </template>
        </div>

        <div class="mt-10 flex items-center justify-center gap-2" x-show="totalPages > 1">
            <button @click="currentPage--" :disabled="currentPage === 1" class="w-10 h-10 rounded-xl bg-white disabled:opacity-20 shadow-sm"><i class="fa-solid fa-chevron-left"></i></button>
            <div class="flex gap-2">
                <template x-for="p in totalPages" :key="p">
                    <button @click="currentPage = p" class="w-10 h-10 rounded-xl bg-white font-bold text-xs shadow-sm" :class="currentPage === p ? 'active-page' : ''" x-text="p"></button>
                </template>
            </div>
            <button @click="currentPage++" :disabled="currentPage === totalPages" class="w-10 h-10 rounded-xl bg-white disabled:opacity-20 shadow-sm"><i class="fa-solid fa-chevron-right"></i></button>
        </div>

        <div x-show="showHistory" x-cloak class="fixed inset-0 z-[100] flex items-center justify-end">
            <div @click="showHistory = false" class="absolute inset-0 bg-blue-900/30 backdrop-blur-sm"></div>
            <div x-show="showHistory" x-transition:enter="transition transform duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" 
                 class="relative bg-white w-full max-w-md h-full shadow-2xl flex flex-col">
                <div class="p-6 bg-[#4A72D4] text-white flex items-center justify-between">
                    <h2 class="text-lg font-bold">Recycle Bin</h2>
                    <button @click="showHistory = false" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/40"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="flex-1 overflow-y-auto p-6 space-y-4 custom-scroll">
                    <template x-for="h in history" :key="h.id">
                        <div class="bg-white rounded-3xl p-5 shadow-sm border border-blue-100">
                            <p class="mb-4 italic text-slate-500 text-sm" x-text="h.text"></p>
                            <div class="flex justify-between items-center border-t pt-3">
                                <span class="text-[9px] font-bold text-blue-300 uppercase" x-text="h.deletedAt"></span>
                                <div class="flex gap-2">
                                    <button @click="restoreSoal(h)" class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-lg font-bold text-[9px]">PULIHKAN</button>
                                    <button @click="forceDelete(h.id)" class="w-7 h-7 bg-red-100 text-red-400 rounded-lg flex items-center justify-center"><i class="fa-solid fa-trash-can text-xs"></i></button>
                                </div>
                            </div>
                        </div>
                    </template>
                    <template x-if="history.length === 0">
                        <div class="text-center py-10 text-slate-400">History kosong</div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <script>
        function soalApp() {
            return {
                showFormAdd: false,
                showHistory: false,
                searchQuery: '',
                newText: '',
                currentPage: 1,
                itemsPerPage: 5,
                categoryName: '{{ $categoryName }}',
                questions: @json($questions),
                history: [],
                get filteredQuestions() {
                    return this.questions.filter(q => q.text.toLowerCase().includes(this.searchQuery.toLowerCase()));
                },
                get paginatedQuestions() {
                    let start = (this.currentPage - 1) * this.itemsPerPage;
                    return this.filteredQuestions.slice(start, start + this.itemsPerPage);
                },
                get totalPages() {
                    return Math.ceil(this.filteredQuestions.length / this.itemsPerPage) || 1;
                },
                async saveNew() {
                    if(!this.newText.trim()) return;
                    try {
                        const response = await fetch('{{ route("admin.minatbakat.soal.store") }}', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                            body: JSON.stringify({ text: this.newText, category: this.categoryName })
                        });
                        if(response.ok) {
                            const newSoal = await response.json();
                            this.questions.unshift(newSoal);
                            this.newText = '';
                            this.showFormAdd = false;
                            this.currentPage = 1; 
                        }
                    } catch (e) { console.error(e); }
                },
                async importCSV(event) {
                    const file = event.target.files[0];
                    if (!file) return;
                    const formData = new FormData();
                    formData.append('file', file);
                    try {
                        const response = await fetch('{{ route("admin.minatbakat.soal.importBulk") }}', {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                            body: formData
                        });
                        const result = await response.json();
                        if (result.success) {
                            alert(result.message);
                            window.location.reload(); 
                        } else {
                            alert('Gagal: ' + result.message);
                        }
                    } catch (e) { alert('Terjadi kesalahan koneksi.'); }
                },
                async deleteSoal(soal) {
                    if(!confirm('Pindahkan soal ke History?')) return;
                    try {
                        const response = await fetch(`/admin/minat-bakat/soal/${soal.id}`, {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                        });
                        if(response.ok) {
                            this.history.unshift({ ...soal, deletedAt: new Date().toLocaleTimeString() });
                            this.questions = this.questions.filter(q => q.id !== soal.id);
                        }
                    } catch (e) { alert('Gagal menghapus'); }
                },
                async restoreSoal(h) {
                    if(!confirm('Pulihkan soal ini?')) return;
                    try {
                        const response = await fetch('{{ route("admin.minatbakat.soal.restore") }}', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                            body: JSON.stringify({ text: h.text, category: this.categoryName })
                        });
                        if(response.ok) {
                            const restored = await response.json();
                            this.questions.unshift(restored);
                            this.history = this.history.filter(item => item.id !== h.id);
                        }
                    } catch (e) { alert('Gagal memulihkan'); }
                },
                forceDelete(id) {
                    if(confirm('Hapus PERMANEN dari history?')) {
                        this.history = this.history.filter(h => h.id !== id);
                    }
                }
            }
        }
    </script>
</body>
</html>