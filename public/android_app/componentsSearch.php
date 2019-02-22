<?php
    header('Content-Type: text/html; charset=utf-8');
	
	include_once 'configLocal.php';

/*	
$host='127.0.0.1';
$username='root';
$pwd='';
$db="praca_inz";

$con=mysqli_connect($host,$username,$pwd,$db) or die('Unable to connect');
*/

$con=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Unable to connect');

if(mysqli_connect_error($con)){
	
    echo "Failed to Connect to Database ".mysqli_connect_error();
}

$id_user = "";
    
    if(isset($_POST['id_user'])){
        
        $id_user = $_POST['id_user'];
        
    }
	
$type = "";
    
    if(isset($_POST['type'])){
        
        $type = $_POST['type'];
        
    }

$comp1 = "";
    
    if(isset($_POST['comp1'])){
        
        $comp1 = $_POST['comp1'];
        
    }
	
$comp2 = "";
    
    if(isset($_POST['comp2'])){
        
        $comp2 = $_POST['comp2'];
        
    }
	
$comp3 = "";
    
    if(isset($_POST['comp3'])){
        
        $comp3 = $_POST['comp3'];
        
    }
	
$comp4 = "";
    
    if(isset($_POST['comp4'])){
        
        $comp4 = $_POST['comp4'];
        
    }
	
$comp5 = "";
    
    if(isset($_POST['comp5'])){
        
        $comp5 = $_POST['comp5'];
        
    }


$data = array(); 

if($type==="1"){
$sql="SELECT recipes.id,name,main_photo,description,components,way_of_preparation,photo1,photo2,photo3,URL_video, favorite_recipes.id, rating
		FROM recipes LEFT JOIN favorite_recipes ON favorite_recipes.id_android_users= '$id_user' AND recipes.id=favorite_recipes.id_recipe 
					 LEFT JOIN opinions ON opinions.id_android_users = '$id_user' AND recipes.id = opinions.id_recipe WHERE recipes.components LIKE '%$comp1%' 
					 OR recipes.components LIKE '%$comp2%' OR recipes.components LIKE '%$comp3%' OR recipes.components LIKE '%$comp4%' OR recipes.components LIKE '%$comp5%'";
}else if($type==="2"){
$sql="SELECT recipes.id,name,main_photo,description,components,way_of_preparation,photo1,photo2,photo3,URL_video, favorite_recipes.id, rating
		FROM recipes LEFT JOIN favorite_recipes ON favorite_recipes.id_android_users= '$id_user' AND recipes.id=favorite_recipes.id_recipe 
					 LEFT JOIN opinions ON opinions.id_android_users = '$id_user' AND recipes.id = opinions.id_recipe WHERE recipes.components LIKE '%$comp1%' 
					 AND recipes.components LIKE '%$comp2%' AND recipes.components LIKE '%$comp3%' AND recipes.components LIKE '%$comp4%' AND recipes.components LIKE '%$comp5%'";	
}


//$result=mysqli_query($con,$sql);
//if($result)
//{
    //while($row=mysqli_fetch_assoc($result))
    //{
    //    $data[]=$row;
    //}
	
	//creating an statment with the query
	mysqli_set_charset($con, 'utf8'); 
$stmt = $con->prepare($sql);
 
//executing that statment
$stmt->execute();
 
//binding results for that statment 
$stmt->bind_result($id, $name, $main_photo, $description, $components, $way_of_preparation, $photo1, $photo2, $photo3, $URL_video, $favorite_recipes, $rating);
//$stmt->bind_result($id, $name);
 
//looping through all the records
while($stmt->fetch()){
	
	$temp = [
 'id'=>$id,
 'name'=>$name,
 'main_photo'=>$main_photo,
 'description'=>$description,
 'components'=>$components,
 'way_of_preparation'=>$way_of_preparation,
 'photo1'=>$photo1,
 'photo2'=>$photo2,
 'photo3'=>$photo3,
 'URL_video'=>$URL_video,
 'favorite_recipes'=>$favorite_recipes,
 'rating'=>$rating
 ];
	array_push($data, $temp);
	
	
}
	//var_dump($data);
    
//}
echo(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_ERROR_UTF8));
mysqli_close($con);

?>