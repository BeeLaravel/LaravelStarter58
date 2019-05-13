<?php
namespace App\Transformers\Vote;

use League\Fractal\TransformerAbstract;

use App\Models\Vote\Log;

class LogTransformer extends TransformerAbstract {
    public function transform(Log $log) {
        return [
            'id' => $log->id,
            'vote_user_id' => $log->vote_user_id,

            // 'title' => $log->title,
            'visited_count' => $log->visited_count,

            'ip' => $log->ip,

            'created_at' => $log->created_at,
            // 'updated_at' => $log->updated_at,
            // 'deleted_at' => $log->deleted_at,

            // 'created_by' => $log->created_by,
            // 'updated_by' => $log->updated_by,
            // 'deleted_by' => $log->deleted_by,
        ];
    }
}
