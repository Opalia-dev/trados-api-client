<?php

namespace Opalia\TradosApiClient\Ressources;

use Opalia\TradosApiClient\Trados;

Class Project{

    public function __construct(private Trados $client)
    {}

    public function list()
    {
        return $this->client->get('/projects');
    }

    public function get(int $projectId, string $fields = null)
    {
        if($fields !==null){
            return $this->client->get('/projects/'.$projectId,[
                'query' => [
                    'fields' => $fields
                ]
            ]);
        }
        return $this->client->get('/projects/'.$projectId);
    }

    public function delete(int $projectId)
    {
        return $this->client->delete('/projects/'.$projectId);
    }

    public function start(int $projectId)
    {
        return $this->client->put('/projects/'.$projectId.'/start');
    }

    public function complete(int $projectId)
    {
        return $this->client->put('/projects/'.$projectId.'/complete');
    }

    public function cancelFile(int $projectId,int $fileId)
    {
        return $this->client->put('/projects/'.$projectId.'/files/'.$fileId.'/cancel');
    }

    // public function create(ProjectModel $projectModel,string $fields = null)
    // {

    // }
}