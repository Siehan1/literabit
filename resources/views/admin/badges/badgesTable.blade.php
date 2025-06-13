<x-dashboardComponent.admin>
    <x-slot name="header">Daftar Badges</x-slot>

    <div class="w-full mb-6 flex justify-center md:justify-end">
        <a href="{{route('badge.create')}}" class="bg-secondary-600 px-4 py-3 rounded-2xl hover:bg-secondary-800 text-white transition-colors duration-200 text-sm md:text-base w-full sm:w-auto text-center">
            <span class="hidden sm:inline">Tambah Badge</span>
            <span class="sm:hidden">+ Badge</span>
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5" role="alert">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white w-full rounded-xl flex flex-col shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-center md:hidden">
            <h3 class="text-xl font-semibold text-gray-800 text-center">Table Badges</h3>
        </div>

        <div class="px-6 py-4 border-b border-gray-200 hidden md:flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Table Badges</h3>
            <div class="flex items-center gap-2">
            </div>
        </div>

        <div class="overflow-x-auto hidden md:block">
            <div class="max-h-[500px] overflow-y-auto">
                <table class="w-auto h-auto ">
                    <thead class="bg-gray-50 text-gray-600 sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Nama Badge</th>
                            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Icon</th>
                            <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/6">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($badges as $badge)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 text-left w-1/6">{{$badge->nama_badge}}</td>
                            <td class="px-6 py-3 text-left w-1/6">{{$badge->description}}</td>
                            <td class="px-6 py-3 text-left w-1/6">
                                <img src="{{asset('storage/' . $badge->icon_path)}}" alt="{{$badge->nama_badge}}" class="w-24 h-24 object-cover rounded">
                            </td>
                            <td class="px-6 py-3 text-left w-1/6">
                                <form action="{{ route('badge.destroy', $badge->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="flex flex-row gap-2">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700" type="submit" style="cursor:pointer">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                    <a href="{{ route('badge.edit', $badge->id )}}" class="text-sky-700 hover:text-sky-900">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="md:hidden divide-y divide-gray-200">
            @foreach ($badges as $badge)
            <div class="bg-white p-4">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <img src="{{asset('storage/' . $badge->icon_path)}}" alt="{{$badge->nama_badge}}" class="w-16 h-16 object-cover rounded-lg">
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-col">
                            <h3 class="text-base font-semibold text-gray-900 leading-tight">
                                {{$badge->nama_badge}}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1 break-words">
                                {{$badge->description}}
                            </p>
                        </div>
                        <div class="mt-3 flex space-x-4 justify-end">
                            <a href="{{ route('badge.edit', $badge->id )}}" class="text-sky-600 hover:text-sky-900 p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors" title="Edit">
                                <i class="bi bi-pencil-square text-lg"></i>
                            </a>
                            <form action="{{ route('badge.destroy', $badge->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $badge->nama_badge }}?')" class="inline-block">
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
            @endforeach
        </div>

        @if ($badges->isEmpty())
        <div class="px-6 py-4 text-center text-gray-500">
            Belum ada badge yang ditambahkan.
        </div>
        @endif
    </div>
</x-dashboardComponent.admin>