## git-execute

### 信息
git --exec-path # 查看 git 可执行文件目录
	/usr/lib/git-core/

git help 帮助

git config 查询和修改配置

git add 添加至暂存区
git add --interactive 交互式添加

git apply 应用补丁

git format-patch 创建邮件格式补丁
git am 应用邮件格式补丁

git annotate - - 同义词，等同于 git blame
git archive 10.9   文件归档打包
git bisect 11.4.6   二分查找
git blame 11.4.5   文件逐行追溯
git branch 分支管理
git cat-file 6.1   版本库对象研究工具
git checkout 8.1; 18.4.2   检出到工作区、切换或创建分支
git cherry-pick 12.3.1   提交拣选
git citool 11.1   图形化提交，相当于 git gui 命令
git clean 5.3   清除工作区未跟踪文件
git clone 13.1; 41.3.2   克隆版本库
git commit 4.1; 4.4; 5.4   提交
git describe 17.1   通过里程碑直观地显示提交ID
git diff 5.3   差异比较
git difftool - - 调用图形化差异比较工具
git fetch 19.1   获取远程版本库的提交
git grep 4.2   文件内容搜索定位工具
git gui 11.1   基于Tcl/Tk的图形化工具，侧重提交等操作

git init 4.1; 13.4   版本库初始化
git init-db* - - 同义词，等同于 git init
git log 11.4.3   显示提交日志
git merge 16.1   分支合并
git mergetool 16.4.2   图形化冲突解决
git mv 10.4   重命名
git pull 13.1   拉回远程版本库的提交
git push 13.1   推送至远程版本库
git rebase 12.3.2   分支变基
git rebase--interactive 12.3.3   交互式分支变基
git reflog 7.2   分支等引用变更记录管理
git remote 19.3   远程版本库管理
git repo-config* - - 同义词，等同于 git config
git reset 7.1   重置改变分支“游标”指向
git rev-parse 4.2; 11.4.1   将各种引用表示法转换为哈希值等
git revert 12.5   反转提交
git rm 10.2.2   删除文件
git show 11.4.3   显示各种类型的对象
git stage* - - 同义词，等同于 git add
git stash 9.2   保存和恢复进度
git status 5.1   显示工作区文件状态
git tag 17.1   里程碑管理
A.2 对象库操作相关命令
命令 相关章节 页数 简要说明
git commit-tree 12.4   从树对象创建提交
git hash-object 41.4.2   从标准输入或文件计算哈希值或创建对象
git ls-files 5.3; 18.4.2   显示工作区和暂存区文件
git ls-tree 5.3   显示树对象包含的文件
git mktag - - 读取标准输入创建一个里程碑对象
git mktree - - 读取标准输入创建一个树对象
git read-tree 24.2   读取树对象到暂存区
git update-index 41.3.1   工作区内容注册到暂存区及暂存区管理
A 2016/4/12
更多教程请到Linux公社www.linuxidc.com
git unpack-file - - 创建临时文件包含指定 blob 的内容
git write-tree 5.3   从暂存区创建一个树对象
A.3 引用操作相关命令
命令 相关章节 页数 简要说明
git check-ref-format 17.7   检查引用名称是否符合规范
git for-each-ref - - 引用迭代器，用于shell编程
git ls-remote 13.4   显示远程版本库的引用
git name-rev 17.1   将提交ID显示为友好名称
git peek-remote* - - 过时命令，请使用 git ls-remote
git rev-list 11.4.2   显示版本范围
git show-branch - - 显示分支列表及拓扑关系
git show-ref 14.1   显示本地引用
git symbolic-ref - - 显示或者设置符号引用
git update-ref - - 更新引用的指向
git verify-tag - - 校验 GPG 签名的Tag
A.4 版本库管理相关命令
命令 相关章节 页数 简要说明
git count-objects - - 显示松散对象的数量和磁盘占用
git filter-branch 35.4   版本库重构
git fsck 14.2   对象库完整性检查
git fsck-objects* - - 同义词，等同于 git fsck
git gc 14.4   版本库存储优化
git index-pack - - 从打包文件创建对应的索引文件
git lost-found* - - 过时，请使用 git fsck --lost-found 命令
git pack-objects - - 从标准输入读入对象ID，打包到文件
git pack-redundant - - 查找多余的 pack 文件
git pack-refs 14.1   将引用打包到 .git/packed-refs 文件中
git prune 14.2   从对象库删除过期对象
git prune-packed - - 将已经打包的松散对象删除
git relink - - 为本地版本库中相同的对象建立硬连接
git repack 14.4   将版本库未打包的松散对象打包
git show-index 14.1   读取包的索引文件，显示打包文件中的内容
git unpack-objects - - 从打包文件释放文件
git verify-pack - - 校验对象库打包文件
A 2016/4/12
更多教程请到Linux公社www.linuxidc.com
A.5 数据传输相关命令
命令
相关章
节
页
数 简要说明
git fetch-pack 15.1   执行 git fetch 或 git pull 命令时在本地执行此命令，用于从其他版本库获取
缺失的对象
git receivepack
15.1   执行 git push 命令时在远程执行的命令，用于接受推送的数据
git send-pack 15.1   执行 git push 命令时在本地执行的命令，用于向其他版本库推送数据
git uploadarchive
- - 执行 git archive --remote 命令基于远程版本库创建归档时，远程版本库执行此
命令传送归档
git upload-pack 15.1   执行 git fetch 或 git pull 命令时在远程执行此命令，将对象打包、上传
A.6 邮件相关命令
命令 相关章节 页数 简要说明
git imap-send - - 将补丁通过 IMAP 发送
git mailinfo - - 从邮件导出提交说明和补丁
git mailsplit - - 将 mbox 或 Maildir 格式邮箱中邮件逐一提取为文件
git request-pull 21.2.1   创建包含提交间差异和执行PULL操作地址的信息
git send-email 20.1   发送邮件
A.7 协议相关命令
命令 相关章节 页数 简要说明
git daemon 28.2   实现Git协议
git http-backend 27.2   实现HTTP协议的CGI程序，支持智能HTTP协议
git instaweb 27.3.4   即时启动浏览器通过 gitweb 浏览当前版本库
git shell - - 受限制的shell，提供仅执行Git命令的SSH访问
git update-server-info 15.1   更新哑协议需要的辅助文件
git http-fetch - - 通过HTTP协议获取版本库
git http-push - - 通过HTTP/DAV协议推送
git remote-ext - - 由Git命令调用，通过外部命令提供扩展协议支持
git remote-fd - - 由Git命令调用，使用文件描述符作为协议接口
git remote-ftp - - 由Git命令调用，提供对FTP协议的支持
git remote-ftps - - 由Git命令调用，提供对FTPS协议的支持
git remote-http - - 由Git命令调用，提供对HTTP协议的支持
git remote-https - - 由Git命令调用，提供对HTTPS协议的支持
A 2016/4/12
更多教程请到Linux公社www.linuxidc.com
git remote-testgit - - 协议扩展示例脚本
A.8 版本库转换和交互相关命令
命令 相关章节 页数 简要说明
git archimport - - 导入Arch版本库到Git
git bundle - - 提交打包和解包，以便在不同版本库间传递
git cvsexportcommit - - 将Git的一个提交作为一个CVS检出
git cvsimport - - 导入CVS版本库到Git。或者使用 cvs2git
git cvsserver - - Git的CVS协议模拟器，可供CVS命令访问Git版本库
git fast-export - - 将提交导出为 git-fast-import 格式
git fast-import 35.3   其他版本库迁移至Git的通用工具
git svn 26.1   Git 作为前端操作 Subversion
A.9 合并相关的辅助命令
命令 相关章节 页数 简要说明
git merge-base 11.4.2   供其他脚本调用，找到两个或多个提交最近的共同祖先
git merge-file - - 针对文件的两个不同版本执行三向文件合并
git merge-index - - 对index中的冲突文件调用指定的冲突解决工具
git merge-octopus - - 合并两个以上分支。参见 git merge 的octopus合并策略
git merge-one-file - - 由 git merge-index 调用的标准辅助程序
git merge-ours - - 合并使用本地版本，抛弃他人版本。参见 git merge 的ours合并策略
git merge-recursive - - 针对两个分支的三向合并。参见 git merge 的recursive合并策略
git merge-resolve - - 针对两个分支的三向合并。参见 git merge 的resolve合并策略
git merge-subtree - - 子树合并。参见 git merge 的 subtree 合并策略
git merge-tree - - 显式三向合并结果，不改变暂存区
git fmt-merge-msg - - 供执行合并操作的脚本调用，用于创建一个合并提交说明
git rerere - - 重用所记录的冲突解决方案
A.10 杂项
命令 相关章节 页数 简要说明
git bisect--helper - - 由 git bisect 命令调用，确认二分查找进度
git check-attr 41.1.2   显示某个文件是否设置了某个属性
git checkout-index - - 从暂存区拷贝文件至工作区
git cherry - - 查找没有合并到上游的提交
git diff-files - - 比较暂存区和工作区，相当于 git diff --raw
git diff-index - - 比较暂存区和版本库，相当于 git diff --cached --raw
A 2016/4/12
更多教程请到Linux公社www.linuxidc.com
git diff-tree - - 比较两个树对象，相当于 git diff --raw A B
git difftool--helper - - 由 git difftool 命令调用，默认要使用的差异比较工具
git get-tar-commit-id 10.9   从 git archive 创建的 tar 包中提取提交ID
git gui--askpass - - 命令 git gui 的获取用户口令输入界面
git notes 41.5   提交评论管理
git patch-id - - 补丁过滤行号和空白字符后生成补丁唯一ID
git quiltimport 20.3.2   将Quilt补丁列表应用到当前分支
git replace 41.4.2   提交替换
git shortlog - - 对 git log 的汇总输出，适合于产品发布说明
git stripspace - - 删除空行，供其他脚本调用
git submodule 23.1   子模组管理
git tar-tree - - 过时命令，请使用 git archive
git var - - 显示 Git 环境变量
git web--browse - - 启动浏览器以查看目录或文件
git whatchanged - - 显示提交历史及每次提交的改动
git-mergetool--lib - - 包含于其他脚本中，提供合并/差异比较工具的选择和执行
git-parse-remote - - 包含于其他脚本中，提供操作远程版本库的函数
git-sh-setup - - 包含于其他脚本中，提供 shell 编程的函数库
