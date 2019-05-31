<?php
namespace App\Http\Controllers\Package\Rpc;

use LinkORB\Component\Etcd\Client;

class EtcdPHPController extends Controller {
    public function index() {
        $client = new Client();
        // $client = Client::constructWithGuzzleClient($guzzleClient);

        $client->set('/foo', 'fooValue');
        // $client->set('/foo', 'fooValue', 10);
        // echo $client->get('/foo');
        // $client->update('/foo', 'newFooValue');
        // $client->rm('/foo');

        // $client->mkdir('/fooDir');
        // $client->rmdir('/fooDir');
    }
}
// ### 命令 etcd-php
// ./vendor/bin/etcd-php etcd:set /foo/bar "Hello world"
// Set a value on the /foo/bar key with a value that expires in 60 seconds:

// $ ./vendor/bin/etcd-php etcd:set /foo/bar "Hello world" --ttl=60
// Create a new key /foo/bar, only if the key did not previously exist:

// $ ./vendor/bin/etcd-php etcd:mk /foo/new_bar "Hello world"
// Create a new dir /fooDir, only if the key did not previously exist:

// $ ./vendor/bin/etcd-php etcd:mkdir /fooDir
// Update an existing key /foo/bar, only if the key already existed:

// $ ./vendor/bin/etcd-php etcd:update /foo/bar "Hola mundo"
// Create or update a directory called /mydir:

// $ ./vendor/bin/etcd-php etcd:setDir /mydir
// Retrieving a key value
// Get the current value for a single key in the local etcd node:

// $ ./vendor/bin/etcd-php etcd:get /foo/bar
// Listing a directory
// Explore the keyspace using the ls command

// $ ./vendor/bin/etcd-php etcd:ls
// /akey
// /adir
// $ ./vendor/bin/etcd-php etcd:ls /adir
// /adir/key1
// /adir/key2
// Add -recursive to recursively list subdirectories encountered.

// $ ./vendor/bin/etcd-php etcd:ls --recursive
// /foo
// /foo/bar
// /foo/new_bar
// /fooDir
// Deleting a key
// Delete a key:

// $ ./vendor/bin/etcd-php etcd:rm /foo/bar
// Delete an empty directory or a key-value pair

// $ ./vendor/bin/etcd-php etcd:rmdir /path/to/dir 
// Recursively delete a key and all child keys:

// $ ./vendor/bin/etcd-php etcd:rmdir /path/to/dir --recursive
// Export node
// $ ./vendor/bin/etcd-php etcd:export --server=http://127.0.0.1:2379 --format=json --output=config.json /path/to/dir
// Watching for changes
// Watch for only the next change on a key:

// $ ./vendor/bin/etcd-php etcd:watch /foo/bar