<?php

namespace App\Models;

use Database\Factories\WorkerFactory;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Worker extends Model
{
    use HasFactory;

    protected $table="workers";

    protected $mappingProperties=array(
        'name'=>[
            'type'=>'text',
            "analyzer"=>"standard",
        ],
        'country'=>[
            'type'=>'text',
            "analyzer"=>"standard",
        ],
    );


    /**
     * @return mixed
     */
    protected static function newFactory()
    {
        return WorkerFactory::new();
    }





}
