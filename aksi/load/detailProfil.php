<?php
include '../../ig.php';
$user = $_COOKIE['user'];
$follower = $ig->getUser($user, "followers");
$following = $ig->getUser($user, "following");
?>
<div>
	<?php echo $ig->totPos($user); ?><br />
	kiriman
</div>
<div>
	<?php echo $ig->countArray($follower, ","); ?><br />
	pengikut
</div>
<div>
	<?php echo $ig->countArray($following, ","); ?><br />
	diikuti
</div>