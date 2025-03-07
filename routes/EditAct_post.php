<?php
// รับค่าจากฟอร์ม และใช้ trim() เพื่อลบช่องว่าง
$title = trim($_POST["title"] ?? "");
$detil = trim($_POST["detil"] ?? "");
$location = trim($_POST["localion"] ?? "");
$date_time = trim($_POST["date_time"] ?? "");
$max = trim($_POST["max"] ?? "");
$id = trim($_POST["id"] ?? "");

// ตรวจสอบว่าฟังก์ชัน ADDEnroll มีอยู่หรือไม่
// ส่งค่าที่ตรวจสอบแล้วไปที่ ADDEnroll
$uploadedImages = [];
if (isset($_FILES['image']) && $_FILES['image']['error'][0] == 0) {
    // วนลูปเพื่อจัดการไฟล์ที่อัปโหลด
    for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
        $tmp_name = $_FILES['image']['tmp_name'][$i];
        $imageName = uniqid() . '-' . $_FILES['image']['name'][$i];
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . $imageName;

        // ตรวจสอบการอัปโหลดและย้ายไฟล์
        if (move_uploaded_file($tmp_name, $uploadFile)) {
            $uploadedImages[] = $uploadFile; // เก็บที่อยู่ของไฟล์ที่อัปโหลด
        }
    }
}

$images = implode(',', $uploadedImages); // รวมที่อยู่ของไฟล์ภาพหลายไฟล์เป็นสตริงเดียว

$res = update_byid($title, $detil, $date_time,$max,$location,$id,$uploadFile);

if ($res) {
    $_SESSION['message'] = 'การแก้ไขนสำเร็จ';
    header('Location: /home');
    exit;
} else {
    $_SESSION['message'] = 'เกิดข้อผิดพลาด';
    header('Location: /');
    exit;
}
