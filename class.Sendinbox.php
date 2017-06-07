<?php
class Modules
{
	public function stuck($msg){
            echo "[Sendinbox] ".$msg;
            $answer =  rtrim( fgets( STDIN ));
            return $answer;
    }
    public function load($file){
        $file = file_get_contents($file);
        $file = explode("\r\n", $file);
        $file = array_unique($file);
        return array(
        	'total' => count($file),
        	'list'  => $file, 
        );  
    }
}