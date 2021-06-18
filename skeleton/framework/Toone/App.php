<?php
/**
 * Created by PhpStorm.
 * User: zhangli
 * Date: 2021-06-18
 * Time: 14:42
 */

namespace Toone;


use App\Api\Controller\TestController;
use Swoole\Http\Server;

class App
{
    public function run(){
        $this->init();
        $this->loadAnnotations();//载入注解

        $http = new Server("0.0.0.0", 9501);
        $http->on("request", function ($request, $response) {

            $response->end("<h1>运行应用</h1>");
        });
        $http->start();
    }

    public function init(){
        define('ROOT_PATH', dirname(dirname(__DIR__))); //根目录
        define('APP_PATH', ROOT_PATH."/application"); //根目录
    }

    public function loadAnnotations(){
        $dirs = glob(APP_PATH."/api/controller/*");
        echo APP_PATH . "/api/controller/*" . PHP_EOL;
        if(!empty($dirs)){
            foreach ($dirs as $file){
                $obj = new TestController();
                $refect = new \ReflectionClass($obj);
//              var_dump($refection->getDocComment());
                foreach ($refect->getMethods() as $method){
                    var_dump($method->getDocComment());
                }
            }
        }
    }
}

