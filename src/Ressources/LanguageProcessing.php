<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class LanguageProcessing{

    public function __construct(private Trados $client)
    {}

    public function getRules(string $languageProcessingRuleId)
    {
        return $this->client->get('languageProcessingRules/'.$languageProcessingRuleId);
    }

    public function listRules()
    {
        return $this->client->get('languageProcessingRules');
    }
}