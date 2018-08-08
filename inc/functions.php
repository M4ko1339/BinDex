<?php

Class Data
{
    private $filename = SETTINGS_DB;
    private $location = LOCATION;

    public function Store($site_name, $site_subname, $site_url, $admin_password)
    {
        $data = array(
            // AdminCP Password
            'password'  => sha1($admin_password),

            // General Settings
            'site_name'    => $site_name,
            'site_subname' => $site_subname,
            'site_url'     => $site_url,

            // General Images
            'site_logo'   => "",
            'logo_width'  => 0,
            'logo_height' => 0,
            'bg_img'      => "",
            'banner_img'  => "img/banner.jpg",

            // Menu Items
            'menu_item' => array(
                0 => array(
                    "Home",
                    "index.php"
                ),
                1 => array(
                    "Rules",
                    "rules.php"
                ),
                2 => array(
                    "Discord",
                    "discord.php"
                ),
                3 => array(
                    "Servers",
                    "servers.php"
                ),
                4 => array(
                    "",
                    ""
                )
            ),

            // General Colors
            'logo_color'      => "rgba(255, 211, 42, 1)",
            'subname_color'   => "rgba(255, 255, 255, 1)",
            'bg_color'        => "rgba(0, 0, 0, 1)",
            'title_color'     => "rgba(255, 255, 255, 1)",
            'body_text_color' => "rgba(255, 255, 255, 1)",

            // Inactive Menu Colors
            'menu_text_color'         => "rgba(255, 255, 255, 1)",
            'menu_text_hover_color'   => "rgba(255, 255, 255, 1)",
            'menu_border_color'       => "rgba(52, 152, 219, 1)",
            'menu_border_hover_color' => "rgba(52, 152, 219, 1)",
            'menu_bg_color'           => "rgba(255, 255, 255, 0)",
            'menu_bg_hover_color'     => "rgba(52, 152, 219, 1)",

            // Active Menu Colors
            'menu_current_text_color'         => "rgba(255, 255, 255, 1)",
            'menu_current_text_hover_color'   => "rgba(255, 255, 255, 1)",
            'menu_current_border_color'       => "rgba(52, 152, 219, 1)",
            'menu_current_border_hover_color' => "rgba(52, 152, 219, 1)",
            'menu_current_bg_color'           => "rgba(52, 152, 219, 1)",
            'menu_current_bg_hover_color'     => "rgba(52, 152, 219, 1)",


            // Rules Colors
            'rules_text_color' => "rgba(255, 255, 255, 1)",
            'rules_odd_row'    => "rgba(2, 2, 2, 1)",
            'rules_even_row'   => "rgba(1, 1, 1, 1)",

            'rules' => array(
                0 => "Rule 1",
                1 => "Rule 2",
                2 => "Rule 3",
                3 => "",
                4 => "",
                5 => "",
                6 => "",
                7 => "",
                8 => ""
            ),

            'infobox' => array(
                0 => array(
                    'fas fa-rocket red-text',
                    'Lightning Fast Servers',
                    'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
                ),
                1 => array(
                    'fas fa-comments orange-text',
                    'Good Community',
                    'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
                ),
                2 => array(
                    'fas fa-shield-alt blue-text',
                    'Secure & Reliable',
                    'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
                )
            ),

            // Servers
            'servers' => array(
                0 => array(
                    "game" => 0,
                    "ip"   => '',
                    "port" => ''
                ),
            ),
        );

        if(file_exists($this->location . $this->filename))
        {
            // Delete file if already exists

            unlink($this->location . $this->filename);
            $fh = fopen($this->location . $this->filename, "w");
            $fw = fwrite($fh, json_encode($data));

            fclose($fh);
        }
        else
        {
            // Write new file if it dont

            $fh = fopen($this->location . $this->filename, "w");
            $fw = fwrite($fh, json_encode($data));

            fclose($fh);
        }
    }

    public function Update($parameter, $value)
    {
        $get   = file_get_contents($this->location . $this->filename);
        $items = json_decode($get, true);

        foreach($items as $item => $key)
        {
            if($item == $parameter)
            {
                $items[$item] = $value;
            }
        }

        $enc = json_encode($items);
        $fh  = fopen($this->location . $this->filename, "w");
        $fw  = fwrite($fh, $enc);

        fclose($fh);
    }

    public function Fetch($parameter, $extra = NULL)
    {
        $get  = file_get_contents($this->location . $this->filename);
        $data = json_decode($get, true);

        if($extra !== NULL)
        {
            return $data[$parameter][$extra];
        }

        return $data[$parameter];
    }

    public function Encrypt($data)
    {
        return sha1($data);
    }

    public function Installed()
    {
        if(file_exists(".lock"))
        {
            return true;
        }

        return false;
    }

    public function Lock()
    {
        $fh = fopen('.lock', "w");
        $fw = fwrite($fh, 'Remove this file to re-install!');
        fclose($fh);
    }

    public function CheckExtension($ext)
    {
        if(extension_loaded($ext))
        {
            return true;
        }

        return false;
    }

    public function GetINI($ext)
    {
        if(ini_get($ext))
        {
            return true;
        }

        return false;
    }
}

Class AdminCP
{
    private $filename = SETTINGS_DB;
    private $location = LOCATION;

    public function Login($password)
    {
        $data = new Data();

        $get = json_decode(file_get_contents($this->location . $this->filename), true);

        if($get['password'] == $data->Encrypt($password))
        {
            return true;
        }

        return false;
    }

    public function Logout()
    {
        if(isset($_SESSION['password']))
        {
            if(isset($_GET['logout']) && (int)$_GET['logout'] == 1)
            {
                session_start();
                session_destroy();

                header('Location: login.php');
                exit;
            }

            return false;
        }

        return false;
    }
}
