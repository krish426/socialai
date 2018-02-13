<?php

/*#############################################################################
Project Name: NextScripts Social Networks AutoPoster
Project URL: http://www.nextscripts.com/snap-api/
Description: Automatically posts to all your Social Networks
Author: NextScripts, Inc
Version: 1.0.0.Beta 19 (Jan 10, 2014)
Author URL: http://www.nextscripts.com
Copyright 2012-2014  NextScripts, Inc
#############################################################################*/

require_once "nxs-api/nxs-api.php";  require_once "nxs-api/nxs-http.php"; require_once "nxs-functions.php";

  $email = 'YourEmail@gmail.com'; 
  $pass = 'YourPassword';
  $msg = 'Post this to Google Plus!'; 
  $pageID = '109888164682746252347';
  $lnk = 'http://www.nextscripts.com/social-networks-auto-poster-for-wp-multiple-accounts';
  
  $email = 'vhrenov6@gmail.com';
  $pass = '53456FT9';
  $pageID = '';
  
  //## Post simple message to account. 
   
  $nt = new nxsAPI_GP();
  $loginError = $nt->connect($email, $pass);     
  if (!$loginError)
  {
	  $result = $nt -> postGP($msg);
  } 
  else echo $loginError; 
  
  if (!empty($result) && is_array($result) && !empty($result['post_url'])) 
  echo '<a target="_blank" href="'.$result['post_url'].'">New Post</a>'; else echo "<pre>".print_r($result, true)."</pre>";
	
die();
  
  //## Post simple message to page. 
  $nt = new nxsAPI_GP();
  $loginError = $nt->connect($email, $pass);     
  if (!$loginError)
	{
	  $result = $nt -> postGP($msg, '', $pageID);
	} 
  else echo $loginError; 
  
  if (!empty($result) && is_array($result) && !empty($result['post_url'])) 
	echo '<a target="_blank" href="'.$result['post_url'].'">New Post</a>'; else echo "<pre>".print_r($result, true)."</pre>";

die();  

  //## Post link message to page.      
  $nt = new nxsAPI_GP();
  $loginError = $nt->connect($email, $pass);     
  if (!$loginError)
	{
	  $lnk = array('img'=>'http://www.nextscripts.com/imgs/nextscripts.png'); 
	  $result = $nt -> postGP($msg, $lnk, $pageID);
	  
	  if (!empty($result) && is_array($result) && !empty($result['post_url'])) 
		echo '<a target="_blank" href="'.$result['post_url'].'">New Post Link</a>'; else echo "<pre>".print_r($result, true)."</pre>";
	} 
  else echo $loginError; 
	
die();

//## Post to Twitter

require_once "nxs-functions.php";  require_once "inc-cl/tw.api.php"; 

$message = array();
$message['text'] = 'Test Post';
$message['imageURL'] = 'http://www.nextscripts.com/imgs/nextscripts.png';

$TWoptions = array();

$TWoptions['twURL'] = 'https://twitter.com/YourTWPage';
$TWoptions['twConsKey'] = 'KEY';
$TWoptions['twConsSec'] = 'SEC';
$TWoptions['twAccToken'] = 'TTT-TOK';
$TWoptions['twAccTokenSec'] = 'TOKSEC';
$TWoptions['twMsgFormat'] = '%TEXT%';
$TWoptions['attchImg'] = '1';


$ntToPost = new nxs_class_SNAP_TW(); 
$ret = $ntToPost->doPostToNT($TWoptions, $message); 
prr($ret);
   
die();