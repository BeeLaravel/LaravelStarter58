<?php
namespace App\Console\Commands\Tool;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use App\Models\Tool\Font as ThisModel;

class Font extends Command {
    protected $signature = 'tool:font {font} {content} {output=beesoft}';
    protected $description = 'Create Font';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $font = $this->input->getArgument('font', 1);
        $content = $this->input->getArgument('content');
        $output = $this->input->getArgument('output');

        $font_data = ThisModel::find($font);
        if ( !$font_data ) $font_data = ThisModel::where(['slug' => $font])->first();
        if ( !$font_data ) throw new Exception("字体不存在！");

        $java_path = "/usr/bin/java";
        $sfnt_path = "storage/app/program/sfnttool.jar";
        $font_path = storage_path($font_data->url);
        $output_path = "storage/app/custom_fonts/{$output}.ttf";

        $command = "{$java_path} -jar {$sfnt_path} -s {$content} {$font_path} {$output_path}";
        // $result = shell_exec($command); // 返回执行的命令
        // passthru($command, $return);
        // $result = system($command, $return);
        $result2 = exec($command, $result, $return);

        if ( $return == 0 ) {
            echo "操作成功！文件路径：{$output_path}\n";
        } else {
            echo "操作失败！\n";
        }
    }
    protected function getArguments() {
        return [
            ['font', InputArgument::REQUIRED, 'The Source Font'],
            ['content', InputArgument::REQUIRED, 'The Target Content'],
            ['output', InputArgument::REQUIRED, 'The Target Font'],
        ];
    }
    protected function getOptions() {
        return [];
    }
}
// php artisan tool:font founder_hard_xing 储成英
