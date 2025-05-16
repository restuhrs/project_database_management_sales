@extends('Admin.BigData.Layouts.Header')

@section('title', 'Big Data')

@section('content')


<!-- Content Area -->
<main class="px-4 sm:px-6 pt-4 md:pt-6 max-w-full">

    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Big Data</h2>
        <div>
            <ol class="flex items-center gap-1.5">
                <li>
                    <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                        href="{{ route('admin.dashboard') }}">
                        Home
                        <span class="material-symbols-outlined text-base">chevron_right</span>
                    </a>
                </li>
                <li class="text-sm text-gray-800 dark:text-white/90">Big Data</li>
            </ol>
        </div>
    </div>

    @if(session('success'))
    <script>
        Swal.fire({
            title: "Data berhasil ditambahkan!",
            text: "success!",
            icon: "success",
            confirmButtonText: "OK"
        });
    </script>
    @endif

    @if(session('deleted'))
    <script>
        Swal.fire({
            title: "Data berhasil dihapus!",
            text: "success!",
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

                <!-- Search and Filter Row -->
                <div class="w-full md:w-auto flex flex-col md:flex-row gap-3 items-stretch">
                    <!-- Upload Excel Button -->
                    <button onclick="openModal()"
                        class="flex items-center justify-center bg-green-500 text-white py-2 px-4 rounded-lg text-sm">
                        <span class="material-symbols-outlined text-2xl mr-2">arrow_circle_up</span>
                        Upload Excel
                    </button>

                    <!-- Add Button -->
                    <button onclick="openAddData()"
                        class="flex items-center justify-center bg-blue-500 text-white py-2 px-4 rounded-lg text-sm">
                        <span class="material-symbols-outlined text-2xl mr-2">add_circle_outline</span>
                        Tambah Data
                    </button>
                </div>
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
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Branch</label>
                    <select id="branchFilter"
                        class="appearance-none w-full pl-4 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Cabang</option>
                        @foreach($branches as $branch)
                        <option value="{{ $branch->id }}">
                            {{ $branch->name }}
                        </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
                        style="top: 24px;">
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
                        @foreach($cities as $city)
                        <option value="{{ $city->kota }}" @if(request()->city == $city->kota) selected @endif>
                            {{ $city->kota }} <!-- Display city name -->
                        </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
                        style="top: 24px;">
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
                        <option value="SPK">SPK</option>
                        <option value="Pending">Pending</option>
                        <option value="Reject">Reject</option>
                        <option value="DO">DO</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
                        style="top: 24px;">
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
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
                        style="top: 24px;">
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
                            <th id="col-cabang"
                                class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                Cabang</th>
                            <th id="col-customer"
                                class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                Customer</th>
                            <th id="col-kota"
                                class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                Kota</th>
                            <th id="col-tanggal_lahir"
                                class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                Tgl. Lahir</th>
                            <th id="col-kendaraan"
                                class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                Jenis Kendaraan</th>
                            <th id="col-jenis_pelanggan"
                                class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                Jenis Pelanggan</th>
                            <th id="col-nama"
                                class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                Salesman</th>
                            <th id="col-progress"
                                class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                Progress</th>
                            <th id="col-keterangan"
                                class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                Keterangan</th>
                            <th id="col-aksi"
                                class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="customerTableBody">
                        @foreach ($customers as $customers)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                            <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customers->id }}</td>
                            <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customers->branch->name ?? '' }}</td>
                            <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customers->nama }}</td>
                            <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customers->kota }}</td>
                            <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customers->tanggal_lahir }}</td>
                            <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customers->model_mobil }}</td>
                            <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customers->jenis_pelanggan }}</td>
                            <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customers->old_salesman }}
                            <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                @if ($customers->progress)
                                @php
                                $colorClasses = match($customers->progress) {
                                'SPK' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                'DO' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                'reject' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                'tidak valid' => 'bg-gray-500 text-white dark:bg-gray-700 dark:text-gray-100',
                                default => '' //tidak ada
                                };
                                @endphp
                                <span class="px-2 py-1 text-xs rounded-full {{ $colorClasses }}">
                                    {{ $customers->progress }}
                                </span>
                                @endif
                            </td>

                            @php
                            $alasan = $customers->alasan === 'N/A' || is_null($customers->alasan) ? 'no reason' : $customers->alasan;
                            @endphp
                            <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $alasan }}</td>
                            <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <button onclick="openTampilData(this)"
                                        data-progress="{{ $customers->progress }}"
                                        data-alasan="{{ $customers->alasan }}"
                                        data-cabang="{{ $customers->branch->name ?? '' }}"
                                        data-salesman="{{ $customers->salesman->name ?? '' }}"
                                        data-sumber_data="{{ $customers->sumber_data }}"
                                        data-customer="{{ $customers->nama }}"
                                        data-alamat="{{ $customers->alamat }}"
                                        data-kelurahan="{{ $customers->kelurahan }}"
                                        data-kecamatan="{{ $customers->kecamatan }}"
                                        data-kota="{{ $customers->kota }}"
                                        data-tanggal_lahir="{{ $customers->tanggal_lahir }}"
                                        data-jenis_kelamin="{{ $customers->jenis_kelamin }}"
                                        data-tipe_pelanggan="{{ $customers->tipe_pelanggan }}"
                                        data-jenis_pelanggan="{{ $customers->jenis_pelanggan }}"
                                        data-tenor="{{ $customers->tenor }}"
                                        data-tanggal_gatepass="{{ $customers->tanggal_gatepass }}"
                                        data-pekerjaan="{{ $customers->pekerjaan }}"
                                        data-jenis_kendaraan="{{ $customers->model_mobil }}"
                                        data-nomor_rangka="{{ $customers->nomor_rangka }}"
                                        data-no_telepon="{{ $customers->nomor_hp_1 }}"
                                        data-no_telepon_update="{{ $customers->nomor_hp_2 }}"
                                        class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                        <span class="material-symbols-outlined text-sm">info</span>
                                    </button>
                                    <form action="{{ route('admin.customer.destroy', $customers->id) }}" method="POST" class="delete-customer-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
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
    <div id="uploadFileModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 hidden">
        <!-- Background Blur -->
        <div class="absolute inset-0 bg-gray-100 bg-opacity-10 backdrop-blur-sm" onclick="closeModal()"></div>

        <div class="relative bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 my-6 sm:my-8 md:max-w-lg">
            <!-- Close Button -->
            <button type="button" onclick="closeModal()" class="text-xl text-gray-500 dark:text-gray-300 absolute top-4 right-4">
                <span class="material-symbols-outlined">close</span>
            </button>

            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white mb-4">
                Upload Your Excel File
            </h3>

            <!-- Form Upload -->
            <form id="uploadForm"
                action="{{ route('admin.bigdata.upload') }}"
                method="POST"
                enctype="multipart/form-data"
                class="w-full">
                @csrf

                <!-- Dropzone Area -->
                <div class="mb-4">
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-64 sm:h-72
                                    border-2 border-gray-300 border-dashed rounded-lg cursor-pointer
                                    bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600">
                            <div class="pt-5 pb-6 flex flex-col items-center">
                                <span id="fileIcon" class="material-symbols-outlined text-7xl text-gray-500 dark:text-gray-400">
                                    cloud_upload
                                </span>
                                <p id="fileUploadText" class="mt-2 text-center text-gray-500 dark:text-gray-400">
                                    <span class="font-semibold" id="fileNameText">Click to upload</span>
                                    or drag and drop
                                </p>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 text-center">
                                    Only Excel files (.xlsx, .xls, .csv)
                                </p>
                            </div>

                            <!-- Hidden but focusable input -->
                            <input id="dropzone-file"
                                type="file"
                                name="xlsx"
                                accept=".xlsx,.xls,.csv"
                                required
                                class="absolute w-1 h-1 opacity-0"
                                onchange="document.getElementById('fileNameText').textContent = this.files[0]?.name || 'Click to upload';" />
                        </label>
                    </div>

                    <div id="fileError" class="mt-2 text-red-600 dark:text-red-400 text-sm text-center hidden">
                        Invalid file format. Please upload a valid Excel file.
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex gap-2">
                    <button type="button"
                        onclick="closeModal()"
                        class="w-full px-4 py-2 bg-gray-500 text-white rounded-md">
                        Cancel
                    </button>
                    <button type="submit"
                        id="uploadButton"
                        class="w-full px-4 py-2 bg-blue-500 text-white rounded-md">
                        Upload
                    </button>
                </div>
            </form>
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
                    <!-- cabang -->
                    <div class="mb-4">
                        <label for="cabang"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cabang</label>
                        <input disabled type="text" id="cabang" name="cabang"
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
                        <label for="tgl_gatepass" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tgl.
                            Gatepass</label>
                        <input disabled type="date" id="tgl_gatepass" name="tgl_gatepass"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="N/A">
                    </div>
                    <div class="mb-4">
                        <label for="pekerjaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pekerjaan</label>
                        <input disabled type="text" id="pekerjaan" name="pekerjaan"
                            class="mt-1 block w-full px-3 py-2 border rounded-md text-gray-700 dark:text-gray-200 dark:bg-gray-800"
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

    <!-- Tambah Data Modal Container -->
    <div id="AddDataModal"
        class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 hidden">
        <!-- Modal Background with Blur effect -->
        <div class="absolute inset-0 bg-gray-100 bg-opacity-10 backdrop-blur-sm" onclick="closeAddData()">
        </div>

        <!-- Modal Content -->
        <div
            class="relative bg-white dark:bg-gray-800 rounded-lg p-4 md:p-6 max-w-md w-full mx-4 my-6 sm:my-8 md:max-w-full z-10 max-h-screen overflow-y-auto w-full">
            <!-- Close Button (X) -->
            <button type="button" onclick="closeAddData()"
                class="text-xl text-gray-500 dark:text-gray-300 absolute top-4 right-4">
                <span class="material-symbols-outlined">close</span> <!-- Material icon for X -->
            </button>

            <!-- Modal Header with Title -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white">Tambah Data</h3>
            </div>

            <!-- Form Input Fields -->
            <form action="{{ route('admin.customer.store') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Use grid layout for better organization -->
                <div class="flex flex-col gap-6 md:grid md:grid-cols-2 lg:grid-cols-4">
                    <!-- Progress -->
                    <div class="mb-4">
                        <label for="progress" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Progress</label>
                        <select id="progress" name="progress"
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
                        <input type="text" id="alasan" name="alasan"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Alasan">
                    </div>
                    <!-- cabang -->
                    <div class="mb-4">
                        <label for="branch_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cabang</label>
                        <select id="branch_id" name="branch_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                            <option value="">Pilih cabang</option>
                            @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="salesman_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Salesman</label>
                        <select id="salesman_id" name="salesman_id"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                            <option value="">Pilih Salesman</option>
                            @foreach($salesmen as $salesman)
                            <option value="{{ $salesman->id }}">{{ $salesman->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="sumber_data"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sumber
                            Data</label>
                        <input type="text" id="sumber_data" name="sumber_data"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Sumber Data">
                    </div>
                    <div class="mb-4">
                        <label for="nama"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Customer</label>
                        <input type="text" id="nama" name="nama"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Nama">
                    </div>
                    <div class="mb-4">
                        <label for="alamat"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                        <input type="text" id="alamat" name="alamat"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Alamat">
                    </div>
                    <div class="mb-4">
                        <label for="kelurahan"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kelurahan</label>
                        <input type="text" id="kelurahan" name="kelurahan"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Kelurahan">
                    </div>
                    <div class="mb-4">
                        <label for="kecamatan"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kecamatan</label>
                        <input type="text" id="kecamatan" name="kecamatan"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Kecamatan">
                    </div>
                    <div class="mb-4">
                        <label for="kota"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kota</label>
                        <input type="text" id="kota" name="kota"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Kota">
                    </div>
                    <div class="mb-4">
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tgl.
                            Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Tgl Lahir">
                    </div>
                    <div class="mb-4">
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
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
                        <input type="text" id="tipe_pelanggan" name="tipe_pelanggan"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Tipe Pelanggan">
                    </div>
                    <div class="mb-4">
                        <label for="jenis_pelanggan"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
                            Pelanggan</label>
                        <input type="text" id="jenis_pelanggan" name="jenis_pelanggan"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Jenis Pelanggan">
                    </div>
                    <div class="mb-4">
                        <label for="tenor"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tenor</label>
                        <input type="number" id="tenor" name="tenor"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Tenor">
                    </div>
                    <div class="mb-4">
                        <label for="tanggal_gatepass" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tgl.
                            Gatepass</label>
                        <input type="date" id="tanggal_gatepass" name="tanggal_gatepass"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Tgl Gatepass">
                    </div>
                    <div class="mb-4">
                        <label for="pekerjaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pekerjaan</label>
                        <input type="text" id="pekerjaan" name="pekerjaan"
                            class="mt-1 block w-full px-3 py-2 border rounded-md text-gray-700 dark:text-gray-200 dark:bg-gray-800"
                            placeholder="Pekerjaan">
                    </div>

                    <div class="mb-4">
                        <label for="model_mobil"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
                            Kendaraan</label>
                        <input type="text" id="model_mobil" name="model_mobil"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Jenis Kendaraan">
                    </div>
                    <div class="mb-4">
                        <label for="nomor_rangka" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No.
                            Rangka</label>
                        <input type="text" id="nomor_rangka" name="nomor_rangka"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="No Rangka">
                    </div>
                    <div class="mb-4">
                        <label for="nomor_hp_1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No.
                            Telepon </label>
                        <input type="number" id="nomor_hp_1" name="nomor_hp_1"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="No Telepon">
                    </div>
                    <div>
                        <label for="nomor_hp_2"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">No.
                            Telepon Update</label>
                        <input type="number" id="nomor_hp_2" name="nomor_hp_2"
                            class=" block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="No Telepon update">
                    </div>
                    <div>
                        <label for="old_salesman"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Old
                            Salesman</label>
                        <input type="text" id="old_salesman" name="old_salesman"
                            class=" block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="(optional)">
                    </div>
                    <!-- Submit Button -->
                    <div class="mb-2 col-span-2 sm:col-span-4">
                        <button type="submit"
                            class="w-full px-4 py-2 bg-blue-500 text-white rounded-md">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection
