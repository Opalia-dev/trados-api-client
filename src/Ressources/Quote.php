<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class Quote{

    public function __construct(private Trados $client)
    {}

    public function exportReport(string $projectId, ?string $format = null, ?string $languageId = null)
    {
        $params = [];
        if($format !==null){
            $params['query']['format'] = $format;
        }
        if($languageId!==null){
            $params['query']['languageId']=$languageId;
        }
        return $this->client->post('/projects/'.$projectId.'/quote-report/export',$params);
    }

    public function pollExportReport(string $projectId, ?string $format = null)
    {
        $params = [];
        if($format !==null){
            $params['query']['format'] = $format;
        }
        return $this->client->pget('/projects/'.$projectId.'/quote-report/export',$params);
    }

    public function downloadExportedReport(string $projectId, ?string $format = null)
    {
        $params = [];
        if($format !==null){
            $params['query']['format'] = $format;
        }
        return $this->client->pget('/projects/'.$projectId.'/quote-report/download',$params);
    }
}