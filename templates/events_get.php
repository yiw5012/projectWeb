<section>
    <h1>Students</h1>
    <?php
    while ($row = $data['result']->fetch_object()) {
    ?>
        <?= json_encode($row) ?>
        <br>
    <?php
    }
    ?>
</section>