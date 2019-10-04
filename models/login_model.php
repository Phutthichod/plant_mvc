<?php

class Login_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function check_login($username,$password)
	{
		$sth = $this->db->prepare("SELECT *  FROM member_1 WHERE 
				username = :username AND password = :password");
		$sth->execute(array(
			':username' => $username,
			':password' => ($password)
		));
		
		$data = $sth->fetch();
		
		$count =  $sth->rowCount();
		if ($count > 0) {
			// login
			if($data['status'] == "Blocked")
			{
				return "Blocked";		
			}
			else
			{
				Session::set('member', $data);
				return true;
			}
						 			
			
		} else {
			return false;			
		}
		
	}
	public function checkUser($data)
	{
		return $this->db->selectOne('SELECT * FROM member WHERE member.username = :username AND member.email =:email', 
					array(':username' => $data['username'] , ':email' => $data['email']));
		
	}
	public function register_insert($data)
	{
		$this->db->insert('member', array(
			'username' => $data['username'],
			'password' => md5($data['password']),
			'firstname' => $data['name'],
			'lastname' => $data['surname'],
			'email' => $data['email'],
			'permission' => 'expert',
			'status' => 'Waiting'
		));
	}
	public function createMail($data)
	{
		$key_tmp = rand(0000,99999);
		require("libs/phpmailer/phpmailer/PHPMailerAutoload.php");		
		$email = $data['email'];
		$name = "Tomato@mail.com"; 
		$key_tmp = rand(0000,99999);
		header('Content-Type: text/html; charset=utf-8');

		$mail = new PHPMailer;
		$mail->CharSet = "utf-8";
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		$mail->SMTPSecure = 'ssl';
		$mail->SMTPAuth = true;


		$gmail_username = "changpass.tomato@gmail.com"; // gmail ที่ใช้ส่ง
		$gmail_password = "madeena_5820503422"; // รหัสผ่าน gmail
		// ตั้งค่าอนุญาตการใช้งานได้ที่นี่ https://myaccount.google.com/lesssecureapps?pli=1


		$sender = "Admin"; // ชื่อผู้ส่ง
		$email_sender = $name; // เมล์ผู้ส่ง 
		$email_receiver = $email; // เมล์ผู้รับ ***

		$subject = "เปลี่ยนรหัสผ่าน"; // หัวข้อเมล์


		$mail->Username = $gmail_username;
		$mail->Password = $gmail_password;
		$mail->setFrom($email_sender, $sender);
		$mail->addAddress($email_receiver);
		$mail->Subject = $subject;

		$activation=md5($email.time());
		$time = time();
		$email_content = "
			<!DOCTYPE html>
			<html>
				<head>
					<meta charset=utf-8'/>
					<title>ทดสอบการส่ง Email</title>
				</head>
				<body>
					
					<div style='padding:20px;'>
						<div>				
							<h2>การเปลี่ยนรหัสผ่าน : <strong style='color:#0000ff;'></strong></h2>
							<a href='#' target='_blank'>
								<h1><strong style='color:#3c83f9;'> >> รหัสของท่านคือ ".$key_tmp." </strong> </h1>
							</a>
						</div>
						<div style='margin-top:30px;'>
							<hr>
							<address>
								<h4>ติดต่อสอบถาม</h4>
								<p>คลังข้อมูลเชื่อพันธุกรรมมะเขือเทศ</p>
								<p>http://127.0.0.1/project/</p>
							</address>
						</div>
					</div>
					<div style='background: #3b434c;color: #a2abb7;padding:30px;'>
						
					</div>
				</body>
			</html>
		";
		if($email_receiver){
			$mail->msgHTML($email_content);
			$Retrun_data = "";

			if (!$mail->send()) {  // สั่งให้ส่ง email

				//กรณีส่ง email ไม่สำเร็จ
				//echo "<h3 class='text-center'>ระบบมีปัญหา กรุณาลองใหม่อีกครั้ง</h3>";
				$Retrun_data =  $mail->ErrorInfo; // ข้อความ รายละเอียดการ error
				//$data = "fail";
			}else{
				//กรณีส่ง email สำเร็จ
				$Retrun_data = "ระบบได้ส่งข้อความไปเรียบร้อย";
				$this->db->insert('time_forgetpass', array(
					'email' => $data['email'],
					'key_tmp' => $key_tmp,
					'username' => $data['username']
				));	
			}	
		    return json_encode($Retrun_data);
		}		
			
	}
	public function checkToken($data)
	{
		return $this->db->selectOne('SELECT * FROM time_forgetpass WHERE time_forgetpass.username = :username AND time_forgetpass.email =:email AND time_forgetpass.key_tmp = :key_token' , 
					array(':username' => $data['username'] , ':email' => $data['email'], ':key_token' => $data['key']));
	}
	public function updatPass($data)
	{
		$value = array( 			
			'password' => md5($data['key'])
			);	
			return $this->db->update('member',$value, "member.username = '{$data['username']}' ");
		//  $value;
		// AND `member.email` = {$data['email']}
	}

	
}