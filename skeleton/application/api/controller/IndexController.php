<?php
/**
 * Created by PhpStorm.
 * User: zhangli
 * Date: 2021-06-18
 * Time: 14:43
 */

namespace App\Api\Controller;

/**
 * Class IndexController
 * @Controller(prefix="index")
 */
class IndexController
{
    /**
     * @RequestMapping(route="index")
     */
    public function index(){
        echo "控制器方法";
    }
}