<?php
include '../ig.php';
$id = $_GET['id'];

setcookie('idpos', $id, time() + 6615, "/");
setcookie('limitKomen', '10', time() + 6615, "/");

$user = $ig->getPos($id, "username");
$konten = $ig->getPos($id, "konten");
$judulPage = $konten;
if($konten == "") {
	$judulPage = $user." di Yaudin";
}
$foto = $ig->getPos($id, "foto");
$fotoProfil = $ig->getUser($user, "foto_profil");
$optComment = $ig->getUser($user, "komentar");

$sesi = $ig->cekSesi();

$likers = $ig->getPos($id, "likers");
$pLike = explode(",", $likers);
$totLike = count($pLike);
$terakhirLike = $pLike[$totLike -1];

if(in_array($sesi, $pLike)) {
	$aksiTbl = "unlike";
	$isiTbl = "<i class='fa fa-heart'></i>";
}else {
	$aksiTbl = "like";
	$isiTbl = "<i class='fa fa-heart-o'></i>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title><?php echo $judulPage; ?></title>
	<link href="../fw/build/fw.css" rel="stylesheet">
	<link href="../fw/build/font-awesome.min.css" rel="stylesheet">
	<link href="../fw/build/material-icons.css" rel="stylesheet">
	<link href="../inc/css/style.pos.css" rel="stylesheet">
	<script src="../inc/js/jquery-3.1.1.js"></script>
	<style>
		.judul { cursor: pointer; }
	</style>
</head>
<body>

<div class="atas">
	<h1 class="judul">Yaudin</h1>
	<div class="pencarian">
		<form>
			<input type="text" class="box" id="cari" oninput="pencarian();" placeholder="cari...">
			<button id="xCari" type="button"><i class="fa fa-close"></i></button>
		</form>
	</div>
	<nav class="menu">
		<a href="#"><li id="explore"><i class="material-icons">explore</i></li></a>
		<a href="#"><li><i class="material-icons">favorite_border</i></li></a>
		<a href="../my/<?php echo $sesi; ?>"><li><i class="material-icons">account_circle</i></li></a>
	</nav>
</div>

<div class="hasilCari">
	<div class="hasil">
		<img src="../user/ryn.jpg">
		<h4>haloriyan</h4>
	</div>
</div>

<div class="kiriman">
	<div class="pos">
		<div class="atasPos">
			<img src="../user/<?php echo $fotoProfil; ?>">
			<h4><?php echo $user; ?></h4>
		</div>
		<div class="konten">
			<img src="../upload/<?php echo $foto; ?>">
		</div>
	</div>
</div>

<div class="kanan">
	<div class="content wrap">
		<b><a href="../my/<?php echo $user; ?>"><?php echo $user; ?></a></b> <?php echo $konten; ?>
	</div>
	<div class="react">
		<input type="hidden" id="idpos" value="<?php echo $id; ?>">
		<div class="ketLike"></div>
		<button id="like" aksi="<?php echo $aksiTbl; ?>"><?php echo $isiTbl; ?></button>
		<label for="komen">
			<button id="comment"><i class="fa fa-comment-o"></i></button>
		</label>
	</div>
	<div class="komentar wrap">
		
	</div>
	<div class="komen">
		<?php
		if($optComment == 1) {
		?>
		<form>
			<input type="text" class="box" id="komen" placeholder="beri komentar...">
			<button id="komentari" style="display: none;"></button>
		</form>
		<?php
		}else {
			//
		}
		?>
	</div>
</div>

<script>
	$(function() {
		$(".komentar").load("../aksi/load/komentar.php");
		$("#komentari").click(function() {
			var komentar = $("#komen").val();
			var komen = "komentar="+komentar;
			if(komentar == "") {
				return false;
			}
			$.ajax({
				type: "POST",
				url: "../aksi/komentari.php",
				data: komen,
				success: function() {
					$(".komentar").load("../aksi/load/komentar.php");
					$("#komen").val('');
				}
			});
			return false;
		});
		$("#like").click(function() {
			var idpos = $("#idpos").val();
			var aksi = $("#like").attr("aksi");
			var hai = 'idpos='+idpos+'&aksi='+aksi;
			if(aksi == "like") {
				var ubahTbl = "<i class='fa fa-heart'></i>";
				var aksiBaru = "unlike";
			}else {
				var ubahTbl = "<i class='fa fa-heart-o'></i>";
				var aksiBaru = "like";
			}
			$.ajax({
				type: "POST",
				url: "../aksi/like.php",
				data: hai,
				success: function() {
					$(".ketLike").load("../aksi/load/ketLike.php");
					$("#like").attr("aksi", aksiBaru);
					$("#like").html(ubahTbl);
				}
			});
		});
		$(".ketLike").load("../aksi/load/ketLike.php");
		$(".judul").click(function() {
			document.location = "../";
		});
	});
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
	$(function() {
		$("#xCari").click(function() {
			$("#cari").val('');
			$(".hasilCari").fadeOut(300);
		});
	});
</script>

</body>
</html>