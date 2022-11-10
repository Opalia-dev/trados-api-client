<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class SourceFile{

    public function __construct(private Trados $client)
    {}

    public function add(string $projectId,array $body)
    {
        $params['header']  = [
            'Content-Type' => 'multipart/form-data'
        ];
        $params['multipart'] = [];
        foreach ($body as $key => $value){
            $params['multipart'][] = [
                'name'     => $key,
                'contents' => $value
            ];
        }
        return $this->client->post('projects/'.$projectId.'/source-files',$params);
    }

    public function list(string $projectId,string $fields = null,int $skip = null,string $sort = null, int $top = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
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
        return $this->client->get('projects/'.$projectId.'/source-files',$params);
    }
}