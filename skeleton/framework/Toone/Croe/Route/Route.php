<?php
/**
 * Created by PhpStorm.
 * User: zhangli
 * Date: 2021-06-18
 * Time: 18:22
 */

namespace Toone\Croe\Route;


class Route
{
    /**
     * Example
     * GET => [
     *      [
     *          routePath => "/index/test",
     *          handel = > App\api\IndexController@index
     *      ]
     * ]
     */
    private static $route;
    /**
     * 路由添加
     */
    public static function addRoute($method, $routeInfo){
        self::$route[$method][] = $routeInfo;
    }

    /**
     * 路由分发
     */
    public static function dispatch($method,$pathInfo){
        switch($method){
            case 'GET':
                foreach (self::$route[$method] as $v){
//                    var_dump($pathInfo, $v['routePath']);
                    //判断路径是否在注册的路由上
                     if($pathInfo == $v['routePath']){
                        $handle = explode("@", $v['handle']);
                        $class = $handle[0];
                        $method = $handle[1];
//                        var_dump($v['handle']);
                        return (new $class)->$method();
                    }
                }
                break;
            case 'POST':
                break;
        }
    }
}