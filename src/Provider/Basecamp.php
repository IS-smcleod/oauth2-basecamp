<?php

namespace League\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class Basecamp extends AbstractProvider {
	use BearerAuthorizationTrait;
	
	/**
	 * {@inheritDoc}
	 * @see \League\OAuth2\Client\Provider\AbstractProvider::ACCESS_TOKEN_RESOURCE_OWNER_ID
	 */
	const ACCESS_TOKEN_RESOURCE_OWNER_ID = 'id';
	
	public $domain = 'launchpad.37signals.com';
	
	public function getBaseAuthorizationUrl() {
		return 'https://' . $this->domain . '/authorization/new';
	}
	public function getBaseAccessTokenUrl(array $params) {
		return 'https://' . $this->domain . '/authorization/token';
	}
	public function getResourceOwnerDetailsUrl(AccessToken $token) {
		return 'https://' . $this->domain . '/authorization.json';
	}
	
	protected function getDefaultScopes() {
		return [ ];
	}
	protected function checkResponse(ResponseInterface $response, $data) {
		if (! empty ( $data ['error'] )) {
			$code = 0;
			$error = $data ['error'];
			
			if (is_array ( $error )) {
				$code = $error ['code'];
				$error = $error ['message'];
			}
			
			throw new IdentityProviderException ( $error, $code, $data );
		}
	}
	protected function createResourceOwner(array $response, AccessToken $token) {
	  return new BasecampAuthorization($response);
	}
	
	protected function getAuthorizationParameters(array $options) {
	  $parameters = parent::getAuthorizationParameters($options);
	  if (isset($options["type"])) { $parameters["type"] = $options["type"]; }
	  return $parameters;
	}
}
