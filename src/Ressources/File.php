<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class File{

    public function __construct(private Trados $client)
    {}

    public function pollUploadZip(string $fileId)
    {
        return $this->client->get('files/'.$fileId);
    }

    public function uploadZip(string $file)
    {
        return $this->client->post('Files',['json'=>['file'=>$file]]);
    }
}