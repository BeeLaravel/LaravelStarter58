<?php
namespace App\Http\Controllers\Api\Tool;

use Storage;

use Vinkla\Hashids\Facades\Hashids;

class DownloadController extends Controller { // 包管理
    public function download($type, $id) {
        switch ( $type ) {
            case 'files':
                $item = \App\Models\Tool\File::find($id);
            break;
            case 'fonts':
                $item = \App\Models\Tool\Font::find($id);
            break;
            case 'custom_fonts':
                $item = \App\Models\Tool\CustomFont::find($id);
            break;
            case 'svgs':
                $item = \App\Models\Tool\Svg::find($id);
            break;
            default:
                throw new \Exception('不支持的分类！');
        }

        if ( !$item ) throw new \Exception('记录不存在！');

        switch ( $type ) {
            case 'custom_fonts':
                $path = storage_path($item->url);
                if ( !file_exists($path) ) {
                    $result = $this->makeCustomFont($item);
                    if ( !$result || !file_exists($path) ) throw new \Exception('系统错误，请联系管理员');
                }
            break;
            default:
        }

        return Storage::download(substr($item->url, 4));
    }
    public function makeCustomFont($item) {
        $java_path = "/usr/bin/java";
        $sfnt_path = storage_path("app/program/sfnttool.jar");
        $content = preg_replace("/\s/", "", $item->content);
        $font_path = storage_path($item->font->url);
        $output_path = storage_path($item->url);

        $command = "{$java_path} -jar {$sfnt_path} -s {$content} {$font_path} {$output_path}";
        $set_charset = 'export LANG=en_US.UTF-8;';
        passthru($set_charset.$command, $return);

        return $return==0;
    }
}
