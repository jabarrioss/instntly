<?php

namespace App\Clients;
use Ellaisys\Cognito\AwsCognitoClient as BaseCognitoClient;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;

class AwsClient extends BaseCognitoClient
{
    public function getNewAccessTokenByRefreshToken($username, $refresh_token)
    {
        try {
            $response = $this->client->adminInitiateAuth([
                'AuthFlow' => 'REFRESH_TOKEN_AUTH',
                'AuthParameters' => [
                    'REFRESH_TOKEN' => $refresh_token,
                    'SECRET_HASH' => $this->cognitoSecretHash($username),
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
