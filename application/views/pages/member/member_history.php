<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-8 offset-lg-2 col-xl-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <h4>History</h4>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Uang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Emas</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered" id="examples">
                                <thead>
                                    <tr>
                                        <th>Tgl.</th>
                                        <th>Keterangan</th>
                                        <th>Masuk</th>
                                        <th>Keluar</th>
                                        <th>Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($history_uang as $row) :
                                        ?>
                                        <tr>
                                            <td><?= $row['tgl']; ?></td>
                                            <td><?= $row['uraian']; ?></td>
                                            <td><?= "Rp. " . number_format($row['masuk'], 0, ',', '.'); ?></td>
                                            <td><?= "Rp. " . number_format($row['keluar'], 0, ',', '.'); ?></td>
                                            <td><?= "Rp. " . number_format($row['saldo'], 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered" id="examples2">
                                <thead>
                                    <tr>
                                        <th>Tgl.</th>
                                        <th>Keterangan</th>
                                        <th>Masuk</th>
                                        <th>Keluar</th>
                                        <th>Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($history_emas as $list) :
                                        ?>
                                        <tr>
                                            <td><?= $list['tgl']; ?></td>
                                            <td><?= $list['uraian']; ?></td>
                                            <td><?= $list['masuk']; ?> .gr</td>
                                            <td><?= $list['keluar']; ?> .gr</td>
                                            <td><?= $list['saldo']; ?> .gr</td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>