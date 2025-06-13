@props(['header', 'actions' => null])
<div class="bg-white w-full rounded-xl flex flex-col shadow-lg border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-center sm:hidden">
        <h3 class="text-xl font-semibold text-gray-800 text-center">
            {{ $header ?? 'User Information' }}
        </h3>
    </div>


    <div class="overflow-x-auto">
        <div class="max-h-[500px] overflow-y-auto">
            <table class="w-full min-w-max">
                <thead class="bg-gray-50 text-gray-600 sticky top-0 z-10">
                    <tr>
                        {{ $thead ?? 'no header'}}
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
</div>