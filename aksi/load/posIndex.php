<?php
foreach ($ig->beranda($sesi, 10) as $row) {
	// "<button id='like'><i class='fa fa-heart-o'></i></button>"
	$likers = $row['likers'];
	$pLike = explode(",", $likers);
	$idpos = $row['idpos'];
	if(in_array($sesi, $pLike)) {
		// sudah like
		$tblLike =  "<button id='unlike'><i class='fa fa-heart'></i></button>".
					"<button id='like' style='display: none;'><i class='fa fa-heart-o'></i></button>";
	}else {
		$tblLike =  "<button id='unlike' style='display: none;'><i class='fa fa-heart'></i></button>".
					"<button id='like'><i class='fa fa-heart-o'></i></button>";
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
		 			"<img src='upload/".$row['foto']."'>".
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