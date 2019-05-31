<?php
namespace App\Http\Controllers\Package\Rpc;

use Etcd\Client;

class StartPointEtcdController extends Controller {
    public function index() {
        $client = new Client('127.0.0.1:2379');

        // $result = $client->put('redis', '127.0.0.1:6379');
        // print_r($result);
        // $result = $client->put('redis', '127.0.0.1:6579', ['prev_kv' => true]);
        // print_r($result);
        // $result = $client->put('redis', '127.0.0.1:6579', ['lease' => 7587822882194199413]);
        // print_r($result);
        // $result = $client->get('redis');
        // print_r($result);
        // $result = $client->getAllKeys();
        // print_r($result);
        // $result = $client->getKeysWithPrefix('/v3/service/user/');
        // print_r($result);
        // $result = $client->del('redis');
        // print_r($result);
        // $result = $client->compaction(5);
        // print_r($result);

        // $result = $client->grant(3600);
        // print_r($result);
        // $result = $client->grant(3600, 7587822882194199413);
        // print_r($result);
        // $result = $client->revoke(7587822882194199413);
        // print_r($result);
        // $result = $client->keepAlive(7587822882194199413);
        // print_r($result);
        // $result = $client->timeToLive(7587822882194199413);
        // print_r($result);

        // $result = $client->authEnable();
        // print_r($result);
        // $result = $client->authDisable();
        // print_r($result);
        // $result = $client->authenticate('user', 'password');
        // print_r($result);
        // $result = $client->setToken($token);
        // print_r($result);
        // $result = $client->clearToken();
        // print_r($result);

        //  $result = $client->addRole('root');
        // print_r($result);
        //  $result = $client->getRole('root');
        // print_r($result);
        //  $result = $client->deleteRole('root');
        // print_r($result);
        //  $result = $client->roleList();
        // print_r($result);

        //  $result = $client->addUser('user', 'password');
        // print_r($result);
        //  $result = $client->getUser('root');
        // print_r($result);
        //  $result = $client->deleteUser('root');
        // print_r($result);
        //  $result = $client->userList();
        // print_r($result);

        //  $result = $client->changeUserPassword('user', 'new password');
        // print_r($result);
        
        //  $result = $client->grantUserRole('user', 'role');
        // print_r($result);
        //  $result = $client->revokeUserRole('user', 'role');
        // print_r($result);

        //  $result = $client->grantRolePermission('admin', \Etcd\Client::PERMISSION_READWRITE, 'redis');
        // print_r($result);
        //  $result = $client->revokeRolePermission('admin', 'redis');
        // print_r($result);
    }
}

