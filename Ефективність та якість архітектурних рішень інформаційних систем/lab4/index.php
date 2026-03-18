<?php

require_once 'EmailNotification.php';
require_once 'SlackAdapter.php';
require_once 'SMSAdapter.php';

// Відправка Email
$emailNotifier = new EmailNotification("admin@example.com");
$emailNotifier->send("Hello Email", "This is an email notification.");

// Відправка Slack повідомлення через адаптер
$slack = new Slack("user_login", "api_key_123", "chat_456");
$slackNotifier = new SlackAdapter($slack);
$slackNotifier->send("Hello Slack", "This is a Slack notification.");

// Відправка SMS через адаптер
$sms = new SMS("+1234567890", "MySender");
$smsNotifier = new SMSAdapter($sms);
$smsNotifier->send("Hello SMS", "This is an SMS notification.");
