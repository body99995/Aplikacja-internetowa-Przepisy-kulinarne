<?php
    header('Content-Type: text/html; charset=utf-8');
	
$host='127.0.0.1';
$username='root';
$pwd='';
$db="praca_inz";

$con=mysqli_connect($host,$username,$pwd,$db) or die('Unable to connect');

if(mysqli_connect_error($con))
{
    echo "Failed to Connect to Database ".mysqli_connect_error();
}


$category = "";
    
    if(isset($_POST['category'])){
        
        $category = $_POST['category'];
        
    }
	
$id_user = "";
    
    if(isset($_POST['id_user'])){
        
        $id_user = $_POST['id_user'];
        
    }

$data = array(); 

//$sql="SELECT id,name,description,main_photo FROM recipes where category = '$category'";
//$sql="SELECT id,name,main_photo FROM recipes where category = '$category'";
//$sql="SELECT id,name,description,main_photo FROM recipes";
$sql="SELECT recipes.id,name,main_photo,description,components,way_of_preparation,photo1,photo2,photo3,URL_video, favorite_recipes.id, rating
		FROM recipes LEFT JOIN favorite_recipes ON favorite_recipes.id_android_users= '$id_user' AND recipes.id=favorite_recipes.id_recipe 
					 LEFT JOIN opinions ON opinions.id_android_users = '$id_user' AND recipes.id = opinions.id_recipe WHERE recipes.category= '$category'";



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