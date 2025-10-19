<script src="./dist/vendors/jquery/jquery.min.js"></script>
<script src="./coreui/coreui/dist/js/coreui.bundle.min.js"></script>
<script src="./coreui/icons/js/svgxuse.min.js"></script>
<script src="./coreui/chartjs/dist/js/coreui-chartjs.bundle.js"></script>
<script src="./coreui/utils/dist/coreui-utils.js"></script>
<script src="./dist/js/main.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function () {
        $('.example').DataTable()
    });
    function showToast(type = 'success', message = 'Operasi berhasil!') {
        const toast = $('#mainToast');
        const header = toast.find('.toast-header');
        const title = $('#toastTitle');
        const body = $('#toastBody');

        header.removeClass('bg-success bg-danger bg-info text-white');
        
        switch (type) {
            case 'success':
            header.addClass('bg-success text-white');
            title.text('Sukses');
            break;
            case 'error':
            header.addClass('bg-danger text-white');
            title.text('Gagal');
            break;
            case 'info':
            header.addClass('bg-info text-white');
            title.text('Info');
            break;
            default:
            header.addClass('bg-secondary text-white');
            title.text('Notifikasi');
        }

        body.text(message);
        toast.toast('show');
    }
</script>
