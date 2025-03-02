<?php
$result = getEventby_id($_GET['event_id']);
renderView('EditAct_get',array('result' => $result));