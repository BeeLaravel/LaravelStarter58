<?php
namespace App\Http\Controllers\Tool;

use Illuminate\Http\Request;

class IndexController extends Controller {
   // public function __construct(Request $request) {}
	public function applications(Request $request) {
		$action = $request->route()->getActionMethod();

		return view("tool.".$action, [
			'title' => $action
		]);
	}
	public function packages(Request $request) {
		$action = $request->route()->getActionMethod();

		return view("tool.".$action, [
			'title' => $action
		]);
	}
	public function files(Request $request) {
		$action = $request->route()->getActionMethod();

		return view("tool.".$action, [
			'title' => $action
		]);
	}
	public function fonts(Request $request) {
		$action = $request->route()->getActionMethod();

		return view("tool.".$action, [
			'title' => $action
		]);
	}
	public function custom_fonts(Request $request) {
		$action = $request->route()->getActionMethod();

		return view("tool.".$action, [
			'title' => $action
		]);
	}
	public function svgs(Request $request) {
		$action = $request->route()->getActionMethod();

		return view("tool.".$action, [
			'title' => $action
		]);
	}
}
