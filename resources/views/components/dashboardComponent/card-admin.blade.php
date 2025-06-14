<div class="bg-white w-full sm:w-80 md:w-72 p-4 sm:p-6 rounded-xl flex flex-col shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
    <div class="flex flex-col gap-2 sm:gap-3">
        <div class="flex items-center gap-2">
            <h3 class="text-base sm:text-lg font-medium text-gray-600">{{ $header ?? "Total"}}</h3>
            <div class="flex-grow"></div>
            {{ $icon ?? '' }}
        </div>
        <h2 class="text-3xl sm:text-4xl font-bold text-primary-600">
            {{ $subheader ?? "subheader" }}
        </h2>
        <p class="text-xs sm:text-sm text-gray-500">
            {{ $paragraph ?? "isi card" }}
        </p>
    </div>
</div>