<div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                 <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Input Kriteria Baru</h1>
                            </div>
							<form class="user" method="post" action="kriteria/simpanrekordbaru">
                                <div class="form-group">
                                 <?php echo validation_errors(); ?>
                                 <input type="text" name="namakriteria" class="form-control form-control-user" id="exampleFirstName" 
                                  placeholder="Ketik nama kriteria" required>
                                </div>
                                <input type="submit" name="bSimpan" value="Simpan Rekord Baru" class="btn btn-primary btn-user btn-block">
                                <hr>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tabel Kriteria</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Tabel Kriteria</h6>
							<a href="<?= base_url();?>Kriteria/uploadfilejson" class="btn btn-primary">
							Import from JSON File</a>
							<a href="<?= base_url();?>Kriteria/json"class="btn btn-primary">
							To JSON</a>
							<a href="<?= base_url();?>Kriteria/uploadfilecsv" class="btn btn-primary">
							Import from CSV File</a>
							<a href="<?= base_url();?>Kriteria/csv"class="btn btn-primary">
							To CSV</a>
							<a href="<?= base_url();?>Kriteria/hapusall" class="btn btn-danger"
							onclick="return(confirm('Apakah yakin akan menghapus semua rekord kriteria ?'))">
							Hapus Semua Rekord</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id Kriteria</th>
                                            <th>Nama Kriteria</th>
                                            <th>Koreksi/Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody><?php foreach ($itemkriteria as $row): ?>
                                        <tr>
                                            <td><?php echo $row['idkriteria']; ?></td>
                                            <td><?php echo $row['namakriteria']; ?></td>
                                            <td><a href="kriteria/koreksi/<?php echo $row['idkriteria']; ?>" class="btn btn-primary btn-user btn-block">Koreksi</a>
                                                <a href="kriteria/hapus/<?php echo $row['idkriteria']; ?>" 
                                                onclick="return(confirm('Apakah yakin akan menghapus rekord terpilih ?'))"
                                                class="btn btn-danger btn-user btn-block">Hapus</a>
                                            </td>
                                        </tr><?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                           <th>Id Kriteria</th>
                                            <th>Nama Kriteria</th>
                                            <th>Koreksi/Hapus</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
