<?php
// beyondcode/laravel-er-diagram-generator
return [
    'directories' => [
        base_path('app'),
    ],
    'ignore' => [
        App\User::class,

        App\Models\Model::class,
        App\Models\Basic\Model::class,
        App\Models\Structure\Model::class,
        App\Models\Tool\Model::class,
        App\Models\Config\Model::class,
        App\Models\Server\Model::class,
        App\Models\System\Model::class,
        App\Models\Warehouse\Model::class,

        App\Models\Basic\State::class,
        App\Models\Basic\Language::class,
        App\Models\Basic\Currency::class,

        App\Models\Structure\Category::class,
        App\Models\Structure\CategoryItem::class,

        App\Models\Tool\Application::class,
        App\Models\Tool\Package::class,
        App\Models\Tool\File::class,
        App\Models\Tool\Font::class,
        App\Models\Tool\CustomFont::class,
        App\Models\Tool\Svg::class,
        App\Models\Tool\Account::class,

        App\Models\Config\Configure::class,
        App\Models\Config\Environment::class,

        App\Models\Server\Server::class,
        App\Models\Server\Account::class,
        App\Models\Server\Protocol::class,

        App\Models\System\Config::class,
        App\Models\System\LogRoute::class,
        App\Models\System\LogDatabase::class,

        App\Models\Warehouse\Warehouse::class,
        App\Models\Warehouse\Area::class,
        App\Models\Warehouse\Location::class,
        App\Models\Warehouse\Supplier::class,
        App\Models\Warehouse\Product::class,
        App\Models\Warehouse\Inbound::class,
        App\Models\Warehouse\Outbound::class,
        App\Models\Warehouse\Fee::class,
        App\Models\Warehouse\Cost::class,
        App\Models\Warehouse\Report::class,
        App\Models\Warehouse\Purchase::class,
        App\Models\Warehouse\Order::class,
        App\Models\Warehouse\Exception::class,

        App\Models\Report\Model::class,

        // Post::class => [
        //     'user'
        // ]
    ],
    'recursive' => true,
    'use_db_schema' => true,
    'use_column_types' => true,
    'table' => [
        'header_background_color' => '#d3d3d3',
        'header_font_color' => '#333333',
        'row_background_color' => '#ffffff',
        'row_font_color' => '#333333',
    ],
    'graph' => [
        'style' => 'filled',
        'bgcolor' => '#F7F7F7',
        'fontsize' => 12,
        'labelloc' => 't',
        'concentrate' => true,
        'splines' => 'polyline',
        'overlap' => false,
        'nodesep' => 1,
        'rankdir' => 'LR',
        'pad' => 0.5,
        'ranksep' => 2,
        'esep' => true,
        'fontname' => 'Helvetica Neue'
    ],
    'node' => [ // 结点
        'margin' => 0,
        'shape' => 'rectangle',
        'fontname' => 'Helvetica Neue'
    ],
    'edge' => [ // 边
        'color' => '#003049',
        'penwidth' => 1.8,
        'fontname' => 'Helvetica Neue'
    ],
    'relations' => [ // 关系
        'HasOne' => [ // 一对一
            'dir' => 'both',
            'color' => '#D62828',
            'arrowhead' => 'tee',
            'arrowtail' => 'none',
        ],
        'BelongsTo' => [ // 一对多
            'dir' => 'both',
            'color' => '#F77F00',
            'arrowhead' => 'tee',
            'arrowtail' => 'crow',
        ],
        'HasMany' => [ // 多对多
            'dir' => 'both',
            'color' => '#FCBF49',
            'arrowhead' => 'crow',
            'arrowtail' => 'none',
        ],
    ]
];
