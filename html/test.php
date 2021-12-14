<?php
function file_get_contents_curl($url) {
    $ch = curl_init();
  
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
  
    $data = curl_exec($ch);
    curl_close($ch);
  
    return $data;
}
  
$data = file_get_contents_curl(
'https://media.geeksforgeeks.org/wp-content/uploads/geeksforgeeks-6-1.png');
  
$fp = 'logo-1.png';
  
file_put_contents( $fp, $data );
?>