<!-- Add to your template -->

<container>
    <!-- Finds avatar of the artist that is playing -->
    <div class="userAvtrar">
        <div class="avatar" style="float:left;">
            <div>
                <a href="member.php?u={vb:raw sctrack.userid}">
                    <img src="image.php?u={vb:raw sctrack.userid}" style="box-shadow: 0px 0px 2px 2px {vb:raw sctrack.state};" />
                </a>
            </div>
        </div>
    </div>

    <div class="mPlayer2" id="playing2" style="float: left; border: 0px solid; border-radius: 75%; min-width: 15px; color: {vb:raw sctrack.state}; padding: 9px 10px 9px 10px; margin-left: 10px; margin-top: 3px; box-shadow: 0px 0px 3px 3px {vb:raw sctrack.state}; font-size: 1.6em; cursor: pointer;" title="Toggle Play" onclick="chPlay2()">
        &nbsp;
        <!-- Requires Fontawesome library -->
        <i class="fa fa-play" aria-hidden="true"></i>
    </div>

    <div class="radio_body">
        <div class="radio_titles">
            <span class="artist">{vb:raw sctrack.artist}</span><br>
            <span class="track">{vb:raw sctrack.track}</span>
        </div>

        <div style="float: left; margin-top: 6px; margin-left: -52px;">
            <div class="livestat" style="float:left;">
                <div class="radio_indicator_listeners" style="background: {vb:raw sctrack.state};">
                    <!-- Connection indicator -->
                    {vb:raw sctrack.srcstat}
                    <!-- Spacer -->
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <!-- Requires Fontawesome library -->
                    <i class="fa fa-street-view" aria-hidden="true"></i> <b>{vb:raw sctrack.listeners}</b>
                </div>
            </div>

            <!-- Spacer -->
            <div style="float: left;">&nbsp;</div>

            <div class="radio_user" title="Current artist playing">
                <b><a href="member.php?u={vb:raw sctrack.userid}">
                        <!-- Requires Fontawesome library -->
                        <i class="fa fa-user" aria-hidden="true"></i> <span class="userinfo">{vb:raw sctrack.userinfo}</span>
                    </a></b>
            </div>

            <!-- Set permissions -->
            <vb:if condition="is_member_of($bbuserinfo, 5,6)">
                <!-- Spacer -->
                <div style="float: left;">&nbsp;</div>

                <div class="radio_connect" style="display: {vb:raw sctrack.br};" title="Connect to stream live">
                    <!-- Add URL to where "Connect" will go to -->
                    <a href="ADD-URL" style="color: #FFF!important; text-shadow: none!important;">
                        <!-- Requires Fontawesome library -->
                        <b><i class="fa fa-sign-in" aria-hidden="true"></i> CONNECT</b>
                    </a>
                </div>

                <!-- Spacer -->
                <div style="float: left;">&nbsp;</div>

                <div style="display: {vb:raw sctrack.br2};" title="Chat with stream">
                    <!-- Add URL to where "Chat" will go to -->
                    <a href="ADD-URL" style="color: #4B75DD!important; text-shadow: none!important;">
                        <!-- Requires Fontawesome library -->
                        <b><i class="fa fa-comments-o" aria-hidden="true"></i> CHAT</b>
                    </a>
                </div>
            </vb:if>
        </div>
    </div>
</container>

<!-- Displays static information before the ajax refresh triggers -->
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
                    $('.userAvtrar').html('<div style="float:left;"><div><a href="member.php?u=' + data.userid + '"><img src="image.php?u=' + data.userid + '" style="width: 75px; height: 75px; border-radius: 10%; box-shadow: 0px 0px 2px 2px ' + data.state + ';" alt="" border="0" /></a></div></div>');

                    $('.mPlayer2').css({
                        'color': '' + data.state + '',
                        'box-shadow': '0px 0px 3px 3px ' + data.state + ''
                    });

                    $('.livestat').html('<div style="float: left; border: 1px solid; border-radius: 5px; background: ' + data.state + '; color: #FFF; font-size: 0.7em; padding: 0px 6px 0px 6px;">' + data.srcstat + '&nbsp;&nbsp;|&nbsp;&nbsp;<i class="fa fa-street-view" aria-hidden="true"></i> <b>' + data.listeners + '</b></div>');

                },
                dataType: "json",
                complete: poll,
                timeout: 2000
            })
        }, 10000);
    })();
</script>
<!-- Ajax refresh triggers updated information -->
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
                    $('.userAvtrar').html('<div style="float:left;"><div><a href="member.php?u=' + data.userid + '"><img src="image.php?u=' + data.userid + '" style="width: 75px; height: 75px; border-radius: 10%; box-shadow: 0px 0px 2px 2px ' + data.state + ';" alt="" border="0" /></a></div></div>');

                    $('.mPlayer2').css({
                        'color': '' + data.state + '',
                        'box-shadow': '0px 0px 3px 3px ' + data.state + ''
                    });

                    $('.livestat').html('<div style="float: left; border: 1px solid; border-radius: 5px; background: ' + data.state + '; color: #FFF; font-size: 0.7em; padding: 0px 6px 0px 6px;">' + data.srcstat + '&nbsp;&nbsp;|&nbsp;&nbsp;<i class="fa fa-street-view" aria-hidden="true"></i> <b>' + data.listeners + '</b></div>');

                },
                dataType: "json",
                complete: poll,
                timeout: 2000
            })
        }, 10000);
    })();
</script>

<!-- Player controls -->
<script language="javascript">
    function chPlay2() {
        if (document.getElementById("playing2").title == "Toggle Play") {
            audio.play();
            document.getElementById("playing2").title = "Toggle Stop";
            document.getElementById("playing2").innerHTML = '<i class="fa fa-stop" aria-hidden="true"></i>';
            document.getElementById("playing2").style.padding = "11px 11px 11px 13px";
        } else {
            audio.pause();
            document.getElementById("playing2").title = "Toggle Play";
            document.getElementById("playing2").innerHTML = '&nbsp;<i class="fa fa-play" aria-hidden="true"></i>';
            document.getElementById("playing2").style.padding = "9px 10px 9px 10px";
        }
    }
</script>

<!-- Player is hidden and controlled with elements -->
<audio id="stream" controls preload="none" style="width: 100%;" hidden="false">
    <source src="http://192.241.129.98:9998/;" type="audio/mpeg">
</audio>

<!-- Sets volume to player -->
<script>
    var audio = document.getElementById('stream');
    audio.volume = 1;
</script>