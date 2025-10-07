<?php

interface SocialNetworkConnector
{
  public function login();
  public function logout();
  public function createPost($message);
}

class FacebookConnector implements SocialNetworkConnector
{
  private $login;
  private $password;

  public function __construct($login, $password)
  {
    $this->login = $login;
    $this->password = $password;
  }

  public function login()
  {
    echo "Facebook: Authorization user {$this->login}<br>";
  }

  public function logout()
  {
    echo "Facebook: User logout {$this->login}<br>";
  }

  public function createPost($message)
  {
    echo "Facebook: Post message: '$message'<br>";
  }
}

class LinkedInConnector implements SocialNetworkConnector
{
  private $email;
  private $password;

  public function __construct($email, $password)
  {
    $this->email = $email;
    $this->password = $password;
  }

  public function login()
  {
    echo "LinkedIn: Authorization user {$this->email}<br>";
  }

  public function logout()
  {
    echo "LinkedIn: Logout user {$this->email}<br>";
  }

  public function createPost($message)
  {
    echo "LinkedIn: Post message: '$message'<br>";
  }
}
