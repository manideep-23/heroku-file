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


$agg = json_encode($update,JSON_PRETTY_PRINT);

$exec=0;
 if(begnWith($text,"16881"))
 {
	 if(strlen($text)==10)
		 $exec=1;
	 else
		sendMessage($chatID,"Enter the Valid Rollnumber!"); 
 }
if($exec==1)
{
	include("simple_html_dom.php");

	$x=$text;
	
	$y="it_hod_vce";
		$data = array(
"rollno"=> $x,
"wak"=> $y,
"ok"=> "SignIn"
);
function login($url,$data){
    $fp = fopen("cookie.txt", "w");
    fclose($fp);
    $login = curl_init();
    curl_setopt($login, CURLOPT_COOKIEJAR, "cookie.txt");
    curl_setopt($login, CURLOPT_COOKIEFILE, "cookie.txt");
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
		//header("location:alert.html");
        
            break;		 
	        }
	}
	 if($flag==1)
 {
$c=login("http://studentscorner.vardhaman.org/Students_Corner_Frame.php",$data);	 
	$html =new simple_html_dom();
	$html->load($c);
	$c=login("http://studentscorner.vardhaman.org/src_programs/students_corner/CreditRegister/credit_register.php",$data);	 
	$html =new simple_html_dom();
	$html->load($c);
	echo "<table width=160>";
	$q=0;
	foreach($html->find("font[color=blue][size=4]") as $link)
	{
		if($q!=0)
		{
		echo "<tr>";
	sendMessage($chatID,$link->plaintext."<br>");
	echo "</tr>";
	break;
		}
		$q=1;
	}
	$c=login("http://studentscorner.vardhaman.org/student_attendance.php",$data);	 
	$html =new simple_html_dom();
	$html->load($c);
	
$c=0;
	foreach($html->find("font[size=5]") as $link)
	{$c=1;
		//echo "Attendance :";
		//echo "<br>";
	sendMessage($chatID,"Attendance Percentage : ".$link->plaintext);
	break;
	
	}	
	
	if($c==0)
	{
		sendMessage($chatID,"Attendance Percentage : Currently not available");

		//echo "Attendance :";
	 //echo "Currently not Available";
	}	


                  
 }
	
	
	
}


if($exec==0)
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
		sendMessage($chatID,$name);
		break;
		case"/who_am_i":
		sendMessage($chatID,"I am a vardhaman Bot..What's Next?");
		break;
		case"/rollnumber":
		sendMessage($chatID,"Enter Your Rollnumber");
		default:
		sendMessage($chatID,"options You have : /start \n /hello \n /my_name \n /who_am_i  \n /rollnumber");
		
		

}

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
