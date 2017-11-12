<?php

require_once 'dbconfig.php';

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function register($email,$uphrase,$upass,$uhashid,$ustatus,$ucode,$uattempt,$utype)
	{
		try
		{				
		    $cddate = date('Y-m-d');		
			$password = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO plaas_accounts(email_address, phrases, password, hashid, status, code, attempts, userType, regdate) 
			                                             VALUES(:user_mail, :user_phrase, :user_pass, :active_code, :user_status, :user_code, :user_attempt, :active_utype, :crt)");
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_phrase",$uphrase);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":active_code",$uhashid);
			$stmt->bindparam(":user_status",$ustatus); 
			$stmt->bindparam(":user_code",$ucode);
			$stmt->bindparam(":user_attempt",$uattempt);
			$stmt->bindparam(":active_utype",$utype);   
			$stmt->bindparam(":crt",$cddate);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM plaas_accounts WHERE email_address=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['status']==1)
				{
					if($userRow['password']==md5($upass))
					{
						$_SESSION['userTyp'] = $userRow['userType'];
						$_SESSION['userSession'] = $userRow['id']; 
						return true;
					}
					else
					{
						header("Location: index.php?error");
						exit;
					}
				}
				else
				{
					header("Location: index.php?inactive");
					exit;
				}	
			}
			else
			{
				header("Location: index.php?error-message");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
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
		$_SESSION['userSession'] = false;
	} 
} 