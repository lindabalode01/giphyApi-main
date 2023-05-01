<?php
namespace App\Controller;

use App\Model\GiphyApi;
use GuzzleHttp\Exception\GuzzleException;

class GiphyControler
{
    private GiphyApi $giphyApi;
    public function __construct()
    {
        $this->giphyApi = new GiphyApi();
    }

    /**
     * @throws GuzzleException
     */
    public function trendingGiphy():array
    {
        return $this->giphyApi->fetchTrending();
    }
    public function searchedGiphys():array
    {
        return $this->giphyApi->searchGifs();
    }
}