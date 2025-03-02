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
