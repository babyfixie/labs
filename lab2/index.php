<?php

require_once 'SocialNetworkConnector.php';
require_once 'SocialNetworkPoster.php';

echo "--- Facebook ---<br>";
$facebook = new FacebookPoster("user123", "fb_password");
$facebook->post("Hi, Facebook!");

echo "<br>--- LinkedIn ---<br>";
$linkedin = new LinkedInPoster("user@domain.com", "li_password");
$linkedin->post("Hi, LinkedIn!");
