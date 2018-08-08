<?php

Class Servers
{
    private $filename = SERVERS_DB;
    private $location = LOCATION;

    public function Create()
    {
        $data = array(
            "servers" => array(
                0 => array(
                    "game" => 4000,
                    "ip"   => "127.0.0.1",
                    "port" => 27015
                )
            )
        );

        if(file_exists($this->location . $this->filename))
        {
            unlink($this->location . $this->filename);
            $fh = fopen($this->location . $this->filename, "w");
            $fw = fwrite($fh, json_encode($data));

            fclose($fh);
        }
        else
        {
            $fh = fopen($this->location . $this->filename, "w");
            $fw = fwrite($fh, json_encode($data));

            fclose($fh);
        }
    }

    public function Add($parameter, $value)
    {
        $get   = file_get_contents($this->location . $this->filename);
        $items = json_decode($get, true);

        foreach($items as $item => $key)
        {
            if($item == $parameter)
            {
                var_dump($items[$i][$item] = $value);
            }
        }

        $enc = json_encode($items);
        $fh  = fopen($this->location . $this->filename, "a");
        $fw  = fwrite($fh, $enc);

        fclose($fh);
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
}
