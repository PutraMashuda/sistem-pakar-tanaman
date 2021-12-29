<?php
if (isset($_POST['proses'])){

$link_konsultasi='?page=konsultasi';
$jml_nol_koma=3; //jumlah angka dibelakang koma
$hasil = array();
$x=0;
$base_domain="http://localhost/cf"; //base domain untuk keperluan load CSS cetak hasil konsultasi

// -------- perhitungan metode certainty factor (CF) ---------
// --------------------- START ------------------------
$sqldiagnosa = mysqli_query($con, "SELECT * FROM diagnosa order by id_diagnosa");
while ($rdiagnosa = mysqli_fetch_array($sqldiagnosa)) {
	$id_diagnosa = $rdiagnosa['id_diagnosa'];
	$cf_old = 0;
	$cf = 0;
	$sql = mysqli_query($con, "SELECT * FROM b_pengetahuan where id_diagnosa=" . $id_diagnosa);
	while ($rgejala = mysqli_fetch_array($sql)) {
		for ($i = 0; $i < count($_POST['gejala']); $i++) {
			$gejala = $_POST['gejala'][$i];
			if ($rgejala['id_gejala'] == $gejala) {
				$cf = $rgejala['mb'] - $rgejala['md'];
				if ($i > 0) {
					$cf_old = $cf_old + $cf * (1 - $cf_old);
				} else {
					$cf_old = $cf;
				}
			}
		}
	}
	$hasil[$x]["id_diagnosa"] = $id_diagnosa;
	$hasil[$x]["nilai"] = $cf_old * 100;
	$x++;
}
// --------------------- END -------------------------

// fungsi untuk mengurutkan nilai berdasarkan nilai terbesar
function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }
    array_multisort($sort_col, $dir, $arr);
}
array_sort_by_column($hasil, 'nilai');

//tampilkan hasil kedalam tabel
$no=0;
$list_rekomendasi='';
$tbl_penanganan='';
foreach($hasil as $arr){
	$no++;
	$rdiagnosa=mysqli_fetch_array(mysqli_query($con,"select * from diagnosa where id_diagnosa='".$arr['id_diagnosa']."'"));
	if($arr['nilai']!=0){
		$list_rekomendasi.='
		<tr>
			<td>'.$no.'</td>
			<td>'.$rdiagnosa['nama_diagnosa'].'</td>
			<td>'.round($arr['nilai'],$jml_nol_koma).' %</td>
		</tr>
		';
	}
	if($tbl_penanganan==''){
		$tbl_penanganan.='
		<tr>
			<td width="120">Hasil Diagnosa</td>
			<td><strong>'.$rdiagnosa['kode_diagnosa'].' - '.$rdiagnosa['nama_diagnosa'].'</strong></td>
		</tr>
		<tr>
			<td>Penanganan</td>
			<td style="white-space: pre-wrap; word-wrap: break-word;">'.$rdiagnosa['keterangan'].'</td>
		</tr>
		';
	}
}

//tabel gejala yang dipilih
$list_data='';
for ($i=0; $i<count($_POST['gejala']);$i++) {
	$no=$i+1;
	$id_gejala = $_POST['gejala'][$i];
	$rgejala=mysqli_fetch_array(mysqli_query($con, "SELECT kode_gejala,nama_gejala FROM gejala where id_gejala = ".$id_gejala));
	$list_data.='
	<tr>
		<td>'.$no.'</td>
		<td>'.$rgejala['kode_gejala'].' - '.$rgejala['nama_gejala'].'</td>
	</tr>
	';
}
?>
<script type="text/javascript">
    $(document).ready(function() {
		$('#btnCetak').on("click", function () {
			$(".cetak").printThis({
				loadCSS: "<?php echo $base_domain; ?>/assets/css/bootstrap.min.css",
				importStyle: true
			});
		});
	});
</script>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title cetak">Hasil Konsultasi</h3>
    </div>
    <div class="box-body">
		<div class='table-responsive'>
			<table class='table table-striped table-bordered cetak'>
				<thead>
					<tr>
						<th width="40">No</th>
						<th>Gejala yang dipiilh</th>
					</tr>
				</thead>
				<tbody>
					<?php echo $list_data;?>
				</tbody>
			</table>
		</div>
		<h3 class="page-header cetak">Hasil Penilaian</h3>
		<div class='table-responsive'>
			<table class='table table-bordered table-striped cetak'>
				<thead>
					<tr>
						<th width="40">No</th>
						<th>Diagnosa</th>
						<th>Nilai</th>
					</tr>
				</thead>
				<tbody>
					<?php echo $list_rekomendasi;?>
				</tbody>
			</table>
		</div>
		<div class='table-responsive'>
			<table class='table table-bordered cetak'>
				<tbody>
					<?php echo $tbl_penanganan;?>
				</tbody>
			</table>
		</div>
    </div>
	<div class="box-footer">
		<div class="text-center col-sm-12">
			<a href="<?php echo $link_konsultasi; ?>" class="btn btn-danger">Ulangi Konsultasi</a> &nbsp;
			<a id="btnCetak" href="#" class="btn btn-success">Cetak</a>
		</div>
	</div>
</div>
<?php } ?>