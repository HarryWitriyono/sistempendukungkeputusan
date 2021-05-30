<div class="container-fluid">
<?php  if (isset($error)) echo $error;?>
<?php echo form_open_multipart('Kriteria/do_upload/csv');?>
<h2>Upload File CSV Untuk Kriteria</h2>
<input type="file" name="userfile" size="20" />
<br /><br />
<input type="submit" value="upload" />
</form>
</div>
