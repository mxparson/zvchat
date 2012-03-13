<?php
define('TIME_STAMP',time()); 

function monotime()
{
	return microtime(true)*10000;
}
$filename  = dirname(__FILE__).'/data.txt';
$log_file = dirname(__FILE__) . '/all.txt';
$filenamemtime = $filename . ".mtime";
 
// store new message in the file
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
$username = isset($_GET['username']) ? $_GET['username'] : '';
if ($msg != '' && $username != '')
{
	$msg = "[". date("H:i:s",TIME_STAMP). "]\t". trim(strip_tags($username)). ":\t". trim(strip_tags($msg));
    file_put_contents($filename,$msg);
    file_put_contents($log_file, $msg . "\r\n" . file_get_contents($log_file), LOCK_EX);
    file_put_contents($filenamemtime,monotime());
  die();
}
 
$lastmodif    = isset($_GET['timestamp']) ? $_GET['timestamp'] : 0;
$currentmodif = file_get_contents($filenamemtime);

while ($currentmodif <= $lastmodif) // check if the data file has been modified
{
	if( (time()-TIME_STAMP) >10)
    {
		exit();
	}
  usleep(100000); // sleep 10ms to unload the CPU
  clearstatcache();
  $currentmodif = file_get_contents($filenamemtime);

}
 
// return a json array
$response = array();
$response['msg']       = file_get_contents($filename);
$response['timestamp'] = $currentmodif;
echo json_encode($response);
flush();

