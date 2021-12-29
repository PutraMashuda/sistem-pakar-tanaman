<?php
$link_data='?page=b_pengetahuan';
$link_update='?page=update_b_pengetahuan';

$combo_id_diagnosa='';
$combo_id_diagnosa.='<select class="selectpicker form-control" data-live-search="true" name="id_diagnosa" id="id_diagnosa" required><option value="">Pilih...</option>';
$q="select * from diagnosa order by id_diagnosa";
$q=mysqli_query($con,$q);
while($r=mysqli_fetch_array($q)){
	$combo_id_diagnosa.='<option value="'.$r['id_diagnosa'].'" data-tokens="'.$r['nama_diagnosa'].'">'.$r['kode_diagnosa'].' - '.$r['nama_diagnosa'].'</option>';
}
$combo_id_diagnosa.='</select>';
$combo_id_gejala='';
$combo_id_gejala.='<select class="selectpicker form-control" data-live-search="true" name="id_gejala" id="id_gejala" required><option value="">Pilih...</option>';
$q="select * from gejala order by id_gejala";
$q=mysqli_query($con,$q);
while($r=mysqli_fetch_array($q)){
	$combo_id_gejala.='<option value="'.$r['id_gejala'].'" data-tokens="'.$r['nama_gejala'].'">'.$r['kode_gejala'].' - '.$r['nama_gejala'].'</option>';
}
$combo_id_gejala.='</select>';
$mb='';
$md='';

if(isset($_POST['save'])){
	$error='';
	$id=$_POST['id'];
	$action=$_POST['action'];
	$id_diagnosa=$_POST['id_diagnosa'];
	$id_gejala=$_POST['id_gejala'];
	$mb=$_POST['mb'];
	$md=$_POST['md'];

	if(empty($error)){
		if($action=='add'){
			$q="insert into b_pengetahuan(id_diagnosa,id_gejala,mb,md) values ('".$id_diagnosa."','".$id_gejala."','".$mb."','".$md."')";
			mysqli_query($con,$q);
			exit("<script>location.href='".$link_data."';</script>");
		}
		if($action=='edit'){
			$q="update b_pengetahuan set id_diagnosa='".$id_diagnosa."',id_gejala='".$id_gejala."',mb='".$mb."',md='".$md."' where id_b_pengetahuan='".$id."'";
			mysqli_query($con,$q);
			exit("<script>location.href='".$link_data."';</script>");
		}
	}
}else{
	if(empty($_GET['action'])){$action='add';}else{$action=$_GET['action'];}
	if($action=='edit'){
		$id=$_GET['id'];
		$q=mysqli_query($con,"select * from b_pengetahuan where id_b_pengetahuan='".$id."'");
		$r=mysqli_fetch_array($q);
		$combo_id_diagnosa='';
		$combo_id_diagnosa.='<select class="selectpicker form-control" data-live-search="true" name="id_diagnosa" id="id_diagnosa" required><option value="">Pilih...</option>';
		$qcmb="select * from diagnosa order by id_diagnosa";
		$qcmb=mysqli_query($con,$qcmb);
		while($rcmb=mysqli_fetch_array($qcmb)){
			if($rcmb['id_diagnosa']==$r['id_diagnosa']) { $selected = "selected"; } else { $selected = ""; }
			$combo_id_diagnosa.='<option value="'.$rcmb['id_diagnosa'].'" data-tokens="'.$rcmb['nama_diagnosa'].'" '.$selected.'>'.$rcmb['kode_diagnosa'].' - '.$rcmb['nama_diagnosa'].'</option>';
		}
		$combo_id_diagnosa.='</select>';
		$combo_id_gejala='';
		$combo_id_gejala.='<select class="selectpicker form-control" data-live-search="true" name="id_gejala" id="id_gejala" required><option value="">Pilih...</option>';
		$qcmb="select * from gejala order by id_gejala";
		$qcmb=mysqli_query($con,$qcmb);
		while($rcmb=mysqli_fetch_array($qcmb)){
			if($rcmb['id_gejala']==$r['id_gejala']) { $selected = "selected"; } else { $selected = ""; }
			$combo_id_gejala.='<option value="'.$rcmb['id_gejala'].'" data-tokens="'.$rcmb['nama_gejala'].'" '.$selected.'>'.$rcmb['kode_gejala'].' - '.$rcmb['nama_gejala'].'</option>';
		}
		$combo_id_gejala.='</select>';
		$mb=$r['mb'];
		$md=$r['md'];
	}
	if($action=='delete'){
		$id=$_GET['id'];
		mysqli_query($con,"delete from b_pengetahuan where id_b_pengetahuan='".$id."'");
		exit("<script>location.href='".$link_data."';</script>");
	}
}
?>
<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title">Data Basis Pengetahuan</h3>
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
				<label for="id_diagnosa" class="col-sm-2 control-label">Kode Diagnosa</label>
				<div class="col-sm-4">
					<?php echo $combo_id_diagnosa; ?>
				</div>
			</div>
			<div class="form-group">
				<label for="id_gejala" class="col-sm-2 control-label">Kode Gejala</label>
				<div class="col-sm-4">
					<?php echo $combo_id_gejala; ?>
				</div>
			</div>
			<div class="form-group">
				<label for="mb" class="col-sm-2 control-label">MB</label>
				<div class="col-sm-4">
					<input name="mb" id="mb" required type="number" step="0.01" min="0" class="form-control" value="<?php echo $mb;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="md" class="col-sm-2 control-label">MD</label>
				<div class="col-sm-4">
					<input name="md" id="md" required type="number" step="0.01" min="0" class="form-control" value="<?php echo $md;?>">
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