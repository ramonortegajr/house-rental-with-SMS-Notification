<?php 
 
// Update the path below to your autoload.php, 
// see https://getcomposer.org/doc/01-basic-usage.md 
require_once '/path/to/vendor/autoload.php'; 
 
use Twilio\Rest\Client; 
 
$sid    = "ACb1f790a5ef1513a3826077fa8332737c"; 
$token  = "[cf434955e4ce613a547e1924df191e31]"; 
$twilio = new Client($sid, $token); 
 
$message = $twilio->messages 
                  ->create("+639518767704", // to 
                           array(        
                               "body" => "Your message" 
                           ) 
                  ); 
 
print($message->sid);