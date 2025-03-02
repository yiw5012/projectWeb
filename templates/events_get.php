<section>
    <h1>Students</h1>
    <form action="event" method="get">
        <input type="text" name="keyword" />
        <button type="submit">Search</button>
    </form>
    <?php
    while ($row = $data['result']->fetch_object()) {
    ?>
        <?= json_encode($row) ?>
        <br>
    <?php
    }
    ?>
</section>