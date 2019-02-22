<?php
    header('Content-Type: text/html; charset=utf-8');
	
	include_once 'configLocal.php';

$con=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Unable to connect');

if(mysqli_connect_error($con))
{
    echo "Failed to Connect to Database ".mysqli_connect_error();
}


	
$id_user = "";
    
    if(isset($_POST['id_user'])){
        
        $id_user = $_POST['id_user'];
        
    }

$data = array(); 

$sql="SELECT name FROM recipes";

	if($id_user != ""){
	//creating an statment with the query
	mysqli_set_charset($con, 'utf8'); 
$stmt = $con->prepare($sql);
 
//executing that statment
$stmt->execute();
 
//binding results for that statment 
$stmt->bind_result($name);
//$stmt->bind_result($id, $name);
 
//looping through all the records
while($stmt->fetch()){
	
	$temp = [
 'name'=>$name
 ];
	array_push($data, $temp);
		
}

echo(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_ERROR_UTF8));
mysqli_close($con);
	}
?>