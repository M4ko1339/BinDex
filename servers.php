<?php

include('header.php');

$srv = new Servers();

$string = '{"servers":[{"game":4000,"ip":"127.0.0.1","port":27015}]}';
$data = array(
    0 => array(
        "game" => 100,
        "ip"   => '100.100.0.100',
        "port" => 10200
    )
);

$dec = json_decode($string, true);


$new = json_encode(array(
    1 => array(
        "game" => 1022,
        "ip"   => '1200.1200.0.1200',
        "port" => 222
)));

$decode = json_decode($new, true);

var_dump($decode);

/*
foreach( as $row)
{
    require __DIR__ . '/SourceQuery/bootstrap.php';

    use xPaw\SourceQuery\SourceQuery;

    define('SQ_SERVER_ADDR', $server);
    define('SQ_SERVER_PORT', $port);
    define('SQ_TIMEOUT',     1);
    define('SQ_ENGINE',      SourceQuery::SOURCE);

    $Query = new SourceQuery( );

    try
    {
    	$Query->Connect(SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE);

    	$info    = $Query->GetInfo();
    	$players = $Query->GetPlayers();
    }
    catch(Exception $e)
    {
    	die($e->getMessage());
    }
    finally
    {
    	$Query->Disconnect();
    }
}
*/
?>

<div class="row">
    <div class="container">
        <div class="content col s12">
            <div class="content-header col s12">
                SERVERS
            </div>

            <div class="content-content col s12">

            </div>
        </div>
    </div>
</div>

<?php

include('footer.php');

?>
