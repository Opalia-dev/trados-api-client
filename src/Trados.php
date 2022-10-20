<?php
namespace Opalia\TradosApiClient;

use Monolog\Logger;
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Opalia\TradosApiClient\Ressources\Project;

class Trados{
    private string $tokenProviderEndpoint = "https://sdl-prod.eu.auth0.com/oauth/token";

    private string $token;
    private string $tokenType;

    private Client $client;

    private Project $project;

    private Logger $logger;

    public function __construct(
        private string $apiKey,
        private string $accountId,
        private string $apiEndpoint = "https://lc-api.sdl.com/public-api/v1/"
    ){
        if (!function_exists('curl_init') || !function_exists('curl_setopt')) {
            throw new \Exception("cURL support is required, but can't be found.");
        }
        $this->logger = new Logger('[Trados]');
        //$this->logger->pushHandler(new StreamHandler('/log/trados.log', Logger::WARNING));

        $this->client = new Client([
            'base_uri' => $this->apiEndpoint
        ]);

        $this->getTokenFromProvider();

        $this->client->setDefaultOption('headers',[
            'Authorization' => $this->tokenType.' '.$this->token,
            'X-LC-Tenant' => $accountId,
            'Content-Type' => 'application/json'
        ]);

        $this->initRessources();
    }

    public function __call($method, $args)
    {
        if (\count($args) < 1) {
            throw new \InvalidArgumentException('Magic request methods require a URI and optional options array');
        }

        $uri = $args[0];
        $opts = $args[1] ?? [];

        return  $this->client->request($method, $uri, $opts);
    }

    private function getTokenFromProvider(){
        $response = $this->client->post($this->tokenProviderEndpoint,[
            'headers' => [
                'Accept'     => 'application/json'
            ],
            'json' => [
                "client_id" => $this->clientId,
                "client_secret" => $this->apiKey,
                "grant_type" => "client_credentials",
                "audience" =>"https://api.sdl.com"
            ]
        ]);

        $data = json_decode($response->getBody());
        $this->token = $data->access_token;
        $this->tokenType = $data->token_type;
    }

    private function initRessources(){
        $this->project = new Project($this);
    }

    /**
     * Get the value of apiKey
     */ 
    public function getApikey()
    {
        return $this->apiKey;
    }

    /**
     * Get the value of apiEndpoint
     */ 
    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }

    /**
     * Get the value of accountId
     */ 
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Get the value of tokenProviderEndpoint
     */ 
    public function getTokenProviderEndpoint()
    {
        return $this->tokenProviderEndpoint;
    }

    /**
     * Get the value of token
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Get the value of project
     */ 
    public function getProject()
    {
        return $this->project;
    }
}