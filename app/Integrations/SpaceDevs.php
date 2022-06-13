<?php

namespace App\Integrations;

use GuzzleHttp\Client;

class SpaceDevs
{

    private $baseUrl;
    private $client;

    public function __construct()
    {
        $provisorio = "https://ll.thespacedevs.com/2.0.0/launch";
        $this->baseUrl = $provisorio;
        $connection = [
            'base_uri' => $this->baseUrl,
            'exceptions' => false,
            'verify' => false,
            'allow_redirects' => true,
            'decode_content' => true,
            'headers' => [
            ]
        ];
        $this->client = new Client($connection);
    }


    public function teste($page)
    {
        $this->getData($page);
    }

    private function getData($page) 
    {
        try {
            //print_r("{$this->baseUrl}?offset={$page}");exit;
            $response = $this->client->request('GET', "{$this->baseUrl}?limit=100&offset={$page}");
            //$response = $this->client->request('GET', 'https://jsonplaceholder.typicode.com/todos');
            //$response = \json_encode($response);
            //return $response;
            //print_r($response->getStatusCode());exit;
            //print_r($response->getStatusCode());
            //print_r((string)$response->getBody()); echo "\n\n"; exit;

            if ($response->getStatusCode() == 200) {  
                print_r($page);
                $response = (string)$response->getBody();  
                return $response;
            }
        } catch (\Exception $e) {
            $logData = [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ];
             print_r(json_encode($logData));
             return ['error' => 1];
            // $log = new Integrations_Log_MainRepository();
            // $log->create($logData);
        }
    }

}