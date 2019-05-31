<?php
namespace App\Console\Commands\Tool;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use App\Models\Tool\CustomFont as ThisModel;

class FontCopy extends Command {
    protected $signature = 'tool:font_copy {font}';
    protected $description = 'Copy created font to public';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $font = $this->input->getArgument('font', 1);

        $item = ThisModel::find($font);
        if ( !$item ) throw new Exception("字体不存在！");

        $source_path = storage_path($item->url);
        $destination_path = public_path('fonts/'.$item->font->language->title.'/'.pathinfo($source_path, PATHINFO_BASENAME));

        $return = copy($source_path, $destination_path);

        if ( $return ) {
            echo "操作成功！\n";
        } else {
            echo "操作失败！\n";
        }
    }
    protected function getArguments() {
        return [
            ['font', InputArgument::REQUIRED, 'The source font'],
        ];
    }
    protected function getOptions() {
        return [];
    }
}
// php artisan tool:font_copy 1
