<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
        <div class="card mb-3">
            <div class="card-header">
                <h3>Tambah Rekening Bank</h3>
            </div>
            <div class="card-body">

                <form name="addbank" action="" method="post" data-parsley-validate novalidate>
                    <div class="form-group">
                        <label for="namabank">Nama Bank<span class="text-danger">*</span></label>
                        <input type="text" name="namabank" data-parsley-trigger="change" required placeholder="Isi nama bank" class="form-control" id="namabank">
                    </div>
                    <div class="form-group">
                        <label for="norek">No. Rek<span class="text-danger">*</span></label>
                        <input type="text" name="norek" data-parsley-trigger="change" required placeholder="No. Rekening" class="form-control" id="norek">
                    </div>
                    <div class="form-group">
                        <label for="an">Nama Pemilik<span class="text-danger">*</span></label>
                        <input id="an" name="an" type="text" placeholder="An." required class="form-control">
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