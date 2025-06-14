<x-dashboardComponent.admin>
    <x-slot name="header">Daftar Kuis</x-slot>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- Tombol Tambah Kuis --}}
    <div class="w-full mb-6 flex justify-center md:justify-end">
        <a href="{{route('kuis.create')}}" class="bg-secondary-600 px-4 py-3 rounded-2xl hover:bg-secondary-800 text-white transition-colors duration-200 text-sm md:text-base w-full sm:w-auto text-center">
            <span class="hidden sm:inline">Tambah Kuis</span>
            <span class="sm:hidden">+ Kuis</span>
        </a>
    </div>

    {{-- Main content area (the card containing the table/cards) --}}
    <div class="bg-white w-full rounded-xl flex flex-col shadow-lg border border-gray-100 overflow-hidden">

        {{-- Header for the card: MOBILE VIEW (centered title) --}}
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-center md:hidden">
            <h3 class="text-xl font-semibold text-gray-800 text-center">Tabel Kuis</h3>
        </div>

        {{-- Header for the card: DESKTOP VIEW (left-aligned title) --}}
        <div class="px-6 py-4 border-b border-gray-200 hidden md:flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Tabel Kuis</h3>
            <div class="flex items-center gap-2">
                {{-- Actions can go here if needed --}}
            </div>
        </div>

        {{-- Table for larger screens (md and up) --}}
        <div class="overflow-x-auto hidden md:block">
            <div class="max-h-[500px] overflow-y-auto">
                <x-dashboardComponent.table>
                    <x-slot name="thead">
                        <thead class="bg-gray-50 text-gray-600 sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Buku</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Pertanyaan</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Jumlah Pilihan</th>
                                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                    </x-slot>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($kuises as $kuis)
                            <tr class="{{ $loop->even ? 'bg-amber-50':'' }} hover:bg-gray-50">
                                <td class="px-6 py-3 text-left whitespace-nowrap">{{ $kuis->book->judul ?? 'N/A' }}</td>
                                <td class="px-6 py-3 text-left whitespace-nowrap">{{ $kuis->pertanyaan }}</td>
                                <td class="px-6 py-3 text-left whitespace-nowrap">{{ $kuis->choices->count() }}</td>
                                <td class="px-5 py-3 text-left whitespace-nowrap">
                                    <form action="{{ route('kuis.destroy', $kuis->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kuis ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-700" type="submit" title="Hapus"><i class="bi bi-trash3-fill"></i></button>
                                        <a href="{{ route('kuis.edit', $kuis->id )}}" class="text-sky-700 hover:text-sky-900" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada kuis yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-dashboardComponent.table>
            </div>
        </div>

        {{-- Mobile Card Layout (visible only on screens smaller than md) --}}
        <div class="md:hidden divide-y divide-gray-200">
            @forelse ($kuises as $kuis)
                <div class="bg-white p-4">
                    <div class="flex items-start space-x-4">
                        {{-- Opsional: Anda bisa menambahkan ikon atau indikator di sini jika ada --}}
                        {{-- <div class="flex-shrink-0">
                            <i class="bi bi-question-circle text-2xl text-gray-500"></i>
                        </div> --}}
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-semibold text-gray-900 leading-tight mb-1 break-words">
                                {{ $kuis->pertanyaan }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                <span class="font-bold">Buku:</span> {{ $kuis->book->judul ?? 'N/A' }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">
                                <span class="font-bold">Jumlah Pilihan:</span> {{ $kuis->choices->count() }}
                            </p>
                            <div class="mt-3 flex space-x-4 justify-end">
                                <a href="{{ route('kuis.edit', $kuis->id )}}" class="text-sky-600 hover:text-sky-900 p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors" title="Edit">
                                    <i class="bi bi-pencil-square text-lg"></i>
                                </a>
                                <form action="{{ route('kuis.destroy', $kuis->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kuis ini?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700 p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors" type="submit" title="Hapus">
                                        <i class="bi bi-trash3-fill text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-4 text-center text-gray-500">
                    Belum ada kuis yang ditambahkan.
                </div>
            @endforelse
        </div>
    </div>
</x-dashboardComponent.admin>