<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class PricingModel{

    public function __construct(private Trados $client)
    {}

    public function get(string $pricingModelId,string $fields = null)
    {
        $params = [];
        if($fields !==null){
            $params['query']['fields'] = $fields;
        }
        return $this->client->get('pricing-models/'.$pricingModelId,$params);
    }

    public function list()
    {
        return $this->client->get('pricing-models');
    }
}