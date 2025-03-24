<?php

$statis = get_statistics_event($_GET['event_id']);
renderView("detil_get",array( 'statistics' => $statis));
