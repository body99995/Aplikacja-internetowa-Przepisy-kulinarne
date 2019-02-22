<?php

require_once 'userAndroid.php';
    
    $login = "";
    
    $password = "";
    
    $email = "";
	
	$id_user = "";
	
	$new_password = "";
    
    if(isset($_POST['login'])){
        
        $login = $_POST['login'];
        
    }
    
    if(isset($_POST['password'])){
        
        $password = $_POST['password'];
        
    }
    
    if(isset($_POST['email'])){
        
        $email = $_POST['email'];
        
    }
	
	if(isset($_POST['id_user'])){
        
        $id_user = $_POST['id_user'];
        
    }
	
	if(isset($_POST['new_password'])){
        
        $new_password = $_POST['new_password'];
        
    }
    
    $userObject = new UserAndroid();
    
    // Registration
    
    if(!empty($login) && !empty($password) && !empty($email) && empty($id_user) && empty($new_password)){
        
        $hashed_password = md5($password);
        
        $json_registration = $userObject->createNewRegisterUser($login, $hashed_password, $email);
        
        echo json_encode($json_registration);
        
    }
    
    // Login
    
    if(!empty($login) && !empty($password) && empty($email) && empty($id_user) && empty($new_password)){
        
        $hashed_password = md5($password);
        
        $json_array = $userObject->loginUsers($login, $hashed_password);
        
        echo json_encode($json_array);
    }
	
	
	//Remind password
	
	if(!empty($login) && empty($password) && !empty($email) && empty($id_user) && empty($new_password)){
        
        $json_array = $userObject->RemindPass($login, $email);
        
        echo json_encode($json_array);
    }
	
	//Change password
	
	if(empty($login) && !empty($password) && empty($email) && !empty($id_user) && !empty($new_password)){
        
        $json_array = $userObject->ChangePassword($password, $id_user, $new_password);
        
        echo json_encode($json_array);
    }
?>