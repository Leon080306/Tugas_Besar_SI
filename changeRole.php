<?php
$userID = "29b0afd2-b303-44aa-bb33-384910209120";
setcookie('user_id', $userID, time() + (86400 * 30), '/', '', false, true);
setcookie('user_role', 'M', time() + (86400 * 30), '/', '', false, true);
?>