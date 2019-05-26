<?php
namespace App\Http\Controllers\Api\Tool;

use Illuminate\Http\Request;

use App\Http\Requests\Tool\FileRequest as ThisRequest;
use App\Models\Tool\File as ThisModel;
use App\Transformers\Tool\FileTransformer as ThisTransformer;

use Storage;

class FileController extends Controller { // 包管理
    public function index(Request $request, $parent_id=0) {
        $page = $request->query('page', 1);
        $per_page = $request->query('per_page', 20);
        $filter = $request->query('filter', "");
        $category = $request->query('category', "");
        $md5 = $request->query('md5', "");
        $sha1 = $request->query('sha1', "");

        $items = new ThisModel;

        if ( $filter ) $items = $items->where(function($query) use ($filter){
            $filter = '%'.$filter.'%';

            return $query->where('title', 'like', $filter)
                ->orWhere('extension', 'like', $filter)
                ->orWhere('mime', 'like', $filter);
        });
        if ( $md5 ) $items = $items->where('md5', $md5);
        if ( $sha1 ) $items = $items->where('sha1', $sha1);
        if ( $category ) $items = $items->where('category', $category);
  
        $items = $items
            ->orderBy('id', 'desc')
            ->paginate($per_page);

        return $this->response->paginator($items, new ThisTransformer);
    }
    public function show($id) {
        $item = ThisModel::findOrFail($id);

        return $this->response->item($item, new ThisTransformer);
    }
    public function store(ThisRequest $request) {
        $file = $request->file('file');
        $category = $request->input('category', 'default');

        $item = ThisModel::where([
            'category' => $category,
            'md5' => md5_file($file->getRealPath()),
        ])->first();

        if ( !$item ) {
            $relative_path = 'app/'.$file->store($category);
            $absolute_path = storage_path($relative_path);

            $item = ThisModel::create([
                'title' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'mime' => $file->getClientMimeType(),
                'size' => $file->getClientSize(),
                'category' => $category,
                'url' => $relative_path,
                'md5' => md5_file($absolute_path),
                'sha1' => sha1_file($absolute_path),
            ]);
        }

        return [
            'result' => $item,
        ];
    }
    public function update(ThisRequest $request, $id) {
        $item = ThisModel::findOrFail($id);
        $delete_result = Storage::delete(substr($item->url, 4));

        $file = $request->file('file');
        $category = $request->input('category', 'default');
        $relative_path = 'app/'.$file->store($category);
        $absolute_path = storage_path($relative_path);

        $result = $item->update([
            'title' => $file->getClientOriginalName(),
            'extension' => $file->getClientOriginalExtension(),
            'mime' => $file->getClientMimeType(),
            'size' => $file->getClientSize(),
            'category' => $category,
            'url' => $relative_path,
            'md5' => md5_file($absolute_path),
            'sha1' => sha1_file($absolute_path),
        ]);

        return [
            'result' => $result,
        ];
    }
    public function destroy($id) {
        $item = ThisModel::findOrFail($id);
        $delete_result = Storage::delete(substr($item->url, 4));

        $result = $item->delete();

        return [
            'result' => $result,
        ];
    }
}
