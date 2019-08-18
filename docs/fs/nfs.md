## NFS
Network File System 网络文件系统
端口 2049

### 类似
mfs MooseFS
FastDFS
tfs Team Foundation Server(taobao)

### 服务器
yum install nfs-utils rpcbind # 安装 nfs 和 rpcbind
/etc/exports
	/usr/share *(ro,sync)
	/soft 192.168.91.0/24(rw,sync)
	/program 192.168.91.0/24(rw,sync)
	/data 192.168.91.0/24(rw,sync) 192.168.81.0/24(rw)
systemctl start rpcbind.service # 开启 rpcbind 服务
systemctl enable rpcbind.service # 启用 rpcbind 服务
systemctl start nfs.service # 开启 nfs 服务
systemctl enable nfs.service # 启用 nfs 服务

chown -R nfsnobody:nfsnobody /data # 修改文件所属人所属组
exportfs -rv # 发布共享
showmount -e # 查看共享
showmount -e 192.168.91.144
cat /var/lib/nfs/etab # 查看共享
rpcinfo -p # rpc 服务器是否启动成功

#### 共享选项
rw # 读写
ro # 只读

sync # 将数据同步写入内存缓冲区与磁盘中，效率低，但可以保证数据的一致性
async # 是大数据时使用，是先写到缓存区，必要时再写到磁盘里
wdelay(default) # 检查是否有相关的写操作，如果有则将这些写操作一起执行，这样可以提高效率
no_wdelay # 若有写操作则立即执行，应与 sync 配合使用

all_squash # 所有访问用户都映射为匿名用户或用户组
no_all_squash(default) # 访问用户先与本机用户匹配，匹配失败后再映射为匿名用户或用户组
root_squash(default) # 将来访的 root 用户映射为匿名用户或用户组
no_root_squash # 来访的 root 用户保持 root 帐号权限
 
subtree_check # 若输出目录是一个子目录，则 nfs 服务器将检查其父目录的权限
no_subtree_check(default) # 即使输出目录是一个子目录，nfs 服务器也不检查其父目录的权限，这样可以提高效率

anonuid=xxx # 将远程访问的所有用户都映射为匿名用户，并指定该用户为本地用户(UID=xxx)
anongid=xxx # 将远程访问的所有用户组都映射为匿名用户组账户

### 客户端
yum install nfs-utils rpcbind # 安装 nfs 和 rpcbind
systemctl start rpcbind.service # 开启 rpcbind 服务
systemctl enable rpcbind.service # 启用 rpcbind 服务
mount -t nfs 192.168.91.144:/data /data # 客户端挂载
mount -o nosuid noexec noatime -t nfs 192.168.91.144:/data /data
/etc/rc.local # 不要写在 /etc/fstab 该文件启动加载 rpcbind 未启动 导致引导失败 服务关闭也会导致失败
	mount -t nfs 192.168.91.144:/data /data
umount -lf /data # 强制卸载
cat /proc/mounts # 查看挂载

#### 挂载参数
noatime 不更新文件的 inode 访问时间戳，文件很多时可以提高效率
nodiratime 不更新目录的访问时间戳
nosuid 关闭挂载目录的 suid
noexec 不允许执行二进制文件
rsize 系统每次读取的最大字节，centos 6.5 默认 131072，过小会影响系统的I/O效率
wsize 系统每次写入的最大字节
defaults 使用默认选项 rw suid dev exec anto nouser async

#### windows 挂载
打开或关闭 Windows 功能 - nfs 服务
mount 192.168.91.144:/data  z:
