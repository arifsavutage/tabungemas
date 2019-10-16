<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <?php
            $uri_controller = $this->uri->segment(1);
            $uri_method     = $this->uri->segment(2);

            if (empty($uri_controller)) {
                $main = "dashboard";
            } else {
                $main = $uri_controller;
            }

            $child = "";
            if (!empty($uri_method)) {
                $mainclass  = "";
                $child      = " <li class='breadcrumb-item active'>$uri_method</li>";
            } else {
                $mainclass = "active";
            }

            ?>
            <h1 class="main-title float-left"><?php echo ucwords($main); ?></h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item <?php echo $mainclass; ?>"><?php echo ucwords($main); ?></li>
                <?php echo $child; ?>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->