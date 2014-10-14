<?php
// check if fields passed are empty
if(empty($_POST['name'])  		||
   empty($_POST['phone']) 		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = $_POST['name'];
$phone = $_POST['phone'];
$email_address = $_POST['email'];
$message = $_POST['message'];
	
// create email body and send it	
$to = 'jinqi.yin@163.com'; // PUT YOUR EMAIL ADDRESS HERE
$subject = "TransPic Contact Form:  $name"; // EDIT THE EMAIL SUBJECT LINE HERE
$comment = "You have received a new message from your website's contact form.\n\n"."Here are the details:\n\nName: $name\n\nPhone: $phone\n\nEmail: $email_address\n\nMessage:\n$message";
//$headers = "From: noreply@transpic.linuxd.org\n";
//$headers .= "Reply-To: $email_address";	
//mail($to,$email_subject,$email_body,$headers);

// send mail by my phpfog server 
/*
 *
 *
 */
function postHtmlByCURL($params,$url="https://japi.ap01.aws.af.cm/st/noti.php?ak=d8n8s2ij4t4w4iw4m4i2c5"){

     $ch = curl_init();
     curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);                                                                          
     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
     $result = curl_exec($ch);
     curl_close($ch);
     return $result;
}

function sendmail($email,$comment,$subject='TransPic',$from='noreply@transpic.linuxd.org'){
        /* */
        $params=array(
                'from'=>$from,
                'subject'=>$subject,
                'email'=>$email,
                'comment'=>$comment);
        $rtn = postHtmlByCURL($params);
        if(substring($rtn, 'SUCESS') > 0 ){
                return true;
        }else{
                return false;
        }

}
sendmail($email_address,$comment,$subject);

return true;			
?>
