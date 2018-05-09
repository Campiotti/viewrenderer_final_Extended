<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 26.01.2018
 * Time: 17:47
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Viewrenderer Final Extended</title>
    <meta charset="utf-8">
    <link rel="icon" href="<?php echo$this->image?><?php echo "icon.ico" ?>">
    <link rel="shortcut icon" href="<?php echo$this->image?><?php echo "icon.ico" ?>" />
    <link rel="stylesheet" href="<?php echo$this->assets?>css/reset.css">
    <link rel="stylesheet" href="<?php echo$this->assets?>css/main.css">
    <script src="<?php echo$this->assets?>js/main.js"></script>
    <!--Image Input Dynamic-->
    <!--link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" /-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
    <!--\Image Input Dynamic-->

</head>
<body  style="" class="">
<div id="alertContainer" class="customMessageContainer cNon zLow" style="display: none">
    <div class="customMessageBackground" id="alertBackground"></div>
    <div class="customMessageBox" id="alertBox">
        <div id="alertBoxTitle" class="customMessageTitle"></div><a class="customMessageClose" id="alertBoxClose" onclick="closeMessage()"><img src="https://png.icons8.com/metro/32/000000/close-window.png"></a>
        <div id="alertBoxContent" class="customMessageContent"></div>

    </div>
</div>
<!--==============================header=================================-->
<header>
    <div class="container_12">
        <div class="grid_12">
            <h1><a href="/base/index"><img src="<?php echo$this->image?>ICSystem_Logo.png" alt="Logo" class="logo"></a> </h1>
            <div class="menu_block">
                <nav  class="header-nav">
                    <ul class="header-ul">
                        <li class="<?php if ($this->headerIndex == 0) echo'current'?>"><a href="/base/index">Home</a></li>
                        <li class="<?php if ($this->headerIndex == 1) echo'current'?>"><a href="/base/about">About</a></li>
                        <!--<li class="<?php if ($this->headerIndex == 2) echo'current'?>"><a href="/video/videos">Videos</a></li>-->
                        <li class="<?php if ($this->headerIndex == 3) echo'current'?>"><a href="/base/partners">Our Partners</a></li>
                        <li class="<?php if ($this->headerIndex == 4) echo'current'?>"><a href="/base/contact">Contact Us</a></li>
                        <li class="<?php if ($this->headerIndex == 5) echo'current'?>"><a href="/user/user">You</a></li>
                        <?php if($this->sessionManager->isSet('User')){ ?>
                        <li class="<?php if ($this->headerIndex == 6) echo'current'?>"><a href="#">Logged In Function</a></li>
                        <li class="<?php if ($this->headerIndex == 7) echo'current'?>"><a href="#">Logged In Function 2</a></li>
                        <?php }?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
