<?php

namespace Markup\RabbitMq\ManagementApi;

use GuzzleHttp\Client as GuzzleHttpClient;
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
    const USERNAME_DEFAULT = 'guest';

    /**
     * @var string
     */
    const PASSWORD_DEFAULT = 'guest';

    /**
     * @var string
     */
    const BASEURL_DEFAULT = 'http://localhost:15672';

    protected $baseUrl = '';

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
        $this->baseUrl = $config->get('rabbit-manager.properties.'. $environment . '.base_url',$baseUrl);
        $username = $config->get('rabbit-manager.properties.'. $environment . '.username',$username);
        $password = $config->get('rabbit-manager.properties.'. $environment . '.password',$password);

        $this->client = new GuzzleHttpClient([
            'headers' => [
                'Authorization' => 'Basic '.base64_encode($username.':'.$password),
                'Accept' => 'application/json',
            ]
        ]);
    }

    /**
     * @param  string|array          $endpoint Resource URI.
     * @param  string                $method
     * @param  array                 $headers  HTTP headers
     * @param  string|resource|array $body     Entity body of request (POST/PUT) or response (GET)
     * @return array
     */
    public function send($endpoint, $method = 'GET', $headers = [], $body = null)
    {
        if (null !== $body) {
            $body = json_encode($body);
        }

        $response = $this->client->$method($this->baseUrl.$endpoint);
        return json_decode($response->getBody(), true);
    }
}