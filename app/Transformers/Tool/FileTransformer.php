<?php
namespace App\Transformers\Tool;

use League\Fractal\TransformerAbstract;

use App\Models\Tool\File as ThisTransformer;

class FileTransformer extends TransformerAbstract {
    protected $availableIncludes = ['user', 'category', 'topReplies'];

    public function transform(ThisTransformer $item) {
        return [
            'id' => $item->id,

            'title' => $item->title,
            'extension' => $item->extension,
            'mime' => $item->mime,
            'size' => $item->size,
            'category' => $item->category,
            'url' => $item->url,
            'md5' => $item->md5,
            'sha1' => $item->sha1,

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