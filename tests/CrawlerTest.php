<?php

namespace Codersharer\MiniCrawler\Tests;

use Codersharer\MiniCrawler\Crawler;
use Codersharer\MiniCrawler\Exceptions\InvalidParamsException;
use PHPUnit\Framework\TestCase;

class CrawlerTest extends TestCase
{
    public function testSetUrlInvalid()
    {
        $crawler = new Crawler();
        $this->expectException(InvalidParamsException::class);
        $crawler->setUrl('');
    }

    public function testSetUrl()
    {
        $crawler = new Crawler();
        $crawler->setUrl('https://www.baidu.com');
        $this->assertEquals('https://www.baidu.com', $crawler->getUrl());
        $this->assertNotEquals('www.baidu.com', $crawler->getUrl());
    }

    public function testRun()
    {
        $crawler = new Crawler();
        $crawler->setUrl('https://www.baidu.com');
        $crawler->setClient();
        $content = $crawler->run();
        $this->assertNotEmpty($content);
    }
}
