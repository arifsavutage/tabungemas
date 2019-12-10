<footer class="footer">
    <span class="text-right">
        Copyright <a target="_blank" href="https://www.tabungemas.com">tabungemas.com</a>
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
        var hrgbeli = parseInt($('#hrgbeli').val());
        var beli = parseInt($(this).val());

        var gramemas = beli / hrgbeli;

        $('#nominalgram').val(gramemas.toFixed(3));
    });
</script>
<script>
    $('#gram').keyup(function() {
        var saldo = parseFloat($('#saldo').val());
        var hrgjual = parseInt($('#hrgjual').val());
        var jual = parseFloat($(this).val());

        if (jual > saldo) {
            alert("Pastikan jumlah gram emas yang di masukkan benar");
            var pendapatan = jual * 0;

            $('#uang').val(pendapatan);
        } else {
            var pendapatan = jual * hrgjual;

            $('#uang').val(pendapatan);
        }

    });
</script>
<script>
    $(document).ready(function() {
        $("form input:text[name=saldowallet]").attr('readonly', true);
        $("#bank").attr('disabled', true);

        $("form input:radio[name=metode]").change(function() {

            if ($(this).val() == 'transfer') {
                $("form input:text[name=saldowallet]").attr('disabled', true);
                $("#bank").attr('disabled', false);
            } else {
                $("#bank").attr('disabled', true);
                //$("form input:text[name=saldowallet]").attr('disabled', false);
            }
        });
    });
</script>
<script>
    /*$(document).ready(function() {
        $('#saldowallet').hide();
        $('#saldoemas').hide();

        $('form input:radio[name=mode]').change(function() {

            if ($(this).val() == 'uang') {
                $('#saldoemas').hide();
                $('#saldowallet').show();
            } else {
                $('#saldowallet').hide();
                $('#saldoemas').show();
            }
        });
    });*/
</script>

<script>
    $(document).ready(function() {
        $('#example1').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#examples').DataTable({
            "order": [
                //angka adalah nomor kolom
                [0, "desc"]
            ]
        });
        $('#examples2').DataTable({
            "order": [
                //angka adalah nomor kolom
                [0, "desc"]
            ]
        });
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