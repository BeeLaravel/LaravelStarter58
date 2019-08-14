import "project/other_protos.proto";

message Person {
  required string name = 1;
  required int32 id = 2; [default = 0]
  optional string email = 3;
  repeated int32 samples = 4 [packed=true];
}
message Person {
  reserved 2, 15, 9 to 11;
  reserved "samples", "email";
}
message Person {
  required string name = 1;
  required int32 id = 2;
  optional string email = 3;

  enum PhoneType {
    // allow_alias = true;
    MOBILE = 0;
    HOME = 1;
    WORK = 2;
  }
  message PhoneNumber {
    required string number = 1;
    optional PhoneType type = 2 [default = HOME];
  }
  repeated PhoneNumber phones = 4;
}
message Person {
  extensions 100 to 199;
}
extend Person {
  optional int32 bar = 126;
}


1-15 1 byte
16-2047 2bytes

required 1
optional 0|1
repeated 0-n


### protobuf
#### 安装
$ wget https://github.com/protocolbuffers/protobuf/releases/download/v2.6.1/protobuf-2.6.1.tar.gz
$ tar -xvf protobuf-2.6.1.tar.gz
$ cd protobuf-2.6.1
$ ./configure
$ make -j8

#### 使用
protoc -I=. --python_out=. ./addressbook.proto
protoc -I=. --cpp_out=. ./addressbook.proto
protoc -I=. --php_out=. ./addressbook.proto

#### protobuf Python 
$ cd protobuf-2.6.1/python
$ mkdir google/protobuf/compiler # 解决无法创建目录的错误
$ python setup.py install
