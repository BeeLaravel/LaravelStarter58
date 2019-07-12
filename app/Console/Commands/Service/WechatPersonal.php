<?php
namespace App\Console\Commands\Service;

use Illuminate\Support\Collection;

use Hanson\Vbot\Foundation\Vbot;
// 消息
use Hanson\Vbot\Message\Text;
// 观察者
use App\Observers\Wechat\PersonalObserver; // 微信个人号 观察者
// 扩展
use App\Logics\Wechat\Personal\HelloWorld; // Hello World
use App\Logics\Wechat\Personal\GuessNumber; // 猜数字
use App\Logics\Wechat\Personal\Blacklist; // 黑名单
use App\Logics\Wechat\Personal\Express; // 快递
use App\Logics\Wechat\Personal\FindMovies; // 找电影
use App\Logics\Wechat\Personal\HotGirl; // 辣妹图
use App\Logics\Wechat\Personal\Tuling; // 图灵

class WechatPersonal extends Command {
    protected $signature = 'service:wechatpersonal';
    protected $description = 'Wechat Personal Service [Swoole[default]|Workerman]';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $vbot = new Vbot(config('wechat_personal'));

        WebServer::register();

        // 消息处理器
		$vbot->messageHandler->setHandler(function(Collection $message){
		    Text::send($message['from']['UserName'], 'hi');
		});
		$vbot->messageHandler->setCustomHandler(function(){
		    Text::send('filehelper', date('Y-m-d H:i:s'));
		});

		// 观察者
		$vbot->observer->setQrCodeObserver([PersonalObserver::class, 'setQrCodeObserver']); // 二维码
        $vbot->observer->setLoginSuccessObserver([PersonalObserver::class, 'setLoginSuccessObserver']); // 登录成功
        $vbot->observer->setReLoginSuccessObserver([PersonalObserver::class, 'setReLoginSuccessObserver']); // 免扫码成功
        $vbot->observer->setExitObserver([PersonalObserver::class, 'setExitObserver']); // 程序退出
        $vbot->observer->setFetchContactObserver([PersonalObserver::class, 'setFetchContactObserver']); // 好友
        $vbot->observer->setBeforeMessageObserver([PersonalObserver::class, 'setBeforeMessageObserver']); // 消息处理前
        $vbot->observer->setNeedActivateObserver([PersonalObserver::class, 'setNeedActivateObserver']); // 异常监听器
		// 扩展
		$vbot->messageExtension->load([
		    HelloWorld::class,
		    GuessNumber::class,
		    Express::class,
		    HelloWorld::class,
		    GuessNumber::class,
		    Express::class,
		    Tuling::class,
		    Tuling::class,
		]);

		// $friends = vbot('friends');
		// $groups = vbot('groups');
		// $members = vbot('members');
		// $officials = vbot('officials');
		// $specials = vbot('specials');
		// $myself = vbot('myself');

		// $friends->getUsernameByNickname($nickname, $blur = false); // 根据昵称获取
		// $friends->getUsernameByRemarkName($remark, $blur = false); // 根据备注获取

		// $friends->getUsername($search, $key, $blur=false);
		// $friends->getAccount($username); // 根据 UserName 获取联系人

		// $groups->get($username);
		// $data = $groups->getAvatar($username); // 头像
		// file_put_content('avatar.jpg', $data);

		// // 好友
		// $friends->setRemarkName($username, $remarkName); // 备注
		// $friends->setStick($username, $isStick=true); // 置顶

		// $friends->add($username, $content=null); // 请求加好友
		// $friends->approve($message); // 同意好友请求

		// // 群
		// $groups->setGroupName($group, $name) // 设置群名称

		// $groups->getGroupsByNickname($nickname, $blur=false); // 根据昵称获取群联系人
		// $groups->getObject($nickname, 'NickName', $blur);
		// $groups->getMembersByNickname($groupUsername, $memberNickname, $blur=false) // 根据昵称搜索群成员

		// $groups->create(array $contacts) // 创建群聊
		// $groups->addMember($groupUsername, $members) // 增加群成员
		// $groups->deleteMember($groupUsername, $members) // 删除群成员

		$vbot->server->serve();
    }
}
