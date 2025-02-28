<?php
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']);  
}
if (isset($_SESSION['message_D'])) {
    echo "<script>alert('" . $_SESSION['message_D'] . "');</script>";
    unset($_SESSION['message_D']);  
}

function getStudentEnrollmentByStudentId(int $studentId): mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'SELECT
    c.course_id,
    c.course_name,
    c.course_code,
    c.instructor,
    e.enrollment_id,
    e.enrollment_date,
    s.student_id
    FROM
    enrollment.courses c
    INNER JOIN enrollment.enrollment e ON
    c.course_id = e.course_id
    INNER JOIN enrollment.students s ON
    e.student_id = s.student_id where s.student_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
function ADDEnroll(int $course_id): bool
{
    $student_id = $_SESSION['student_id'];
    
    $conn = getConnection();
    $sql = "SELECT * FROM enrollment WHERE student_id = ? AND course_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $student_id, $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return false; 
    }
    
    $enrollment_date = date('Y-m-d'); 

    $sql = 'INSERT INTO enrollment ( student_id, course_id, enrollment_date) 
            VALUES (?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $student_id, $course_id, $enrollment_date);

    try {
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
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




function deleteEnroll(int $course_id): bool
{
    $student_id = $_SESSION['student_id'];

    $conn = getConnection();

    $sql = "DELETE FROM enrollment WHERE student_id = ? AND course_id = ?";
    $stmt = $conn->prepare($sql);


    $stmt->bind_param("is", $student_id, $course_id);

    try {
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true; 
        } else {
            echo "ไม่พบการลงทะเบียนที่ต้องการลบ.";
            return false;
        }
    } catch (Exception $e) {
        echo "เกิดข้อผิดพลาด: " . $e->getMessage();
        return false;
    }
}


