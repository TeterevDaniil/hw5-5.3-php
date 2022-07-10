<?php

namespace App\Model;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class SwiftMailer
{
  public function message()
  {

    $transport = (new Swift_SmtpTransport(HOSTMAIL, PORTMAIL, 'SSL'))
      ->setUsername(USERMAIL)
      ->setPassword(PASSMAIL);

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $message = (new Swift_Message('Какая то тема письма'))
      ->setFrom(['testsmtp@abaplus.pro' => 'Тестовое письмо'])
      ->setTo([MAILTO])
      ->setBody('Привет это тестовое письмо');
    // Send the message
    $result = $mailer->send($message);
    return $result;
  }
}
