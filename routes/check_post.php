<?php
echo''.$_POST['otp'].''.$_POST['registration_id'];
if(walkin_check($_POST['registration_id'], $_POST['otp'],$_POST['event_id'])){
	if(walkin_update($_POST['registration_id'])) {
      if(walkin_update_regis($_POST['registration_id'])){
        echo "<script>
        alert('You OTP or Registration_id Are Not In the Data Base Plasee check you OTP or Registration_id');
      </script>";
      header('Location: /home');

      }

    }
}else {
    echo "<script>
            alert('You OTP or Registration_id Are Not In the Data Base Plasee check you OTP or Registration_id');
            window.history.back();
          </script>";
		  exit;
}