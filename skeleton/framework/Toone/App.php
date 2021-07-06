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
use Toone\Croe\Route\Route;

class App
{
    public function run(){
        $this->init();
        $this->loadAnnotations();//载入注解
        $http = new Server("0.0.0.0", 9501);
        $http->on("request", function ($request, $response) {
            $path_info = $request->server['path_info'];
            $method = $request->server['request_method'];
            $ret = Route::dispatch($method, $path_info);
            $response->end("<h1>$ret</h1>");
        });
        $http->start();
    }

    public function init(){
        define('ROOT_PATH', dirname(dirname(__DIR__))); //根目录
        define('APP_PATH', ROOT_PATH."/application"); //根目录
    }

    public function loadAnnotations(){
        $dirs = glob(APP_PATH."/api/controller/*");
        var_dump($this->tree(APP_PATH));
//        echo APP_PATH . "/api/controller/*" . PHP_EOL;
        if(!empty($dirs)){
            foreach ($dirs as $file){
                $obj = new TestController();
                $refect = new \ReflectionClass($obj);
                $classDocComment = $refect->getDocComment();
                //匹配前缀
                preg_match('/@Controller\((.*)\)/i', $classDocComment, $prefix);
                $prefix = trim(explode("=", $prefix[1])[1], "\"");
//                var_dump($prefix); //专门有个解析类
                foreach ($refect->getMethods() as $method){
                    $methodDocComment = $method->getDocComment();
                    preg_match('/@RequestMapping\((.*)\)/i', $methodDocComment, $suffix);
                    $suffix = trim(explode("=", $suffix[1])[1], "\"");
//                    var_dump($suffix);
                    $routeInfo = [
                        'routePath' => "/".$prefix."/".$suffix,
                        'handle'    =>  $refect->getName()."@".$method->getName()
                    ];
//                    var_dump($routeInfo);
                    Route::addRoute('GET', $routeInfo);
                }
            }
        }
    }

    /**
     * 遍历目录
     * @param $dir
     */
    public function tree($dir){
        $dirs = glob($dir."/*");
        $dirFiles = [];
        foreach ($dirs as $dir){
            if(is_dir($dir)){
                $dirFiles[] = $this->tree($dir);
                if(is_array($dirFiles)){

                }
            }else{
                $dirFiles[] = $dir;
            }
        }
        return $dirFiles;
    }
}

