<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class FileProcessingConfiguration{

    public function __construct(private Trados $client)
    {}

    public function list()
    {
        return $this->client->get('/file-processiong-configurations');
    }

    public function get(string $fileProcessingConfigurationId)
    {
        return $this->client->get('/file-processiong-configurations/'.$fileProcessingConfigurationId);
    }

    public function listFileTypeSettings()
    {
        return $this->client->get('/file-processiong-configurations/file-type-settings');
    }

    public function getFileTypeSettings(string $fileProcessingConfigurationId,string $fileTypeSettingId)
    {
        return $this->client->get('/file-processiong-configurations/'.$fileProcessingConfigurationId.'/file-type-settings/'.$fileTypeSettingId);
    }
}