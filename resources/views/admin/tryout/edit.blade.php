<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persisten Dashboard - Edit Tryout</title>
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

<body class="bg-[#E9EFFF] h-screen overflow-hidden text-[#2D3B61]" x-data="editTryoutForm()">

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

            <nav
                class="flex-1 space-y-1 overflow-y-auto pr-2 
                [&::-webkit-scrollbar]:w-1 
                [&::-webkit-scrollbar-track]:bg-transparent 
                [&::-webkit-scrollbar-thumb]:bg-white/20 
                [&::-webkit-scrollbar-thumb]:rounded-full">

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <div
                        class="w-5 h-5 border-2 border-white/50 rounded group-hover:border-white transition-colors shrink-0">
                    </div>
                    <span class="text-md font-regular">Dashboard</span>
                </a>

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl  transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen user</span>
                </a>

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen streak</span>
                </a>

                <a href="#" x-init="if (currentPage === 'tryout') { $el.scrollIntoView({ block: 'center' }) }"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl bg-[#D4DEF7]  text-[#2E3B66] transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen tryout</span>
                </a>

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3  rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen kuis</span>
                </a>

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen latihan
                        soal</span>
                </a>

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen video
                        pembelajaran</span>
                </a>

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen minat
                        bakat</span>
                </a>



                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Manajemen peluang
                        PTN</span>
                </a>

                <a href="#"
                    class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl transition-all duration-200 group text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="text-md font-regular">Monitoring dan
                        laporan</span>
                </a>



            </nav>

            <button
                class="mt-4 w-full flex items-center bg-white/10 hover:bg-white/20 px-6 py-3 rounded-2xl transition-all group border border-white/20 backdrop-blur-sm shrink-0">
                <svg xmlns="http://www.w3.org/2000/xml" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-5 md:size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
                <span class="text-white text-md font-medium tracking-wide ml-4">Logout</span>
            </button>
        </aside>

        <main class="flex-1 flex flex-col h-full overflow-y-auto custom-scrollbar p-4 lg:p-8">
            <form id="formTryout" action="{{ route('admin.tryout.update', $tryout->id) }}" method="POST" @submit.prevent="submitForm">
                @csrf
                @method('PUT')
                
                <input type="hidden" name="nama_tryout" :value="namaTryout">
                <input type="hidden" name="tanggal" :value="tglMulai">
                <input type="hidden" name="tanggal_akhir" :value="tglSelesai">
                <input type="hidden" name="payload_full_data" id="payload_full_data">

                <div x-show="activeSubtesIndex === null" x-transition>
                    <div class="mb-8 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('admin.tryout.index') }}" class="p-3 bg-white rounded-xl text-gray-400 hover:text-red-500 shadow-sm border border-blue-50 transition-all"><i class="fa-solid fa-arrow-left"></i></a>
                            <h2 class="text-2xl font-extrabold text-[#4A72D4]">Panel Edit Tryout</h2>
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
                                    <div class="p-3 rounded-2xl bg-blue-50 text-[#4A72D4]"><i class="fa-solid fa-book-open"></i></div>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase" x-text="'Subtes ' + (index + 1)"></span>
                                </div>
                                <h3 class="font-bold text-gray-800 text-sm" x-text="sub.name"></h3>
                                <div class="flex items-center justify-between mt-4">
                                    <p class="text-[10px] text-gray-400">Terisi: <span class="font-bold text-[#4A72D4]" x-text="sub.soalTerisi"></span>/20</p>
                                    <div class="flex items-center gap-1 text-[10px] font-bold text-orange-500"><i class="fa-solid fa-clock"></i> <span x-text="sub.waktu + 'm'"></span></div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="mt-12 p-8 bg-white rounded-[35px] border-2 border-dashed border-gray-200 flex flex-col items-center">
                        <button type="submit" class="px-16 py-4 bg-[#4A72D4] text-white rounded-2xl font-bold shadow-xl transition-all hover:scale-105">SIMPAN PERUBAHAN</button>
                    </div>
                </div>

                <div x-show="activeSubtesIndex !== null" x-cloak x-transition>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <button type="button" @click="activeSubtesIndex = null" class="p-3 bg-white rounded-xl text-gray-400 hover:text-red-500 shadow-sm border border-blue-50 transition-all"><i class="fa-solid fa-arrow-left"></i></button>
                            <h2 class="text-xl font-extrabold text-[#4A72D4]" x-text="subtesList[activeSubtesIndex]?.name"></h2>
                        </div>
                        <div class="bg-white px-4 py-2 rounded-xl shadow-sm border flex items-center gap-3">
                            <label class="text-[10px] font-bold text-gray-400 uppercase">Waktu (m)</label>
                            <input type="number" x-model="subtesList[activeSubtesIndex].waktu" class="w-12 bg-gray-50 rounded-lg p-2 text-sm font-bold text-[#4A72D4] outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 space-y-6">
                            <div class="bg-white rounded-[30px] p-8 shadow-sm border border-blue-50">
                                <div class="space-y-6">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Materi / Teks</label>
                                        <textarea id="materi_teks" class="w-full bg-gray-50 border-none rounded-[25px] p-6 text-sm outline-none min-h-[100px]"></textarea>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Pertanyaan Nomor <span x-text="activeQuestion"></span> *</label>
                                        <textarea id="pertanyaan_teks" class="w-full bg-gray-50 rounded-[25px] p-6 text-sm outline-none min-h-[80px]"></textarea>
                                    </div>
                                    <div class="grid grid-cols-1 gap-4">
                                        <template x-for="opt in ['A','B','C','D','E']">
                                            <div class="flex items-center gap-4 p-4 rounded-2xl bg-gray-50">
                                                <span class="w-10 h-10 shrink-0 flex items-center justify-center bg-white rounded-xl shadow-sm font-black text-[#4A72D4]" x-text="opt"></span>
                                                <input type="text" :id="'opt_'+opt.toLowerCase()" placeholder="Isi opsi..." class="flex-1 bg-transparent border-none outline-none text-sm font-bold">
                                                <input type="radio" name="correct_option" :value="opt" class="w-5 h-5 accent-emerald-500">
                                            </div>
                                        </template>
                                    </div>
                                    <div class="pt-6 border-t">
                                        <label class="text-[10px] font-bold text-orange-500 uppercase ml-1">Pembahasan *</label>
                                        <textarea id="pembahasan_teks" class="w-full bg-orange-50/30 rounded-[25px] p-6 text-sm outline-none min-h-[80px]"></textarea>
                                    </div>
                                </div>
                                <div class="flex justify-end mt-8">
                                    <button type="button" @click="simpanSoal()" class="bg-[#4A72D4] text-white px-10 py-4 rounded-2xl font-bold text-sm shadow-lg">SIMPAN SOAL</button>
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-1">
                            <div class="bg-white p-6 rounded-[30px] shadow-sm border border-blue-50 text-center sticky top-8">
                                <h4 class="text-[10px] font-bold text-gray-400 uppercase mb-6 tracking-widest">Navigasi Soal</h4>
                                <div class="grid grid-cols-4 gap-2 mb-8">
                                    <template x-for="n in 20">
                                        <button type="button" @click="activeQuestion = n; loadQuestion()" 
                                            :class="activeQuestion === n ? 'bg-[#4A72D4] text-white' : (subtesList[activeSubtesIndex]?.questions[n-1] ? 'bg-emerald-500 text-white' : 'bg-gray-50 text-gray-400')" 
                                            class="aspect-square rounded-xl flex items-center justify-center font-bold text-[10px] transition-all" x-text="n"></button>
                                    </template>
                                </div>
                                <button type="button" @click="activeSubtesIndex = null" class="w-full py-4 bg-emerald-500 text-white rounded-2xl font-black text-[10px] uppercase">Selesai Kelola</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <script>
        function editTryoutForm() {
            return {
                activeSubtesIndex: null,
                activeQuestion: 1,
                imageUrl: null,
                showImageModal: false,
                tempImageUrl: '',
                namaTryout: {!! json_encode($tryout->nama_tryout) !!},
                tglMulai: {!! json_encode($tryout->tanggal->format('Y-m-d')) !!},
                tglSelesai: {!! json_encode($tryout->tanggal_akhir ? $tryout->tanggal_akhir->format('Y-m-d') : '') !!},
                subtesList: {!! json_encode($tryout->categories->map(function($cat) {
                    return [
                        'name' => $cat->nama_kategori,
                        'waktu' => (int) $cat->durasi,
                        'soalTerisi' => $cat->soals->count(),
                        'questions' => $cat->soals->map(function($s) {
                            return [
                                'pertanyaan' => $s->pertanyaan ?? '',
                                'opsi_a' => $s->opsi_a ?? '',
                                'opsi_b' => $s->opsi_b ?? '',
                                'opsi_c' => $s->opsi_c ?? '',
                                'opsi_d' => $s->opsi_d ?? '',
                                'opsi_e' => $s->opsi_e ?? '',
                                'jawaban_benar' => $s->jawaban_benar ?? '',
                                'pembahasan' => $s->pembahasan ?? '',
                                'materi_teks' => $s->materi_teks ?? '',
                            ];
                        })->toArray()
                    ];
                })) !!},

                selectSubtes(index) {
                    this.activeSubtesIndex = index;
                    this.activeQuestion = 1;
                    this.$nextTick(() => { this.loadQuestion(); });
                },

                simpanSoal() {
                    let current = this.subtesList[this.activeSubtesIndex];
                    const jaw = document.querySelector('input[name="correct_option"]:checked');
                    
                    current.questions[this.activeQuestion - 1] = {
                        materi_teks: document.getElementById('materi_teks').value,
                        pertanyaan: document.getElementById('pertanyaan_teks').value,
                        opsi_a: document.getElementById('opt_a').value,
                        opsi_b: document.getElementById('opt_b').value,
                        opsi_c: document.getElementById('opt_c').value,
                        opsi_d: document.getElementById('opt_d').value,
                        opsi_e: document.getElementById('opt_e').value,
                        jawaban_benar: jaw ? jaw.value : '',
                        pembahasan: document.getElementById('pembahasan_teks').value,
                    };
                    current.soalTerisi = current.questions.filter(x => x && x.pertanyaan).length;
                    alert('Soal nomor ' + this.activeQuestion + ' tersimpan sementara.');
                },

                loadQuestion() {
                    let data = this.subtesList[this.activeSubtesIndex].questions[this.activeQuestion - 1];
                    if (data) {
                        document.getElementById('materi_teks').value = data.materi_teks || '';
                        document.getElementById('pertanyaan_teks').value = data.pertanyaan || '';
                        document.getElementById('opt_a').value = data.opsi_a || '';
                        document.getElementById('opt_b').value = data.opsi_b || '';
                        document.getElementById('opt_c').value = data.opsi_c || '';
                        document.getElementById('opt_d').value = data.opsi_d || '';
                        document.getElementById('opt_e').value = data.opsi_e || '';
                        document.getElementById('pembahasan_teks').value = data.pembahasan || '';
                        document.getElementsByName('correct_option').forEach(r => r.checked = (r.value === data.jawaban_benar));
                    } else {
                        ['materi_teks','pertanyaan_teks','opt_a','opt_b','opt_c','opt_d','opt_e','pembahasan_teks'].forEach(id => document.getElementById(id).value = '');
                        document.getElementsByName('correct_option').forEach(r => r.checked = false);
                    }
                },

                submitForm() {
                    // PENTING: Masukkan data ke input hidden sebelum submit
                    document.getElementById('payload_full_data').value = JSON.stringify(this.subtesList);
                    document.getElementById('formTryout').submit();
                }
            }
        }
    </script>
</body>
</html>