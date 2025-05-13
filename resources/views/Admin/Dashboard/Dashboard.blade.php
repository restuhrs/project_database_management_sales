@extends('Admin.Dashboard.Layouts.Header')

@section('title', 'Dashboard')

@section('content')

    <!-- Content Area -->
    <main class="px-6 pt-6 sm:max-w-sm md:max-w-full">
        <!-- Stats Cards & Chart Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4 max-w-full">

            <!-- Left Column - Stats Cards (Stacked) -->
            <div class="space-y-4 max-h-full">

                <!-- Saved Data Card -->
                <div class="data-card bg-white p-4 sm:p-6 rounded-lg shadow dark:bg-gray-800 max-w-full">
                    <div class="flex items-start justify-center">
                        <div class=" w-full">
                            <div class="flex items-center justify-between mb-2 flex-wrap">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Saved Data
                                    </p>
                                    <p class="text-xl sm:text-2xl font-semibold text-gray-800 dark:text-white">
                                        {{ $savedCount }}
                                    </p>
                                </div>

                                <div
                                    class="p-4 pb-2 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300">
                                    <span class="material-symbols-outlined">inventory_2</span>
                                </div>
                            </div>
                            <div class=" px-3 py-1 bg-blue-50 dark:bg-blue-900 rounded-lg inline-block">
                                <p class="text-xs text-blue-500 dark:text-blue-300 flex items-center">
                                    <span class="material-symbols-outlined text-sm mr-1">update</span>
                                    Updated Today, {{ now()->format('H:i A') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Follow Up Card -->
                <div class="data-card bg-white p-4 sm:p-6 rounded-lg shadow dark:bg-gray-800 max-w-full">
                    <div class="flex items-start justify-center">
                        <div class=" w-full">
                            <div class="flex items-center justify-between mb-2 flex-wrap">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Follow Up
                                    </p>
                                    <p class="text-xl sm:text-2xl font-semibold text-gray-800 dark:text-white">
                                        {{ $followUpCount }}
                                    </p>
                                </div>

                                <div
                                    class="p-4 pb-2 rounded-full bg-blue-100 dark:bg-green-900 text-green-600 dark:text-green-300">
                                    <span class="material-symbols-outlined">inventory_2</span>
                                </div>
                            </div>
                            <div class=" px-3 py-1 bg-green-50 dark:bg-green-900 rounded-lg inline-block">
                                <p class="text-xs text-green-500 dark:text-green-300 flex items-center">
                                    <span class="material-symbols-outlined text-sm mr-1">update</span>
                                    Updated Today, {{ now()->format('H:i A') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column - Chart -->
            <div class="bg-white p-4 sm:p-6 rounded-lg shadow dark:bg-gray-800">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3 sm:mb-4">All Salesman
                    Progress</h3>
                <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6">

                    <!-- Chart Container -->
                    <div class="w-full sm:w-1/2 h-40 sm:h-48 flex justify-center">
                        <canvas id="salesChart" class="max-h-full"></canvas>
                    </div>

                    <!-- Big Data Text -->
                    <div class="text-center sm:text-left w-full sm:w-1/2">
                        <p class="text-3xl sm:text-4xl font-bold text-gray-800 dark:text-gray-200 mb-1 sm:mb-2">
                            {{ $totalAllCustomers }}
                        </p>
                        <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400">Big Data Customer</p>
                        <div class="mt-2 sm:mt-3 p-2 sm:px-4  bg-blue-50 dark:bg-blue-900 rounded-lg inline-block">
                            <span
                                class="text-xs text-blue-600 dark:text-blue-300 flex items-center justify-center sm:justify-start">
                                Updated Today, {{ now()->format('H:i A') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Salesman Table -->
        <div class="bg-white rounded-lg shadow dark:bg-gray-800 overflow-hidden mb-6 dark:text-gray-50">
            <div class="p-4 sm:p-6 border-gray-200 dark:border-gray-600">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
                    <h3 class="text-xl md:text-sm lg:text-2xl font-semibold text-gray-800 dark:text-white">
                        Salesman Goals Bulan <?php
    $bulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    $bulan_sekarang = date('n'); // Mendapatkan angka bulan saat ini
    echo $bulan[$bulan_sekarang]; // Menampilkan nama bulan dalam bahasa Indonesia?>

                    </h3>

                    <!-- Search and Filter Row -->
                    <div class="w-full md:w-auto flex flex-col sm:flex-row gap-3 items-stretch">
                        <!-- Search Input -->
                        <div class="relative flex-grow min-w-[200px]">
                            <input type="text" id="salesmanSearch" placeholder="Search..."
                                class="pl-10 pr-4 py-2 w-full border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="absolute left-3 top-2.5 text-gray-400 dark:text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Improved Dropdown Filters -->
                        <div class="relative flex-grow min-w-[160px]">
                            <select id="cityFilter"
                                class="appearance-none w-full h-full pl-4 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">All Branches</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->name }}">
                                        {{ $branch->name }} <!-- Display city name -->
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <span
                                    class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-lg">expand_more</span>
                            </div>
                        </div>
                        <div class="relative flex-grow min-w-[120px]">
                            <select id="itemsPerPage"
                                class="appearance-none w-full h-full pl-4 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="5">5 items</option>
                                <option value="10" selected>10 items</option>
                                <option value="20">20 items</option>
                                <option value="50">50 items</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <span
                                    class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-lg">expand_more</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto px-4 sm:px-6">
                <!-- Wrapper with maximum width and overflow scroll for mobile display -->
                <div class="w-full max-w-full overflow-x-auto">
                    <table class="data-table w-full text-left border border-collapse rounded-lg overflow-hidden"
                        id="salesmanTable">
                        <thead>
                            <tr class="text-left bg-gray-100 dark:bg-gray-700">
                                <th class="p-3 sm:p-4 border-b border-gray-200 dark:border-gray-500 font-semibold">
                                    No
                                </th>
                                <th class="p-3 sm:p-4 border-b border-gray-200 dark:border-gray-500 font-semibold">
                                    Cabang</th>
                                <th class="p-3 sm:p-4 border-b border-gray-200 dark:border-gray-500 font-semibold">
                                    Nama</th>
                                <th class="p-3 sm:p-4 border-b border-gray-200 dark:border-gray-500 font-semibold">
                                    Follow Up</th>
                                <th class="p-3 sm:p-4 border-b border-gray-200 dark:border-gray-500 font-semibold">
                                    Saved</th>
                            </tr>
                        </thead>
                        <tbody id="salesmanTableBody">
                            @foreach($admin_salesman_goals as $index => $salesman)
                                <tr
                                    class="border-b border-gray-200 dark:border-gray-500 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="p-3 sm:p-4 border-b border-gray-200 dark:border-gray-500">{{ $salesman['no'] }}
                                    </td>
                                    <td class="p-3 sm:p-4 border-b border-gray-200 dark:border-gray-500">
                                        {{ $salesman['branch']->name ?? 'N/A' }}
                                    </td>
                                    <td class="p-3 sm:p-4 border-b border-gray-200 dark:border-gray-500">
                                        {{ $salesman['salesman']->name }}
                                    </td>
                                    <td class="p-3 sm:p-4 border-b border-gray-200 dark:border-gray-500">
                                        {{ $salesman['total_customers'] }}
                                    </td>
                                    <td class="p-3 sm:p-4 border-b border-gray-200 dark:border-gray-500">
                                        {{ $salesman['follow_up_count'] }}
                                    </td>
                                    <td class="p-3 sm:p-4 border-b border-gray-200 dark:border-gray-500">
                                        {{ $salesman['saved_count'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div
                class="px-4 sm:px-6 py-6 border-gray-200 dark:border-gray-600 flex flex-col sm:flex-row justify-between items-center gap-3">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Showing <span id="showingFrom">1</span> to <span id="showingTo">10</span> of <span
                        id="totalItems">0</span> entries
                </div>
                <!-- Pagination -->
                <div
                    class="p-0 border-gray-200 dark:border-gray-600 flex flex-col sm:flex-row justify-between items-center gap-3 w-full sm:w-auto">

                    <!-- Pagination controls -->
                    <div class="flex flex-col sm:flex-row sm:gap-3 gap-2 md:gap-0 w-full sm:justify-end sm:space-x-3 mt-3">
                        <!-- Previous button (Mobile: on top, full width) -->
                        <button id="prevPage" disabled
                            class="w-full sm:w-auto px-3 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 disabled:opacity-50">
                            Previous
                        </button>

                        <!-- Page Numbers -->
                        <div id="pageNumbers" class="flex gap-1 w-full justify-center sm:justify-start">
                            <!-- Page numbers will be inserted here -->
                        </div>

                        <!-- Next button (Mobile: on bottom, full width) -->
                        <button id="nextPage" disabled
                            class="w-full sm:w-auto px-3 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 disabled:opacity-50">
                            Next
                        </button>
                    </div>
                </div>
            </div>

        </div>
@endsection