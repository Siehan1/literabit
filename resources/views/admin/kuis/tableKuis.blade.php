<x-dashboardComponent.admin>
    <x-slot name="header">Daftar Kuis</x-slot>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="w-full text-end mb-6">
        <a href="{{route('kuis.create')}}" class="bg-secondary-600 px-4 py-3 rounded-2xl hover:bg-secondary-800 text-white transition-colors duration-20">Tambah Kuis</a>
    </div>

    <x-dashboardComponent.table>
        <x-slot name="header">Table Kuis</x-slot>
        <x-slot name="thead">
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Buku</th>
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Pertanyaan</th>
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Jumlah Pilihan</th>
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Aksi</th>
        </x-slot>

        @foreach ($kuises as $kuis)
            <tr>
                <td class="px-6 py-3 text-left w-1/6">{{ $kuis->book->judul ?? 'N/A' }}</td> {{-- Tampilkan judul buku --}}
                <td class="px-6 py-3 text-left w-1/6">{{ $kuis->pertanyaan }}</td>
                <td class="px-6 py-3 text-left w-1/6">{{ $kuis->choices->count() }}</td> {{-- Hitung jumlah pilihan --}}
                <td class="px-6 py-3 text-left w-1/6">
                <form action="{{ route('kuis.destroy', $kuis->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500" type="submit" style="cursor:pointer"><i class="bi bi-trash3-fill"></i></button>
                        <a href="{{ route('kuis.edit', $kuis->id )}}" class="text-sky-700"><i class="bi bi-pencil-square"></i></a>
                    </form>
                    {{-- <a href=""><i class="bi bi-pencil-square"></i></a>|
                    <a href=""></a> --}}
                </td>
            </tr>
        @endforeach
    </x-dashboardComponent.table>
</x-dashboardComponent.admin>