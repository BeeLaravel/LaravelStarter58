<?php

namespace App\Http\Controllers\Tool\Database;

use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    public function index() {

    	return view('tool.database.reference');
    }
}
