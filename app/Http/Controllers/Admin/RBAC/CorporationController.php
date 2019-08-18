<?php
namespace App\Http\Controllers\Admin\RBAC;

use Illuminate\Http\Request;

use App\Models\RBAC\Corporation;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Admin\RBAC\CorporationExport;

// RBAC - 公司
class CorporationController extends Controller {
    public function index() {
        $where = [];

        $list = Corporation::where($where)
            ->paginate(10);

        return view('admin.rbac.corporation.index', compact('list'));
    }
    public function create() {
        return view('admin.rbac.corporation.create');
    }
    public function store(Request $request) {
        
    }
    public function show(Corporation $corporation) {
        
    }
    public function edit(Corporation $corporation) {
        
    }
    public function update(Request $request, Corporation $corporation) {
        
    }
    public function destroy(Corporation $corporation) {
        
    }

    public function export() {
        return Excel::download(new CorporationExport, 'corporations.xlsx');
    }
    public function download($type) {
        $path = '';

        switch ( $type ) {
            case 'template':
                $path = template_path('report/import/壹加壹网电战绩榜模板.xlsx');
            break;
            case 'picture':
                $directory = temp_path('abc');
                $images_path = glob($directory . "/*.jpg");
                $path = $directory . ".zip";

                $zipper = new \Chumper\Zipper\Zipper;
                $zipper->make($path)->add($images_path)->close();
            break;
            default:
            break;
        }

        if ( $path ) {
            return response()->download($path);
        } else {
            return back();
        }
    }
}
