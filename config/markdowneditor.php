<?php
return [
    "default" => 'local', // 默认返回存储位置 url
    "dirver" => ['local'], // 存储平台 ['local', 'qiniu', 'aliyun']
    "connections" => [ // 连接
        "local" => [ // 本地
            'upload_url' => 'markdown/editormd/upload', // markdown/editormd/upload
            'prefix' => 'uploads/editormd', // 本地存储位置 uploads[default] uploads/editormd uploads/markdown uploads/images
        ],
        "qiniu" => [ // 七牛
            'access_key' => '',
            'secret_key' => '',
            'bucket' => '',
            'prefix' => '', // 前缀
            'domain' => '' // 域名
        ],
        "aliyun" => [ // 阿里云
            'ak_id' => '',
            'ak_secret' => '',
            'end_point' => '',
            'bucket' => '',
            'prefix' => '', // 前缀
        ],
    ],
];