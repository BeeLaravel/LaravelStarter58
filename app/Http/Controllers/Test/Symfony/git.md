/etc/gitconfig # 全局配置
~/.gitconfig # 用户配置

$ git config --global user.name "Jiang Xin"
$ git config --global user.email jiangxin@ossxp.com

# --system 系统
# --global 用户
$ git config --system alias.br branch
$ git config --system alias.ci "commit -s"
$ git config --system alias.co checkout
$ git config --system alias.st "-p status"

$ git init
$ git init demo
$ echo "Hello." > welcome.txt
$ git add welcome.txt
$ git ci -m "initialized"

$ strace -e 'trace=file' git status # 跟踪文件状态


$ git rev-parse --git-dir # 显示版本库:file:`.git`目录所在的位置
/path/to/my/workspace/demo/.git

$ git rev-parse --show-toplevel # 显示工作区根目录。
/path/to/my/workspace/demo

$ git rev-parse --show-prefix # 相对于工作区根目录的相对目录。
a/b/c/

$ git rev-parse --show-cdup # 显示从当前目录（cd）后退（up）到工作区的根的深度。
../../../

$ GIT_CONFIG=test.ini git config a.b.c.d "hello, world" # 向配置文件:file:`test.ini`中添加配置

$ GIT_CONFIG=test.ini git config a.b.c.d # 从配置文件:file:`test.ini`中读取配置
hello, world

$ git config --unset --global user.name
$ git config --unset --global user.email