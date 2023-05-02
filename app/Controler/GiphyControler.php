<?php
namespace App\Controller;

use App\Models\GiphyApi;
use App\View;
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
    public function trending():View
    {
       $gifs = $this->giphyApi->fetchTrending();
       return new View('trending', $gifs);
    }
    public function search():View
    {
        $gifs = $this->giphyApi->searchGifs();
        return new View('search', $gifs);
    }
}