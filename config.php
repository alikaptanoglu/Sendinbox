<?php
class Config
{
	public function account(){
		return array(
			array(
				'email' 	=> '', 
				'password' 	=> '', 
				'host' 		=> '', 
				'from' 		=> '', 
				'port' 		=> '', 
				'secure'    => 'ssl',
				'limit' 	=> '100',  // ngelimit send
			),
			/*array(
				'email' 	=> '', 
				'password' 	=> '', 
				'host' 		=> '', 
				'from' 		=> '', 
				'port' 		=> '', 
				'secure'    => 'ssl',
				'limit' 	=> '100',  // ngelimit send
			),
			array(
				'email' 	=> '', 
				'password' 	=> '', 
				'host' 		=> '', 
				'from' 		=> '', 
				'port' 		=> '', 
				'secure'    => 'ssl',
				'limit' 	=> '100',  // ngelimit send
			),*/
		);
	}
	public function letter($config){
		$letter = file_get_contents("letter.html");
		foreach ($config as $key => $value) {
			$letter = str_replace($key, $value, $letter);
		}
		return $letter;
	}
	public function letter_header(){
		return array(
			'subject' => 'Verify your account information', 
		);
	}
}