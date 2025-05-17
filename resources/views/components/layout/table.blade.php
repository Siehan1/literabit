@props(['header'])
<div class="bg-white w-full rounded-xl flex flex-col shadow-lg border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <h3 class="text-xl font-semibold text-gray-800">{{ $header ?? 'User Information' }}</h3>
        <div class="flex items-center gap-2">
            {{ $actions ?? '' }}
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 text-gray-600 sticky top-0">
                <tr>
                    {{ $thead }}
                </tr>
            </thead>
        </table>
        <div class="max-h-[400px] overflow-y-auto">
            <table class="w-full">
                <tbody class="divide-y divide-gray-200">
                    {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- @props(['users'])
<div class="bg-white w-full rounded flex flex-col shadow mt-5">
    <div class="pl-5 py-5 border-b-2 border-primary-400">
        <h3 class="text-teks font-bold text-2xl">User Information</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full rounded-2xl">
            <thead class="bg-primary-200 text-teks sticky top-0" name="thead">
                <tr>
                    <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/5">Username</th>
                    <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/5">Email</th>
                    <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/5">Level</th>
                    <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/5">Total Exp</th>
                    <th class="px-6 py-3 text-left text-[14px] font-semibold uppercase w-1/5">Bergabung pada</th>
                </tr>
            </thead>
        </table>
        <div class="max-h-[350px] overflow-y-auto">
            <table class="min-w-full rounded-2xl">
                <tbody>
                    @foreach ( $users as $user)
                        <tr class="{{ $loop->even ? 'bg-amber-50':'' }}">
                            <td class="px-6 py-3 text-left w-1/5">{{$user->username}}</td>
                            <td class="px-6 py-3 text-left w-1/5">{{$user->email}}</td>
                            <td class="px-6 py-3 text-left w-1/5">{{$user->level}}</td>
                            <td class="px-6 py-3 text-left w-1/5">{{$user->xp}} EXP</td>
                            <td class="px-6 py-3 text-left w-1/5">{{$user->created_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> --}}