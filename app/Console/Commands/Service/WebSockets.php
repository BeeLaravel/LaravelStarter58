<?php
namespace App\Console\Commands\Service;

class WebSockets extends Command {
    protected $signature = 'service:websockets';
    protected $description = 'WebSocket SSL Service [Swoole[default]|Workerman]';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $server = new \swoole_websocket_server("0.0.0.0", config('beesoft.websockets.port'), SWOOLE_PROCESS, SWOOLE_SOCK_TCP | SWOOLE_SSL);
        $server->set(array(
            'ssl_cert_file' => '/etc/httpd/cert/2_102.beesoft.ink.crt',
            'ssl_key_file' => '/etc/httpd/cert/3_102.beesoft.ink.key',
            // 'worker_num' => 4, // 进程数
            // 'daemonize' => 1, // 守护进程
            'log_file' => storage_path('logs/swoole_wss.log'), // 日志文件
        ));
        $server->on('open', function($server, $req) {
            echo "connection open: {$req->fd}\n";
        });
        $server->on('close', function($server, $fd) {
            echo "connection close: {$fd}\n";

            $user_id = $this->redis->hGet('bee_wss_h_fds', $fd);
            $this->redis->hDel('bee_wss_h_fds', $fd);
            $this->redis->hDel('bee_wss_h_users', $user_id);
        });
        $server->on('message', function($server, $frame) {
            echo "received message: {$frame->data}\n";

            $data = json_decode($frame->data, true);

            switch ( $data['command'] ) {
                case 'login': // 登录
                    $this->redis->hSet('bee_wss_h_users', $data['id'], $frame->fd);
                    $this->redis->hSet('bee_wss_h_fds', $frame->fd, $data['id']);
                break;
                case 'inform': // 通知
                    $target_fd = $this->redis->hGet('bee_wss_h_users', $data['id']);
                    log_file($target_fd);
                    $server->push($target_fd, $frame->data);
                break;
                case 'announcement': // 公告
                    $fds = $this->redis->hKeys('bee_wss_s_fds');
                    log_file($fds);
                    foreach ( $fds as $fd ) {
                        log_file($fd);
                        $server->push($fd, $frame->data);
                    }
                break;
                case 'history': // 历史消息
                break;
                default:
                break;
            }
        });

        $server->start();
    }
}
