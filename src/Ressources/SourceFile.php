<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class SourceFile{

    public function __construct(private Trados $client)
    {}

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

    public function update(string $projectId,string $sourceFileId,string $fields = null)
    {

        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        return $this->client->get('projects/'.$projectId.'/source-files/'.$sourceFileId.'/versions',$params);
    }

    public function listVersions(string $projectId,string $sourceFileId,string $fields = null)
    {

        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        return $this->client->get('projects/'.$projectId.'/source-files/'.$sourceFileId.'/versions',$params);
    }

    public function addVersion(string $taskId,string $sourceFileId,array $body,string $fields = null)
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
        $params['query'] = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        return $this->client->post('tasks/'.$taskId.'/source-files/'.$sourceFileId.'/versions/',$params);
    }

    public function downloadVersion(string $projectId,string $sourceFileId,string $fileVersionId)
    {
        return $this->client->get('projects/'.$projectId.'/source-files/'.$sourceFileId.'/versions/'.$fileVersionId.'/download');
    }

    public function getProperties(string $taskId,string $sourceFileId)
    {
        return $this->client->get('tasks/'.$taskId.'/source-files/'.$sourceFileId);
    }

    public function updateProperties(string $taskId,string $sourceFileId,array $body)
    {
        return $this->client->put('tasks/'.$taskId.'/source-files/'.$sourceFileId,['json'=>$body]);
    }
}