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

if(!isset($_SESSION['password']))
{
    header('Location: login.php');
    exit;
}

$admin->Logout();

?>
<html>
<head>
    <title><?php echo $data->Fetch('site_name'); ?> | Admin Panel</title>
    <meta http-equiv="content-type" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" type="text/css" href="css/materialize.min.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="css/main.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="css/admin.css" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css" media="screen,projection">
</head>
<body>
<div class="topline">
    <div class="row">
        <div class="container">
            <div class="header">
                <div class="menu">
                    <ul>
                        <li><a href="admin.php" <?php echo (!isset($_GET['page'])?'class="current-nav"':''); ?>><i class="fas fa-tasks"></i> General Settings</a></li>
                        <li><a href="?page=info" <?php echo (isset($_GET['page']) && $_GET['page'] == "info"?'class="current-nav"':''); ?>><i class="fas fa-info-circle"></i> Information Settings</a></li>
                        <li><a href="?page=servers" <?php echo (isset($_GET['page']) && $_GET['page'] == "servers"?'class="current-nav"':''); ?>><i class="fas fa-server"></i> Servers</a></li>
                        <li><a href="?page=colors" <?php echo (isset($_GET['page']) && $_GET['page'] == "colors"?'class="current-nav"':''); ?>><i class="fas fa-paint-brush"></i> Color Settings</a></li>
                        <li class="right"><a href="?logout=1"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="container">
        <div class="content col s12">
            <?php if(isset($_GET['page']) && $_GET['page'] == 'colors'): ?>
                <div class="content-box col s12">
                    <form method="POST">
                        <div class="col s12">
                            <div class="section col s12">
                                <div class="option-container col s12">
                                    <div class="split-label col s12">
                                        <label>General Colors</label>
                                    </div>

                                    <div class="input-field col s12 m3">
                                        <input type="text" id="logo_color" class="browser-default color" value="<?php echo $data->Fetch('logo_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="logo_color" />
                                        <label for="logo_color">Logo Color</label>
                                    </div>

                                    <div class="input-field col s12 m3">
                                        <input type="text" id="title_color" class="browser-default color" value="<?php echo $data->Fetch('title_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="title_color" />
                                        <label for="title_color">Title Color</label>
                                    </div>

                                    <div class="input-field col s12 m3">
                                        <input type="text" id="bg_color" class="browser-default color"  value="<?php echo $data->Fetch('bg_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="bg_color" />
                                        <label for="bg_color">Background Color</label>
                                    </div>

                                    <div class="input-field col s12 m3">
                                        <input type="text" id="body_text_color" class="browser-default color" value="<?php echo $data->Fetch('body_text_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="body_text_color" />
                                        <label for="body_text_color">Body Text Color</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m6">
                            <div class="section col s12">
                                <div class="option-container col s12">
                                    <div class="split-label col s12">
                                        <label>Inactive Menu Colors</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <input type="text" id="text_color" class="browser-default color" value="<?php echo $data->Fetch('menu_text_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="menu_text_color" />
                                        <label for="text_color">Text</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <input type="text" id="text_hover_color" class="browser-default color" value="<?php echo $data->Fetch('menu_text_hover_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="menu_text_hover_color" />
                                        <label for="text_hover_color">Hover</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <input type="text" id="text_border_color" class="browser-default color" value="<?php echo $data->Fetch('menu_border_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="menu_border_color" />
                                        <label for="text_border_color">Border</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <input type="text" id="text_border_hover_color" class="browser-default color" value="<?php echo $data->Fetch('menu_border_hover_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="menu_border_hover_color" />
                                        <label for="text_border_hover_color">Hover</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <input type="text" id="text_bg_color" class="browser-default color" value="<?php echo $data->Fetch('menu_bg_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="menu_bg_color" />
                                        <label for="text_bg_color">Background</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <input type="text" id="text_bg_hover_color" class="browser-default color" value="<?php echo $data->Fetch('menu_bg_hover_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="menu_bg_hover_color" />
                                        <label for="text_bg_hover_color">Hover</label>
                                    </div>

                                    <div class="split-label col s12">
                                        <br><label>Active Menu Colors</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <input type="text" id="text_bg_color" class="browser-default color" value="<?php echo $data->Fetch('menu_current_text_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="menu_current_text_color" />
                                        <label for="text_bg_color">Text</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <input type="text" id="text_bg_hover_color" class="browser-default color" value="<?php echo $data->Fetch('menu_current_text_hover_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="menu_current_text_hover_color" />
                                        <label for="text_bg_hover_color">Hover</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <input type="text" id="text_bg_color" class="browser-default color" value="<?php echo $data->Fetch('menu_current_border_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="menu_current_border_color" />
                                        <label for="text_bg_color">Border</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <input type="text" id="text_bg_hover_color" class="browser-default color" value="<?php echo $data->Fetch('menu_current_border_hover_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="menu_current_border_hover_color" />
                                        <label for="text_bg_hover_color">Hover</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <input type="text" id="text_bg_color" class="browser-default color" value="<?php echo $data->Fetch('menu_current_bg_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="menu_current_bg_color" />
                                        <label for="text_bg_color">Background</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <input type="text" id="text_bg_hover_color" class="browser-default color" value="<?php echo $data->Fetch('menu_current_bg_hover_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="menu_current_bg_hover_color" />
                                        <label for="text_bg_hover_color">Hover</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m6">
                            <div class="section col s12">
                                <div class="option-container col s12">
                                    <div class="split-label col s12">
                                        <label>Rules Colors</label>
                                    </div>

                                    <div class="input-field col s12 m4">
                                        <input type="text" id="rules_text_color" class="browser-default color" value="<?php echo $data->Fetch('rules_text_color'); ?>" placeholder="rgba(255, 255, 255, 1)" name="rules_text_color" />
                                        <label for="rules_text_color">Text</label>
                                    </div>

                                    <div class="input-field col s12 m4">
                                        <input type="text" id="rules_odd_row" class="browser-default color" value="<?php echo $data->Fetch('rules_odd_row'); ?>" placeholder="rgba(255, 255, 255, 1)" name="rules_odd_row" />
                                        <label for="rules_odd_row">Odd Row</label>
                                    </div>

                                    <div class="input-field col s12 m4">
                                        <input type="text" id="rules_even_row" class="browser-default color" value="<?php echo $data->Fetch('rules_even_row'); ?>" placeholder="rgba(255, 255, 255, 1)" name="rules_even_row" />
                                        <label for="rules_even_row">Even Row</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bottom col s12">
                            <button type="submit" class="btn" name="save"><i class="material-icons">save</i></button>
                        </div>
                    </form>
                </div>
                <?php if(isset($_POST['save'])): ?>
                    <?php

                    $data->Update('logo_color', $_POST['logo_color']);
                    $data->Update('subname_color', $_POST['subname_color']);
                    $data->Update('bg_color', $_POST['bg_color']);
                    $data->Update('title_color', $_POST['title_color']);
                    $data->Update('body_text_color', $_POST['body_text_color']);

                    $data->Update('menu_text_color', $_POST['menu_text_color']);
                    $data->Update('menu_text_hover_color', $_POST['menu_text_hover_color']);
                    $data->Update('menu_border_color', $_POST['menu_border_color']);
                    $data->Update('menu_border_hover_color', $_POST['menu_border_hover_color']);
                    $data->Update('menu_bg_color', $_POST['menu_bg_color']);
                    $data->Update('menu_bg_hover_color', $_POST['menu_bg_hover_color']);

                    $data->Update('menu_current_text_color', $_POST['menu_current_text_color']);
                    $data->Update('menu_current_text_hover_color', $_POST['menu_current_text_hover_color']);
                    $data->Update('menu_current_border_color', $_POST['menu_current_border_color']);
                    $data->Update('menu_current_border_hover_color', $_POST['menu_current_border_hover_color']);
                    $data->Update('menu_current_bg_color', $_POST['menu_current_bg_color']);
                    $data->Update('menu_current_bg_hover_color', $_POST['menu_current_bg_hover_color']);

                    $data->Update('rules_text_color', $_POST['rules_text_color']);
                    $data->Update('rules_odd_row', $_POST['rules_odd_row']);
                    $data->Update('rules_even_row', $_POST['rules_even_row']);

                    echo '<meta http-equiv="refresh" content="0">';

                    ?>
                <?php endif; ?>
            <?php elseif(isset($_GET['page']) && $_GET['page'] == 'info'): ?>
                <div class="content-box col s12">
                    <form method="POST">
                        <?php $i = 0; ?>
                        <?php foreach($data->Fetch('infobox') as $row): ?>
                            <div class="col s12 m4">
                                <div class="section col s12">
                                    <div class="option-container col s12">
                                        <div class="split-label col s12">
                                            <label>Infobox <?php echo $i+1; ?> Settings</label>
                                        </div>

                                        <div class="input-field col s12">
                                            <input type="text" id="info_icon" class="browser-default" value="<?php echo $row[0]; ?>" placeholder="" name="info_icon<?php echo $i; ?>" />
                                            <label for="info_icon">FontAwesome.io Icon</label>
                                        </div>

                                        <div class="input-field col s12">
                                            <input type="text" id="info_title" class="browser-default" value="<?php echo $row[1]; ?>" placeholder="" name="info_title<?php echo $i; ?>" />
                                            <label for="info_title">Title</label>
                                        </div>

                                        <div class="input-field col s12">
                                            <textarea class="browser-default" name="info_text<?php echo $i; ?>" placeholder=""><?php echo $row[2]; ?></textarea>
                                            <label for="info_text">Body Text</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>

                        <div class="col s12">
                            <div class="section col s12">
                                <div class="option-container col s12">
                                    <div class="split-label col s12">
                                        <label>Rules Settings</label>
                                    </div>

                                    <?php $i = 0; ?>
                                    <?php foreach($data->Fetch('rules') as $row): ?>
                                        <div class="input-field col s12 m4">
                                            <input type="text" id="rule_text" class="browser-default" value="<?php echo $row; ?>" placeholder="" name="rule<?php echo $i; ?>" />
                                            <label for="rule_text">Rule <?php echo $i+1; ?></label>
                                        </div>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <div class="bottom col s12">
                            <button type="submit" class="btn" name="save"><i class="material-icons">save</i></button>
                        </div>
                    </form>
                </div>

                <?php if(isset($_POST['save'])): ?>
                    <?php

                    $data->Update('infobox', array(
                        0 => array(
                            $_POST['info_icon0'],
                            $_POST['info_title0'],
                            $_POST['info_text0']
                        ),
                        1 => array(
                            $_POST['info_icon1'],
                            $_POST['info_title1'],
                            $_POST['info_text1']
                        ),
                        2 => array(
                            $_POST['info_icon2'],
                            $_POST['info_title2'],
                            $_POST['info_text2']
                        )
                    ));

                    $data->Update('rules', array(
                        0 => $_POST['rule0'],
                        1 => $_POST['rule1'],
                        2 => $_POST['rule2'],
                        3 => $_POST['rule3'],
                        4 => $_POST['rule4'],
                        5 => $_POST['rule5'],
                        6 => $_POST['rule6'],
                        7 => $_POST['rule7'],
                        8 => $_POST['rule8'],
                    ));

                    echo '<meta http-equiv="refresh" content="0">';

                    ?>
                <?php endif; ?>
            <?php elseif(isset($_GET['page']) && $_GET['page'] == 'servers'): ?>
                <div class="content-box col s12">
                    <form method="POST">
                        <div class="col s12 m4">
                            <div class="section col s12">
                                <div class="option-container col s12">
                                    <div class="split-label col s12">
                                        <label>Add Server</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <select name="game">
                                            <?php foreach($games as $row => $key): ?>
                                                <option value="<?php echo $key; ?>"><?php echo $row; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="logo_color">Game</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input type="text" id="server_ip" class="browser-default" value="<?php ?>" placeholder="" name="server_ip" />
                                        <label for="server_ip">Server IP</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input type="text" id="server_port" class="browser-default"  value="<?php ?>" placeholder="" name="server_port" />
                                        <label for="server_port">Server Port</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <button type="submit" class="btn" name="add"><i class="material-icons">add</i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="col s12 m8">
                        <div class="section col s12">
                            <div class="option-container col s12">
                                <div class="split-label col s12">
                                    <label>Servers</label>
                                </div>

                                <table class="server-table">
                                    <tr>
                                        <td>Garry's Mod</td>
                                        <td>127.0.0.1</td>
                                        <td>27015</td>
                                        <td><i class="fas fa-pen-square green-text right"></i></td>
                                        <td><i class="fas fa-trash-alt red-text right"></i></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="content-box col s12">
                    <form method="POST">
                        <div class="col s12">
                            <div class="section col s12">
                                <div class="option-container col s12">
                                    <div class="split-label col s12">
                                        <label>General Settings</label>
                                    </div>

                                    <div class="input-field col s12 m4">
                                        <input type="text" id="site_name" class="browser-default" value="<?php echo $data->Fetch('site_name'); ?>" placeholder="" name="site_name" />
                                        <label for="site_name">Site Name</label>
                                    </div>

                                    <div class="input-field col s12 m4">
                                        <input type="text" id="site_subname" class="browser-default" value="<?php echo $data->Fetch('site_subname'); ?>" placeholder="" name="site_subname" />
                                        <label for="site_subname">Site Subname</label>
                                    </div>

                                    <div class="input-field col s12 m4">
                                        <input type="text" id="site_url" class="browser-default" value="<?php echo $data->Fetch('site_url'); ?>" placeholder="" name="site_url" />
                                        <label for="site_url">Site URL</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m6">
                            <div class="section col s12">
                                <div class="option-container col s12">
                                    <div class="split-label col s12">
                                        <label>Menu Items</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <table id="table">
                                            <tbody>
                                                <tr>
                                                    <td class="title">Item Name</td>
                                                    <td class="title">Filename</td>
                                                    <td></td>
                                                </tr>
                                                <?php $i = 0; ?>
                                                <?php foreach($data->Fetch('menu_item') as $row): ?>
                                                    <tr>
                                                        <td><input type="text" class="browser-default" placeholder="" name="menu_name<?php echo $i; ?>" value="<?php echo $row[0]; ?>" /></td>
                                                        <td><input type="text" class="browser-default" placeholder="" name="menu_link<?php echo $i; ?>" value="<?php echo $row[1]; ?>" /></td>
                                                        <!--<td class="icon-table"><i class="material-icons red-text">indeterminate_check_box</i></td>-->
                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <!--<a href="#" id="add"><i class="material-icons add-row green-text right">add_box</i></a>-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m6">
                            <div class="section col s12">
                                <div class="option-container col s12">
                                    <div class="split-label col s12">
                                        <label>Admin Settings</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input type="password" id="admin_password" class="browser-default" value="<?php echo $_SESSION['password']; ?>" placeholder="" name="admin_password" />
                                        <label for="admin_password">Admin Password</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m6">
                            <div class="section col s12">
                                <div class="option-container col s12">
                                    <div class="split-label col s12">
                                        <label>Image Options</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <div class="sub-field col s12 m8">
                                            <label for="site_logo">Site Logo</label>
                                            <input type="text" id="site_logo" class="browser-default" value="<?php echo $data->Fetch('site_logo'); ?>" placeholder="" name="site_logo" />
                                        </div>

                                        <div class="sub-field col s12 m2">
                                            <label for="logo_width">Logo Width</label>
                                            <input type="number" min="0" max="9999" id="logo_width" class="browser-default" value="<?php echo $data->Fetch('logo_width'); ?>" placeholder="" name="logo_width" />
                                        </div>

                                        <div class="sub-field col s12 m2">
                                            <label for="site_logo">Logo Height</label>
                                            <input type="number" min="0" max="9999" id="logo_height" class="browser-default" value="<?php echo $data->Fetch('logo_height'); ?>" placeholder="" name="logo_height" />
                                        </div>
                                    </div>

                                    <div class="input-field col s12">
                                        <input type="text" id="banner_image" class="browser-default" value="<?php echo $data->Fetch('banner_img'); ?>" placeholder="" name="banner_image" />
                                        <label for="banner_image">Banner Image</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input type="text" id="bg_img" class="browser-default" value="<?php echo $data->Fetch('bg_img'); ?>" placeholder="" name="bg_img" />
                                        <label for="bg_img">Background Image</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bottom col s12">
                            <button type="submit" class="btn" name="save"><i class="material-icons">save</i></button>
                        </div>
                    </form>
                </div>
                <?php if(isset($_POST['save'])): ?>
                    <?php

                    $data->Update('site_name', $_POST['site_name']);
                    $data->Update('site_subname', $_POST['site_subname']);
                    $data->Update('site_url', $_POST['site_url']);

                    $data->Update('site_logo', $_POST['site_logo']);
                    $data->Update('logo_width', $_POST['logo_width']);
                    $data->Update('logo_height', $_POST['logo_height']);

                    $data->Update('bg_img', $_POST['bg_img']);
                    $data->Update('banner_img', $_POST['banner_image']);

                    $data->Update('menu_item', array(
                        0 => array(
                            $_POST['menu_name0'],
                            $_POST['menu_link0']
                        ),
                        1 => array(
                            $_POST['menu_name1'],
                            $_POST['menu_link1']
                        ),
                        2 => array(
                            $_POST['menu_name2'],
                            $_POST['menu_link2']
                        ),
                        3 => array(
                            $_POST['menu_name3'],
                            $_POST['menu_link3']
                        ),
                        4 => array(
                            $_POST['menu_name4'],
                            $_POST['menu_link4']
                        )
                    ));

                    echo '<meta http-equiv="refresh" content="0">';

                    ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- JS -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript" src="js/ColorPicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('select').formSelect();

        // JS Color Picker
        $('.color').colorPicker();
    });
</script>

<script type="text/javascript">
    // Dynamic row adding will be added later
    $(document).ready(function() {
        $("#add").click(function() {
          $('#table tbody>tr:last').clone(true).insertAfter('#table tbody>tr:last');
          return false;
        });
    });
</script>
</body>
</html>
