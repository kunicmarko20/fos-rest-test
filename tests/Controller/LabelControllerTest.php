<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Marko Kunic <kunicmarko20@gmail.com>
 */
class LabelControllerTest extends WebTestCase
{
    public function testPostFail()
    {
        $client = static::createClient();

        $client
            ->request(
                Request::METHOD_POST,
                '/labels',
                ['name' => 'fake'],
                [],
                [
                    'CONTENT_TYPE' => 'application/json'
                ]
            );

        $response = $client->getResponse();

        $data = $this->extractData($response);
        $this->assertSame(400, $response->getStatusCode());
        $this->assertSame('This value should not be null.', $data['errors']['children']['value']['errors'][0]);
    }

    private function extractData(Response $response): array
    {
        return json_decode($response->getContent(), true);
    }

    public function testPostSuccess()
    {
        $client = static::createClient();

        $client
            ->request(
                Request::METHOD_POST,
                '/labels',
                [
                    'name' => $name = 'fake',
                    'value' => $value = 'alsoFake'
                ],
                [],
                [
                    'CONTENT_TYPE' => 'application/json'
                ]
            );

        $response = $client->getResponse();

        $data = $this->extractData($response);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame($name, $data['name']);
        $this->assertSame($value, $data['value']);
    }
}
