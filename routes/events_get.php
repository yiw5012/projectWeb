<?php
$result = getEvent();
renderView('events_get',array('result' => $result));