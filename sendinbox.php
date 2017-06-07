<?php
error_reporting(0);
require('phpmailer/PHPMailerAutoload.php');
require('class.Sendinbox.php');
require('config.php');
class Sendinbox extends Modules
{
	function __construct()
	{
		$LoadEmail = $this->stuck("[ Load Email List ] : "); $this->LoadEmail 	= $LoadEmail;
		$this->listEmail = $this->load($this->LoadEmail);
	}
	public function senders($email){
		$mail = new PHPMailer(); $mail->IsSMTP(); $mail->SMTPDebug = 0; $mail->SMTPAuth = true; 
		$mail->SMTPSecure 		= $this->smtp_secure;;
		$mail->Host 			= $this->smtp_host;
		$mail->Port 			= $this->smtp_port; 
		$mail->Username 		= $this->smtp_email;
		$mail->Password 		= $this->smtp_pass;
		$mail->Subject 			= $this->sendsubject;
		$Mail->Priority 		= 1;
		$mail->SetFrom($this->smtp_email,$this->smtp_from);
		$mail->IsHTML(true);
		$mail->Encoding = 'base64'; // 8bit base64
		$mail->MsgHTML($this->meletter);
		$mail->AddAddress($email);
		if( $mail->Send() ){
			echo "Send Succes\r\n";
		}else{
			echo "Send Failed\r\n";
		}
	}
    public function send(){
      	$config = new Config; 
      	$this->sendform 	= $config->letter_header()[from];
      	$this->sendsubject 	= $config->letter_header()[subject];
      	for ($i=0; $i <3; $i++) { 
      		sleep(0);
      	}
      	echo "\r\n";
      	$emailList = $this->listEmail['list'];
      	$break 	= false;
		$breaks = false;
		$smtacchit = 1;
      	foreach ($config->account() as $keys => $account) {
      		$this->smtp_email = $account['email'];
      		$this->smtp_pass  = $account['password'];
      		$this->smtp_host  = $account['host'];
      		$this->smtp_port  = $account['port'];
      		$this->smtp_limit = $account['limit'];
      		$this->smtp_from  = $account['from'];
      		$hitMail = 1;
      		foreach ($emailList as $key => $email) {
      			echo "[Sendinbox][".$hitMail."/".$this->listEmail[total]."|".$smtacchit."/".count($config->account())."] ".$email." => ";
      			
      			$letter_replace = array(
      				'{email}' 	=> $email, 
      				'{link}' 	=> "http://google.com", 
      				'{date}'  	=> date("D , d/m/Y")
      			);

      			$this->meletter = $config->letter($letter_replace);
      			$this->senders($email);
      			unset($emailList[$key]);
				if($hitMail >= $this->smtp_limit){
					$break = true;
				}
				if($break === true){
					$breaks = true;	
					$break = false;
					break;
				}
				
				$hitMail++;
      		}
      			$smtacchit++;
      	}
    }
}
echo "=========================================\r\n";
echo "      _______    || Sendinbox v.1\r\n";
echo "     |==   []|   || (c) 2017 Bug7sec\r\n";
echo "     |  ==== |   ||\r\n";
echo "     '-------'   ||\r\n";
echo "=========================================\r\n";
$Sendinbox = new Sendinbox;
$Sendinbox->send();
?>