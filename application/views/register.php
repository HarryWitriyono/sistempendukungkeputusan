<div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                 <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Input Pengguna Baru</h1>
                            </div>
                            <?php echo validation_errors(); ?>

                            <form class="user" method="post" action="pengguna/simpanrekordbaru">
                                <div class="form-group">
                                 <input type="text" name="idpengguna" class="form-control form-control-user" id="exampleFirstName" 
                                 value="<?php echo set_value('idpengguna'); ?>"
                                 placeholder="First Name">
                                </div>
                                <div class="form-group">
                                 <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                 <input type="password" name="konfirmasipassword" class="form-control form-control-user"
                                 id="exampleRepeatPassword" placeholder="Ulangi ketik Passwordnya">
                                </div>
                                <input type="submit" name="bSimpan" value="Simpan Pengguna Baru" class="btn btn-primary btn-user btn-block">
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
                    <h1 class="h3 mb-2 text-gray-800">Table Pengguna</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id Pengguna</th>
                                            <th>Password</th>
                                            <th>Koreksi/Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody><?php foreach ($itempengguna as $row): ?>
                                        <tr>
                                            <td><?php echo $row['idpengguna']; ?></td>
                                            <td><?php echo $row['password']; ?></td>
                                            <td><a href="pengguna/koreksi/<?php echo $row['idpengguna']; ?>" class="btn btn-primary btn-user btn-block">Koreksi</a>
                                                <a href="pengguna/hapus/<?php echo $row['idpengguna']; ?>" 
                                                onclick="return(confirm('Apakah yakin akan menghapus rekord ini ?'))"
                                                class="btn btn-danger btn-user btn-block">Hapus</a>
                                            </td>
                                        </tr><?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id Pengguna</th>
                                            <th>Password</th>
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
