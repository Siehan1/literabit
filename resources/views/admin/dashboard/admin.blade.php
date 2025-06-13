<x-dashboardComponent.admin>
    <x-slot name="header">Admin Dashboard</x-slot>

    <div class="flex flex-col gap-6">
        <div class="flex flex-wrap gap-4 justify-center md:justify-start">
            <x-dashboardComponent.card-admin>
                <x-slot name="header">Total User</x-slot>
                <x-slot name="icon">
                    <i class="bi bi-person-fill text-3xl text-sec"></i>
                </x-slot>
                <x-slot name="subheader">{{$users->count()}}</x-slot>
                <x-slot name="paragraph">Total pengguna terdaftar</x-slot>
            </x-dashboardComponent.card-admin>
            <x-dashboardComponent.card-admin>
                <x-slot name="header">Total Buku</x-slot>
                <x-slot name="icon">
                    <i class="bi bi-book-fill text-3xl text-sec"></i>
                </x-slot>

                <x-slot name="subheader">{{$bukus -> count()}}</x-slot>
                <x-slot name="paragraph">Koleksi</x-slot>
            </x-dashboardComponent.card-admin>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-gray-100 overflow-hidden hidden md:block">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-xl font-semibold text-gray-800">Daftar Pengguna</h3>
            </div>
            <div class="overflow-x-auto">
                <div class="max-h-[500px] overflow-y-auto">
                    <x-dashboardComponent.table>
                        <x-slot name="thead">
                            <thead class="bg-gray-50 text-gray-600 sticky top-0 z-10">
                                <tr>
                                    <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">No</th>
                                    <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Username</th>
                                    <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Email</th>
                                    <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Level</th>
                                    <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Total Exp</th>
                                    <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase whitespace-nowrap">Bergabung pada</th>
                                </tr>
                            </thead>
                        </x-slot>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($users as $index => $user)
                            <tr class="{{ $loop->even ? 'bg-amber-50':'' }} hover:bg-gray-50">
                                <td class="px-6 py-3 text-left whitespace-nowrap">{{ $index+1 }}</td>
                                <td class="px-6 py-3 text-left whitespace-nowrap">{{$user->username}}</td>
                                <td class="px-6 py-3 text-left whitespace-nowrap">{{$user->email}}</td>
                                <td class="px-6 py-3 text-left whitespace-nowrap">{{$user->level}}</td>
                                <td class="px-6 py-3 text-left whitespace-nowrap">{{$user->xp}} EXP</td>
                                <td class="px-6 py-3 text-left whitespace-nowrap">{{$user->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </x-dashboardComponent.table>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md border border-gray-100 overflow-hidden md:hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-center">
                <h3 class="text-xl font-semibold text-gray-800 text-center">Daftar Pengguna</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse ($users as $index => $user)
                <div class="p-4">
                    <div class="flex flex-col gap-1">
                        <p class="text-sm font-semibold text-gray-700">No: <span class="font-normal">{{ $index+1 }}</span></p>
                        <p class="text-sm font-semibold text-gray-700">Username: <span class="font-normal">{{$user->username}}</span></p>
                        <p class="text-sm font-semibold text-gray-700">Email: <span class="font-normal">{{$user->email}}</span></p>
                        <p class="text-sm font-semibold text-gray-700">Level: <span class="font-normal">{{$user->level}}</span></p>
                        <p class="text-sm font-semibold text-gray-700">Total Exp: <span class="font-normal">{{$user->xp}} EXP</span></p>
                        <p class="text-sm font-semibold text-gray-700">Bergabung pada: <span class="font-normal">{{$user->created_at}}</span></p>
                    </div>
                </div>
                @empty
                <div class="px-6 py-4 text-center text-gray-500">
                    Tidak ada pengguna yang terdaftar.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-dashboardComponent.admin>