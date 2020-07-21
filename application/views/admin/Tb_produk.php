<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data produk</h1>
          </div>
        </div>
            <!-- ini tombol modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah data produk
                </button>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <!-- alert simpan data -->
					<?php if ($this->session->flashdata('success')):?>
					<div id="pesan" class="alert alert-success" role="alert">
						<strong><?=$this->session->flashdata('success');
						?></strong>
					</div>
					<?php endif;?>
					<!-- aler hapus data -->
					<?php if ($this->session->flashdata('error')):?>
					<div id="pesan" class="alert alert-danger" role="alert">
						<strong><?=$this->session->flashdata('error');
						?></strong>
					</div>
          <?php endif; ?>
          
              <div class="card-body">
             
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode produk</th>
                      <th>Nama produk</th>
                      <th>Harga produk</th>
                      <th>Kategori</th>
                      <th>Stok</th>
                      <th>Image</th>
                      <th>Tanggal Input</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $no= 1;
                      foreach ($produk as $key => $value) :?>
                  <tr>
                    <td><?=$no++;?></td>
                    <td><?=$value['kode_produk'];?></td>
                    <td><?=$value['nama_produk'];?></td>
                    <td><?="Rp. ".number_format( $value['harga_produk']);?></td>
                    <td><?=$value['kategori'];?></td>
                    <td><?=$value['stok_produk'];?></td>
                    <td><img style="width: 100px;height: 100px; border-radius:50%" src="<?=base_url();?>assets/images/<?=$value['image'];?>"></td>
                    <td><?=$value['tanggal'];?></td>
                    
                    <td>
                      <a href="<?php echo base_url(); ?>c_admin/edit_produk/<?=$value['id_produk']; ?>"
											class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> Edit </a>

                      <a href="<?php echo base_url(); ?>c_admin/delete_produk/<?= $value['id_produk']; ?>"
                      onclick="return confirm('Apakah Anda Ingin Menghapus Data <?=$value['nama_produk'];?>');" class="btn btn-danger btn-xs" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i> Delate</a>  
                    
                    </td>
                  </tr>
                  <?php endforeach;?>
                </tfoot>
             
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal tambah produk-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">

				<h5 class="modal-title" id="exampleModalLabel">Tambah Data produk</h5>

			</div>
			<div class="modal-body">

				<form action="<?=base_url();?>c_admin/save_produk" method="POST"	enctype="multipart/form-data">

        <div class="form-group">
						<label for="exampleInputEmail1">Kode produk</label>
						<input type readonly="text" name="kode_produk" id="kode_produk"  class="form-control" value="<?=$kode_otomatis;?>">

					</div>
      
      		<div class="form-group">
						<label for="exampleInputEmail1">Nama produk</label>
						<input type="text" name="nama_produk" id="nama_produk" class="form-control" placeholder="Input nama produk" required>

					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Harga produk</label>
						<input type="text" name="harga_produk" id="harga_produk" class="form-control"
							placeholder="Input harga produk" required>
					</div>

					<div class="form-group">
						<label for="exampleInputPassword1">Stok</label>
						<input type="text" name="stok_produk" id="stok_produk" class="form-control" placeholder="Input stok produk"
							required>
          </div>
          
          <div class="form-group">
          <label>Kategori</label>
									<select name="kategori" class="form-control">
										<option value="0">--pilih--</option>
                    <option value="makanan">Makanan</option>
                    <option value="minuman">Minuman</option>
									</select>
          </div>
          
          <div class="form-group">
						<label for="exampleInputPassword1">Image</label>
						<input type="file" name="image" id="image" class="form-control"	required>
					</div>

				   <!-- Date -->
           <div class="form-group">
                  <label>Tanggal</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input"required data-target="#reservationdate"/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <!-- /.form group -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
			</form>
		</div>
	</div>
</div>