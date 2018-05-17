<?php
/**
 * @author        Jesse Boyer <contact@jream.com>
 * @copyright    Copyright (C), 2011-12 Jesse Boyer
 * @license        GNU General Public License 3 (http://www.gnu.org/licenses/)
 *                Refer to the LICENSE file distributed within the package.
 *
 * @link        http://jream.com
 *
 * @internal    Inspired by Klein @ https://github.com/chriso/klein.php
 */

class Route
{
    /**
     * submit - Looks for a match for the URI and runs the related function
     */
    public function submit()
    {
        $uri = isset($_REQUEST['uri']) ? $_REQUEST['uri'] : '/';
        $routerFragments = explode("/",$uri);
        $routerFragments[0] = ucfirst($routerFragments[0]) . "Controller";
        $namespace = "\Controller\\" . $routerFragments[0];
        if(class_exists($namespace)){
            $controller = new $namespace;
            //UserController->index();
            $function = $routerFragments[1];
            // array( $obj, 'method' )
            // [$obj, 'method']
            // TODO MODIFIED
            $controller->viewTemplate = $function . ".php";
            //counts Views/Calls for all function for analitical purposes.
            $cookieManager=new \services\CookieManager();
            if($cookieManager->isCookieSet($namespace."\\".$function)){
                $cookieManager->setCookie($namespace."\\".$function,$cookieManager->getCookie($namespace."\\".$function)+1);
            }else{
                $cookieManager->setCookie($namespace."\\".$function,1);
            }
            @call_user_func_array([$controller, $function],array_slice($routerFragments,2));
        }else{
            /*throw new Error("Damn Daniel back at nonexistent pages again😂😂😂😂😂😂😂
             Page not found!!!!!!!!!!!!!!!!!", 404);*/?>
            <head>
                <title>Damn Daniel</title>
                <script type='text/javascript'>
                    function shuffle(){
                        emoji.innerHTML="";
                        for(var i=0; i<emojis.length; i++){
                            emoji.innerHTML+=emojis[Math.floor(Math.random()*emojis.length)];
                        }
                        setTimeout("shuffle()",1500);
                    }
                </script>
                <style>
                    #image:hover{
                        /*border: 5px solid #f4f4f4;*/
                        transform: scale(4.20);
                        -webkit-transition-duration: 1s;
                        -moz-transition-duration: 1s;
                        -o-transition-duration: 1s;
                        transition-duration: 1s;
                        z-index: 3
                    }
                </style>
            </head>
            <?php $videoArr=array('6Oj79WGfQec','qXZM5bxoccc','C-FJWkASE2k','Mk6mGEst7mM');?>
            <body onload="shuffle()">
                <div>
                    <img src="http://i0.kym-cdn.com/photos/images/original/001/117/432/515.gif" style="width:100%; height:100%; z-index: -1;">
                    <div id="player" style="z-index: 599; position: absolute; right: 0; bottom: 0; max-height: 25%; max-width: 25%;"></div>
                    <!--<iframe id="video" width="560" height="315" src="https://www.youtube-nocookie.com/embed/?autoplay=1&amp;rel=0&amp;controls=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen style="z-index: 2; position: absolute; right: 0; bottom: 0; max-height: 50%; max-width: 50%;"></iframe>-->
                    <img src="https://emojipedia-us.s3.amazonaws.com/thumbs/120/apple/129/face-screaming-in-fear_1f631.png" id="image" style="position: absolute; z-index: 255; top: 25%; height: 10%; width:10%; left:25%; overflow: hidden;">
                    <div style="z-index: 25; font-size: 4.20cm; top: 0; left: 0; position: absolute;">Page not found
                        <span id="emoji">😂😂😂🤣🤣🤣🤔🤔🤔😭😭😭😱😱</span>
                </div>
            </body>
            <script>
                var emoji = document.getElementById('emoji');
                var arr=emoji.innerHTML.split('');
                var emojis = [];
                for(var i=0; i+1<arr.length; i++) {
                    emojis.push(arr[i] + arr[i + 1]);
                    i++;
                }
                var image=document.getElementById("image");

                var tag = document.createElement('script');
                tag.src = "https://www.youtube.com/iframe_api";
                var firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                var player;
                function onYouTubeIframeAPIReady() {
                    player = new YT.Player('player', {
                        height: '480',
                        width: '720',
                        videoId: '<?php echo $videoArr[array_rand($videoArr)]?>',
                        events: {
                            'onReady': onPlayerReady
                        }
                    });
                }
                function onPlayerReady(event) {
                    event.target.playVideo();
                }
            </script>
        <?php
        }

    }

}










