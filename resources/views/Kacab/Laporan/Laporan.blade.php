@extends('Kacab.Laporan.Layouts.Header')

@section('title', 'Laporan Salesman')

@section('content')

    <!-- Content Area -->
    <main class="px-4 sm:px-6 pt-4 md:pt-6 max-w-full">

        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Laporan</h2>
            <div>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                            href="{{ route('kacab.dashboard') }}">
                            Home
                            <span class="material-symbols-outlined text-base">chevron_right</span>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90">Laporan</li>
                </ol>
            </div>
        </div>

        <!-- SumberData Table -->
        <div class="bg-white rounded-lg shadow dark:bg-gray-800 overflow-hidden mb-6 dark:text-gray-50">
            <div class="p-4 sm:p-6 border-gray-200 dark:border-gray-600">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Laporan Salesman</h3>

                    <!-- Upload Excel Button -->
                    <form action="{{ route('kacab.laporan.export') }}" method="POST">
                        @csrf
                        <button
                            class="flex items-center justify-center bg-green-500 text-white py-2 px-4 rounded-lg text-sm w-full md:w-auto">
                            <span class="material-symbols-outlined text-2xl mr-2">arrow_circle_up</span>
                            Export Excel
                        </button>
                    </form>
                </div>

                <!-- Search and Filter Row with flex-wrap -->
                <div class="w-full md:w-auto flex flex-col sm:flex-row gap-3 items-stretch pt-4">
                    <!-- Search Input (larger) -->
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

                    <!-- Compact Items Per Page Dropdown -->
                    <div class="relative w-full md:w-[160px]">
                        <select id="itemsPerPage"
                            class="appearance-none w-full h-full pl-3 pr-7 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
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

            <div class="overflow-x-auto px-4 sm:px-6">
                <!-- Wrapper with maximum width and overflow scroll for mobile display -->
                <div class="w-full max-w-full overflow-x-auto">
                    <table id="SalesmanProgressTable"
                        class="w-full text-sm border border-collapse rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th id="col-no"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    No</th>
                                <th id="col-cabang"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Cabang</th>
                                <th id="col-salesman"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Salesman</th>
                                <th id="col-followup"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Total Follow Up</th>
                                <th id="col-contact"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Total Kontak</th>
                                <th id="col-invalid-contact"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Total Kontak Invalid</th>
                                <th id="col-progress"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Total Progress</th>
                                <th id="col-spk"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Total SPK</th>
                                <th id="col-pending"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Total Pending</th>
                                <th id="col-nonvalid"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Total Non-valid</th>
                            </tr>
                        </thead>
                        <tbody id="SalesmanProgressTableBody">
                            @foreach($salesmanProgress as $key => $progress)
                                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <!-- Kolom 1: No -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $key + 1 }}</td>

                                    <!-- Kolom 2: Cabang -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        {{ $progress['branch'] }}</td>

                                    <!-- Kolom 3: Salesman -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        {{ $progress['salesman'] }}</td>

                                    <!-- Kolom 4: Total Follow Up -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        {{ $progress['totalFollowUp'] }}</td>

                                    <!-- Kolom 5: Total Kontak -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        {{ $progress['totalFollowUp'] }}</td>

                                    <!-- Kolom 6: Total Kontak Invalid -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        {{ $progress['totalNonValid'] }}</td>

                                    <!-- Kolom 7: Total Progress -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        {{ $progress['progressPercentage'] }}%</td>

                                    <!-- Kolom 8: Total SPK -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        {{ $progress['spkPercentage'] }}%</td>

                                    <!-- Kolom 9: Total Pending -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        {{ $progress['pendingPercentage'] }}%</td>

                                    <!-- Kolom 10: Total Non-valid -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        {{ $progress['nonValidPercentage'] }}%</td>
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