<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Shopping List App' }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-xl font-bold text-blue-600">Shopping List Admin</span>
                </div>
                
                <!-- User Navigation Section -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    @auth
                        <div class="relative ml-3">
                            <div class="flex items-center space-x-4">
                                <span class="text-gray-600">{{ Auth::user()->name }}</span>
                                
                                <!-- Logout Form -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-gray-600 hover:text-blue-600 transition duration-150 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth
                    
                    @guest
                        <div class="flex space-x-4">
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Register</a>
                            @endif
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        {{ $slot }}
    </main>
</body>
</html>