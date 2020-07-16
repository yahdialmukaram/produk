

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Data </h1>
          </div>
     
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Edit Data Produk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                  <form action="<?=base_url();?>c_admin/update/<?=$edit['id_produk'];?>" method="POST" enctype="multipart/form-data">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Produk</label>
                    <input type="text" name="nama_produk" value="<?=$edit['nama_produk'];?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Harga Produk</label>
                    <input type="text" name="harga_produk" value="<?=$edit['harga_produk'];?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">kategori Produk</label>
                    <input type="text" name="kategori" value="<?=$edit['kategori'];?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Stok</label>
                    <input type="text" name="stok_produk" value="<?=$edit['stok_produk'];?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>

               
                   <div class="form-group">
                    <label for="exampleInputFile">File Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" value="<?=$edit['image'];?>" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
            
                    </div>
                  </div> 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="<?=base_url();?>c_admin/tb_produk" class="btn btn-secondary btn-sm">Back</a>
                  <button type="submit" class="btn btn-primary btn-sm fa fa-save"> Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
 
