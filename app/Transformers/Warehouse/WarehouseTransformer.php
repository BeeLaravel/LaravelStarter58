<?php
namespace App\Transformers\Warehouse;

use League\Fractal\TransformerAbstract;

use App\Models\Warehouse\Warehouse as ThisTransformer;

class WarehouseTransformer extends TransformerAbstract {
    protected $availableIncludes = ['user', 'category', 'topReplies'];

    public function transform(ThisTransformer $item) {
        return [
            'id' => $item->id,

            'title' => $item->title,
            'slug' => $item->slug,
            'type' => $item->type,
            'description' => $item->description,

            'sort' => $item->sort,
            // 'created_by' => $item->created_by,
            'created_at' => $item->created_at->diffForHumans(),
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