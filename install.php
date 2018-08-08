<?php

include('inc/settings.php');
include('inc/functions.php');
include('inc/servers.class.php');

$data = new Data();
$srv  = new Servers();

if($data->Installed())
{
    header('Location: index.php');
    exit;
}

?>
<html>
<head>
    <title>BinDex - install</title>
    <meta http-equiv="content-type" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" type="text/css" href="css/materialize.min.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="css/main.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="css/install.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css" media="screen,projection">
</head>
<body>
    <div class="row">
        <div class="container">
            <div class="content col s12">
                <div class="content-box col s4 offset-s4">
                    <div class="content-box-header col s12 white-text">
                        Install - BinDex
                    </div>

                    <div class="content-box-content col s12">
                        <form method="POST">
                            <div class="input-field col s12">
                                <input type="text" id="site_name" name="site_name" />
                                <label for="site_name">Site Name</label>
                            </div>

                            <div class="input-field col s12">
                                <input type="text" id="site_subname" name="site_subname" />
                                <label for="site_subname">Site Subname</label>
                            </div>

                            <div class="input-field col s12">
                                <input type="text" id="site_url" name="site_url" />
                                <label for="site_url">Site URL</label>
                            </div>

                            <div class="input-field col s12">
                                <input type="password" id="admin_password" name="admin_password" />
                                <label for="admin_password">Admin Password</label>
                            </div>

                            <div class="extensions col s12">
                                <?php echo ($data->CheckExtension('PDO')?'<i class="fas fa-check green-text"></i> PDO Extension':'<i class="fas fa-times red-text"></i> PDO Extension'); ?>
                                <br>
                                <?php echo ($data->CheckExtension('json')?'<i class="fas fa-check green-text"></i> JSON Extension':'<i class="fas fa-times red-text"></i> JSON Extension'); ?>
                                <br>
                                <?php echo ($data->CheckExtension('gmp')?'<i class="fas fa-check green-text"></i> GMP Extension':'<i class="fas fa-times red-text"></i> GMP Extension'); ?>
                                <br>
                                <?php echo ($data->GetINI('allow_url_fopen')?'<i class="fas fa-check green-text"></i> allow_url_fopen':'<i class="fas fa-times red-text"></i> allow_url_fopen'); ?>
                            </div>

                            <div class="input-field col s12">
                                <input type="submit" class="btn" <?php echo ($data->CheckExtension('PDO') && $data->CheckExtension('json') && $data->CheckExtension('gmp') && $data->GetINI('allow_url_fopen')?"":"disabled"); ?> name="install" value="Install" />
                            </div>
                        </form>
                    </div>

                    <?php if(isset($_POST['install'])): ?>
                        <?php if(!empty($_POST['site_name'] && $_POST['site_subname'] && $_POST['site_url'] && $_POST['admin_password'])): ?>
                            <?php if($data->CheckExtension('PDO') && $data->CheckExtension('json') && $data->CheckExtension('gmp') && $data->GetINI('allow_url_fopen')): ?>
                                <?php

                                $data->Store($_POST['site_name'], $_POST['site_subname'], $_POST['site_url'], $_POST['admin_password']);
                                $srv->Create();
                                $data->Lock();

                                header('Location: admin.php');
                                exit;

                                ?>
                            <?php else: ?>
                                <div class="response col s12 red">
                                    One or more dependencies are missing!
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="response col s12 red">
                                All fields needs to be filled in!
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
