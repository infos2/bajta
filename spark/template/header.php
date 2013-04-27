<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="icon" href="images/favicon.ico.png" type="image/jpg"/>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<title>Spark</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/ordering.js"></script>
<script src="js/functions.js"></script>
<script src="js/ajax.php{endx,AJAXARGS}"></script>
</head>
<body>
<div class="main">
	<div style="text-align:center;padding:15px 0;"><img src="images/elementi/logo.png"/></div>
	<ul class="menu">
	{endx,MENU}
        <div class="menu-right" style="padding:4px 10px;">
            <span style="float:right;padding:5px 10px;">
                <a href="{endx,SITE}" style="margin-right:10px;" target="_new"><img src="images/elementi/view.png" /> View site </a>
                <span style="margin:0 10px;" class="">
                    <select onChange="goTo('index.php?lang='+this.value)">
                        <option value="en" >EN</option>
                        <option value="por">POR</option>
                    </select>
                </span>
                <a href="?logout=1"><img src="images/elementi/log_out.png" /> Log out</a>
            </span>
        </div>
    </ul>
    <!-- *********/HEADER/********* --> 

