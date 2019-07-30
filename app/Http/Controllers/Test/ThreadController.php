<?php
namespace App\Http\Controllers\Test;

class ThreadController extends Controller {
    public function index() {
    	$chG = new Request("www.google.com");
        $chB = new Request("www.baidu.com");

        $chG->start();
        $chB->start();

        $chB->join();

        // $chG->join();
        sleep(1); // 1s 钟后还不返回就不要你了

        $gl = $chG->response;
        $bd = $chB->response;

        $bd->kill();

        if ( !$gl ) $gl = ""; // 处理异常，或在线程类内给 $gl 一个默认值

    	return 'test thread index';
    }
}
class Request extends Thread {
    public $url;
    public $response;

    public function __construct($url) {
        $this->url = $url;
    }

    public function run() {
        $this->response = file_get_contents($this->url);
    }
}
