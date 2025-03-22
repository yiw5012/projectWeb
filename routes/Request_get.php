<?php
$result = get_registered_users_by_creator($_SESSION['student_id']);

$statis = get_statistics($_SESSION['student_id']);
print_r($statis);
renderView("request_get",array('result' => $result, 'statistics' => $statis));
