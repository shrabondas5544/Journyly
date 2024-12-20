<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <title>admin dashboard</title>
  <script src="https://kit.fontawesome.com/4b5d033142.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
  <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>  
  @vite('resources/css/app.css')
</head>
<body class=" min-h-screen bg-gradient-to-br from-blue-200 via-blue-50 to-transparent">
  <nav class="p-3 flex mt-2 justify-between items-center">
    <a href="dashboard" id="brand" >
      <img class="object-cover max-w-30 max-h-20 ml-10" src="{{ asset('images/journylyLOGO.png') }}" alt="" >
    </a>
    <div id="nav-menu" class="hidden md:flex gap-10">
      <a href="dashboard" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">home</a>
      <a href="{{ route('admin.feedbacks') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">feedbacks</a>
      <a href="hotelbook.html" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Hotel</a>
      <a href="{{ route('admin.flightpanel') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Flight</a>
      <a href="{{ route('admin.buspanel') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Bus</a>
      <a href="trainticket.html" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Train</a>
    </div>

    <div class="mr-12 hidden md:block relative" x-data="{ open: false }">
        @auth
            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110">
              <i class="fa-duotone fa-solid fa-user" style="--fa-primary-color: #0080ff; --fa-secondary-color: #0080ff;"></i>
                <span class="font-medium">{{ Auth::user()->name }}</span>
                <i class="fa-solid fa-caret-down" style="--fa-primary-color: #0080ff;"></i>
            </button>
        
            <!-- Dropdown menu -->
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
        <a href="home.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block ">home</a>
        <a href="hotelbook.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Hotel</a>
        <a href="airlineTticket.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Flight</a>
        <a href="busticket.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Bus</a>
        <a href="trainticket.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Train</a>
      </div> 
      <div class="h-[1px] bg-gray-300"></div>
      <a href="{{ route('admin.login') }}">
      <button type="button" class=" mr-12 mt-6 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
        Login
        <i class="fa-solid fa-arrow-right"></i>
      </button>
      </a>    
    </div>
  </nav>
</body>
<script src="script.js"></script>
</html>