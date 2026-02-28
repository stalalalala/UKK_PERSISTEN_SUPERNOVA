<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persisten Dashboard - Manajemen Tryout</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.2); border-radius: 10px; }
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-[#E9EFFF] h-screen overflow-hidden text-[#2D3B61]" x-data="{
    mobileMenuOpen: false,
    activeSubtesIndex: null,
    activeQuestion: 1,
    targetSoal: 20, 
    imageUrl: null,
    showImageModal: false,
    showImportModal: false,
    tempImageUrl: '',
    namaTryout: '',
    tglMulai: '',
    tglSelesai: '',
    subtesList: [
        { name: 'Penalaran Umum', completed: false, soalTerisi: 0, waktu: 20, questions: [] },
        { name: 'Penalaran & Pemahaman Umum', completed: false, soalTerisi: 0, waktu: 20, questions: [] },
        { name: 'Pemahaman Bacaan & Menulis', completed: false, soalTerisi: 0, waktu: 20, questions: [] },
        { name: 'Pengetahuan Kuantitatif', completed: false, soalTerisi: 0, waktu: 20, questions: [] },
        { name: 'Penalaran Matematika', completed: false, soalTerisi: 0, waktu: 20, questions: [] },
        { name: 'Literasi Bahasa Indonesia', completed: false, soalTerisi: 0, waktu: 20, questions: [] },
        { name: 'Literasi Bahasa Inggris', completed: false, soalTerisi: 0, waktu: 20, questions: [] }
    ],

    init() {
        const saved = localStorage.getItem('persisten_tryout_final');
        if (saved) {
            const data = JSON.parse(saved);
            this.subtesList = data.subtesList || this.subtesList;
            this.namaTryout = data.namaTryout || '';
            this.tglMulai = data.tglMulai || '';
            this.tglSelesai = data.tglSelesai || '';
        }
    },

    saveLocal() {
        localStorage.setItem('persisten_tryout_final', JSON.stringify({
            subtesList: this.subtesList, 
            namaTryout: this.namaTryout, 
            tglMulai: this.tglMulai, 
            tglSelesai: this.tglSelesai
        }));
    },

    get canPublish() {
        return this.namaTryout && this.tglMulai && this.tglSelesai && this.subtesList.every(s => s.completed);
    },

    unduhTemplate() {
        const wb = XLSX.utils.book_new();
        const header = [['Pertanyaan', 'Opsi A', 'Opsi B', 'Opsi C', 'Opsi D', 'Opsi E', 'Jawaban Benar', 'Pembahasan', 'Materi Teks', 'Link Gambar']];
        const dummyData = ['Contoh Pertanyaan', 'A', 'B', 'C', 'D', 'E', 'B', 'Penjelasan...', 'Materi...', ''];
        
        this.subtesList.forEach(sub => {
            const ws = XLSX.utils.aoa_to_sheet([...header, dummyData]);
            XLSX.utils.book_append_sheet(wb, ws, sub.name.substring(0, 31));
        });
        XLSX.writeFile(wb, 'Template_Soal_20.xlsx');
    },

    importSheet(event) {
        const file = event.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = (e) => {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, { type: 'array' });
            let count = 0;
            workbook.SheetNames.forEach(sheetName => {
                const sIdx = this.subtesList.findIndex(s => s.name.toLowerCase() === sheetName.toLowerCase());
                if (sIdx !== -1) {
                    const jsonData = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName]);
                    if (jsonData.length > 0) {
                        let current = this.subtesList[sIdx];
                        jsonData.forEach((row, i) => {
                            if(i < this.targetSoal) {
                                current.questions[i] = {
                                    pertanyaan: row['Pertanyaan'] || '',
                                    opsi_a: row['Opsi A'] || '', opsi_b: row['Opsi B'] || '',
                                    opsi_c: row['Opsi C'] || '', opsi_d: row['Opsi D'] || '',
                                    opsi_e: row['Opsi E'] || '',
                                    jawaban_benar: row['Jawaban Benar']?.toUpperCase() || '',
                                    pembahasan: row['Pembahasan'] || '',
                                    materi_teks: row['Materi Teks'] || '',
                                    image_url: row['Link Gambar'] || null
                                };
                            }
                        });
                        current.soalTerisi = current.questions.filter(x => x && x.pertanyaan).length;
                        current.completed = (current.soalTerisi >= this.targetSoal); 
                        count++;
                    }
                }
            });
            this.saveLocal();
            alert('Berhasil mengimpor data!');
            this.showImportModal = false;
            if (this.activeSubtesIndex !== null) this.loadQuestion();
            event.target.value = '';
        };
        reader.readAsArrayBuffer(file);
    },

    selectSubtes(index) {
        this.activeSubtesIndex = index;
        this.activeQuestion = 1;
        this.imageUrl = null;
        this.$nextTick(() => { this.loadQuestion(); });
    },

    backToDaftarTryout() {
        if (confirm('Yakin ingin kembali? Data yang belum dipublikasikan akan dihapus.')) { 
            localStorage.removeItem('persisten_tryout_final');
            window.location.href = '/admin/tryout'; 
        }
    },

    backToKategori() { 
        this.saveLocal();
        this.activeSubtesIndex = null; 
    },

    handleImageFile(event) {
        const file = event.target.files[0];
        if (file) { 
            const reader = new FileReader();
            reader.onload = (e) => { this.imageUrl = e.target.result; this.showImageModal = false; };
            reader.readAsDataURL(file);
        }
    },

    applyImageUrl() {
        if (this.tempImageUrl.trim() !== '') {
            this.imageUrl = this.tempImageUrl; this.showImageModal = false; this.tempImageUrl = '';
        }
    },

    simpanSoal() {
        const q = document.getElementById('pertanyaan_teks').value.trim();
        const a = document.getElementById('opt_a').value.trim();
        const b = document.getElementById('opt_b').value.trim();
        const c = document.getElementById('opt_c').value.trim();
        const d = document.getElementById('opt_d').value.trim();
        const e = document.getElementById('opt_e').value.trim();
        const pbs = document.getElementById('pembahasan_teks').value.trim();
        const jaw = document.querySelector('input[name=\'correct_option\']:checked');

        if (!q || !a || !b || !c || !d || !e || !pbs || !jaw) { alert('Lengkapi semua field!'); return; }

        let current = this.subtesList[this.activeSubtesIndex];
        current.questions[this.activeQuestion - 1] = {
            materi_teks: document.getElementById('materi_teks').value,
            pertanyaan: q, opsi_a: a, opsi_b: b, opsi_c: c, opsi_d: d, opsi_e: e,
            jawaban_benar: jaw.value, pembahasan: pbs, image_url: this.imageUrl
        };
        current.soalTerisi = current.questions.filter(x => x && x.pertanyaan).length;
        this.saveLocal();

        if (this.activeQuestion < this.targetSoal) {
            this.activeQuestion++; this.loadQuestion();
        } else { alert('Tersimpan!'); }
    },

    loadQuestion() {
        let current = this.subtesList[this.activeSubtesIndex];
        let data = current.questions[this.activeQuestion - 1];
        if (data) {
            document.getElementById('materi_teks').value = data.materi_teks || '';
            document.getElementById('pertanyaan_teks').value = data.pertanyaan || '';
            document.getElementById('opt_a').value = data.opsi_a || '';
            document.getElementById('opt_b').value = data.opsi_b || '';
            document.getElementById('opt_c').value = data.opsi_c || '';
            document.getElementById('opt_d').value = data.opsi_d || '';
            document.getElementById('opt_e').value = data.opsi_e || '';
            document.getElementById('pembahasan_teks').value = data.pembahasan || '';
            this.imageUrl = data.image_url || null;
            document.getElementsByName('correct_option').forEach(r => r.checked = (r.value === data.jawaban_benar));
        } else { this.resetInputForm(); }
    },

    resetInputForm() {
        ['materi_teks','pertanyaan_teks','opt_a','opt_b','opt_c','opt_d','opt_e','pembahasan_teks'].forEach(id => {
            const el = document.getElementById(id); if(el) el.value = '';
        });
        this.imageUrl = null;
        document.getElementsByName('correct_option').forEach(r => r.checked = false);
    },

    selesaikanSubtes() {
        if (this.subtesList[this.activeSubtesIndex].soalTerisi < this.targetSoal) {
            alert('Lengkapi 20 soal terlebih dahulu!'); return;
        }
        this.subtesList[this.activeSubtesIndex].completed = true;
        this.activeSubtesIndex = null;
        this.saveLocal();
    },

    publikasikan() {
        if (!this.canPublish) {
            alert('Lengkapi semua data dan subtes!'); return;
        }
        if(confirm('Publikasikan Tryout?')) {
            localStorage.removeItem('persisten_tryout_final');
            document.getElementById('formTryout').submit();
        }
    }
}">

    <div x-show="showImageModal" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm" x-transition>
        <div class="bg-white w-full max-w-md rounded-[30px] p-8 shadow-2xl" @click.away="showImageModal = false">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-lg text-[#4A72D4]">Tambah Gambar</h3>
                <button type="button" @click="showImageModal = false" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="space-y-6">
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">Upload File</label>
                    <label class="flex items-center justify-center w-full h-24 border-2 border-dashed border-blue-100 rounded-2xl bg-blue-50/50 cursor-pointer hover:bg-blue-50 transition-all text-center">
                        <div><i class="fa-solid fa-cloud-arrow-up text-blue-400 text-xl mb-1"></i><p class="text-[10px] font-bold text-blue-400 uppercase">Pilih File</p></div>
                        <input type="file" class="hidden" @change="handleImageFile">
                    </label>
                </div>
                <div class="relative flex items-center py-2"><div class="flex-grow border-t border-gray-100"></div><span class="mx-4 text-[10px] font-bold text-gray-300 uppercase">Atau</span><div class="flex-grow border-t border-gray-100"></div></div>
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">Link Gambar (URL)</label>
                    <div class="flex gap-2">
                        <input type="text" x-model="tempImageUrl" placeholder="https://..." class="flex-1 bg-gray-50 rounded-xl py-3 px-4 text-xs outline-none">
                        <button type="button" @click="applyImageUrl" class="bg-[#4A72D4] text-white px-4 rounded-xl text-xs font-bold">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="showImportModal" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm" x-transition>
        <div class="bg-white w-full max-w-md rounded-[30px] p-8 shadow-2xl" @click.away="showImportModal = false">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-lg text-[#4A72D4]">Import Soal via Sheet</h3>
                <button type="button" @click="showImportModal = false" class="text-gray-400 hover:text-red-500"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="space-y-6 text-center">
                <p class="text-xs text-gray-400 font-medium">Pastikan nama Sheet di Excel sesuai dengan nama Subtes.</p>
                <label class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-emerald-100 rounded-[30px] bg-emerald-50/50 cursor-pointer hover:bg-emerald-50 transition-all">
                    <i class="fa-solid fa-file-excel text-emerald-400 text-3xl mb-3"></i>
                    <p class="text-[10px] font-bold text-emerald-500 uppercase tracking-widest">Klik untuk pilih file Excel</p>
                    <input type="file" class="hidden" accept=".xlsx, .xls" @change="importSheet">
                </label>
                <button type="button" @click="unduhTemplate()" class="text-[10px] font-bold text-[#4A72D4] uppercase hover:underline">Belum punya template? Unduh di sini</button>
            </div>
        </div>
    </div>

    <div class="flex h-full w-full">
        <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed inset-y-0 left-0 z-50 w-72 bg-[#4A72D4] text-white flex flex-col p-6 shadow-xl transition-all lg:static shrink-0 h-full">
            <div class="flex items-center justify-between mb-10 px-2">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-2 rounded-xl text-[#4A72D4]"><i class="fa-solid fa-bolt"></i></div>
                    <h1 class="text-2xl font-bold uppercase tracking-tighter">Persisten</h1>
                </div>
                <button @click="mobileMenuOpen = false" class="lg:hidden p-2 text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <nav class="flex-1 space-y-1">
                <div class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7] text-[#2E3B66]">
                    <i class="fa-solid fa-file-pen"></i><span class="font-bold text-sm">Manajemen tryout</span>
                </div>
            </nav>
        </aside>

        <main class="flex-1 flex flex-col h-full overflow-y-auto custom-scrollbar p-4 lg:p-8">
            <form id="formTryout" action="{{ route('admin.tryout.store') }}" method="POST">
                @csrf
                <input type="hidden" name="nama_tryout" :value="namaTryout">
                <input type="hidden" name="tanggal" :value="tglMulai">
                <input type="hidden" name="tanggal_akhir" :value="tglSelesai">
                <input type="hidden" name="payload_full_data" :value="JSON.stringify(subtesList)">

                <div x-show="activeSubtesIndex === null" x-transition>
                    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <button type="button" @click="backToDaftarTryout()" class="p-3 bg-white rounded-xl text-gray-400 hover:text-red-500 shadow-sm border border-blue-50 transition-all"><i class="fa-solid fa-arrow-left"></i></button>
                            <div>
                                <h2 class="text-2xl font-extrabold text-[#4A72D4]">Panel Pembuatan Tryout</h2>
                                <p class="text-gray-400 text-xs mt-1 italic font-bold tracking-wide">Lengkapi data subtes untuk mempublikasikan.</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" @click="unduhTemplate()" class="bg-emerald-500 text-white px-6 py-3 rounded-2xl font-bold text-xs shadow-lg flex items-center gap-2 hover:scale-105 transition-all">
                                <i class="fa-solid fa-download"></i> UNDUH TEMPLATE
                            </button>
                            <button type="button" @click="showImportModal = true" class="bg-white border border-blue-100 text-[#4A72D4] px-6 py-3 rounded-2xl font-bold text-xs shadow-lg flex items-center gap-2 hover:scale-105 transition-all">
                                <i class="fa-solid fa-file-import"></i> IMPORT VIA SHEET
                            </button>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-[35px] shadow-sm mb-8 border border-blue-50 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Nama Tryout *</label>
                            <input type="text" x-model="namaTryout" required class="w-full bg-gray-50 rounded-2xl py-4 px-6 text-sm outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Mulai *</label>
                            <input type="date" x-model="tglMulai" required class="w-full bg-gray-50 rounded-2xl py-4 px-6 text-sm outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Selesai *</label>
                            <input type="date" x-model="tglSelesai" required class="w-full bg-gray-50 rounded-2xl py-4 px-6 text-sm outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <template x-for="(sub, index) in subtesList" :key="index">
                            <div @click="selectSubtes(index)" class="bg-white p-6 rounded-[30px] shadow-sm border-2 border-transparent hover:border-[#4A72D4] cursor-pointer transition-all">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="p-3 rounded-2xl" :class="sub.completed ? 'bg-emerald-100 text-emerald-600' : 'bg-blue-50 text-[#4A72D4]'"><i class="fa-solid" :class="sub.completed ? 'fa-check-double' : 'fa-book-open'"></i></div>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase" x-text="sub.completed ? 'Selesai' : 'Draft'"></span>
                                </div>
                                <h3 class="font-bold text-gray-800 text-sm" x-text="sub.name"></h3>
                                <div class="flex items-center justify-between mt-4">
                                    <p class="text-[10px] text-gray-400">Terisi: <span class="font-bold text-[#4A72D4]" x-text="sub.soalTerisi"></span>/<span x-text="targetSoal"></span></p>
                                    <div class="flex items-center gap-1 text-[10px] font-bold text-orange-500"><i class="fa-solid fa-clock"></i> <span x-text="sub.waktu + 'm'"></span></div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="mt-12 p-8 bg-white rounded-[35px] border-2 border-dashed border-gray-200 flex flex-col items-center">
                        <button type="button" @click="publikasikan()" :disabled="!canPublish" class="px-16 py-4 bg-orange-500 disabled:bg-gray-200 text-white rounded-2xl font-bold shadow-xl transition-all hover:scale-105 active:scale-95">PUBLIKASIKAN TRYOUT</button>
                    </div>
                </div>

                <div x-show="activeSubtesIndex !== null" x-cloak x-transition>
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
                        <div class="flex items-center gap-4">
                            <button type="button" @click="backToKategori()" class="p-3 bg-white rounded-xl text-gray-400 hover:text-red-500 shadow-sm border border-blue-50 transition-all"><i class="fa-solid fa-arrow-left"></i></button>
                            <h2 class="text-xl font-extrabold text-[#4A72D4]" x-text="subtesList[activeSubtesIndex]?.name"></h2>
                        </div>
                        <div class="flex gap-2">
                            <button type="button" @click="showImportModal = true" class="bg-white border border-blue-100 text-[#4A72D4] px-5 py-3 rounded-2xl text-[10px] font-black uppercase shadow-sm hover:bg-blue-50">
                                <i class="fa-solid fa-file-import mr-2"></i> Import
                            </button>
                            <div class="bg-white px-4 py-2 rounded-xl shadow-sm border flex items-center gap-3">
                                <label class="text-[10px] font-bold text-gray-400 uppercase">Waktu (m)</label>
                                <input type="number" x-model="subtesList[activeSubtesIndex].waktu" class="w-12 bg-gray-50 rounded-lg p-2 text-sm font-bold text-[#4A72D4] outline-none">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 space-y-6">
                            <div class="bg-white rounded-[30px] p-8 shadow-sm border border-blue-50">
                                <div class="space-y-6">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Materi / Teks</label>
                                        <div class="relative">
                                            <textarea id="materi_teks" class="w-full bg-gray-50 border-none rounded-[25px] p-6 text-sm outline-none min-h-[120px] resize-none"></textarea>
                                            <div class="absolute right-4 bottom-4">
                                                <button type="button" @click="showImageModal = true" class="flex items-center gap-2 bg-white/80 px-4 py-2 rounded-full shadow-sm border cursor-pointer hover:bg-blue-50 transition-all">
                                                    <i class="fa-solid fa-image text-blue-500"></i><span class="text-[10px] font-bold uppercase">Gambar</span>
                                                </button>
                                            </div>
                                        </div>
                                        <template x-if="imageUrl">
                                            <div class="mt-2 relative inline-block group">
                                                <img :src="imageUrl" class="max-h-32 rounded-xl border-2 border-white shadow-md">
                                                <button type="button" @click="imageUrl = null" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 text-[10px] opacity-0 group-hover:opacity-100 transition-opacity"><i class="fa-solid fa-xmark"></i></button>
                                            </div>
                                        </template>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Pertanyaan Nomor <span x-text="activeQuestion"></span> *</label>
                                        <textarea id="pertanyaan_teks" class="w-full bg-gray-50 rounded-[25px] p-6 text-sm outline-none min-h-[100px] resize-none"></textarea>
                                    </div>
                                    <div class="grid grid-cols-1 gap-4">
                                        <template x-for="opt in ['A','B','C','D','E']">
                                            <div class="flex items-start gap-4 p-4 rounded-2xl border-2 bg-gray-50 transition-all">
                                                <span class="w-10 h-10 shrink-0 flex items-center justify-center bg-white rounded-xl shadow-sm font-black text-[#4A72D4]" x-text="opt"></span>
                                                <textarea :id="'opt_'+opt.toLowerCase()" placeholder="Isi opsi..." class="flex-1 bg-transparent border-none outline-none text-sm pt-2 h-10 resize-none"></textarea>
                                                <input type="radio" name="correct_option" :value="opt" class="mt-3 w-5 h-5 accent-emerald-500 cursor-pointer">
                                            </div>
                                        </template>
                                    </div>
                                    <div class="pt-6 border-t">
                                        <label class="text-[10px] font-bold text-orange-500 uppercase flex items-center gap-2 mb-2 ml-1"><i class="fa-solid fa-lightbulb"></i> Pembahasan *</label>
                                        <textarea id="pembahasan_teks" class="w-full bg-orange-50/30 border-2 border-orange-100 rounded-[25px] p-6 text-sm outline-none min-h-[100px] resize-none"></textarea>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between mt-10">
                                    <button type="button" @click="resetInputForm()" class="text-xs font-bold text-gray-400 uppercase tracking-widest hover:text-red-500 transition-colors">Reset Form</button>
                                    <button type="button" @click="simpanSoal()" class="bg-[#4A72D4] text-white px-10 py-4 rounded-2xl font-bold text-sm shadow-lg hover:-translate-y-1 transition-all">SIMPAN & LANJUT</button>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-50 text-center">
                                <h4 class="text-[10px] font-bold text-gray-400 uppercase mb-6 tracking-widest">Navigasi Soal</h4>
                                <div class="grid grid-cols-4 gap-2 mb-8">
                                    <template x-for="n in targetSoal">
                                        <button type="button" @click="activeQuestion = n; loadQuestion()" 
                                            :class="activeQuestion === n ? 'bg-[#4A72D4] text-white' : (subtesList[activeSubtesIndex]?.questions[n-1] ? 'bg-emerald-500 text-white' : 'bg-gray-50 text-gray-400')" 
                                            class="aspect-square rounded-xl border-2 flex items-center justify-center font-bold text-[10px] transition-all" x-text="n"></button>
                                    </template>
                                </div>
                                <button type="button" @click="selesaikanSubtes()" :disabled="subtesList[activeSubtesIndex]?.soalTerisi < targetSoal" :class="subtesList[activeSubtesIndex]?.soalTerisi < targetSoal ? 'bg-gray-300' : 'bg-emerald-500 shadow-lg'" class="w-full py-4 text-white rounded-2xl font-black text-[10px] uppercase">Selesaikan Subtes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>
</body>
</html>