<?php
namespace Opalia\TradosApiClient;

use Monolog\Logger;
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Opalia\TradosApiClient\Ressources\File;
use Opalia\TradosApiClient\Ressources\Group;
use Opalia\TradosApiClient\Ressources\Folder;
use Opalia\TradosApiClient\Ressources\Account;
use Opalia\TradosApiClient\Ressources\Project;
use Opalia\TradosApiClient\Ressources\Customer;
use Opalia\TradosApiClient\Ressources\Language;
use Opalia\TradosApiClient\Ressources\PublicKeys;
use Opalia\TradosApiClient\Ressources\CustomField;
use Opalia\TradosApiClient\Ressources\PricingModel;
use Opalia\TradosApiClient\Ressources\FileProcessingConfiguration;

class Trados{
    private string $tokenProviderEndpoint = "https://sdl-prod.eu.auth0.com/oauth/token";

    private string $token;
    private string $tokenType;

    private Client $client;

    private Account $account;
    private Customer $customer;
    private CustomField $customField;
    private File $file;
    private FileProcessingConfiguration $fileProcessingConfiguration;
    private Folder $folder;
    private Group $group;
    private Language $language;
    private PricingModel $pricingModel;
    private Project $project;
    private PublicKeys $publicKeys;

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

        return  $this->client->request($method, $uri, $opts)->getBody();
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

    /**
     * Get the value of account
     */ 
    public function getAccount():Account
    {
        return $this->account;
    }

    /**
     * Get the value of customer
     */ 
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Get the value of fileProcessingConfiguration
     */ 
    public function getFileProcessingConfiguration():FileProcessingConfiguration
    {
        return $this->fileProcessingConfiguration;
    }

    /**
     * Get the value of folder
     */ 
    public function getFolder():Folder
    {
        return $this->folder;
    }

    /**
     * Get the value of group
     */ 
    public function getGroup():Group
    {
        return $this->group;
    }

    /**
     * Get the value of language
     */ 
    public function getLanguage():Language
    {
        return $this->language;
    }

    /**
     * Get the value of pricingModel
     */ 
    public function getPricingModel():PricingModel
    {
        return $this->pricingModel;
    }

    /**
     * Get the value of publicKeys
     */ 
    public function getPublicKeys():PublicKeys
    {
        return $this->publicKeys;
    }

    /**
     * Get the value of file
     */ 
    public function getFile():File
    {
        return $this->file;
    }

    /**
     * Get the value of customField
     */ 
    public function getCustomField():CustomField
    {
        return $this->customField;
    }
}