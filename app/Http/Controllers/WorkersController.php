<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dotenv\Dotenv;
use Elastic\Elasticsearch\ClientBuilder;

class WorkersController extends Controller
{
    /**
     * @return \Elastic\Elasticsearch\Client
     * @throws \Elastic\Elasticsearch\Exception\AuthenticationException
     */
    protected function getClient()
    {
        $client=ClientBuilder::create()
            ->setSSLVerification(false)
            ->setHosts(['http://localhost:9200/'])
            ->build();
        return $client;
    }

    /**
     * @throws \Elastic\Elasticsearch\Exception\AuthenticationException
     * @throws \Elastic\Elasticsearch\Exception\ClientResponseException
     * @throws \Elastic\Elasticsearch\Exception\ServerResponseException
     */
    public function version()
    {
        $client=$this->getClient();
        $response=$client->info();
        echo $response['version']['number']; // 8.0.0
    }

    public function lists()
    {
        $client=$this->getClient();
        $paraams=[
            'size'=>100,
            'index'=>'user2'
        ];
        $data=$client->search($paraams);
        dd($data->asArray());
    }


    ///done
    public function Indexing()
    {
        $client=$this->getClient();

        $params=[
            'index'=>'user',
            'id'=>'my_id4535',
            'body'=>['name'=>'مزکر ایران می باشد', 'country'=>" تهران", 'dob'=>"2000-12-10"],
        ];

        $response=$client->index($params);
        dd($response->asArray(), "T");
    }

    public function count()
    {
        $client=$this->getClient();

        $data=$client->count();
        dd($data->asArray());
    }


    public function serach()
    {
        $client=$this->getClient();
        $params=[];
        $params['index']='_all';
        $params['body']['query']['match']['country']='تهران';
        $data=$client->search($params);
        dd($data->asArray());
    }

    public function getId()
    {
        $client=$this->getClient();
        $params=[
            'index'=>'users',
        ];
        $data=$client->get($params);
        return $data->asArray();
    }

    ///done
    public function update()
    {
        $client=$this->getClient();

        $params=[
            'index'=>'user',
            'id'=>"my_id4535",
            'body'=>[
                "counter"=>1,
                "tags"=>["red"]
            ],

        ];
        $data=$client->update($params);
        dd($data->asArray());
    }

    //done
    public function delete()
    {
        $client=$this->getClient();

        $params=[
            'index'=>'user',
            'id'=>"my_id4535",
        ];
        $response=$client->delete($params);
        dd($response);
    }

    public function deleteByQuery()
    {
        $client=$this->getClient();

        $params=[
            'index'=>'user',
            'body'=>[
                'query'=>[
                    "term"=>[
                        "user.id"=>"Gljc4oIB8zeRTtL6MAeq"
                    ]
                ]
            ]

        ];
        $response=$client->deleteByQuery($params);
        dd($response);
    }

    /**
     * done
     * /// serach two method  or method _index is done  or  {name}.keyword
     **/
    public function sort($order)
    {
        $client=$this->getClient();
        $params=[
            'form'=>0,
            'size'=>5,
            'body'=>[
                'sort'=>[
                    ['name.keyword'=>['order'=>$order]],

                ]
            ]
        ];

        $response=$client->search($params);
        $result=$response->asArray()['hits']['hits'];
        dd($result);
    }


    /***** match1 * ***************************/
    public function match() ///serach fulll
    {
        $client=$this->getClient();
        $params=[
            'body'=>[
                'query'=>[
                    'match'=>[
                        'name'=>'Dawson Legros'
                    ]
                ]
            ]
        ];
        $response=$client->search($params);
        $result=$response->asArray()['hits']['hits'];
        dd($result);
    }

    public function multi_match() ///serach 1 filelds
    {
        $client=$this->getClient();
        $params=[
            'body'=>[
                'query'=>[
                    'multi_match'=>[
                        'query'=>"DVM",
                        'fields'=>["name"]
                    ]
                ]
            ]
        ];
        $response=$client->search($params);
        $result=$response->asArray()['hits']['hits'];
        dd($result);
    }


    public function boolent() ///serach 1 filelds  filter
    {
        $client=$this->getClient();
        $params=[
            'body'=>[
                'query'=>[
                    'bool'=>[
                        'filter'=>[
                            'range'=>[
                                'price'=>['gte'=>500],
                                'price'=>['lte'=>500]
                            ]

                        ]
                    ]
                ]
            ]
        ];
        $response=$client->search($params);
        $result=$response->asArray()['hits']['hits'];
        dd($result);
    }

    public function boolent_must() ///serach 1  must => and
    {
        $client=$this->getClient();
        $params=[
            'body'=>[
                'query'=>[
                    'bool'=>[
                        'must'=>[
                            'match'=>[
                                'fist_name'=>'amin'
                            ]
                        ],
                        'filter'=>[
                            'range'=>[
                                'price'=>['gte'=>300]
                            ]

                        ]
                    ]
                ]
            ]
        ];
        $response=$client->search($params);
        $result=$response->asArray()['hits']['hits'];
        dd($result);
    }

    // Parameters  gt < gte <=   lt <  lte <=
    public function boolent_must_not() ///serach 1  must => not
    {
        $client=$this->getClient();
        $params=[
            'size'=>100,
            'body'=>[
                'query'=>[
                    'bool'=>[
                        'must'=>[
                            'match'=>[
                                'price'=>500
                            ]
                        ],
                        'must_not'=>[
                            'match'=>[
                                'fist_name'=>'amin'
                            ]
                        ],
                        'filter'=>[
                            'range'=>[
                                'price'=>['gte'=>300]
                            ]

                        ]
                    ]
                ]
            ]
        ];
        $response=$client->search($params);
        $result=$response->asArray()['hits']['hits'];
        dd($result);
    }

    public function boolent_should() ///serach 1  must => or
    {
        $client=$this->getClient();
        $params=[
            'size'=>100,
            'body'=>[
                'query'=>[
                    'bool'=>[
                        'should'=>[
                            'match'=>[
                                'fist_name'=>'amin'
                            ],
                            'match'=>[
                                'name'=>'Pouros'
                            ]
                        ],
                    ]
                ]
            ]

        ];
        $response=$client->search($params);
        $result=$response->asArray()['hits']['hits'];
        dd($result);
    }

    public function query()
    {
        $client=$this->getClient();
        $params=[
            'size'=>100,
            'body'=>array(
                'query'=>'select * from user'
            )

        ];
        $response=$client->sql()->query($params);
        $result=$response->asArray();
        dd($result);
    }

    public function mapping()
    {
        $client=$this->getClient();
        $params=[
            'index'=>'users',
            'id'=>'my_i63d4535',
            'body'=>[

                'mappings'=>[
                    'properties'=>[
                        'dob'=>[
                            'type'=>"date"
                        ]
                    ]
                ]
            ]

        ];
        $response=$client->create($params);
        $result=$response->asArray();

        dd($result);
    }

    public function bulk()
    {
        $client=$this->getClient();

        for($i=0; $i < 100; $i++) {
            $params['body'][]=[
                'index'=>[
                    '_index'=>'my_index',
                ]
            ];

            $params['body'][]=[
                'my_field'=>'my_value',
                'second_field'=>'some more values'
            ];
        }

        $response=$client->bulk($params);
        $result=$response->asArray();

    }

    public function queryString()
    {
        $client=$this->getClient();
        $params=[
            'size'=>100,
            'body'=>[
                'query'=>[
                    'query_string'=>[
                        'query'=>"DVM",
                        'fields'=>["name"]
                    ]

                ]
            ]

        ];
        $response=$client->search($params);
        $result=$response->asArray()['hits']['hits'];
        dd($result);
    }

    public function mget()
    {
        $client=$this->getClient();
        $params=[
            'size'=>100,
            'body'=>[
                'docs'=>[
                    [
                        "_index"=>"my_index",
                        "_id"=>"LFjc4oIB8zeRTtL6MAeq"
                    ]
                ]
            ]

        ];
        $response=$client->mget($params);
        $result=$response->asArray();
        dd($result);
    }

    public function update_by_query()
    {
        $client=$this->getClient();
        $params=[
            'index'=>'user',
            'body'=>[
                'query'=>[
                    'match'=>[
                        "_id"=>"my_id452"
                    ]
                ],
                "script"=>[
                    "inline"=>'ctx._source.name= params.name',
                    "params"=>[
                        "name"=>4
                    ]
                ]

            ]
        ];
        $response=$client->updateByQuery($params);
        $result=$response->asArray();
        dd($result);
    }

    public function asyncSearch()
    {
        $client=$this->getClient();
        $params=[
            'index'=>'user',
            'body'=>[
               "query"=>[
                   "aggs"=>[
                       "name"=>[
                           "terms"=>[
                               "field"=>"name",
                               "size"=>10
                           ]
                       ]
                   ]
               ]

            ]
        ];
        $response=$client->asyncSearch($params);
        $result=$response->asArray();
        dd($result);
    }
    ///Copies documents from a source to a destination.
        public function reindex()
    {
        $client=$this->getClient();
        $params=[
            'index'=>'user',
            'body'=>[

                  "source"=>[
                      "index"=>'user2'
                  ],
                  'dest'=>[
                      'index'=>'user3'
                  ]

            ]
        ];
        $response=$client->reindex($params);
        $result=$response->asArray();
        dd($result);
    }

}
