<?php
// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$result = getUserById($_SESSION['student_id']);
$events=getEvent();

// เรียกใช้งานฟังก์ชัน renderView เพื่อแสดงผลในหน้า home_get.php
renderView('home_get', array('result' => $result,'events'=>$events));
?>
