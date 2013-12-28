<?php
class CaptchaComponent extends Component {

	public $components = array('Session');

	public function show_captcha() {
		if (session_id() == "") {
			session_name("CAKEPHP");
			session_start();
		}

		$path = $this->webroot;
		$imgname = 'noise.jpg';
		$imgpath  = 'img/'.$imgname;
		$captcha_dir = 'images/captcha';
	
		$captchatext = md5(time());
		$captchatext = substr($captchatext, 0, 5);
		$_SESSION['captcha'] = $captchatext;
		$this->Session->write('captcha', $captchatext);

		if (file_exists($imgpath)){
			$im = imagecreatefromjpeg($imgpath); 
			$grey = imagecolorallocate($im, 102, 102, 102);
			$font = 'fonts/'.'captcha_font.ttf';
			imagettftext($im, 25, 0, 10, 25, $grey, $font, $captchatext);

			$output_img_name = 'captcha.jpg';	//security_code_'.session_id().'.jpg';
			$output_img_path = $captcha_dir.'/'.$output_img_name;
			imagejpeg($im,$output_img_path);

			//start delete all files which made before 1 day
			$last_day_strtotime = strtotime('-1 day');
			if ($handle = opendir($captcha_dir)) {
			    while (false !== ($entry = readdir($handle))) {
			    	if(!in_array($entry, array('.','..')) and filemtime($captcha_dir.'/'.$entry) < $last_day_strtotime){
						unlink($captcha_dir.'/'.$entry);
			    	}
			    }
			    closedir($handle);
			}
			//end delete all files which made before 1 day

			//return $output_img_name;

			return $_SESSION['captcha'];

		}
		else{
			echo 'captcha error';
			exit;
		}		 
	}
}
?>