<!DOCTYPE html>
<html lang="en" x-data="app">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}" />
    <title>Login User</title>
    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')
    <!-- Alpine JS -->
    @vite('resources/js/app.js')
    <!-- Material Symbols -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body
    class="bg-gray-200 min-h-screen flex items-center justify-center p-4 transition-colors duration-300 font-sans dark:bg-gray-900">
    <!-- Theme Toggle (Fixed in top-right corner) -->
    <button @click="toggleTheme"
        class="fixed top-4 right-4 p-3 pb-1 rounded-full bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300 z-10 border border-gray-200 dark:border-gray-700 focus:outline-none ">
        <span class="material-symbols-outlined dark:text-white text-gray-700"
            x-text="darkMode ? 'light_mode' : 'dark_mode'"></span>
    </button>

    <!-- Login Card -->
    <div class="w-full max-w-md mx-auto">
        <div
            class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 dark:bg-gray-800 transform hover:scale-[1.01]">
            <!-- Logo Header -->
            <div class="bg-gradient-to-r from-blue-800 to-blue-400 dark:from-blue-800 dark:to-blue-500 py-6 px-6">
                <div class="flex items-center justify-center">
                    <div class="bg-white/20 p-3 rounded-xl">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Company Logo" class="h-12 w-12 rounded-lg">
                    </div>
                    <div class="ml-4">
                        <h1 class="text-white font-bold text-2xl">Kaizen DB Engine</h1>
                        <p class="text-blue-100 text-sm">Secure Login Portal</p>
                    </div>
                </div>
            </div>

            <!-- Login Form -->
            <form class="p-4 sm:p-6 md:p-6" action="{{ route('login.action') }}" method="POST">
                @csrf

                <!-- Error Message with Auto-dismiss and Close Button -->
                <div x-data="{ showError: true }" x-show="showError" @keydown.escape.window="showError = false">
                    @if($errors->has('error'))
                        <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="material-symbols-outlined text-red-500 dark:text-red-300 mr-2">error</span>
                                    <p class="text-red-600 dark:text-red-300 font-medium">{{ $errors->first('error') }}</p>
                                </div>
                                <!-- Tombol close -->
                                <button @click="showError = false"
                                    class="ml-4 text-red-500 hover:text-red-700 focus:outline-none">
                                    <span class="material-symbols-outlined">close</span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-left">Happy Utilization</h2>

                <!-- Username Field -->
                <div class="mb-6">
                    <label for="username"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Username</label>
                    <div class="relative">
                        <input required type="text" id="username" x-ref="username"
                            class="w-full pl-4 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-white text-gray-700 placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-300"
                            name="username" placeholder="Enter your username">
                    </div>
                </div>

                <!-- Password Field -->
                <div class="mb-8">
                    <label for="password"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                    <div class="relative">
                        <input required id="password" name="password" x-ref="password" :type="showPassword ? 'text' : 'password'"
                            class="w-full pl-4 pr-12 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-white text-gray-700 placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-300"
                            placeholder="Enter your password">
                        <button @click="showPassword = !showPassword" type="button"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <span
                                class="material-symbols-outlined text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                                <span x-text="showPassword ? 'visibility_off' : 'visibility'"></span>
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-medium py-3 px-4 rounded-lg transition duration-300 transform hover:-translate-y-1 hover:shadow-lg flex items-center justify-center space-x-2">
                    <span>Masuk</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="mt-6 text-center text-gray-500 dark:text-gray-400 text-sm">
            © 2025 Kaizen DB. All rights reserved.
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('app', () => ({
                darkMode: false,
                showPassword: false,

                init() {
                    // Check for saved theme preference or system preference
                    const savedTheme = localStorage.getItem('darkMode');
                    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    this.darkMode = savedTheme ? savedTheme === 'true' : systemPrefersDark;
                    this.applyTheme();
                },

                toggleTheme() {
                    this.darkMode = !this.darkMode;
                    localStorage.setItem('darkMode', this.darkMode);
                    this.applyTheme();
                },

                applyTheme() {
                    if (this.darkMode) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                },
            }));
        });
    </script>
</body>

</html>