## RaspberryPI

### 配置摄像头
raspi-config 开启摄像头
/etc/modules
	bcm2835-v4l2
重启树莓派
vcgencmd get_camera # 测试摄像头
raspistill -t 2000 -o 1.jpg # 摄像头拍照

### 配置网络
/etc/network/interfaces
	auto lo
	iface lo inet loopback

	allow-hotplug wlan0
	auto wlan0
	iface wlan0 inet dhcp
        wpa-ssid "WIFISSID"
        wpa-psk "WIFIPASSWORD"

### nginx
	sudo apt-get install -y curl build-essential libpcre3 libpcre3-dev libpcre++-dev zlib1g-dev libcurl4-openssl-dev libssl-dev

	wget http://nginx.org/download/nginx-1.11.8.tar.gz # 下载 nginx
	tar -zxvf nginx-1.11.8.tar.gz # 解压 nginx

	wget https://github.com/arut/nginx-rtmp-module/archive/master.zip # 下载 nginx-rtmp
	unzip master.zip # 解压 nginx-rtmp

	cd nginx-1.11.8
	./configure
		--prefix=/var/www
		--sbin-path=/usr/sbin/nginx
		--conf-path=/etc/nginx/nginx.conf
		--pid-path=/var/run/nginx.pid 
		--error-log-path=/var/log/nginx/error.log
		--http-log-path=/var/log/nginx/access.log

		--with-http_ssl_module
		--without-http_proxy_module
		--add-module=/home/pi/nginx_src/nginx-rtmp-module-master
	make
	sudo make install

	/etc/nginx/nginx.conf
		rtmp {
		    server {
		        listen 1935;
		        chunk_size 4096;
		        application live {
		            live on;
		            record off;
		        }
		    }
		}
	sudo service nginx start

### 安装必需组件 avconv GStreamer
	sudo apt-get install libav-tools gstreamer1.0-tools libgstreamer1.0-0 libgstreamer1.0-0-dbg libgstreamer1.0-dev liborc-0.4-0 liborc-0.4-0-dbg liborc-0.4-dev liborc-0.4-doc gir1.2-gst-plugins-base-1.0 gir1.2-gstreamer-1.0 gstreamer1.0-alsa gstreamer1.0-doc gstreamer1.0-omx gstreamer1.0-plugins-bad gstreamer1.0-plugins-bad-dbg gstreamer1.0-plugins-bad-doc gstreamer1.0-plugins-base gstreamer1.0-plugins-base-apps gstreamer1.0-plugins-base-dbg gstreamer1.0-plugins-base-doc gstreamer1.0-plugins-good gstreamer1.0-plugins-good-dbg gstreamer1.0-plugins-good-doc gstreamer1.0-plugins-ugly gstreamer1.0-plugins-ugly-dbg gstreamer1.0-plugins-ugly-doc gstreamer1.0-pulseaudio gstreamer1.0-tools gstreamer1.0-x libgstreamer-plugins-bad1.0-0 libgstreamer-plugins-bad1.0-dev libgstreamer-plugins-base1.0-0 libgstreamer-plugins-base1.0-dev

	avconv -f video4linux2 -r 24 -i /dev/video0 -f flv rtmp://localhost:1935/live
	gst-launch-1.0 -v v4l2src device=/dev/video0 ! 'video/x-raw, width=1024, height=768, framerate=30/1' ! queue ! videoconvert ! omxh264enc ! h264parse ! flvmux ! rtmpsink location='rtmp://树莓派的IP地址/live live=1'

### 直播
	wget http://downloads.sourceforge.net/project/smp.adobe/Strobe%20Media%20Playback%201.6%20Release%20%28source%20and%20binaries%29/StrobeMediaPlayback_1.6.328-full.zip
	unzip StrobeMediaPlayback_1.6.328-full.zip
	sudo cp -r for\ Flash\ Player\ 10.1 /var/www/html/strobe

	rtmp://send1.douyu.com/live/1372rSOMdcBJ8UHD?wsSecret=96d2k4ecdf267d17b8e8c38b6a4a6efd&wsTime=59f92e2e&wsSeek=off live=1 # 斗鱼地址