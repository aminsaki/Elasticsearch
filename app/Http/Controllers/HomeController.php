<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
//        $param=[];
//        $post=Post::with('category')->get();
//
//        foreach($post as $row) {
//            $param['index']='shop';
//            $param['body']['title']=$row->title;
//            $param['body']['image_url']=$row->image_url;
//            $param['body']['price']=$row->price;
//            $param['body']['option']=$row->option;
//            $param['body']['cat_title']=$row->category->title;
//            $param['body']['body']=$row->body;
//            $param['mappings']['properties']['cat_title']['type']='keyword';
//            $param['mappings']['properties']['option']['type']='keyword';
//            $this->getClient()->index($param);
//        }
        return view('welcome', ['posts'=>Post::with('category')->get()->toArray()]);

    }

    public function serach(Request $request)
    {
        $param=[
            'body'=>[
                'query'=>[
                    "match"=>[
                        "title"=>"ms"
                    ]
                ]
            ]
        ];
        $result=$this->getClient()->search($param);
        dd($result->asArray());
        return view('welcome', ['posts'=>$result->asArray()['hits']['hits']]);

    }

    protected function getClient()
    {
        $client=ClientBuilder::create()
            ->setSSLVerification(false)
            ->setApiKey("RUpvZ000TUJUbkVrcEZXRkhYbFc6RmlKRnhMYVlSSHVSdkF2a285ek5vUQ==")
            ->setHosts(['https://localhost:9200/'])
            ->build();
        return $client;

    }

    public function putmapping()
    {
        $param=[
            'index'=>'shop',
            'body'=>[
                "mappings"=>[
                    'properties'=>[
                        "name"=>["type"=>"text"]

                    ]
                ]
            ]

        ];

        $result=$this->getClient()->indices($param)->putMapping()
        return view('welcome', ['posts'=>$result->asArray()['hits']['hits']]);
    }

}
