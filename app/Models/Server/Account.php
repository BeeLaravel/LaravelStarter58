<?php
namespace App\Models\Server;

use Illuminate\Database\Eloquent\Model;

use Lorisleiva\LaravelSearchString\Concerns\SearchString;
use Glorand\Model\Settings\Traits\HasSettingsTable; // 模型设置
use Glorand\Model\Settings\Traits\HasSettingsField;

class Account extends Model {
    use SearchString;
    use HasSettingsTable;
    use HasSettingsField;

    protected $table = 'server_accounts';
    protected $fillable = ['type', 'unique_slug', 'key', 'value', 'created_at', 'updated_at', 'created_by'];

    protected $persistSettings = true; // 持久化
    public $settingsFieldName = 'settings'; // 模型设置
    
    protected $searchStringColumns = [
        // 'title',
        // 'body' => 'content',
        // 'published_at' => '/^published|live$/',
        // 'created_at' => [
        //     'key' => 'created',         // Default to column name: /^created_at$/
        //     'operator' => '/^:|=$/',    // Default to everything: /.*/
        //     'value' => '/^[\d\s-:]+$/', // Default to everything: /.*/
        //     'date' => true,             // Default to true only if the column is cast as date.
        //     'boolean' => true,          // Default to true only if the column is cast as boolean or date.
        //     'searchable' => false       // Default to false.
        // ],
    ];
    protected $searchStringKeywords = [
        // 'select' => [
        //     'key' => 'fields',
        //     'operator' => '/^:|=$/',
        //     'value' => '/.*/',
        // ], // Updates the selected query columns
        // 'order_by' => 'sort',   // Updates the order of the query results
        // 'limit' => 'limit',     // Limits the number of results
        // 'offset' => 'from',     // Starts the results at a further index
    ];
    
    public function getSearchStringOptions() {
        return [
            'columns' => $this->searchStringColumns ?? [],
            'keywords' => $this->searchStringKeywords ?? [],
        ];
    }
}
// php artisan model-settings:model-settings-field # 指定模型设置字段
// php artisan migrate # 迁移
// ### 模型设置 .env
// MODEL_SETTINGS_FIELD_NAME=settings
// MODEL_SETTINGS_TABLE_NAME=model_settings
// MODEL_SETTINGS_PERSISTENT=true # 持久化

// $user->settings()->all();
// $user->settings()->get();

// $user->settings()->get('some.setting');
// $user->settings()->get('some.setting', 'default value');

// $user->settings()->getMultiple([
//     'some.setting_1',
//     'some.setting_2',
// ], 'default value');

// $user->settings()->apply((array)$settings); // Add / Update setting
// $user->settings()->set('some.setting', 'new value');
// $user->settings()->update('some.setting', 'new value');

// $user->settings()->setMultiple([
//     'some.setting_1' => 'new value 1',
//     'some.setting_2' => 'new value 2',
// ]);

// $user->settings()->has('some.setting');

// $user->settings()->delete('some.setting');

// $user->settings()->deleteMultiple([
//     'some.setting_1',
//     'some.setting_2',
// ]);

// $user->settings()->clear();
