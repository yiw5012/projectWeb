<?php

$statis = get_statistics_event($_GET['event_id']);
print_r($statis);
renderView("detil_get",array( 'statistics' => $statis));
