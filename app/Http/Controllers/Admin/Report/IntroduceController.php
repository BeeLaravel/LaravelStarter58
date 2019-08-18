<?php
namespace App\Http\Controllers\Admin\Tool;

use Illuminate\Http\Request;

use Illuminate\Container\Container;

// 老带新报表
class IntroduceController extends Controller {
    public function index() {
        $app = Container::getInstance();
        $request = new Request(['/']); // createFromGlobals();
		$response = $app['router']->dispatch($request);
        file_put_contents('index.html', $response->getContent());
    }
    public function create() {
    }
    public function store(Request $request) {
    }
    public function show(Server $server) {
    }
    public function edit(Server $server) {
    }
    public function update(Request $request, Server $server) {
    }
    public function destroy(Server $server) {
    }
}
