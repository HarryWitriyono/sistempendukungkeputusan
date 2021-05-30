<div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                 <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Koreksi Kriteria</h1>
                            </div>
                            <form class="user" method="post" action="kriteria/simpanrekordkoreksi">
                                <div class="form-group">
                                 <input type="hidden" name="idkriteria" value="<?php echo $itemkriteria['idkriteria'];?>" required>
                                 <?php echo validation_errors(); ?>
                                 <input type="text" name="namakriteria" class="form-control form-control-user" id="exampleFirstName" 
                                  placeholder="Ketik nama kriteria" 
                                  value="<?php echo $itemkriteria['namakriteria'];?>"
                                  required>
                                </div>
                                <input type="submit" name="bSimpan" value="Simpan Hasil Koreksi" class="btn btn-primary btn-user btn-block">
                                <hr>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>