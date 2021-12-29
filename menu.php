<?php
$page='';
if(isset($_GET['page'])){
	$page=$_GET['page'];
}
?>
<li <?php if($page=="") echo 'class="active"'; ?>><a href="./"><i class="fa fa-circle"></i> <span>Beranda</span></a></li>
<li <?php if($page=="gejala" || $page=="update_gejala") echo 'class="active"'; ?>><a href="?page=gejala"><i class="fa fa-circle"></i> <span>Gejala</span></a></li>
<li <?php if($page=="diagnosa" || $page=="update_diagnosa" || $page=="lihat_diagnosa") echo 'class="active"'; ?>><a href="?page=diagnosa"><i class="fa fa-circle"></i> <span>Diagnosa</span></a></li>
<li <?php if($page=="b_pengetahuan" || $page=="update_b_pengetahuan") echo 'class="active"'; ?>><a href="?page=b_pengetahuan"><i class="fa fa-circle"></i> <span>Basis Pengetahuan</span></a></li>
<li <?php if($page=="konsultasi" || $page=="proses_konsultasi") echo 'class="active"'; ?>><a href="?page=konsultasi"><i class="fa fa-circle"></i> <span>Konsultasi</span></a></li>
<li <?php if($page=="admin" || $page=="update_admin") echo 'class="active"'; ?>><a href="?page=admin"><i class="fa fa-circle"></i> <span>Admin</span></a></li>
<li <?php if($page=="password") echo 'class="active"'; ?>><a href="?page=password"><i class="fa fa-circle"></i> <span>Ubah Password</span></a></li>
<li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>