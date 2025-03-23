<?php
declare(strict_types=1);
var_dump(value: $_GET);
echo''.$_GET['start_date'].''.$_GET['end_date'];
if (isset($_SESSION['student_id']) && is_numeric($_SESSION['student_id'])) {
    $events=getEvent();

    $student_id = (int) $_SESSION['student_id']; // แปลงให้เป็น int
    $result = getUserById($student_id);
    $keyword = $_GET['keyword'] ?? '';
    $searchType = $_GET['search_type'] ?? 'title'; // ถ้าไม่เลือกจะใช้ค่าเริ่มต้นเป็น 'title'
    if ($keyword !== '') {
        if ($searchType == 'title') {
            $events = getEventsByKeyword($keyword);

        } elseif ($searchType  == 'date' && isset($_GET['start_date']) && isset($_GET['end_date'])) {
            $start_date = $_GET['start_date'];
            $end_date = $_GET['end_date'];

            $events = getEventsByDateRange($start_date,endDate: $end_date);
        }
        renderView('home_get', array('result' => $result, 'events' => $events));


    }else{
        renderView('home_get', array('result' => $result, 'events' => $events));

    }



}else{
$events=getEvent();

renderView('home_get', array('events' => $events));
}
// ดึงข้อมูลผู้ใช้จากฐานข้อมูล


//renderView('home_get', array('result' => $result, 'events' => $events));

//renderView('home_get', array('result' => $result, 'events' => $events));

// เรียกใช้งานฟังก์ชัน renderView เพื่อแสดงผลในหน้า home_get.php
?>
