<x-dashboardComponent.admin>
    <x-slot name="header">Daftar Genre Buku</x-slot>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            
        </div>
    @endif
    <div class="w-full text-end mb-6">
        <a href="{{ route('genre.create') }}" class="bg-secondary-600 px-4 py-3 rounded-2xl hover:bg-secondary-800 text-white transition-colors duration-100">Tambah Genre</a>
    </div>
    <x-dashboardComponent.table>
        <x-slot name="header">Tabel Genre</x-slot>
        <x-slot name="thead">
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">No</th> 
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Nama Genre</th>
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Action</th> 
        </x-slot>
        @foreach ($genres as $index => $genre)
            <tr class="{{ $loop->even ? 'bg-amber-50':'' }}">
                <td class="px-6 py-3 text-left w-1/6">{{$index+1}}</td>
                <td class="px-6 py-3 text-left w-1/6">{{$genre->nama_genre}}</td>
                <td class="px-5 py-3 text-left w-1/6">
                    <form action="{{ route('genre.destroy', $genre->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="flex flex-row gap-1">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500" type="submit" style="cursor:pointer"><i class="bi bi-trash3-fill"></i></button>
                        <a href="{{ route('genre.edit', $genre->id )}}" class="text-sky-700"><i class="bi bi-pencil-square"></i></a>
                    </form>
                </td>
                
            </tr>
        @endforeach
    </x-dashboardComponent.table>


</x-dashboardComponent.admin>