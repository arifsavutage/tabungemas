<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-6 offset-lg-3 col-xl-6 offset-lg-3">
        <div class="card">
            <div class="card-header">
                <h4>Jual Emas</h4>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="ted-tab" data-toggle="tab" href="#ted" role="tab" aria-controls="ted" aria-selected="true">Jual Ke TED</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="anggota-tab" data-toggle="tab" href="#anggota" role="tab" aria-controls="anggota" aria-selected="false">Jual Ke Anggota</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="ted" role="tabpanel" aria-labelledby="ted-tab">
                        <hr />
                        <form name="jualketed" method="post" action="">
                            <input type="hidden" name="hrgjual" id="hrgjual" value="<?= $jual; ?> " />
                            <input type="hidden" name="tgl" value="<?= date('Y-m-d'); ?> " />
                            <input type="hidden" name="keterangan" value="<?= "jual emas" ?> " />
                            <input type="hidden" name="idted" value="<?= $this->session->userdata('id'); ?> " />
                            <input type="hidden" name="status" value="0" />
                            <input type="hidden" name="tujuan" value="ted" />

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="saldo">Saldo Emas Anda</label>
                                    <input type="text" class="form-control" name="saldo" id="saldo" value="<?= $saldo_emas['saldo']; ?>" placeholder="gr" readonly="true">
                                    <?= form_error('saldo', '<small class="text-danger pl-3">', '</small>'); ?>

                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="gram">Jml Gram Emas Dijual</label>
                                    <input type="text" maxlength="5" class="form-control" name="gram" id="gram" value="" placeholder="gr">
                                    <?= form_error('gram', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="uang">Nominal uang</label>
                                    <input type="text" class="form-control" name="uang" id="uang" value="" placeholder="1.000" readonly="true">
                                    <?= form_error('uang', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <p>
                                    * minimal penjualan <strong>0,001 gr</strong><br />
                                    ** penjualan emas <strong>Tidak Bisa</strong> di batalkan.<br />
                                    *** pecahan (angka di belakang koma) <strong>menggunakan titik</strong>.
                                </p>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block">Jual Emas</button>

                        </form>
                    </div>
                    <div class="tab-pane fade" id="anggota" role="tabpanel" aria-labelledby="anggota-tab">
                        <hr />
                        <form name="jualkeanggota" method="post" action="">
                            <input type="hidden" name="hrgjual" id="hrgjual" value="<?= $jual; ?> " />
                            <input type="hidden" name="tgl" value="<?= date('Y-m-d'); ?> " />
                            <input type="hidden" name="keterangan" value="<?= "jual emas ke" ?> " />
                            <input type="hidden" name="idted" id="idted" value="<?= $this->session->userdata('id'); ?> " />
                            <input type="hidden" name="status" value="0" />
                            <input type="hidden" name="tujuan" value="anggota" />

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="saldo">Saldo Emas Anda</label>
                                    <input type="text" class="form-control" name="saldo" id="saldo" value="<?= $saldo_emas['saldo']; ?>" placeholder="gr" readonly="true">
                                    <?= form_error('saldo', '<small class="text-danger pl-3">', '</small>'); ?>

                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="gram">Jumlah Gram</label>
                                    <input type="text" maxlength="5" class="form-control" name="gram" id="gram" value="" placeholder="gr">
                                    <?= form_error('gram', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="hrgpergram">Harga per gram</label>
                                    <input type="text" class="form-control" name="hrgpergram" id="hrgpergram" value="" placeholder="Rp">
                                    <?= form_error('hrgpergram', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>

                            <span class="d-block p-2 bg-dark text-white">
                                <h6>Data Pembeli</h6>
                            </span><br />

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="idtujuan">Id Anggota</label>
                                    <input type="text" class="form-control" name="idtujuan" id="idtujuan" placeholder="" maxlength="8" />
                                    <?= form_error('idtujuan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="namatujuan">Nama Anggota</label>
                                    <input type="text" class="form-control" name="namatujuan" readonly="true" id="namatujuan" placeholder="" />
                                    <?= form_error('namatujuan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>No. Telp</label>
                                    <input type="text" id="hp" class="form-control" readonly="true" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input type="text" id="email" class="form-control" readonly="true" />
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Alamat</label>
                                    <textarea id="alamat" class="form-control" readonly="true"></textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12 text-center">
                                    <label>Foto</label>
                                    <div id="imgid"></div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <hr />
                                    <p>
                                        * minimal penjualan <strong>0,001 gr</strong><br />
                                        ** penjualan emas <strong>Tidak Bisa</strong> di batalkan.<br />
                                        *** pecahan (angka di belakang koma) <strong>menggunakan titik</strong>.
                                    </p>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block">Jual Emas</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>