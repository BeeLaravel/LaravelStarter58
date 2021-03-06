<?php
namespace App\Http\Controllers\Admin\User;

use App\Models\User\Tag;

use Illuminate\Http\Request;
use App\Http\Requests\User\TagRequest;

class TagController extends Controller {
    private $show = [
        'id',
        'title',
        'slug',
        'type',
        'created_at',
        'updated_at',
    ];

    public function index(Request $request) {
        if ( $request->ajax() ) {
            $draw = $request->input('draw', 1);
            $start = $request->input('start', 0);
            $length = $request->input('length', 20);

            $order['name'] = $request->input('columns.' .$request->input('order.0.column') . '.name', 'id'); // 排序字段
            $order['dir'] = $request->input('order.0.dir', 'desc'); // 升降序
            $search['value'] = $request->input('search.value', ''); // 搜索字段
            $search['regex'] = $request->input('search.regex', false); // 是否正则

            $model = Tag::where('created_by', auth('admin')->user()->id);

            // # 搜索
            $columns = $request->input('columns');
            foreach ( $columns as $key => $value ) { // 字段搜索
                if ( $value['search']['value'] ) {
                    switch ( $key ) {
                        default:
                            if ( $value['search']['value'] ) { // 有内容
                                if ( $value['search']['regex']=='true' ) { // 正则
                                    $model = $model->where($this->show[$key], 'like', "%{$value['search']['value']}%");
                                } else { // 普通
                                    $model = $model->where($this->show[$key], $value['search']['value']);
                                }
                            }
                    }
                }
            }

            if ( $search['value'] ) { // 搜索
                if ( $search['regex'] == 'true' ) { // 正则匹配
                    $model = $model->where('slug', 'like', "%{$search['value']}%")
                        ->orWhere('title', 'like', "%{$search['value']}%")
                        ->orWhere('description', 'like', "%{$search['value']}%");
                } else { // 完全匹配
                    $model = $model->where('slug', $search['value'])
                        ->orWhere('title', $search['value'])
                        ->orWhere('description', $search['value']);
                }
            }

            $count = $model->count(); // 总数
            $model = $model->orderBy($order['name'], $order['dir']); // 排序
            $model = $model->offset($start)->limit($length)->get(); // 分页

            if ( $model ) {
                foreach ( $model as $item ) {
                    $item->parent_name = $item->parent_id ? $item->parent->title : '顶级';
                    $item->user_name = $item->created_by ? $item->user->name : '未知';
                    $item->button = $item->getActionButtons('tags');
                }
            }

            return [
                'draw' => $draw,
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $model,
            ];
        } else {
            $types = auth('admin')->user()->profile->tags;
            $types = json_decode($types, true);

            $search = [
            ];

            return view('admin.user.tag.index', compact('types', 'search'));
        }
    }
    public function create(Request $request) {
        $types = auth('admin')->user()->profile->tags;
        $types = json_decode($types, true);

        return view('admin.user.tag.create', compact('types'));
    }
    public function store(TagRequest $request) {
        $result = Tag::create(array_merge($request->all(), [
            'created_by' => auth('admin')->user()->id,
        ]));

        if ( $result ) {
            flash('操作成功', 'success');

            return redirect('/admin/tags'); // 列表
        } else {
            flash('操作失败', 'error');

            return back(); // 继续
        }
    }
    public function show(int $id) {
        return 'user tag show';
    }
    public function edit(int $id) {
        $types = auth('admin')->user()->profile->tags;
        $types = json_decode($types, true);

        $item = Tag::find($id);

        return view('admin.user.tag.edit', compact('types', 'item'));
    }
    public function update(TagRequest $request, int $id) {
        $items = Tag::find($id);
        $result = $items->update($request->all());

        if ( $result ) {
            flash('操作成功', 'success');

            return redirect('/admin/tags'); // 列表
        } else {
            flash('操作失败', 'error');

            return back(); // 继续
        }
    }
    public function destroy(Request $request, int $id) {
        $result = Tag::destroy($id);

        if ( $result ) {
            flash('删除成功', 'success');
        } else {
            flash('删除失败', 'error');
        }

        return redirect('admin/tags');
    }
}
