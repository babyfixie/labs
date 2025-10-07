<?php

require_once 'SocialNetworkConnector.php';

abstract class SocialNetworkPoster
{
  abstract public function getConnector();

  public function post($message)
  {
    $connector = $this->getConnector();
    $connector->login();
    $connector->createPost($message);
    $connector->logout();
  }
}

class FacebookPoster extends SocialNetworkPoster
{
  private $login;
  private $password;

  public function __construct($login, $password)
  {
    $this->login = $login;
    $this->password = $password;
  }

  public function getConnector()
  {
    return new FacebookConnector($this->login, $this->password);
  }
}

class LinkedInPoster extends SocialNetworkPoster
{
  private $email;
  private $password;

  public function __construct($email, $password)
  {
    $this->email = $email;
    $this->password = $password;
  }

  public function getConnector()
  {
    return new LinkedInConnector($this->email, $this->password);
  }
}
