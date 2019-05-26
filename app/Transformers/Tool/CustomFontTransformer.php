<?php
namespace App\Transformers\Tool;

use League\Fractal\TransformerAbstract;

use App\Models\Tool\CustomFont as ThisTransformer;

class CustomFontTransformer extends TransformerAbstract {
    protected $availableIncludes = ['font'];

    public function transform(ThisTransformer $item) {
        return [
            'id' => $item->id,

            'title' => $item->title,
            'content' => $item->content,
            'font' => $item->font,
            'url' => $item->url,

            'sort' => $item->sort,
            // 'created_by' => $item->created_by,
            // 'created_at' => $item->created_at,
            // 'updated_at' => $item->updated_at,
            // 'deleted_at' => $item->deleted_at,
        ];
    }

    public function includeFont(ThisTransformer $item) {
        return $this->item($item->font, new \App\Transformers\Tool\FontTransformer());
    }
}

