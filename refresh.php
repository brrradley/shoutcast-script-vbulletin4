<?php // Remove PHP tags if using within vBulletin plugin

// Create plugin. Hook Location: ajax_start

if($_REQUEST['do'] == 'shoutcast2'){  

class radioStats {               
    public $tags;   
    public $serverStatus;   
    public $serverTitle;   
    public $currentListeners;   
    public $currentSong;   
    public $version;   
    public $songList = array();   
    public function __construct( $server, $port, $extra, $user, $password ) {   
        /* Start cURL */   
        $session = curl_init();   
        curl_setopt( $session, CURLOPT_URL, $server . ":" . $port . $extra );   
        curl_setopt( $session, CURLOPT_HEADER, false );   
        curl_setopt( $session, CURLOPT_RETURNTRANSFER, true );   
        curl_setopt( $session, CURLOPT_POST, false );   
        curl_setopt( $session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );   
        curl_setopt( $session, CURLOPT_USERPWD, $user . ":" . $password );   
        curl_setopt( $session, CURLOPT_FOLLOWLOCATION, true );   
        curl_setopt( $session, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );   
        $xml = curl_exec( $session );   
        curl_close( $session );   
        /* End cURL */   

        /* Start Simple XML */   
        $simpleXML = simplexml_load_string( $xml );    
        $this->xml = $simpleXML;   
    }   

    public function returnStats() {   
        return $this->xml;       
    }           
}   

// Remember to change *HOST*, *PORT*, *USER*, *PASSWORD* to match your details
$array = array(); 
$array['host'] = "*HOST*"; 
$array['port'] = "*PORT*"; 
$array['extra'] = "/admin.cgi?sid=1&mode=viewxml&page=1"; 
$array['user'] = "*USER*"; 
$array['password'] = "*PASSWORD*"; 
$radioStats = new radioStats( $array['host'], $array['port'], $array['extra'], $array['user'], $array['password']); 
$stats = $radioStats->returnStats(); 

$sctrack = array(); 
$sctrack['title'] = (string) $stats->SONGTITLE[0]; 
$sctrack['bitrate'] = (string) $stats->BITRATE[0]; 
$sctrack['listeners'] = (string) $stats->CURRENTLISTENERS[0]; 
$sctrack['version'] = (string) $stats->VERSION[0]; 

// File title formatting
if(strtolower(substr($sctrack['title'], 0, 7)) == 'live - '){
    // Connection is live
        $sctrack['state'] = '#B96259'; // Font color: red
        $sctrack['bkstate'] = 'forum-alt-red.png'; // Image background (red)
        $sctrack['srcstat'] = '<i class="fa fa-rocket" aria-hidden="true"></i> <b> LIVE</b>'; 
        $sctrack['title'] = substr($sctrack['title'], 7);  // Removes the "live - " from the title
            $tmp = explode(" - ", $sctrack['title']); // splits the title into 2 pieces at " - "
            $newtmp = explode("_", $tmp[1]); // splits the result into 2 pieces at "_"
                $sctrack['artist'] = $tmp[0]; 
                $sctrack['track'] = $newtmp[0]; 
                $sctrack['userid'] = $newtmp[1];                 
            $userinfo=fetch_userinfo($sctrack['userid']); 
            $sctrack['userinfo']=$userinfo['username']; 
    } else { 
    // AutoDJ is active
        $sctrack['state'] = '#D9B241'; // Font color: orange
        $sctrack['bkstate'] = 'forum-alt.png'; // Image background (original)
        $sctrack['srcstat'] = '<i class="fa fa-rss" aria-hidden="true"></i> <b> AUTO</b>'; 
            $tmp = explode(" - ", $sctrack['title']); // splits the title into 2 pieces at " - "
            $newtmp = explode("_", $tmp[1]); // splits the result into 2 pieces at "_"
                $sctrack['artist'] = $tmp[0]; 
                $sctrack['track'] = $newtmp[0]; 
                $sctrack['userid'] = $newtmp[1];                 
            $userinfo=fetch_userinfo($sctrack['userid']); 
            $sctrack['userinfo']=$userinfo['username']; 
    } 
        echo json_encode($sctrack);  
    exit;  
}  

// Remove PHP tags if using within vBulletin plugin
?> 