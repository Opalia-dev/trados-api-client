<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class LanguageProcessing{

    public function __construct(private Trados $client)
    {}

    public function getRules(string $languageProcessingRuleId,string $fields = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        return $this->client->get('languageProcessingRules/'.$languageProcessingRuleId,$params);
    }

    public function listRules()
    {
        return $this->client->get('languageProcessingRules');
    }
}