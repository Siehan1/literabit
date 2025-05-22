<x-dashboardComponent.admin>

    <a href="{{ route('missionTemplate.index') }}"><i class="bi bi-arrow-left text-4xl hover:text-primary transition-colors duration-200"></i></a>

    {{-- Tambahkan bagian untuk menampilkan error validasi jika ada --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5">
                    @foreach ($errors->all() as $error)
                        <i class="bi bi-exclamation-triangle-fill text-red-700 "></i>
                        <span>{{ $error }}</span>
                    @endforeach
                </div>
            @endif

    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">
            <h2 class="text-2xl font-bold text-primary mb-8 text-center">Buat Template Misi Baru</h2>


            <form action="{{ route('missionTemplate.store') }}" method="POST" class="space-y-6">
                @csrf 

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Nama Misi --}}
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-teks">Nama Misi: <span class="text-red-500">*</span></label>
                        <select id="type" name="type" class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200" required>
                            <option value="" disabled selected>Pilih jenis misi</option>
                            <option value="read">Membaca</option>
                            <option value="quiz">Kuis</option>
                        </select>
                    </div>

                    {{-- Poin --}}
                    <div class="space-y-2">
                        <label for="points" class="block text-sm font-medium text-teks">Poin: <span class="text-red-500">*</span></label>
                        <input type="number" id="points" name="xp_reward" class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200" required>
                    </div>

                    {{-- Target Misi --}}
                    <div class="space-y-2">
                        <label for="target" class="block text-sm font-medium text-teks">Target: <span class="text-red-500">*</span></label>
                        <input type="number" id="target" name="jumlah_target" class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200" required>
                    </div>
                </div>

                {{-- Deskripsi (ambil lebar penuh) --}}
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-teks">Deskripsi: <span class="text-red-500">*</span></label>
                    <textarea id="description" name="deskripsi" rows="4" class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200" required></textarea>
                </div>


                {{-- Tombol Submit dengan styling serupa --}}
                <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-8 py-3 bg-primary text-white rounded-xl font-medium hover:bg-hover transition-all duration-200 shadow-[0px_4px_0px_0px_rgba(201,144,75,1.00)] hover:shadow-[0px_2px_0px_0px_rgba(201,144,75,1.00)] hover:-translate-y-0.5 active:translate-y-0 active:shadow-[0px_0px_0px_0px_rgba(201,144,75,1.00)]">
                        Simpan Template Misi
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboardComponent.admin>