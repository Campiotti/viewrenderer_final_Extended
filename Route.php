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
        ini_set('display_errors', 0);
        ini_set('log_errors',1);
        ini_set('error_log', __DIR__ . '/error/Error.log');
        register_shutdown_function(function(){
            $last_error = error_get_last();
            if ( !empty($last_error) &&
                $last_error['type'] & (E_ERROR | E_COMPILE_ERROR | E_PARSE | E_CORE_ERROR | E_USER_ERROR)
            )
            {
                require_once(dirname(__FILE__).'/error.php');
                exit(1);
            }
        });
        $uri = isset($_REQUEST['uri']) ? $_REQUEST['uri'] : '/';
        $routerFragments = explode("/",$uri);
        $con=$routerFragments[0];
        $routerFragments[0] = ucfirst($routerFragments[0]) . "Controller";
        $namespace = "\Controller\\" . $routerFragments[0];
        $function = $routerFragments[1];

        if(class_exists($namespace) && (method_exists($namespace,$function)
                || file_exists(__DIR__."/view/view/controller/".$con."/".$function.".php"))){
            $controller = new $namespace;
            $controller->viewTemplate = $function . ".php";
            @call_user_func_array([$controller, $function], array_slice($routerFragments, 2));

        }else{

            require_once('Error.php');

            /*throw new Error("Damn Daniel back at nonexistent pages again😂😂😂😂😂😂😂
             Page not found!!!!!!!!!!!!!!!!!", 404);*/?>

            <?php
        }

    }

}








