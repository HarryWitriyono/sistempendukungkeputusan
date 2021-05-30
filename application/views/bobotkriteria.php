<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Input Bobot Harapan Kriteria</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Input Bobot Harapan Kriteria</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
			  <form method="post" action="<?php echo base_url();?>kriteria/bobotharapan">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <?php foreach ($itemkriteria as $r) : ?>
                                <th><?php echo $r['namakriteria']; ?></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>Jenis dan Bobot Nilai Harapan</td>
								<?php foreach ($itemkriteria as $ra) : ?>
                                    <td>
									<input type="hidden" value="<?php echo $ra['idkriteria'];?>" name="idkriteria[]">
									<select name="jeniskriteria[]" required>
									 <option value="1" <?php if ($ra['jeniskriteria']=='1') echo 'Selected';?>>Cost</option>
									 <option value="2" <?php if ($ra['jeniskriteria']=='2') echo 'Selected';?>>Benefit</option>
									</select>
									<input type="text" value="<?php echo $ra['bobotpreferensi'];?>" name="bobotharapan[]">
                                    </td>
								<?php endforeach; ?>	
                            </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                                <th colspan=3>
								<input type="submit" value="Simpan Nilai Bobot Harapan" name="bSimpanBobot">
								</th>
                        </tr>
                    </tfoot>
                </table>
			  </form>
            </div>
        </div>
    </div>
</div><!-- /.container-fluid -->