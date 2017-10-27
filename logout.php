<?php

$past = time() - 10;
setcookie('Cal', "1", $past);

header("location:/login.php");
?>