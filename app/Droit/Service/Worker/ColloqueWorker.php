<?php namespace Droit\Service\Worker;

class ColloqueWorker{

    protected $custom;
    protected $client;

    /* Inject dependencies */
    public function __construct()
    {
        $this->custom  = new \Custom;
        $this->client  = new \GuzzleHttp\Client();
    }

    public function getColloques(){

        $response   = $this->client->get('http://www.publications-droit.ch/fileadmin/admin_unine/api/event');
        $data       = $response->json();
        $data       = $this->organise($data);
        $collection = new \Illuminate\Support\Collection($data);

        return $collection;
    }

    public function organise($data){

        if(!empty($data))
        {
            foreach($data as $colloque)
            {
                $centre = (count($colloque['organisateur']) > 1 ? 'both' : $colloque['organisateur'][0]);
                $organise[$centre][] = $colloque;
            }

            return $organise;
        }

        return [];
    }

}