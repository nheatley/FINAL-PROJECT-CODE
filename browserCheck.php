<?php

function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // NEXT CHECK NAME OF THE USER AGENT
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE";
        
        // DIRECTED TO THE BROWSER ERROR PAGE
        header("location: browserCheckErrorPage.php");  
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 

    } 
      elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
        
        // DIRECTED TO THE BROWSER ERROR PAGE
        header("location: browserCheckErrorPage.php"); 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari";
        
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
        
        
        // DIRECTED TO THE BROWSER ERROR PAGE
        header("location: browserCheckErrorPage.php"); 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
        
        // DIRECTED TO THE BROWSER ERROR PAGE
        header("location: browserCheckErrorPage.php"); 
    } else
      {
      
      $bname = $u_agent;
      
      // DIRECTED TO THE BROWSER ERROR PAGE
      header("location: browserCheckErrorPage.php"); 
      }
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
    
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 

// now try it
$ua=getBrowser();
$yourbrowser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];
// $error = "THIS IS A CHECKER";

//print_r($ua['version']);

// IF STATEMENT TO SAY THAT IF THE BROWSER IS NOT:
// GOOGLE CHROME VERSION 71 OR HIGHER
// APPLE SAFARI VERSION 10 OR HIGHER
// THEN DIRECT USER TO THE VERSION ERROR PAGE
if( ($ua['name'] == 'Google Chrome' && $ua['version'] < '70.0.0000.00') || ($ua['name'] == 'Apple Safari' && $ua['version'] < '10.0.0')) {
 
 //DIRECTED TO THE VERSION ERROR PAGE
 header("location: browserCheckErrorPage.php"); 
}
?>