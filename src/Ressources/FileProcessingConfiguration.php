<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class FileProcessingConfiguration{

    public function __construct(private Trados $client)
    {}

    public function list()
    {
        return $this->client->get('file-processing-configurations');
    }

    public function get(string $fileProcessingConfigurationId)
    {
        return $this->client->get('file-processing-configurations/'.$fileProcessingConfigurationId);
    }

    public function listFileTypeSettings()
    {
        return $this->client->get('file-processing-configurations/file-type-settings');
    }

    public function getFileTypeSettings(string $fileProcessingConfigurationId,string $fileTypeSettingId)
    {
        return $this->client->get('file-processing-configurations/'.$fileProcessingConfigurationId.'/file-type-settings/'.$fileTypeSettingId);
    }
}