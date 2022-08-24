<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Worker;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        if($request->search){
            return view('WorkerSearch',['elastic'=>$this->serach($request->search)]);
        }
        return view('WorkerSearch',['workers'=>Worker::all()]);
    }

    public function serach($search)
    {
        $client=$this->getClient();
        $params=[];
        $params['index']='_all';
        $params['body']['query']['match']['country']=$search;
        $data=$client->search($params);
        $response=json_decode($data, true);
        if ( $response['hits']['total']['value'] === 0 ) {

            $questRel=Worker::WhereRaw("country LIKE ? ", '%' . $search . '%')->get();
            $this->Indexing($questRel);
        }
         return $response['hits']['hits'];

    }

    public function Indexing($questRel)
    {
        $client=$this->getClient();
        $params=[];
        $params['index']="my_index";
        $params['id']=Str::random(30);
        foreach($questRel as $row){
            $params['body']=['name'=>$row->name, 'country'=>$row->ountry];
         }

        $data =   $client->index($params);
        $response=json_decode($data, true);
        return $response;

    }

    protected function getClient()
    {
        $client=ClientBuilder::create()
            ->setSSLVerification(false)
            ->setHosts(['http://localhost:9200/'])
            ->build();
        return $client;
    }

}
