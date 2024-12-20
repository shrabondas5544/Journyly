<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Bus - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/4b5d033142.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-200 via-blue-50 to-transparent">

<!-- Mobile Menu Button -->
<div class="lg:hidden fixed top-4 left-4 z-50">
    <button id="mobileMenuBtn" class="p-2 bg-white rounded-lg shadow-lg">
        <i class="fa-solid fa-bars text-xl"></i>
    </button>
</div>
<nav class="p-3 flex mt-2 justify-between items-center">
        <a href="{{ route('admin.dashboard') }}" id="brand">
            <img class="object-cover max-w-30 max-h-20 ml-10" src="{{ asset('images/journylyLOGO.png') }}" alt="">
        </a>
        <div id="nav-menu" class="hidden md:flex gap-10">
            <a href="{{ route('admin.dashboard') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110">home</a>
            <a href="{{ route('admin.feedbacks') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110">feedbacks</a>
            <a href="#" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110">Hotel</a>
            <a href="{{ route('admin.flightpanel') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110">Flight</a>
            <a href="{{ route('admin.buspanel') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110">Bus</a>
            <a href="#" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110">Train</a>
        </div>

        <div class="mr-12 hidden md:block relative" x-data="{ open: false }">
            @auth
                <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110">
                    <i class="fa-duotone fa-solid fa-user" style="--fa-primary-color: #0080ff; --fa-secondary-color: #0080ff;"></i>
                    <span class="font-medium">{{ Auth::user()->name }}</span>
                    <i class="fa-solid fa-caret-down" style="--fa-primary-color: #0080ff;"></i>
                </button>
            
                <div x-show="open" 
                    @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-400 transition-colors duration-300 ease-in-out rounded-lg">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-400 transition-colors duration-300 ease-in-out rounded-lg">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('admin.login') }}">
                    <button type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Login
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </a>
            @endauth
        </div>

        <button class="p-6 md:hidden" onclick="handleMenu()">
            <i class="fa-solid fa-bars"></i>
        </button>
        
        <div id="nav-dialog" class="fixed z-10 bg-gradient-to-br from-blue-200 via-blue-50 to-transparent md:hidden inset-0 p-3 hidden">
            <div id="nav-bar" class="flex justify-between">
                <a href="#" id="brand">
                    <img class="object-cover max-w-30 max-h-20 ml-10" src="{{ asset('images/journylyLOGO.png') }}" alt="">
                </a>
                <button class="p-6 md:hidden" onclick="handleMenu()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div> 
            <div class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">home</a>
                <a href="{{ route('admin.feedbacks') }}" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">feedbacks</a>
                <a href="#" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Hotel</a>
                <a href="#" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Flight</a>
                <a href="#" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Bus</a>
                <a href="#" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Train</a>
            </div> 
            <div class="h-[1px] bg-gray-300"></div>
            <a href="{{ route('admin.login') }}">
                <button type="button" class="mr-12 mt-6 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    Login
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </a>    
        </div>
    </nav>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<div class="flex flex-col lg:flex-row min-h-screen">

    <!-- Main Content Area -->
    <div class="flex-1 p-8">
        <div class="max-w-4xl mx-auto">
            

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="mb-6 flex items-center justify-between">
                    
                    <h1 class="text-2xl font-semibold text-blue-900"><i class="fa-solid fa-plus mr-2"></i>Add New Bus</h1>
                    <a href="{{ route('admin.flightpanel') }}" class="text-blue-500 hover:text-blue-700">
                        <i class="fa-solid fa-arrow-left mr-2"></i>Back to Bus Panel
                    </a>
                </div>
                <form action="{{ route('admin.store-bus') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Operator Name</label>
                            <input type="text" name="operator_name" required class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">From Location</label>
                            <input type="text" name="from_location" required class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">To Location</label>
                            <input type="text" name="to_location" required class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Departure Time</label>
                            <input type="time" name="departure_time" required class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Arrival Time</label>
                            <input type="time" name="arrival_time" required class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Journey Date</label>
                            <input type="date" name="journey_date" required class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Original Price (BDT)</label>
                            <input type="number" name="original_price" step="0.01" required class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Discounted Price (BDT)</label>
                            <input type="number" name="discounted_price" step="0.01" required class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Available Seats</label>
                            <input type="number" name="available_seats" required class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bus Type</label>
                            <select name="bus_type" required class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="AC">AC</option>
                                <option value="Non AC">Non AC</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Boarding Point</label>
                            <input type="text" name="boarding_point" required class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Operator Logo</label>
                            <input type="file" name="operator_logo" accept="image/*" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('admin.buspanel') }}" class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            Add Bus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');

    // Mobile menu toggle
    mobileMenuBtn.addEventListener('click', function() {
        sidebar.classList.toggle('hidden');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth < 1024) {
            if (!sidebar.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                sidebar.classList.add('hidden');
            }
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            sidebar.classList.remove('hidden');
        } else {
            sidebar.classList.add('hidden');
        }
    });
});
</script>

</body>
</html>