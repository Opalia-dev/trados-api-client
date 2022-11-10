<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class Workflow{

    public function __construct(private Trados $client)
    {}

    public function get(string $workflowId,string $fields = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        return $this->client->get('workflows/'.$workflowId,$params);
    }
}