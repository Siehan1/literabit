<x-dashboardComponent.admin>

    <a href="{{ route('index.Asignment') }}" class="inline-block mb-6">
        <i class="bi bi-arrow-left text-4xl hover:text-primary transition-colors duration-200"></i>
    </a>

    {{-- Tambahkan bagian untuk menampilkan error validasi jika ada --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5">
            @foreach ($errors->all() as $error)
                <i class="bi bi-exclamation-triangle-fill text-red-700"></i>
                <span>{{ $error }}</span>
            @endforeach
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5">
            <i class="bi bi-check-circle-fill text-green-700"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">
            <h2 class="text-2xl font-bold text-primary mb-8 text-center">Buat Assignment Misi</h2>

            <form action="{{ route('store.Asignment') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Pilih Misi --}}
                    <div class="space-y-2">
                        <label for="daily_id" class="block text-sm font-medium text-teks">Pilih Tanggal Misi: <span
                                class="text-red-500">*</span></label>
                        <select id="daily_id" name="daily_id"
                            class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200"
                            required>
                            <option value="" disabled selected>Pilih Misi Harian</option>
                            @foreach($dailyMissions as $mission)
                                @if($mission->is_completed)
                                    <option value="{{ $mission->id }}" disabled class="text-gray-400 bg-gray-100">
                                        {{ $mission->template->deskripsi }} - {{ $mission->tanggal->format('d M Y') }}
                                        ({{ $mission->template->jumlah_target }} target) - ✅ SELESAI
                                    </option>
                                @else
                                    <option value="{{ $mission->id }}">
                                        {{ $mission->template->deskripsi }} - {{ $mission->tanggal->format('d M Y') }}
                                        ({{ $mission->template->jumlah_target }} target)
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    {{-- Input Judul Baru --}}
                    <div class="space-y-2">
                        <label for="judul" class="block text-sm font-medium text-teks">Judul Assignment: <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="judul" name="judul"
                            class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200"
                            value="{{ old('judul') }}" placeholder="Contoh: membaca 10 buku">
                    </div>


                    {{-- Status --}}
                    <div class="space-y-2">
                        <label for="is_done" class="block text-sm font-medium text-teks">Status Awal: <span
                                class="text-red-500">*</span></label>
                        <select id="is_done" name="is_done"
                            class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200"
                            required>
                            <option value="0">Belum Selesai</option>
                            <option value="1">Selesai</option>
                        </select>
                    </div>

                    {{-- Progress --}}
                    <div class="space-y-2">
                        <label for="jumlah_selesai" class="block text-sm font-medium text-teks">Progress Awal: <span
                                class="text-red-500">*</span></label>
                        <input type="number" id="jumlah_selesai" name="jumlah_selesai" min="0"
                            class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200"
                            required>
                    </div>
                </div>

                {{-- Pilih User (multiple select) --}}
                <div class="space-y-2">
                    <label for="user_ids" class="block text-sm font-medium text-teks">Pilih User: <span
                            class="text-red-500">*</span></label>
                    <select id="user_ids" name="user_ids[]" multiple
                        class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200 h-auto"
                        required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                    <p class="text-sm text-gray-500 mt-1">Gunakan Ctrl/Cmd + klik untuk memilih multiple user</p>
                </div>

                {{-- Tombol Submit --}}
                <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-8 py-3 bg-primary text-white rounded-xl font-medium hover:bg-hover transition-all duration-200 shadow-[0px_4px_0px_0px_rgba(201,144,75,1.00)] hover:shadow-[0px_2px_0px_0px_rgba(201,144,75,1.00)] hover:-translate-y-0.5 active:translate-y-0 active:shadow-[0px_0px_0px_0px_rgba(201,144,75,1.00)]">
                        Buat Assignment
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script untuk mempercantik multiple select --}}
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            // Inisialisasi select2 untuk multiple select
            $(document).ready(function () {
                $('#user_ids').select2({
                    placeholder: "Pilih user",
                    allowClear: true,
                    width: '100%',
                    dropdownParent: $('#user_ids').parent()
                });
            });
        </script>
    @endpush

</x-dashboardComponent.admin>