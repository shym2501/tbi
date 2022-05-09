<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Add New Submenu</a>
            
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($subMenu as $sm) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $sm['title']; ?></td>
                        <td><?= $sm['menu']; ?></td>
                        <td><?= $sm['url']; ?></td>
                        <td><?= $sm['icon']; ?></td>
                        <td><?= $sm['is_active']; ?></td>
                        <td>
                          <a href="" data-toggle="modal" data-target="#modal-edit<?= $sm['id']; ?>" class="btn btn-primary btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-edit mr-2"></i>Edit</a>

                      <?php if ($sm['id'] > 8) { ?>
                        <a href="<?= base_url('menu/hapusSubMenu/') . $sm['id']; ?>" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash mr-2"></i>Delete</a>
                        
                      <?php } else { ?>
                        <a href="" class="btn btn-default btn-sm" data-popup="tooltip" data-placement="top" title="Data Locked"><i class="fas fa-key mr-1"></i>Locked</a>
                      <?php } ?>
                    </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<!-- /#page-wrapper edit-->

<?php $no = 0;

foreach ($subMenu as $sm) : $no++; ?>
  <div class="row">
    <div id="modal-edit<?= $sm['id']; ?>" class="modal fade">
      <div class="modal-dialog">
        <form action="<?= base_url('menu/editSubmenu'); ?>" method="post">
          <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
              <h4 class="modal-title text-white">Edit Data Submenu</h4>
              <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

              <input type="hidden" readonly value="<?= $sm['id']; ?>" name="id" class="form-control">

              <div class="form-group">
                <label class='col-md-3'>Title</label>
                <div class='col-md-12'>
                  <input type="text" name="title" id="title" autocomplete="off" value="<?= $sm['title']; ?>" required placeholder="Masukkan Title" class="form-control">
                </div>
              </div>

              <!-- Pilih Menu yang mana mau ditambahkan submenu baru -->
              <div class="form-group">
                <label class='col-md-3'>Pilih Menu</label>
                <div class='col-md-12'>
                  <select name="menu_id" id="menu_id" class="form-control">
                    <!-- LOOPING isi dari tabel Menu(database) -->
                    <option value="<?= $sm['menu_id']; ?>"><?= $sm['menu']; ?></option>
                    <!-- loopong untuk menampilkan menu apa saja yang ada di menu management -->
                    <?php foreach ($menu as $m) : ?>
                      <option value="<?= $m['id']; ?>">
                        <?= $m['menu']; ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class='col-md-3'>Url</label>
                <div class='col-md-12'><input type="text" name="url" id="url" autocomplete="off" value="<?= $sm['url']; ?>" required placeholder="Masukkan Url" class="form-control"></div>
              </div>

              <div class="form-group">
                <label class='col-md-12'>Icon</label>
                <div class='col-md-9'><input type="text" name="icon" id="icon" autocomplete="off" value="<?= $sm['icon']; ?>" required placeholder="Masukkan Icon" class="form-control"></div>
              </div>

              <!-- untuk cek_aktif pakai cek-box -->
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                  <label class="form-check-label" for="is_active">
                    Aktifkan submenu ini?
                  </label>
                </div>
              </div>
              <br>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-black" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-blue">Ok</button>
            </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!--Konfirmasi Hapus Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-danger text-white">
        <h5 class="modal-title" id="exampleModalLabel">Kamu yakin ingin menghapus Submenu "<?= $sm['title']?>" ?</h5>
        <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true text-white">×</span>
        </button>
      </div>
      <div class="modal-body">Pilih 'Delete' untuk melanjutkan.</div>
      <div class="modal-footer">
        <button class="btn btn-black" type="button" data-dismiss="modal">Batal</button>
        <a class="btn btn-danger" href="<?= base_url('menu/hapusSubMenu/') . $sm['id']; ?>">Delete</a>
      </div>
    </div>
  </div>
</div>
<!-- AKHIR MODAL -->