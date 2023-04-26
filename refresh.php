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
if (strtolower(str_contains($sctrack['title'], "[live]"))) { // if title contains [live]
    // connection is live
        $sctrack['srcstat'] = '<i class="fa fa-rocket" aria-hidden="true"></i> <b> LIVE</b>'; // add LIVE icon and label to page
        $sctrack['title'] = str_replace("[live]", "", $sctrack['title']); // remove [live] from title
        $tmp = explode(" - ", $sctrack['title']); // splits the title into 2 pieces at " - "
        $sctrack['artist'] = $tmp[0]; // display first half of title 'artist'
        $sctrack['track'] = $tmp[1]; // display second half of title 'track'
        $sctrack['state'] = '#B96259'; // font color: red
    
            if (strtolower(str_contains($sctrack['title'], "[id:"))) {
            // if title contains [id:] (user:id)
                $str_from = strpos($sctrack['title'], "[id:"); // find start of [id:]
                $str_to = strpos($sctrack['title'], "]", $str_from); // find end of [id:]
                $str_id_len = ($str_to) - ($str_from); // find length of [id:]
                    $sctrack['userid'] = substr($sctrack['title'], $str_from + 4, $str_id_len - 4); // declares user:id
                    $str_unf = substr($sctrack['title'], $str_from, $str_id_len + 1); // finds [id:]
                    $sctrack['title'] = str_replace($str_unf, "", $sctrack['title']); // remove [id:] from title
            } else {
                $sctrack['userid'] = "19160"; // liteBOT
            };
    } else { 
    // AutoDJ is active
        $sctrack['state'] = '#D9B241'; // font color: orange
        $sctrack['srcstat'] = '<i class="fa fa-rss" aria-hidden="true"></i> <b> AUTO</b>'; // add AUTO icon and label to page
        $tmp = explode(" - ", $sctrack['title']); // splits the title into 2 pieces at " - "
            $newtmp = explode("_", $tmp[1]);  // formats user:id from _
            $sctrack['artist'] = $tmp[0]; // display first half of title 'artist'
            $sctrack['track'] = $newtmp[0]; // display second half of title 'track'
            $sctrack['userid'] = $newtmp[1]; // declares user:id
    };
    
    $userinfo=fetch_userinfo($sctrack['userid']); // finds profile for user:id
    $sctrack['userinfo']=$userinfo['username']; // finds username of user:id
    
    echo json_encode($sctrack);  
    exit;  
}  

// Remove PHP tags if using within vBulletin plugin
