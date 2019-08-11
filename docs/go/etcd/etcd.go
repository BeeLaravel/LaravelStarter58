package main

import (
	"context"
	"fmt"
	"log"
	"strconv"
	"time"

	"go.etcd.io/etcd/clientv3"
	"vincent.com/etcd/etcd/etcdserver/api/v3rpc/rpctypes"
)

func main() {

	cli, err := clientv3.New(clientv3.Config{
		Endpoints:   []string{"http://127.0.0.1:23790", "http://127.0.0.1:23791"},
		DialTimeout: 5 * time.Second,
	})
	if err != nil {
		// handle error!
		log.Fatalln(err.Error())
	}
	defer cli.Close()
	defer cli.Delete(context.Background(), "sample_key")

	for index := 0; index < 10000; index++ {
		insertKV(cli, "sample_key", "sample_value"+strconv.Itoa(index))
		if err != nil {
			break
		}
	}
	resp, err := cli.Get(context.Background(), "sample_key")
	if err != nil {
		log.Fatalln("get key error", err)
	}
	fmt.Printf("get the sample_key: %v\n", resp.Kvs)
}

func insertKV(cli *clientv3.Client, key string, value string) (err error) {
	time.Sleep(2 * time.Millisecond)
	_, err = cli.Put(context.Background(), key, value)
	// cancel()
	if err != nil {
		switch err {
		case context.Canceled:
			log.Fatalf("ctx is canceled by another routine: %v", err)

		case context.DeadlineExceeded:
			log.Fatalf("ctx is attached with a deadline is exceeded: %v", err)
		case rpctypes.ErrEmptyKey:
			log.Fatalf("client-side error: %v", err)
		default:
			log.Fatalf("bad cluster endpoints, which are not etcd servers: %v", err)
		}
	}
	return
}