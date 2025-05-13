<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Modern Material Icons (Outlined) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')
    <!-- Alpine JS -->
    @vite('resources/js/app.js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Base styles */
        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* Dark mode styles */
        .dark {
            --tw-bg-opacity: 1;
            background-color: rgb(17 24 39 / var(--tw-bg-opacity));
        }

        .dark .dark\:bg-gray-800 {
            background-color: #1f2937;
        }

        .dark .dark\:bg-gray-700 {
            background-color: #374151;
        }

        .dark .dark\:text-white {
            color: #fff;
        }

        .dark .dark\:text-gray-300 {
            color: #d1d5db;
        }

        .dark .dark\:border-gray-700 {
            border-color: #374151;
        }

        .dark .dark\:hover\:bg-gray-700:hover {
            background-color: #374151;
        }

        /* App container */
        .app-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Sidebar styles */
        .sidebar {
            width: 250px;
            height: 100%;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            overflow-x: hidden;
            transition: width 0.3s ease, transform 0.3s ease;
            z-index: 50;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            min-height: 100vh;
            transition: margin-left 0.0s ease;
        }

        /* Overlay styles */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 40;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .sidebar-open .sidebar-overlay {
            opacity: 1;
            pointer-events: auto;
        }

        /* Collapsed sidebar */
        .sidebar-collapsed .sidebar {
            width: auto;
        }

        .sidebar-collapsed .main-content {
            margin-left: 70px;
        }

        .sidebar-collapsed .sidebar-text {
            opacity: 0;
            position: absolute;
            pointer-events: none;
            transition: opacity 0.0s ease;
        }

        /* Hover effects */
        .sidebar-collapsed .sidebar:hover {
            width: 250px;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar-collapsed .sidebar:hover .sidebar-text {
            opacity: 1;
            position: static;
            pointer-events: auto;
            transition-delay: 0.0s;
        }

        /* Menu dots */
        .menu-dots-container {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .menu-dots {
            display: none;
        }

        .sidebar-collapsed .menu-dots {
            display: block;
        }

        .sidebar-collapsed .menu-text {
            display: none;
        }

        .sidebar-collapsed .sidebar:hover .menu-dots {
            display: none;
        }

        .sidebar-collapsed .sidebar:hover .menu-text {
            display: block;
        }

        /* Dropdown arrows */
        .dropdown-arrow {
            transition: transform 0.2s ease;
        }

        .dropdown-open .dropdown-arrow {
            transform: rotate(180deg);
        }

        .sidebar-collapsed .dropdown-arrow {
            display: none;
        }

        .sidebar-collapsed .sidebar:hover .dropdown-arrow {
            display: block;
        }

        /* Dropdown content */
        .sidebar-collapsed .dropdown-content {
            display: none !important;
        }

        .sidebar-collapsed .sidebar:hover .dropdown-content {
            display: block !important;
        }

        /* Navbar icon alignment */
        .nav-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .nav-icon:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .dark .nav-icon:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        nav {
            position: sticky;
            top: 0;
            z-index: 30;
        }

        /* Mobile and Tablet responsive (up to 768px) */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 50;
            }

            .sidebar-open .sidebar {
                transform: translateX(0);
                width: 250px;
                height: 100%;
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar-collapsed .main-content {
                margin-left: 0;
            }

            /* Adjust navbar padding */
            nav {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            /* Make cards full width on mobile, 2 columns on tablet */
            .grid-cols-1 {
                grid-template-columns: 1fr !important;
            }

            @media (min-width: 640px) {
                .grid-cols-1 {
                    grid-template-columns: repeat(2, 1fr) !important;
                }
            }

            /* Adjust content padding */
            .p-6 {
                padding: 1rem;
            }

            /* Hide collapse button */
            .sidebar-collapse-btn {
                display: none;
            }

            /* Make navbar icons smaller */
            .nav-icon {
                width: 32px;
                height: 32px;
            }

            /* Adjust user dropdown */
            .user-dropdown-btn div {
                width: 32px;
                height: 32px;
            }
        }

        /* Desktop responsive (769px and up) */
        @media (min-width: 769px) {
            .sidebar-overlay {
                display: none !important;
            }

            /* Enable hover effects for desktop */
            .sidebar-collapsed .sidebar:hover .dropdown-content {
                display: block !important;
            }

            .sidebar-collapsed .sidebar:hover [x-show="dropdownOpen"] {
                display: block !important;
            }
        }

        /* Add a container with max-width constraint */
        .table-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Make sure the table doesn't exceed its container */
        table {
            table-layout: auto;
        }

        /* For very small screens, ensure the table wrapper is visible */
        @media (max-width: 640px) {
            .overflow-x-auto {
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>

</head>

<!-- Navbar -->
@include('Admin.Laporan.Layouts.Sidebar')

@yield('content')

<!-- Footer -->
@include('Admin.Laporan.Layouts.Footer')

</main>
</div>

<!-- SweetAlert logout -->
<script>
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded ml-5",
            cancelButton: "px-4 py-2 text-white bg-gray-500 hover:bg-gray-700 rounded"
        },
        buttonsStyling: false
    });

    function confirmLogout() {
        swalWithBootstrapButtons.fire({
            title: "Apakah anda ingin logout?",
            text: "Setelah ini anda harus login kembali",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Logout",
            cancelButtonText: "Cancel",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get table elements - UPDATED IDs for Salesman Table
        const table = document.getElementById('SalesmanProgressTable');
        const tableBody = document.getElementById('SalesmanProgressTableBody');
        const rows = Array.from(tableBody.querySelectorAll('tr'));

        // Get filter elements - UPDATED IDs for the filters
        const searchInput = document.getElementById('salesmanSearch');
        const branchFilter = document.getElementById('branchFilter');
        const itemsPerPageSelect = document.getElementById('itemsPerPage');

        // Get pagination elements - KEPT SAME (assuming these IDs match)
        const prevPageButton = document.getElementById('prevPage');
        const nextPageButton = document.getElementById('nextPage');
        const pageNumbersContainer = document.getElementById('pageNumbers');
        const showingFrom = document.getElementById('showingFrom');
        const showingTo = document.getElementById('showingTo');
        const totalItems = document.getElementById('totalItems');

        // Pagination state
        let currentPage = 1;
        let itemsPerPage = parseInt(itemsPerPageSelect.value);

        // Extract data from the table - UPDATED FOR YOUR COLUMN STRUCTURE
        function extractTableData() {
            return rows.map(row => {
                const cells = Array.from(row.querySelectorAll('td'));
                return {
                    no: cells[0] ? cells[0].textContent.trim() : '',
                    cabang: cells[1] ? cells[1].textContent.trim() : '',
                    nama: cells[2] ? cells[2].textContent.trim() : '',
                    totalFollowUp: cells[3] ? cells[3].textContent.trim() : '',
                    totalKontak: cells[4] ? cells[4].textContent.trim() : '',
                    totalKontakInvalid: cells[5] ? cells[5].textContent.trim() : '',
                    totalPending: cells[6] ? cells[6].textContent.trim() : '',
                    totalProcess: cells[7] ? cells[7].textContent.trim() : '',
                    totalClosing: cells[8] ? cells[8].textContent.trim() : '',
                    element: row // Store reference to the original row element
                };
            });
        }

        // Initialize table data
        const tableData = extractTableData();

        // Filter table data based on search and filter criteria - UPDATED FILTERS
        function filterTableData() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedBranch = branchFilter.value;

            return tableData.filter(item => {
                // Check if matches search term
                const matchesSearch =
                    item.no.toLowerCase().includes(searchTerm) ||
                    item.cabang.toLowerCase().includes(searchTerm) ||
                    item.nama.toLowerCase().includes(searchTerm) ||
                    item.totalFollowUp.toLowerCase().includes(searchTerm) ||
                    item.totalKontak.toLowerCase().includes(searchTerm) ||
                    item.totalKontakInvalid.toLowerCase().includes(searchTerm) ||
                    item.totalPending.toLowerCase().includes(searchTerm) ||
                    item.totalProcess.toLowerCase().includes(searchTerm) ||
                    item.totalClosing.toLowerCase().includes(searchTerm);

                // Check if matches filter criteria
                const matchesBranch = !selectedBranch || item.cabang === selectedBranch;

                return matchesSearch && matchesBranch;
            });
        }

        // Update table display with paginated data
        function updateTableDisplay(filteredData) {
            // Calculate pagination
            const totalFilteredItems = filteredData.length;
            const totalPages = Math.ceil(totalFilteredItems / itemsPerPage) || 1;

            // Adjust current page if needed
            if (currentPage > totalPages) {
                currentPage = totalPages;
            }
            if (currentPage < 1) {
                currentPage = 1;
            }

            // Calculate start and end indices for current page
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = Math.min(startIndex + itemsPerPage, totalFilteredItems);

            // Update pagination info
            totalItems.textContent = totalFilteredItems;
            showingFrom.textContent = totalFilteredItems === 0 ? 0 : startIndex + 1;
            showingTo.textContent = totalFilteredItems === 0 ? 0 : endIndex;

            // Enable/disable pagination buttons
            prevPageButton.disabled = currentPage === 1 || totalFilteredItems === 0;
            nextPageButton.disabled = currentPage === totalPages || totalFilteredItems === 0;

            // Generate page number buttons
            pageNumbersContainer.innerHTML = '';

            // Always show first page button if not visible
            if (totalPages > 1) {
                const firstPageButton = document.createElement('button');
                firstPageButton.textContent = '1';
                firstPageButton.className = currentPage === 1 ?
                    'px-3 py-1 text-sm bg-blue-500 text-white rounded-lg' :
                    'px-3 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800';
                firstPageButton.addEventListener('click', () => {
                    currentPage = 1;
                    const newFilteredData = filterTableData();
                    updateTableDisplay(newFilteredData);
                });
                pageNumbersContainer.appendChild(firstPageButton);

                // Show ellipsis if needed
                if (currentPage > 3 && totalPages > 4) {
                    const ellipsis = document.createElement('span');
                    ellipsis.textContent = '...';
                    ellipsis.className = 'px-3 py-1 text-sm';
                    pageNumbersContainer.appendChild(ellipsis);
                }
            }

            // Show pages around current page
            let startPage = Math.max(2, currentPage - 1);
            let endPage = Math.min(totalPages - 1, currentPage + 1);

            // Adjust if we're at the beginning or end
            if (currentPage <= 3) {
                endPage = Math.min(4, totalPages - 1);
            }
            if (currentPage >= totalPages - 2) {
                startPage = Math.max(totalPages - 3, 2);
            }

            for (let i = startPage; i <= endPage; i++) {
                if (i < 2 || i > totalPages - 1) continue;

                const pageButton = document.createElement('button');
                pageButton.textContent = i;
                pageButton.className = i === currentPage ?
                    'px-3 py-1 text-sm bg-blue-500 text-white rounded-lg' :
                    'px-3 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800';

                pageButton.addEventListener('click', () => {
                    currentPage = i;
                    const newFilteredData = filterTableData();
                    updateTableDisplay(newFilteredData);
                });

                pageNumbersContainer.appendChild(pageButton);
            }

            // Always show last page button if not visible
            if (totalPages > 1) {
                // Show ellipsis if needed
                if (currentPage < totalPages - 2 && totalPages > 4) {
                    const ellipsis = document.createElement('span');
                    ellipsis.textContent = '...';
                    ellipsis.className = 'px-3 py-1 text-sm';
                    pageNumbersContainer.appendChild(ellipsis);
                }

                const lastPageButton = document.createElement('button');
                lastPageButton.textContent = totalPages;
                lastPageButton.className = currentPage === totalPages ?
                    'px-3 py-1 text-sm bg-blue-500 text-white rounded-lg' :
                    'px-3 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800';
                lastPageButton.addEventListener('click', () => {
                    currentPage = totalPages;
                    const newFilteredData = filterTableData();
                    updateTableDisplay(newFilteredData);
                });
                pageNumbersContainer.appendChild(lastPageButton);
            }

            // Hide all rows first
            rows.forEach(row => {
                row.style.display = 'none';
            });

            // Show only rows for current page
            const currentPageData = filteredData.slice(startIndex, endIndex);
            currentPageData.forEach(item => {
                item.element.style.display = '';
            });

            // If no results, show a message
            if (totalFilteredItems === 0) {
                const noResultsRow = document.createElement('tr');
                noResultsRow.className = 'bg-white dark:bg-gray-800';
                const noResultsCell = document.createElement('td');
                noResultsCell.colSpan = 9; // Adjust based on your columns
                noResultsCell.className = 'p-4 text-center text-gray-500 dark:text-gray-400';
                noResultsCell.textContent = 'No matching records found';
                noResultsRow.appendChild(noResultsCell);

                // Remove any existing no results row
                const existingNoResults = tableBody.querySelector('.no-results-row');
                if (existingNoResults) {
                    existingNoResults.remove();
                }

                noResultsRow.classList.add('no-results-row');
                tableBody.appendChild(noResultsRow);
            } else {
                // Remove no results row if it exists
                const existingNoResults = tableBody.querySelector('.no-results-row');
                if (existingNoResults) {
                    existingNoResults.remove();
                }
            }
        }

        // Event listeners for filtering
        searchInput.addEventListener('input', function () {
            currentPage = 1;
            const filteredData = filterTableData();
            updateTableDisplay(filteredData);
        });

        branchFilter.addEventListener('change', function () {
            currentPage = 1;
            const filteredData = filterTableData();
            updateTableDisplay(filteredData);
        });

        itemsPerPageSelect.addEventListener('change', function () {
            itemsPerPage = parseInt(this.value);
            currentPage = 1;
            const filteredData = filterTableData();
            updateTableDisplay(filteredData);
        });

        prevPageButton.addEventListener('click', function () {
            if (currentPage > 1) {
                currentPage--;
                const filteredData = filterTableData();
                updateTableDisplay(filteredData);
            }
        });

        nextPageButton.addEventListener('click', function () {
            const filteredData = filterTableData();
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                updateTableDisplay(filteredData);
            }
        });

        // Initialize the table
        updateTableDisplay(tableData);
    });
</script>

<script>
    // Toggle filters visibility on mobile
    const toggleFiltersBtn = document.getElementById("toggleFiltersBtn");
    const filterContainer = document.getElementById("filterContainer");

    toggleFiltersBtn.addEventListener('click', function () {
        filterContainer.classList.toggle('hidden');
    });

    // Ensure that search input stays in the correct position for tablets
    const mediaQuery = window.matchMedia("(max-width: 1024px)");

    function adjustLayoutForTablet() {
        const searchInput = document.querySelector('#SumberDataSearch');
        if (mediaQuery.matches) {
            searchInput.classList.add('w-full');
        } else {
            searchInput.classList.remove('w-full');
        }
    }

    // Initial layout adjustment
    adjustLayoutForTablet();

    // Listen to screen resize event
    mediaQuery.addListener(adjustLayoutForTablet);
</script>
</body>

</html>