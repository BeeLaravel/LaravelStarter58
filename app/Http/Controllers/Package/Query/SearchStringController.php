<?php
namespace App\Http\Controllers\Package\Query;

use Illuminate\Http\Request;

// use App\Models\Acticle;
// use App\Models\Invoice;

class SearchStringController extends Controller {
    public function index() {
        // 未发布或标题为「我的博客文章」的最新博客文章
        // Article::usingSearchString('title:"My blog article" or not published sort:-created_at');

        // Article::where('title', 'My blog article')
        //     ->orWhere('published', false)
        //     ->orderBy('created_at', 'desc');

        // 在客户和描述列中搜索术语 「John」，同时确保发票已付款或存档
        // Invoice::usingSearchString('John and status in (Paid,Archived) limit:10 from:10');

        // Invoice::where(function ($query) {
        //     $query->where('customer', 'like', '%John%')
        //         ->orWhere('description', 'like', '%John%');
        // })
        // ->whereIn('status', ['Paid', 'Archived'])
        // ->limit(10)
        // ->offset(10);

    	return 'search string index';
    }
    public function test() {
        // // 'Apple Banana'
        // $query->where(function($query) {
        //     $query->where('title', 'like', '%Apple%')
        //         ->orWhere('description', 'like', '%Apple%');
        // })
        // ->where(function($query) {
        //     $query->where('title', 'like', '%Banana%')
        //         ->orWhere('description', 'like', '%Banana%');
        // });

        // // '"John Doe"'
        // $query->where(function($query) {
        //     $query->where('title', 'like', '%John Doe%')
        //         ->orWhere('description', 'like', '%John Doe%');
        // });
    }
}

// composer require lorisleiva/laravel-search-string // 安装
// php artisan vendor:publish --tag=search-string // 发布配置 search-string.php

// // 精确匹配
// 'title:Hello'
// 'title=Hello'
// 'title:"Hello World"'
// 'rating : 0'
// 'rating = 99.99'
// 'created_at: "2018-07-06 00:00:00"'

// // 比较
// 'title < B'
// 'rating > 3'
// 'created_at >= "2018-07-06 00:00:00"'

// // 在数组中
// 'title in (Hello, Hi, "My super article")'
// 'status in(Finished,Archived)'
// 'status:Finished,Archived'

// // 检查日期
// // - 术语必须定义为日期
// 'created_at = today'        // today between 00:00 and 23:59
// 'not created_at = today'    // any time before today 00:00 and after today 23:59
// 'created_at >= tomorrow'    // from tomorrow at 00:00
// 'created_at <= tomorrow'    // until tomorrow at 23:59
// 'created_at > tomorrow'     // from the day after tomorrow at 00:00
// 'created_at < tomorrow'     // until today at 23:59

// // 检查布尔值
// // - 术语必须定义为布尔值
// 'published'         // published = true
// 'created_at'        // created_at is not null

// // 否定
// 'not title:Hello'
// 'not title="My super article"'
// 'not rating:0'
// 'not rating>4'
// 'not status in (Finished,Archived)'
// 'not published'     // published = false
// 'not created_at'    // created_at is null

// // 空值(区分大小写)
// 'body:NULL'         // body 为空
// 'not body:NULL'     // body 不为空

// // 搜索查询
// // - 术语不能定义为布尔值
// // - 至少有一列必须定义为可搜索的
// 'Apple'             // %Aplle% like at least one of the searchable columns
// '"John Doe"'        // %John Doe% like at least one of the searchable columns
// 'not "John Doe"'    // %John Doe% not like any of the searchable columns

// // 与/或嵌套查询
// 'title:Hello body:World'        // Implicit and
// 'title:Hello and body:World'    // Explicit and
// 'title:Hello or body:World'     // Explicit or
// 'A B or C D'                    // Equivalent to '(A and B) or (C and D)'
// 'A or B and C or D'             // Equivalent to 'A or (B and C) or D'
// '(A or B) and (C or D)'         // Explicit nested priority
// 'not (A and B)'                 // Equivalent to 'not A or not B'
// 'not (A or B)'                  // Equivalent to 'not A and not B'

// // 特殊的关键字
// 'fields:title,body,created_at'  // Select only title, body, created_at
// 'not fields:rating'             // Select all columns but rating
// 'sort:rating,-created_at'       // Order by rating asc, created_at desc
// 'limit:1'                       // Limit 1
// 'from:10'                       // Offset 10