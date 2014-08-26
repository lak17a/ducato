<?php
$name=$_POST['name']; //vardas
$phone=$_POST['phone']; //telefonas
$mail=$_POST['mail']; //el pastas
$city=$_POST['city']; //miestas
$actipon=$_POST['action']; //cia kad butu aisku kuri forma suveike

class mail_sender {
/**
	This List for send mail by city
**/
	private $mail_list_city_1='sarunas@balticode.com,sarunas.balticode@gmail.com';//setup mails for vilnius
	private	$mail_list_city_2='sarunas@balticode.com'; //for kaunas
	private	$mail_list_city_3='sarunas@balticode.com'; // and klaipeda
/**

**/

/**
	This List for send mail by count
**/
//   Tartu
	private $mail_list_city_1_by_count_1='sarunas@balticode.com';//for first
	private	$mail_list_city_1_by_count_2='sarunas@balticode.com'; //for secont
	private	$mail_list_city_1_by_count_3='sarunas@balticode.com'; //for secont
	private $mail_list_city_1_by_count=3; //how much groups we have in this city

//   Parnu
	private $mail_list_city_2_by_count_1='sarunas@balticode.com';//for first
	private	$mail_list_city_2_by_count_2='sarunas.balticode@gmail.com'; //for secont
	private $mail_list_city_2_by_count=2; //how much groups we have in this city

//	Talinas
	//private $mail_list_city_3_by_count_1='sarunas@balticode.com';//this is only one, always send just for this mail
	private $mail_list_city_3_by_count=1; //how much groups we have in this city
/**

**/
/*
//          This is for Vilnius city 1
	private $mail_list_city_1_by_count=1;
	private $mail_list_city_1_by_count_1='arnoldas.ardzevicius@fiat.lt,
		vytautas.steiblys@bmw.lt,
		juste.sataite@fiat.lt,
		paule.meidute@modusgroup.lt';

//			This is for Kaunas city 2
	private $mail_list_city_2_by_count=1;											
	private $mail_list_city_2_by_count_1='vaidotas.nortkus@bmw.lt,
		andrius.mockaitis@bmw.lt,
		juste.sataite@fiat.lt, 
		paule.meidute@modusgroup.lt';

//			This is for Klaipeda city 3
	private $mail_list_city_3_by_count=1;		
	private $mail_list_city_3_by_count_1='vytautas.stankevicius@bmw.lt,
		algimantas.stanislauskas@bmw.lt,
		juste.sataite@fiat.lt, 
		paule.meidute@modusgroup.lt';

//			This is for Riga city 4
	private $mail_list_city_4_by_count=1;
	private $mail_list_city_4_by_count_1='artis.skulte@autobrava.lv,
		andris.sivickis@autobrava.lv,
		juste.sataite@fiat.lt,
		paule.meidute@modusgroup.lt';

//			This is for Talinas city 5
	private $mail_list_city_5_by_count=2;
	private $mail_list_city_5_by_count_1='marko.viirand@autospirit.ee,
		juste.sataite@fiat.lt,
		paule.meidute@modusgroup.lt,
		triin.kutsen@autospirit.ee';
	private $mail_list_city_5_by_count_2='priit.peetsalu@unitedmotors.ee,
		kristina.noor@unitedmotors.ee,
		juste.sataite@fiat.lt,
		paule.meidute@modusgroup.lt';

//			This is for Tartu city 6
	private $mail_list_city_6_by_count=2;	
	private $mail_list_city_6_by_count_1='raiki.reinsoo@autospirit.ee,
		marko.viirand@autospirit.ee,
		juste.sataite@fiat.lt,
		paule.meidute@modusgroup.lt';
	private $mail_list_city_6_by_count_2='priit.peetsalu@unitedmotors.ee,
		kristina.noor@unitedmotors.ee, 
		juste.sataite@fiat.lt,
		paule.meidute@modusgroup.lt';

//			This is for Parnu city 7
	private $mail_list_city_7_by_count=2;	
	private $mail_list_city_7_by_count_1='priit.peetsalu@unitedmotors.ee,
		kristina.noor@unitedmotors.ee,
		juste.sataite@fiat.lt,
		paule.meidute@modusgroup.lt';
	private $mail_list_city_7_by_count_2='priit.peetsalu@unitedmotors.ee,
		kristina.noor@unitedmotors.ee, 
		juste.sataite@fiat.lt,
		paule.meidute@modusgroup.lt';
*/

	function call_error($text){ //send to file error text
		$filename="mail_errors.log";
		$file = fopen($filename, "a+") or die("Unable to open file! For error log");
		$text=date("Y-m-d h:i:sa").' '.$text."\n";
		fwrite($file, $text);
		fclose($file);
	}

	function send_mail_by_city($subject,$message,$city){ //function send mail by selected city number
	 	$sent=false;
	 	$mail_list = "mail_list_city_".$city; //get right array
		$sent=mail($this->$mail_list,$subject,$message); //send mails for thise mails
		return $sent;
	}

	function send_mail_by_city_count($subject,$message,$city){ //function who send a mail to one or two city by counting
		$sent=false;
		$filename="sendatgroup"; //file name
		$file = fopen($filename, "a+") or die("Unable to open file in send_mail_by_city_count function this need to read who this time get a mails"); //try to pen file if not make log
		$groups = explode(",", fgets($file)); //get how many groups is in a file
		$file_line_content="";
		for($count=0; (count($groups)-1)>$count || ($city-1)>=$count ;$count++){ //loop while count not be biger that array or city number
			if($groups[$count]=="") $groups[$count]="1"; //if something is lost reset it to one
			if(($count+1)==$city){ //if count number is like city number it is my number
			 	$mail_list = "mail_list_city_".$city."_by_count_".$groups[$count]; //get right array
				//$message = "You got a mail from city number ".$city." and this mail have group number: ".$groups[$count];
				//echo 'mail: '.$this->$mail_list.'<br />Subject:'.$subject.'<br />message: '.$message.'<br />';
				$sent=mail($this->$mail_list,$subject,$message); //send mail for thise mails
				//looking for next mail receivers
				$variable="mail_list_city_".$city."_by_count"; //temp value
				if( $groups[$count]>= $this->$variable ){ $groups[$count]=1; } else { $groups[$count]++; } //if goup number is maximum
			} //it is my numger
			$file_line_content.=$groups[$count].','; //to file group number
		}
			file_put_contents($filename, ""); //erase file
			fwrite($file, $file_line_content); //write to file groups numbers to who get mails for NEXT time
			fclose($file); //close file	
		return $sent;
	}
}


$send_mail= new mail_sender();

$subject = 'New registration';
$message = 'You got a new registration success: Name: '.$_POST['name'].' E-mail: '.$_POST['mail'].' And phone: '.$_POST['phone'];
$message.= 'Registraited from city id: '.$_POST['city'];

if( $actipon=="send_mail_by_city" ){
	if( !$text=$send_mail->send_mail_by_city($subject,$message,$city) )
		$send_mail->call_error($text);
}

if( $actipon=="send_mail_by_city_count" ){
	if( !$text=$send_mail->send_mail_by_city_count($subject,$message,$city) )
		$send_mail->call_error($text);
}
?>