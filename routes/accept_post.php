<?php
// $_POST['case'];
// $_POST['event_id'];
// $_POST['user_id'];

$reg_id =  registration_id_for_user($_POST['user_id']);
var_dump($reg_id); // ตรวจสอบค่าก่อนนำไปใช้

reject_or_accept($_POST['case'], $_POST['event_id'], $_POST['user_id'],$reg_id);

header('Location: /home');