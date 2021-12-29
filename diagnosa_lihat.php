<?php
$link_data='?page=diagnosa';

$id=$_GET['id'];
$r=mysqli_fetch_array(mysqli_query($con,"select * from diagnosa where id_diagnosa='".$id."'"));
$kode_diagnosa=$r['kode_diagnosa'];
$nama_diagnosa=$r['nama_diagnosa'];
$keterangan=$r['keterangan'];
?>
<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title">Data Diagnosa</h3>
	</div>
	<form class="form-horizontal">
		<div class="box-body">
			<div class="form-group">
				<label for="kode_diagnosa" class="col-sm-2 control-label">Kode Diagnosa</label>
				<div class="col-sm-4">
					<input name="kode_diagnosa" id="kode_diagnosa" class="form-control" readonly type="text" value="<?php echo $kode_diagnosa;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="nama_diagnosa" class="col-sm-2 control-label">Nama Diagnosa</label>
				<div class="col-sm-4">
					<input name="nama_diagnosa" id="nama_diagnosa" class="form-control" readonly type="text" value="<?php echo $nama_diagnosa;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
				<div class="col-sm-4">
				<textarea name="keterangan" id="keterangan" class="form-control" readonly rows="5"><?php echo $keterangan;?></textarea>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<div class="text-center col-sm-6">
				<a href="<?php echo $link_data;?>" class="btn btn-danger">Kembali</a>
			</div>
		</div>
	</form>
</div>