<?php
namespace App\Transformers\Basic;

use League\Fractal\TransformerAbstract;

use App\Models\Basic\Language as ThisTransformer;

class LanguageTransformer extends TransformerAbstract {
    protected $availableIncludes = ['font'];

    public function transform(ThisTransformer $item) {
        return [
            'id' => $item->id,

            'slug' => $item->slug,
            'title' => $item->title,
            'description' => $item->description,
            'Basic_id' => $item->Basic_id,

            'sort' => $item->sort,
            // 'created_by' => $item->created_by,
            // 'created_at' => $item->created_at,
            // 'updated_at' => $item->updated_at,
            // 'deleted_at' => $item->deleted_at,
        ];
    }

    // public function includeFont(ThisTransformer $item) {
    //     return $this->item($item->font, new \App\Transformers\Tool\FontTransformer());
    // }
}

