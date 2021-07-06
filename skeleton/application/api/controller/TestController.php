<?php
/**
 * Created by PhpStorm.
 * User: zhangli
 * Date: 2021-06-18
 * Time: 15:45
 */

namespace App\Api\Controller;


/**
 * Class TestContorller
 * @Controller(prefix="test")
 */
class TestController
{
    /**
     * @RequestMapping(route="index")
     */
    public function index(){
        return "控制器方法";
    }

    /**
     * @RequestMapping(route="test")
     */
    public function test(){
        return "控制器方法";
    }
}