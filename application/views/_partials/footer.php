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
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script src="<?= base_url(); ?>assets/plugins/datetimepicker/js/moment.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datetimepicker/js/daterangepicker.js"></script>

<script src="<?= base_url(); ?>assets/plugins/trumbowyg/trumbowyg.min.js"></script>

<script src="<?= base_url(); ?>assets/plugins/parsleyjs/parsley.min.js"></script>
<script>
    $('#form').parsley();
</script>

<script type="text/javascript">
    //fungsi untuk filtering data berdasarkan tanggal 
    var start_date;
    var end_date;
    var DateFilterFunction = (function(oSettings, aData, iDataIndex) {
        var dateStart = parseDateValue(start_date);
        var dateEnd = parseDateValue(end_date);
        //Kolom tanggal yang akan kita gunakan berada dalam urutan 2, karena dihitung mulai dari 0
        //nama depan = 0
        //nama belakang = 1
        //tanggal terdaftar =2
        var evalDate = parseDateValue(aData[2]);
        if ((isNaN(dateStart) && isNaN(dateEnd)) ||
            (isNaN(dateStart) && evalDate <= dateEnd) ||
            (dateStart <= evalDate && isNaN(dateEnd)) ||
            (dateStart <= evalDate && evalDate <= dateEnd)) {
            return true;
        }
        return false;
    });

    // fungsi untuk converting format tanggal dd/mm/yyyy menjadi format tanggal javascript menggunakan zona aktubrowser
    function parseDateValue(rawDate) {
        var dateArray = rawDate.split("/");
        var parsedDate = new Date(dateArray[2], parseInt(dateArray[1]) - 1, dateArray[0]); // -1 because months are from 0 to 11   
        return parsedDate;
    }

    /*$(document).ready(function() {
        //konfigurasi DataTable pada tabel dengan id example dan menambahkan  div class dateseacrhbox dengan dom untuk meletakkan inputan daterangepicker
        var $dTable = $('#example').DataTable({
            "dom": "<'row'<'col-sm-4'l><'col-sm-5' <'datesearchbox'>><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>"
        });

        //menambahkan daterangepicker di dalam datatables
        $("div.datesearchbox").html('<div class="input-group"> <div class="input-group-addon"> <i class="glyphicon glyphicon-calendar"></i> </div><input type="text" class="form-control pull-right" id="datesearch" placeholder="Search by date range.."> </div>');

        document.getElementsByClassName("datesearchbox")[0].style.textAlign = "right";

        //konfigurasi daterangepicker pada input dengan id datesearch
        $('#datesearch').daterangepicker({
            autoUpdateInput: false
        });

        //menangani proses saat apply date range
        $('#datesearch').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            start_date = picker.startDate.format('DD/MM/YYYY');
            end_date = picker.endDate.format('DD/MM/YYYY');
            $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
            $dTable.draw();
        });

        $('#datesearch').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            start_date = '';
            end_date = '';
            $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
            $dTable.draw();
        });
    });*/
</script>

<script>
    $(document).ready(function() {
        $('#examplebtn').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ]
        });
    });
</script>

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
    $(document).ready(function() {
        var judul = $('#judul-berkas').val();
        $('#export').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    title: judul
                },
                {
                    extend: 'pdfHtml5',
                    title: judul
                }
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
    $(function() {
        $('.dates').daterangepicker({
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

<!-- AJAX Jual Emas Ke Anggota-->
<script>
    $(document).ready(function() {
        $('#idtujuan').on('change', function(event) {
            event.preventDefault();

            var idanggota = $(this).val();
            var idsendiri = $('#idted').val();

            $.getJSON("<?= base_url(); ?>" + "index.php/member/anggotaAjax/" + idanggota, function(data) {


                if (data.status == 200) {
                    if (idanggota == idsendiri) {
                        $('#namatujuan').val('');
                        $('#hp').val('');
                        $('#email').val('');
                        $('#alamat').val('');
                        $('#imgid').append('');

                        $('#imgid').append('<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>Oops, </h4> Maaf ' + data.member.nama_lengkap + ' transaksi ini tidak bisa menjual ke akun Anda sendiri. <br /> Pastika <strong>ID Anggota</strong> yang Anda input benar</div>');
                    } else {
                        $('#namatujuan').val(data.member.nama_lengkap);
                        $('#hp').val(data.member.nohp);
                        $('#email').val(data.member.email);
                        $('#alamat').val(data.member.alamat);
                        $('#imgid').append('<img src="<?= base_url(); ?>assets/images/avatars/' + data.member.foto_profil + '" class="img-fluid img-thumbnail w-50" alt="member profile">');
                    }

                } else {
                    $('#namatujuan').val('');
                    $('#hp').val('');
                    $('#email').val('');
                    $('#alamat').val('');
                    $('#imgid').append('');

                    $('#imgid').append('<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>Oops, </h4> Anggota tidak ditemukan</div>');
                }

            });
        });
    });
</script>
<!-- AJAX Jual Emas Ke Anggota-->
<script>
    function valtrf() {
        var i = confirm("Pastikan data sudah benar. \n Yakin akan ditransfer ?");

        if (i) {
            return true;
        } else {
            return false;
        }
    }
</script>
<script>
    $(function() {
        $('input[name="tgl1"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
        $('input[name="tgl2"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
</script>
</body>

</html>