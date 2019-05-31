<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title}}</title>

    <link rel="stylesheet" href="//at.alicdn.com/t/font_1186056_pkzt0lgxll.css">
    <link rel="stylesheet" href="/styles/tool.css">
</head>
<body>
    <div id="app">
        <header-first title="包管理"></header-first>
        <list-second></list-second>
        <footer-first></footer-first>
        <tip-first :message="message"></tip-first>
    </div>

    <script src="/scripts/tool.js"></script>
</body>
</html>