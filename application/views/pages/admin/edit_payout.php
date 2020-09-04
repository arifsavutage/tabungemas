<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
        <div class="card mb-3">
            <div class="card-header">
                <h3>Edit Payout</h3>
            </div>
            <div class="card-body">

                <form name="editpayout" action="" method="post">
                    <div class="form-group">
                        <label for="namapayout">Nama Payout<span class="text-danger">*</span></label>
                        <input type="text" name="namapayout" value="<?= $detail['nama_payout']; ?>" required placeholder="Isi nama payout" class="form-control" id="namapayout">
                        <input type="hidden" name="id" value="<?= $detail['id']; ?>" />

                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal<span class="text-danger">*</span></label>
                        <input type="text" name="nominal" value="<?= $detail['nominal']; ?>" required placeholder="nominal" class="form-control" id="nominal">
                    </div>

                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary" type="submit">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-secondary m-l-5">
                            Cancel
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<style>
    .parsley-error {
        border-color: #ff5d48 !important;
    }

    .parsley-errors-list.filled {
        display: block;
    }

    .parsley-errors-list {
        display: none;
        margin: 0;
        padding: 0;
    }

    .parsley-errors-list>li {
        font-size: 12px;
        list-style: none;
        color: #ff5d48;
        margin-top: 5px;
    }

    .form-section {
        padding-left: 15px;
        border-left: 2px solid #FF851B;
        display: none;
    }

    .form-section.current {
        display: inherit;
    }
</style>