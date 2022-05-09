<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>
            
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $m['menu']; ?></td>
                        <td>
                            <a href="" data-toggle="modal" data-target="#modal-edit<?= $m['id']; ?>" class="btn btn-primary btn-sm" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-edit mr-2"></i>Edit</a>
                            <?php if ($m['id'] > 3) { ?>
                            
                      <a href="<?= base_url('menu/hapusMenu/') . $m['id']; ?>" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash mr-2"></i>Delete</a>

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
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
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

<?php $no = 0;
foreach ($menu as $m) : $no++; ?>
  <div class="row">
    <div id="modal-edit<?= $m['id']; ?>" class="modal fade">
      <div class="modal-dialog">
        <form action="<?= base_url('menu/editMenu'); ?>" method="post">
          <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
              <h4 class="modal-title text-white">Edit Data Menu</h4>
              <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

              <input type="hidden" readonly value="<?= $m['id']; ?>" name="id" class="form-control">

              <div class="form-group">
                <label class='col-md-3'>Judul</label>
                <div class='col-md-9'><input type="text" name="menu" autocomplete="off" value="<?= $m['menu']; ?>" required placeholder="Masukkan Modal" class="form-control"></div>
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
        <h5 class="modal-title" id="exampleModalLabel">Kamu yakin ingin menghapus Menu "<?= $m['menu']?>" ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">×</span>
        </button>
      </div>
      <div class="modal-body">Pilih 'Delete' untuk melanjutkan.</div>
      <div class="modal-footer">
        <button class="btn btn-black" type="button" data-dismiss="modal">Batal</button>
        <a class="btn btn-danger" href="<?= base_url('menu/hapusMenu/') . $m['id']; ?>">Delete</a>
      </div>
    </div>
  </div>
</div>
<!-- AKHIR MODAL