<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index() {
    	// echo configure('key1', 'value1')."<br>\n";
    	// echo configure('key2', 'value2')."<br>\n";
    	// echo configure_other('application', 'shop', 'key3', 'value3')."<br>\n";

    	// echo configure_system('laravelstarter58', 'key4', 'value4')."<br>\n";
    	// echo configure_application('warehouse', 'key5', 'value5')."<br>\n";
    	// echo configure_module('chat', 'key6', 'value6')."<br>\n";

    	// echo configure_organization('eccang', 'key7', 'value7')."<br>\n";
    	// echo configure_department('technology', 'key8', 'value8')."<br>\n";
    	// echo configure_site('wuhan', 'key9', 'value9')."<br>\n";

    	// echo configure_role('seller', 'key10', 'value10')."<br>\n";
    	// echo configure_user('beesoft', 'key11', 'value11')."<br>\n";

    	// print_r(configure_site('wuhan'));
    	// echo configure_user('beesoft', 'key11')."<br>\n";
    	// echo configure_user('beesoft', 'key12')."<br>\n";

    	return 'test system index';
    }
}
