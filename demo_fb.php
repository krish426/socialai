<?php        
  require_once "inc/nxs-functions.php";  require_once "inc-cl/fb.api.php"; 
  require_once "nxs-api/nxs-http.php"; 
  $message = array(
      'url'=>'https://www.nextscripts.com/snap-api/',
      'siteName' => 'oengines',
      'urlDescr'=>'Social Networks Auto Poster (SNAP) API', 
      'urlTitle'=>'Social Networks Auto Poster API', 
      'imageURL' => array(
        'large'=>'https://www.nextscripts.com/images/SNAP-Logo_Big_SQ.png'
      ), 
      'pTitle'=>'Social Networks Auto Poster (SNAP) API', 
      'pText'=>'Social Networks Auto Poster (SNAP) API is
         a universal API for the most popular social networks', 
  ); 

  // 20d8ac6ed504509a588ba7a74e8ffeb1
  $NToptions = array();
  $NToptions['uName'] = 'Reversi-Offline-Community';
  $NToptions['fbURL'] = 'https://www.facebook.com/Reversi-Offline-Community-488953118136750/';
  $NToptions['atpKey'] = '262227294283704';
  $NToptions['appSec'] = 'a548b234061a1b40a8862694c5c04452';
  $NToptions['fbAppAuthToken'] = '262227294283704|GP9iYfNEcUkfwlTYhcW-wKxDCLc';
  $NToptions['fbAppPageAuthToken'] = 'EAADufoy557gBAHvoP0U9gNt9kmAEy4lT04pgoDOSNEqjelXLDZBk1BxWfnkzaQ0F0I1VmRWpxtX3FtrnY0EVWWvIuiVsQEuyaDVMwAp08IOWsC7lZBHWl8SriQdHKgW0iZCYW3PRkJ21kV57KjITZCvpcZCkdl5koumYX5znha3e11cX3ZAq2ZBFEQ6tFjgwDcrspT8lOD6qgZDZD'; //## If you are posting to a page
  $NToptions['postType'] = 'A';
  $NToptions['attachType'] = '1';
  $NToptions['imgUpl'] = '2';
  $NToptions['destType'] = '';
  $NToptions['appsecret_proof'] = '';
  $NToptions['fbAppSec'] = 'a548b234061a1b40a8862694c5c04452';
  $NToptions['pgID'] = '488953118136750';
  
  $ntToPost = new nxs_class_SNAP_FB(); 
  $result = $ntToPost->doPostToNT($NToptions, $message);   
  if (!empty($result) && is_array($result) && !empty($result['postURL'])) 
    echo '<a target="_blank" href="'.$result['postURL'].'">New Post</a>'; 
  else 
    echo "<pre>".print_r($result, true)."</pre>";
?>