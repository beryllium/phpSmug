<?php
namespace phpSmug\Tests;

use phpSmug\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldNotHaveToPassHttpClientToConstructor()
    {
        $client = new Client("I-am-not-a-valid-APIKey-but-it-does-not-matter-for-this-test");

        $this->assertInstanceOf('GuzzleHttp\Client', $client->getHttpClient());
    }

    /**
     * @test
     */
    public function shouldThrowExceptionIfNoApikey()
    {
        $client = new Client();
    }

    /**
     * @test
     */
    public function shouldHaveOptionsSetInInstance()
    {
        $APIKey = 'I-am-not-a-valid-APIKey-but-it-does-not-matter-for-this-test';
        $options = [
            'AppName'   => 'Testing phpSmug',
            'verbosity' => 1,
            'shorturis' => true,
            ];
        $client = new Client($APIKey, $options);

        $this->assertEquals($client->APIKey, $APIKey);
        $this->assertEquals($client->AppName, $options['AppName']);
        $this->assertEquals($client->verbosity, $options['verbosity']);
        $this->assertEquals($client->shorturis, $options['shorturis']);
        $this->assertEquals($client->getRequestOptions()['headers']['User-Agent'], sprintf("Testing phpSmug using phpSmug/%s", $client::VERSION));
    }

}
