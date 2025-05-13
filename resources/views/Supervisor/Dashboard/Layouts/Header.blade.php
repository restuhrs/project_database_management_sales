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
@include('Supervisor.Dashboard.Layouts.Sidebar')

@yield('content')

<!-- Footer -->
@include('Supervisor.Dashboard.Layouts.Footer')

</main>
</div>

<!-- SweetAlert logout dan delete -->
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

    // document.querySelectorAll('.delete-user-form').forEach(form => {
    //     form.addEventListener('submit', function(e) {
    //         e.preventDefault();
    //         swalWithBootstrapButtons.fire({
    //             title: "Apakah anda ingin menghapus data?",
    //             text: "Data yang dihapus tidak bisa dikembalikan.",
    //             icon: "warning",
    //             showCancelButton: true,
    //             confirmButtonText: "Delete",
    //             cancelButtonText: "Cancel",
    //             reverseButtons: true
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 form.submit();
    //             }
    //         });
    //     });
    // });
</script>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Create a class to handle chart functionality with theme awareness
    class SalesmanChart {
        constructor(chartElementId, titleElementSelector) {
            this.ctx = document.getElementById(chartElementId).getContext('2d');
            this.titleElement = document.querySelector(titleElementSelector);
            this.originalTitle = this.titleElement.textContent;
            this.chart = null;
            this.activeRow = null;

            // Theme-aware colors
            this.colors = {
                saved: {
                    bg: 'rgba(59, 130, 246, 0.8)', // Blue
                    border: 'rgba(59, 130, 246, 1)'
                },
                followUp: {
                    bg: 'rgba(16, 185, 129, 0.8)', // Green
                    border: 'rgba(16, 185, 129, 1)'
                },
                invalid: {
                    bg: 'rgba(255, 0, 0, 0.8)', // Merah
                    border: 'rgba(255, 0, 0, 1)' // Merah
                }
            };

            // Default data structure
            this.defaultData = {
                labels: ['Saved Data', 'Follow Up', 'Invalid Data'],
                datasets: [{
                    data: [{{ $savedCount }}, {{ $followUpCount }}, {{ $invalidCount }}],
                    backgroundColor: [
                        this.colors.saved.bg,
                        this.colors.followUp.bg,
                        this.colors.invalid.bg
                    ],
                    borderColor: [
                        this.colors.saved.border,
                        this.colors.followUp.border,
                        this.colors.invalid.border
                    ],
                    borderWidth: 2
                }]
            };

            // Initialize the chart
            this.initChart(this.defaultData);

            // Set up document click handler for resetting
            document.addEventListener('click', (e) => {
                if (!e.target.closest('#salesmanTable')) {
                    this.resetChart();
                }
            });
        }

        // Initialize or update chart
        initChart(data) {
            if (this.chart) {
                this.chart.destroy();
            }

            const isDarkMode = document.documentElement.classList.contains('dark');
            const textColor = isDarkMode ? '#fff' : '#333';

            this.chart = new Chart(this.ctx, {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '60%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: textColor,
                                font: {
                                    size: 12
                                },
                                boxWidth: 12,
                                padding: 15
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    return `${label}: ${value}`;
                                }
                            },
                            backgroundColor: isDarkMode ? 'rgba(17, 24, 39, 0.8)' : 'rgba(255, 255, 255, 0.8)',
                            titleColor: isDarkMode ? '#fff' : '#111',
                            bodyColor: isDarkMode ? '#e5e7eb' : '#333',
                            borderColor: isDarkMode ? '#374151' : '#e5e7eb',
                            borderWidth: 1,
                            padding: 10,
                            cornerRadius: 4
                        }
                    }
                }
            });
        }

        // Update chart with row data
        updateWithRowData(rowData) {
            const newChartData = {
                labels: ['Saved Data', 'Follow Up'],
                datasets: [{
                    data: [rowData.saved, rowData.followUp],
                    backgroundColor: [
                        this.colors.saved.bg,
                        this.colors.followUp.bg
                    ],
                    borderColor: [
                        this.colors.saved.border,
                        this.colors.followUp.border
                    ],
                    borderWidth: 2
                }]
            };

            // Update the chart title
            this.titleElement.textContent = `${rowData.nama} (${rowData.kota}) Progress`;

            // Update the chart
            this.initChart(newChartData);
        }

        // Reset chart to default
        resetChart() {
            this.initChart(this.defaultData);
            this.titleElement.textContent = this.originalTitle;

            // Remove highlight from active row
            if (this.activeRow) {
                this.activeRow.classList.remove('bg-blue-100', 'dark:bg-blue-900');
                this.activeRow = null;
            }
        }

        // Set active row
        setActiveRow(row) {
            if (this.activeRow) {
                this.activeRow.classList.remove('bg-blue-100', 'dark:bg-blue-900');
            }

            row.classList.add('bg-blue-100', 'dark:bg-blue-900');
            this.activeRow = row;
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Create chart instance
        const salesmanChart = new SalesmanChart('salesChart', 'h3.text-lg.font-semibold');

        // Get table and rows
        const table = document.getElementById('salesmanTable');
        const tableBody = document.getElementById('salesmanTableBody');
        const rows = tableBody.querySelectorAll('tr');

        // Convert table rows to data array
        function getTableData() {
            const data = [];
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                if (cells.length >= 5) { // Ensure we have all columns
                    data.push({
                        no: cells[0].textContent.trim(),
                        kota: cells[1].textContent.trim(),
                        nama: cells[2].textContent.trim(),
                        followUp: parseInt(cells[3].textContent.trim()) || 0,
                        saved: parseInt(cells[4].textContent.trim()) || 0
                    });
                }
            });
            return data;
        }

        // Sample data from table
        const salesmanData = getTableData();

        // Pagination variables
        let currentPage = 1;
        let itemsPerPage = 10;
        let filteredData = [...salesmanData];

        // DOM elements
        const itemsPerPageSelect = document.getElementById('itemsPerPage');
        const prevPageBtn = document.getElementById('prevPage');
        const nextPageBtn = document.getElementById('nextPage');
        const pageNumbersContainer = document.getElementById('pageNumbers');
        const showingFromSpan = document.getElementById('showingFrom');
        const showingToSpan = document.getElementById('showingTo');
        const totalItemsSpan = document.getElementById('totalItems');
        const searchInput = document.getElementById('salesmanSearch');

        // Function to render table data
        function renderTable() {
            // Calculate pagination
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedData = filteredData.slice(startIndex, endIndex);

            // Clear table body
            tableBody.innerHTML = '';

            // If no results after filtering
            if (filteredData.length === 0) {
                const noResultsRow = document.createElement('tr');
                noResultsRow.className = 'bg-white dark:bg-gray-800';
                const noResultsCell = document.createElement('td');
                noResultsCell.colSpan = 5;  // Adjust the colspan to fit your table columns
                noResultsCell.className = 'p-4 text-center text-gray-500 dark:text-gray-400';
                noResultsCell.textContent = 'No matching records found';
                noResultsRow.appendChild(noResultsCell);
                tableBody.appendChild(noResultsRow);
            } else {
                // Populate table with filtered and paginated data
                paginatedData.forEach((item, index) => {
                    const row = document.createElement('tr');
                    row.className = index % 2 === 0 ?
                        'bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 cursor-pointer' :
                        'bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer';

                    // Store data in row
                    row.dataset.salesmanData = JSON.stringify(item);

                    row.innerHTML = `
                            <td class="p-3 sm:p-4 border-b border-gray-200 dark:border-gray-600">${item.no}</td>
                            <td class="p-3 sm:p-4 border-b border-gray-200 dark:border-gray-600">${item.kota}</td>
                            <td class="p-3 sm:p-4 border-b border-gray-200 dark:border-gray-600">${item.nama}</td>
                            <td class="p-3 sm:p-4 border-b border-gray-200 dark:border-gray-600">${item.followUp}</td>
                            <td class="p-3 sm:p-4 border-b border-gray-200 dark:border-gray-600">${item.saved}</td>
                        `;

                    // Add click event
                    row.addEventListener('click', function (e) {
                        e.stopPropagation();

                        // Set this row as active
                        salesmanChart.setActiveRow(this);

                        // Update chart with row data
                        const rowData = JSON.parse(this.dataset.salesmanData);
                        salesmanChart.updateWithRowData(rowData);
                    });

                    tableBody.appendChild(row);
                });
            }

            // Update pagination info
            updatePaginationInfo();
        }

        function updatePaginationInfo() {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            const startItem = filteredData.length > 0 ? (currentPage - 1) * itemsPerPage + 1 : 0;
            const endItem = Math.min(currentPage * itemsPerPage, filteredData.length);

            showingFromSpan.textContent = startItem;
            showingToSpan.textContent = endItem;
            totalItemsSpan.textContent = filteredData.length;

            // Update pagination buttons
            prevPageBtn.disabled = currentPage === 1;
            prevPageBtn.classList.toggle('opacity-50', currentPage === 1);
            nextPageBtn.disabled = currentPage === totalPages || totalPages === 0;
            nextPageBtn.classList.toggle('opacity-50', currentPage === totalPages || totalPages === 0);

            // Update page numbers
            pageNumbersContainer.innerHTML = '';

            const maxVisiblePages = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            if (endPage - startPage + 1 < maxVisiblePages) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }

            // Previous ellipsis
            if (startPage > 1) {
                const ellipsis = document.createElement('span');
                ellipsis.className = 'px-3 py-1 text-gray-500 dark:text-gray-400';
                ellipsis.textContent = '...';
                pageNumbersContainer.appendChild(ellipsis);
            }

            // Page numbers
            for (let i = startPage; i <= endPage; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.className = `px-3 py-1 text-sm border rounded-lg ${i === currentPage
                    ? 'bg-blue-500 text-white border-blue-600 dark:bg-blue-600 dark:border-blue-700'
                    : 'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'
                    }`;
                pageBtn.textContent = i;
                pageBtn.addEventListener('click', () => {
                    currentPage = i;
                    renderTable();
                });
                pageNumbersContainer.appendChild(pageBtn);
            }

            // Next ellipsis
            if (endPage < totalPages) {
                const ellipsis = document.createElement('span');
                ellipsis.className = 'px-3 py-1 text-gray-500 dark:text-gray-400';
                ellipsis.textContent = '...';
                pageNumbersContainer.appendChild(ellipsis);
            }
        }

        // Filter data
        function filterData() {
            const searchTerm = searchInput.value.toLowerCase();

            filteredData = salesmanData.filter(item => {
                const matchesSearch =
                    item.nama.toLowerCase().includes(searchTerm) ||
                    item.kota.toLowerCase().includes(searchTerm) ||
                    item.followUp.toString().includes(searchTerm) ||
                    item.saved.toString().includes(searchTerm);

                return matchesSearch;
            });

            currentPage = 1; // Reset to first page
            renderTable();
            salesmanChart.resetChart(); // Reset chart when filtering
        }

        // Set up event listeners
        itemsPerPageSelect?.addEventListener('change', (e) => {
            itemsPerPage = parseInt(e.target.value);
            currentPage = 1;
            renderTable();
        });

        prevPageBtn?.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        });

        nextPageBtn?.addEventListener('click', () => {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
            }
        });

        searchInput?.addEventListener('input', filterData);

        // Watch for theme changes to update chart
        const observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                if (mutation.attributeName === 'class') {
                    // Theme has changed, update chart
                    salesmanChart.initChart(salesmanChart.chart.data);
                }
            });
        });

        // Observe document element for class changes (dark mode toggle)
        observer.observe(document.documentElement, {
            attributes: true
        });

        // Initial render
        renderTable();

        // Add click events to existing rows (if any)
        rows.forEach(row => {
            row.addEventListener('click', function (e) {
                e.stopPropagation();

                // Get data from cells
                const cells = this.querySelectorAll('td');
                if (cells.length >= 5) {
                    const rowData = {
                        no: cells[0].textContent.trim(),
                        kota: cells[1].textContent.trim(),
                        nama: cells[2].textContent.trim(),
                        followUp: parseInt(cells[3].textContent.trim()) || 0,
                        saved: parseInt(cells[4].textContent.trim()) || 0
                    };

                    // Set this row as active
                    salesmanChart.setActiveRow(this);

                    // Update chart with row data
                    salesmanChart.updateWithRowData(rowData);
                }
            });
        });
    });
</script>

</body>

</html>