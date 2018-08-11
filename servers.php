<?php

require __DIR__ . '/SourceQuery/bootstrap.php';
use xPaw\SourceQuery\SourceQuery;

function SourceEngine($ip, $port)
{
    $Query = new SourceQuery();

    try
    {
        $Query->Connect($ip, $port, 1, SourceQuery::SOURCE);

        return $Query->GetInfo();
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

include('header.php');

$srv = new Servers();

?>

<div class="row">
    <div class="container">
        <div class="content col s12">
            <div class="content-header col s12">
                SERVERS
            </div>

            <div class="content-content col s12">
                <?php foreach($srv->Fetch("servers") as $row): ?>
                    <?php $game = array_keys($games, $row['game']); ?>
                    <?php $src = SourceEngine($row['ip'], $row['port']); ?>
                    <div class="col s12 m4">
                        <div class="server-card col s12">
                            <div class="server-card-header <?php echo $row['color']; ?>">
                                <?php echo substr($src['HostName'], 0, 36); ?>
                            </div>

                            <div class="server-card-content">
                                <div class="card-content-line col s12">
                                    <b>Game:</b> <?php echo $game[0]; ?>
                                </div>

                                <div class="card-content-line col s12">
                                    <b>Gamemode:</b> <?php echo $src['ModDesc']; ?>
                                </div>

                                <div class="card-content-line col s12">
                                    <b>Players:</b> <?php echo $src['Players']; ?> / <?php echo $src['MaxPlayers']; ?>
                                </div>

                                <div class="card-content-line col s12">
                                    <b>Map:</b> <?php echo $src['Map']; ?>
                                </div>

                                <div class="card-content-line col s12">
                                    <a href="steam://connect/<?php echo $row['ip']; ?>:<?php echo $row['port']; ?>" class="btn connect-button">Connect</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php

include('footer.php');

?>
