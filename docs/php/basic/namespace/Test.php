<?php
namespace Test;

// require_once "Test1.php";
// require_once "Test2.php";

function __autoload($class) {
	require_once __DIR__.'/'.$class.'.php';
}

\Test1\test1();
\Test2\test2();
