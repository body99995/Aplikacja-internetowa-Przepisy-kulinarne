<?php
    
    include_once 'db-connect.php';
    
    class UserAndroid{
        
        private $db;
        
        private $db_table = "android_users";
        
        public function __construct(){
            $this->db = new DbConnect();
        }
        
        public function isLoginExist($login, $password){
            
            $query = "select id from ".$this->db_table." where login = '$login' AND password = '$password' Limit 1";
            
            $result = mysqli_query($this->db->getDb(), $query);
            
            if(mysqli_num_rows($result) > 0){
                
				$row = mysqli_fetch_row($result);
				
                //mysqli_close($this->db->getDb());
                
                
                return $row[0];
                
            }
            
            mysqli_close($this->db->getDb());
            
            return 0;
            
        }
		
		
		public function isCorrectPassword($id, $password){
            
            $query = "select login from ".$this->db_table." where id = '$id' AND password = '$password' Limit 1";
            
            $result = mysqli_query($this->db->getDb(), $query);
            
            if(mysqli_num_rows($result) > 0){
                
				$row = mysqli_fetch_row($result);
				
                //mysqli_close($this->db->getDb());
                
                
                return 1;
                
            }
            
            //mysqli_close($this->db->getDb());
            
            return 0;
            
        }
		
		
		public function isUserExist($login, $email){
            
            $query = "select id from ".$this->db_table." where login = '$login' AND email = '$email' Limit 1";
            
            $result = mysqli_query($this->db->getDb(), $query);
            
            if(mysqli_num_rows($result) > 0){
                
				$row = mysqli_fetch_row($result);
				
                //mysqli_close($this->db->getDb());
                
                
                return $row[0];
                
            }
            
            //mysqli_close($this->db->getDb());
            
            return 0;
            
        }
        
        public function isEmailUsernameExist($login, $email){
            
            $query = "select * from ".$this->db_table." where login = '$login' AND email = '$email'";
            
            $result = mysqli_query($this->db->getDb(), $query);
            
            if(mysqli_num_rows($result) > 0){
                
                mysqli_close($this->db->getDb());
                
                return true;
                
            }
               
            return false;
            
        }
        
        public function isValidEmail($email){
            return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        }
        
        public function createNewRegisterUser($login, $password, $email){
              
            $isExisting = $this->isEmailUsernameExist($login, $email);
            
            if($isExisting){
                
                $json['success'] = 0;
                $json['message'] = "Błąd w rejestracji. Prawdopodobnie login/email już wykorzystany";
            }
            
            else{
                
            $isValid = $this->isValidEmail($email);
                
                if($isValid)
                {
                $query = "insert into ".$this->db_table." (login, email, password, created_at, updated_at) values ('$login', '$email', '$password', NOW(), NOW())";
                
                $inserted = mysqli_query($this->db->getDb(), $query);
                
                if($inserted == 1){
                    
                    $json['success'] = 1;
                    $json['message'] = "Rejestracja przebiegła pomyślnie";
                    
                }else{
                    
                    $json['success'] = 0;
                    $json['message'] = "Błąd w rejestracji. Prawdopodobnie login/email już wykorzystany";
                    
                }
                
                mysqli_close($this->db->getDb());
                }
                else{
                    $json['success'] = 0;
                    $json['message'] = "Niepoprawny email";
                }
                
            }
            
            return $json;
            
        }
        
        public function loginUsers($login, $password){
            
            $json = array();
            
            $canUserLogin = $this->isLoginExist($login, $password);
            
            if($canUserLogin > 0){
                
                $json['success'] = 1;
                $json['message'] = "Poprawne zalogowanie";
				$json['id'] = $canUserLogin;
				$json['log'] = $this->createLogUser($canUserLogin);
                
            }else{
                $json['success'] = 0;
                $json['message'] = "Niepoprawne dane";
            }
            return $json;
        }
		
		public function generateRandomString($length) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
		
		
		public function createLogUser($canUserLogin){
			
			$query = "insert into `android_user_logs` (id_android_user, date) values ('$canUserLogin', NOW())";
                
            $inserted = mysqli_query($this->db->getDb(), $query);
			
			if($inserted == 1){
                    $json = 1;
              
                }else{
                    $json = 0;
                    
                }
			mysqli_close($this->db->getDb());
			return $json;
		}
		
		public function createLogChangePass($id_user, $type_of_change){
			
			
			$query = "insert into `android_password_change` (id_android_users, type_of_change, date) values ('$id_user', '$type_of_change', NOW())";
            
            $inserted = mysqli_query($this->db->getDb(), $query);
			
			if($inserted == 1){
                    $json = 1;
              
                }else{
                    $json = 0;
                    
                }
			mysqli_close($this->db->getDb());
			return $json;
		}
		
		
		public function ChangePass($id, $password){
			
			
			$query = "update ".$this->db_table." set `password` = '$password' ,`updated_at` = NOW() where id = '$id'";
			
                
            $updated = mysqli_query($this->db->getDb(), $query);
			
			if($updated === TRUE){
                    $json = 1;
              
                }else{
                    $json = 0;
                    
                }
			//mysqli_close($this->db->getDb());
			return $json;
		}
		
		
		public function SendMail($email, $hashed_password){
			
			$to      = $email;
			$subject = 'Przywracanie hasla';
			$message = 'Nowe haslo: '.$hashed_password;
			$headers = 'From: biuro@przepisy-kulinarne.cba.pl' . "\r\n" .
			'Reply-To: biuro@przepisy-kulinarne.cba.pl';

			//mail($to, $subject, $message, $headers);
			
			if(@mail($to, $subject, $message, $headers)){
				return 1;
			}else{
				return 0;
			}
		}
		
		
		public function RemindPass($login, $email){
			
			$json = array();
            
            $canUserExist = $this->isUserExist($login, $email);
			
			if($canUserExist > 0){
                
				//$hashed_password = md5(generateRandomString());
				$hashed_password = $this->generateRandomString(5);
				
				if(($this->SendMail($email, $hashed_password))==1){
					$hashed_password = md5($hashed_password);
					
					if(($this->ChangePass($canUserExist, $hashed_password))==1){
						
						$json['success'] = 1;
						$json['message'] = "Poprawne zresetowanie";
						$json['id'] = $canUserExist;
						$json['log'] = $this->createLogChangePass($canUserExist,"reset");
					}else{
						
					$json['success'] = 0;
					$json['message'] = "Problem ze zmiana";
					}
				}else{
					$json['success'] = 0;
					$json['message'] = "Problem z wyslaniem";
				}
				
            }else{
                $json['success'] = 0;
                $json['message'] = "Niepoprawne dane";
            }
			
			return $json;
		}
		
		
		public function ChangePassword($password, $id_user, $new_password){
			
			$json = array();
			
			$password = md5($password);
			
			if($this->isCorrectPassword($id_user,$password)){
            	
					$hashed_password = md5($new_password);
					
					if(($this->ChangePass($id_user, $hashed_password))==1){
						
						$json['success'] = 1;
						$json['message'] = "Poprawna zmiana";
						//$json['id'] = $canUserExist;
						$json['log'] = $this->createLogChangePass($id_user,"change");
					}else{
						
						$json['success'] = 0;
						$json['message'] = "Problem ze zmiana";
					}
			}else{
				$json['success'] = 0;
                $json['message'] = "Niepoprawne stare haslo";
			}			
				
            
			
			return $json;
		}
    }
    ?>