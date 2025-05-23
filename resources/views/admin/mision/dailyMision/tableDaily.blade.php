<x-dashboardComponent.admin>
    <x-slot name="header">Daily Missions</x-slot>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="w-full text-end mb-6">
        <a href="{{route('uploadDaily')}}" class="bg-secondary-600 px-4 py-3 rounded-2xl hover:bg-secondary-800 text-white transition-colors duration-100">Tambah Daily Mission</a>
    </div>

    <x-dashboardComponent.table>
        <x-slot name="header">Daily Missions</x-slot>
        <x-slot name="thead">
            <th class="px-6 py-3 text-center text-[14px] font-semibold uppercase w-1/6">Tanggal</th>
            <th class="px-6 py-3 text-center text-[14px] font-semibold uppercase w-1/6">Tipe</th>
            <th class="px-6 py-3 text-center text-[14px] font-semibold uppercase w-1/6">Deskripsi</th>
            <th class="px-6 py-3 text-center text-[14px] font-semibold uppercase w-1/6">status</th>
            <th class="px-6 py-3 text-center text-[14px] font-semibold uppercase w-1/6">Aksi</th>
        </x-slot>

        @foreach ($misions as $i)
            <tr>
                <td class="px-6 py-4 text-sm text-gray-800 w-1/6 text-center">
                    {{ date('Y-m-d', strtotime($i->tanggal)) }}
                </td>
                <td class="px-6 py-4 text-sm text-gray-800 w-1/6 text-center">
                    {{$i->template->type ?? 'No Template'}}
                </td>
                <td class="px-6 py-4 text-sm text-gray-800 w-1/6 text-center">
                    {{$i->template->deskripsi ?? 'No Description'}}
                </td>
                <td class="px-6 py-4 text-sm text-gray-800 w-1/6 text-center">
                    <span class="{{ $i->is_completed ? 'bg-green-200' : 'bg-red-200' }} {{ $i->is_completed ? 'text-green-700' : 'text-red-700' }} px-3 py-1 rounded-full">
                        {{ $i->is_completed ? 'Completed' : 'Not Completed' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-800 w-1/6 text-center">
                    {{-- Ubah action form delete --}}
                    <form action="{{ route('deleteDaily', $i->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="flex flex-row gap-3 items-center justify-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=""><i class="bi bi-trash3-fill text-red-500 text-[24px]"></i></button>
                        <a href="{{ route('editDaily', $i->id) }}" class="text-sky-700"><i class="bi bi-pencil-square text-[24px]"></i></a>
                    </form>
                </td>
            </tr>
        @endforeach

    </x-dashboardComponent.table>
</x-dashboardComponent.admin>