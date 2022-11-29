<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class TargetFile{

    public function __construct(private Trados $client)
    {}

    public function list(string $projectId,string $fields = null,int $skip = null,array $sourceFileIds = null,array $targetFileIds = null, int $top = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        if($skip!==null){
            $params['query']['skip']=$skip;
        }
        if($sourceFileIds!==null){
            $params['query']['sourceFileIds']=$sourceFileIds;
        }
        if($targetFileIds!==null){
            $params['query']['targetFileIds']=$targetFileIds;
        }
        if($top!==null){
            $params['query']['top']=$top;
        }
        return $this->client->get('projects/'.$projectId.'/target-files',$params);
    }

    public function get(string $projectId,string $targetFileId)
    {
        return $this->client->get('projects/'.$projectId.'/target-files/'.$targetFileId);
    }

    public function getVersion(string $projectId,string $targetFileId,string $fileVersionId)
    {
        return $this->client->get('projects/'.$projectId.'/target-files/'.$targetFileId.'/versions/'.$fileVersionId);
    }

    public function listVersions(string $projectId,string $targetFileId,string $fields = null)
    {

        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        return $this->client->get('projects/'.$projectId.'/target-files/'.$targetFileId.'/versions',$params);
    }

    public function downloadVersion(string $projectId,string $targetFileId,string $fileVersionId)
    {
        $tmpFile = \tempnam(\sys_get_temp_dir(), $targetFileId);
        $params = ['sink'=>$tmpFile];
        $this->client->get('projects/'.$projectId.'/target-files/'.$targetFileId.'/versions/'.$fileVersionId.'/download',$params);
        return $tmpFile;
    }
}