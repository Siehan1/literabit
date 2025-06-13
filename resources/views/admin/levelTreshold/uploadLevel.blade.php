<x-dashboardComponent.admin>
<a href="{{route('tableLevel')}}" class="hidden md:block"><i class="bi bi-arrow-left text-4xl hover:text-primary transition-colors duration-200"></i></a>
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8">
            <h2 class="text-2xl font-bold text-primary mb-8 text-center">Upload Level Baru</h2>
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5">
                        @foreach ($errors->all() as $error)
                            <i class="bi bi-exclamation-triangle-fill text-red-700 "></i>
                            <span>{{$error}}</span>
                        @endforeach
                </div>
            @endif
            <div class="flex flex-col items-center">
                <form action="{{route('level.store')}}" method="POST" class="space-y-6 w-2xl">
                    @csrf
                    <div class="flex gap-2 flex-col">
                        <label for="level" class="block text-sm font-medium text-teks">Level<span class="text-red-500">*</span></label>
                        <input type="number" name="level" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring focus:border-primary focus:ring-primary/20 transition-all duration-200">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="" class="block text-sm font-medium text-teks">Experience<span class="text-red-500">*</span></label>
                        <input type="number" name="required_xp" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring focus:border-primary focus:ring-primary/20 transition-all duration-200">
                    </div>
                    <div class="flex justify-center mt-8">
                    <button type="submit"
                        class="px-8 py-3 bg-primary text-white rounded-xl font-medium hover:bg-hover transition-all duration-200 shadow-[0px_4px_0px_0px_rgba(201,144,75,1.00)] hover:shadow-[0px_2px_0px_0px_rgba(201,144,75,1.00)] hover:-translate-y-0.5 active:translate-y-0 active:shadow-[0px_0px_0px_0px_rgba(201,144,75,1.00)]">
                        Simpan Level
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboardComponent.admin>