@extends('Salesman.Dashboard.Layouts.Header')

@section('title', 'Dashboard')

@section('content')


    <!-- Content Area -->
    <main class="px-4 sm:px-6 pt-4 md:pt-6 max-w-full">

        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Big Data</h2>
            <div>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                            href="{{ route('salesman.dashboard') }}">
                            Home
                            <span class="material-symbols-outlined text-base">chevron_right</span>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90">Dashboard</li>
                </ol>
            </div>
        </div>

        <!-- customer Table -->
        <div class="bg-white rounded-lg shadow dark:bg-gray-800 overflow-hidden mb-6 dark:text-gray-50">
            <div class="p-4 sm:p-6 border-gray-200 dark:border-gray-600">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Data Customer</h3>
                </div>

                <!-- Search and Filter Row with flex-wrap -->
                <div class="w-full md:w-auto flex flex-col md:flex-row gap-3 items-stretch mt-4 flex-wrap">
                    <!-- Search Input -->
                    <div class="relative flex-grow min-w-[200px] flex-1">
                        <input type="text" id="customerSearch" placeholder="Search..."
                            class="min-w-full pl-10 pr-4 py-2 w-full border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <div class="absolute left-3 top-2.5 text-gray-400 dark:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Filter Button -->
                    <button id="toggleFiltersBtn"
                        class="flex items-center justify-center border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800  py-1 px-4 rounded-lg text-sm max-h-full">
                        <span class="material-symbols-outlined text-lg">filter_alt</span> Filters
                    </button>
                </div>

                <!-- Advanced Filters (Toggling Visibility on Mobile) -->
                <div id="filterContainer" class="mt-4 grid sm:grid-cols-4 gap-3 hidden">
                    <div class="relative filter-container">
                        <label for="branchFilter"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis Kendaraan</label>
                        <select id="branchFilter"
                            class="appearance-none w-full pl-4 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Model</option>

                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none mt-6">
                            <span
                                class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-lg">expand_more</span>
                        </div>
                    </div>

                    <div class="relative filter-container">
                        <label for="cityFilter"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                        <select id="cityFilter"
                            class="appearance-none w-full pl-4 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Cities</option>

                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none mt-6">
                            <span
                                class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-lg">expand_more</span>
                        </div>
                    </div>

                    <div class="relative filter-container">
                        <label for="progressFilter"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis Pelanggan</label>
                        <select id="progressFilter"
                            class="appearance-none w-full pl-4 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Type</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none mt-6">
                            <span
                                class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-lg">expand_more</span>
                        </div>
                    </div>

                    <!-- Items Per Page -->
                    <div class="relative filter-container">
                        <label for="itemsPerPage"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Show</label>
                        <select id="itemsPerPage"
                            class="appearance-none w-full pl-4 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="5">5 items</option>
                            <option value="10" selected>10 items</option>
                            <option value="20">20 items</option>
                            <option value="50">50 items</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none mt-6">
                            <span
                                class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-lg">expand_more</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto px-4 sm:px-6">
                <!-- Wrapper with maximum width and overflow scroll for mobile display -->
                <div class="w-full max-w-full overflow-x-auto">
                    <table id="customerTable" class="w-full text-sm border border-collapse rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th id="col-no"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    No</th>
                                <th id="col-nama"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Customer</th>
                                <th id="col-kota"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Kota</th>
                                <th id="col-tgllahir"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Tgl Lahir</th>
                                <th id="col-kendaraan"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Jenis Kendaraan</th>
                                <th id="col-salesman"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Salesman</th>
                                <th id="col-jenis_pelanggan"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Jenis Pelanggan</th>
                                <th id="col-aksi"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="customerTableBody">
                            @foreach($customers as $customer)
                                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 ">
                                    <!-- Kolom 1: No -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $loop->iteration }}
                                    </td>

                                    <!-- Kolom 3: Nama Customer -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customer->nama }}
                                    </td>

                                    <!-- Kolom 4: Kota -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customer->kota }}
                                    </td>

                                    <!-- Kolom 5: Tgl Lahir -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        {{ \Carbon\Carbon::parse($customer->tanggal_lahir)->format('d-m-Y') }}
                                    </td>

                                    <!-- Kolom 6: Jenis Kendaraan -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        {{ $customer->model_mobil }}
                                    </td>

                                    <!-- Kolom 7: Salesman -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        {{ $customer->salesman->name ?? '' }}
                                    </td>

                                    <!-- Kolom 7: jenis pelanggan -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        {{ ucfirst($customer->jenis_pelanggan) }}
                                    </td>

                                    <!-- Kolom 8: Aksi -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <form action="{{ route('salesman.customer.save', $customer->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-yellow-50 hover:bg-yellow-100 dark:bg-yellow-900/50 dark:hover:bg-yellow-900 text-yellow-600 dark:text-yellow-300 rounded-md border border-yellow-200 dark:border-yellow-700 ">
                                                    <span class="material-symbols-outlined text-sm">shopping_cart</span>
                                                </button>
                                            </form>
                                        </div>
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

        <!-- Modal Upload File -->
        <div id="uploadFileModal"
            class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 hidden">
            <!-- Modal Background with Blur effect -->
            <div class="absolute inset-0 bg-gray-100 bg-opacity-10 backdrop-blur-sm" onclick="closeModal()">
            </div>
            <div class="relative bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 my-6 sm:my-8 md:max-w-lg">


                <!-- Close Button (X) using Google Material Icon -->
                <button type="button" onclick="closeModal()"
                    class="text-xl text-gray-500 dark:text-gray-300 absolute top-4 right-4">
                    <span class="material-symbols-outlined">close</span> <!-- Material icon for X -->
                </button>

                <!-- Modal Header with Title -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white">Upload Your Excel
                        File</h3>
                </div>

                <!-- Custom File Input (Flowbite Style) -->
                <div class="mb-2">
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-64 sm:h-72 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class=" p-2 flex flex-col items-center justify-center pt-5 pb-6">
                                <span id="fileIcon"
                                    class="material-symbols-outlined mb-4 text-7xl text-gray-500 dark:text-gray-400">
                                    cloud_upload
                                </span>
                                <p id="fileUploadText"
                                    class="mb-2 text-sm sm:text-base text-gray-500 dark:text-gray-400 text-center">
                                    <span class="font-semibold" id="fileNameText">Click to upload</span> or drag
                                    and drop
                                </p>
                                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 text-center">Only
                                    Excel files
                                    are allowed (xlsx, xls, csv)</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" />
                        </label>
                    </div>

                    <!-- Error Message Display -->
                    <div id="fileError" class="mt-4 text-red-600 dark:text-red-400 text-sm sm:text-base text-center hidden">
                        Invalid file format. Please upload a valid Excel file.
                    </div>

                </div>

                <!-- Modal Footer with Full-width Upload Button -->
                <div class="flex gap-2 mt-4">
                    <button type="button" onclick="closeModal()"
                        class="w-full px-4 py-2 text-sm sm:text-base bg-gray-500 text-white rounded-md">Cancel</button>
                    <button id="uploadButton" type="button" onclick="uploadFile()"
                        class="w-full px-4 py-2 text-sm sm:text-base bg-blue-500 text-white rounded-md">Upload</button>
                </div>
            </div>
        </div>


        <!-- Detail Data Modal Container -->
        <div id="TampilDataModal"
            class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 hidden">
            <!-- Modal Background with Blur effect -->
            <div class="absolute inset-0 bg-gray-100 bg-opacity-10 backdrop-blur-sm" onclick="closeTampilData()">
            </div>

            <!-- Modal Content -->
            <div
                class="relative bg-white dark:bg-gray-800 rounded-lg p-4 md:p-6 max-w-md w-full mx-4 my-6 sm:my-8 md:max-w-full z-10 max-h-screen overflow-y-auto w-full">
                <!-- Close Button (X) -->
                <button type="button" onclick="closeTampilData()"
                    class="text-xl text-gray-500 dark:text-gray-300 absolute top-4 right-4">
                    <span class="material-symbols-outlined">close</span> <!-- Material icon for X -->
                </button>

                <!-- Modal Header with Title -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white">Detail Data</h3>
                </div>

                <!-- Form Input Fields -->
                <form class="space-y-4">
                    <!-- Use grid layout for better organization -->
                    <div class="flex flex-col gap-6 md:grid md:grid-cols-2 lg:grid-cols-4">
                        <!-- Progress -->
                        <div class="mb-4">
                            <label for="progress"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Progress</label>
                            <input disabled type="text" id="progress" name="progress"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="alasan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alasan</label>
                            <input disabled type="text" id="alasan" name="alasan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="salesman"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Salesman</label>
                            <input disabled type="text" id="salesman" name="salesman"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="sumber_data"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sumber
                                Data</label>
                            <input disabled type="text" id="sumber_data" name="sumber_data"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="nama"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                            <input disabled type="text" id="nama" name="nama"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="alamat"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                            <input disabled type="text" id="alamat" name="alamat"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="kelurahan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kelurahan</label>
                            <input disabled type="text" id="kelurahan" name="kelurahan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="kecamatan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kecamatan</label>
                            <input disabled type="text" id="kecamatan" name="kecamatan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="kota"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kota</label>
                            <input disabled type="text" id="kota" name="kota"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="tgl_lahir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tgl.
                                Lahir</label>
                            <input disabled type="date" id="tgl_lahir" name="tgl_lahir"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <!-- Gender (Dropdown) -->
                        <div class="mb-4">
                            <label for="jenis_kelamin"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Kelamin</label>
                            <input disabled type="text" id="jenis_kelamin" name="jenis_kelamin"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="tipe_pelanggan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipe
                                Pelanggan</label>
                            <input disabled type="text" id="tipe_pelanggan" name="tipe_pelanggan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="jenis_pelanggan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
                                Pelanggan</label>
                            <input disabled type="text" id="jenis_pelanggan" name="jenis_pelanggan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="tenor"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tenor</label>
                            <input disabled type="text" id="tenor" name="tenor"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="tgl_gatepass"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tgl.
                                Gatepass</label>
                            <input disabled type="date" id="tgl_gatepass" name="tgl_gatepass"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="pekerjaan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pekerjaan</label>
                            <input disabled type="text" id="pekerjaan" name="pekerjaan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="jenis_kendaraan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
                                Kendaraan</label>
                            <input disabled type="text" id="jenis_kendaraan" name="jenis_kendaraan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="no_rangka" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No.
                                Rangka</label>
                            <input disabled type="text" id="no_rangka" name="no_rangka"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="no_telepon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No.
                                Telepon</label>
                            <input disabled type="number" id="no_telepon" name="no_telepon"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                        <div class="mb-4">
                            <label for="no_telepon_update"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">No.
                                Telepon Update</label>
                            <input disabled type="number" id="no_telepon_update" name="no_telepon_update"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="N/A">
                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection