<?php
include '../ig.php';

$sesi = $ig->cekSesi();
$nama = $ig->getUser($sesi, "nama");
$email = $ig->getUser($sesi, "email");
$bio = $ig->getUser($sesi, "bio");

$komentar = $ig->getUser($sesi, "komentar");
$privat = $ig->getUser($sesi, "privat");
if($komentar == 1 or $privat == 1) {
	$opsiCmt = '
	<option value="1" selected>Nyala</option>
	<option value="0">Mati</option>
	';
}else {
	$opsiCmt = '
	<option value="1">Nyala</option>
	<option value="0" selected>Mati</option>
	';
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Pengaturan | Yaudin</title>
	<link href="fw/build/fw.css" rel="stylesheet">
	<link href="fw/build/font-awesome.min.css" rel="stylesheet">
	<link href="inc/css/style.setting.css" rel="stylesheet">
	<script src="inc/js/jquery-3.1.1.js"></script>
	<script src="inc/js/script.setting.js"></script>
	<style>
		.box { width: 92%; }
	</style>
</head>
<body>

<div class="atas">
	<h1 class="judul rata-tengah">Yaudin</h1>
</div>

<div class="container">
	<div class="bagian" id="umum">
		<div class="wrap">
			<h2>Setelan Umum</h2>
			<form>
				<div class="isi">Nama :</div>
				<input type="text" class="box" id="namaSet" value="<?php echo $nama; ?>">
				<div class="isi">E-Mail :</div>
				<input type="email" class="box" id="mailSet" value="<?php echo $email; ?>">
				<div class="isi">Bio :</div>
				<textarea class="box" id="bioSet"><?php echo $bio; ?></textarea>
				<div class="bag-tombol">
					<button class="tbl biru" id="saveUmum"><i class="fa fa-save"></i> SIMPAN</button>
				</div>
			</form>
		</div>
	</div>
	<div class="bagian" id="secure">
		<div class="wrap">
			<h2>Keamanan</h2>
			<form>
				<input type="hidden" id="sandiLamaHide" value="<?php echo $sandi; ?>">
				<div class="isi">Kata sandi lama :</div>
				<input type="password" class="box" id="pwdLama">
				<div class="isi">Buat sandi baru :</div>
				<input type="password" class="box" id="pwdBaru">
				<div class="isi">Ulangi kata sandi :</div>
				<input type="password" class="box" id="retypePwd">
				<div class="bag-tombol">
					<button class="tbl biru" id="saveSecure"><i class="fa fa-save"></i> UBAH</button>
				</div>
			</form>
		</div>
	</div>
	<div class="bagian" id="privasi">
		<div class="wrap">
			<h2>Privasi</h2>
			<div class="isi bag bag-4" style="margin-top: 22px;">Akun Privat?</div>
			<select class="box" id="akunPrivat" style="width: 40%;" onchange="gantiPrivat()">
				<?php echo $opsiCmt; ?>
			</select>
			<div style="margin-top: 5px;font-size: 15px;margin-bottom: 19px;">
			Hanya akun yang Anda ikuti saja yang dapat melihat kiriman Anda
			</div>
			<div class="isi bag bag-4" style="margin-top: 22px;">Izinkan Komentar?</div>
			<select class="box" id="optComment" style="width: 40%;" onchange="gantiOptComment();">
				<?php echo $opsiCmt; ?>
			</select>
			<div style="opacity: 0.01;">sss</div>
		</div>
	</div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="notif">
	<div class="popup">
		<div class="wrap">
			<h2>Notice</h2>
			<p>Setelan berhasil diubah</p>
		</div>
	</div>
</div>

<script>
	function gantiOptComment() {
		$(function() {
			var cmt = document.getElementById('optComment').value;
			var optCmt = 'opsi='+cmt+'&tipe=privasi2';
			$.ajax({
				type: "POST",
				url: "aksi/saveSetting.php",
				data: optCmt,
				success: function() {
					munculPopup("#notif");
					setTimeout(function() {
						hilangPopup("#notif");
					}, 1500);
				}
			});
		});
	}
	function gantiPrivat() {
		$(function() {
			var prvt = document.getElementById('akunPrivat').value;
			var optPrvt = 'opsi='+prvt+'&tipe=privasi';
			$.ajax({
				type: "POST",
				url: "aksi/saveSetting.php",
				data: optPrvt,
				success: function() {
					munculPopup("#notif");
					setTimeout(function() {
						hilangPopup("#notif");
					}, 1500);
				}
			});
		});
	}
</script>

</body>
</html>