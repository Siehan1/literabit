<x-dashboardComponent.admin>
    <x-slot name="header">Daftar Badges</x-slot>
    <!-- success session -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            
        </div>
    @endif
    <div class="w-full text-end mb-6">
        <a href="{{route('badge.create')}}" class="bg-secondary-600 px-4 py-3 rounded-2xl hover:bg-secondary-800 text-white transition-colors duration-20">Tambah Badge</a>
    </div>

    <x-dashboardComponent.table>
        <x-slot name="header">Table Badges</x-slot>
        <x-slot name="thead">
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Nama Badge</th>
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Deskripsi</th>
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Icon</th>
            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Action</th>
        </x-slot>

        @foreach ($badges as $badge)
            <tr>
                <td class="px-6 py-3 text-left w-1/6">{{$badge->nama_badge}}</td>
                <td class="px-6 py-3 text-left w-1/6">{{$badge->description}}</td>
                <td class="px-6 py-3 text-left w-1/6"><img src="{{asset('storage/' . $badge->icon_path)}}" alt="{{$badge->path}}" class="w-36"></td>
                <td class="px-5 py-3 text-left w-1/6">
                    <form action="{{ route('badge.destroy', $badge->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="flex flex-row gap-1">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500" type="submit" style="cursor:pointer"><i class="bi bi-trash3-fill"></i></button>
                        <a href="{{ route('badge.edit', $badge->id )}}" class="text-sky-700"><i class="bi bi-pencil-square"></i></a>
                    </form>
                </td>
            </tr>
            
        @endforeach
    </x-dashboardComponent.table>
</x-dashboardComponent.admin>