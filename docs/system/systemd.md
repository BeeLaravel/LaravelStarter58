## systemd

### systemctl 命令
	start 启动
	stop 关闭
	restart 重启
	reload 重载配置
	is-active 是否正在运行

	enable 开机启动
	disable 开机不启动
	is-enable 是否开机启动

	status 状态
	show 列出配置
	kill 发送信号给进程

	mask 注销
	unmask 取消注销

	list-units # 列表已启动 -all 列表所有 包括没有启动
		--type=TYPE(service|target )
	list-unit-files # 列表 根据 /lib/systemd/system/
	list-sockets # 列表 sockets

	get-default # 取得目前的 target
	set-default # 设置后面接的 target 成为默认的操作模式
	isolate # 切换到后面接的模式

	--failed 失败的

	poweroff # 系统关机
	reboot # 重新开机
	suspend # 进入暂停模式
	hibernate # 进入休眠模式
	rescue # 强制进入救援模式
	emergency # 强制进入紧急救援模式

	list-dependencies multi-user.target --reverse # 查看依赖
	daemon-reload # 运行