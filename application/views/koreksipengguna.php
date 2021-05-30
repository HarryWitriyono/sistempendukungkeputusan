<div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                 <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Koreksi Pengguna</h1>
                            </div>
                            <form class="user" method="post" action="pengguna/simpanrekordbaru">
                                <div class="form-group">
                                Nama Pengguna : <?php echo $itempengguna['idpengguna'];?>
                                 <input type="text" name="idpengguna" class="form-control form-control-user" id="exampleFirstName" 
                                 value="<?php echo $itempengguna['idpengguna'];?>">
                                </div>
                                <div class="form-group">
                                 <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" 
                                 placeholder="Ketik Password barunya">
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