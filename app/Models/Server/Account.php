<?php

namespace App\Models\Server;

use Illuminate\Database\Eloquent\Model;

use Lorisleiva\LaravelSearchString\Concerns\SearchString;

class Account extends Model
{
    use SearchString;

    protected $table = 'server_accounts';

    protected $fillable = ['type', 'unique_slug', 'key', 'value', 'created_at', 'updated_at', 'created_by'];

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

