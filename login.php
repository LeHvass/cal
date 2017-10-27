<?php
if (isset($_COOKIE['Cal'])) {
    header("location:/");
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Project &#8226; Sign in</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Personal Calendar">
        <meta name="author" content="Christian Hvass">
        <link href="/favicon.ico?=v2" rel="shortcut icon">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #eee;
            }

            .form-signin {
                max-width: 330px;
                padding: 15px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form name="signin" method="post" action="checklogin.php" class="form-signin">
                <h1 class="text-center"><b>Private page</b></h1>
                <div class="form-group">
                   <label for="password">The password is <strong>Portfolio</strong></label>
                    <input type="password" name="password" class="form-control input-lg" placeholder="Password">
                </div>
                <?php
                echo '<input type="hidden" name="location" value="';
                if (isset($_GET['location'])) {
                    echo htmlspecialchars($_GET['location']);
                }
                echo '" />';
                ?>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>

            <?php
            if (isset($_GET['failed'])) {
                echo "Login failed";
            }
            ?>
        </div>
    </body>
</html>
