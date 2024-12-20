<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Management</title>
    <script src="https://kit.fontawesome.com/4b5d033142.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>  
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-200 via-blue-50 to-transparent">
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
<!--------------------------piechart-------------------------------------->
<div class=" w-full max-w-7xl mx-auto bg-white rounded-t-xl p-6 shadow-lg">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Feedback Status Overview</h3>
            <p class="text-sm text-gray-600">Total Feedbacks: {{ count($feedbacks) }}</p>
        </div>
        <div class="flex gap-4">
            <div class="flex items-center">
                <div class="w-3 h-3 rounded-full bg-yellow-200 mr-2"></div>
                <span class="text-sm">Pending: {{ $feedbacks->where('status', 'pending')->count() }}</span>
            </div>
            <div class="flex items-center">
                <div class="w-3 h-3 rounded-full bg-green-200 mr-2"></div>
                <span class="text-sm">Reviewed: {{ $feedbacks->where('status', 'reviewed')->count() }}</span>
            </div>
        </div>
    </div>
    <div class="flex justify-center">
        @php
            $total = count($feedbacks);
            $pending = $feedbacks->where('status', 'pending')->count();
            $reviewed = $feedbacks->where('status', 'reviewed')->count();
            $pendingPercentage = $total > 0 ? ($pending / $total) * 100 : 0;
            $pendingAngle = $total > 0 ? ($pending / $total) * 360 : 0;
            $reviewedAngle = 360 - $pendingAngle;
            $radius = 80;
            $center = 100;
            
            function polarToCartesian($centerX, $centerY, $radius, $angleInDegrees) {
                $angleInRadians = ($angleInDegrees - 90) * M_PI / 180.0;
                return [
                    'x' => $centerX + ($radius * cos($angleInRadians)),
                    'y' => $centerY + ($radius * sin($angleInRadians))
                ];
            }
            
            $start = polarToCartesian($center, $center, $radius, 0);
            $end = polarToCartesian($center, $center, $radius, $pendingAngle);
            $largeArcFlag = $pendingAngle <= 180 ? 0 : 1;
        @endphp

        <svg width="200" height="200" viewBox="0 0 200 200">
            @if($pending > 0)
                <path d="M {{ $center }} {{ $center }} 
                        L {{ $start['x'] }} {{ $start['y'] }} 
                        A {{ $radius }} {{ $radius }} 0 {{ $largeArcFlag }} 1 {{ $end['x'] }} {{ $end['y'] }} Z" 
                    fill="#FEF08A" />
            @endif
            
            @if($reviewed > 0)
                @php
                    $start = polarToCartesian($center, $center, $radius, $pendingAngle);
                    $end = polarToCartesian($center, $center, $radius, 360);
                    $largeArcFlag = $reviewedAngle <= 180 ? 0 : 1;
                @endphp
                <path d="M {{ $center }} {{ $center }} 
                        L {{ $start['x'] }} {{ $start['y'] }} 
                        A {{ $radius }} {{ $radius }} 0 {{ $largeArcFlag }} 1 {{ $end['x'] }} {{ $end['y'] }} Z" 
                    fill="#BBF7D0" />
            @endif
            
            <circle cx="{{ $center }}" cy="{{ $center }}" r="40" fill="white"/>
            
            <g class="hover-info">
                <text x="{{ $center }}" y="{{ $center - 5 }}" 
                    text-anchor="middle" class="text-sm font-semibold">
                    {{ round($pendingPercentage) }}%
                </text>
                <text x="{{ $center }}" y="{{ $center + 15 }}" 
                    text-anchor="middle" class="text-xs">
                    Pending
                </text>
            </g>
        </svg>
    </div>
</div>
<!------Feedback Management--------->
<div class="mt-3 bg-white rounded-b-xl p-6 lg:p-8 shadow-lg w-full max-w-7xl mx-auto">
    <div class="flex items-center mb-6">
        <i class="fa-solid fa-comments text-3xl text-blue-500 mr-4"></i>
        <h2 class="text-2xl font-semibold text-blue-900">Feedback Management</h2>
    </div>

    @if($feedbacks->isEmpty())
        <div class="text-center py-8 text-gray-500">
            <i class="fa-solid fa-inbox text-4xl mb-4"></i>
            <p>No feedback submissions found</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="py-3 px-4 text-left">Submission Date</th>
                        <th class="py-3 px-4 text-left">Username</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">Phone</th>
                        <th class="py-3 px-4 text-left">Message</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($feedbacks as $feedback)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $feedback->created_at->format('Y-m-d') }}</td>
                        <td class="py-3 px-4">{{ $feedback->user_name }}</td>
                        <td class="py-3 px-4">{{ $feedback->email }}</td>
                        <td class="py-3 px-4">{{ $feedback->phone ?? 'N/A' }}</td>
                        <td class="py-3 px-4">
                            <div class="max-w-xs overflow-hidden text-ellipsis whitespace-nowrap">
                                {{ $feedback->message }}
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded-full text-xs
                                {{ $feedback->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                {{ ucfirst($feedback->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <form action="{{ route('admin.feedback.update-status', $feedback->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                    class="text-blue-500 hover:text-blue-700"
                                    title="Mark as Reviewed">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>