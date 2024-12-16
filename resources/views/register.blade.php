<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center p-4 h-full min-h-screen bg-gradient-to-br from-blue-200 via-sky-100 to-transparent">
    <div class="absolute top-3 left-4 ">
        <a href="{{ route('account.dashboard') }}" id="brand" ><img src="{{ asset('images/journylyLOGO.png') }}" alt="Logo" class="object-cover max-w-50 max-h-40 ml-10"></a>
    </div>
    <div x-data="{ email: '', password: '', name: '' }" 
         class="bg-white bg-opacity-10 backdrop-blur-lg rounded-3xl p-8 shadow-2xl w-full max-w-md transform hover:scale-105 transition-all duration-300"
         x-init="
            gsap.from($el, {opacity: 0, y: 50, duration: 1, ease: 'back'});
            gsap.from('.input-field', {opacity: 0, x: -50, stagger: 0.2, duration: 0.8, ease: 'power2.out'});
            gsap.from('.btn', {opacity: 0, scale: 0.5, duration: 0.5, delay: 1, ease: 'elastic.out(1, 0.5)'});
         ">
        <h2 class="text-4xl font-extrabold text-sky-500 mb-6 text-center animate-pulse">Sign Up</h2>
        <form method="post" action="{{ route('account.processRegister') }}"  class="space-y-6">
            @csrf
            <div class="input-field relative">
                <input name="name" x-model="name" type="text" id="name" class="w-full px-4 py-3 rounded-lg bg-gray-500 bg-opacity-20 focus:bg-opacity-30 focus:ring-2  text-gray-800 placeholder-gray-500 transition duration-500" placeholder="Full Name">
                <i class="fas fa-user absolute right-3 top-3 text-sky-600"></i>
            </div>
            <div class="input-field relative">
                <input name="email" value="{{ old('email') }}" x-model="email" type="text" id="email" class="@error('email') is-invalid @enderror w-full px-4 py-3 rounded-lg bg-gray-500 bg-opacity-20 focus:bg-opacity-30 focus:ring-2  text-gray-800 placeholder-gray-500 transition duration-500" placeholder="Email Address">
                <i class="fas fa-envelope absolute right-3 top-3 text-sky-600"></i>
                @error('email')
                    <p class="invalid-feedback text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="input-field relative">
                <input name="phone" x-model="phone" type="number" id="phone" class=" w-full px-4 py-3 rounded-lg bg-gray-500 bg-opacity-20 focus:bg-opacity-30 focus:ring-2  text-gray-800 placeholder-gray-500 transition duration-500" placeholder="Phone Number">
                <i class="fas fa-phone absolute right-3 top-3 text-sky-600"></i>
                
            </div>
            <div class="input-field relative">
                <input name="password" x-model="password" type="password" id="password" class="@error('password') is-invalid @enderror w-full px-4 py-3 rounded-lg bg-gray-500 bg-opacity-20 focus:bg-opacity-30 focus:ring-2 text-gray-800 placeholder-gray-500 transition duration-500" placeholder="Password">
                <i class="fas fa-lock absolute right-3 top-3 text-sky-600"></i>
                @error('password')
                    <p class="invalid-feedback text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="input-field relative">
                <input name="password_confirmation" x-model="password_confirmation" type="password" id="password_confirmation" class="w-full px-4 py-3 rounded-lg bg-gray-500 bg-opacity-20 focus:bg-opacity-30 focus:ring-2 text-gray-800 placeholder-gray-500 transition duration-500" placeholder="Comfirm Password">
                <i class="fas fa-lock absolute right-3 top-3 text-sky-600"></i>
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-sky-500 to-sky-300 text-gray-800 font-bold py-3 px-4 rounded-lg hover:opacity-90 focus:ring-4  transition duration-300 transform hover:scale-105">
                Sign Up
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
            
        </form>
        <p class="text-gray-800 text-center mt-6">
            Already have an account? 
            <a href="{{ route('account.login') }}" class="font-bold hover:underline text-sky-600">Log in</a>
        </p>
        <div class="mt-8 flex justify-center space-x-4">
            <a href="#" class="text-sky-500 hover:text-sky-800 transition-colors duration-200">
                <i class="fab fa-facebook-f text-2xl"></i>
            </a>
            <a href="#" class="text-sky-500 hover:text-sky-800 transition-colors duration-200">
                <i class="fab fa-twitter text-2xl"></i>
            </a>
            <a href="#" class="text-sky-500 hover:text-sky-800 transition-colors duration-200">
                <i class="fab fa-google text-2xl"></i>
            </a>
        </div>
    </div>

    <script>
        gsap.to('.fab', {
            y: -10,
            stagger: 0.1,
            duration: 0.8,
            repeat: -1,
            yoyo: true,
            ease: 'power1.inOut'
        });
    </script>
</body>
</html>
