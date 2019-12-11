<?php

header("Access-Control-Allow-Origin: *");
$filename= "audio-file.flac";
$file = fopen($filename, 'r');
$filesize = filesize($filename);
$bytes = fread($file,$filesize);
$data = array('part_content_type' => 'audio/flac');
$headers = array("Content-Type: audio/flac", "Transfer-Encoding: chunked");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://gateway-lon.watsonplatform.net/speech-to-text/api//v1/recognize');
curl_setopt($ch, CURLOPT_USERPWD, 'apikey' . ':' . 'fofYHLPM6a4cu76ayr1AwKwqwrGHOsj9BYMYVU9shsrx');
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $bytes);
curl_setopt($ch, CURLOPT_INFILESIZE, $filesize);
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
if (curl_errno($ch)) 
{
    echo 'Error:' . curl_error($ch);
}
echo $result;
curl_close($ch);

?>