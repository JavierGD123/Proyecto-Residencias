<?php 
	define('METHOD','AES-256-CBC');
  	define('SECRET_KEY','$SINDICATO@2020');
  	define('SECRET_IV','60950');

	class ED{
		  
	    public static function Encriptar($string){
	      $output=FALSE;
	      $key=hash('sha256', SECRET_KEY);
	      $iv=substr(hash('sha256', SECRET_IV), 0, 16);
	      $output=openssl_encrypt($string, METHOD, $key, 0, $iv);
	      $output=base64_encode($output);
	      return $output;
	    }


	   public static function Desencritar($string){
	      $key=hash('sha256', SECRET_KEY);
	      $iv=substr(hash('sha256', SECRET_IV), 0, 16);
	      $output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
	      return $output;
	    }
	}
 ?>