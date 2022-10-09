<?php
if ($_POST != NULL) {
	$supply = $_POST['supply'];
	$demand = $_POST['demand'];
}

if ($supply > 5 && $demand > 5) {
	include "./template/header.php";
	echo '<div class="alert alert-danger text-center m-3">Demand atau Supply tidak boleh lebih dari 5!</div>';
	echo '<a class="btn btn-info btn-md d-flex justify-content-center m-3" href="index.php" role="button">Kembali Ke Halaman Utama</a>';
} else if ($supply == NULL && $demand == NULL) {
	include "./template/header.php";
	echo '<div class="alert alert-danger text-center m-3">Demand atau Supply tidak boleh kosong!</div>';
	echo '<a class="btn btn-info btn-md d-flex justify-content-center m-3" href="index.php" role="button">Kembali Ke Halaman Utama</a>';
}else {
	include "./template/header.php";
	include "./content/tableInput.php";
	include "./template/footer.php";
}
?>