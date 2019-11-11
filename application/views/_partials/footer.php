<footer class="footer">
    <span class="text-right">
        Copyright <a target="_blank" href="#">Your Website</a>
    </span>
    <span class="float-right">
        Powered by <a target="_blank" href="https://www.pikeadmin.com"><b>Pike Admin</b></a>
    </span>
</footer>

</div>
<!-- END main -->
<script src="<?= base_url(); ?>assets/js/modernizr.min.js"></script>
<script src="<?= base_url(); ?>assets/js/moment.min.js"></script>

<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>

<script src="<?= base_url(); ?>assets/js/detect.js"></script>
<script src="<?= base_url(); ?>assets/js/fastclick.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery.blockUI.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/switchery/switchery.min.js"></script>

<!-- App js -->
<script src="<?= base_url(); ?>assets/js/pikeadmin.js"></script>

<!-- BEGIN Java Script for this page -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url(); ?>assets/plugins/datetimepicker/js/moment.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datetimepicker/js/daterangepicker.js"></script>

<script src="<?= base_url(); ?>assets/plugins/trumbowyg/trumbowyg.min.js"></script>

<script>
    $('#nominaluang').keyup(function() {
        var hrgjual = parseInt($('#hrgjual').val());
        var beli = parseInt($(this).val());

        var gramemas = beli / hrgjual;

        $('#nominalgram').val(gramemas.toFixed(3));
    });
</script>
<script>
    $(document).ready(function() {
        $('#example1').DataTable();
    });
</script>
<script>
    $(function() {
        $('input[name="tgllahir"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });
    });
    $(function() {
        $('input[name="tglmasuk"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });
    });
</script>
<script>
    $(document).ready(function() {
        'use strict';
        $('.editor').trumbowyg();
    });
</script>
<!-- END Java Script for this page -->

</body>

</html>