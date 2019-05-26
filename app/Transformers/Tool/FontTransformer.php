<?php
namespace App\Transformers\Tool;

use League\Fractal\TransformerAbstract;

use App\Models\Tool\Font as ThisTransformer;

class FontTransformer extends TransformerAbstract {
    protected $availableIncludes = ['user', 'category', 'topReplies'];

    public function transform(ThisTransformer $item) {
        $data = [
            'id' => $item->id,

            'title' => $item->title,
            'slug' => $item->slug,
            'url' => $item->url,
            'language' => $item->language,
            'category' => $item->category,
            'company' => $item->company,
            'weight' => $item->weight,
            'description' => $item->description,

            'sort' => $item->sort,
            // 'created_by' => $item->created_by,
            // 'created_at' => $item->created_at,
            // 'updated_at' => $item->updated_at,
            // 'deleted_at' => $item->deleted_at,
        ];

        if ( $item->info ) $data['info'] = $item->info;

        return $data;
    }

    // public function includeUsers(ThisTransformer $vote) {
    //     return $this->collection($vote->users, new UserTransformer());
    // }
    // public function includeLogs(ThisTransformer $vote) {
    //     return $this->collection($vote->logs, new UserTransformer());
    // }
}