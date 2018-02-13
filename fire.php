<?php
/*#############################################################################
Project Name: NextScripts Social Networks AutoPoster
Project URL: http://www.nextscripts.com/snap-api/
Description: Automatically posts to all your Social Networks
Author: NextScripts, Inc
Version: 1.5.Beta 26 (Sept 01, 2016)
Author URL: http://www.nextscripts.com
Copyright 2012-2016  NextScripts, Inc
#############################################################################*/
// print_r($_POST);die;
error_reporting(E_ALL);

define('NXS_PLPATH', rtrim(dirname(__FILE__), '/\\') . '/');
define('NXS_PLURL', '');

require_once "inc/nxs-networks-class.php";
require_once "nxs-snap-class.php";

if($_POST['id'] && strlen($_POST['id'])  == 24){
    if (file_exists("inc/nxs-functions-".(string)$_POST['id'].".php"))
        require_once "inc/nxs-functions-".(string)$_POST['id'].".php";
}

// if (file_exists("nxs-user-functions.php"))
//     require_once "nxs-user-functions.php";

$options = nxs_settings_open();
if (empty($options))
    $options = array();
global $nxs_snapSetPgURL, $nxs_gOptions, $nxs_gNtwrks;
$nxs_snapSetPgURL = nxs_currPageURL();
$nxs_gOptions     = $options;
$nxs_gNtwrks      = $options;

$postTo = array(
    'tw' => array(
        0,
        2
    ),
    'fb' => array(
        0,
        1,
        2
    ),
    'li' => array(
        0,
        1
    ),
    'gp' => array(
        0,
        1,
        2
    )

);
//$options = nxs_filterOutSettings($postTo, $options);// prr($options);

//## AJAX
if (!empty($_POST) && !empty($_POST['action']) && $_POST['action'] == 'nxs_snap_aj') {
    if ($_POST['nxsact'] == 'getNTset') {
        $ii     = $_POST['ii'];
        $nt     = $_POST['nt'];
        $ntl    = strtolower($nt);
        $clName = 'nxs_snapClass' . $nt;
        $ntObj  = new $clName();
        if ($ii == 'N') {
            if (!isset($options[$ntl]) || count($options[$ntl]) == 0)
                $mt = 0;
            else
                $mt = 1 + max(array_keys($options[$ntl]));
            $ntObj->showNewNTSettings($mt);
        } else {
            $pbo                    = $options[$ntl][$ii];
            $pbo['ntInfo']['lcode'] = $ntl;
            $ntObj->showNTSettings($ii, $pbo, true);
        }
    }
    if ($_POST['nxsact'] == 'setNTset') {
        global $nxs_snapAvNts;
        unset($_POST['action']);
        unset($_POST['nxsact']);
        unset($_POST['_wp_http_referer']);
        unset($_POST['_wpnonce']); //unset($_POST['apDoSFB0']); // Do something
        if (get_magic_quotes_gpc() || (!empty($_POST['nxs_mqTest']) && $_POST['nxs_mqTest'] == "\'")) {
            array_walk_recursive($_POST, 'nsx_stripSlashes');
        }
        array_walk_recursive($_POST, 'nsx_fixSlashes');
        unset($_POST['nxs_mqTest']);
        foreach ($nxs_snapAvNts as $avNt)
            if (isset($_POST[$avNt['lcode']])) {
                $clName = 'nxs_snapClass' . $avNt['code'];
                if (!isset($options[$avNt['lcode']]))
                    $options[$avNt['lcode']] = array();
                $ntClInst                = new $clName();
                $ntOpt                   = $ntClInst->setNTSettings($_POST[$avNt['lcode']], $options[$avNt['lcode']]);
                $options[$avNt['lcode']] = $ntOpt;
            }
        nxs_settings_save($options);
        die('OK');
    }
    if ($_POST['nxsact'] == 'getNewPostDlg')
        nxs_showNewPostForm($options);
    if ($_POST['nxsact'] == 'tst') {
        echo "Testing [" . $_POST['nt'] . "] ....<br/><br/>";
        $ntl             = strtolower($_POST['nt']);
        /*$postTo          = array(
            $ntl => array(
                0,
                1,
            )
        );*/
        $postTo = array(
            'tw' => array(
                0,
                2
            ),
            'fb' => array(
                0,
                1,
                2
            ),
            'li' => array(
                0,
                1
            ),
            'gp' => array(
                0,
                1,
                2
            ),
            'ap' => array(0),
            'bg' => array(0),
            'da' => array(0),
            'di' => array(0),
            'dl' => array(0),
            'fl' => array(0),
            'fp' => array(0),
            'ig' => array(0),
            'ip' => array(0),
            'li' => array(0),
            'lj' => array(0),
            'mc' => array(0),
            'md' => array(0),
            'pk' => array(0),
            'pn' => array(0),
            'rd' => array(0),
            'sc' => array(0),
            'st' => array(0),
            'su' => array(0),
            'tg' => array(0),
            'tr' => array(0),
            'tw' => array(0),
            'vb' => array(0),
            'vk' => array(0),
            'wb' => array(0),
            'wl' => array(0),
            'wp' => array(0),
            'xi' => array(0),
            'yo' => array(0),
            'yt' => array(0)
        );
        // print_r($options);
        $options         = nxs_filterOutSettings($postTo, $options);
        $nxsAutoPostToSN = new cl_nxsAutoPostToSN($nxs_snapAPINts, $options);
        // print_r($nxsAutoPostToSN);die;
        $message         = array(
            'title' => (isset($_POST['message']['title'])) ? $_POST['message']['title'] : '',
            'text' => (isset($_POST['message']['title'])) ? $_POST['message']['title'] : '',
            'url' => (isset($_POST['message']['title'])) ? $_POST['message']['title'] : '',
            'message' => (isset($_POST['message']['description'])) ? $_POST['message']['description'] : '',
            'urlDescr' => (isset($_POST['message']['description'])) ? $_POST['message']['description'] : '',
            'urlTitle' => (isset($_POST['message']['title'])) ? $_POST['message']['title'] : '',
            'imageURL' => (isset($_POST['message']['imageurl'])) ? $_POST['message']['imageurl'] : '',
		  	'videoURL' => (isset($_POST['message']['videourl'])) ? $_POST['message']['videourl'] : '',
            'siteName' => (isset($_POST['message']['title'])) ? $_POST['message']['title'] : '',
            'announce' => (isset($_POST['message']['title'])) ? $_POST['message']['title'] : ''
        );
        //## Set Message
        $nxsAutoPostToSN->setMessage($message);
        //## Post Message
        $ret = $nxsAutoPostToSN->autoPost();
        // if (!empty($ret) && is_array($ret) && !empty($ret[$ntl][$_POST['nid']])) {
            // if (!empty($ret[$ntl][$_POST['nid']]['isPosted']))
                // echo 'All OK. Post URL: <a target="_blank" href="' . $ret[$ntl][$_POST['nid']]['postURL'] . '">' . $ret[$ntl][$_POST['nid']]['postURL'] . '</a>';
            // if (!empty($ret[$ntl][$_POST['nid']]['Error']))
                // echo '<b style="color:red;">Error: </b>' . $ret[$ntl][$_POST['nid']]['Error'];
        // }
        // echo "<br/><br/><hr/>Raw Output:<br/>";
        return print_r($ret);

    }
    if ($_POST['nxsact'] == 'doNewPost')
        nxs_doNewNPPost($options);
    if ($_POST['nxsact'] == 'nsDN') {
        $indx = (int) $_POST['id'];
        unset($options[$_POST['nt']][$indx]);
        nxs_settings_save($options);
    }
    die();
}
if (!empty($_POST) && !empty($_POST['action']) && $_POST['action'] == 'getBoards') {
    if (get_magic_quotes_gpc() || $_POST['nxs_mqTest'] == "\'") {
        $_POST['u'] = stripslashes($_POST['u']);
        $_POST['p'] = stripslashes($_POST['p']);
    }
    $_POST['p'] = trim($_POST['p']);
    $u          = trim($_POST['u']);
    $u          = $_POST['u'] != '' ? $_POST['u'] : $options['pn'][$_POST['ii']]['pnUName'];
    $p          = $_POST['p'] != '' ? $_POST['p'] : $options['pn'][$_POST['ii']]['pnPass'];
    $loginError = doConnectToPinterest($u, substr($p, 0, 5) == 'g9c1a' ? nsx_doDecode(substr($p, 5)) : $p);
    if ($loginError !== false) {
        echo $loginError;
        return "BAD USER/PASS";
    }
    $gPNBoards                                   = doGetBoardsFromPinterest();
    $options['pn'][$_POST['ii']]['pnBoardsList'] = base64_encode($gPNBoards);
    $options['pn'][$_POST['ii']]['pnSvC']        = serialize($nxs_gCookiesArr);
    nxs_settings_save($options);
    echo $gPNBoards;
    die();
}
if (!empty($_POST) && !empty($_POST['action']) && $_POST['action'] == 'getGPCats') {
    if (get_magic_quotes_gpc() || $_POST['nxs_mqTest'] == "\'") {
        $_POST['u'] = stripslashes($_POST['u']);
        $_POST['p'] = stripslashes($_POST['p']);
    }
    $_POST['p'] = trim($_POST['p']);
    $u          = trim($_POST['u']);
    $u          = $_POST['u'] != '' ? $_POST['u'] : $options['gp'][$_POST['ii']]['gpUName'];
    $p          = $_POST['p'] != '' ? $_POST['p'] : $options['gp'][$_POST['ii']]['gpPass'];
    $c          = $_POST['c'] != '' ? $_POST['c'] : $options['gp'][$_POST['ii']]['gpCommID'];
    $loginError = doConnectToGooglePlus2($u, substr($p, 0, 5) == 'n5g9a' ? nsx_doDecode(substr($p, 5)) : $p);
    if ($loginError !== false) {
        echo $loginError;
        return "BAD USER/PASS";
    }
    $gGPCCats                                   = doGetCCatsFromGooglePlus($c);
    $options['gp'][$_POST['ii']]['gpCCatsList'] = base64_encode($gGPCCats);
    nxs_settings_save($options);
    echo $gGPCCats;
    die();
}

//## END AJAX 

//## POST
if (!empty($_POST) && !empty($_POST['update_NS_SNAutoPoster_settings'])) {
    foreach ($nxs_snapAvNts as $avNt)
        if (isset($_POST[$avNt['lcode']])) {
            $clName = 'nxs_snapClass' . $avNt['code'];
            if (!isset($options[$avNt['lcode']]))
                $options[$avNt['lcode']] = array();
            $ntClInst                = new $clName();
            $ntOpt                   = $ntClInst->setNTSettings($_POST[$avNt['lcode']], $options[$avNt['lcode']]);
            $options[$avNt['lcode']] = $ntOpt;
        }
    nxs_settings_save($options);
}
//## END POST

//prr($options);

if (class_exists("cl_nxsAutoPostToSN")) {
    $nxsAutoPostToSN = new cl_nxsAutoPostToSN($nxs_snapAPINts, $options);
}?>