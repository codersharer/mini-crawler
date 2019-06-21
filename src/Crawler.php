<?php

namespace Codersharer\MiniCrawler;

use Codersharer\MiniCrawler\Exceptions\HttpException;
use Codersharer\MiniCrawler\Exceptions\InvalidParamsException;
use GuzzleHttp\Client;

class Crawler
{
    protected $url;

    protected $client;

    public function __construct()
    {
    }

    /**
     * Description:.
     *
     * @return Client
     *
     * @author franklu@soarinfotech.com
     */
    public function setClient()
    {
        $this->client = new Client();
    }

    public function setUrl(string $url)
    {
        if (!$url) {
            throw new InvalidParamsException('Url is empty.');
        }

        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function run(): string
    {
        try {
            $response = $this->client->get($this->url);
            if ($response->getStatusCode() >= 400) {
                throw new HttpException();
            }
            $content = $response->getBody()->getContents();

            return $content;
        } catch (\Exception $e) {
            if ($e instanceof InvalidParamsException) {
                throw new InvalidParamsException($e->getMessage(), $e->getCode(), $e);
            } else {
                if ($e instanceof HttpException) {
                    throw new HttpException($e->getMessage(), $e->getCode(), $e);
                } else {
                    throw new \Exception($e->getMessage(), $e->getCode(), $e);
                }
            }
        }
    }
}
