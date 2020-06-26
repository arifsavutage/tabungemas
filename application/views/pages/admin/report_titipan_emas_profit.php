<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
        <div class="card mb-3">
            <div class="card-header">
                <h3>Laporan Profit Titipan Emas</h3>
            </div>
            <div class="card-body">
                <form name="report" action="" method="post" data-parsley-validate novalidate>
                    <div class="form-row mb-4">
                        <div class="col">
                            <label for="bulan">Bulan <span class="text-danger">*</span></label>
                            <select name="bulan" class="form-control" data-parsley-trigger="change" required>
                                <option value="">: Pilih</option>
                                <?php
                                $bln    = [
                                    '01'    => 'Januari',
                                    '02'    => 'Februari',
                                    '03'    => 'Maret',
                                    '04'    => 'April',
                                    '05'    => 'Mei',
                                    '06'    => 'Juni',
                                    '07'    => 'Juli',
                                    '08'    => 'Agustus',
                                    '09'    => 'September',
                                    '10'    => 'Oktober',
                                    '11'    => 'November',
                                    '12'    => 'Desember'
                                ];
                                foreach ($bln as $key => $value) {
                                    echo "<option value='$key'>$value</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="tahun">Tahun<span class="text-danger">*</span></label>
                            <?php $tahun = date('Y'); ?>
                            <input type="text" name="tahun" value="<?= $tahun; ?>" data-parsley-trigger="change" required placeholder="yyyy" class="form-control" id="tahun">

                        </div>
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