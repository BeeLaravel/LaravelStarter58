<?php

function category($category_id, $parent_id=0) {
	$category = Category::find($category_id);

	$data = $category->items
		->where('parent_id', $parent_id)
		->pluck('title', 'id');

	return $data;
}