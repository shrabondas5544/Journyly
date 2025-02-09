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
  <main class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white shadow-lg rounded-lg p-8">
            <h1 class="text-2xl font-bold mb-4">Terms and Conditions</h1>
            <p class="text-gray-600 mb-8">Last Updated: December 15, 2024</p>
            <p class="text-gray-600 mb-8">
            Welcome to Journyly! These Terms and Conditions outline the rules and regulations for the use of our travel planning and booking platform. 
            By accessing or using Journyly, you agree to comply with these terms. If you do not agree, please do not use our services.
            </p>

            <div class="space-y-8">
                <!-- Information Collection Section -->
                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">1. Acceptance of Terms</h2>
                    <p class="text-gray-600 leading-relaxed mb-3">
                    By creating an account, accessing, or using Journyly, you agree to abide by these Terms and Conditions, as well as any applicable laws and regulations.
                    </p>
                </section>

                <!-- Information Usage Section -->
                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">2. User Responsibilities</h2>
                    <p class="text-gray-600 leading-relaxed mb-3">
                        We use the collected information for the following purposes:
                    </p>
                    <ul class="list-disc ml-6 text-gray-600 space-y-2">
                        <li>You must be at least 18 years old to use Journyly.</li>
                        <li>You are responsible for ensuring the accuracy of the information provided during registration or booking.</li>
                        <li>Sending important service updates</li>
                        <li>Misuse of the platform, such as fraudulent bookings or inappropriate conduct, is strictly prohibited.</li>
                    </ul>
                </section>

                <!-- Information Sharing Section -->
                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">3. Services Offered</h2>
                    <p class="text-gray-600 leading-relaxed mb-3">
                      Journyly provides the following services:
                    </p>
                    <ul class="list-disc ml-6 text-gray-600 space-y-2">
                        <li>Destination exploration by state, district, or specific location.</li>
                        <li>Integrated booking for hotels, flights, and local tour guides.</li>
                        <li>Personalized itineraries and bundled travel deals.</li>
                    </ul>
                </section>

                <!-- Data Security Section -->
                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">4. Payments and Refunds</h2>
                    <p class="text-gray-600 leading-relaxed">             
                    </p>
                    <ul class="list-disc ml-6 text-gray-600 space-y-2">
                        <li>All payments are processed securely through third-party payment providers.</li>
                        <li>Refunds and cancellations are subject to the policies of the respective service providers (e.g., airlines, hotels).</li>
                    </ul>
                </section>

                <!-- User Rights Section -->
                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">5. Privacy and Security</h2>
                    <p class="text-gray-600 leading-relaxed mb-3">
                    We are committed to safeguarding your personal data. Please refer to our
                    <a class="text-blue-500 bg-blue-100" href="{{ route('privacy') }}">Privacy&Policy </a>for detailed information on how we handle your data.
                    </p>
                </section>

                <!-- Cookies Section -->
                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">6. Intellectual Property</h2>
                    <p class="text-gray-600 leading-relaxed">
                      All content, design, and features on Journyly are the intellectual property of Journyly and may not be reproduced, copied, or redistributed without prior permission.
                    </p>
                </section>

                <!-- Contact Section -->
                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">7. Limitation of Liability</h2>
                    <p class="text-gray-600 leading-relaxed">
                    Journyly is not liable for any loss, damages, or disruptions caused by third-party providers, unforeseen circumstances, or incorrect user inputs.
                    </p>
                </section>

                <!-- Contact Section -->
                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">8. Changes to Terms</h2>
                    <p class="text-gray-600 leading-relaxed">
                    We reserve the right to modify these Terms and Conditions at any time. Changes will be effective immediately upon posting
                    </p>
                </section>
                
                <!-- FAQ Section -->
                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">6. FAQ</h2>
                    <p class="text-gray-600 leading-relaxed mb-2">
                    1. What can I do on Journyly?
                    Journyly allows you to explore destinations, book hotels and flights, connect with tour guides, and create personalized travel itineraries.</p>
                    <p class="text-gray-600 leading-relaxed mb-2">
                    2. How do I book a hotel or flight?
                    You can use the integrated booking system on Journyly to reserve accommodations and flights directly through the platform.</p>
                    <p class="text-gray-600 leading-relaxed mb-2">
                    3. Is my payment information secure?
                    Yes, we use secure encryption methods and payment processors to ensure that your payment information is protected during transactions.</p>
                    <p class="text-gray-600 leading-relaxed mb-2">
                    4. What is the cancellation policy?
                    Cancellations and refunds are subject to the policies of the service provider you booked with (e.g., airlines, hotels). Please review their terms before booking.</p>
                    <p class="text-gray-600 leading-relaxed mb-2">
                    5. Can I find local tour guides on Journyly?
                    Yes, Journyly provides detailed profiles of local tour guides, including their language skills, specialization, and user ratings. You can book them directly through the platform.</p>
                    <p class="text-gray-600 leading-relaxed mb-2">
                    6. How do I contact customer support?
                    You can contact our support team via email at support@journyly.com or by calling +880 1234-567890.</p>
                    <p class="text-gray-600 leading-relaxed mb-2">
                    7. Is my personal information safe?
                    Absolutely. We implement robust security measures to protect your data. Refer to our
                    <a class="text-blue-500 bg-blue-100" href="{{ route('privacy') }}">Privacy&Policy </a>for more details.</p>
                    <p class="text-gray-600 leading-relaxed mb-2">
                    8. How do I update my account details?
                    You can update your account details, in the "profile/user info" section.</p>
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
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://github.com/shrabondas5544">Github</a>
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
                  <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://github.com/shrabondas5544/Journyly/blob/main/LICENSE">MIT License</a>
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