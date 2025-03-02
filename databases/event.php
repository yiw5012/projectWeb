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
    $stmt->bind_param('s',$keyword);
    $res = $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
function CreateACT($id, $actname, $detailact, $location, $dateevent, $maxregister) {
    $conn = getConnection();
    $date_reg = date('Y-m-d'); 

    // คำสั่ง SQL ที่ต้องการ
    $sql = 'INSERT INTO events (title_event, description, date_time, date_reg, location, max_capacity, created_by, images) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);

    // ตัวแปรสำหรับค่าที่จะถูกส่งเข้า bind_param
    $images = NULL; // กรณีที่ไม่ใช้ค่า images หรือคุณสามารถส่งค่าของรูปภาพในตัวแปรนี้ได้
    
    // ปรับการใช้ bind_param ให้ถูกต้อง
    $stmt->bind_param("sssssisi", $actname, $detailact, $dateevent, $date_reg, $location, $maxregister, $id, $images);

    try {
        // ดำเนินการ SQL
        $stmt->execute();
        $role = 'creator';
        if ($stmt->affected_rows > 0) {
            $sql = 'UPDATE users SET role = ? WHERE user_id = ?';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $role, $id); // ปรับให้ตรงกับประเภทพารามิเตอร์
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo 'Update completed';
            } else {
                echo 'Update failed';
            }
            return true;
        } else {
            echo "ไม่สามารถลงทะเบียนวิชานี้ได้.";
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

function getmax_eventid():int {
    $conn = getConnection();
    $sql = 'SELECT MAX(event_id) as max_id FROM events';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $maxid = $result->fetch_object()->max_id ?? 0;

    return $maxid+1;
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
