<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class Customer{

    public function __construct(private Trados $client)
    {}

    public function get(string $customerId,string $fields = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        return $this->client->get('customers/'.$customerId,$params);
    }

    public function list(string $fields = null,array $location = null, string $locationStrategy = null,int $skip = null,string $sort = null, int $top = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        if($location!==null){
            $params['query']['location']=$location;
        }
        if($locationStrategy!==null){
            $params['query']['locationStrategy']=$locationStrategy;
        }
        if($skip!==null){
            $params['query']['skip']=$skip;
        }
        if($sort!==null){
            $params['query']['sort']=$sort;
        }
        if($top!==null){
            $params['query']['top']=$top;
        }
        return $this->client->get('customers',$params);
    }
}