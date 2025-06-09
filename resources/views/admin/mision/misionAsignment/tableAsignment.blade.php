<x-dashboardComponent.admin>
<x-slot name="header">Mission Assignment</x-slot>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            
        </div>
    @endif
    <div class="w-full text-end mb-6">
        <a href="{{ route('create.Asignment') }}" class="bg-secondary-600 px-4 py-3 rounded-2xl hover:bg-secondary-800 text-white transition-colors duration-100">Tambah Missions</a>
    </div>
    <x-dashboardComponent.table>
        <x-slot name="header">Assignments</x-slot>
        <x-slot name="thead">
            <tr>
                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Judul</th>
                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Jumlah Selesai</th>
                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Status</th>
                <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Aksi</th>
            </tr>
        </x-slot>
        <tbody>
            @foreach ($assignments as $a)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4 w-1/6">{{ $a->judul }}</td>
                <td class="px-6 py-4 w-1/6">{{ $a->jumlah_selesai }}</td>
                <td class="px-6 py-4 w-1/6">{{ $a->is_done }}</td>
                <td class="px-6 py-4 w-1/6">
                    <form action="{{ route('missionTemplate.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="inline-flex gap-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Hapus">
                            <i class="bi bi-trash3-fill text-red-500 text-[20px] hover:cursor-pointer"></i>
                        </button>
                        <a href="{{ route('missionTemplate.edit', $a->id) }}" class="text-sky-700" title="Edit">
                            <i class="bi bi-pencil-square text-[20px]"></i>
                        </a>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </x-dashboardComponent.table>
    
</x-dashboardComponent.admin>