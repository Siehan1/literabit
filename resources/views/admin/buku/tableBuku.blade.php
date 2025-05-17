<x-dashboardComponent.admin>
    <x-slot name="header">Daftar Buku</x-slot>
    <div class="w-full text-end mb-6">
        <a href="{{ route('upload') }}" class="bg-secondary-600 px-4 py-3 rounded-2xl hover:bg-secondary-800 text-white transition-colors duration-100">Tambah Buku</a>
    </div>
    <x-dashboardComponent.table>
        <x-slot name="header">Tabel Buku</x-slot>
        <x-slot name="thead">
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Id</th> 
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Judul</th> 
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Penulis</th> 
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Level Required</th> 
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Genre</th> 
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Cover</th> 
        </x-slot>
        @foreach ($bukus as $buku)
            <tr class="{{ $loop->even ? 'bg-amber-50':'' }}">
                <td class="px-6 py-3 text-left w-1/6">{{$buku->id}}</td>
                <td class="px-6 py-3 text-left w-1/6">{{$buku->judul}}</td>
                <td class="px-6 py-3 text-left w-1/6">{{$buku->penulis}}</td>
                <td class="px-6 py-3 text-left w-1/6">{{$buku->level_required}}</td>
                <td class="px-6 py-3 text-left w-1/6">{{$buku->genre_id}}</td>
                <td class="px-6 py-3 text-left w-1/6">{{$buku->cover_path}}</td>
            </tr>
        @endforeach
    </x-dashboardComponent.table>


</x-dashboardComponent.admin>