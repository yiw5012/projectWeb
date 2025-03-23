<?php
declare(strict_types=1);



// ตรวจสอบว่า session 'timestamp' ถูกตั้งค่า
if (isset($_SESSION['timestamp'])) {
    $events = getEvent();
    $student_id = (int) $_SESSION['student_id'];
    $result = getUserById($student_id);
    // รับค่าจาก URL (ค่าเหล่านี้จะถูกส่งผ่าน URL เมื่อฟอร์มถูกส่ง)
    $searchType = $_GET['search_type'] ?? 'title'; // ค่าเริ่มต้นเป็น 'title'
    $keyword = $_GET['keyword'] ?? ''; // ค่าคำค้นหาจากฟอร์ม
    $startDate = $_GET['start_date'] ?? ''; // ค่าวันที่เริ่มต้น
    $endDate = $_GET['end_date'] ?? ''; // ค่าวันที่สิ้นสุด

    // ตรวจสอบค่าที่ได้รับจากฟอร์ม
    // สามารถใช้ค่าที่ได้รับเพื่อคิวรีฐานข้อมูล
    // ตัวอย่างการค้นหาตามประเภท
    if ($searchType === 'title' && $keyword !== '') {
        $events = getEventsByKeyword($keyword);

        // ค้นหาตามชื่อกิจกรรม
        // เรียกฟังก์ชันหรือ SQL query ที่ใช้ $keyword ในการค้นหา
    } elseif ($searchType === 'date' && $startDate !== '' && $endDate !== '') {
        // ค้นหาตามช่วงเวลา
        $events = getEventsByDateRange($startDate, $endDate);

        // เรียกฟังก์ชันหรือ SQL query ที่ใช้ $startDate และ $endDate ในการค้นหา
    }

    renderView('home_get', array('result' => $result, 'events' => $events));


}else{

        $events = getEvent();
        renderView('home_get', array('events' => $events));
    }


?>
