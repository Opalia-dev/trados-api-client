<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class PricingModel{

    public function __construct(private Trados $client)
    {}

    public function get(string $pricingModelId)
    {
        return $this->client->get('pricing-models/'.$pricingModelId);
    }

    public function list()
    {
        return $this->client->get('pricing-models');
    }
}