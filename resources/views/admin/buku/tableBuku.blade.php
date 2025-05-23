<x-dashboardComponent.admin>
    <x-slot name="header">Daftar Buku</x-slot>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            
        </div>
    @endif
    <div class="w-full text-end mb-6">
        <a href="{{ route('buku.create') }}" class="bg-secondary-600 px-4 py-3 rounded-2xl hover:bg-secondary-800 text-white transition-colors duration-100">Tambah Buku</a>
    </div>
    <x-dashboardComponent.table>
        <x-slot name="header">Tabel Buku</x-slot>
        <x-slot name="thead">
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">No</th> 
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Cover</th> 
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Judul</th> 
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Penulis</th> 
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Level Required</th> 
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Genre</th> 
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Action</th> 
        </x-slot>
        @foreach ($bukus as $index => $buku)
            <tr class="{{ $loop->even ? 'bg-amber-50':'' }}">
                <td class="px-6 py-3 text-left w-1/6">{{$index+1}}</td>
                <td class="px-6 py-3 text-center w-1/6">
                <img src="{{ asset('storage/' . $buku->cover_path)}}" alt="Cover-{{$buku->slug}}" width="100px">
                </td>
                <td class="px-6 py-3 text-left w-1/6">{{$buku->judul}}</td>
                <td class="px-6 py-3 text-left w-1/6">{{$buku->penulis}}</td>
                <td class="px-6 py-3 text-left w-1/6">{{$buku->level_required}}</td>
                <td class="px-6 py-3 text-left w-1/6">{{$buku->genre->nama_genre}}</td>
                <td class="px-5 py-3 text-left w-1/6">
                    <form action="{{ route('buku.destroy', $buku->slug) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="flex flex-row gap-1">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500" type="submit" style="cursor:pointer"><i class="bi bi-trash3-fill"></i></button>
                        <a href="{{ route('buku.edit', $buku->slug )}}" class="text-sky-700"><i class="bi bi-pencil-square"></i></a>
                    </form>
                </td>
                
            </tr>
        @endforeach
    </x-dashboardComponent.table>


</x-dashboardComponent.admin>