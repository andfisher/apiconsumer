<?php

namespace Services;

final class RewardGateway implements WebServiceInterface
{
    /**
     * @var array
     */
    private $_config;

    public function __construct(array $config)
    {
        $this->_config = $config;
    }

    /**
     * @return stdClass
     * @throws Mocky\Exception
     */
    public function fetch()
    {
        $user = $this->_config['user'];
        $pass = $this->_config['pass'];

        $curl = curl_init($this->_config['endpoint'] . $this->_config['resource']);

        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "$user:$pass");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            curl_close($curl);
            throw new RewardGateway\Exception(curl_error($curl));
        }

        curl_close($curl);
        return json_decode($response);
    }
}
