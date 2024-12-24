<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/4b5d033142.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
  <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>  
  @vite('resources/css/app.css')
</head>
<body class=" min-h-screen bg-gradient-to-br from-blue-200 via-blue-50 to-transparent" x-data="{ showSuccess: {{ Session::has('success') ? 'true' : 'false' }} }" x-init="setTimeout(() => { showSuccess = false }, 5000)">
<!-- Success Alert -->
  <div x-show="showSuccess"
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0 transform -translate-y-2"
       x-transition:enter-end="opacity-100 transform translate-y-0"
       x-transition:leave="transition ease-in duration-300"
       x-transition:leave-start="opacity-100 transform translate-y-0"
       x-transition:leave-end="opacity-0 transform -translate-y-2"
       class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-auto max-w-md">
    <div class="flex items-center p-3 bg-green-100 rounded-lg shadow-lg">
      <svg class="flex-shrink-0 w-6 h-6 text-green-700" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
      </svg>
      <div class="ml-3 text-base font-medium text-green-700">
        {{ Session::get('success') }}
      </div>
    </div>
  </div>

  <nav class="p-3 flex mt-5 justify-between items-center">
    <a href="dashboard" id="brand" >
      <img class="object-cover max-w-30 max-h-20 ml-10" src="./assets/journylyLOGO.png" alt="" >
    </a>
    <div id="nav-menu" class="hidden md:flex gap-10">
      <a href="{{ route('account.dashboard') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">home</a>
      <a href="hotelbook.html" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Hotel</a>
      <a href="{{ route('account.flight.search') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Flight</a>
      <a href="{{ route('account.bus.search') }}" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Bus</a>
      <a href="" class="font-medium hover:text-blue-500 transition-scale duration-300 ease-in-out hover:scale-110 ">Train</a>
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
                <a href="{{ route('account.userprofile') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 transition-colors duration-300 ease-in-out rounded-lg ">
                    Profile
                </a>
                <a href="{{ route('account.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-400 transition-colors duration-300 ease-in-out rounded-lg">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('account.logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-400 transition-colors duration-300 ease-in-out rounded-lg">
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
        <a href="{{ route('account.flight.search') }}" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Flight</a>
        <a href="{{ route('account.bus.search') }}" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Bus</a>
        <a href="trainticket.html" class="font-medium m-3 p-3 hover:bg-blue-400 transition-colors duration-500 ease-in-out rounded-lg block">Train</a>
      </div> 
      <div class="h-[1px] bg-gray-300"></div>
      <a href="welcome">
      <button type="button" class=" mr-12 mt-6 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
        Login
        <i class="fa-solid fa-arrow-right"></i>
      </button>
      </a>    
    </div>
  </nav>
  <main class="container mx-auto max-w-4xl px-4 py-8">
    <div class="bg-white rounded-lg p-8 shadow">
      <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Privacy Policy</h1>
        <p class="text-gray-600 mb-8">Last Updated: December 15, 2024</p>

        <div class="space-y-6">
        <section>
            <h2 class="text-xl font-semibold mb-4">1. Information We Collect</h2>
            <p class="text-gray-600 mb-3">At Journyly, we collect various types of information to provide and improve our services:</p>
            <ul class="list-disc pl-5 space-y-2 text-gray-600">
              <li>Personal identification information (Name, email, phone number)</li>
              <li>Travel preferences and booking history</li>
              <li>Payment information</li>
              <li>Device and usage information</li>
            </ul>
        </section>

        <section>
            <h2 class="text-xl font-semibold mb-4">2. How We Use Your Information</h2>
            <p class="text-gray-600 mb-3">We use the collected information for the following purposes:</p>
            <ul class="list-disc pl-5 space-y-2 text-gray-600">
              <li>Processing your bookings and transactions</li>
              <li>Providing customer support</li>
              <li>Sending important service updates</li>
              <li>Improving our services</li>
            </ul>
        </section>

        <section>
            <h2 class="text-xl font-semibold mb-4">3. Information Sharing</h2>
            <p class="text-gray-600 mb-3">We may share your information with:</p>
            <ul class="list-disc pl-5 space-y-2 text-gray-600">
              <li>Service providers to fulfill your bookings</li>
              <li>Payment processors for transactions</li>
              <li>Legal authorities when required</li>
              <li>Third-party service providers</li>
            </ul>
        </section>

        <section>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">2. How We Use Your Information</h2>
            <p class="text-gray-600 leading-relaxed mb-3">
                We use the collected information for the following purposes:
            </p>
            <ul class="list-disc ml-6 text-gray-600 space-y-2">
                <li>Processing your bookings and transactions</li>
                <li>Providing customer support</li>
                <li>Sending important service updates</li>
                <li>Improving our services</li>
            </ul>
        </section>

        <section>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">4. Data Security</h2>
            <p class="text-gray-600 leading-relaxed">
                We implement appropriate security measures to protect your information. This includes encryption,
                secure data storage, and regular security assessments. However, no method of transmission over
                the internet is 100% secure.
            </p>
        </section>

        <!-- User Rights Section -->
        <section>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">5. Your Rights</h2>
            <p class="text-gray-600 leading-relaxed mb-3">
                You have certain rights regarding your personal data:
            </p>
            <ul class="list-disc ml-6 text-gray-600 space-y-2">
                <li>Access your personal information</li>
                <li>Request corrections to your data</li>
                <li>Delete your account</li>
                <li>Opt-out of marketing communications</li>
            </ul>
        </section>

        <!-- Cookies Section -->
        <section>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">6. Cookies and Tracking</h2>
            <p class="text-gray-600 leading-relaxed">
                We use cookies and similar tracking technologies to improve your browsing experience,
                analyze site traffic, and understand where our visitors come from.
            </p>
        </section>

        <!-- FAQ Section -->
        <section>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">6. FAQ</h2>
            <p class="text-gray-600 leading-relaxed mb-2">
            1. What personal information does Journyly collect?
            We collect personal identification information such as your name, email, phone number, travel preferences, booking history, payment details, and device usage information to provide and improve our services.</p>
            <p class="text-gray-600 leading-relaxed mb-2">
            2. How can I access or update my personal information?
            You can access or update your personal information by logging into your Journyly account or contacting our support team at support@journyly.com.</p>
            <p class="text-gray-600 leading-relaxed mb-2">
            3. Is my payment information secure?
            Yes, we use secure encryption methods and payment processors to ensure that your payment information is protected during transactions.</p>
            <p class="text-gray-600 leading-relaxed mb-2">
            4. Can I delete my account?
            Yes, you can request to delete your account by contacting our support team. Please note that some information may be retained as required by law.</p>
            <p class="text-gray-600 leading-relaxed mb-2">
            5. How does Journyly use cookies?
            We use cookies to enhance your browsing experience, analyze site traffic, and understand visitor behavior. You can manage your cookie preferences in your browser settings.</p>
            <p class="text-gray-600 leading-relaxed mb-2">
            6. Will my information be shared with third parties?
            Your information may be shared with trusted service providers, payment processors, and legal authorities as needed to fulfill bookings and comply with regulations.</p>
            <p class="text-gray-600 leading-relaxed mb-2">
            7. How can I opt-out of marketing communications?
            You can opt-out of marketing communications by clicking the "unsubscribe" link in our emails or updating your preferences in your account settings.</p>
            <p class="text-gray-600 leading-relaxed mb-2">
            8. What should I do if I suspect unauthorized access to my account?
            If you suspect unauthorized access, please change your password immediately and contact our support team for assistance.</p>
        </section>

        <!-- Contact Section -->
        <section>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">7. Contact Us</h2>
            <p class="text-gray-600 leading-relaxed">
                For questions about this Privacy Policy, please contact us at:
            </p>
            <ul class="list-none mt-2 text-gray-600">
                <li>Email: support@journyly.com</li>
                <li>Phone: +880 1234-567890</li>
                <li>Address: Dhaka, Bangladesh</li>
            </ul>
        </section>

        </div>
      </div>
    </div>
  </main>

  <footer class="relative bg-blueGray-200 pt-8 pb-6">
    <div class="container mx-auto px-4">
      <div class="flex flex-wrap text-left lg:text-left">
        <div class="w-full lg:w-6/12 px-4">
          <h4 class="text-3xl fonat-semibold text-blueGray-700">Let's keep in touch!</h4>
          <h5 class="text-lg mt-0 mb-2 text-blueGray-600">
            Find us on any of these platforms, we respond 1-2 business days.
          </h5>
          <h6 class="text-sm mt-0 text-blueGray-600">Email: support@journyly.com</h6>
          <h6 class="text-sm mt-0 text-blueGray-600">Phone: +880 1234-567890</h6>
          <h6 class="text-sm mt-0 mb-2 text-blueGray-600">Address: Dhaka, Bangladesh</h6>
          <div class="mt-6 lg:mb-0 mb-6">
            <button class="bg-white text-lightBlue-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2" type="button">
              <i class="fab fa-twitter"></i></button><button class="bg-white text-lightBlue-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2" type="button">
              <i class="fab fa-facebook-square"></i></button><button class="bg-white text-pink-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2" type="button">
              <i class="fab fa-instagram"></i></button><button class="bg-white text-blueGray-800 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2" type="button">
              <i class="fab fa-github"></i>
            </button>
          </div>
        </div>
        <div class="w-full lg:w-6/12 px-4">
          <div class="flex flex-wrap items-top mb-6">
            <div class="w-full lg:w-4/12 px-4 ml-auto">
              <span class="block uppercase text-blueGray-500 text-sm font-semibold mb-2">Useful Links</span>
              <ul class="list-unstyled">
                <li>
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://www.creative-tim.com/presentation?ref=njs-profile">About Us</a>
                </li>
                <li>
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://blog.creative-tim.com?ref=njs-profile">Blog</a>
                </li>
                <li>
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm hover:text-blue-500 transition-scale duration-300 ease-in-out " 
                  href="https://github.com/shrabondas5544">Github</a>
                </li>
                <li>
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://www.creative-tim.com/bootstrap-themes/free?ref=njs-profile">Free Products</a>
                </li>
              </ul>
            </div>
            <div class="w-full lg:w-4/12 px-4">
              <span class="block uppercase text-blueGray-500 text-sm font-semibold mb-2">Other Resources</span>
              <ul class="list-unstyled">
                <li>
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm hover:text-blue-500 transition-scale duration-300 ease-in-out " 
                  href="https://github.com/shrabondas5544/Journyly/blob/main/LICENSE">MIT License</a>
                </li>
                <li>
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm hover:text-blue-500 transition-scale duration-300 ease-in-out " 
                  href="{{ route('terms') }}">Terms &amp; Conditions</a>
                </li>
                <li>
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm hover:text-blue-500 transition-scale duration-300 ease-in-out " 
                  href="{{ route('privacy') }}">Privacy &amp; Policy</a>
                </li>
                <li>
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://creative-tim.com/contact-us?ref=njs-profile">Contact Us</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-6 border-blueGray-300">
      <div class="flex flex-wrap items-center md:justify-between justify-center">
        <div class="w-full md:w-4/12 px-4 mx-auto text-center">
          <div class="text-sm text-blueGray-500 font-semibold py-1">
            Copyright © <span id="get-current-year">2024</span> Journyly by Shrabon.
          </div>
        </div>
      </div>
    </div>
  </footer>

</body>
<script>
const navDialog = document.getElementById('nav-dialog');
function handleMenu(){
    navDialog.classList.toggle('hidden');
}
</script>
</html>