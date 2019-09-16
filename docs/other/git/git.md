## git

### 工具

#### diff
$ diff -u hello world # 比较两个文件差异
$ diff -u hello world | less -N

#### patch
用目标文件 world 和差异文件 diff.txt 来恢复原始文件
$ cp hello world
$ patch world < diff.txt

用原始文件 world 和差异文件 diff.txt 来恢复目标文件
$ cp world hello
$ patch -R hello < diff.txt

#### less
$ less -N # 行号

#### more

#### 字符集
$ locale
LANG=C.UTF-8
LC_CTYPE="C.UTF-8"
LC_NUMERIC="C.UTF-8"
LC_TIME="C.UTF-8"
LC_COLLATE="C.UTF-8"
LC_MONETARY="C.UTF-8"
LC_MESSAGES="C.UTF-8"
LC_ALL=


### Cygwin
$ cygcheck -c cygwin
Cygwin Package Information
Package Version Status
cygwin 1.7.7-1 OK

$ mount
C:/cygwin/bin on /usr/bin type ntfs (binary,auto)
C:/cygwin/lib on /usr/lib type ntfs (binary,auto)
C:/cygwin on / type ntfs (binary,auto)
C: on /cygdrive/c type ntfs (binary,posix=0,user,noumount,auto)
D: on /cygdrive/d type ntfs (binary,posix=0,user,noumount,auto)

$ cygpath -u C:\\Windows
/cygdrive/c/Windows
$ cygpath -w ~/
C:\cygwin\home\jiangxin\

#### 命令行补齐忽略文件名大小写
~/.inputrc
	set completion-ignore-case on

#### 忽略文件权限的可执行位
git config --system core.fileMode false

#### Cygwin 下 Git 的中文支持
git config --global core.quotepath false

#### Git 使用 plink.exe 做为 SSH 客户端
export GIT_SSH=/cygdrive/c/Program\ Files/PuTTY/plink.exe

#### 手动运行 plink 
/cygdrive/c/Program\ Files/PuTTY/plink.exe git@bj.ossxp.com

#### 创建脚本 ~/bin/ssh-jiangxin
#!/bin/sh
/cygdrive/c/Program\ Files/PuTTY/plink.exe -i c:/cygwin/home/jiangxin/.ssh/jiangxin-cygwin.ppk $*

export GIT_SSH=~/bin/ssh-jiangxin


### backup
git -p status
git config --global pager.status true
export LESS=FRX
git config --global core.pager 'less -+$LESS -FRX'