<?php
$result = get_registered_users_by_creator($_SESSION['student_id']);

$statis = statistics_for_all('',array('event' => $result));
print_r($statis);
renderView("request_get",array('result' => $result, 'statistics' => $statis));
