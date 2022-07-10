<?php

namespace APP\Controller;

use Base\AbstractController;

use App\Model\SwiftMailer as Mailer;

class SwiftMailer extends AbstractController
{
  public function sendMessageAction()
  {
    if (!$this->user) {
      $this->redirect('/user/register');
    }

    $sendingMessage = new Mailer();
    $res = $sendingMessage->message();
    var_dump($res);
  }
}
