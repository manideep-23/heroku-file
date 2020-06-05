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


 echo "byee";



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





		



function sendMessage($chatID,$text)
{
	
	$url = $GLOBALS[website]."/sendMessage?chat_id=$chatID&text=".urlencode($text);
	file_get_contents($url);
}





?>

