<?php

include('inc/settings.php');
include('inc/functions.php');
include('inc/servers.class.php');

$data = new Data();


if(!$data->Installed())
{
    header('Location: install.php');
    exit;
}

?>
<html>
<head>
    <title><?php echo $data->Fetch('site_name'); ?></title>
    <meta http-equiv="content-type" charset="utf-8">
    <meta name="description" content="<?php echo $data->Fetch('seo', 'description'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" type="text/css" href="css/materialize.min.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="css/main.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="css/content.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css" media="screen,projection">

    <style>
        html,body
        {
            <?php if($data->Fetch('bg_img') !== ""): ?>
                background: url(<?php echo $data->Fetch('bg_img'); ?>) no-repeat center center fixed;
                -webkit-background-size: cover;
            	-moz-background-size: cover;
              	-o-background-size: cover;
              	background-size: cover;
            <?php endif; ?>
        }

        body
        {
            background-color: <?php echo $data->Fetch('bg_color'); ?>;
            color: <?php echo $data->Fetch('body_text_color'); ?>;
        }

        .logo
        {
            color: <?php echo $data->Fetch('logo_color'); ?>;
        }

        .subname
        {
            color: <?php echo $data->Fetch('subname_color'); ?>;
        }

        .main-menu a
        {
            z-index: 10;
            padding: 8px 10px 10px 10px;
            text-align: center;
            border: 3px <?php echo $data->Fetch('menu_border_color'); ?> solid;
            background-color: <?php echo $data->Fetch('menu_bg_color'); ?>;
            margin: 2px;
            color: <?php echo $data->Fetch('menu_text_color'); ?>;
        }

        .main-menu a:hover, .main-menu a:hover
        {
            z-index: 10;
            padding: 8px 10px 10px 10px;
            text-align: center;
            border: 3px <?php echo $data->Fetch('menu_border_hover_color'); ?> solid;
            background-color: <?php echo $data->Fetch('menu_bg_hover_color'); ?>;
            margin: 2px;
            color: <?php echo $data->Fetch('menu_text_hover_color'); ?>;
        }

        .main-menu .current-nav
        {
            z-index: 10;
            padding: 8px 10px 10px 10px;
            text-align: center;
            border: 3px <?php echo $data->Fetch('menu_current_border_color'); ?> solid;
            background-color: <?php echo $data->Fetch('menu_current_bg_color'); ?>;
            margin: 2px;
            color: <?php echo $data->Fetch('menu_current_text_color'); ?>;
        }

        .main-menu .current-nav:hover
        {
            z-index: 10;
            padding: 8px 10px 10px 10px;
            text-align: center;
            border: 3px <?php echo $data->Fetch('menu_current_border_hover_color'); ?> solid;
            background-color: <?php echo $data->Fetch('menu_current_bg_hover_color'); ?>;
            margin: 2px;
            color: <?php echo $data->Fetch('menu_current_text_hover_color'); ?>;
        }

        .slides h3
        {
            padding: 30px 0px 0px 0px;
        }

        .slides h5
        {
            padding: 0px 0px 0px 0px;
        }

        .card-title
        {
            text-align: center;
            color: #EEE;
            padding: 5px;
        }

        .content-header
        {
            font-size: 2rem;
            padding: 10px 10px 20px 10px;
            border-bottom: 1px #333 solid;
            text-align: center;
            color: <?php echo $data->Fetch('title_color'); ?>;
        }

        .rules-list li
        {
            padding: 10px;
            color: <?php echo $data->Fetch('rules_text_color'); ?>;
        }

        .rules-list li:nth-child(odd)
        {
            background-color: <?php echo $data->Fetch('rules_odd_row'); ?>;
        }

        .rules-list li:nth-child(even)
        {
            background-color: <?php echo $data->Fetch('rules_even_row'); ?>;
        }
    </style>
</head>
<body>
<div class="slider">
    <ul class="slides">
        <li>
            <img src="<?php echo $data->Fetch('banner_img'); ?>">

            <div class="caption center-align main-menu">
                <?php echo ($data->Fetch('site_logo') == "")?"<h3 class='logo'>" . $data->Fetch('site_name') . "</h3>":"<img src=" . $data->Fetch('site_logo') . " style='width: " . $data->Fetch('logo_width') . "px; height: " . $data->Fetch('logo_height') . "px !important;'>"; ?>
                <h5 class="light text-lighten-3 subname"><?php echo $data->Fetch('site_subname'); ?></h5>
                <br>
                <?php foreach($data->Fetch('menu_item') as $row): ?>
                    <?php if($row[0] !== "" || $row[1] !== ""): ?>
                        <a href="<?php echo $row[1]; ?>" <?php echo (basename($_SERVER["PHP_SELF"]) == $row[1])?"class=\"current-nav\"":""; ?>><?php echo strtoupper($row[0]); ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </li>
    </ul>
</div>
