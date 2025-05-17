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
        <div class="max-h-[500px] overflow-y-auto">
            <table class="w-full">
                <tbody class="divide-y divide-gray-200">
                    {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
</div>
