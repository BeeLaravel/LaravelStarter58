# encoding:utf-8
import sys
import addressbook_pb2

address_book = addressbook_pb2.AddressBook()

person = address_book.people.add()
person.id = 1234
person.name = "John Doe"
person.email = "jdoe@example.com"

phone = person.phones.add()
phone.number = "555-4321"
phone.type = addressbook_pb2.Person.HOME

print(person.IsInitialized()) # 检查是否所有 required 的 Filed 都有赋值

res = person.SerializeToString() # 序列化
a = addressbook_pb2.Person()
a.ParseFromString(res) # 反序列化

b = addressbook_pb2.Person()
b.name = "Tom"
b.CopyFrom(a) # 拷贝

a.Clear() # 删除

print(b)