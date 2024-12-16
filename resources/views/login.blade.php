<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="./output.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center p-4 h-full min-h-screen bg-gradient-to-br from-blue-200 via-sky-100 to-transparent">
    <div class="absolute top-4 left-4">
        <a href="{{ route('account.dashboard') }}" id="brand"><img src="{{ asset('images/journylyLOGO.png') }}" alt="Logo" class="object-cover max-w-50 max-h-40 ml-10"></a>
    </div>
    <div x-data="{ email: '', password: '', name: '',
                    showError: {{ Session::has('error') ? 'true' : 'false' }},
                    showSuccess: {{ Session::has('success') ? 'true' : 'false' }},
                    showInfo: {{ Session::has('info') ? 'true' : 'false' }}}" 
         class="bg-white bg-opacity-10 backdrop-blur-lg rounded-3xl p-8 shadow-2xl w-full max-w-md transform hover:scale-105 transition-all duration-300"
         x-init="
            gsap.from($el, {opacity: 0, y: 50, duration: 1, ease: 'back'});
            gsap.from('.input-field', {opacity: 0, x: -50, stagger: 0.2, duration: 0.8, ease: 'power2.out'});
            gsap.from('.btn', {opacity: 0, scale: 0.5, duration: 0.5, delay: 1, ease: 'elastic.out(1, 0.5)'});
            
            setTimeout(() => {
                showError = false;
                showSuccess = false;
                showInfo = false;
            }, 3000);">

        <div x-show="showError" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2"
            class="mb-6">
            <div class="flex items-center p-4 bg-red-100 rounded-lg">
                <svg class="flex-shrink-0 w-5 h-5 text-red-700" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div class="ml-3 text-sm font-medium text-red-700">
                    {{ Session::get('error') }}
                </div>
            </div>
        </div>

        <div x-show="showSuccess"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="mb-6">
            <div class="flex items-center p-4 bg-green-100 rounded-lg">
                <svg class="flex-shrink-0 w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <div class="ml-3 text-sm font-medium text-green-700">
                    {{ Session::get('success') }}
                </div>
            </div>
        </div>

        <div x-show="showInfo"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="mb-6">
            <div class="flex items-center p-4 bg-blue-100 rounded-lg">
                <svg class="flex-shrink-0 w-5 h-5 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div class="ml-3 text-sm font-medium text-blue-700">
                    {{ Session::get('info') }}
                </div>
            </div>
        </div>

        <h2 class="text-4xl font-extrabold text-sky-500 mb-6 text-center animate-pulse">Login</h2>
        <form method="POST" action="{{ route('account.authenticate') }}" class="space-y-6">
            @csrf
            <div class="input-field relative">
                <input x-model="email" value="{{ old('email') }}" name="email" type="text" id="email" class="@error('email') is-invalid @enderror w-full px-4 py-3 rounded-lg bg-gray-500 bg-opacity-20 focus:bg-opacity-30 focus:ring-2 text-gray-800 placeholder-gray-500 transition duration-500" placeholder="Email Address">
                <i class="fas fa-envelope absolute right-3 top-3 text-sky-600"></i>
                @error('email')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div class="input-field relative">
                <input x-model="password" name="password" type="password" id="password" class="@error('email') is-invalid @enderror w-full px-4 py-3 rounded-lg bg-gray-500 bg-opacity-20 focus:bg-opacity-30 focus:ring-2 text-gray-800 placeholder-gray-500 transition duration-500" placeholder="Password">
                <i class="fas fa-lock absolute right-3 top-3 text-sky-600"></i>
                @error('password')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" class="w-full bg-gradient-to-r from-sky-500 to-sky-300 text-gray-800 font-bold py-3 px-4 rounded-lg hover:opacity-90 focus:ring-4 transition duration-300 transform hover:scale-105">
                L o g i n
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </form>
        <p class="text-gray-800 text-center mt-6">
            Do you have account? 
            <a href="{{ route('account.register') }}" class="font-bold hover:underline text-sky-600">Sign up</a>
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