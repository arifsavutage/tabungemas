<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3>Tambah Hadiah</h3>
            </div>
            <div class="card-body">
                <form name="addhadiah" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" maxlength="100" name="judul" value="" required />
                    </div>
                    <div class="form-group">
                        <label>Jumlah Poin</label>
                        <input type="number" class="form-control" name="jmlpoin" min="1" value="" required />
                    </div>
                    <div class="form-group">
                        <label>Keterangan Hadiah</label>
                        <textarea name="ket" class="form-control editor" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" class="form-control" name="gambar" value="" />
                        <small class="form-text text-danger">Dimensi maks 500 x 500 pixel</small>
                    </div>
                    <div class="form-group">
                        <a href="<?= base_url('index.php/pengaturan/hadiah_reward_poin'); ?>" class="btn btn-secondary">Batal</a>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>