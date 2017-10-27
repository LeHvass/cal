<?php

if ($_POST['password'] == "Portfolio") {
    $expire = time() + 3600 * 24 * 30;
    setcookie('Cal', '1', $expire);
    header("location:/");
} else {
    header("Location: http://www.google.com");
//    echo "Wrong Username or Password";
}
?>
