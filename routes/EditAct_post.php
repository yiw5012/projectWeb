<?php
session_start(); // ต้องมีเพื่อใช้ $_SESSION

// รับค่าจากฟอร์มและใช้ trim() เพื่อลบช่องว่าง
$title = trim($_POST["title"] ?? "");
$detil = trim($_POST["detil"] ?? "");
$location = trim($_POST["localion"] ?? ""); // แก้ไขชื่อให้ตรงกัน
$date_time = trim($_POST["date_time"] ?? "");
$max = trim($_POST["max"] ?? "");
$id = trim($_POST["id"] ?? "");
$old_images = trim($_POST['old_image'] ?? "");

// ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
$uploadedImages = [];
if (isset($_FILES['images']) && is_array($_FILES['images']['name'])) {
    $uploadDir = 'uploads/';
    foreach ($_FILES['images']['name'] as $index => $name) {
        $tmp_name = $_FILES['images']['tmp_name'][$index];
        $error = $_FILES['images']['error'][$index];

        if ($error === UPLOAD_ERR_OK) {
            $imageType = mime_content_type($tmp_name);
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($imageType, $allowedTypes)) {
                $imageName = uniqid() . '-' . basename($name);
                $uploadFile = $uploadDir . $imageName;

                if (move_uploaded_file($tmp_name, $uploadFile)) {
                    $uploadedImages[] = $uploadFile;
                }
            }
        }
    }
}

// กำหนดค่า $images ให้เป็น NULL หรือใช้รูปเดิมหากไม่มีไฟล์ใหม่
$images = !empty($uploadedImages) ? implode(',', $uploadedImages) : $old_images;

// เรียกใช้ฟังก์ชันอัปเดตข้อมูล
$res = update_byid($title, $detil, $date_time, $location, $max, $id, $images);

if ($res) {
    $_SESSION['message'] = 'การแก้ไขสำเร็จ';
    header('Location: /home');
    exit;
} else {
    $_SESSION['message'] = 'เกิดข้อผิดพลาด';
    header('Location: /');
    exit;
}
