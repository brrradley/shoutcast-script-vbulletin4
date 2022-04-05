<div style="font-size:12px; width: 100%; height: 8em;">
    <p class="forumdescription">
        <div style="width: 97.5%; background: #FFF !important; padding: 10px !important;">
            <div class="userAvtrar" style="float:left;">
                <div>
                    <a href="member.php?u={vb:raw sctrack.userid}">
                        <img src="image.php?u={vb:raw sctrack.userid}" style="box-shadow: 0px 0px 2px 2px {vb:raw sctrack.state}; border: 0px solid #ccc; border-radius: 10%; width: 75px; height: 75px;" alt="" />
                    </a>
                </div>
            </div>
          
            <div id="playing2" style="float: left; border: 0px solid; border-radius: 75%; min-width: 15px; color: {vb:raw sctrack.state}; padding: 9px 10px 9px 10px; margin-left: 10px; margin-top: 3px; box-shadow: 0px 0px 3px 3px {vb:raw sctrack.state}; font-size: 1.6em; cursor: pointer;" title="Toggle Play" onclick="chPlay2()">&nbsp;<i class="fa fa-play" aria-hidden="true"></i>
            </div>
                    
            <div style="float: left; font-size: 1.3em; line-height: 150%; padding: 0px 0px 0px 5px; margin-left: 5px; margin-top: 3px;">
                <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; margin-top: -2px;">
                    <span class="artist">{vb:raw sctrack.artist}</span><br>
                    <span class="track">{vb:raw sctrack.track}</span>
                </div>
  
                <div style="float: left; margin-top: 6px; margin-left: -52px;">
                  
                    <div class="livestat" style="float:left;">
                        <div style="float: left; border: 1px solid; border-radius: 5px; background: {vb:raw sctrack.state}; color: #FFF; font-size: 0.7em; padding: 0px 6px 0px 6px;">{vb:raw sctrack.srcstat}&nbsp;&nbsp;|&nbsp;&nbsp;<i class="fa fa-street-view" aria-hidden="true"></i> <b>{vb:raw sctrack.listeners}</b>
                        </div>
                    </div>
            
                    <div style="float: left;">&nbsp;</div>
                    
                    <div style="float: left; border: 1px solid #ccc; border-radius: 5px; color: #4f4e4e; font-size: 0.7em; padding: 0px 6px 0px 6px; cursor: pointer;" title="Current artist playing"><b><a href="member.php?u={vb:raw sctrack.userid}"><i class="fa fa-user" aria-hidden="true"></i> <span class="userinfo">{vb:raw sctrack.userinfo}</span></a></b>
                    </div>
                    
                    <vb:if condition="is_member_of($bbuserinfo, 5,6,7,14,20,24,26)">
                        <div style="float: left;">&nbsp;</div>
                        
                        <div style="float: left; background: #5CB959; color: #FFF; border: 1px solid; border-radius: 5px; padding: 0px 6px 0px 6px; font-size: 0.7em !IMPORTANT; cursor: pointer; display: {vb:raw sctrack.br};" title="Connect to stream live"><a href="faq.php?faq=litecast#faq_howtoconnecttolitecast" style="color: #FFF!IMPORTANT; text-shadow: none!important;"><b><i class="fa fa-sign-in" aria-hidden="true"></i> CONNECT</b></a>
                        </div>
                    
                        <div style="float: left;">&nbsp;</div>
                        
                        <div style="float: left; color: #4B75DD; border: 1px solid #4B75DD; border-radius: 5px; padding: 0px 6px 0px 6px; font-size: 0.7em !IMPORTANT; cursor: pointer; display: {vb:raw sctrack.br2};" title="Chat with stream"><a href="forumdisplay.php?88-Main-Stage" style="color: #4B75DD!IMPORTANT; none!important;"><b><i class="fa fa-comments-o" aria-hidden="true"></i> CHAT</b></a>
                        </div>
                    </vb:if>

                </div>
            </div>
        </div>
    </p>
</div>

<script>
    (function poll() {
        setTimeout(function() {
            $.ajax({
                url: "ajax.php?do=shoutcast",
                type: "GET",
                success: function(data) {
                    $('.artist').text(data.artist);
                    $('.state').text(data.state);
                    $('.bkstate').text(data.bkstate);
                    $('.br').text(data.br);
                    $('.br2').text(data.br2);
                    $('.track').text(data.track);
                    $('.bitrate').text(data.bitrate + ' kpbs');
                    $('.listeners').text(data.listeners);
                    $('.srcstat').text(data.srcstat);
                    $('.userinfo').text(data.userinfo);
                    $('.userid').text(data.userid);
                    $('.aside').text(data.srcstat);
                    $('.userAvtrar').html
                        ('<div style="float: left;"><div><a href="member.php?u='+data.userid+'"><img src="image.php?u='+data.userid+'" style="width: 75px; height: 75px; border-radius: 10%; box-shadow: 0px 0px 2px 2px '+data.state+';" alt="" border="0" /></a></div></div>');
					$('.livestat').html
                        ('<div style="float: left; border: 1px solid; border-radius: 5px; background: '+data.state+'; color: #FFF; font-size: 0.7em; padding: 0px 6px 0px 6px;">'+data.srcstat+'&nbsp;&nbsp;|&nbsp;&nbsp;<i class="fa fa-street-view" aria-hidden="true"></i> <b>'+data.listeners+'</b></div>');
                },
                dataType: "json",
                complete: poll,
                timeout: 2000
            })
        }, 10000);
    })();
</script>

<script language="javascript">
    (function poll() {
        setTimeout(function() {
            $.ajax({
                url: "ajax.php?do=shoutcast2",
                type: "GET",
                success: function(data) {
                    $('.artist').text(data.artist);
                    $('.state').text(data.state);
                    $('.bkstate').text(data.bkstate);
                    $('.br').text(data.br);
                    $('.br2').text(data.br2);
                    $('.track').text(data.track);
                    $('.bitrate').text(data.bitrate + ' kpbs');
                    $('.listeners').text(data.listeners);
                    $('.srcstat').text(data.srcstat);
                    $('.userinfo').text(data.userinfo);
                    $('.userid').text(data.userid);
                    $('.aside').text(data.srcstat);
                    $('.userAvtrar').html
                        ('<div style="float: left;"><div><a href="member.php?u='+data.userid+'"><img src="image.php?u='+data.userid+'" style="width: 75px; height: 75px; border-radius: 10%; box-shadow: 0px 0px 2px 2px '+data.state+';" alt="" border="0" /></a></div></div>');
					$('.livestat').html
                        ('<div style="float: left; border: 1px solid; border-radius: 5px; background: '+data.state+'; color: #FFF; font-size: 0.7em; padding: 0px 6px 0px 6px;">'+data.srcstat+'&nbsp;&nbsp;|&nbsp;&nbsp;<i class="fa fa-street-view" aria-hidden="true"></i> <b>'+data.listeners+'</b></div>');
                },
                dataType: "json",
                complete: poll,
                timeout: 2000
            })
        }, 10000);
    })();
</script>

<!-- # PLAYER ELEMENTS # -->

<script language="javascript">
    function chPlay2() {
        if (document.getElementById("playing2").title =="Toggle Play") 
        {
            audio.play();
            document.getElementById("playing2").title = "Toggle Stop";
            document.getElementById("playing2").innerHTML = '<i class="fa fa-stop" aria-hidden="true"></i>';
            document.getElementById("playing2").style.padding = "11px 11px 11px 13px";
        }
            else
        {
            audio.pause();
            document.getElementById("playing2").title = "Toggle Play";
            document.getElementById("playing2").innerHTML = '&nbsp;<i class="fa fa-play" aria-hidden="true"></i>';
            document.getElementById("playing2").style.padding = "9px 10px 9px 10px";
        }
    }
</script>

<audio id="stream" controls preload="none" style="width: 100%;" hidden="false">
    <source src="http://192.241.129.98:9998/;" type="audio/mpeg">
</audio>

<script>
    var audio = document.getElementById('stream');
    audio.volume = 1;
</script>