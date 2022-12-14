<?php
namespace Opalia\TradosApiClient;

use Monolog\Logger;
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Opalia\TradosApiClient\Ressources\File;
use Opalia\TradosApiClient\Ressources\Task;
use Opalia\TradosApiClient\Ressources\User;
use Opalia\TradosApiClient\Ressources\Group;
use Opalia\TradosApiClient\Ressources\Quote;
use Opalia\TradosApiClient\Ressources\Folder;
use Opalia\TradosApiClient\Ressources\Account;
use Opalia\TradosApiClient\Ressources\Project;
use Opalia\TradosApiClient\Ressources\Customer;
use Opalia\TradosApiClient\Ressources\Language;
use Opalia\TradosApiClient\Ressources\TaskType;
use Opalia\TradosApiClient\Ressources\Workflow;
use Opalia\TradosApiClient\Ressources\PublicKeys;
use Opalia\TradosApiClient\Ressources\SourceFile;
use Opalia\TradosApiClient\Ressources\TargetFile;
use Opalia\TradosApiClient\Ressources\TQAProfile;
use Opalia\TradosApiClient\Ressources\CustomField;
use Opalia\TradosApiClient\Ressources\PricingModel;
use Opalia\TradosApiClient\Ressources\ProjectTemplate;
use Opalia\TradosApiClient\Ressources\TranslationEngine;
use Opalia\TradosApiClient\Ressources\TranslationMemoryImport;
use Opalia\TradosApiClient\Ressources\FileProcessingConfiguration;

class Trados{
    private ?string $token = null;
    private ?string $tokenType = null;

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
    private ProjectTemplate $projectTemplate;
    private PublicKeys $publicKeys;
    private Quote $quote;
    private SourceFile $sourceFile;
    private TargetFile $targetFile;
    private Task $task;
    private TaskType $taskType;
    private TQAProfile $tqaProfile;
    private TranslationEngine $translationEngine;
    private TranslationMemoryImport $translationMemoryImport;
    private User $user;
    private Workflow $workflow;

    private Logger $logger;

    public function __construct(
        private string $clientId,
        private string $clientSecret,
        private string $accountId,
        private string $apiEndpoint = "https://lc-api.sdl.com/public-api/v1/",
        private string $tokenProviderEndpoint = "https://sdl-prod.eu.auth0.com/oauth/token"
    ){
        if (!function_exists('curl_init') || !function_exists('curl_setopt')) {
            throw new \Exception("cURL support is required, but can't be found.");
        }
        $this->logger = new Logger('[Trados]');
        //$this->logger->pushHandler(new StreamHandler('/log/trados.log', Logger::WARNING));

        $this->client = new Client();

        $this->getTokenFromProvider();

        $this->client = new Client([
            'base_uri' => $this->apiEndpoint,
            'headers'=> [
            'Authorization' => $this->tokenType.' '.$this->token,
            'X-LC-Tenant' => $this->accountId,
            'Content-Type' => 'application/json'
        ]]);

        $this->initRessources();
    }

    public function __call(string $method, array $args):mixed
    {
        if (\count($args) < 1) {
            throw new \InvalidArgumentException('Magic request methods require a URI and optional options array');
        }

        $uri = $args[0];
        $opts = $args[1] ?? [];

        return  json_decode($this->client->request($method, $uri, $opts)->getBody());
    }

    private function getTokenFromProvider(){
        $response = $this->client->post($this->tokenProviderEndpoint,[
            'headers' => [
                'Accept'     => 'application/json'
            ],
            'json' => [
                "client_id" => $this->clientId,
                "client_secret" => $this->clientSecret,
                "grant_type" => "client_credentials",
                "audience" =>"https://api.sdl.com"
            ]
        ]);

        $data = json_decode($response->getBody());
        $this->token = $data->access_token;
        $this->tokenType = $data->token_type;
    }

    private function initRessources(){
        $this->account = new Account($this);
        $this->customer = new Customer($this);
        $this->customField = new CustomField($this);
        $this->file = new File($this);
        $this->fileProcessingConfiguration = new FileProcessingConfiguration($this);
        $this->folder = new Folder($this);
        $this->group = new Group($this);
        $this->language = new Language($this);
        $this->pricingModel = new PricingModel($this);
        $this->project = new Project($this);
        $this->projectTemplate = new ProjectTemplate($this);
        $this->publicKeys = new PublicKeys($this);
        $this->quote = new Quote($this);
        $this->sourceFile = new SourceFile($this);
        $this->targetFile = new TargetFile($this);
        $this->task = new Task($this);
        $this->taskType = new TaskType($this);
        $this->tqaProfile= new TQAProfile($this);
        $this->translationEngine = new TranslationEngine($this);
        $this->translationMemoryImport = new TranslationMemoryImport($this);
        $this->user = new User($this);
        $this->workflow = new Workflow($this);
    }

    /**
     * Get clientId
     */ 
    public function getClientId():string
    {
        return $this->clientId;
    }

    /**
     * Get clientSecret
     */ 
    public function getClientSecret():string
    {
        return $this->clientSecret;
    }

    /**
     * Get apiEndpoint
     */ 
    public function getApiEndpoint():string
    {
        return $this->apiEndpoint;
    }

    /**
     * Get accountId ressource
     */ 
    public function getAccountId():string
    {
        return $this->accountId;
    }

    /**
     * Get tokenProviderEndpoint
     */ 
    public function getTokenProviderEndpoint():string
    {
        return $this->tokenProviderEndpoint;
    }

    /**
     * Get token
     */ 
    public function getToken():string
    {
        return $this->token;
    }

    /**
     * Get project ressource
     */ 
    public function getProject():Project
    {
        return $this->project;
    }

    /**
     * Get account ressource
     */ 
    public function getAccount():Account
    {
        return $this->account;
    }

    /**
     * Get customer ressource
     */ 
    public function getCustomer():Customer
    {
        return $this->customer;
    }

    /**
     * Get fileProcessingConfiguration ressource
     */ 
    public function getFileProcessingConfiguration():FileProcessingConfiguration
    {
        return $this->fileProcessingConfiguration;
    }

    /**
     * Get folder ressource
     */ 
    public function getFolder():Folder
    {
        return $this->folder;
    }

    /**
     * Get group ressource
     */ 
    public function getGroup():Group
    {
        return $this->group;
    }

    /**
     * Get language ressource
     */ 
    public function getLanguage():Language
    {
        return $this->language;
    }

    /**
     * Get pricingModel ressource
     */ 
    public function getPricingModel():PricingModel
    {
        return $this->pricingModel;
    }

    /**
     * Get publicKeys ressource
     */ 
    public function getPublicKeys():PublicKeys
    {
        return $this->publicKeys;
    }

    /**
     * Get file ressource
     */ 
    public function getFile():File
    {
        return $this->file;
    }

    /**
     * Get customField ressource
     */ 
    public function getCustomField():CustomField
    {
        return $this->customField;
    }

    /**
     * Get projectTemplate resource
     */ 
    public function getProjectTemplate():ProjectTemplate
    {
        return $this->projectTemplate;
    }

    /**
     * Get sourceFile resource
     */ 
    public function getSourceFile():SourceFile
    {
        return $this->sourceFile;
    }

    /**
     * Get Workflow resource
     */ 
    public function getWorkflow():Workflow
    {
        return $this->workflow;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get the value of translationMemoryImport
     */ 
    public function getTranslationMemoryImport()
    {
        return $this->translationMemoryImport;
    }

    /**
     * Get the value of targetFile
     */ 
    public function getTargetFile()
    {
        return $this->targetFile;
    }

    /**
     * Get the value of task
     */ 
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Get the value of taskType
     */ 
    public function getTaskType()
    {
        return $this->taskType;
    }

    /**
     * Get the value of tqaProfile
     */ 
    public function getTqaProfile()
    {
        return $this->tqaProfile;
    }

    /**
     * Get the value of translationEngine
     */ 
    public function getTranslationEngine()
    {
        return $this->translationEngine;
    }

    /**
     * Get the value of quote
     */ 
    public function getQuote()
    {
        return $this->quote;
    }
}