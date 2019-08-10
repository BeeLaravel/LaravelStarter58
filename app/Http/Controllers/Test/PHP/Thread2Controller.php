<?php
namespace App\Http\Controllers\Test;

class Thread2Controller extends Controller {
    public function index() {
        for ( $i=0; $i<100; $i++ ) {
            $urls_array[] = array("name" => "baidu", "url" => "http://www.baidu.com/s?wd=".mt_rand(10000,20000));
        }

        $time_start = microtime(true);
        $result = $this->runThread($urls_array);
        $time_end = microtime(true);
        echo "多线程：" . ($time_start-$time_end) . "\n";

        $time_start = microtime(true);
        foreach ( $urls_array as $key => $value ) {
            $result_new[$key] = model_http_curl_get($value["url"]);
        }
        $time_end = microtime(true);
        echo "For循环：" . ($time_start-$time_end) . "\n";

    	return 'test thread2 index';
    }
    public function runThread($urls_array) {
        foreach ( $urls_array as $key => $value ) {
            $thread_array[$key] = new test_thread_run($value["url"]);

            $thread_array[$key]->start();
        }

        foreach ( $thread_array as $key => $value ) {
            while ( $thread_array[$key]->isRunning() ) usleep(10);

            if ( $thread_array[$key]->join() ) $return[$key] = $thread_array[$key]->data;
        }

        return $return;
    }
}
class test_thread_run extends Thread {
    public $url;
    public $data;
  
    public function __construct($url) {
        $this->url = $url;
    }
  
    public function run() {
        if ( $url = $this->url ) $this->data = model_http_curl_get($url);
    }
}
function model_http_curl_get($url, $userAgent="") {
    $userAgent = $userAgent ? $userAgent : 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2)';

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 5);
    curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
