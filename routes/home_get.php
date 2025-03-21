<?php
declare(strict_types=1);


if (isset($_SESSION['student_id']) && is_numeric($_SESSION['student_id'])) {
    $student_id = (int) $_SESSION['student_id']; // แปลงให้เป็น int
    $result = getUserById($student_id);
    $events=getEvent();
    $keyword = $_GET['keyword'] ?? '';
    $searchType = $_GET['search_type'] ?? 'title'; // ถ้าไม่เลือกจะใช้ค่าเริ่มต้นเป็น 'title'
    
    if ($keyword !== '') {
        if ($searchType === 'title') {
            $events = getEventsByKeyword($keyword);
        } elseif ($searchType === 'date') {
            $events = getEventsByDate($keyword);
        }
    }
    renderView('home_get', array('result' => $result, 'events' => $events));


}else{
    $events=getEvent();
$keyword = $_GET['keyword'] ?? '';
$searchType = $_GET['search_type'] ?? 'title'; // ถ้าไม่เลือกจะใช้ค่าเริ่มต้นเป็น 'title'

if ($keyword !== '') {
    if ($searchType === 'title') {
        $events = getEventsByKeyword($keyword);
    } elseif ($searchType === 'date') {
        $events = getEventsByDate($keyword);
    }
}
    renderView(template: 'home_get');
}
// ดึงข้อมูลผู้ใช้จากฐานข้อมูล


//renderView('home_get', array('result' => $result, 'events' => $events));

//renderView('home_get', array('result' => $result, 'events' => $events));

// เรียกใช้งานฟังก์ชัน renderView เพื่อแสดงผลในหน้า home_get.php
?>
