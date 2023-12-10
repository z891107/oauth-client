<?php

namespace App\Providers;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\User;

class SocialiteOauthProvider extends AbstractProvider
{

    /**
     * @return string
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase($this->getCognitoUrl() . '/authorize', $state);
    }

    /**
     * @return string
     */
    protected function getTokenUrl()
    {
        return $this->getCognitoUrl() . '/token';
    }

    /**
     * @param string $token
     *
     * @throws GuzzleException
     *
     * @return array|mixed
     */
    protected function getUserByToken($token)
    {
        // $response = $this->getHttpClient()->post($this->getCognitoUrl() . '/userInfo', [
        //     'headers' => [
        //         'cache-control' => 'no-cache',
        //         'Authorization' => 'Bearer ' . $token,
        //         'Content-Type' => 'application/x-www-form-urlencoded',
        //     ],
        // ]);

        // return json_decode($response->getBody()->getContents(), true);
        return [
            'name' => 'testUser'
        ];
    }

    /**
     * @return User
     */
    protected function mapUserToObject(array $user)
    {
        // return (new User())->setRaw($user)->map([
        //     'id' => $user['sub'],
        //     'email' => $user['email'],
        //     'username' => $user['username'],
        //     'email_verified' => $user['email_verified'],
        //     'family_name' => $user['family_name'],
        // ]);
        return (new User())->setRaw($user)->map([
            'username' => $user['name'],
        ]);
    }

    /**
     * @return string
     */
    private function getCognitoUrl()
    {
        return config('services.oauth.base_uri') . '/oauth';
    }
}
