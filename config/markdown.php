<?php
declare(strict_types=1);

return [ // graham-campbell/markdown GrahamCampbell/Laravel-Markdown
    'views' => true, // Default: true 渲染 markdown 视图 后缀 .md .md.php .md.blade.php Blade @markdown
    'extensions' => [
        // AltThree\Emoji\EmojiExtension::class, // 暂不支持 laravel 5.8
    ], // Default: [] 自动加载的扩展
    'renderer' => [ // 渲染 HTML
        'block_separator' => "\n",
        'inner_separator' => "\n",
        'soft_break'      => "\n",
    ],
    'enable_em' => true, // Default: true <em>
    'enable_strong' => true, // Default: true <strong>
    'use_asterisk' => true, // Default: true *
    'use_underscore' => true, // Default: true _
    'html_input' => 'escape', // Default: 'strip' 去除不被信任的 HTML 标签 [strip 去除 escape 转义 allow 允许]
    'allow_unsafe_links' => false, // Default: true 允许图片 URL 以及链接，javascript:, vbscript:, file:, data: 协议的链接
    'max_nesting_level' => INF, // Default: INF 允许的最大缩进
];
