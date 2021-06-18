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
 * @Contoller(prefix="test")
 */
class TestController
{
    /**
     * RequestMapping(route="index")
     */
    public function index(){
        echo "控制器方法";
    }

    /**
     * RequestMapping(route="test")
     */
    public function test(){

    }
}