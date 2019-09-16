<?php
namespace App\Http\Controllers\Test\PHP;

class VariableController extends Controller {
    public function assignMemory() { // int(18986416) int(18986416) int(19514856)
    	$a = range(0, 10000);
        var_dump(memory_get_usage());

        $b = $a; // 0
        var_dump(memory_get_usage());

        $a = range(0, 10000);
        var_dump(memory_get_usage());
    }
    public function refMemory() { // int(19000912) int(19000936) int(19000936)
        $a = range(0, 10000);
        var_dump(memory_get_usage());

        $b = &$a; // 24
        var_dump(memory_get_usage());

        $a = range(0, 10000); // 0
        var_dump(memory_get_usage());
    }
    // php7 和之前不同了
    // a: (refcount=1, is_ref=0)=1
    // a: (refcount=2, is_ref=0)=1
    // b: (refcount=2, is_ref=0)=1
    // a: (refcount=1, is_ref=0)=2
    // b: (refcount=1, is_ref=0)=1

    // a: (refcount=0, is_ref=0)int 1
    // a: (refcount=0, is_ref=0)int 1
    // b: (refcount=0, is_ref=0)int 1
    // a: (refcount=0, is_ref=0)int 2
    // b: (refcount=0, is_ref=0)int 1
    public function assignDetail() {
        $a = 1;
        xdebug_debug_zval('a');

        $b = $a;
        xdebug_debug_zval('a');
        xdebug_debug_zval('b');

        $a = 2;
        xdebug_debug_zval('a');
        xdebug_debug_zval('b');
    }
    // a: (refcount=1, is_ref=0)=1
    // a: (refcount=2, is_ref=1)=1
    // b: (refcount=2, is_ref=1)=1
    // a: (refcount=2, is_ref=1)=2
    // b: (refcount=2, is_ref=1)=2

    // a: (refcount=0, is_ref=0)int 1
    // a: (refcount=2, is_ref=1)int 1
    // b: (refcount=2, is_ref=1)int 1
    // a: (refcount=2, is_ref=1)int 2
    // b: (refcount=2, is_ref=1)int 2
    public function refDetail() {
        $a = 1;
        xdebug_debug_zval('a');

        $b = &$a;
        xdebug_debug_zval('a');
        xdebug_debug_zval('b');

        $a = 2;
        xdebug_debug_zval('a');
        xdebug_debug_zval('b');
    }
    // Array ( [0] => a [1] => b [2] => c )
    // Array ( [0] => b [1] => b [2] => c )
    // Array ( [0] => b [1] => c [2] => c )
    // Array ( [0] => b [1] => c [2] => c )
    public function test() {
        $d = ['a', 'b', 'c'];

        foreach ( $d as $k => $v ) {
            $v = &$d[$k];
            print_r($d);
        }

        print_r($d);
    }
    public function cast() {
        $binary = b"binary string";
        var_dump($binary);
    }
}
// 引用变量 unset()只会取消引用，不会销毁内存空间
// $a = 1;
// $b = &$a;
// unset($b);
// echo $a;
// 对象本身就是引用赋值
// class Person {
//     public $age = 1;
// }

// $p1 = new Person;
// xdebug_debug_zval('p1');

// $p2 = $p1;
// xdebug_debug_zval('p1');
// xdebug_debug_zval('p2');

// $p2->age = 2;
// xdebug_debug_zval('p1');
// xdebug_debug_zval('p2');

// ### 类型转换
// 强制转换
// 函数式转换
// bool settype(mixed var, string type)
// null boolean string float integer array object

// ### 类型判断
// (unset) is_null 空值
// (bool)(boolean) is_bool 布尔
// (string) is_string 字符串
// (float)(double)(real) is_float/is_double 浮点数
// (integer)(int) is_integer/is_int 整形
// (array) is_arrary 数组
// (object) is_object 对象
// is_numeric 数字或由数字组成的字符串
// (binary) b""
// $binary = (binary)$string;
// $binary = b"binary string";

// ### 类型
// 标量类型 boolean string integer float
// 复合类型 array object callable
// 特殊类型 resource NULL
// 伪类型 mixed number callback array|object void
// 伪变量 $...