<?php require('inc/header.inc');
?><!DOCTYPE html>
<html lang="da">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title><?php echo $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/favicon.ico?=v2" rel="shortcut icon">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" rel="stylesheet">
        <script src="https://use.fontawesome.com/4b366c67d3.js"></script>
        <link href="//fonts.googleapis.com/css?family=Droid+Sans+Mono|Open+Sans:400,600,700,800,400italic,600italic,800italic" rel="stylesheet" type="text/css">
        <link href="/css/square/blue.css" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
        <link href="/css/select2-bootstrap.min.css" rel="stylesheet">
        <link href="/css/theme.bootstrap.css" rel="stylesheet" media="screen">
        <link href="/css/jquery.tablesorter.pager.css" rel="stylesheet" media="screen">
        <link href="/css/style.css" rel="stylesheet" media="screen">
        <link href="/css/datepicker.css" rel="stylesheet" media="screen">
        <link href="/css/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <?php require('inc/menu.inc') ?>
        <div class="navbar navbar-inverse navbar-fixed-top visible-xs visible-sm">
            <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="col-lg-12">
            <?php
            if (!file_exists("lib/" . $content . ".php")) {
                require("lib/404.php");
            } else {
                require "lib/" . $content . ".php";
            }
            ?>
        </div>

        <!-- Modal -->
        <?php require('inc/modal.inc') ?>

        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/da.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.1/icheck.min.js"></script>
        <script src="/js/bootstrap-datepicker.js"></script>
        <script src="/js/bootstrap-datepicker.da.js"></script>
        <script src="/js/jquery.tablesorter.min.js"></script>
        <script src="/js/jquery.tablesorter.widgets.min.js"></script>
        <script src="/js/jquery.tablesorter.pager.min.js"></script>
        <script src="/js/bootstrap-timepicker.min.js"></script>
        <script src="/js/scripts.js"></script>

    </body>
</html>