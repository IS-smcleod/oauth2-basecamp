<?php

namespace League\OAuth2\Client\Provider;

class BasecampAuthorization implements ResourceOwnerInterface {
  /**
   *
   * @var array
   */
  protected $response;
  
  /**
   *
   * @param array $response          
   */
  public function __construct(array $response) {
    $this->response = $response;
  }
  
  /**
   * When the authorization expires.
   *
   * @return string
   */
  public function getExpires() {
    return $this->response['expires_at'];
  }
  
  /**
   * Get the identity id.
   * 
   * @return int
   */
  public function getId() {
    return $this->response['identity']['id'];
  }
  
  /**
   * Get name.
   *
   * @return string
   */
  public function getFirstName() {
    return $this->response['identity']['first_name'];
  }
  
  /**
   * Get last name.
   *
   * @return string
   */
  public function getLastName() {
    return $this->response['identity']['last_name'];
  }
  
  /**
   * Get email address.
   *
   * @return string
   */
  public function getEmail() {
    return $this->response['identity']['email_address'];
  }
  
  /**
   * Get the accounts.
   * 
   * @return array
   */
  public function getAccounts() {
    return $this->response['accounts'];
  }

  /**
   * Get user data as an array.
   *
   * @return array
   */
  public function toArray() {
    return $this->response;
  }
  
}
