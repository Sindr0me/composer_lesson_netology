<?php 
$data = $_POST;
if (isset($data['adress'])){
echo $_POST['adress'];}
?>

<form  method="post" action ="index.php" enctype="multipart/form-data">
	<input type="text" name="adress" placeholder="Введите адрес">
	<input type="submit" value="Найти" name="get_coord">
</form>
