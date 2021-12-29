<?php
$link_data='?page=diagnosa';
$link_update='?page=update_diagnosa';

$kode_diagnosa='';
$nama_diagnosa='';
$keterangan='';

if(isset($_POST['save'])){
	$error='';
	$id=$_POST['id'];
	$action=$_POST['action'];
	$kode_diagnosa=$_POST['kode_diagnosa'];
	$nama_diagnosa=$_POST['nama_diagnosa'];
	$keterangan=$_POST['keterangan'];

	if(empty($error)){
		if($action=='add'){
			if(mysqli_num_rows(mysqli_query($con,"select * from diagnosa where kode_diagnosa='".$kode_diagnosa."'"))>0){
				$error='Kode Diagnosa sudah ada';
			}else{
				$q="insert into diagnosa(kode_diagnosa,nama_diagnosa,keterangan) values ('".$kode_diagnosa."','".$nama_diagnosa."','".$keterangan."')";
				mysqli_query($con,$q);
				exit("<script>location.href='".$link_data."';</script>");
			}
		}
		if($action=='edit'){
			$q=mysqli_query($con,"select * from diagnosa where id_diagnosa='".$id."'");
			$r=mysqli_fetch_array($q);
			$kode_diagnosa_tmp=$r['kode_diagnosa'];
			if(mysqli_num_rows(mysqli_query($con,"select * from diagnosa where kode_diagnosa='".$kode_diagnosa."' and kode_diagnosa<>'".$kode_diagnosa_tmp."'"))>0){
				$error='Kode Diagnosa sudah ada';
			}else{
				$q="update diagnosa set kode_diagnosa='".$kode_diagnosa."',nama_diagnosa='".$nama_diagnosa."',keterangan='".$keterangan."' where id_diagnosa='".$id."'";
				mysqli_query($con,$q);
				exit("<script>location.href='".$link_data."';</script>");
			}
		}
	}
}else{
	if(empty($_GET['action'])){$action='add';}else{$action=$_GET['action'];}
	if($action=='edit'){
		$id=$_GET['id'];
		$q=mysqli_query($con,"select * from diagnosa where id_diagnosa='".$id."'");
		$r=mysqli_fetch_array($q);
		$kode_diagnosa=$r['kode_diagnosa'];
		$nama_diagnosa=$r['nama_diagnosa'];
		$keterangan=$r['keterangan'];
	}
	if($action=='delete'){
		$id=$_GET['id'];
		mysqli_query($con,"delete from diagnosa where id_diagnosa='".$id."'");
		exit("<script>location.href='".$link_data."';</script>");
	}
}
?>
<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title">Data Diagnosa</h3>
	</div>
	<form class="form-horizontal" action="<?php echo $link_update;?>" method="post" >
		<input name="id" type="hidden" value="<?php echo $id;?>">
		<input name="action" type="hidden" value="<?php echo $action;?>">
		<div class="box-body">
		<?php
			if(!empty($error)){
				echo '<div class="alert bg-danger" role="alert">'.$error.'</div>';
			}
		?>
			<div class="form-group">
				<label for="kode_diagnosa" class="col-sm-2 control-label">Kode Diagnosa</label>
				<div class="col-sm-4">
					<input name="kode_diagnosa" id="kode_diagnosa" class="form-control" required type="text" value="<?php echo $kode_diagnosa;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="nama_diagnosa" class="col-sm-2 control-label">Nama Diagnosa</label>
				<div class="col-sm-4">
					<input name="nama_diagnosa" id="nama_diagnosa" class="form-control" required type="text" value="<?php echo $nama_diagnosa;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
				<div class="col-sm-4">
					<textarea name="keterangan" id="keterangan" class="form-control" required rows="5"><?php echo $keterangan;?></textarea>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<div class="text-center col-sm-6">
				<button type="submit" name="save" class="btn btn-success">Simpan</button>
				<a href="<?php echo $link_data;?>" class="btn btn-danger">Batal</a>
			</div>
		</div>
	</form>
</div>