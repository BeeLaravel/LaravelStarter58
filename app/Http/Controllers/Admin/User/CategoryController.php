<?php
namespace App\Http\Controllers\Admin\User;

use App\Models\User\Category;

use Illuminate\Http\Request;
use App\Http\Requests\User\CategoryRequest;

class CategoryController extends Controller {
    private $show = [
        'id',
        'title',
        'slug',
        'type',
        'sort',
        'created_at',
        'updated_at',
    ];

    public function index(Request $request) {
        if ( $request->ajax() ) {
            $draw = $request->input('draw', 1); // 页面次序
            $start = $request->input('start', 0); // 开始记录
            $length = $request->input('length', 20); // 分页长度

            $order['name'] = $request->input('columns.' .$request->input('order.0.column') . '.name', 'id'); // 排序字段
            $order['dir'] = $request->input('order.0.dir', 'desc'); // 升降序
            $search['value'] = $request->input('search.value', ''); // 搜索字段
            $search['regex'] = $request->input('search.regex', false); // 是否正则

            $model = Category::where('created_by', auth('admin')->user()->id); // 筛选用户
            $model = $model->where('parent_id', $request->query('parent_id', 0)); // 筛选层级

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
            $model = $model->offset($start)->limit($length)->withCount('children')->get(); // 分页

            if ( $model ) {
                foreach ( $model as $item ) {
                    $item->title = $item->children_count ? "<a href='".url('/admin/categories/').'?'.http_build_query(['parent_id' => $item->id])."'>".$item->title." (".$item->children_count.")</a>" : $item->title;
                    $item->button = $item->getActionButtons('categories');
                }
            }

            return [
                'draw' => $draw,
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $model,
            ];
        } else {
            $types = auth('admin')->user()->profile->categories;
            $types = json_decode($types, true);

            $parent_id = $request->input('parent_id', 0);

            $search = [
                'parent_id' => $parent_id,
            ];

            $parent = null;
            if ( $parent_id ) $parent = Category::find($parent_id);

            return view('admin.user.category.index', compact('types', 'search', 'parent'));
        }
    }
    public function create(Request $request) {
        $types = auth('admin')->user()->profile->categories;
        $types = json_decode($types, true);

        $category_array = Category::where('created_by', auth('admin')->user()->id)->get();
        $categories = level_array($category_array);
        $categories = plain_array($categories, 0, '==');

        $parent_id = $request->query('parent_id', 0);

        return view('admin.user.category.create', compact('types', 'categories', 'parent_id'));
    }
    public function store(CategoryRequest $request) {
        $result = Category::create(array_merge($request->all(), [
            'created_by' => auth('admin')->user()->id
        ]));

        if ( $result ) {
            flash('操作成功', 'success');

            return redirect('/admin/categories?'.http_build_query(['parent_id' => $result->parent_id])); // 列表
        } else {
            flash('操作失败', 'error');

            return back(); // 继续
        }
    }
    public function show(int $id) {
        return 'user category show';
    }
    public function edit(int $id) {
        $types = auth('admin')->user()->profile->categories;
        $types = json_decode($types, true);

        $category_array = Category::where('created_by', auth('admin')->user()->id)->get();
        $categories = level_array($category_array);
        $categories = plain_array($categories, 0, '==');

        $item = Category::find($id);

        return view('admin.user.category.edit', compact('types', 'categories', 'item'));
    }
    public function update(CategoryRequest $request, int $id) {
        $category = Category::find($id);
        $result = $category->update($request->all());

        if ( $result ) {
            flash('操作成功', 'success');

            return redirect('/admin/categories'); // 列表
        } else {
            flash('操作失败', 'error');

            return back(); // 继续
        }
    }
    public function destroy(Request $request, int $id) {
        $result = Category::destroy($id);

        if ( $result ) {
            flash('删除成功', 'success');
        } else {
            flash('删除失败', 'error');
        }

        return redirect('admin/categories');
    }
}
