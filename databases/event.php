<?php
function getEvent(): mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'select * from events';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}
function getEventsByKeyword(string $keyword): mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'select * from events where title_event like ?';
    $stmt = $conn->prepare($sql);
    $keyword = "%{$keyword}%"; // ต้องเติม `%` รอบคำค้นหา
    $stmt->bind_param('s', $keyword);
    $res = $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
function CreateACT($id, $actname, $detailact, $location, $dateevent, $maxregister, $images)
{
    $conn = getConnection(); // ตรวจสอบการเชื่อมต่อ
    if (!$conn) {
        echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้.";
        return false;
    }

    $date_reg = date('Y-m-d');
    $uploadedImages = [];

    // ตรวจสอบการอัปโหลดไฟล์หลายไฟล์
    if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
        for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
            $tmp_name = $_FILES['images']['tmp_name'][$i];
            $imageName = uniqid() . '-' . $_FILES['images']['name'][$i];
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . $imageName;

            // ตรวจสอบว่าไฟล์มีข้อผิดพลาดหรือไม่
            if ($_FILES['images']['error'][$i] != 0) {
                echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์ที่ " . $_FILES['images']['name'][$i];
                return false;
            }

            // ตรวจสอบประเภทไฟล์
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];  // สามารถเพิ่มประเภทที่ต้องการได้
            if (!in_array($_FILES['images']['type'][$i], $allowedTypes)) {
                echo "ไฟล์ " . $_FILES['images']['name'][$i] . " ไม่สามารถอัปโหลดได้ เพราะไม่ใช่ประเภทที่รองรับ.";
                return false;
            }

            // ตรวจสอบขนาดไฟล์
            if ($_FILES['images']['size'][$i] > 5000000) {  // 5MB
                echo "ไฟล์ " . $_FILES['images']['name'][$i] . " มีขนาดใหญ่เกินไป.";
                return false;
            }

            // อัปโหลดไฟล์
            if (move_uploaded_file($tmp_name, $uploadFile)) {
                $uploadedImages[] = $uploadFile;
            } else {
                echo "ไม่สามารถอัปโหลดไฟล์ " . $_FILES['images']['name'][$i];
                return false;
            }
        }
    }

    // รวมที่อยู่ของไฟล์หลายไฟล์เป็นสตริงเดียว
    $images = implode(',', $uploadedImages);

    // คำสั่ง SQL ที่ต้องการ
    $sql = 'INSERT INTO events (title_event, description, date_time, date_reg, location, max_capacity, created_by, images) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);

    // ตัวแปรสำหรับค่าที่จะถูกส่งเข้า bind_param    
    $stmt->bind_param("sssssiis", $actname, $detailact, $dateevent, $date_reg, $location, $maxregister, $id, $images);

    try {
        // ดำเนินการ SQL
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // อัปเดต role ของผู้ใช้
            $role = 'creator';
            $sql = 'UPDATE users SET role = ? WHERE user_id = ?';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $role, $id); 
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo 'Update completed';
            } else {
                echo 'Update failed';
            }
            return true;
        } else {
            echo "ไม่สามารถลงทะเบียนกิจกรรมได้.";
            return false;
        }
    } catch (Exception $e) {
        echo "เกิดข้อผิดพลาด: " . $e->getMessage();
        return false;
    }
}


function getEventby_keyword($keyword): mysqli_result|bool
{

    $conn = getConnection();
    $sql = 'select * from events where title_event like ?';
    $stmt = $conn->prepare($sql);
    $keyword = '%' . $keyword . '%';
    $stmt->bind_param('s', $keyword);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}

function getmax_eventid(): int
{
    $conn = getConnection();
    $sql = 'SELECT MAX(event_id) as max_id FROM events';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $maxid = $result->fetch_object()->max_id ?? 0;

    return $maxid + 1;
}

function insertEvent($event_id, $title_event, $description, $date_time, $location, $max_capacity, $created_by, $images)
{
    $conn = getConnection();
    $sql = 'insert into events (event_id, title_event, description, date_time, location, max_capacity, created_by, images) VALUES (?,?,?,?,?,?,?,?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('issssiis', $event_id, $title_event, $description, $date_time, $location, $max_capacity, $created_by, $images);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
    // issssiis

}
function getEventby_id($event_id): mysqli_result|bool
{

    $conn = getConnection();
    $sql = 'select * from events where event_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}

function update_byid($title_event, $description, $date_time, $location, $max_capacity, $event_id, $images): bool
{ 
    if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
        for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
            $tmp_name = $_FILES['images']['tmp_name'][$i];
            $imageName = uniqid() . '-' . $_FILES['images']['name'][$i];
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . $imageName;

            // ตรวจสอบว่าไฟล์มีข้อผิดพลาดหรือไม่
            if ($_FILES['images']['error'][$i] != 0) {
                echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์ที่ " . $_FILES['images']['name'][$i];
                return false;
            }

            // ตรวจสอบประเภทไฟล์
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];  // สามารถเพิ่มประเภทที่ต้องการได้
            if (!in_array($_FILES['images']['type'][$i], $allowedTypes)) {
                echo "ไฟล์ " . $_FILES['images']['name'][$i] . " ไม่สามารถอัปโหลดได้ เพราะไม่ใช่ประเภทที่รองรับ.";
                return false;
            }

            // ตรวจสอบขนาดไฟล์
            if ($_FILES['images']['size'][$i] > 5000000) {  // 5MB
                echo "ไฟล์ " . $_FILES['images']['name'][$i] . " มีขนาดใหญ่เกินไป.";
                return false;
            }

            // อัปโหลดไฟล์
            if (move_uploaded_file($tmp_name, $uploadFile)) {
                $uploadedImages[] = $uploadFile;
            } else {
                echo "ไม่สามารถอัปโหลดไฟล์ " . $_FILES['images']['name'][$i];
                return false;
            }
        }
    }

    // รวมที่อยู่ของไฟล์หลายไฟล์เป็นสตริงเดียว
    $images = implode(',', $uploadedImages);
    $conn = getConnection();
    $sql = 'UPDATE events SET title_event = ?, description = ?, date_time = ?, location = ?, max_capacity = ?,images = ? WHERE event_id = ?';
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false; // If statement preparation fails
    }

    $stmt->bind_param('ssssisi', $title_event, $description, $date_time, $max_capacity, $location, $images, $event_id);
    $success = $stmt->execute();

    // Check if any row was actually updated
    return $stmt->affected_rows > 0;
}

function editEvent_if_creater($event_id, $user_id)
{
    $conn = getConnection();
    $sql = 'SELECT event_id, created_by from events WHERE event_id = ? and created_by = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $event_id, $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}
