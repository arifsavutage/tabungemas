<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-lg-3">
        <div class="card">
            <div class="card-header">
                <h4>Rubah Password</h4>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="pass1">Password Baru</label>
                        <input type="password" class="form-control" id="pass1" name="pass1" value="">
                        <?= form_error('pass1', '<small class="text-danger pl-3">', '</small>'); ?>
                        <input type="hidden" name="idted" value="<?= $detail['idted']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="pass2">Re-type Password</label>
                        <input type="password" class="form-control" id="pass2" name="pass2" value="">
                        <?= form_error('pass2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <button type="submit" class="btn btn-secondary btn-lg btn-block">Edit</button>

                </form>
            </div>
        </div>
    </div>
</div>