<?php

namespace App\Models;
use Dotenv\Util\Str;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GiphyApi
{
public Client $client;
public function __construct()
{
    $this->client = new Client();
}

    /**
     * @throws GuzzleException
     */
    public function fetchTrending(): array
{
    $response = $this->client->get('api.giphy.com/v1/gifs/trending', [
        'query' => [
            'api_key' => $_ENV['API_KEY'],
            'limit' => 10,
            'offset' => floor(rand(0, 499))
        ]
    ]);
    $giphyData = json_decode($response->getBody()->getContents());
    return $this->giphy($giphyData->data);
}
PUBLIC FUNCTION searchGifs():array
{
    $response = $this->client->get('api.giphy.com/v1/gifs/search', [
        'query' => [
            'api_key' => $_ENV['API_KEY'],
            'Q' => $_GET['keyWord'],
            'limit' => $_GET['count'],
            'offset' => floor(rand(0, 499))
        ]
    ]);
    $giphyData = json_decode($response->getBody()->getContents());
    return $this->giphy($giphyData->data);
}
public function giphy(array $randomGifs): array
{
    $gifCollection = [];
    foreach ($randomGifs as $gif)
    {
     $gifCollection[]= new Giphy(
            $gif->title,
            $gif->images->fixed_width->url
        );
    }
    return $gifCollection;
}
}