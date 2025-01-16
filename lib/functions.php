<?php
session_start();

date_default_timezone_set('Asia/kolkata');

class class_functions{

//Constructor
function __construct(){
    $this->con = new mysqli("localhost","root","","fitness");
}


//Create new account
function create_new_account($username,$email,$phno,$password){
  
$current_date = date("Y-m-d");
$current_time = date("H:i:s A");

if($stmt = $this->con->prepare("INSERT INTO `users`(`username`, `email`,`phno`, `password`, `date`, `time`) VALUES (?,?,?,?,?,?)")){

$stmt->bind_param("ssssss",$username,$email,$phno,$password,$current_date,$current_time);

}
            if($stmt->execute()){
				header("location:home.html");
				return true;
			}
			else{
				return false;
			}
}

//Get Users Data
function get_all_users_data(){

    
		if($stmt = $this->con->prepare("SELECT `id`, `username`, `email`,`phno`, `password`, `date`, `time` FROM `users`"))
		{
			$stmt->bind_result($id,$username,$email,$phno,$passsword,$date,$time);
			
			if($stmt->execute())
			{
				$data = array();
				$counter = 0;
				
				while($stmt->fetch())
				{
					$data[$counter]['id'] = $id;
					$data[$counter]['username'] = $username;
					$data[$counter]['email']	=	$email;
					$data[$counter]['phno']	=	$phno;
					$data[$counter]['password']	=	$passsword;
					$data[$counter]['date']	=	$date;
					$data[$counter]['time']	=	$time;
					
					$counter++;
				}
				
				if(!empty($data))
				{
					return $data;
				}
				else{
					return false;
				}
				
			}
			
		}

}

//Delete user data by id
function delete_user_data($del_id)
	{
		if($stmt = $this->con->prepare("Delete from `users` where `id`=?"))
		{
			$stmt->bind_param("i",$del_id);
			
			if($stmt->execute())
			{
				return true;
			}
			else{
				return false;
			}
		}
	}





//contact-us
function contact_us($name,$email,$message){

$current_date = date("Y-m-d");
$current_time = date("H:i:s A");

if($stmt = $this->con->prepare("INSERT INTO `contact_us`(`name`, `email`, `message`, `date`, `time`) VALUES (?,?,?,?,?)")){

$stmt->bind_param("sssss",$name,$email,$message,$current_date,$current_time);

}
            if($stmt->execute()){
				return true;
			}
			else{
				return false;
			}
}

//Get-password
function get_user_password($var_username){
    if($stmt = $this->con->prepare("Select `password` from `users` where `username`=?"))
    {
        $stmt->bind_param("s",$var_username);
        
        $stmt->bind_result($res_password);
        
        if($stmt->execute())
        {
            if($stmt->fetch())
            {
                return $res_password;
            }
            else
            {
                return false;
            }
        }
    }
    
}

function get_user_data_from_id($edit_id)
	{
		if($stmt = $this->con->prepare("SELECT `id`, `username`, `email`, `phno`, `password` FROM `users` where `id`=?"))
		{
			$stmt->bind_param("i",$edit_id);
			
			$stmt->bind_result($id,$username,$email,$phno,$password);
			
			if($stmt->execute())
			{
				$data = array();
						
				if($stmt->fetch())
				{
					$data['id'] = $id;
					$data['username'] = $username;
					$data['email']	=	$email;
					$data['phno']	=	$phno;
					$data['password']	=	$password;
					
					
				}
				
				if(!empty($data))
				{
					return $data;
				}
				else{
					return false;
				}
				
			}
			
		}
	}


	function update_user_account($var_username,$var_email, $var_phno,$var_password,$edit_id)
	{
		$current_date	=	date("Y-m-d");
		$current_time	=	date("H:i:s A");
		
		if($stmt = $this->con->prepare("UPDATE `users` SET `username`=?,`email`=?,`phno`=?,`password`=?,`date`=?,`time`=? WHERE `id`=?"))
		{
			$stmt->bind_param("ssssssi",$var_username,$var_email, $var_phno,$var_password,$current_date,$current_time,$edit_id);
			
			if($stmt->execute())
			{
				return true;
			}
			else{
				return false;
			}
			
		}
	}


	function subscribe($email){
		$current_date	=	date("Y-m-d");
		$current_time	=	date("H:i:s A");

		if($stmt = $this->con->prepare("INSERT INTO `subscribe`(`email`, `date`, `time`) VALUES (?,?,?)")){

			$stmt->bind_param("sss",$email,$current_date,$current_time);
			
			}
						if($stmt->execute()){
							return true;
						}
						else{
							return false;
						}

	}


}


?>


