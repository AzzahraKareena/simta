<script>
    "use strict";

    // Class definition
    var KTDatatablesServerSide = function() {
        // Shared variables
        var table;
        var dt;

        // Private functions
        var initDatatable = function() {
            dt = $("#dt_timeline").DataTable();
            table = dt.$;
        }

        // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
        var handleSearchDatatable = function() {
            const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
            filterSearch.addEventListener('keyup', function(e) {
                dt.search(e.target.value).draw();
            });
        }

        // Public methods
        return {
            init: function() {
                initDatatable();
                handleSearchDatatable();
            }
        }
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function() {
        KTDatatablesServerSide.init();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const tahunAjaranSelect = document.getElementById('tahun');

        // Jika tahun ajaran yang dipilih ada, set URL form untuk mengirimkan data ke server
        tahunAjaranSelect.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });
</script>