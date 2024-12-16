<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Booking Page</title>
    <link href="./output.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://kit.fontawesome.com/4b5d033142.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-200 via-blue-50 to-transparent">
    <nav class="p-3 my-5 flex justify-between items-center">
        <a href="home.html" id="brand" >
          <img class="object-cover max-w-30 max-h-20 ml-10" src="./assets/journylyLOGO.png" alt="" >
        </a>
        <div id="nav-menu" class="hidden md:flex gap-10">
            <a href="{{ route('account.dashboard') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">home</a>
            <a href="hotelbook.html" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Hotel</a>
            <a href="airlineTticket.html" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Flight</a>
            <a href="busticket.html" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Bus</a>
            <a href="trainticket.html" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Train</a>
        </div>

        <div class="mr-12 hidden md:block relative" x-data="{ open: false }">
            @auth
                <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-blue-500">
                <i class="fa-duotone fa-solid fa-user" style="--fa-primary-color: #0080ff; --fa-secondary-color: #0080ff;"></i>
                    <span class="font-medium">{{ Auth::user()->name }}</span>
                    <i class="fa-solid fa-caret-down" style="--fa-primary-color: #0080ff;"></i>
                </button>
        
                <!-- Dropdown menu -->
                <div x-show="open" 
                    @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
                    <a href="{{ route('account.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('account.logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-50">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('account.login') }}">
                    <button type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Login
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </a>
            @endauth
        </div>

        </a>
        <button class="p-6 md:hidden" onclick="handleMenu()">
          <i class="fa-solid fa-bars"></i>
        </button>
         
        <div id="nav-dialog" class="fixed z-10 bg-gradient-to-br from-blue-200 via-blue-50 to-transparent md:hidden inset-0 p-3">
          <div id="nav-bar" class="flex justify-between">
            <a href="#" id="brand" >
              <img class="object-cover max-w-30 max-h-20 ml-10" src="./assets/journylyLOGO.png" alt="" >
            </a>
            <button class="p-6 md:hidden" onclick="handleMenu()">
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div> 
          <div class="mt-6">
            <a href="{{ route('account.dashboard') }}" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block ">home</a>
            <a href="hotelbook.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Hotel</a>
            <a href="airlineTticket.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Flight</a>
            <a href="busticket.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Bus</a>
            <a href="trainticket.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Train</a>
          </div> 
          <div class="h-[1px] bg-gray-300"></div>
          <a href="login.html">
          <button type="button" class=" mr-12 mt-6 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
            Login
            <i class="fa-solid fa-arrow-right"></i>
          </button>
          </a>    
        </div>
    </nav>
      <!--main-->
    <div class="container mx-auto p-4 bg-white rounded-lg">
        <!-- Search Bar -->
        <div class="flex flex-wrap items-center gap-4 bg-gradient-to-br from-blue-200 via-blue-50 to-transparent p-4 rounded-md shadow-md mb-4">
            <input type="text" placeholder="From" class="flex-1 border rounded-md p-2 border-blue-300">
            <input type="text" placeholder="To" class="flex-1 border rounded-md p-2 border-blue-300">
            <label>Departure </label>
            <input type="date" class="flex-1 border rounded-md p-2 border-blue-300">
            <label>Return</label>
            <input type="date" class="flex-1 border rounded-md p-2 border-blue-300">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:transition-scale duration-300 ease-in-out hover:scale-110">Search</button>
        </div>

        <!-- 
        <div class="my-4 bg-sky-100 p-2 rounded-md shadow-md flex justify-around text-blue-400 font-semibold">
            <span class="px-4 py-2 cursor-pointer hover: transition-scale duration-300 ease-in-out hover:scale-110">Choose Departing Ticket</span>
            <span class="px-4 py-2 cursor-pointer hover: transition-scale duration-300 ease-in-out hover:scale-110">Passenger Details</span>
            <span class="px-4 py-2 cursor-pointer hover: transition-scale duration-300 ease-in-out hover:scale-110">Review & Pay</span>
        </div>
        -->
        <!-- Main Content - Use flex-col for mobile and flex-row for larger screens -->
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Filter Section -->
            <div class="w-full lg:w-1/4 bg-gradient-to-br from-blue-200 via-blue-50 to-transparent p-4 rounded-md shadow-md">
                <h2 class="text-lg font-semibold mb-2">Filters</h2>
                <button class="w-full bg-blue-500 text-white py-2 rounded mb-4 hover:transition-scale duration-300 ease-in-out hover:scale-95">R E S E T</button>

                <!-- Bus Type Filter -->
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-700 mb-3">Train Type</h3>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 "> AC</label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2"> Non AC</label>
                </div>
                <div class="h-[1px] bg-gray-300 my-4"></div>

                <!-- Operator Filter -->
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-700 mb-3">Operator</h3>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2"> 	Subarna Express </label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2">  Mohanagar Express</label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2">  Ekota Express</label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2"> 	Tista Express</label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2"> Parabat Express</label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2"> 	Kapotaksha Express</label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2"> Sundarban Express</label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2">  Rupsha Express</label>
                </div>
                <div class="h-[1px] bg-gray-300 my-4"></div>

                <!-- Boarding Point Filter -->
                <div>
                    <h3 class="font-semibold text-blue-800 mb-3">Train Class</h3>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2"> AC_B</label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2"> AC_S</label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2"> SNIGDHA</label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2"> F_BERTH</label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2"> F_SEAT</label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2"> F_CHAIR</label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2"> S_CHAIR</label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2"> SHOVAN</label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2"> SHULOV</label>
                    <label class="block text-sm font-medium"><input type="checkbox" class="mr-2 my-2"> AC_CHAIR</label>
                </div>
                <div class="h-[1px] bg-gray-300 my-4"></div>

                    <!-- Arrival Filter -->
                <div class="bg-white p-4 shadow rounded-lg mb-3">
                    <h2 class="font-semibold mb-2">Arrival time</h2>
                    <div class="grid grid-cols-2 gap-2">
                        <button class="hover:bg-blue-400 transition-colors duration-500 ease-in-out bg-gray-100 p-2 rounded">12am - 6am</button>
                        <button class="hover:bg-blue-400 transition-colors duration-500 ease-in-out bg-gray-100 p-2 rounded">6am - 12pm</button>
                        <button class="hover:bg-blue-400 transition-colors duration-500 ease-in-out bg-gray-100 p-2 rounded">12pm - 6pm</button>
                        <button class="hover:bg-blue-400 transition-colors duration-500 ease-in-out bg-gray-100 p-2 rounded">6pm - 12am</button>
                    <!-- Add more time slots as needed -->
                    </div>
                </div>
                <!-- Departure Filter -->
                <div class="bg-white p-4 shadow rounded-lg">
                    <h2 class="font-semibold mb-2">Departure time</h2>
                    <div class="grid grid-cols-2 gap-2">
                        <button class="hover:bg-blue-400 transition-colors duration-500 ease-in-out bg-gray-100 p-2 rounded">12am - 6am</button>
                        <button class="hover:bg-blue-400 transition-colors duration-500 ease-in-out bg-gray-100 p-2 rounded">6am - 12pm</button>
                        <button class="hover:bg-blue-400 transition-colors duration-500 ease-in-out bg-gray-100 p-2 rounded">12pm - 6pm</button>
                        <button class="hover:bg-blue-400 transition-colors duration-500 ease-in-out bg-gray-100 p-2 rounded">6pm - 12am</button>
                    <!-- Add more time slots as needed -->
                    </div>
                </div>

                <div class="h-[1px] bg-gray-300 my-4"></div>

                
            </div>

            <!-- Trainss Listing Section -->
            <div class="w-full lg:w-3/4 bg-gradient-to-br from-blue-200 via-blue-50 to-transparent p-4 rounded-md shadow-md">
                <!-- Sort Options -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold"> 4 Available Trains</h2>
                    <div>
                        <button class="px-4 py-2 text-sm bg-blue-300 rounded-l-md my-2">Low to High</button>
                        <button class="px-4 py-2 text-sm bg-blue-300 rounded-r-md my-2">High to Low</button>
                    </div>
                </div>

                <!-- Train Card -->
                <div class="bg-white p-4 shadow rounded-lg">
                    
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                      <div class="flex items-center gap-2">
                        <!--<img src="assets/buslogo/akota.jpg" alt="Akota Transport" class="w-12 h-12">-->
                        <h2 class="text-lg font-semibold flex-1">Mohanagar Express</h2>
                        <!--<p class="text-gray-500 text-sm">#82502 | Depart on: <span class="font-medium text-green-600">SMTWTFS</span></p>-->
                      </div>
                      <div class="flex gap-2 items-center">
                        <div class="text-center ">
                          <p class="text-sm font-medium">6:00 PM</p>
                          <p class="text-gray-500 text-xs">Dhaka</p>
                        </div>
                        <div class="text-center mx-2 text-gray-500">---6h 0m---</div>
                        <div class="text-center">
                          <p class="text-sm font-medium">12:00 AM</p>
                          <p class="text-gray-500 text-xs">Rajshahi</p>
                        </div>
                      </div>
                      <a href="#" class="text-blue-500 text-sm">View Route</a>
                    </div>
                  
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 bg-gradient-to-br from-blue-200 via-blue-50 to-transparent p-4 rounded-md shadow-md">
                      <!-- Class Card 1 -->
                      <div class="border bg-white p-4 rounded-lg flex flex-col justify-between hover:transition-scale duration-300 ease-in-out hover:scale-95">
                        <div>
                          <p class="text-sm font-medium">
                            <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded">AC_B</span>
                          </p>
                          <p class="text-sm font-semibold mt-2 text-gray-500 line-through">BDT 1,000৳</p>
                          <p class="text-lg font-semibold ">BDT 900৳</p>
                          <p class="text-green-600 text-sm font-medium mt-1">Available 149</p>
                          <!--<p class="text-gray-500 text-xs">Free Cancellation</p>
                          <p class="text-gray-400 text-xs">Updated 1 hr ago</p>-->
                        </div>
                        <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full text-center hover:transition-scale duration-300 ease-in-out hover:scale-110">Book</button>
                      </div>
                  
                      <!-- Class Card 2 -->
                      <div class="border bg-white p-4 rounded-lg flex flex-col justify-between hover:transition-scale duration-300 ease-in-out hover:scale-95">
                        <div>
                          <p class="text-sm font-medium">
                            <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded">SNIGDHA</span>
                          </p>
                          <p class="text-sm font-semibold mt-2 text-gray-500 line-through">BDT 1,000৳</p>
                          <p class="text-lg font-semibold">688৳</p>
                          <p class="text-green-600 text-sm font-medium mt-1">Available 1</p>
                        </div>
                        <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full text-center hover:transition-scale duration-300 ease-in-out hover:scale-110">Book</button>
                      </div>
                  
                      <!-- Class Card 3 -->
                      <div class="border bg-white p-4 rounded-lg flex flex-col justify-between hover:transition-scale duration-300 ease-in-out hover:scale-95">
                        <div>
                          <p class="text-sm font-medium">
                            <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded"> S_CHAIR</span>
                          </p>
                          <p class="text-sm font-semibold mt-2 text-gray-500 line-through">BDT 1,000৳</p>
                          <p class="text-lg font-semibold">700৳</p>
                          <p class="text-green-600 text-sm font-medium mt-1">Available 15</p>
                        </div>
                        <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full text-center hover:transition-scale duration-300 ease-in-out hover:scale-110">Book</button>
                      </div>
                  
                      <!-- Class Card 4 -->
                      <div class="border bg-white p-4 rounded-lg flex flex-col justify-between hover:transition-scale duration-300 ease-in-out hover:scale-95">
                        <div>
                          <p class="text-sm font-medium">
                            <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded">SHOVAN</span>
                          </p>
                          <p class="text-sm font-semibold mt-2 text-gray-500 line-through">BDT 1,000৳</p>
                          <p class="text-lg font-semibold mt-2">749৳</p>
                          <p class="text-green-600 text-sm font-medium mt-1">Available 9</p>
                        </div>
                        <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full text-center hover:transition-scale duration-300 ease-in-out hover:scale-110">Book</button>
                      </div>
                    </div>
                </div>


                <div class="bg-white p-4 shadow rounded-lg my-4">
                    
                  <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                    <div class="flex items-center gap-2">
                      <!--<img src="assets/buslogo/akota.jpg" alt="Akota Transport" class="w-12 h-12">-->
                      <h2 class="text-lg font-semibold flex-1">Mohanagar Express</h2>
                      <!--<p class="text-gray-500 text-sm">#82502 | Depart on: <span class="font-medium text-green-600">SMTWTFS</span></p>-->
                    </div>
                    <div class="flex gap-2 items-center">
                      <div class="text-center ">
                        <p class="text-sm font-medium">6:00 PM</p>
                        <p class="text-gray-500 text-xs">Dhaka</p>
                      </div>
                      <div class="text-center mx-2 text-gray-500">---6h 0m---</div>
                      <div class="text-center">
                        <p class="text-sm font-medium">12:00 AM</p>
                        <p class="text-gray-500 text-xs">Rajshahi</p>
                      </div>
                    </div>
                    <a href="#" class="text-blue-500 text-sm">View Route</a>
                  </div>
                
                  <div class="grid grid-cols-2 md:grid-cols-4 gap-4 bg-gradient-to-br from-blue-200 via-blue-50 to-transparent p-4 rounded-md shadow-md">
                    <!-- Class Card 1 -->
                    <div class="border bg-white p-4 rounded-lg flex flex-col justify-between hover:transition-scale duration-300 ease-in-out hover:scale-95">
                      <div>
                        <p class="text-sm font-medium">
                          <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded">AC_B</span>
                        </p>
                        <p class="text-sm font-semibold mt-2 text-gray-500 line-through">BDT 1,000৳</p>
                        <p class="text-lg font-semibold ">BDT 900৳</p>
                        <p class="text-green-600 text-sm font-medium mt-1">Available 149</p>
                        <!--<p class="text-gray-500 text-xs">Free Cancellation</p>
                        <p class="text-gray-400 text-xs">Updated 1 hr ago</p>-->
                      </div>
                      <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full text-center hover:transition-scale duration-300 ease-in-out hover:scale-110">Book</button>
                    </div>
                
                    <!-- Class Card 2 -->
                    <div class="border bg-white p-4 rounded-lg flex flex-col justify-between hover:transition-scale duration-300 ease-in-out hover:scale-95">
                      <div>
                        <p class="text-sm font-medium">
                          <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded">SNIGDHA</span>
                        </p>
                        <p class="text-sm font-semibold mt-2 text-gray-500 line-through">BDT 1,000৳</p>
                        <p class="text-lg font-semibold">688৳</p>
                        <p class="text-green-600 text-sm font-medium mt-1">Available 1</p>
                      </div>
                      <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full text-center hover:transition-scale duration-300 ease-in-out hover:scale-110">Book</button>
                    </div>
                
                    <!-- Class Card 3 -->
                    <div class="border bg-white p-4 rounded-lg flex flex-col justify-between hover:transition-scale duration-300 ease-in-out hover:scale-95">
                      <div>
                        <p class="text-sm font-medium">
                          <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded"> S_CHAIR</span>
                        </p>
                        <p class="text-sm font-semibold mt-2 text-gray-500 line-through">BDT 1,000৳</p>
                        <p class="text-lg font-semibold">700৳</p>
                        <p class="text-green-600 text-sm font-medium mt-1">Available 15</p>
                      </div>
                      <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full text-center hover:transition-scale duration-300 ease-in-out hover:scale-110">Book</button>
                    </div>
                
                    <!-- Class Card 4 -->
                    <div class="border bg-white p-4 rounded-lg flex flex-col justify-between hover:transition-scale duration-300 ease-in-out hover:scale-95">
                      <div>
                        <p class="text-sm font-medium">
                          <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded">SHOVAN</span>
                        </p>
                        <p class="text-sm font-semibold mt-2 text-gray-500 line-through">BDT 1,000৳</p>
                        <p class="text-lg font-semibold mt-2">749৳</p>
                        <p class="text-green-600 text-sm font-medium mt-1">Available 9</p>
                      </div>
                      <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full text-center hover:transition-scale duration-300 ease-in-out hover:scale-110">Book</button>
                    </div>
                  </div>
              </div>


              <div class="bg-white p-4 shadow rounded-lg my-4">
                    
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                  <div class="flex items-center gap-2">
                    <!--<img src="assets/buslogo/akota.jpg" alt="Akota Transport" class="w-12 h-12">-->
                    <h2 class="text-lg font-semibold flex-1">Mohanagar Express</h2>
                    <!--<p class="text-gray-500 text-sm">#82502 | Depart on: <span class="font-medium text-green-600">SMTWTFS</span></p>-->
                  </div>
                  <div class="flex gap-2 items-center">
                    <div class="text-center ">
                      <p class="text-sm font-medium">6:00 PM</p>
                      <p class="text-gray-500 text-xs">Dhaka</p>
                    </div>
                    <div class="text-center mx-2 text-gray-500">---6h 0m---</div>
                    <div class="text-center">
                      <p class="text-sm font-medium">12:00 AM</p>
                      <p class="text-gray-500 text-xs">Rajshahi</p>
                    </div>
                  </div>
                  <a href="#" class="text-blue-500 text-sm">View Route</a>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 bg-gradient-to-br from-blue-200 via-blue-50 to-transparent p-4 rounded-md shadow-md">
                  <!-- Class Card 1 -->
                  <div class="border bg-white p-4 rounded-lg flex flex-col justify-between hover:transition-scale duration-300 ease-in-out hover:scale-95">
                    <div>
                       <p class="text-sm font-medium">
                        <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded">AC_B</span>
                      </p>
                      <p class="text-sm font-semibold mt-2 text-gray-500 line-through">BDT 1,000৳</p>
                      <p class="text-lg font-semibold ">BDT 900৳</p>
                      <p class="text-green-600 text-sm font-medium mt-1">Available 149</p>
                      <!--<p class="text-gray-500 text-xs">Free Cancellation</p>
                      <p class="text-gray-400 text-xs">Updated 1 hr ago</p>-->
                    </div>
                    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full text-center hover:transition-scale duration-300 ease-in-out hover:scale-110">Book</button>
                  </div>
                
                  <!-- Class Card 2 -->
                  <div class="border bg-white p-4 rounded-lg flex flex-col justify-between hover:transition-scale duration-300 ease-in-out hover:scale-95">
                    <div>
                      <p class="text-sm font-medium">
                        <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded">SNIGDHA</span>
                      </p>
                      <p class="text-sm font-semibold mt-2 text-gray-500 line-through">BDT 1,000৳</p>
                      <p class="text-lg font-semibold">688৳</p>
                      <p class="text-green-600 text-sm font-medium mt-1">Available 1</p>
                    </div>
                    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full text-center hover:transition-scale duration-300 ease-in-out hover:scale-110">Book</button>
                  </div>
                
                  <!-- Class Card 3 -->
                  <div class="border bg-white p-4 rounded-lg flex flex-col justify-between hover:transition-scale duration-300 ease-in-out hover:scale-95">
                    <div>
                      <p class="text-sm font-medium">
                        <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded"> S_CHAIR</span>
                        </p>
                      <p class="text-sm font-semibold mt-2 text-gray-500 line-through">BDT 1,000৳</p>
                      <p class="text-lg font-semibold">700৳</p>
                      <p class="text-green-600 text-sm font-medium mt-1">Available 15</p>
                    </div>
                    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full text-center hover:transition-scale duration-300 ease-in-out hover:scale-110">Book</button>
                  </div>
                
                  <!-- Class Card 4 -->
                  <div class="border bg-white p-4 rounded-lg flex flex-col justify-between hover:transition-scale duration-300 ease-in-out hover:scale-95">
                    <div>
                      <p class="text-sm font-medium">
                        <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded">SHOVAN</span>
                      </p>
                      <p class="text-sm font-semibold mt-2 text-gray-500 line-through">BDT 1,000৳</p>
                      <p class="text-lg font-semibold mt-2">749৳</p>
                      <p class="text-green-600 text-sm font-medium mt-1">Available 9</p>
                    </div>
                    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full text-center hover:transition-scale duration-300 ease-in-out hover:scale-110">Book</button>
                  </div>
                </div>
            </div>

              <div class="bg-white p-4 shadow rounded-lg my-4">
                    
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                  <div class="flex items-center gap-2">
                    <!--<img src="assets/buslogo/akota.jpg" alt="Akota Transport" class="w-12 h-12">-->
                    <h2 class="text-lg font-semibold flex-1">Mohanagar Express</h2>
                    <!--<p class="text-gray-500 text-sm">#82502 | Depart on: <span class="font-medium text-green-600">SMTWTFS</span></p>-->
                  </div>
                  <div class="flex gap-2 items-center">
                    <div class="text-center ">
                      <p class="text-sm font-medium">6:00 PM</p>
                      <p class="text-gray-500 text-xs">Dhaka</p>
                    </div>
                    <div class="text-center mx-2 text-gray-500">---6h 0m---</div>
                    <div class="text-center">
                      <p class="text-sm font-medium">12:00 AM</p>
                      <p class="text-gray-500 text-xs">Rajshahi</p>
                    </div>
                  </div>
                  <a href="#" class="text-blue-500 text-sm">View Route</a>
                </div>
              
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 bg-gradient-to-br from-blue-200 via-blue-50 to-transparent p-4 rounded-md shadow-md">
                  <!-- Class Card 1 -->
                  <div class="border bg-white p-4 rounded-lg flex flex-col justify-between hover:transition-scale duration-300 ease-in-out hover:scale-95">
                    <div>
                      <p class="text-sm font-medium">
                        <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded">AC_B</span>
                      </p>
                      <p class="text-sm font-semibold mt-2 text-gray-500 line-through">BDT 1,000৳</p>
                      <p class="text-lg font-semibold ">BDT 900৳</p>
                      <p class="text-green-600 text-sm font-medium mt-1">Available 149</p>
                      <!--<p class="text-gray-500 text-xs">Free Cancellation</p>
                      <p class="text-gray-400 text-xs">Updated 1 hr ago</p>-->
                    </div>
                    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full text-center hover:transition-scale duration-300 ease-in-out hover:scale-110">Book</button>
                  </div>
              
                  <!-- Class Card 2 -->
                  <div class="border bg-white p-4 rounded-lg flex flex-col justify-between hover:transition-scale duration-300 ease-in-out hover:scale-95">
                    <div>
                      <p class="text-sm font-medium">
                        <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded">SNIGDHA</span>
                      </p>
                      <p class="text-sm font-semibold mt-2 text-gray-500 line-through">BDT 1,000৳</p>
                      <p class="text-lg font-semibold">688৳</p>
                      <p class="text-green-600 text-sm font-medium mt-1">Available 1</p>
                    </div>
                    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full text-center hover:transition-scale duration-300 ease-in-out hover:scale-110">Book</button>
                  </div>
              
                  <!-- Class Card 3 -->
                  <div class="border bg-white p-4 rounded-lg flex flex-col justify-between hover:transition-scale duration-300 ease-in-out hover:scale-95">
                    <div>
                      <p class="text-sm font-medium">
                        <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded"> S_CHAIR</span>
                      </p>
                      <p class="text-sm font-semibold mt-2 text-gray-500 line-through">BDT 1,000৳</p>
                      <p class="text-lg font-semibold">700৳</p>
                      <p class="text-green-600 text-sm font-medium mt-1">Available 15</p>
                    </div>
                    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full text-center hover:transition-scale duration-300 ease-in-out hover:scale-110">Book</button>
                  </div>
              
                  <!-- Class Card 4 -->
                  <div class="border bg-white p-4 rounded-lg flex flex-col justify-between hover:transition-scale duration-300 ease-in-out hover:scale-95">
                    <div>
                      <p class="text-sm font-medium">
                        <span class="bg-orange-200 text-orange-700 px-2 py-1 rounded">SHOVAN</span>
                      </p>
                      <p class="text-sm font-semibold mt-2 text-gray-500 line-through">BDT 1,000৳</p>
                      <p class="text-lg font-semibold mt-2">749৳</p>
                      <p class="text-green-600 text-sm font-medium mt-1">Available 9</p>
                    </div>
                    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full text-center hover:transition-scale duration-300 ease-in-out hover:scale-110">Book</button>
                  </div>
                </div>
              </div>
                
                      
                
                    <!--<a href="#" class="text-blue-500 text-sm mt-4 block">Nearby dates</a>
                  </div>-->
                
                
                

            </div>
        </div>
    </div>
</body>
<script src="script.js"></script>
</html>
