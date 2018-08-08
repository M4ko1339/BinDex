<?php

include('header.php');

?>

<div class="row">
    <div class="container">
        <div class="content col s12">
            <div class="content-header col s12">
                RULES
            </div>

            <div class="content-content col s12">
                <ul class="rules-list">
                    <?php foreach($data->Fetch('rules') as $row): ?>
                        <?php if($row !== ""): ?>
                            <li><?php echo $row; ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php

include('footer.php');

?>
