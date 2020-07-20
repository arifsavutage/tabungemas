<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Menu Management</h3>
            </div>
            <div class="card-body">
                <?php
                if ($this->session->flashdata('info')) {
                    echo $this->session->flashdata('info');
                }
                ?>
                <form name="menumanagement" class="form-inline" method="post" action="">
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="level" class="sr-only">Level User</label>
                        <select name="level" id="level" class="form-control">
                            <option value="">: Pilih</option>
                            <?php
                            foreach ($role as $level) {
                                echo '<option value=' . $level['id'] . '>' . $level['role_name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Confirm identity</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php
    $i = 1;
    foreach ($access as $menu) :

        if ($menu['url'] == '#' && $menu['parent_menu'] == 0) {
    ?>
            <div class="col-xs-12 col-sm-12 col-md-4 mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                <?= $menu['title']; ?>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
        $i++;
    endforeach;
    ?>
</div>