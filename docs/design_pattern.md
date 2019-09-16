##

### 工厂模式
解耦
从使用者直接实例化改为调用工厂生产
单个改变只需要修改工厂方法即可

### 单例模式
构造函数设置为私有，不能直接实例化
静态获取实例方法

### 注册器
class Register {
	protected $obj;

	static function set() {

	}
	static function get() {

	}
	function unset() {

	}
}