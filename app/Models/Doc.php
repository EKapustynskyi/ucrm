<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    protected $table = 'docs';
    protected $primaryKey = 'docs_id';
    public $timestamps = false;

    protected $fillable = [
        'docs_hash', 'docs_name', 'docs_type_id', 'docs_status_id',
        'access_id', 'priority_id', 'abstract', 'docs_path',
        'parent_docs_id', 'deadline', 'date_created', 'date_updated'
    ];
}
