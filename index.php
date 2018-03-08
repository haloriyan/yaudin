<?php
include 'ig.php';

error_reporting(1);
$sesi = $ig->cekSesi();
$following = $ig->getUser($sesi, "following");
$myPhoto = $ig->getUser($sesi, "foto_profil");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Yaudin</title>
	<link href="fw/build/fw.css" rel="stylesheet">
	<link href="fw/build/font-awesome.min.css" rel="stylesheet">
	<link href="fw/build/material-icons.css" rel="stylesheet">
	<link href="inc/css/style.index.css" rel="stylesheet">
	<script src="inc/js/jquery-3.1.1.js"></script>
	<script src="inc/js/script.index.js"></script>
	<script>
		function unlike(val) {
			$(function() {
				var id = 'idpos='+val;
				$.ajax({
					type: "POST",
					url: "aksi/like.php",
					data: id+'&aksi=unlike',
					success: function() {
						$("#"+val+"unlike").hide();
						$("#"+val+"like").show();
					}
				});
			});
		}
		function like(val) {
			$(function() {
				var id = 'idpos='+val;
				$.ajax({
					type: "POST",
					url: "aksi/like.php",
					data: id+'&aksi=like',
					success: function() {
						$("#"+val+"like").hide();
						$("#"+val+"unlike").show();
					}
				});
			});
		}
	</script>
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
		<a href="./my/<?php echo $sesi; ?>"><li><i class="material-icons">account_circle</i></li></a>
	</nav>
</div>

<div class="atas mobile">
	<h1 class="judul rata-tengah">Yaudin</h1>
</div>

<div class="controls">
	<a href="" id="active"><li><i class="fa fa-home"></i></li></a>
	<a href="./mobile/cari"><li><i class="fa fa-search"></i></li></a>
	<a href="./mobile/compose"><li><i class="fa fa-plus"></i></li></a>
	<a href="#"><li><i class="fa fa-heart-o"></i></li></a>
	<a href="./my/<?php echo $sesi; ?>"><li><i class="fa fa-user-o"></i></li></a>
</div>

<div class="hasilCari">
	<div class="hasil">
		<img src="user/<?php echo $myPhoto; ?>">
		<h4>haloriyan</h4>
	</div>
</div>

<div class="container">
	<?php
	if($following == "") {
		include 'lib/welcomeYaudin.php';
	}else {
		foreach ($ig->beranda($sesi, 10) as $row) {
			// "<button id='like'><i class='fa fa-heart-o'></i></button>"
			$likers = $row['likers'];
			$pLike = explode(",", $likers);
			$idpos = $row['idpos'];
			if(in_array($sesi, $pLike)) {
				// sudah like
				$tblLike =  "<button onclick='unlike(this.value);' value='".$idpos."' class='unlike' id='".$idpos."unlike'><i class='fa fa-heart'></i></button>".
							"<button onclick='like(this.value);' value='".$idpos."' class='like' style='display: none;' id='".$idpos."like'><i class='fa fa-heart-o'></i></button>";
			}else {
				$tblLike =  "<button onclick='unlike(this.value);' value='".$idpos."' class='unlike' style='display: none;' id='".$idpos."unlike'><i class='fa fa-heart'></i></button>".
							"<button onclick='like(this.value);' value='".$idpos."' class='like' id='".$idpos."like'><i class='fa fa-heart-o'></i></button>";
			}
			$fotoProfil = $ig->getUser($row['username'], "foto_profil");
			echo "<div class='pos'>".
				 	"<div class='atasPos'>".
				 		"<a href='./my/".$row['username']."'>".
				 			"<img src='user/".$fotoProfil."'>".
				 			"<h4>".$row['username']."</h4>".
				 		"</a>".
				 	"</div>".
				 	"<div class='konten'>".
				 		"<a href='./pos/".$idpos."'>".
				 			"<img src='upload/".$row['foto']."' ondblclick='like(this.value);' value='".$idpos."'>".
				 		"</a>".
				 		"<div>".
				 			"<div class='wrap'>".
				 				"<b><a href='./profil/".$row['username']."'>".$row['username']."</a></b> ".
				 				$row['konten'].
				 			"</div>".
				 		"</div>".
				 	"</div>".
				 	"<div class='react'>".
				 		"<input type='hidden' id='idpos' value='".$idpos."'>".
				 		$tblLike.
				 		"<a href='./pos/".$idpos."'><button id='comment'><i class='fa fa-comment-o'></i></button></a>".
				 	"</div>".
				 "</div>";
		}
	}
	?>
</div>

<div class="kanan">
	<div class="bagian" id="profil">
		<img src="user/<?php echo $myPhoto; ?>">
		<h4><?php echo $ig->getUser($sesi, "nama"); ?></h4>
	</div>
</div>

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
					url: "aksi/setCookie.php",
					data: cari,
					success: function() {
						$(".hasilCari").load("aksi/load/pencarian.php");
					}
				})
			}
		});
	}
	$(function() {
		var idpos = $("#idpos").val();
		$("#xCari").click(function() {
			$("#cari").val('');
			$(".hasilCari").fadeOut(300);
		});
	});
</script>

</body>
</html>