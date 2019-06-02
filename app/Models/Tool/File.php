<?php
namespace App\Models\Tool;

class File extends Model {
    protected $fillable = ['title', 'extension', 'mime', 'size', 'category', 'url', 'md5', 'sha1', 'created_by', 'created_at', 'updated_at'];
}
