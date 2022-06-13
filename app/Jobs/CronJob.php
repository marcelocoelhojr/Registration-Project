<?php

namespace App\Jobs;

use App\Integrations\SpaceDevs;
use App\Models\MongoDb;
use MongoDB\Client;

class CronJob 
{
    private $spaceDev;

    public function __construct()
    {
        $this->spaceDev = new SpaceDevs();
    }

    public function teste()
    {
        // $mongo = new MongoDb();
        // $mongo->name = 'marcelo';
        // $mongo->idade = 22;

        // $mongo->save();
        //$mongoTable = 'mongodb_space_devs';
        // $model = \DB::connection('mongodb')->collection('mongodb_space_devs');
        // $model->nome = 'ana';
        // $model::save();
        //print_r($model::all());
        print_r('teste');
        $client = new Client("mongodb://172.20.0.3:27017");
        print_r($client);
        $collection = $client->demo->beers;
        $result = $collection->insertOne(['name' => 'Hinterland', 'brewery' => 'BrewDog']);
        print_r('-teste1');
        //$model::insert(['id' => 1, 'title' => 'The Fault in Our Stars']);
        //print_r(json_encode($mongo::all()));
    }

    // public function teste($page = 0)
    // {
    //     if ($page > 1900) {
    //         exit;
    //     }
        
    //     $page = $page + 100;
    //     $aux = $this->spaceDev->teste($page);
    //     if (isset($aux['error'])) {
    //         sleep(2093);
    //     } else {
    //         //salvar no mongo
    //     }
        
    //     $this->teste($page);
       
    // }

    //criar comando personalizado https://hackthestuff.com/article/how-to-set-cron-job-in-laravel-8-using-scheduler

}