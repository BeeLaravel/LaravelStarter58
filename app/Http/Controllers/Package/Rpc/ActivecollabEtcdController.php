<?php
namespace App\Http\Controllers\Package\Rpc;

use ActiveCollab\Etcd\Client as EtcdClient;

class ActivecollabEtcdController extends Controller {
    public function index() {
        $client = new EtcdClient('http://127.0.0.1:4001');
        $client = (new Client('https://127.0.0.1:4001'))->verifySslPeer(false);
        $client = (new Client('https://127.0.0.1:4001'))->verifySslPeer(true, '/path/to/ca/file');

        $client->setSandboxPath('/my/namespace');
        echo $client->getSandboxPath();

        if ( !$client->exists('/key/name') ) $client->set('/key/name', 'value'); // if not exists set
        $client->set('/key/name', 'value', 10); // set with TTL
        echo $client->get('/key/name'); // get
        $client->update('/key/name', 'new value'); // update
        $client->remove('/key/name'); // remove

        if ( !$client->dirExists('/dir/path') ) $client->createDir('/dir/path');
        $client->updateDir('/dir/path', 10); // Set TTL
        $client->removeDir('/dir/path');
        $client->dirInfo('/dir/path');

        $client->listDirs('/dir/path');
        $client->getKeyValueMap('/dir/path');

        $client->sandboxed('./different/namespace', function(EtcdClient &$c) {
            $c->set('new_key', 123); // Sets /my/namespace/different/namespace/new_key
        });
        $client->sandboxed('/different/namespace', function(EtcdClient &$c) {
            $c->set('new_key', 123); // Sets /different/namespace/new_key
        });
    }
}
