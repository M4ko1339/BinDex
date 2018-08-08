<?php

session_start();

include('inc/settings.php');
include('inc/functions.php');

$data  = new Data();
$admin = new AdminCP();

if(!$data->Installed())
{
    header('Location: install.php');
    exit;
}

if(isset($_SESSION['password']))
{
    header('Location: admin.php');
    exit;
}

?>
<html>
<head>
    <title><?php echo $data->Fetch('site_name'); ?> | Login Panel</title>
    <meta http-equiv="content-type" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" type="text/css" href="css/materialize.min.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="css/main.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="css/login.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css" media="screen,projection">
</head>
<body>

<div class="row">
    <div class="container">
        <div class="content col s12 m4 offset-m4">
            <div class="login-box col s12">
                <div class="login-box-header col s12">
                    Login Panel
                </div>

                <div class="login-box-content col s12">
                    <form method="POST">
                        <div class="input-field col s12">
                            <input type="password" class="browser-default" id="password" placeholder="" name="password" />
                            <label for="password">Password</label>
                        </div>

                        <div class="input-field col s12">
                            <input type="submit" class="btn" name="login" value="Login" />
                        </div>
                    </form>
                </div>
            </div>

            <?php if(isset($_POST['login'])): ?>
                <?php if(!empty($_POST['password'])): ?>
                    <?php if($admin->Login($_POST['password'])): ?>
                        <?php $_SESSION['password'] = $_POST['password']; ?>
                        <?php header('Location: admin.php'); exit; ?>
                    <?php else: ?>
                        <div class="response col s12 red">
                            You have entered a wrong password!
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="response col s12 red">
                        All fields are required!
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- JS -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

</body>
</html>
