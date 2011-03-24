<?php
/*
	JoomlaXTC VAI Mediacenter module

	version 1.6
	
	Copyright (C) 2009,2010 Monev Software LLC.
	
	All Rights Reserved.
	
	THIS PROGRAM IS NOT FREE SOFTWARE
	
	You shall not modify, copy, duplicate, reproduce, sell, license or
	sublicense the Software, or transfer or convey the Software or
	any right in the Software to anyone else without the prior
	written consent of Developer; provided that Licensee may make
	one copy of the Software for backup or archival purposes.
	
	Monev Software LLC
	www.joomlaxtc.com
*/

$url = trim($_REQUEST['url']);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$info = curl_exec($ch);

$pos1 = strpos($info, '"video_id": "');
$pos2 = strpos($info, '"t": "');

$video_id = substr($info, $pos1 + 13);
$video_id = substr($video_id, 0, strpos($video_id, '", '));

$tag_t = substr($info, $pos2 + 6);
$tag_t = substr($tag_t, 0, strpos($tag_t, '", '));

$response  = '<video>';
$response .= '<id>' . $video_id . '</id>';
$response .= '<t>' . $tag_t . '</t>';
$response .= '</video>';

header("Content-type: text/xml");   
  
echo $response;
  
curl_close($ch);
?>
