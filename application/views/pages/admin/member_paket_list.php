<div class="row justify-content-md-center">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
        <div class="card mb-3">
            <div class="card-header">
                <h3>Member paket</h3>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?><br />
                <a href="<?= base_url('index.php/member/paket_create') ?>" class="btn btn-secondary mb-2 mt-1">Tambah Paket</a>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Paket</th>
                                <th>Payout</th>
                                <th>Role Menu</th>
                                <th>Status</th>
                                <th><i class="fas fa-cog"></i></th>
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
                                        echo "<ul>";
                                        for ($j = 0; $j < count($data); $j++) {
                                            echo "<li>" . $data[$j]->nama_payout . "</li>";
                                        }
                                        echo "</ul>";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $this->db->where('id', $pkt->role_id);
                                        $role = $this->db->get('tb_user_role')->row();
                                        ?>
                                        <span class="badge badge-secondary"><?= $role->role_name ?></span>
                                    </td>
                                    <td><?= $pkt->is_active == 0 ? '<span class="badge badge-danger">non active</span>' : '<span class="badge badge-success">active</span>' ?></td>
                                    <td><?= $pkt->is_active == 0 ? '<a href="' . base_url('index.php/member/paket_status/1/' . $pkt->id) . '" class="btn btn-sm btn-success" title="menghidupkan paket">On</a>' : '<a href="' . base_url('index.php/member/paket_status/0/' . $pkt->id) . '" class="btn btn-sm btn-danger" title="mematikan paket">Off</a>' ?></td>
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