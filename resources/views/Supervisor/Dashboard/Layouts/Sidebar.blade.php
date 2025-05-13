<body class="bg-gray-50 dark:bg-gray-900" x-data="{ sidebarOpen: false, darkMode: false, sidebarCollapsed: false }"
    x-init="
        // Initialize dark mode from localStorage or system preference
        darkMode = localStorage.getItem('darkMode') === 'true' ||
                  (localStorage.getItem('darkMode') === null && window.matchMedia('(prefers-color-scheme: dark)').matches);

        // Initialize sidebar state
        sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

        // Apply initial states
        if (darkMode) document.documentElement.classList.add('dark');
        if (sidebarCollapsed) document.body.classList.add('sidebar-collapsed');

        // Watch for changes
        $watch('darkMode', value => {
            localStorage.setItem('darkMode', value);
            if (value) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });

        $watch('sidebarCollapsed', value => {
            localStorage.setItem('sidebarCollapsed', value);
        });

        $watch('sidebarOpen', value => {
            document.body.classList.toggle('sidebar-open', value);
        });
      " :class="{ 'sidebar-collapsed': sidebarCollapsed, 'sidebar-open': sidebarOpen }">

    <!-- Container Utama -->
    <div class="app-container">
        <!-- Overlay (for mobile/tablet) -->
        <div class="sidebar-overlay" @click="sidebarOpen = false" x-show="sidebarOpen"></div>

        <!-- Sidebar -->
        <aside class="sidebar bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <!-- Logo -->
            <div class="flex items-left justify-left h-16 px-4 ">
                <div class="flex items-center">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg flex items-center justify-center">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="" srcset="">
                    </div>
                    <span class="ml-3 text-lg font-semibold text-gray-800 dark:text-white sidebar-text">
                        Kaizen DB
                    </span>
                </div>
            </div>

            <!-- Menu Title -->
            <div class="px-4 py-3 ">
                <div class="menu-dots-container justify-start pl-1">
                    <span
                        class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider menu-text">Menu</span>
                    <span class="menu-dots material-symbols-outlined text-gray-500 dark:text-gray-400">more_vert</span>
                </div>
            </div>

            <!-- Menu -->
            <div class="py-4 px-3 h-[calc(100vh-7.5rem)]">
                <ul class="space-y-2">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('supervisor.dashboard') }}"
                            class="flex items-center p-2 text-base font-medium bg-opacity-10 bg-blue-600 text-blue-700 rounded-lg dark:text-blue-300">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span class="ml-3 sidebar-text">Dashboard</span>
                        </a>
                    </li>

                    <!-- Laporan -->
                    <li>
                        <a href="{{ route('supervisor.laporan') }}"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 dark:text-gray-100 dark:hover:bg-gray-700">
                            <span class="material-symbols-outlined dark:text-gray-400">description</span>
                            <span class="ml-3 sidebar-text">Laporan</span>
                        </a>
                    </li>

                    <!-- Divider -->
                    <li class="border-t border-gray-200 dark:border-gray-700 my-2"></li>

                    <!-- Menu Title -->
                    <div class="px-2 py-3 ">
                        <div class="menu-dots-container justify-start">
                            <span
                                class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider menu-text">Other</span>
                            <span
                                class="menu-dots material-symbols-outlined text-gray-500 dark:text-gray-400">more_vert</span>
                        </div>
                    </div>

                    <!-- Logout -->
                    <li>
                        <a href="#" onclick="event.preventDefault(); confirmLogout();"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 dark:text-gray-100 dark:hover:bg-gray-700">
                            <span class="material-symbols-outlined dark:text-gray-400">logout</span>
                            <span class="ml-3 sidebar-text">Logout</span>
                        </a>
                    </li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content dark:bg-gray-900 max-w-full">
            <!-- Navbar -->
            <nav class="bg-white border-b px-2 border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <div class="px-4 py-3 flex items-center justify-between md:py-4 lg:py-5">
                    <!-- Left Side -->
                    <div class="flex items-center">
                        <!-- Toggle Sidebar Button (Mobile/Tablet only) -->
                        <button @click="sidebarOpen = !sidebarOpen"
                            class="nav-icon md:hidden dark:text-white border dark:border-gray-700 border-gray-200 w-8 h-8 md:w-10 md:h-10">
                            <span class="material-symbols-outlined">menu</span>
                        </button>

                        <!-- Collapse Sidebar Button (Desktop only) -->
                        <button @click="sidebarCollapsed = !sidebarCollapsed"
                            class="nav-icon dark:text-white border dark:border-gray-700 border-gray-200 w-8 h-8 md:w-10 md:h-10 hidden lg:flex sidebar-collapse-btn">
                            <span x-show="!sidebarCollapsed" class="material-symbols-outlined">menu</span>
                            <span x-show="sidebarCollapsed" class="material-symbols-outlined">menu</span>
                        </button>

                        <span class="text-lg font-semibold text-gray-800 dark:text-white ml-4">Dashboard</span>
                    </div>

                    <!-- Right Side -->
                    <div class="flex items-center space-x-4">
                        <!-- Dark Mode Toggle -->
                        <button @click="darkMode = !darkMode"
                            class="nav-icon dark:text-white border dark:border-gray-700 border-gray-200 w-8 h-8 md:w-10 md:h-10">
                            <span x-show="!darkMode" class="material-symbols-outlined">dark_mode</span>
                            <span x-show="darkMode" class="material-symbols-outlined">light_mode</span>
                        </button>

                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ userDropdownOpen: false }"
                            @click.outside="userDropdownOpen = false">
                            <button @click="userDropdownOpen = !userDropdownOpen" class="flex items-center space-x-4">
                                <div
                                    class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-primary-500 flex items-center justify-center text-white">
                                    <span class="material-symbols-outlined text-sm">person</span>
                                </div>
                                <span class="hidden lg:inline text-gray-700 dark:text-gray-300">Supervisor</span>
                                <span
                                    class="hidden lg:inline material-symbols-outlined text-gray-500 dark:text-gray-400">expand_more</span>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="userDropdownOpen" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 dark:bg-gray-700">
                                <a href="#" onclick="event.preventDefault(); confirmLogout();"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600">
                                    <span class="material-symbols-outlined align-middle mr-2 text-base">logout</span>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
