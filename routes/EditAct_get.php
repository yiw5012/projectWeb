<?php
$result = getEventby_id($_GET['event_id']);
renderView('editact_get',array('result' => $result));