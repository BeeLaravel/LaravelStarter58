<?php
namespace App\Transformers\Warehouse;

use League\Fractal\TransformerAbstract;

use App\Models\Warehouse\Area as ThisTransformer;

class AreaTransformer extends TransformerAbstract {
    protected $availableIncludes = ['warehouse'];

    public function transform(ThisTransformer $item) {
        return [
            'id' => $item->id,

            'slug' => $item->slug,
            'title' => $item->title,
            'description' => $item->description,
            'warehouse_id' => $item->warehouse_id,

            'warehouse' => $item->warehouse,

            'sort' => $item->sort,
            // 'created_by' => $item->created_by,
            'created_at' => $item->created_at->diffForHumans(),
            // 'updated_at' => $item->updated_at,
            // 'deleted_at' => $item->deleted_at,
        ];
    }

    public function includeWarehouse(ThisTransformer $item) {
        return $this->item($item->warehouse_id, new \App\Transformers\Warehouse\WarehouseTransformer());
    }
}

