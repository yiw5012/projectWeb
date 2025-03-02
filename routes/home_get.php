<?php
// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$result = getUserById($_SESSION['student_id']);
// $events=getEvent();

if(isset($_GET['keyword'])) {
    $events = getEventby_keyword($_GET['keyword']);
    renderView('events_get',array('result' => $result,'events'=>$events));
}else{
    // in case !isset($_GET['keyword']) || $_GET['keyword'] == ''
    $events = getEvent();
    renderView('events_get',array('result' => $result,'events'=>$events));
}

// เรียกใช้งานฟังก์ชัน renderView เพื่อแสดงผลในหน้า home_get.php
// renderView('home_get', array('result' => $result,'events'=>$events));
?>
