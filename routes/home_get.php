<?php
declare(strict_types=1);
// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$result = getUserById($_SESSION['student_id']);
$events=getEvent();

if (!isset($_GET['keyword'])) {
    renderView('home_get', array('result' => $result,'events'=>$events));
} elseif ($_GET['keyword'] == '') {
    $events=getEvent();
    renderView('home_get', array('result' => $result,'events'=>$events));
} else {
    $events = getEventsByKeyword($_GET['keyword']);
    renderView('home_get', array('result' => $result,'events'=>$events));

}
// เรียกใช้งานฟังก์ชัน renderView เพื่อแสดงผลในหน้า home_get.php
?>
