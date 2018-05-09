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
                    var emoji = document.getElementById('emoji');
                    function shuffle(){
                        emoji.innerHTML=emoji.innerHTML.split('').sort(function(){return 0.5-Math.random()}).join('');
                        setTimeout("shuffle()",1000);
                    }
                </script>
                <script type="text/javascript"></script>
            </head>
            <body onload="shuffle()">
                <div>
                    <img src="http://i0.kym-cdn.com/photos/images/original/001/117/432/515.gif" style="width:100%; height:100%; z-index: -1;">
                    <div style="z-index: 25; font-size: 4.20cm; top: 0; left: 0; position: absolute;">Page not found
                        <span id="emoji">😂😂😂🤣🤣🤣😂😂😂😭😭😭😂😂</span>
                </div>
                    <script>shuffle()</script>
            </body>
        <?php
        }

    }

}










