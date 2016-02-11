<?php
/*Author: Mayandi*/
class USER
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }


 
    public function register($fname,$lname,$uname,$umail,$upass)
    {
       try
       {
           $new_password = password_hash($upass, PASSWORD_DEFAULT);
   
           $stmt = $this->db->prepare("INSERT INTO users(user_name,user_email,user_pass) 
                                                       VALUES(:uname, :umail, :upass)");
              
           $stmt->bindparam(":uname", $uname);
           $stmt->bindparam(":umail", $umail);
           $stmt->bindparam(":upass", $new_password);            
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	public function updateAccountData($umail,$mobile){
		
		 try
		{
			 $session_id=$_SESSION['user_session'];
			 $stmt = $this->db->prepare("update users SET user_email=:umail,mobile_no=:mobile where user_id=:session_id");
			 $stmt->bindparam(":umail", $umail);
			 $stmt->bindparam(":mobile", $mobile);
			 $stmt->bindparam(":session_id", $session_id);
			 $stmt->execute(); 
			 return $stmt; 
		}
		catch(PDOException $e)
       {
           echo $e->getMessage();
       }
                                                 

	}
	public function getAccountData(){
		
		try
		{
			$session_id=$_SESSION['user_session'];

			$stmt = $this->db->prepare("SELECT user_email,mobile_no FROM users WHERE user_id=:session_id LIMIT 1");
			$stmt->execute(array(':session_id'=>$session_id));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() > 0)
			{
				return $userRow;
			}
		}
	   catch(PDOException $e)
       {
           echo $e->getMessage();
       }


	}
    public function login($uname,$umail,$upass)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM users WHERE user_name=:uname OR user_email=:umail LIMIT 1");
          $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if(password_verify($upass, $userRow['user_pass']))
             {
                $_SESSION['user_session'] = $userRow['user_id'];
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
 
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }
 
   public function redirect($url)
   {
       header("Location: $url");
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
}
?>
