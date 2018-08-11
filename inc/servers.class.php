<?php

Class Servers
{
    private $filename = SERVERS_DB;
    private $location = LOCATION;

    public function Create()
    {
        $data = "";

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

    public function Add($data)
    {
        $get   = file_get_contents($this->location . $this->filename);
        $items = json_decode($get, true);

        $items["servers"][] = $data;

        $enc = json_encode($items);
        $fh  = fopen($this->location . $this->filename, "w");
        $fw  = fwrite($fh, $enc);

        fclose($fh);
    }

    public function Update($id, $parameter, $value)
    {
        $get   = file_get_contents($this->location . $this->filename);
        $items = json_decode($get, true);

        foreach($items["servers"] as $item => $key)
        {
            if($item == $id)
            {
                $items["servers"][$item][$parameter] = $value;
            }
        }

        $enc = json_encode($items);
        $fh  = fopen($this->location . $this->filename, "w");
        $fw  = fwrite($fh, $enc);

        fclose($fh);
    }

    public function Delete($id)
    {
        $get   = file_get_contents($this->location . $this->filename);
        $items = json_decode($get, true);

        foreach($items["servers"] as $item => $key)
        {
            if($item == $id)
            {
                unset($items["servers"][$id]);
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
