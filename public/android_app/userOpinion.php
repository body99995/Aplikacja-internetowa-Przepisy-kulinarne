<?php
	header('Content-Type: text/html; charset=utf-8');
    
    include_once 'db-connect.php';
    
    class FavoriteRecipe{
        
        private $db;
        
        private $db_table = "opinions";
        
        public function __construct(){
            $this->db = new DbConnect();
			mysqli_set_charset($this->db->getDb(), "utf8"); 
        }
        
		/*
        public function isFavoriteRecipeExist($id_android_users, $id_recipe){
            
            $query = "select id from ".$this->db_table." where id_android_users = '$id_android_users' AND id_recipe = '$id_recipe' Limit 1";
            
            $result = mysqli_query($this->db->getDb(), $query);
            
            if(mysqli_num_rows($result) > 0){
                
				$row = mysqli_fetch_row($result);
				
                mysqli_close($this->db->getDb());
                
                
                return $row[0];
                
            }
            
            mysqli_close($this->db->getDb());
            
            return 0;
            
        }*/
        

		
        public function editFavoriteRecipe($id_android_users, $id_recipe, $opinion){
			
			/*
			$query = "insert into ".$this->db_table." (`id_android_users`, `id_recipe`) values ('$id_android_users', '$id_recipe')";
				//$query = "insert into ".$this->db_table." (login, email               ) values ('$login', '$email', '$password'  )";
				//$query = "insert into ".$this->db_table." (id_android_users, id_recipe) values ('4', '10')";
                
                $inserted = mysqli_query($this->db->getDb(), $query);
                
                if($inserted == 1){
                    
                    $json['success'] = 1;
                    $json['message'] = "Dodano do ulubionych";
                    
                }else{
                    
                    $json['success'] = 0;
                    $json['message'] = "Problem w dodawaniu";
                    
                }*/
				
			
			//$id = $this->isFavoriteRecipeExist($id_android_users, $id_recipe);
			
			
			$query = "select id from ".$this->db_table." where id_android_users = '$id_android_users' AND id_recipe = '$id_recipe' Limit 1";
			
			//mysqli_set_charset($this->db->getDb(), "utf8"); 
			
            
            $result = mysqli_query($this->db->getDb(), $query);
            
            if(mysqli_num_rows($result) > 0){
                
				$row = mysqli_fetch_row($result);
				
                //mysqli_close($this->db->getDb());
                
				$id=$row[0];
                
                
            }else{
				$id=0;
			}
            
            //mysqli_close($this->db->getDb());
            
            
	
			if($id==0){
	
	
				//echo "po select". $id_android_users." ".$id_recipe." ".$id;
				
                $query = "insert into ".$this->db_table." (`id_android_users`, `id_recipe`, `opinion`, `rating`) values ('$id_android_users', '$id_recipe', '$opinion', '')";
				
                //mysqli_set_charset($this->db->getDb(), "utf8"); 
                $inserted = mysqli_query($this->db->getDb(), $query);
                
                if($inserted == 1){
                    
                    $json['success'] = 1;
                    $json['message'] = "Dodano ocene";
                    
                }else{
                    
                    $json['success'] = 0;
                    $json['message'] = "Problem w dodawaniu";
                    
                }
				
                
	
            }else{
				
				//echo "delete ". $id_android_users." ".$id_recipe." ".$id;
				
				
				/*
				$host='127.0.0.1';
				$username='root';
				$pwd='';
				$db="praca_inz";

				$con=mysqli_connect($host,$username,$pwd,$db) or die('Unable to connect');

				if(mysqli_connect_error($con))
				{
					echo "Failed to Connect to Database ".mysqli_connect_error();
				}
				
				*/
				//$query = "delete from ".$this->db_table." where id  = '$id'";
				$query = "update ".$this->db_table." set `opinion` = '$opinion' where id = '$id'";
				
				
				//echo "SQL ".$query;
                //mysqli_set_charset($this->db->getDb(), "utf8"); 
                $updated = mysqli_query($this->db->getDb(), $query);
				
				//$deleted = $conn->query($sql)
                
				
				//echo "delete ".$deleted;
				
                if($updated === TRUE){
                    
                    $json['success'] = 1;
                    $json['message'] = "Zmieniono";
                    
                }else{
                    
                    $json['success'] = 0;
                    $json['message'] = "Problem w zmianie";
					//echo "Error deleting record: " . mysqli_error($this->db->getDb());
                    
                }

			}
			
			mysqli_close($this->db->getDb());
            return $json;
			
            
        }
        
    }
	
	
	$id_android_users = "4";
    
    $id_recipe = "1";
	
	$opinion = "żaba chrząszcz";

    
    if(isset($_POST['id_android_users'])){
        
        $id_android_users = $_POST['id_android_users'];
        
    }
    
    if(isset($_POST['id_recipe'])){
        
        $id_recipe = $_POST['id_recipe'];
        
    }
	
	if(isset($_POST['opinion'])){
        
        $opinion = $_POST['opinion'];
        
    }
	//echo "id_user".$id_android_users; 
	//echo "id_recipe".$id_recipe;
	
	
	
	$FavoriteObject = new FavoriteRecipe();
	
        
        $json_registration = $FavoriteObject->editFavoriteRecipe($id_android_users, $id_recipe, $opinion);
        
        echo json_encode($json_registration);
        
 
    ?>