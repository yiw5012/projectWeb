<?php
declare(strict_types=1);


if (isset($_SESSION['student_id']) && is_numeric($_SESSION['student_id'])) {
    $student_id = (int) $_SESSION['student_id']; // แปลงให้เป็น int
    $result = getUserById($student_id);
}
// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$events=getEvent();

if (!isset($_GET['keyword'])) {
    renderView('home_get', array('events'=>$events));
} elseif ($_GET['keyword'] == '') {
    $events=getEvent();
    renderView('home_get', array('result' => $result,'events'=>$events));
} else {
    $events = getEventsByKeyword($_GET['keyword']);
    renderView('home_get', array('result' => $result,'events'=>$events));

}
//renderView('home_get', array('result' => $result, 'events' => $events));

// เรียกใช้งานฟังก์ชัน renderView เพื่อแสดงผลในหน้า home_get.php
?>
