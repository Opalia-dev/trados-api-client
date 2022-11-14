<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class TranslationMemoryImport{

    public function __construct(private Trados $client)
    {}

    public function poll(string $importId)
    {
        return $this->client->post('translation-memory/imports/'.$importId);
    }

    public function update(string $translationMemoryId,array $body)
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
        return $this->client->post('/translation-memory/'.$translationMemoryId.'/imports');
    }
}