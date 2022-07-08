<?php

namespace App\Http\Controllers;

use Elastic\Elasticsearch\Response\Elasticsearch;
use http\Client\Response; 

use Elastic\Elasticsearch\ClientBuilder;

class HomeController extends Controller
{   

  public function index(){
       


      $response = $this->makeClient()->indices()->getMapping();     

     dd($response);

     }

    public function create()
    {

      $params = [];
      $params['body']=['first_name'=>'reza' , 'last_name'=>"reza"];
      $params['index']='mysite1';
      $params['type']='mysite1';
      $result = $this->makeClient()->index($params);
      dd($result);
    }



    public function update()
    {

        $params = [ 
           'index'=> 'mysite1',
            'id'=> "GkKf3YEBGeBaR183DuTZ",
            'body' =>[

                   'doc'=>[
                      'first_name'=>'AliReza'  

                     ]
            ]
        ]; 

        $response = $this->makeClient()->update($params);
    }


    public function serachOne(){

     $result = $this->makeClient()->search(['body'=>[
                                'query'=>[
                                'bool'=>[
                                'should'=>[
                                   'match'=>['last_name'=>'reza']
                                   // 'match'=>['last_name'=>'a'],
                                  ]
                                ]
                             ]
                        ]
                   ]);

     dd($result['hits']['hits']);

    }


    public function serachTow(){


      $params['index'] = '_all';
     $params['type']='mysite2';

     $params['body']['query']['match']['first_name']='amin';
     $result = $this->makeClient()->search($params);
     dd($result['hits']['hits']);

    }

    public function delete(){ 

        $params = [
            'index' => 'mysite1',
            'id'    => 'GUKd3YEBGeBaR183WeTy'
        ];

        // Delete doc at /my_index/_doc_/my_id
        $response = $this->makeClient()->delete($params); 

        dd($response);


    }


   private  function  makeClient()
   {
       return  ClientBuilder::create()->build(); 

   }
}
