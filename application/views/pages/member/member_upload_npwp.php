<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-lg-3">
        <div class="card">
            <div class="card-header">
                <h4>Upload NPWP</h4>
            </div>
            <div class="card-body">
                <img class="card-img-top" src="<?= base_url() . "assets/images/berkas/" . $detail['scan_npwp']; ?>" alt="">

                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="npwp">&nbsp;</label>
                        <input type="file" class="form-control" id="npwp" name="npwp" value="">
                        <input type="hidden" name="idted" value="<?= $detail['idted']; ?>" />
                    </div>
                    <button type="submit" class="btn btn-secondary btn-lg btn-block">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>