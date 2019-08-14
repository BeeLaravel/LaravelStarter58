## consul docker
docker run -d --name=c1 -p 8500:8500 -e consul agent --server=true --bootstrap-expect=3 --client=0.0.0.0 --bind='{{ GetInterfaceIP "eth0" }}' -ui
docker run -d --name=c1 -p 8500:8500 -e CONSUL_BIND_INTERFACE=eth0 consul agent --server=true --bootstrap-expect=3 --client=0.0.0.0 -ui
docker run -d --name=c2 -e CONSUL_BIND_INTERFACE=eth0 consul agent --server=true --client=0.0.0.0 --join 172.17.0.5
docker run -d --name=c3 -e CONSUL_BIND_INTERFACE=eth0 consul agent --server=true --client=0.0.0.0 --join 172.17.0.5
docker run -d --name=c4 -e CONSUL_BIND_INTERFACE=eth0 consul agent --server=false --client=0.0.0.0 --join 172.17.0.5

consul members # 查看成员