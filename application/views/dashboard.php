<?php
$this->load->view('_partials/header');
$this->load->view('_partials/menu_top');
$this->load->view('_partials/menu_sidebar');

?>
<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">


            <!--breadcrumb-->
            <?php $this->load->view('_partials/breadcrumb'); ?>
            <!--breadcrumb-->

            <?php
            if ($page) {
                $this->load->view($page);
            }
            ?>
        </div>
        <!-- END container-fluid -->
    </div>
    <!-- END content -->
</div>
<!-- END content-page -->
<?php $this->load->view('_partials/footer'); ?>