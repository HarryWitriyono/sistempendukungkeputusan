<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Matrix Normalisasi</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Matrix Normalisasi</h6>
			<a href="<?= base_url();?>Saw/csv" target="_blank" class="btn btn-primary">To CSV</a>
			<a href="<?= base_url();?>Saw/xml" target="_blank" class="btn btn-primary">To XML</a>
			<a href="<?= base_url();?>Saw/json" target="_blank" class="btn btn-primary">To JSON</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Atribut</th>
                            <?php foreach ($pilidkriteria as $r) : ?>
                                <th><?php echo $r['namakriteria']; ?></th>
                            <?php endforeach ?>
							<th>Nilai Preferensi Atribut</th>
                        </tr>
                    </thead>

                    <tbody><?php $v=0;
					            foreach ($pilidatribut as $ra) : ?>
                            <tr>
                                <td><?php echo $ra['namaatribut']; ?></td>
                                <?php foreach ($pilidkriteria as $rk) : ?>
                                    <td><?php foreach ($itemratingkecocokan as $ir) :
                                            if (($ir['idatribute'] == $ra['idatribute'])
											and ($ir['idkriteria'] == $rk['idkriteria'])) {
                                                echo $ir['nilainormalisasi'].' v= '.$ir['bobotnormalisasi']; 
												$v=$v+$ir['bobotnormalisasi']; 
											}
                                        endforeach; ?>
                                    </td>
                                <?php endforeach; ?>
								<td><?php echo $v;$v=0;?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Atribut</th>
                            <?php foreach ($pilidkriteria as $r) : ?>
                                <th><?php echo $r['namakriteria']; ?></th>
                            <?php endforeach ?>
							<th>Nilai Preferensi Atribut</th>
                        </tr>
                    </tfoot>
                </table>
				Dengan demikain urutan rangking rekomendasi adalah : <br>
                <?php $nmr=1;
				foreach ($rangking as $rank) { 
				echo $nmr++.'. '.$rank['namaatribut'].' dengan Nilai Preferensi = '
				.$rank['nilaipreferensi'].'<br>';
				};
				?>
            </div>
        </div>
    </div>
</div><!-- /.container-fluid -->