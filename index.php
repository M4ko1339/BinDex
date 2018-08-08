<?php

include('header.php');

?>

<div class="row">
    <div class="container">
        <?php foreach($data->Fetch('infobox') as $row): ?>
            <?php if($row[0] !== "" && $row[1] !== "" && $row[2] !== ""): ?>
                <div class="content col s12 m4">
                    <div class="card col s12">
                        <div class="card-icon">
                            <i class="<?php echo $row[0]; ?>"></i>
                        </div>

                        <div class="card-content">
                            <span class="card-title"><?php echo $row[1]; ?></span>

                            <p><?php echo $row[2]; ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<?php

include('footer.php');

?>
