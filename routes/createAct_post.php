<?php
// $_POST["actname"];
// $_POST["detailact"];
// $_POST["location"];
// $_POST["dateevent"];
// $_POST["actname"];
// $_POST["dateregisterend"];
// $_POST["maxregister"];
// echo ($_POST["actname"] . $_POST["detailact"] . $_POST["location"] . $_POST["detailact"] . $_POST["dateevent"] . $_POST["actname"] . $_POST["dateregisterend"] . $_POST["maxregister"]);

if (insertEvent(getmax_eventid(), $_POST["actname"], $_POST["detailact"],  $_POST["dateevent"], $_POST["location"], $_POST["maxregister"], $_SESSION['student_id'], $_POST['image'])) {
    header('Location: /');
} else {
    echo "<script>
    alert('Can not add Event Please try again.');
</script>";
    return;
}
// insertEvent(getmax_eventid(), $_POST["actname"], $_POST["detailact"],  $_POST["dateevent"], $_POST["location"], $_POST["maxregister"], $_SESSION['student_id'], $_POST['image']);

// *** sessint['student_id'] == sesstion['user_id'] fix later!!!