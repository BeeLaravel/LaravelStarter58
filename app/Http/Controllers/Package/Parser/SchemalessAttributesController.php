<?php
namespace App\Http\Controllers\Package\Parser;


class SchemalessAttributesController extends Controller {
    public function index() {
    	$user = User::first();
        $user->extra_attributes->company = 'foobar company';
        $user->extra_attributes->position = 'php';
        $user->save();

        $user->extra_attributes->set('school.class', 1001);
        echo $user->extra_attributes->get('school.class');
        echo $user->extra_attributes->get('school.foobar', 'default');
        $user->save();

        echo User::withExtraAttributes('position', 'php')->get();
        echo User::withExtraAttributes('position', 'php')->toSql();
        echo User::withExtraAttributes('school->class', '1001')->get();
        echo User::withExtraAttributes('school->class', '1001')->toSql();
    }
}

