<?php
include '../ig.php';

$tag = $_GET['tag'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>#<?php echo $tag; ?> on Yaudin</title>
	<link href="../fw/build/fw.css" rel="stylesheet">
	<link href="../fw/build/font-awesome.min.css" rel="stylesheet">
	<link href="../inc/css/style.hashtag.css" rel="stylesheet">
	<script src="../inc/js/jquery-3.1.1.js"></script>
</head>
<body>

<div class="atas">
	<h1 class="judul" style="cursor: pointer;">Yaudin</h1>
	<div class="tngh rata-tengah">
		#<?php echo $tag; ?><br />
		<div style="font-size: 16px;margin-top: -30px;"><?php echo $ig->totKirimHashtag($tag); ?> kiriman</div>
	</div>
</div>

<div class="container">
	<?php
	error_reporting(1);
	foreach ($ig->hashtag($tag) as $row) {
		echo "<a href='../pos/".$row['idpos']."'>".
			 	"<div class='pos'>".
				 	"<img src='../upload/".$row['foto']."'>".
			 	"</div>".
			 "</a>";
	}
	?>
</div>

<script>
	$(function() {
		$(".judul").click(function() {
			document.location = "../";
		});
	});
</script>

</body>
</html>