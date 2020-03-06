<?php


namespace App\Repositories;

use App\Enums\SystemSettingsEnum;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class NewsRepository
{

    /**
     * @var GuzzleHttpClient
     */
    private $client;

    public function __construct(GuzzleHttpClient $client)
    {
        $this->client = $client;
    }



    /**
     * @param $source
     * @return mixed
     * to get news from news api
     */
    public function getNews($source)
    {
        try {
            //with the code below, we can get news from multiple sources
            $apiRequest    = $this->client->request('GET', SystemSettingsEnum::NEWS_API_URL.'/articles?source='.$source.'&sortBy=top&apiKey='.SystemSettingsEnum::NEWS_API_KEY);
            $content       = json_decode($apiRequest->getBody()->getContents(), true);
            return $content['articles'];
        } catch (RequestException $e) {
            //For handling exception
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }
    }

    /**
     * @return mixed
     * to get all sources that we can use from newsapi
     */
    public function getAllSources()
    {

        try {

            $apiRequest       = $this->client->request('GET', SystemSettingsEnum::NEWS_API_URL.'/sources?language=en' );
            $content          = json_decode($apiRequest->getBody()->getContents(), true);
            return $content['sources'];
        } catch (RequestException $e) {
            //For handling exception
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }
    }
}
