<?php
namespace App\Http\Controllers\Test\Network;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Pool;
use GuzzleHttp\Middleware;
use GuzzleHttp\TransferStats;
use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;

use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

use GuzzleHttp\Tests\Server;

// 异常
use GuzzleHttp\Exception\SeekException; // Seek
use GuzzleHttp\Exception\TransferException; // 传输异常
use GuzzleHttp\Exception\RequestException; // 请求异常
use GuzzleHttp\Exception\ConnectException; // 连接异常
use GuzzleHttp\Exception\TooManyRedirectsException; // 循环重定向
use GuzzleHttp\Exception\BadResponseException; // 错误响应
use GuzzleHttp\Exception\ServerException; // 500 服务器异常
use GuzzleHttp\Exception\ClientException; // 400 客户端异常

// Psr
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\StreamInterface;

class WorkflowController extends Controller {
    public function index() {
        $client = new Client([
            'base_uri' => 'http://httpbin.org',
            'timeout' => 2.0,
        ]);

        $response = $client->request('GET', 'test');
        $response = $client->request('GET', '/root');

        $response = $client->get('http://httpbin.org/get');
        $response = $client->delete('http://httpbin.org/delete');
        $response = $client->head('http://httpbin.org/get');
        $response = $client->options('http://httpbin.org/get');
        $response = $client->patch('http://httpbin.org/patch');
        $response = $client->post('http://httpbin.org/post');
        $response = $client->put('http://httpbin.org/put');

        $promise = $client->getAsync('http://httpbin.org/get');
        $promise = $client->deleteAsync('http://httpbin.org/delete');
        $promise = $client->headAsync('http://httpbin.org/get');
        $promise = $client->optionsAsync('http://httpbin.org/get');
        $promise = $client->patchAsync('http://httpbin.org/patch');
        $promise = $client->postAsync('http://httpbin.org/post');
        $promise = $client->putAsync('http://httpbin.org/put');

        $request = new Request('PUT', 'http://httpbin.org/put');
        $response = $client->send($request, ['timeout' => 2]);

        $headers = ['X-Foo' => 'Bar'];
        $body = 'Hello!';
        $request = new Request('HEAD', 'http://httpbin.org/head', $headers, $body);
        $promise = $client->sendAsync($request);

        $promise = $client->requestAsync('GET', 'http://httpbin.org/get');

        $promise->then(function (ResponseInterface $res) {
            echo $res->getStatusCode() . "\n";
        }, function (RequestException $e) {
            echo $e->getMessage() . "\n";
            echo $e->getRequest()->getMethod();
        });

        $promises = [
            'image' => $client->getAsync('/image'),
            'png'   => $client->getAsync('/image/png'),
            'jpeg'  => $client->getAsync('/image/jpeg'),
            'webp'  => $client->getAsync('/image/webp'),
        ];

        $results = Promise\unwrap($promises);
        $results = Promise\settle($promises)->wait(); // 等待

        echo $results['image']['value']->getHeader('Content-Length')[0];
        echo $results['png']['value']->getHeader('Content-Length')[0];

        $client = new Client();

        $requests = function ($total) {
            $uri = 'http://127.0.0.1:8126/guzzle-server/perf';
            for ( $i = 0; $i < $total; $i++ ) {
                yield new Request('GET', $uri);
            }
        };
        $pool = new Pool($client, $requests(100), [
            'concurrency' => 5,
            'fulfilled' => function ($response, $index) {
            },
            'rejected' => function ($reason, $index) {
            },
        ]);

        $requests = function ($total) use ($client) {
            $uri = 'http://127.0.0.1:8126/guzzle-server/perf';
            for ( $i = 0; $i < $total; $i++ ) {
                yield function() use ($client, $uri) {
                    return $client->getAsync($uri);
                };
            }
        };
        $pool = new Pool($client, $requests(100));

        $promise = $pool->promise();
        $promise->wait();

        // Response 响应
        $code = $response->getStatusCode(); // 200
        $reason = $response->getReasonPhrase(); // OK

        if ( $response->hasHeader('Content-Length') ) echo "It exists";
        echo $response->getHeader('Content-Length')[0];
        foreach ( $response->getHeaders() as $name => $values ) {
            echo $name . ': ' . implode(', ', $values) . "\r\n";
        }

        echo $response->getBody();
        echo $response->getBody()->read(1024);
        $response->eof(); // end of file
        $response->getContents(); // content
        $response->tell(); // tell

        $generator = function ($bytes) {
            for ( $i = 0; $i < $bytes; $i++ ) {
                yield '.';
            }
        };
        $iter = $generator(1024);
        $stream = Psr7\stream_for($iter);
        echo $stream->read(3);

        echo $stream->getMetadata('uri');
        var_export($stream->isReadable());
        var_export($stream->isWritable());
        var_export($stream->isSeekable());

        $tenBytes = $body->read(10);
        $remainingBytes = $body->getContents();

        // Query String
        $response = $client->request('GET', 'http://httpbin.org?foo=bar');
        $client->request('GET', 'http://httpbin.org', [
            'query' => ['foo' => 'bar']
        ]);
        $client->request('GET', 'http://httpbin.org', ['query' => 'foo=bar']);


        $r = $client->request('POST', 'http://httpbin.org/post', [
            'body' => 'raw data'
        ]);

        $body = fopen('/path/to/file', 'r');
        $r = $client->request('POST', 'http://httpbin.org/post', ['body' => $body]);

        $body = \GuzzleHttp\Psr7\stream_for('hello!');
        $r = $client->request('POST', 'http://httpbin.org/post', ['body' => $body]);

        $r = $client->request('PUT', 'http://httpbin.org/put', [ // json
            'json' => ['foo' => 'bar']
        ]);

        // 
        $response = $client->request('POST', 'http://httpbin.org/post', [
            'form_params' => [
                'field_name' => 'abc',
                'other_field' => '123',
                'nested_field' => [
                    'nested' => 'hello'
                ]
            ]
        ]);
        $response = $client->request('POST', 'http://httpbin.org/post', [
            'multipart' => [
                [
                    'name'     => 'field_name',
                    'contents' => 'abc'
                ], [
                    'name'     => 'file_name',
                    'contents' => fopen('/path/to/file', 'r')
                ], [
                    'name'     => 'other_file',
                    'contents' => 'hello',
                    'filename' => 'filename.txt',
                    'headers'  => [
                        'X-Foo' => 'this is an extra header to include'
                    ]
                ]
            ]
        ]);

        // cookie
        $jar = new \GuzzleHttp\Cookie\CookieJar;
        $r = $client->request('GET', 'http://httpbin.org/cookies', [
            'cookies' => $jar
        ]);

        $client = new \GuzzleHttp\Client(['cookies' => true]);
        $r = $client->request('GET', 'http://httpbin.org/cookies');

        // ### 选项
        $onRedirect = function(
            RequestInterface $request,
            ResponseInterface $response,
            UriInterface $uri
        ) {
            echo 'Redirecting! ' . $request->getUri() . ' to ' . $uri . "\n";
        };

        $resource1 = fopen('http://httpbin.org', 'r');
        $resource2 = fopen('/path/to/file', 'w');
        $stream1 = GuzzleHttp\Psr7\stream_for('contents...');
        $stream2 = GuzzleHttp\Psr7\stream_for($resource2);
        $jar = new \GuzzleHttp\Cookie\CookieJar();

        $res = $client->request('GET', '/redirect/3', [
            'allow_redirects' => false, // 禁用 重定向
            'allow_redirects' => [
                'max'             => 10,
                'strict'          => true,
                'referer'         => true,
                'protocols'       => ['https'],
                'on_redirect'     => $onRedirect,
                'track_redirects' => true
            ]
            'auth' => ['username', 'password'],
            'auth' => ['username', 'password', 'digest'],
            'auth' => ['username', 'password', 'ntlm'],
            'body' => 'foo',
            'body' => $resource1,
            'body' => $stream1,
            'cert' => ['/path/server.pem', 'password'],
            'cookies' => $jar,
            'connect_timeout' => 3.14,
            'debug' => true,
            'decode_content' => false
            'decode_content' => 'gzip',
            // 'delay' => 1,
            // 'expect' => 1,
            'force_ip_resolve' => 'v4',
            'force_ip_resolve' => 'v6',
            'http_errors' => false,
            'stream' => true, // 流
            'read_timeout' => 10, // 读取超时
            'headers' => null,
            'headers' => [
                'User-Agent' => 'testing/1.0',
                'Accept' => 'application/json',
                'X-Foo' => ['Bar', 'Baz'],
                'Accept-Encoding' => 'gzip',
            ],
            'form_params' => [ // application/x-www-form-urlencoded
                'foo' => 'bar',
                'baz' => ['hi', 'there!'],
            ],
            'multipart' => [ // multipart/form-data
                [
                    'name'     => 'foo',
                    'contents' => 'data',
                    'headers'  => ['X-Baz' => 'bar']
                ], [
                    'name'     => 'baz',
                    'contents' => fopen('/path/to/file', 'r')
                ], [
                    'name'     => 'qux',
                    'contents' => fopen('/path/to/file', 'r'),
                    'filename' => 'custom_filename.txt'
                ],
            ],
            'json' => ['foo' => 'bar'],
            'query' => ['foo' => 'bar'],
            'on_headers' => function (ResponseInterface $response) {
                if ($response->getHeaderLine('Content-Length') > 1024) {
                    throw new \Exception('The file is too big!');
                }
            },
            'on_stats' => function (TransferStats $stats) {
                echo $stats->getEffectiveUri() . "\n";
                echo $stats->getTransferTime() . "\n";
                var_dump($stats->getHandlerStats());

                if ($stats->hasResponse()) {
                    echo $stats->getResponse()->getStatusCode();
                } else {
                    var_dump($stats->getHandlerErrorData());
                }
            },
            'progress' => function(
                $downloadTotal,
                $downloadedBytes,
                $uploadTotal,
                $uploadedBytes
            ) {
            },
            'proxy' => [
                'http'  => 'tcp://localhost:8125', // Use this proxy with "http"
                'https' => 'tcp://localhost:9124', // Use this proxy with "https",
                'no' => ['.mit.edu', 'foo.com']    // Don't use a proxy with these
            ],
            'sink' => '/path/to/file',
            'sink' => $resource2,
            'save_to' => $stream,
            // 'synchronous' => true, // 并发
            'ssl_key' => '',
            'verify' => true,
            'verify' => '/path/to/cert.pem',
            'verify' => false,
            'timeout' => 3.14,
            'version' => 1.0,
        ]);

        $clientHandler = $client->getConfig('handler');
        $tapMiddleware = Middleware::tap(function ($request) {
            echo $request->getHeaderLine('Content-Type');
            echo $request->getBody();
        });
        $response = $client->request('PUT', '/put', [
            'json'    => ['foo' => 'bar'],
            'handler' => $tapMiddleware($clientHandler)
        ]);

        $body = $response->getBody(); // 流式读取
        $body->seek(0);
        while ( !$body->eof() ) {
            echo $body->read(1024);
        }

        // 请求响应
        $headers = [
            'X-Foo' => 'Bar',
            'Link' => '<http:/.../front.jpeg>; rel="front"; type="image/jpeg"',
        ];
        $body = 'hello!';
        $request = new Request('PUT', 'http://httpbin.org/put', $headers, $body);
        $parsed = Psr7\parse_header($request->getHeader('Link')); // 多维数组的 header

        if ( $request->hasHeader('X-Foo') ) echo 'It is there';
        $request->getHeader('X-Foo');
        foreach ( $request->getHeaders() as $name => $values ) {
            echo $name . ': ' . implode(', ', $values) . "\r\n";
        }
        echo $request->getMethod(); // method 方法
        echo $request->getUri(); // uri
        echo $request->getUri()->getScheme(); // http
        echo $request->getUri()->getHost(); // httpbin.org
        echo $request->getHeader('Host'); // httpbin.org
        echo $request->getUri()->getPort(); // 8080
        echo $request->getUri()->getPath(); // /get
        echo $request->getUri()->getQuery(); // foo=bar

        $status = 200;
        $headers = [
            'X-Foo' => 'Bar',
        ];
        $body = 'hello!';
        $protocol = '1.1';
        $response = new Response($status, $headers, $body, $protocol);
        echo $response->getStatusCode(); // 200
        echo $response->getReasonPhrase(); // OK
        echo $response->getProtocolVersion(); // 1.1
        echo $response->getHeaderLine('X-Guzzle-Redirect-History');
        echo $response->getHeaderLine('X-Guzzle-Redirect-Status-History');

        // 异常
        try {
            $client->request('GET', 'https://github.com/_abc_123_404');
        } catch ( ClientException $e ) {
        } catch ( RequestException $e ) {
            echo Psr7\str($e->getRequest());

            if ( $e->hasResponse() ) echo Psr7\str($e->getResponse());
        }
    }
    public function test() {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar']),
            new Response(202, ['Content-Length' => 0]),
            new RequestException("Error Communicating with Server", new Request('GET', 'test'))
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        echo $client->request('GET', '/')->getStatusCode();
        echo $client->request('GET', '/')->getStatusCode();


        $container = [];
        $history = Middleware::history($container);

        $stack = HandlerStack::create();
        $stack->push($history);

        $client = new Client(['handler' => $stack]);

        $client->request('GET', 'http://httpbin.org/get');
        $client->request('HEAD', 'http://httpbin.org/get');

        echo count($container);

        foreach ( $container as $transaction ) {
            echo $transaction['request']->getMethod();

            if ( $transaction['response'] ) {
                echo $transaction['response']->getStatusCode();
            } elseif ($transaction['error']) {
                echo $transaction['error'];
            }

            var_dump($transaction['options']);
        }


        Server::enqueue([
            new Response(200, ['Content-Length' => 0])
        ]);

        $client = new Client(['base_uri' => Server::$url]);
        echo $client->request('GET', '/foo')->getStatusCode();

        foreach ( Server::received() as $response ) {
            echo $response->getStatusCode();
        }

        Server::flush();
        echo count(Server::received());
    }
    public function middleware() {
        $handler = new CurlHandler();
        $stack = HandlerStack::create($handler);
        $client = new Client(['handler' => $stack]);
        
        $stack = new HandlerStack();
        $stack->setHandler(new CurlHandler());
        $stack->push(add_header('X-Foo', 'bar'));
        $client = new Client(['handler' => $stack]);

        function my_middleware() {
            return function (callable $handler) {
                return function (RequestInterface $request, array $options) use ($handler) {
                    return $handler($request, $options);
                };
            };
        }

        function add_header($header, $value) {
            return function (callable $handler) use ($header, $value) {
                return function (RequestInterface $request, array $options) use ($handler, $header, $value) {
                    $request = $request->withHeader($header, $value);
                    return $handler($request, $options);
                };
            };
        }


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Client;

function add_response_header($header, $value) {
    return function (callable $handler) use ($header, $value) {
        return function (
            RequestInterface $request,
            array $options
        ) use ($handler, $header, $value) {
            $promise = $handler($request, $options);
            return $promise->then(
                function (ResponseInterface $response) use ($header, $value) {
                    return $response->withHeader($header, $value);
                }
            );
        };
    };
}

$stack = new HandlerStack();
$stack->setHandler(new CurlHandler());
$stack->push(add_response_header('X-Foo', 'bar'));
$client = new Client(['handler' => $stack]);

    }
}
// ### 环境变量
// GUZZLE_CURL_SELECT_TIMEOUT
// HTTP_PROXY
// HTTPS_PROXY
// ### php ini 配置
// openssl.cafile
