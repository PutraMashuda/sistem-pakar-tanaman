<?php
switch($page){
	case 'gejala':
		include "gejala.php";
		break;
	case 'update_gejala':
		include "gejala_update.php";
		break;
	case 'admin':
		include "admin.php";
		break;
	case 'update_admin':
		include "admin_update.php";
		break;
	case 'diagnosa':
		include "diagnosa.php";
		break;
	case 'update_diagnosa':
		include "diagnosa_update.php";
		break;
	case 'lihat_diagnosa':
		include "diagnosa_lihat.php";
		break;
	case 'b_pengetahuan':
		include "b_pengetahuan.php";
		break;
	case 'update_b_pengetahuan':
		include "b_pengetahuan_update.php";
		break;
	case 'konsultasi':
		include "konsultasi.php";
		break;
	case 'proses_konsultasi':
		include "konsultasi_proses.php";
		break;
	case 'password':
		include "password.php";
		break;

	default:
		include "beranda.php";
		break;
}
?>