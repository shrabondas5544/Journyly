<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Flight</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/4b5d033142.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-blue-200 via-blue-50 to-transparent min-h-screen">
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
<!----------------------------------------------------------------------------------------------------------------------------------------->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <i class="fa-solid fa-plane text-3xl text-blue-500 mr-4"></i>
                    <h1 class="text-2xl font-semibold text-blue-900">Add New Flight</h1>
                </div>
                <a href="{{ route('admin.flightpanel') }}" class="text-blue-500 hover:text-blue-700">
                    <i class="fa-solid fa-arrow-left mr-2"></i>Back to Flight Panel
                </a>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.store-flight') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Flight Information -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Airline Name</label>
                        <input type="text" name="airline_name" value="{{ old('airline_name') }}" 
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 shadow-sm"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Flight Number</label>
                        <input type="text" name="flight_number" value="{{ old('flight_number') }}"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 shadow-sm"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">From Location</label>
                        <input type="text" name="from_location" value="{{ old('from_location') }}"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 shadow-sm"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">To Location</label>
                        <input type="text" name="to_location" value="{{ old('to_location') }}"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 shadow-sm"
                            required>
                    </div>

                    <!-- Time and Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Departure Time Slot</label>
                        <select name="departure_time_slot" 
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 shadow-sm"
                            required>
                            <option value="12am_6am" {{ old('departure_time_slot') == '12am_6am' ? 'selected' : '' }}>12 AM - 6 AM</option>
                            <option value="6am_12pm" {{ old('departure_time_slot') == '6am_12pm' ? 'selected' : '' }}>6 AM - 12 PM</option>
                            <option value="12pm_6pm" {{ old('departure_time_slot') == '12pm_6pm' ? 'selected' : '' }}>12 PM - 6 PM</option>
                            <option value="6pm_12am" {{ old('departure_time_slot') == '6pm_12am' ? 'selected' : '' }}>6 PM - 12 AM</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Arrival Time Slot</label>
                        <select name="arrival_time_slot" 
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 shadow-sm"
                            required>
                            <option value="12am_6am" {{ old('arrival_time_slot') == '12am_6am' ? 'selected' : '' }}>12 AM - 6 AM</option>
                            <option value="6am_12pm" {{ old('arrival_time_slot') == '6am_12pm' ? 'selected' : '' }}>6 AM - 12 PM</option>
                            <option value="12pm_6pm" {{ old('arrival_time_slot') == '12pm_6pm' ? 'selected' : '' }}>12 PM - 6 PM</option>
                            <option value="6pm_12am" {{ old('arrival_time_slot') == '6pm_12am' ? 'selected' : '' }}>6 PM - 12 AM</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Departure Date</label>
                        <input type="date" name="departure_date" value="{{ old('departure_date') }}"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 shadow-sm"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Return Date (Optional)</label>
                        <input type="date" name="return_date" value="{{ old('return_date') }}"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 shadow-sm">
                    </div>

                    <!-- Pricing and Seats -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Original Price (BDT)</label>
                        <input type="number" name="original_price" value="{{ old('original_price') }}"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 shadow-sm"
                            required min="0" step="0.01">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Discounted Price (BDT)</label>
                        <input type="number" name="discounted_price" value="{{ old('discounted_price') }}"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 shadow-sm"
                            required min="0" step="0.01">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Available Seats</label>
                        <input type="number" name="available_seats" value="{{ old('available_seats') }}"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 shadow-sm"
                            required min="0">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Baggage Allowance (KG)</label>
                        <input type="number" name="baggage_allowance" value="{{ old('baggage_allowance') }}"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 shadow-sm"
                            required min="0">
                    </div>

                    <!-- Flight Class -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Flight Class</label>
                        <select name="flight_class" 
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 shadow-sm"
                            required>
                            <option value="Economy" {{ old('flight_class') == 'Economy' ? 'selected' : '' }}>Economy</option>
                            <option value="Business" {{ old('flight_class') == 'Business' ? 'selected' : '' }}>Business</option>
                            <option value="First" {{ old('flight_class') == 'First' ? 'selected' : '' }}>First</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Airline Logo</label>
                        <input type="file" name="airline_logo" accept="image/*"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 shadow-sm">
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="window.location='{{ route('admin.flightpanel') }}'"
                        class="px-4 py-2 border bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">
                        Add Flight
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Add validation for discounted price
        document.querySelector('form').addEventListener('submit', function(e) {
            const originalPrice = parseFloat(document.querySelector('[name="original_price"]').value);
            const discountedPrice = parseFloat(document.querySelector('[name="discounted_price"]').value);

            if (discountedPrice > originalPrice) {
                e.preventDefault();
                alert('Discounted price cannot be greater than original price');
            }
        });

        // Set minimum dates
        const today = new Date().toISOString().split('T')[0];
        const departureInput = document.querySelector('[name="departure_date"]');
        const returnInput = document.querySelector('[name="return_date"]');

        departureInput.min = today;
        
        departureInput.addEventListener('change', function() {
            returnInput.min = this.value;
            if (returnInput.value && returnInput.value < this.value) {
                returnInput.value = this.value;
            }
        });
    </script>
</body>
</html>