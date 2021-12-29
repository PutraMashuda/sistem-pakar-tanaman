<?php
$link_data='?page=b_pengetahuan';
$link_update='?page=update_b_pengetahuan';

$list_data='';
$q="select * from b_pengetahuan order by id_b_pengetahuan";
$q=mysqli_query($con,$q);
if(mysqli_num_rows($q) > 0){
	while($r=mysqli_fetch_array($q)){
		$id=$r['id_b_pengetahuan'];
		$r_diagnosa=mysqli_fetch_array(mysqli_query($con,"select kode_diagnosa,nama_diagnosa from diagnosa where id_diagnosa='".$r['id_diagnosa']."'"));
		$r_gejala=mysqli_fetch_array(mysqli_query($con,"select kode_gejala,nama_gejala from gejala where id_gejala='".$r['id_gejala']."'"));
		$list_data.='
		<tr>
		<td></td>
		<td>'.$r_diagnosa['kode_diagnosa'].' - '.$r_diagnosa['nama_diagnosa'].'</td>
		<td>'.$r_gejala['kode_gejala'].' - '.$r_gejala['nama_gejala'].'</td>
		<td>'.$r['mb'].'</td>
		<td>'.$r['md'].'</td>
		<td>
		<a href="'.$link_update.'&amp;id='.$id.'&amp;action=edit" class="btn btn-success btn-xs" title="Ubah">Ubah</a> &nbsp;
		<a href="#" data-href="'.$link_update.'&amp;id='.$id.'&amp;action=delete" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs" title="Hapus">Hapus</a></td>
		</tr>';
	}
}
?>
<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title">Data Basis Pengetahuan</h3>
		<div class="button-right">
			<a href="<?php echo $link_update;?>" class="btn btn-primary">Tambah Basis Pengetahuan</a>
		</div>
	</div>
	<div class="box-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTables1">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Diagnosa</th>
						<th>Kode Gejala</th>
						<th>MB</th>
						<th>MD</th>
						<th width="80">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php echo $list_data;?>
				</tbody>
			</table>
		</div>
	</div>
</div>