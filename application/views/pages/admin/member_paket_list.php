<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
        <div class="card mb-3">
            <div class="card-header">
                <h3>Member paket</h3>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Paket</th>
                                <th>Payout</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($pakets as $pkt) :
                            ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $pkt->nama_paket ?></td>
                                    <td>
                                        <?php
                                        $this->load->model('model_payout');
                                        $json = json_decode($pkt->payout_id, true);

                                        $data = $this->model_payout->get_where_in($json);
                                        $ass = json_encode($data, true);
                                        //print_r(var_dump($ass));

                                        for ($j = 0; $j < count($data); $j++) {
                                            echo $data[$j]->nama_payout . "<br/>";
                                        }
                                        ?>
                                    </td>
                                    <td><?= $pkt->is_active ?></td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>

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