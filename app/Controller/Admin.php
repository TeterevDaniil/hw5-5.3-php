<?php
namespace APP\Controller;

use App\Model\Message;
use Base\AbstractController;
use Base\View;

class Admin extends AbstractController
{
   public function deleteMessageAction ()
   {$this->view->setRenderType(View::RENDER_TYPE_NATIVE);
    if (!$this->user && !$this->user->isAdmin()) {
        $this->redirect('/user/blog');
    }
    $messageId = $_GET['id'];
    Message::deleteMessage($messageId);
    $this->redirect('/blog');
   }

}
