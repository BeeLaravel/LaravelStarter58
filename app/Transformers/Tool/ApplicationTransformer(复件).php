<?php
namespace App\Transformers\Tool;

use League\Fractal\TransformerAbstract;

use App\Models\Tool\Application as ThisTransformer;

class ApplicationTransformer extends TransformerAbstract {
    protected $availableIncludes = ['user', 'category', 'topReplies'];

    public function transform(ThisTransformer $item) {
        return [
            'id' => $item->id,

            'title' => $item->title,
            'slug' => $item->slug,
            'language' => $item->language,
            'category' => $item->category,
            'description' => $item->description,
            'note' => $item->note,

            'sort' => $item->sort,
            // 'created_by' => $item->created_by,
            // 'created_at' => $item->created_at,
            // 'updated_at' => $item->updated_at,
            // 'deleted_at' => $item->deleted_at,
        ];
    }

    // public function includeUser(ThisTransformer $vote) {
    //     return $this->item($vote->creater, new \App\Transformers\RBAC\UserTransformer());
    // }
    // public function includeUsers(ThisTransformer $vote) {
    //     return $this->collection($vote->users, new UserTransformer());
    // }
    // public function includeLogs(ThisTransformer $vote) {
    //     return $this->collection($vote->logs, new UserTransformer());
    // }
}