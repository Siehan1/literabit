<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - LittleRabbit</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="font-poppins text-teks bg-wave min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4 py-12 md:py-16 lg:py-20">
        <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-md p-10 md:p-12 lg:p-16 relative">
            <!-- Tombol Close -->
            <a href="/index" class="absolute right-4 top-4 text-sec hover:text-primary transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>

            <div class="flex flex-col lg:flex-row items-center justify-between gap-8 lg:gap-16">
                {{-- gambar --}}
                <div class="lg:w-1/2 flex flex-col items-center lg:items-start">
                    <img src="{{ asset('asset/images/kelinci_login.png') }}" alt="image login" class="w-40 md:w-48 lg:w-96">
                </div>

                {{-- form --}}
                <div class="lg:w-1/2">
                    <div class="flex flex-col items-center lg:items-start gap-3 mb-8">
                        <h3 class="text-xl md:text-2xl text-center lg:text-left font-bold">Selamat Datang!</h3>
                        <p class="text-center lg:text-left text-sm md:text-[14px] text-sec">Silakan registrasi untuk melanjutkan ke akun Anda dan nikmati berbagai cerita buku yang kami sediakan</p>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 flex flex-row gap-1.5">
                                @foreach ($errors->all() as $error)
                                    <i class="bi bi-exclamation-triangle-fill text-red-700 "></i>
                                    <span>{{$error}}</span>
                                @endforeach
                        </div>
                    @endif

                    <form class="space-y-4" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="flex flex-col gap-2">
                            <label for="name" class="text-sm font-medium">Nama</label>
                            <input type="text" id="name" required class="w-full px-4 py-2 rounded-xl border-2 border-teks focus:outline-none focus:border-primary transition-colors duration-200" placeholder="Nama Lengkap" autofocus name="name">
                        </div>
                        
                        <div class="flex flex-col gap-2">
                            <label for="username" class="text-sm font-medium">Username</label>
                            <input type="text" id="username" required class="w-full px-4 py-2 rounded-xl border-2 border-teks focus:outline-none focus:border-primary transition-colors duration-200" placeholder="Username" autofocus name="username">
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-sm font-medium">Email</label>
                            <input type="email" id="email" required class="w-full px-4 py-2 rounded-xl border-2 border-teks focus:outline-none focus:border-primary transition-colors duration-200" placeholder="JhonDhoe@gmail.com" autofocus name="email">
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="password" class="text-sm font-medium">Password</label>
                            <div class="relative">
                                <input type="password" id="password" required class="w-full px-4 py-2 rounded-xl border-2 border-teks focus:outline-none focus:border-primary transition-colors duration-200" placeholder="Password" name="password">
                                <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-sec hover:text-primary transition-colors duration-200">
                                    <!-- Icon Mata Tertutup -->
                                    <svg xmlns="http://www.w3.org/2000/svg" id="eyeClose" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                    <!-- Icon Mata Terbuka -->
                                    <svg xmlns="http://www.w3.org/2000/svg" id="eyeOpen" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="password" class="text-sm font-medium">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" required class="w-full px-4 py-2 rounded-xl border-2 border-teks focus:outline-none focus:border-primary transition-colors duration-200" placeholder="Konfirmasi Password" name="password_confirmation">
                            <span class="italic text-sm" id="message"></span>
                        </div>

                        <button id="btn-daftar" type="submit" class="w-full bg-primary text-white py-2.5 rounded-xl font-medium hover:bg-hover transition-colors duration-200 shadow-[0px_4px_0px_0px_rgba(201,144,75,1.00)]">
                            Daftar
                        </button>

                        <p class="text-center text-sm">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="text-primary hover:text-hover transition-colors duration-200">Login!</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>