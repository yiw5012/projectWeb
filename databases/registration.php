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
