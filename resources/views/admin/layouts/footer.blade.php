<script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('admin/js/ruang-admin.min.js') }}"></script>
<script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    // $(function () {
    //     $('[data-toggle="tooltip"]').tooltip()
    // });
    $(document).ready(function() {
        $('#summernote').summernote();
        $('#summernote1').summernote();
        $('#dataTable').DataTable();
    });

    function confirmDelete() {
        return confirm("Are you sure you want to delete?");
    }
</script>

@include('notify::messages')
@notifyJs

@yield('footerContent')
</body>

</html>
