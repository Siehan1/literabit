<x-dashboardComponent.admin>
    <x-slot name="header">Edit Daily Mission</x-slot>

    {{-- Tombol kembali --}}
    <a href="{{ route('tableDaily') }}"><i class="bi bi-arrow-left text-4xl hover:text-primary transition-colors duration-200"></i></a>

    {{-- Tampilkan error validasi --}}
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
            <h2 class="text-2xl font-bold text-primary mb-8 text-center">Edit Daily Mission</h2>

            {{-- Ganti action ke route update daily mission --}}
            <form action="{{ route('updateDaily', $mission->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="flex flex-col gap-6">
                    <div class="flex flex-col md:flex-row gap-6">
                        {{-- Pilih Template Misi --}}
                        <div class="space-y-2 flex-1">
                            <label for="template_id" class="block text-sm font-medium text-teks">Template Misi: <span class="text-red-500">*</span></label>
                            <select id="template_id" name="template_id" class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200" required>
                                <option value="" disabled {{ is_null($mission->template_id) ? 'selected' : '' }}>-- Pilih Template --</option>
                                @foreach ($templates as $template)
                                <option value="{{ $template->id }}" {{ $mission->template_id == $template->id ? 'selected' : '' }}>{{ $template->type }} - {{ $template->deskripsi }}</option>
                            @endforeach
                            </select>
                        </div>

                        {{-- Tanggal Misi --}}
                        <div class="space-y-2 flex-1">
                            <label for="tanggal" class="block text-sm font-medium text-teks">Tanggal: <span class="text-red-500">*</span></label>
                            <input type="date" id="tanggal" name="tanggal" value="{{ $mission->tanggal->format('Y-m-d') }}" class="w-full px-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:ring focus:ring-primary/20 focus:outline-none transition-all duration-200" required>
                        </div>
                    </div>

                    {{-- Status Selesai (Opsional, tergantung kebutuhan) --}}
                    <div class="space-y-2 justify-center">
                        <label for="is_completed" class="block text-sm font-medium text-teks">Status Selesai:</label>
                        <input type="checkbox" id="is_completed" name="is_completed" value="1" {{ $mission->is_completed ? 'checked' : '' }} class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
                        <span class="text-sm text-teks">Tandai sebagai Selesai</span>
                    </div>
                </div>

                {{-- Tombol Submit --}}
                <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-8 py-3 bg-primary text-white rounded-xl font-medium hover:bg-hover transition-all duration-200 shadow-[0px_4px_0px_0px_rgba(201,144,75,1.00)] hover:shadow-[0px_2px_0px_0px_rgba(201,144,75,1.00)] hover:-translate-y-0.5 active:translate-y-0 active:shadow-[0px_0px_0px_0px_rgba(201,144,75,1.00)]">
                        Update Daily Mission
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboardComponent.admin>