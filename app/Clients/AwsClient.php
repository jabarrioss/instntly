<?php

namespace App\Clients;
use Ellaisys\Cognito\AwsCognitoClient as BaseCognitoClient;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;

/**
 * Class that extends from the base client of the cognito sdk to be able to obtain a new access_token from the AWS service
 * 
 * Created date: 20/09/2021
 * Modified date: 20/09/2021
 *
 * Developed by: Jhonny B. Sandrea for Kleverpay
 */
class AwsClient extends BaseCognitoClient
{
    /**
     * This method returns a new access_token using
     * the refresh token provided through the API exposed to the client
     * @param  \string  $username
     * @param  \string  $refresh_token
     * 
     * @return \Aws\Result
     */
    
    public function getNewAccessTokenByRefreshToken($username, $refresh_token)
    {
        try {
            $response = $this->client->adminInitiateAuth([
                'AuthFlow' => 'REFRESH_TOKEN_AUTH',
                'AuthParameters' => [
                    'REFRESH_TOKEN' => $refresh_token,
                    // 'SECRET_HASH' => $this->cognitoSecretHash($username),
                ],
                'ClientId' => $this->clientId,
                'UserPoolId' => $this->poolId,
            ]);
        } catch (CognitoIdentityProviderException $exception) {
            throw $exception;
        }
        return $response;
    }
}
