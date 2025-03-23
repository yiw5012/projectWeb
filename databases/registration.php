<?php
function get_registered_users_by_creator($creator_id): mysqli_result|bool
{
    $conn = getConnection();
    $sql = '
        SELECT 
            users.name, 
            users.age, 
            users.gender,
            registration.user_id, 
            registration.event_id, 
            events.title_event
        FROM registration
        INNER JOIN users ON registration.user_id = users.user_id
        INNER JOIN events ON registration.event_id = events.event_id
        WHERE events.created_by = ? AND registration.status = ?
    ';

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }

    $status = "pending"; // สถานะที่ต้องการกรอง
    $stmt->bind_param('is', $creator_id, $status);
    $stmt->execute();

    return $stmt->get_result();
}

function registration($event_id, $user_id)
{
    $conn = getConnection();
    $sql = 'INSERT INTO registration (user_id, event_id) VALUES (?,?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $user_id, $event_id);
    $stmt->execute();

    return $stmt->get_result();
}
function registration_id_for_user_event($user_id, $event_id): int {
    $conn = getConnection();
    $sql = 'SELECT registration_id FROM registration WHERE user_id = ? AND event_id = ? LIMIT 1';
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // สามารถบันทึกข้อผิดพลาดหรือคืนค่า 0 ได้
        return 0;
    }
    $stmt->bind_param('ii', $user_id, $event_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['registration_id'] ?? 0; // คืนค่า 0 หากไม่พบข้อมูล
}


function reject_or_accept($case, $event_id, $user_id,$reg_id)
{


    $status = 'pending';
    $conn = getConnection();
    $sql = 'UPDATE registration SET status = ? WHERE  user_id = ? and event_id = ?';

    switch ($case) {
        case 1:
            $status = 'approved';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sii', $status, $user_id, $event_id);
            $stmt->execute();

            $otp = rand();            
            $con = getConnection();
            $sq = 'INSERT INTO attendance (registration_id ,otp_used) VALUES (?,?)';
            
            $stm = $con->prepare($sq);
            $stm->bind_param('ii', $reg_id,$otp);
            $stm->execute();

            break;

        case 2:
            $status = 'rejected';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sii', $status, $user_id, $event_id);
            $stmt->execute();
            break;
    }
   
}


function event_ever_rejected($user_id): mysqli_result|bool
{
    $status = 'rejected';

    $conn = getConnection();
    $sql = 'SELECT * FROM 
    registration 
    INNER JOIN events ON registration.event_id = events.event_id
    WHERE user_id = ? and status = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $user_id, $status);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}
function event_ever_pending($user_id): mysqli_result|bool
{
    $status = 'pending';

    $conn = getConnection();
    $sql = 'SELECT * FROM 
    registration 
    INNER JOIN events ON registration.event_id = events.event_id
    WHERE user_id = ? and status = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $user_id, $status);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}
function otp_for_user($user_id, $event_id) {
    $conn = getConnection();
    $sql = 'SELECT otp_used, attendance.registration_id
            FROM attendance 
            INNER JOIN registration ON attendance.registration_id = registration.registration_id
            WHERE registration.user_id = ? AND registration.event_id = ?';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $user_id, $event_id);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc(); // Returns an associative array (or null if not found)

    
    
}

function not_allow_two($user_id, $event_id): bool {
    $conn = getConnection();
    $sql = 'SELECT * FROM registration WHERE user_id = ? AND event_id = ?';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $user_id, $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return true; // User is already registered
    } else {
        return ur_creater($event_id, $user_id);
    }
}

function ur_creater($event_id, $created_by): bool {
    $conn = getConnection();
    $sql = 'SELECT * FROM events WHERE event_id = ? AND created_by = ?';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $event_id, $created_by);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows > 0; // Returns true if the user is the creator of the event
}

function event_ever_regis($user_id): mysqli_result|bool
{
    $status = 'approved';

    $conn = getConnection();
    $sql = 'SELECT * FROM 
    registration 
    INNER JOIN events ON registration.event_id = events.event_id
    WHERE user_id = ? and status = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $user_id, $status);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}

function get_statistics($creator_id) {
    $conn = getConnection();
    $sql = "
        SELECT 
            SUM(CASE WHEN users.gender = 'male' THEN 1 ELSE 0 END) AS male_count,
            SUM(CASE WHEN users.gender = 'female' THEN 1 ELSE 0 END) AS female_count,
            AVG(users.age) AS avg_age
        FROM registration
        INNER JOIN users ON registration.user_id = users.user_id
        INNER JOIN events ON registration.event_id = events.event_id
        WHERE events.created_by = ? AND registration.status = 'pending'
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param('i', $creator_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    // Store data in the session
    $_SESSION['graph'] = [
        'male' => $result['male_count'] ?? 0,
        'female' => $result['female_count'] ?? 0,
        'avg_age' => round($result['avg_age'] ?? 0, 2)
    ];
}

function get_statistics_event($creator_id) {
    $conn = getConnection();
    $sql = "
        SELECT 
            SUM(CASE WHEN users.gender = 'male' THEN 1 ELSE 0 END) AS male_count,
            SUM(CASE WHEN users.gender = 'female' THEN 1 ELSE 0 END) AS female_count,
            AVG(users.age) AS avg_age
        FROM registration
        INNER JOIN users ON registration.user_id = users.user_id
        INNER JOIN events ON registration.event_id = events.event_id
        WHERE events.event_id = ? AND registration.status = 'approved'
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param('i', $creator_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    // Ensure no null values (default to 0)
    return [
        'male' => $result['male_count'] ?? 0,
        'female' => $result['female_count'] ?? 0,
        'avg_age' => round($result['avg_age'] ?? 0, 2) // Round for better readability
    ];
}

