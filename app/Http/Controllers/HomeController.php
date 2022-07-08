<?php

namespace App\Http\Controllers;

use Elastic\Elasticsearch\Response\Elasticsearch;
use http\Client\Response; 

use Elastic\Elasticsearch\ClientBuilder;

class HomeController extends Controller
{


    public function create()
    {

      $params = [];
      $params['body']=['first_name'=>'reza' , 'last_name'=>"reza"];
      $params['index']='mysite1';
      $params['type']='mysite1';
      $result = $this->makeClient()->index($params);
      dd($result);
    }

    public function serachOne(){

     $result = $client->search(['body'=>[
                                'query'=>[
                                'bool'=>[
                                'should'=>[
                                   'match'=>['first_name'=>'amin']
                                   // 'match'=>['last_name'=>'a'],
                                  ]
                                ]
                             ]
                        ]
                   ]);

     dd($result['hits']['hits']);

    }


    public function serachTow(){


      $params['index'] = 'all';
     $params['type']='mysite2';

     $params['body']['query']['match']['first_name']='amin';
     $result = $client->search($params);
     dd($result['hits']['hits']);

    }


   private  function  makeClient()
   {
       return  ClientBuilder::create()->build(); 

   }
}
