<?php

namespace Markup\RabbitMq\ManagementApi;

use Guzzle\Http\Client as GuzzleHttpClient;
use Illuminate\Config\Repository;
/**
 * ManagementApi
 *
 * @author Richard Fullmer <richard.fullmer@opensoftdev.com>
 */
class Client
{
    /**
     * @var GuzzleHttpClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    const USERNAME_DEFAULT = 'guest';

    /**
     * @var string
     */
    const PASSWORD_DEFAULT = 'guest';

    /**
     * @var string
     */
    const BASEURL_DEFAULT = 'http://localhost:15672';

    /**
     * @param \Guzzle\Http\Client $client
     * @param string              $username
     * @param string              $password
     */
    public function __construct(Repository $config,
        $baseUrl = self::BASEURL_DEFAULT,
        $username = self::USERNAME_DEFAULT,
        $password = self::PASSWORD_DEFAULT
    ) {
        $environment = $config->get('rabbit-manager.use');
        $baseUrl = $config->get('rabbit-manager.properties.'. $environment . '.base_url',$baseUrl);
        $username = $config->get('rabbit-manager.properties.'. $environment . '.username',$username);
        $password = $config->get('rabbit-manager.properties.'. $environment . '.password',$password);

        $this->client = new GuzzleHttpClient();
        $this->client->setBaseUrl($baseUrl);

        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @param  string|array          $endpoint Resource URI.
     * @param  string                $method
     * @param  array                 $headers  HTTP headers
     * @param  string|resource|array $body     Entity body of request (POST/PUT) or response (GET)
     * @return array
     */
    public function send($endpoint, $method = 'GET', $headers = null, $body = null)
    {
        if (null !== $body) {
            $body = json_encode($body);
        }

        $request = $this->client->createRequest($method, $endpoint, $headers, $body)->setAuth($this->username, $this->password);

        if (in_array($method, ['PUT', 'POST', 'DELETE'])) {
            $request->setHeader('content-type', 'application/json');
        }

        $response = $request->send();

        return json_decode($response->getBody(), true);
    }
}
