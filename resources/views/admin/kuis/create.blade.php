<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kuis Fundamental - Admin | PERSISTEN</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }
    </style>
</head>

<script>
    function kuisForm() {
        return {
            activeMenu: 'Manajemen Kuis',
            showPublishModal: false,
            mobileMenuOpen: false,
            showImportModal: false,
            currentSet: @json($nextSet),
            selectedSubtes: '',
            selectedWaktu: 20,

            soalTersimpan: 0,
            activeQuestion: 1,

            questions: [],

            errors: {
                subtes: '',
                pertanyaan: '',
                opsi: ['', '', '', '', ''],
                benar: ''
            },

            currentQuestion: {
                materi: '',
                gambar: null,
                pertanyaan: '',
                opsi: ['', '', '', '', ''],
                benar: null,
            },

            autoSaveSoal() {

                let index = this.activeQuestion - 1;

                // jangan simpan kalau kosong
                if (this.currentQuestion.pertanyaan.trim() === '') return;

                this.questions[index] = {

                    subtes: this.selectedSubtes,
                    waktu: this.selectedWaktu,

                    materi: this.currentQuestion.materi,
                    gambar: this.currentQuestion.gambar,

                    pertanyaan: this.currentQuestion.pertanyaan,

                    opsi_a: this.currentQuestion.opsi[0],
                    opsi_b: this.currentQuestion.opsi[1],
                    opsi_c: this.currentQuestion.opsi[2],
                    opsi_d: this.currentQuestion.opsi[3],
                    opsi_e: this.currentQuestion.opsi[4],

                    jawaban_benar: this.currentQuestion.benar !== null ? ['a', 'b', 'c', 'd', 'e'][this
                        .currentQuestion.benar
                    ] : null,

                };

                this.saveToLocal(); // 🔥 WAJIB

            },

            saveToLocal() {
                const data = {
                    selectedSubtes: this.selectedSubtes,
                    selectedWaktu: this.selectedWaktu,
                    questions: this.questions,
                    activeQuestion: this.activeQuestion,
                    currentQuestion: this.currentQuestion // 🔥 TAMBAH INI
                };

                localStorage.setItem('kuis_draft', JSON.stringify(data));
            },

            loadFromLocal() {
                const saved = localStorage.getItem('kuis_draft');
                if (!saved) return;

                const data = JSON.parse(saved);

                this.selectedSubtes = data.selectedSubtes || '';
                this.selectedWaktu = data.selectedWaktu || 20;
                this.questions = data.questions || [];
                this.activeQuestion = data.activeQuestion || 1;

                this.soalTersimpan = this.questions.filter(q => q).length;

                // 🔥 PRIORITAS: restore currentQuestion dulu
                if (data.currentQuestion) {
                    this.currentQuestion = data.currentQuestion;
                } else {
                    this.loadQuestion();
                }
            },

            openPublishModal() {

                let totalTerisi = this.questions.filter(q => q).length;

                if (totalTerisi < 20) {
                    alert("Wajib isi 20 soal sebelum publish!");
                    return;
                }

                this.showPublishModal = true;
            },

            confirmPublikasikan() {

                this.showPublishModal = false;

                // lanjut submit
                document.getElementById("questions_json").value =
                    JSON.stringify(this.questions);

                document.getElementById("kuisForm").submit();
            },

            uploadGambar(e) {

                const file = e.target.files[0];
                if (!file) return;

                if (file.size > 1024 * 1024) {
                    alert("Ukuran gambar maksimal 1MB");
                    e.target.value = "";
                    return;
                }

                const allowed = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];

                if (!allowed.includes(file.type)) {
                    alert("Format gambar harus PNG/JPG/WEBP");
                    e.target.value = "";
                    return;
                }

                const reader = new FileReader();

                reader.onload = (event) => {

                    this.currentQuestion.gambar = event.target.result;

                    this.saveToLocal();

                    console.log("BASE64 OK:", this.currentQuestion.gambar.substring(0, 50));

                };

                reader.readAsDataURL(file);
            },

            importExcel(event) {
                const file = event.target.files[0];
                if (!file) return;

                const reader = new FileReader();

                reader.onload = (e) => {
                    try {
                        const data = new Uint8Array(e.target.result);
                        const workbook = XLSX.read(data, {
                            type: "array"
                        });

                        const sheet = workbook.Sheets[workbook.SheetNames[0]];
                        const jsonData = XLSX.utils.sheet_to_json(sheet);

                        if (jsonData.length === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'File Excel kosong!',
                                width: '340px',
                                confirmButtonColor: '#ef4444',
                                customClass: {
                                    popup: 'rounded-3xl shadow-xl',
                                    title: 'text-lg font-bold'
                                }
                            });
                            return;
                        }

                        // =========================
                        // 🔥 VALIDASI GLOBAL
                        // =========================

                        const allowedSubtes = [
                            "Penalaran Umum",
                            "Penalaran & Pemahaman Umum",
                            "Pemahaman Bacaan & Menulis",
                            "Pengetahuan Kuantitatif",
                            "Penalaran Matematika",
                            "Literasi Bahasa Indonesia",
                            "Literasi Bahasa Inggris"
                        ];

                        const globalSubtes = (jsonData[0]["Kategori Subtes"] || "").trim();
                        const globalWaktu = (jsonData[0]["Waktu"] || "").toString().trim();

                        if (!allowedSubtes.includes(globalSubtes)) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Subtes tidak valid!',
                                width: '340px',
                                confirmButtonColor: '#ef4444',
                                customClass: {
                                    popup: 'rounded-3xl shadow-xl',
                                    title: 'text-lg font-bold'
                                }
                            });
                            return;
                        }

                        const allowedWaktu = [
                            "20 Menit", "25 Menit", "30 Menit",
                            "35 Menit", "40 Menit", "45 Menit",
                            "50 Menit", "55 Menit", "60 Menit"
                        ];

                        if (!allowedWaktu.includes(globalWaktu)) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Waktu harus 20 - 60 menit!',
                                width: '340px',
                                confirmButtonColor: '#ef4444',
                                customClass: {
                                    popup: 'rounded-3xl shadow-xl',
                                    title: 'text-lg font-bold'
                                }
                            });
                            return;
                        }

                        const waktuAngka = parseInt(globalWaktu.replace(" Menit", ""));

                        // =========================
                        // 🔥 VALIDASI PER BARIS
                        // =========================
                        for (let i = 0; i < jsonData.length; i++) {
                            let row = jsonData[i];
                            let jawaban = (row["Jawaban Benar"] || "").toString().trim();

                            if (!['a', 'b', 'c', 'd', 'e'].includes(jawaban)) {
                                Swal.fire({
                                    icon: 'error',
                                    title: `Error di baris ${i + 2}`,
                                    text: 'Jawaban harus a/b/c/d/e',
                                    width: '340px',
                                    confirmButtonColor: '#ef4444',
                                    customClass: {
                                        popup: 'rounded-3xl shadow-xl',
                                        title: 'text-lg font-bold'
                                    }
                                });
                                return;
                            }

                            if (jawaban !== jawaban.toLowerCase()) {
                                Swal.fire({
                                    icon: 'error',
                                    title: `Error di baris ${i + 2}`,
                                    text: 'Gunakan huruf kecil!',
                                    width: '340px',
                                    confirmButtonColor: '#ef4444',
                                    customClass: {
                                        popup: 'rounded-3xl shadow-xl',
                                        title: 'text-lg font-bold'
                                    }
                                });
                                return;
                            }
                        }

                        // =========================
                        // ✅ MAPPING DATA
                        // =========================
                        this.selectedSubtes = globalSubtes;
                        this.selectedWaktu = waktuAngka;

                        this.questions = jsonData.slice(0, 20).map((row) => ({
                            subtes: globalSubtes,
                            waktu: waktuAngka,

                            materi: row["Materi"] || "",
                            pertanyaan: row["Pertanyaan"] || "",

                            gambar: (row["URL Gambar"] || "").startsWith("http") ?
                                row["URL Gambar"] : null,

                            opsi_a: row["Opsi A"] || "",
                            opsi_b: row["Opsi B"] || "",
                            opsi_c: row["Opsi C"] || "",
                            opsi_d: row["Opsi D"] || "",
                            opsi_e: row["Opsi E"] || "",

                            jawaban_benar: (row["Jawaban Benar"] || "").toLowerCase().trim(),
                        }));

                        this.soalTersimpan = this.questions.length;
                        this.activeQuestion = 1;
                        this.loadQuestion();

                        this.showImportModal = false;

                        // ✅ SUCCESS
                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil diimport',
                            width: '340px',
                            padding: '1.8rem',
                            confirmButtonColor: '#4A72D4',
                            customClass: {
                                popup: 'rounded-3xl shadow-xl',
                                title: 'text-lg font-bold',
                                confirmButton: 'rounded-xl px-6 py-2'
                            }
                        });

                    } catch (err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Data Gagal Tersimpan!',
                            width: '340px',
                            confirmButtonColor: '#ef4444',
                            customClass: {
                                popup: 'rounded-3xl shadow-xl',
                                title: 'text-lg font-bold'
                            }
                        });
                    }
                };

                reader.readAsArrayBuffer(file);
            },

            unduhTemplate() {
                const wb = XLSX.utils.book_new();

                const data = [
                    [
                        "Kategori Subtes",
                        "Waktu",
                        "Materi",
                        "Pertanyaan",
                        "URL Gambar",
                        "Opsi A",
                        "Opsi B",
                        "Opsi C",
                        "Opsi D",
                        "Opsi E",
                        "Jawaban Benar"
                    ],
                    [
                        "Penalaran Umum",
                        "20 Menit",
                        "Teks bacaan...",
                        "Apa ibukota Indonesia?",
                        "https://contoh.com/gambar.jpg",
                        "Jakarta",
                        "Bandung",
                        "Surabaya",
                        "Medan",
                        "Bali",
                        "a"
                    ]
                ];

                const ws = XLSX.utils.aoa_to_sheet(data);
                XLSX.utils.book_append_sheet(wb, ws, "Template");

                XLSX.writeFile(wb, "TEMPLATE_SOAL_KUIS.xlsx");
            },






            simpanSoal() {

                this.autoSaveSoal();
                this.saveToLocal(); // 🔥 tetap jalan

                // ==========================
                // RESET ERROR
                // ==========================
                this.errors = {
                    subtes: '',
                    pertanyaan: '',
                    opsi: ['', '', '', '', ''],
                    benar: ''
                };

                let valid = true;

                // ==========================
                // VALIDASI
                // ==========================
                if (!this.selectedSubtes) {
                    this.errors.subtes = "Subtes wajib dipilih!";
                    valid = false;
                }

                if (this.currentQuestion.pertanyaan.trim() === '') {
                    this.errors.pertanyaan = "Pertanyaan wajib diisi!";
                    valid = false;
                }

                for (let i = 0; i < this.currentQuestion.opsi.length; i++) {
                    if (!this.currentQuestion.opsi[i] || this.currentQuestion.opsi[i].trim() === '') {
                        this.errors.opsi[i] = `Opsi ${['A','B','C','D','E'][i]} wajib diisi!`;
                        valid = false;
                    }
                }

                if (this.currentQuestion.benar === null) {
                    this.errors.benar = "Pilih jawaban benar!";
                    valid = false;
                }

                // ❌ STOP kalau ada error
                if (!valid) {
                    return;
                }

                // ==========================
                // SIMPAN DATA
                // ==========================
                let index = this.activeQuestion - 1;

                this.questions[index] = {
                    subtes: this.selectedSubtes,
                    waktu: this.selectedWaktu,

                    materi: this.currentQuestion.materi,
                    gambar: this.currentQuestion.gambar,

                    pertanyaan: this.currentQuestion.pertanyaan,

                    opsi_a: this.currentQuestion.opsi[0],
                    opsi_b: this.currentQuestion.opsi[1],
                    opsi_c: this.currentQuestion.opsi[2],
                    opsi_d: this.currentQuestion.opsi[3],
                    opsi_e: this.currentQuestion.opsi[4],

                    jawaban_benar: ['a', 'b', 'c', 'd', 'e'][this.currentQuestion.benar],
                };

                this.soalTersimpan = this.questions.filter(q => q).length;

                // ==========================
                // PINDAH SOAL
                // ==========================
                if (this.activeQuestion < 20) {
                    this.activeQuestion++;
                    this.loadQuestion();
                }

                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            },


            loadQuestion() {

                let index = this.activeQuestion - 1;



                if (this.questions[index]) {
                    let q = this.questions[index];

                    this.selectedSubtes = q.subtes;
                    this.selectedWaktu = q.waktu;

                    this.currentQuestion = {
                        materi: q.materi,
                        gambar: q.gambar,
                        pertanyaan: q.pertanyaan,
                        opsi: [q.opsi_a, q.opsi_b, q.opsi_c, q.opsi_d, q.opsi_e],
                        benar: ['a', 'b', 'c', 'd', 'e'].indexOf(q.jawaban_benar),
                    };

                } else {

                    this.currentQuestion = {
                        materi: '',
                        gambar: null,
                        pertanyaan: '',
                        opsi: ['', '', '', '', ''],
                        benar: null,
                    };

                }

            },



            submitFinal() {

                let totalTerisi = this.questions.filter(q => q).length;

                if (totalTerisi < 20) {
                    alert("Wajib isi 20 soal sebelum publish!");
                    return;
                }

                console.log("DATA SOAL FULL:", this.questions);
                console.log("GAMBAR SOAL 1:", this.questions[0].gambar);

                document.getElementById("questions_json").value =
                    JSON.stringify(this.questions);

                document.getElementById("kuisForm").submit();
            }
        }
    }

    function PageGuard() {

        return {

            allowLeave: false,

            init() {

                history.pushState({
                    page: 1
                }, "", location.href);
                history.pushState({
                    page: 2
                }, "", location.href);

                window.addEventListener("popstate", () => {

                    if (!this.allowLeave) {
                        this.confirmLeave();
                        history.pushState({
                            page: 2
                        }, "", location.href);
                    }

                });

                window.addEventListener('beforeunload', () => {
                    localStorage.removeItem('kuis_draft');
                });



            },

            confirmLeave() {

                Swal.fire({
                    title: 'Yakin ingin keluar?',
                    text: 'Perubahan kuis yang belum disimpan akan hilang.',
                    icon: 'warning',
                    width: '340px',
                    padding: '1.8rem',
                    showCancelButton: true,
                    confirmButtonColor: '#4A72D4',
                    cancelButtonColor: '#E5E7EB',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya, keluar',
                    customClass: {
                        popup: 'rounded-3xl shadow-xl',
                        title: 'text-lg font-bold text-gray-800',
                        htmlContainer: 'text-sm text-gray-500',
                        confirmButton: 'rounded-xl px-5 py-2',
                        cancelButton: 'rounded-xl px-5 py-2'
                    }
                }).then((result) => {

                    if (result.isConfirmed) {

                        this.allowLeave = true;
                        window.location.href = "{{ route('admin.kuis.index') }}";

                    }

                });

            }

        }

    }
</script>



<body class="bg-[#E9EFFF] h-screen overflow-hidden text-[#2D3B61]" x-data="{ ...PageGuard(), ...kuisForm() }" x-init="init();
loadFromLocal()"
    x-effect="saveToLocal()">

    <div class="flex h-screen w-full relative">
        <aside x-init="if (currentPage === 'kuis') { $el.scrollIntoView({ block: 'center' }) }" :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
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
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen tryout</span>
                </a>

                <a href="{{ route('admin.kuis.index') }}" x-init="if (currentPage === 'kuis') { $el.scrollIntoView({ block: 'center' }) }"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7]  text-[#2E3B66] transition-all duration-200 group text-left">
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
                    <span class="text-md font-regular">Manajemen latihan soal</span>
                </a>

                <a href="{{ route('admin.videoPembelajaran.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-9">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen video pembelajaran</span>
                </a>

                <a href="{{ route('admin.minatBakat.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                    </svg>
                    <span class="text-md font-regular">Manajemen minat bakat</span>
                </a>



                <a href="{{ route('admin.peluang.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen peluang PTN</span>
                </a>

                <a href="{{ route('admin.laporan.index') }}"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                    </svg>
                    <span class="text-md font-regular">Monitoring dan laporan</span>
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

        <div x-show="mobileMenuOpen" x-transition:enter="transition opacity-ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition opacity-ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="mobileMenuOpen = false"
            class="fixed inset-0 bg-black/50 z-40 lg:hidden">
        </div>

        <main class="flex-1 flex flex-col min-w-0 h-full overflow-y-auto custom-scrollbar p-4 lg:p-8">
            <header class="flex flex-col lg:flex-row lg:items-center justify-between pb-4 gap-4 flex-shrink-0 w-full">
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

            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-extrabold text-[#4A72D4]">
                        Kuis Fundamental - Set <span x-text="currentSet">1</span>
                    </h2>
                    <p class="text-gray-400 text-sm">Persisten Admin Panel / Kuis</p>
                </div>

                <div class="flex flex-wrap gap-3 w-full lg:w-auto">


                    <button @click="showImportModal = true"
                        class="flex-1 lg:flex-none flex items-center justify-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-semibold text-sm transition-all shadow-md active:scale-95">
                        <i class="fa-solid fa-file-excel text-lg"></i> Import via Excel
                    </button>

                    <a href="{{ route('admin.kuis.index') }}" @click.prevent="confirmLeave()"
                        class="px-5 py-3.5 rounded-xl border items-center justify-center  border-gray-200 text-gray-600 bg-white font-bold text-sm hover:bg-gray-50 transition-all">
                        Batal
                    </a>
                </div>


            </div>

            <div class="flex-1 flex flex-col min-w-0 h-full overflow-y-auto custom-scrollbar pb-4 lg:pb-8">
                <div x-show="activeMenu === 'Manajemen Kuis'" x-transition>


                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                        <div class="lg:col-span-2 space-y-6">
                            <div class="bg-white rounded-xl p-6 lg:p-10 shadow-sm border border-blue-50">
                                <div class="flex items-center justify-between mb-10">
                                    <div class="flex items-center gap-4">
                                        <div class="p-3 bg-blue-50 rounded-2xl text-[#4A72D4]">
                                            <i class="fa-solid fa-pen-nib text-xl"></i>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-800">Input Soal Nomor <span
                                                x-text="activeQuestion"></span></h3>
                                    </div>
                                </div>

                                <form id="kuisForm" action="{{ route('admin.kuis.store') }}"
                                    @submit="allowLeave = true" method="POST" class="space-y-8">


                                    @csrf

                                    <input type="hidden" name="set" :value="currentSet">
                                    <input type="hidden" name="durasi" :value="selectedWaktu">

                                    <!-- Semua soal dikirim dalam JSON -->
                                    <input type="hidden" name="questions_json" id="questions_json">



                                    <div class="grid grid-cols-1 md:flex md:items-stretch gap-4 mb-8">

                                        {{-- Subtes --}}
                                        <div class="flex-1 min-w-0 flex flex-col gap-2" x-data="{ open: false }"
                                            @click.away="open = false">
                                            <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Kategori
                                                Subtes</label>
                                            <div
                                                class="bg-white px-4 py-3 rounded-2xl shadow-sm border border-blue-50 flex items-center relative h-full">
                                                <button type="button" @click="open = !open"
                                                    class="w-full flex items-center justify-between text-sm font-bold text-[#4A72D4] focus:outline-none">
                                                    <span x-text="selectedSubtes || 'Pilih Subtes'"
                                                        class="truncate"></span>
                                                    <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200"
                                                        :class="open ? 'rotate-180' : ''"></i>
                                                </button>
                                                <div x-show="open" x-transition
                                                    class="absolute z-50 w-full mt-2 top-full left-0 bg-white border border-blue-50 shadow-xl rounded-2xl overflow-hidden py-2">
                                                    <template
                                                        x-for="item in [
                                                        'Penalaran Umum',
                                                        'Penalaran & Pemahaman Umum',
                                                        'Pemahaman Bacaan & Menulis',
                                                        'Pengetahuan Kuantitatif',
                                                        'Penalaran Matematika',
                                                        'Literasi Bahasa Indonesia',
                                                        'Literasi Bahasa Inggris'
                                                        ]">
                                                        <div @click="selectedSubtes = item; open = false"
                                                            class="px-4 py-3 text-sm text-gray-600 hover:bg-blue-50 hover:text-[#4A72D4] cursor-pointer transition-colors font-medium"
                                                            x-text="item"></div>
                                                    </template>
                                                </div>
                                                <input type="hidden" name="kategori" :value="selectedSubtes">

                                            </div>
                                        </div>

                                        {{-- Set --}}
                                        <div class="w-full md:w-32 flex flex-col gap-2">
                                            <label
                                                class="text-[10px] font-bold text-gray-400 uppercase ml-1">Set</label>
                                            <div
                                                class="bg-gray-50 px-4 py-3 rounded-2xl border border-gray-100 flex items-center h-full">
                                                <span class="text-sm font-bold text-[#4A72D4]"
                                                    x-text="'Set ' + currentSet"></span>
                                            </div>
                                        </div>

                                        {{-- Waktu --}}
                                        <div class="w-full md:w-48 flex flex-col gap-2" x-data="{ open: false }"
                                            @click.away="open = false">
                                            <label
                                                class="text-[10px] font-bold text-gray-400 uppercase ml-1">Waktu</label>
                                            <div
                                                class="bg-white px-4 py-3 rounded-2xl shadow-sm border border-blue-50 flex items-center gap-2 relative h-full">
                                                <i class="fa-solid fa-stopwatch text-orange-400 text-sm"></i>
                                                <button type="button" @click="open = !open"
                                                    class="w-full flex items-center justify-between text-sm font-bold text-gray-700 focus:outline-none">
                                                    <span x-text="selectedWaktu + ' Menit'"></span>
                                                    <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 transition-transform duration-200"
                                                        :class="open ? 'rotate-180' : ''"></i>
                                                </button>
                                                <div x-show="open" x-transition
                                                    class="absolute z-50 w-full mt-2 top-full left-0 bg-white border border-blue-50 shadow-xl rounded-2xl overflow-hidden py-2">
                                                    <template x-for="t in [20,25,30,35,40,45,50,55,60]">
                                                        <div @click="selectedWaktu = t; open = false"
                                                            class="px-4 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-[#4A72D4] cursor-pointer transition-colors font-medium"
                                                            x-text="t + ' Menit'"></div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p x-show="errors.subtes" class="text-red-500 text-xs mt-1"
                                        x-text="errors.subtes"></p>

                                    <div class="space-y-6">

                                        <div class="space-y-2">
                                            <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Materi
                                                atau Teks (Opsional)</label>

                                            <div class="relative group">
                                                <textarea x-model="currentQuestion.materi" name="materi" x-data="{
                                                    resize() {
                                                        $el.style.height = 'auto';
                                                        $el.style.height = ($el.scrollHeight < 120 ? 120 : $el.scrollHeight) + 'px';
                                                    }
                                                }" x-init="resize()"
                                                    @input="resize()"
                                                    class="w-full bg-gray-50 border-none rounded-[25px] p-6 text-sm 
           focus:bg-white focus:ring-2 focus:ring-blue-100 
           outline-none shadow-inner transition-all 
           resize-none overflow-hidden leading-relaxed"
                                                    placeholder="Masukkan teks soal di sini..." style="min-height:120px;">
</textarea>


                                                <div class="absolute right-4 bottom-4">
                                                    <label
                                                        class="flex items-center gap-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full shadow-sm border border-gray-100 cursor-pointer hover:bg-blue-50 hover:border-blue-200 transition-all">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-4 w-4 text-blue-500" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        <span
                                                            class="text-[10px] font-bold text-blue-600 uppercase">Tambah
                                                            Foto</span>
                                                        <input type="file" x-ref="imageInput" class="hidden"
                                                            accept="image/png,image/jpeg,image/jpg,image/webp"
                                                            @change="uploadGambar($event)">
                                                    </label>
                                                </div>
                                            </div>

                                            @if (session('error'))
                                                <div class="bg-red-500 text-white p-3 rounded mb-3">
                                                    {{ session('error') }}
                                                </div>
                                            @endif

                                            <template x-if="currentQuestion.gambar !== null">
                                                <div class="relative mt-3 inline-block">
                                                    <img :src="currentQuestion.gambar" referrerpolicy="no-referrer"
                                                        class="max-h-48 rounded-2xl border-2 border-white shadow-sm ring-1 ring-gray-100">
                                                    <button @click="currentQuestion.gambar = null"
                                                        class="absolute -top-2 -right-2 bg-red-500 text-white p-1 rounded-full hover:scale-110 transition-all shadow-md">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </template>
                                        </div>

                                        <div class="space-y-2">
                                            <label
                                                class="text-[10px] font-bold text-gray-400 uppercase ml-1">Pertanyaan</label>
                                            <textarea x-model="currentQuestion.pertanyaan" required x-data="{
                                                resize() {
                                                    $el.style.height = 'auto';
                                                    $el.style.height = ($el.scrollHeight < 120 ? 120 : $el.scrollHeight) + 'px';
                                                }
                                            }" x-init="resize()"
                                                @input="resize()"
                                                class="w-full bg-gray-50 border-none rounded-[25px] p-6 text-sm focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none shadow-inner transition-all overflow-hidden resize-none"
                                                placeholder="Masukkan teks pertanyaan di sini..." style="min-height: 120px;"></textarea>
                                        </div>
                                        <p x-show="errors.pertanyaan" class="text-red-500 text-xs mt-1"
                                            x-text="errors.pertanyaan"></p>


                                        <div class="grid grid-cols-1 gap-4">
                                            <template x-for="(opt, i) in ['a','b','c','d','e']">
                                                <div :class="currentQuestion.benar === i ?
                                                    'bg-emerald-50 border-emerald-200' :
                                                    'bg-gray-50 border-transparent'"
                                                    class="flex items-start gap-4 p-4 rounded-2xl border-2 transition-all">

                                                    <!-- Label A B C -->
                                                    <span
                                                        class="w-10 h-10 flex items-center justify-center bg-white rounded-xl shadow-sm font-black text-[#4A72D4]"
                                                        x-text="opt"></span>

                                                    <!-- Textarea Jawaban Auto Resize -->
                                                    <textarea x-model="currentQuestion.opsi[i]" x-data="{
                                                        resize() {
                                                            $el.style.height = 'auto';
                                                            $el.style.height = ($el.scrollHeight < 60 ? 60 : $el.scrollHeight) + 'px';
                                                        }
                                                    }" x-init="resize()" @input="resize()"
                                                        class="flex-1 bg-transparent border-none outline-none text-sm font-medium resize-none overflow-hidden leading-relaxed"
                                                        placeholder="Tulis jawaban di sini..." style="min-height:60px;"></textarea>
                                                    <p x-show="errors.opsi[i]" class="text-red-500 text-xs mt-1"
                                                        x-text="errors.opsi[i]"></p>

                                                    <!-- Radio Button -->
                                                    <input type="radio" @click="currentQuestion.benar = i"
                                                        :checked="currentQuestion.benar === i"
                                                        class="w-5 h-5 mt-3 accent-emerald-500 cursor-pointer">

                                                </div>
                                            </template>
                                        </div>
                                        <p x-show="errors.benar" class="text-red-500 text-xs mt-2"
                                            x-text="errors.benar"></p>

                                    </div>

                                    <div
                                        class="flex flex-col md:flex-row items-center justify-between gap-4 pt-6 border-t border-gray-100 mt-6">
                                        <p
                                            class="text-[10px] text-gray-400 text-center md:text-left order-2 md:order-1">
                                            Klik "Simpan" untuk mengunci jawaban nomor ini.
                                        </p>

                                        <div class="flex items-center gap-2 w-full md:w-auto order-1 md:order-2">
                                            <button type="button"
                                                @click="currentQuestion = {
                                                        materi: '',
                                                        gambar: null,
                                                        pertanyaan: '',
                                                        opsi: ['', '', '', '', ''],
                                                        benar: null
                                                    }"
                                                class="px-4 py-2 text-sm font-bold text-gray-400 hover:text-red-400">
                                                Reset
                                            </button>

                                            <button type="button" @click="simpanSoal()"
                                                :disabled="soalTersimpan >= 20"
                                                class="flex-1 md:flex-none bg-[#4A72D4] text-white px-8 py-3 rounded-xl font-bold text-sm shadow-lg">
                                                <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Soal
                                            </button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-50">
                                <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-6">
                                    Navigasi Soal</h4>

                                <div class="grid grid-cols-5 gap-3">
                                    <template x-for="n in 20">
                                        <button
                                            @click="
autoSaveSoal();
saveToLocal(); // 🔥 TAMBAH INI
activeQuestion = n;
loadQuestion();
window.scrollTo({top:0,behavior:'smooth'})"
                                            :class="{
                                                'bg-blue-500 text-white': activeQuestion === n,
                                                'bg-emerald-500 text-white': questions[n - 1]?.pertanyaan,
                                                'bg-gray-50 text-gray-400': !questions[n - 1]?.pertanyaan
                                            }"
                                            class="aspect-square rounded-xl border-2 flex items-center justify-center font-bold text-xs transition-all hover:scale-110">
                                            <span x-text="n"></span>
                                        </button>

                                    </template>
                                </div>

                                <div class="mt-8 space-y-3 pt-6 border-t border-gray-50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                                        <span class="text-[10px] font-bold text-gray-500 uppercase">Terisi</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 bg-[#4A72D4] rounded-full"></div>
                                        <span class="text-[10px] font-bold text-gray-500 uppercase">Aktif</span>
                                    </div>
                                </div>

                                <button type="button" @click="openPublishModal()"
                                    :disabled="questions.filter(q => q?.pertanyaan).length < 20"
                                    class="w-full mt-6 bg-emerald-500 text-white py-3 rounded-xl font-bold disabled:opacity-40 disabled:cursor-not-allowed">
                                    Publikasikan Kuis
                                </button>




                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </div>

    <div x-show="showImportModal" x-cloak class="fixed inset-0 z-[100] overflow-y-auto">

        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" @click="showImportModal = false">
        </div>

        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-white w-full max-w-lg rounded-[35px] shadow-2xl p-8 transform transition-all"
                x-show="showImportModal" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-8"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-3">
                        <i class="fa-solid fa-video text-emerald-500"></i> Import Soal dari Excel
                    </h3>
                    <button @click="showImportModal = false"
                        class="text-gray-400 hover:text-red-500 transition-colors">
                        <i class="fa-solid fa-circle-xmark text-2xl"></i>
                    </button>
                </div>

                <div
                    class="border-4 border-dashed border-gray-100 rounded-[25px] p-10 flex flex-col items-center justify-center group hover:border-emerald-300 transition-all bg-gray-50/50">
                    <div
                        class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-cloud-arrow-up text-3xl text-emerald-500"></i>
                    </div>
                    <p class="text-sm font-bold text-gray-600">Klik di sini</p>
                    <p class="text-[10px] text-gray-400 mt-2">Maksimal ukuran file: 100MB (.xlsx, .xls)</p>

                    <input type="file" class="hidden" x-ref="videoExcelInput" @change="importExcel($event)"
                        accept=".xlsx,.xls">
                    <button @click="$refs.videoExcelInput.click()"
                        class="mt-6 px-6 py-2 bg-emerald-500 text-white rounded-xl text-xs font-bold hover:bg-emerald-600 transition-all">
                        Pilih File
                    </button>
                </div>

                <div class="mt-8 p-4 bg-emerald-50 rounded-2xl flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-info text-emerald-500"></i>
                        <span class="text-[11px] font-bold text-emerald-700 uppercase tracking-tight">Belum punya
                            formatnya?</span>
                    </div>
                    <button @click="unduhTemplate()"
                        class="text-[11px] font-black text-emerald-600 hover:underline cursor-pointer uppercase">
                        Unduh Template Excel
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

    {{-- MODAL KONFIRM PUBLIKASI --}}
    <div x-show="showPublishModal" x-cloak class="fixed inset-0 z-[180] flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="showPublishModal = false"></div>

        <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full relative z-[181] text-center shadow-2xl border border-blue-50"
            x-show="showPublishModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">

            <div
                class="w-20 h-20 bg-blue-100 text-[#4A72D4] rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>

            <h3 class="text-xl font-black text-[#2E3B66] mb-2">Publikasikan Kuis?</h3>
            <p class="text-gray-500 text-sm mb-8">Pastikan semua data sudah benar. Kuis yang dipublikasikan akan
                langsung dapat diakses.</p>

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
