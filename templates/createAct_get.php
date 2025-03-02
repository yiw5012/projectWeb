<form action="crateAct" method="post">
<h3>Name Act</h3>
<input type="text" name="actname" id="actname"><br>

<h5>detail act</h5>
<input type="text" name="detailact" id="detailact"><br>

<h5>location</h5>
<input type="text" name="location" id="location"><br>

<h5>date_in_event</h5>
<input type="date" name="dateevent" id="dateevent"><br>

<h3>data_for_register</h3>
<input type="text" name="dateregisterend" id="dateregisterend"><br>

<h5>max_for_register</h5>
<input type="text" name="maxregister" id="maxregister"><br>

<h5>image uri</h5>
<input type="text" name="image" id="image"><br>

<button type="submit"  name="user_id" value="<?= $_SESSION['student_id'] ?>" >crate_event</button>    
</form>
<!-- value="<?= $_SESSION['user_id'] ?>" -->



