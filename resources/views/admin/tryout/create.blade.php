<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Soal Tryout - Admin | PERSISTEN</title>
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
    showConfirmBackModal: false,
    isDirty: false,
    showSuccessModal: false,
    successMessage: '',
    showErrorModal: false,
    errorMessage: '',
    showPublishModal: false,
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
        history.pushState(null, null, window.location.href);
        window.onpopstate = () => {
            if (this.isDirty) {
                this.showConfirmBackModal = true;
                history.pushState(null, null, window.location.href);
            } else {
                window.location.href = '/admin/tryout';
            }
        };

        const saved = localStorage.getItem('persisten_tryout_final');
        if (saved) {
            const data = JSON.parse(saved);
            this.subtesList = data.subtesList || [];
            this.namaTryout = data.namaTryout || '';
            this.tglMulai = data.tglMulai || '';
            this.tglSelesai = data.tglSelesai || '';
            this.isDirty = true; 
        }

        this.$watch('subtesList', () => this.saveLocal());
        this.$watch('namaTryout', () => this.saveLocal());
        this.$watch('tglMulai', () => this.saveLocal());
        this.$watch('tglSelesai', () => this.saveLocal());
    },

        saveLocal() {
            this.isDirty = true;
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
        XLSX.writeFile(wb, 'Template_Soal_TRYOUT.xlsx');
    },

    importSheet(event) {
        const file = event.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = (e) => {
            try {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, { type: 'array' });
                let totalImported = 0;
                let foundSheet = false;

                workbook.SheetNames.forEach(sheetName => {
                    const sIdx = this.subtesList.findIndex(s => s.name.toLowerCase() === sheetName.toLowerCase());
                    if (sIdx !== -1) {
                        foundSheet = true;
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
                                        jawaban_benar: row['Jawaban Benar']?.toString().toUpperCase() || '',
                                        pembahasan: row['Pembahasan'] || '',
                                        materi_teks: row['Materi Teks'] || '',
                                        image_url: row['Link Gambar'] || null
                                    };
                                }
                            });
                            current.soalTerisi = current.questions.filter(x => x && x.pertanyaan).length;
                            current.completed = (current.soalTerisi >= this.targetSoal);
                            totalImported += current.soalTerisi;
                        }
                    }
                });

                if (!foundSheet) throw new Error('Nama sheet tidak sesuai subtes.');
                
                this.saveLocal();
                this.successMessage = 'Berhasil mengimport ' + totalImported + ' soal.';
                this.showSuccessModal = true;
                this.showImportModal = false;
                if (this.activeSubtesIndex !== null) this.loadQuestion();
            } catch (error) {
                this.errorMessage = error.message;
                this.showErrorModal = true;
            }
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
        this.errorMessage = 'Lengkapi semua data dan subtes terlebih dahulu!';
        this.showErrorModal = true;
        return;
    }
    this.showPublishModal = true;
    },

    confirmPublikasikan() {
        localStorage.removeItem('persisten_tryout_final');
        document.getElementById('formTryout').submit();
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

    <div x-show="showImportModal" x-cloak class="fixed inset-0 z-[100] overflow-y-auto">
   
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" @click="showImportModal = false"></div>

    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="relative bg-white w-full max-w-lg rounded-[35px] shadow-2xl p-8 transform transition-all"
             x-show="showImportModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                    <i class="fa-solid fa-file-excel text-emerald-500"></i> Import Soal dari Excel
                </h3>
                <button @click="showImportModal = false" class="text-gray-400 hover:text-red-500 transition-colors">
                    <i class="fa-solid fa-circle-xmark text-2xl"></i>
                </button>
            </div>

            <div class="border-4 border-dashed border-gray-100 rounded-[25px] p-10 flex flex-col items-center justify-center group hover:border-emerald-300 transition-all bg-gray-50/50">
                <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-cloud-arrow-up text-3xl text-emerald-500"></i>
                </div>
                <p class="text-sm font-bold text-gray-600">Klik di sini</p>
                <p class="text-[10px] text-gray-400 mt-2">Maksimal ukuran file: 100MB (.xlsx, .xls)</p>
                
                <input type="file" class="hidden" x-ref="soalExcelInput" @change="importSheet($event)" accept=".xlsx,.xls">
                <button @click="$refs.soalExcelInput.click()"
                        class="mt-6 px-6 py-2 bg-emerald-500 text-white rounded-xl text-xs font-bold hover:bg-emerald-600 transition-all">
                    Pilih File
                </button>
            </div>

            <div class="mt-8 p-4 bg-emerald-50 rounded-2xl flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-info text-emerald-500"></i>
                    <span class="text-[11px] font-bold text-emerald-700 uppercase tracking-tight">Belum punya formatnya?</span>
                </div>
                <button @click="unduhTemplate()"
                   class="text-[11px] font-black text-emerald-600 hover:underline">
                    DOWNLOAD TEMPLATE
                </button>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-8">
                <button @click="showImportModal = false"
                        class="py-4 rounded-2xl text-sm font-bold text-gray-400 hover:bg-gray-50 transition-all">
                    Batalkan
                </button>
            </div>
        </div>
    </div>
</div>

    <div class="flex h-full w-full">
        <aside x-data="{ currentPage: 'tryout' }" :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
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

         <a href="{{ route('admin.tryout.index') }}" x-init="if(currentPage === 'tryout') { $el.scrollIntoView({ block: 'center' }) }"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left bg-[#D4DEF7]  text-[#2E3B66]">
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

        

         <a href="{{ route('admin.peluang.index') }}" 
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
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

        <main class="flex-1 flex flex-col h-full overflow-y-auto custom-scrollbar p-4 lg:p-8">
             <header class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
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
            <form id="formTryout" action="{{ route('admin.tryout.store') }}" method="POST">
                @csrf
                <input type="hidden" name="nama_tryout" :value="namaTryout">
                <input type="hidden" name="tanggal" :value="tglMulai">
                <input type="hidden" name="tanggal_akhir" :value="tglSelesai">
                <input type="hidden" name="payload_full_data" :value="JSON.stringify(subtesList)">

                <div x-show="activeSubtesIndex === null" x-transition>
                <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <button type="button" @click="isDirty ? showConfirmBackModal = true : window.location.href = '/admin/tryout'" class="p-3 bg-white rounded-xl text-gray-400 hover:text-red-500 shadow-sm border border-blue-50 transition-all"><i class="fa-solid fa-arrow-left"></i></button>
                        <div>
                            <h2 class="text-2xl font-extrabold text-[#4A72D4]">Panel Pembuatan Tryout</h2>
                            <p class="text-gray-400 text-xs mt-1 italic font-bold tracking-wide">Lengkapi data subtes untuk mempublikasikan.</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-2 w-full md:w-auto">
                        <button type="button" @click="showImportModal = true" class="w-full md:w-auto bg-white border border-blue-100 text-[#4A72D4] px-6 py-3 rounded-2xl font-bold text-xs shadow-lg flex items-center justify-center gap-2 hover:scale-105 transition-all">
                            <i class="fa-solid fa-file-import"></i> IMPORT VIA SHEET
                        </button>
                    </div>
                </div>

                    <div class="bg-white p-8 rounded-[35px] shadow-sm mb-8 border border-blue-50 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Nama Tryout *</label>
                            <input type="text" x-model="namaTryout" @input="saveLocal()" @input="isDirty = true" required class="w-full bg-gray-50 rounded-2xl py-4 px-6 text-sm outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Mulai *</label>
                            <input type="date" x-model="tglMulai" @input="saveLocal()" @input="isDirty = true" required class="w-full bg-gray-50 rounded-2xl py-4 px-6 text-sm outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Selesai *</label>
                            <input type="date" x-model="tglSelesai" @input="saveLocal()" @input="isDirty = true" required class="w-full bg-gray-50 rounded-2xl py-4 px-6 text-sm outline-none">
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
                        <button type="button" @click="backToKategori()" class="p-3 bg-white rounded-xl text-gray-400 hover:text-red-500 shadow-sm border border-blue-50 transition-all">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                        <h2 class="text-xl font-extrabold text-[#4A72D4]" x-text="subtesList[activeSubtesIndex]?.name"></h2>
                    </div>

                    <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                        
                        <button type="button" @click="showImportModal = true" 
                            class="w-full md:w-auto flex items-center justify-center bg-white border border-blue-100 text-[#4A72D4] px-5 py-3 rounded-2xl text-[10px] font-black uppercase shadow-sm hover:bg-blue-50">
                            <i class="fa-solid fa-file-import mr-2"></i> Import
                        </button>

                        <div class="w-full md:w-48 flex flex-col gap-2" x-data="{ open: false }" @click.away="open = false">
                            <div class="bg-white px-4 py-3 rounded-2xl shadow-sm border border-blue-50 flex items-center gap-2 relative h-full">
                                <i class="fa-solid fa-stopwatch text-orange-400 text-sm"></i>
                                
                                <button type="button" @click="open = !open"
                                    class="w-full flex items-center justify-between text-sm font-bold text-gray-700 focus:outline-none">
                                    <span x-text="subtesList[activeSubtesIndex].waktu + ' Menit'"></span>
                                    <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 transition-transform duration-200"
                                        :class="open ? 'rotate-180' : ''"></i>
                                </button>

                                <div x-show="open" 
                                    x-transition 
                                    class="absolute z-50 w-full mt-2 top-full left-0 bg-white border border-blue-50 shadow-xl rounded-2xl overflow-hidden py-2"
                                    style="display: none;">
                                    <template x-for="t in [20,25,30,35,40,45,50,55,60]">
                                        <div @click="subtesList[activeSubtesIndex].waktu = t; open = false"
                                            class="px-4 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-[#4A72D4] cursor-pointer transition-colors font-medium"
                                            x-text="t + ' Menit'">
                                        </div>
                                    </template>
                                </div>
                            
                        </div>

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
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-50 text-center sticky top-8">
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
                </div>
            </form>
        </main>
    </div>

    {{-- MODAL KEMBALI --}}
    <div x-show="showConfirmBackModal" x-cloak class="fixed inset-0 z-[150] flex items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="showConfirmBackModal = false"></div>
    <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full relative z-[151] text-center shadow-2xl border border-blue-50">
        <div class="w-20 h-20 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <h3 class="text-xl font-black text-[#2E3B66] mb-2">Konfirmasi Keluar</h3>
        <p class="text-gray-500 text-sm mb-8">Data belum disimpan. Jika keluar sekarang, data akan dihapus.</p>
        <div class="flex gap-3">
            <button type="button" @click="showConfirmBackModal = false" class="flex-1 py-3 rounded-xl font-bold bg-gray-100 text-gray-500 hover:bg-gray-200">Batal</button>
            <button type="button" @click="isDirty = false; localStorage.removeItem('persisten_tryout_final'); window.location.href = '/admin/tryout'" 
                    class="flex-1 py-3 rounded-xl font-bold bg-red-500 text-white shadow-lg shadow-red-200">Ya, Keluar</button>
        </div>
    </div>
</div>

{{-- MODAL BERHASIL IMPORT --}}
<div x-show="showSuccessModal" x-cloak class="fixed inset-0 z-[160] flex items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="showSuccessModal = false"></div>
    
    <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full relative z-[161] text-center shadow-2xl border border-blue-50"
         x-show="showSuccessModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">
        
        <div class="w-20 h-20 bg-emerald-100 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        
        <h3 class="text-xl font-black text-[#2E3B66] mb-2">Import Berhasil</h3>
        <p class="text-gray-500 text-sm mb-8" x-text="successMessage"></p>
        
        <button type="button" @click="showSuccessModal = false" 
                class="w-full py-3 rounded-xl font-bold bg-[#4A72D4] text-white shadow-lg shadow-blue-100 hover:bg-blue-600 transition-all text-center">
            Tutup
        </button>
    </div>
</div>

{{-- MODAL GAGAL IMPORT --}}
<div x-show="showErrorModal" x-cloak class="fixed inset-0 z-[170] flex items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="showErrorModal = false"></div>
    
    <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full relative z-[171] text-center shadow-2xl border border-blue-50"
         x-show="showErrorModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">
        
        <div class="w-20 h-20 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
            <i class="fa-solid fa-circle-xmark"></i>
        </div>
        
        <h3 class="text-xl font-black text-[#2E3B66] mb-2">Import Gagal</h3>
        <p class="text-gray-500 text-sm mb-8" x-text="errorMessage"></p>
        
        <button type="button" @click="showErrorModal = false" 
                class="w-full py-3 rounded-xl font-bold bg-gray-800 text-white shadow-lg hover:bg-black transition-all text-center">
            Coba Lagi
        </button>
    </div>
</div>

{{-- MODAL KONFIRM PUBLIKASI --}}
<div x-show="showPublishModal" x-cloak class="fixed inset-0 z-[180] flex items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="showPublishModal = false"></div>
    
    <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full relative z-[181] text-center shadow-2xl border border-blue-50"
         x-show="showPublishModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">
        
        <div class="w-20 h-20 bg-blue-100 text-[#4A72D4] rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
            <i class="fa-solid fa-cloud-arrow-up"></i>
        </div>
        
        <h3 class="text-xl font-black text-[#2E3B66] mb-2">Publikasikan Tryout?</h3>
        <p class="text-gray-500 text-sm mb-8">Pastikan semua data sudah benar. Tryout yang dipublikasikan akan langsung dapat diakses.</p>
        
        <div class="flex gap-3">
            <button type="button" @click="showPublishModal = false" 
                    class="flex-1 py-3 rounded-xl font-bold bg-gray-100 text-gray-500 hover:bg-gray-200 transition-all">
                Batal
            </button>
            <button type="button" @click="confirmPublikasikan()" 
                    class="flex-1 py-3 rounded-xl font-bold bg-[#4A72D4] text-white shadow-lg shadow-blue-100 hover:bg-blue-600 transition-all">
                Ya, Terbitkan
            </button>
        </div>
    </div>
</div>
</body>

</html>