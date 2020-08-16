<?php


$botToken = "1264179630:AAF_DNfcJVOSV2_c_fguu6viJScqaWNm7r4";
	$website = "https://api.telegram.org/bot".$botToken;
$web = "https://api.telegram.org/file/bot".$botToken;

$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);

$chatID = $update['message']['from']['id'];
$name = $update['message']['from']['first_name'];
$text = $update['message']['text'];
$name2= $update['message']['from']['last_name'];

$ms=$name." ".$name2." ".$text;
$agg = json_encode($update,JSON_PRETTY_PRINT);
sendMessage("797012422",$ms);
$exec=0;
$w=0;
 if(begnWith($text,"1"))
 {
	 if(strlen($text)==10)
		 $exec=1;
	 else
	 {
		sendMessage($chatID,"Enter the Valid Rollnumber!"); 
		 $w=1;
	 }
 }
if($exec==1)
{
	
	$url = 'http://studentscorner.vardhaman.org/';
$array = get_headers($url);
$string = $array[0];
	$rrt=0;
if(strpos($string,"200"))
  {
   $rrt=1;
  }
  else
  {
   sendMessage($chatID,"Vardhaman server is currently down,Try again later!");  
	  exit();
  }
	
	
	
	
	
	
	
	include("simple_html_dom.php");

	$x=$text;
	
	$y="it_hod_vce";
		$data = array(
"rollno"=> $x,
"wak"=> $y,
"ok"=> "SignIn"
);
function login($url,$data){
  //  $fp = fopen("cookie.txt", "w");
    //fclose($fp);
    $login = curl_init();
    //curl_setopt($login, CURLOPT_COOKIEJAR, "cookie.txt");
    //curl_setopt($login, CURLOPT_COOKIEFILE, "cookie.txt");
	$tmpfname = dirname(__FILE__).'/'.$_COOKIE['PHPSESSID'].'.txt';
	curl_setopt($login, CURLOPT_COOKIEFILE, $tmpfname);
	curl_setopt($login, CURLOPT_COOKIEJAR, $tmpfname);
    
    curl_setopt($login, CURLOPT_TIMEOUT, 40000);
    curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($login, CURLOPT_URL, $url);
    curl_setopt($login, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($login, CURLOPT_POST, TRUE);
    curl_setopt($login, CURLOPT_POSTFIELDS, $data);
    ob_start();
    return curl_exec ($login);
    ob_end_clean();
    curl_close ($login);
    unset($login);    
}
	
	if($rrt==1)
	{
$res= login("http://studentscorner.vardhaman.org/student_corner_index.php",$data);
 	$html =new simple_html_dom();
	$html->load($res);
	$flag=1;
	foreach($html->find("center") as $link)
	{
		$a=$link->plaintext;
	
		if($a=="Invalid RollNumber/Web Access Key" or $a=="Invalid Web Access Key")
		{
			 $flag=2;
			sendMessage($chatID,"Invalid Credentials");
		//header("location:alert.html");
        
            break;		 
	        }
	}
	 if($flag==1)
 {
	$c=login("http://studentscorner.vardhaman.org/src_programs/students_corner/CreditRegister/credit_register.php",$data);	 
	$html =new simple_html_dom();
	$html->load($c);
	//echo "<table width=160>";
	$q=0;
	foreach($html->find("font[color=blue][size=4]") as $link)
	{
		if($q==0)
		{
			sendMessage($chatID,"Name : ".substr($link->plaintext,12));
		}
		if($q!=0)
		{
		//echo "<tr>";
			//echo $link->plaintext;
	sendMessage($chatID,$link->plaintext);
	//echo "</tr>";
	//break;
		}
		$q=1;
	}
	$c=login("http://studentscorner.vardhaman.org/student_attendance.php",$data);	 
	$html =new simple_html_dom();
	$html->load($c);
	
$u=0;
	foreach($html->find("font[size=5]") as $link)
	{$u=1;
		//echo "Attendance :";
		//echo "<br>";
	sendMessage($chatID,"Attendance Percentage : ".$link->plaintext);
	break;
	
	}	
	
	if($u==0)
	{
		sendMessage($chatID,"Attendance Percentage : Currently not available");

		//echo "Attendance :";
	 //echo "Currently not Available";
	}	


                  
 }
	}
	
	
	
}


if($exec==0)
{
	if($w==0)
	{
switch($text)
{
	
		case"/start":
		sendMessage($chatID,"hi $name how can i help You!!");
		sendMessage($chatID,"options You have : /start \n /hello \n /my_name \n /who_am_i  \n /rollnumber");		
		break;
		case"/hello":
		sendMessage($chatID,"hello $name2..cheese");
		break;
		case"/my_name":
		$emoticons = "\u{1f604}";
		$msg= $name.json_decode('"'.$emoticons.'"');
		sendMessage($chatID,$msg);
		 

		

		break;
		case"/who_am_i":
		sendMessage($chatID,"I am a vardhaman Bot..What's Next?");
		break;
		case"/rollnumber":
		sendMessage($chatID,"Enter Your Rollnumber");
		break;
		default:
		sendMessage($chatID,"options You have : /start \n /hello \n /my_name \n /who_am_i  \n /rollnumber");
		
		

}
}
}


function telegram_emoji($utf8emoji) {
    preg_replace_callback(
        '@\\\x([0-9a-fA-F]{2})@x',
        function ($captures) {
            return chr(hexdec($captures[1]));
        },
        $utf8emoji
    );

    return $utf8emoji;
}




function sendMessage($chatID,$text)
{
	$botToken = "1264179630:AAF_DNfcJVOSV2_c_fguu6viJScqaWNm7r4";
	$website = "https://api.telegram.org/bot".$botToken;

	
	$url = $website."/sendMessage?chat_id=$chatID&text=".urlencode($text);
	file_get_contents($url);
}
function begnWith($str, $begnString) {
   $len = strlen($begnString);
   return (substr($str, 0, $len) === $begnString);
}




?>
