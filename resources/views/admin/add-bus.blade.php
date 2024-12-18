<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Bus - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/4b5d033142.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-200 via-blue-50 to-transparent">

<!-- Mobile Menu Button -->
<div class="lg:hidden fixed top-4 left-4 z-50">
    <button id="mobileMenuBtn" class="p-2 bg-white rounded-lg shadow-lg">
        <i class="fa-solid fa-bars text-xl"></i>
    </button>
</div>

<div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Sidebar -->
    <div id="sidebar" class="fixed lg:relative hidden lg:flex flex-col bg-blue-50 text-gray-700 h-screen w-full lg:w-64 p-4 shadow-xl z-40 lg:z-0">
        <div>            
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('images/journylyLOGO.png') }}" alt="Logo" class="w-64 h-32 object-contain">
                </a>       
            </div>
        </div>
        <nav class="flex flex-col gap-1 min-w-[240px] p-2 font-sans text-base font-normal text-gray-700">
            <a href="#" class="flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-100 hover:bg-opacity-80 focus:bg-blue-200 focus:bg-opacity-80 active:bg-blue-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none">
                <div class="grid place-items-center mr-4">
                    <i class="fa-solid fa-user"></i>
                </div>User info
            </a>
            <!-- Add other sidebar items similar to your main panel -->
            <a href="{{ route('admin.buspanel') }}" class="flex items-center w-full p-3 bg-blue-100 rounded-lg text-start leading-tight">
                <div class="grid place-items-center mr-4">
                    <i class="fa-solid fa-bus"></i>
                </div>Bus Panel
            </a>
            <!-- Add logout form -->
            <form action="{{ route('admin.logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="flex items-center w-full p-3 rounded-lg text-start leading-tight hover:bg-blue-100">
                    <div class="grid place-items-center mr-4">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </div>
                    Log Out
                </button>
            </form>
        </nav>
    </div>

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
                    <!--<a href="{{ route('admin.buspanel') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                        Back to Bus Panel
                    </a>-->
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