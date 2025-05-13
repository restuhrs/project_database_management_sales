@extends('Salesman.SavedData.Layouts.Header')

@section('title', 'Saved Customer')

@section('content')


    <!-- Content Area -->
    <main class="px-4 sm:px-6 pt-4 md:pt-6 max-w-full">

        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Saved Customer</h2>
            <div>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                            href="dashboard.html">
                            Home
                            <span class="material-symbols-outlined text-base">chevron_right</span>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90">Saved Customer</li>
                </ol>
            </div>
        </div>

        <!-- @if(session('success'))
                    <script>
                        Swal.fire({
                            title: "Data berhasil ditambahkan!",
                            text: "- Admin -",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                    </script>
                    @endif -->

        @if(session('updated'))
            <script>
                Swal.fire({
                    title: "Data berhasil diupdate!",
                    text: "Success!",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            </script>
        @endif

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
                <div id="filterContainer" class="mt-4 grid sm:grid-cols-5 gap-3 hidden">
                    <div class="relative filter-container">
                        <label for="branchFilter"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis Kendaraan</label>
                        <select id="branchFilter"
                            class="appearance-none w-full pl-4 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All model</option>
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
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Progress</label>
                        <select id="progressFilter"
                            class="appearance-none w-full pl-4 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Status</option>
                            <option value="DO">DO</option>
                            <option value="SPK">SPK</option>
                            <option value="Pending">Pending</option>
                            <option value="Reject">Reject</option>
                            <option value="Tidak valid">Tidak Valid</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none mt-6">
                            <span
                                class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-lg">expand_more</span>
                        </div>
                    </div>

                    <div class="relative filter-container">
                        <label for="JenisPelangganFilter"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis
                            Pelanggan</label>
                        <select id="JenisPelangganFilter"
                            class="appearance-none w-full pl-4 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Type</option>
                            <option value="Fleet">Fleet</option>
                            <option value="Retail">Retail</option>
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
                                <th id="col-kendaraan"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Jenis Kendaraan</th>
                                <th id="col-sales"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Salesman</th>
                                <th id="col-progress"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Progress</th>
                                <th id="col-keterangan"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Keterangan</th>
                                <th id="col-jenispelanggan"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Jenis Pelanggan</th>
                                <th id="col-aksi"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="customerTableBody">
                            @foreach($savedCustomers as $key => $customer)
                                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <!-- Kolom 1: No -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $loop->iteration }}
                                    </td>

                                    <!-- Kolom 3: Nama Customer -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customer->nama }}
                                    </td>

                                    <!-- Kolom 4: Kota -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customer->kota }}
                                    </td>

                                    <!-- Kolom 5: Jenis Kendaraan -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        {{ $customer->model_mobil }}
                                    </td>

                                    <!-- Kolom 6: Sales -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        {{ $customer->salesman->name ?? 'N/A' }}
                                    </td>

                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        @if ($customer->progress)
                                            @php
                                                $colorClasses = match ($customer->progress)
                                                {
                                                                'SPK' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                                                'DO' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                                                'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                                                'reject' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                                                'tidak valid' => 'bg-gray-500 text-white dark:bg-gray-700 dark:text-gray-100',
                                                                default => '' //tidak ada
                                                };
                                            @endphp
                                            <span class="px-2 py-1 text-xs rounded-full {{ $colorClasses }}">
                                                {{ ucfirst($customer->progress) }}
                                            </span>
                                        @endif
                                    </td>

                                    @php
                                        $alasan = $customer->alasan === 'N/A' || is_null($customer->alasan) ? 'no reason' : $customer->alasan;
                                    @endphp
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $alasan }}</td>
                                    <!-- Kolom 9: Jenis Pelanggan -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                        {{ ucfirst($customer->jenis_pelanggan) }}
                                    </td>

                                    <!-- Kolom 10: Aksi -->
                                    <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <button onclick="openTampilData(this)" data-progress="{{ $customer->progress }}"
                                                data-alasan="{{ $customer->alasan }}"
                                                data-cabang="{{ $customer->branch->name ?? '' }}"
                                                data-salesman="{{ $customer->salesman->name ?? '' }}"
                                                data-sumber_data="{{ $customer->sumber_data }}"
                                                data-customer="{{ $customer->nama }}" data-alamat="{{ $customer->alamat }}"
                                                data-kelurahan="{{ $customer->kelurahan }}"
                                                data-kecamatan="{{ $customer->kecamatan }}" data-kota="{{ $customer->kota }}"
                                                data-tanggal_lahir="{{ $customer->tanggal_lahir }}"
                                                data-jenis_kelamin="{{ $customer->jenis_kelamin }}"
                                                data-tipe_pelanggan="{{ $customer->tipe_pelanggan }}"
                                                data-jenis_pelanggan="{{ $customer->jenis_pelanggan }}"
                                                data-tenor="{{ $customer->tenor }}"
                                                data-tanggal_gatepass="{{ $customer->tanggal_gatepass }}"
                                                data-pekerjaan="{{ $customer->pekerjaan }}"
                                                data-jenis_kendaraan="{{ $customer->model_mobil }}"
                                                data-nomor_rangka="{{ $customer->nomor_rangka }}"
                                                data-no_telepon="{{ $customer->nomor_hp_1 }}"
                                                data-no_telepon_update="{{ $customer->nomor_hp_2 }}"
                                                data-old_salesman="{{ $customer->old_salesman }}"
                                                class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700">
                                                <span class="material-symbols-outlined text-sm">info</span>
                                            </button>
                                            <button onclick="openModalUpdateUser(this)" data-id="{{ $customer->id }}"
                                                data-progress="{{ $customer->progress }}" data-alasan="{{ $customer->alasan }}"
                                                class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-green-50 hover:bg-green-100 dark:bg-green-900/50 dark:hover:bg-green-900 text-green-600 dark:text-green-300 rounded-md border border-green-200 dark:border-green-700">
                                                <span class="material-symbols-outlined text-sm">edit</span>
                                            </button>
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
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Customer</label>
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
                            <label for="tgl_lahir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tgl
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
                            <label for="tgl_gatepass" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tgl
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
                        <div class="mb-4">
                            <label for="old_salesman" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Old
                                Salesman</label>
                            <input disabled type="text" id="update-old_salesman" name="old_salesman"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="old salesman">
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!-- UPDATE Data Modal Container -->
        <div id="updateUserModal"
            class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 hidden">
            <!-- Modal Background -->
            <div class="absolute inset-0 bg-gray-100 bg-opacity-10 backdrop-blur-sm" onclick="closeUpdateData()"></div>

            <!-- Modal Content -->
            <div
                class="relative bg-white dark:bg-gray-800 rounded-lg p-4 md:p-6 max-w-md w-full mx-4 my-6 sm:my-8 md:max-w-full z-10 max-h-screen overflow-y-auto w-full">
                <!-- Close Button -->
                <button type="button" onclick="closeUpdateData()"
                    class="text-xl text-gray-500 dark:text-gray-300 absolute top-4 right-4">
                    <span class="material-symbols-outlined">close</span>
                </button>

                <!-- Modal Header -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white">Update Follow Up Data</h3>
                </div>

                <!-- Form Input Fields -->
                <form id="updateUserForm" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="update-id" name="id">
                    <!-- Use grid layout for better organization -->
                    <div class="flex flex-col gap-6 md:grid md:grid-cols-2 lg:grid-cols-4">

                        <!-- Progress -->
                        <div class="mb-4">
                            <label for="progress"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Progress</label>
                            <select id="update-progress" name="progress"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                <option value="" disabled selected>Pilih progress</option>
                                <option value="DO">DO</option>
                                <option value="SPK">SPK</option>
                                <option value="pending">Pending</option>
                                <option value="reject">Reject</option>
                                <option value="tidak valid">Tidak Valid</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="alasan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alasan</label>
                            <input type="text" id="update-alasan" name="alasan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Alasan">
                        </div>

                        <!-- <div class="mb-4">
                                        <label for="salesman_id"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Salesman</label>
                                        <input type="number" id="update-salesman_id" name="salesman_id"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="Salesman">
                                    </div>

                                    <div class="mb-4">
                                        <label for="sumber_data"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sumber
                                            Data</label>
                                        <input type="text" id="update-sumber_data" name="sumber_data"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="Sumber Data">
                                    </div>
                                    <div class="mb-4">
                                        <label for="nama"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Customer</label>
                                        <input type="text" id="update-nama" name="nama"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="Nama">
                                    </div>
                                    <div class="mb-4">
                                        <label for="alamat"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                                        <input type="text" id="update-alamat" name="alamat"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="Alamat">
                                    </div>
                                    <div class="mb-4">
                                        <label for="kelurahan"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kelurahan</label>
                                        <input type="text" id="update-kelurahan" name="kelurahan"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="Kelurahan">
                                    </div>
                                    <div class="mb-4">
                                        <label for="kecamatan"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kecamatan</label>
                                        <input type="text" id="update-kecamatan" name="kecamatan"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="Kecamatan">
                                    </div>
                                    <div class="mb-4">
                                        <label for="kota"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kota</label>
                                        <input type="text" id="update-kota" name="kota"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="Kota">
                                    </div>
                                    <div class="mb-4">
                                        <label for="tgl_lahir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tgl.
                                            Lahir</label>
                                        <input type="date" id="update-tgl_lahir" name="tgl_lahir"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="Tgl Lahir">
                                    </div>
                                    <div class="mb-4">
                                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis kelamin</label>
                                        <select id="update-jenis_kelamin" name="jenis_kelamin"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="tipe_pelanggan"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipe
                                            Pelanggan</label>
                                        <input type="text" id="update-tipe_pelanggan" name="tipe_pelanggan"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="Tipe Pelanggan">
                                    </div>
                                    <div class="mb-4">
                                        <label for="jenis_pelanggan"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
                                            Pelanggan</label>
                                        <input type="text" id="update-jenis_pelanggan" name="jenis_pelanggan"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="Jenis Pelanggan">
                                    </div>
                                    <div class="mb-4">
                                        <label for="tenor"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tenor</label>
                                        <input type="number" id="update-tenor" name="tenor"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="Tenor">
                                    </div>
                                    <div class="mb-4">
                                        <label for="tgl_gatepass" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tgl.
                                            Gatepass</label>
                                        <input type="date" id="update-tgl_gatepass" name="tgl_gatepass"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="Tgl Gatepass">
                                    </div>
                                    <div class="mb-4">
                                        <label for="pekerjaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pekerjaan</label>
                                        <input type="text" id="update-pekerjaan" name="pekerjaan"
                                            class="mt-1 block w-full px-3 py-2 border rounded-md text-gray-700 dark:text-gray-200 dark:bg-gray-800"
                                            placeholder="Pekerjaan">
                                    </div>

                                    <div class="mb-4">
                                        <label for="jenis_kendaraan"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
                                            Kendaraan</label>
                                        <input type="text" id="update-jenis_kendaraan" name="jenis_kendaraan"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="Jenis Kendaraan">
                                    </div>
                                    <div class="mb-4">
                                        <label for="nomor_rangka" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No.
                                            Rangka</label>
                                        <input type="text" id="update-nomor_rangka" name="nomor_rangka"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="No Rangka">
                                    </div>
                                    <div class="mb-4">
                                        <label for="no_telepon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No.
                                            Telepon </label>
                                        <input type="number" id="update-no_telepon" name="no_telepon"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="No Telepon">
                                    </div>
                                    <div class="mb-4">
                                        <label for="no_telepon_update"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">No.
                                            Telepon Update</label>
                                        <input type="number" id="update-no_telepon_update" name="no_telepon_update"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                            placeholder="No Telepon Update">
                                    </div> -->

                        <!-- Submit Button -->
                        <div class="mb-2 col-span-2 sm:col-span-4">
                            <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-md">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


@endsection