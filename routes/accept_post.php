<?php
// $_POST['case'];
// $_POST['event_id'];
// $_POST['user_id'];

$reg_id =  registration_id_for_user_event($_POST['user_id'],$_POST['event_id']);
var_dump($reg_id); // ตรวจสอบค่าก่อนนำไปใช้
if ($reg_id <= 0) {
    // แสดงข้อความแสดงข้อผิดพลาด หรือออกจากฟังก์ชันไปเลย
    echo "ไม่พบ registration_id สำหรับผู้ใช้";
    exit;
}

reject_or_accept($_POST['case'], $_POST['event_id'], $_POST['user_id'],$reg_id);

header('Location: /home');