<?php
include '../ig.php';

$sesi = $ig->cekSesi();
error_reporting(1);

$user = $_GET['user'];
setcookie('user',$user,time() + 3605, "/");
setcookie('limitPosProf', '3', time() + 3605, "/");
$nama = $ig->getUser($user, "nama");
$fotoProfil = $ig->getUser($user, "foto_profil");
$follower = $ig->getUser($user, "followers");
$following = $ig->getUser($user, "following");
$privat = $ig->getUser($user, "privat");
$uFolling = explode(",", $following);

$myFollowing = $ig->getUser($sesi, "following");
$pFolling = explode(",", $myFollowing);

if($user == $sesi) {
	$tblAksi = '<button class="tbl" id="pengaturan"><i class="fa fa-cog"></i> Pengaturan</button>';
}else {
	if(in_array($user, $pFolling)) {
		// sudah follow
		$tblAksi =  '<button class="tbl biru" id="tblFollow" style="display: none;"><i class="fa fa-plus"></i> Ikuti</button>'.
					'<button class="tbl" id="sudahFollow"><i class="fa fa-check"></i> Diikuti</button>';
	}else {
		$tblAksi =  '<button class="tbl" id="sudahFollow" style="display: none;"><i class="fa fa-check"></i> Diikuti</button>'.
					'<button class="tbl biru" id="tblFollow"><i class="fa fa-plus"></i> Ikuti</button>';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title><?php echo $nama; ?> on Yaudin</title>
	<link href="../fw/build/fw.css" rel="stylesheet">
	<link href="../fw/build/font-awesome.min.css" rel="stylesheet">
	<link href="../fw/build/material-icons.css" rel="stylesheet">
	<link href="../inc/css/style.profile.css" rel="stylesheet">
	<script src="../inc/js/jquery-3.1.1.js"></script>
	<script>
		$(function() {
			var us = $("#user").val();
			var user = "user="+us;
			$(".detail").load("../aksi/load/detailProfil.php");
			$("#pengaturan").click(function() {
				$(".bg,.opsiSetting").fadeIn(300);
			});
			$("#tblFollow").click(function() {
				$("#tblFollow").html("<i class='fa fa-spinner'></i> sebentar...").attr("disabled", "");
				$.ajax({
					type: "POST",
					url: "../aksi/follows.php",
					data: user+'&aksi=follow',
					success: function() {
						$("#tblFollow").hide();
						$("#sudahFollow").fadeIn(300);
						$(".detail").load("../aksi/load/detailProfil.php");
						$("#tblFollow").html("<i class='fa fa-plus'></i> Ikuti").removeAttr("disabled");
					}
				});
			});
			$("#sudahFollow").click(function() {
				$("#sudahFollow").html("<i class='fa fa-spinner'></i> sebentar...").attr("disabled", "");
				$.ajax({
					type: "POST",
					url: "../aksi/follows.php",
					data: user+'&aksi=unfoll',
					success: function() {
						$("#sudahFollow").hide();
						$("#tblFollow").fadeIn(300);
						$(".detail").load("../aksi/load/detailProfil.php");
						$("#sudahFollow").html("<i class='fa fa-check'></i> Diikuti").removeAttr("disabled");
					}
				});
			});
			$("#loadPos").load("../aksi/load/kirimanDiProfil.php");
			$(document).keydown(function(e) {
				if(e.which == 27) {
					$(".bg,.popupWrapper,.opsiSetting").fadeOut(290);
					$(".popup").css({"top":"-150%"}).fadeOut(200);
				}
			});
			$("#loadMorePos").click(function() {
				$("#loadMorePos").html("<i class='fa fa-spinner'></i> sebentar...");
				$.ajax({
					type: "POST",
					url: "../aksi/loadMorePos.php",
					data: "",
					success: function() {
						$("#loadMorePos").html("LAINNYA");
						$("#loadPos").load("../aksi/load/kirimanDiProfil.php");
					}, error: function() {
						$("#loadMorePos").html("LAINNYA");
					}
				});
			});
		});
	</script>
</head>
<body>

<input type="hidden" id="user" value="<?php echo $user; ?>">
<div class="atas">
	<a href="../" style="color: #444;"><h1 class="judul">Yaudin</h1></a>
	<div class="pencarian">
		<form>
			<input type="text" class="box" id="cari" oninput="pencarian();" placeholder="cari...">
			<button id="xCari" type="button"><i class="fa fa-close"></i></button>
		</form>
	</div>
	<nav class="menu">
		<a href="#"><li id="explore"><i class="material-icons">explore</i></li></a>
		<a href="#"><li><i class="material-icons">favorite_border</i></li></a>
		<a href="./<?php echo $sesi; ?>"><li><i class="material-icons">account_circle</i></li></a>
	</nav>
</div>

<div class="atas mobile">
	<h1 class="judul rata-tengah">Yaudin</h1>
</div>

<div class="hasilCari">
	<div class="hasil">
		<img src="../user/ryn.jpg">
		<h4>haloriyan</h4>
	</div>
</div>

<div class="profile">
	<div class="wrap">
		<div class="kiri">
			<img src="../user/<?php echo $fotoProfil; ?>">
		</div>
		<div class="kanan">
			<h2><?php echo $nama; ?></h2>
			<h3>@<?php echo $user; ?> <?php echo $tblAksi; ?></h3>
			<div class="detail">
				
			</div>
		</div>
	</div>
</div>

<div class="controls">
	<a href="../"><li><i class="fa fa-home"></i></li></a>
	<a href="../mobile/cari"><li><i class="fa fa-search"></i></li></a>
	<a href="../mobile/compose"><li><i class="fa fa-plus"></i></li></a>
	<a href="#"><li><i class="fa fa-heart-o"></i></li></a>
	<a href="../my/<?php echo $sesi; ?>" id="active"><li><i class="fa fa-user-o"></i></li></a>
</div>

<div class="kiriman" style="margin-bottom: 29px;">
	<?php
	if(in_array($sesi, $uFolling) or $privat == 0) {
		?>
		<div id="loadPos"></div>
		<div class="bag-tombol">
			<button id="loadMorePos" class="tbl biru" style="margin-top: 18px;">LAINNYA</button>
		</div>
	<?php
	}else { ?>
		<div class="rata-tengah" style="font-size: 40px;">
			Akun ini bersifat pribadi
		</div>
	<?php
	}
	?>
</div>

<?php
if($sesi == $user) { ?>
<button id="addPos" class="biru"><i class="fa fa-plus"></i></button>
<?php } ?>

<div class="bg"></div>
<div class="popupWrapper" id="buatKiriman">
	<div class="popup">
		<div class="wrap">
			<h3>Tambah Kiriman</h3>
			<input type="file" class="box" id="foto" style="font-size: 18px;">
			<div id="nextPosting" style="display: none;">
				<div id="preview"></div>
				<input type="hidden" id="namaFile" value="">
				<div class="isi">Katakan sesuatu tentang foto ini</div>
				<textarea class="box" id="kontenPost" style="width: 92%;"></textarea>
				<div class="bag-tombol">
					<button class="biru" id="post"><i class="fa fa-send"></i> KIRIM</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="opsiSetting">
	<a href="../pengaturan">
		<div>Sunting Profil</div>
	</a>
	<a href="../logout">
		<div>Log Out</div>
	</a>
</div>

<script src="../inc/js/insert.js"></script>
<script>
	function pencarian() {
		$(function() {
			var key = $("#cari").val();
			var cari = "namakuki=keycari&isikuki="+key+'&durasi=300';
			if(key == "") {
				$(".hasilCari").fadeOut(300);
			}else {
				$(".hasilCari").html("<i class='fa fa-spinner'></i>").css({"text-align":"center"});
				$(".hasilCari").fadeIn(300);
				$.ajax({
					type: "POST",
					url: "../aksi/setCookie.php",
					data: cari,
					success: function() {
						$(".hasilCari").load("../aksi/load/pencarian2.php");
					}
				})
			}
		});
	}
	function munculPopup(selector) {
		$(function() {
			$(selector+",.bg").fadeIn(300);
			$(selector+" .popup").fadeIn(300).css({"top":"0px"});
		});
	}
	function hilangPopup(selector) {
		$(function() {
			$(".bg,"+selector).fadeOut(300);
			$(selector+" .popup").fadeOut(300).css({"top":"-150%"});
		});
	}
	$(function() {
		$("#xCari").click(function() {
			$("#cari").val('');
			$(".hasilCari").fadeOut(300);
		});
		$("#addPos").click(function() {
			munculPopup("#buatKiriman");
		});
		$("#foto").on("change", function() {
			var file = $(this)[0].files[0];
			$(".view h1").css({"margin-top":"15%"});
			$("#progress-wrp").fadeIn(290);
		    var upload = new Upload(file);
			upload.doUpload();
		});
		$("#post").click(function() {
			var namaFile = $("#namaFile").val();
			var konten = $("#kontenPost").val();
			var pos = 'namafile='+namaFile+'&konten='+konten;
			$.ajax({
				type: "POST",
				url: "../aksi/kirim.php",
				data: pos,
				success: function() {
					$(".detail").load("../aksi/load/detailProfil.php");
					$("#loadPos").load("../aksi/load/kirimanDiProfil.php");
					$("#nextPosting").hide();
					$("#kontenPost,#foto").val('');
					$("#preview").html("");
					hilangPopup("#buatKiriman");
				}
			});
			return false;
		});
	});
	function sukses() {
		$(function() {
			$("#nextPosting").fadeIn(300);
			var img = $("#foto").val();
			var p = img.split("fakepath");
			var nama = p[1].substr(1, 2524);
			$("#namaFile").val(nama);
			$("#preview").html('<img src="../upload/'+nama+'" style="width: 50%">');
		});
	}
</script>

</body>
</html>