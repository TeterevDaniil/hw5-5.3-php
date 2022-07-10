<?php

namespace App\Controller;

use App\Model\Message;
use Base\AbstractController;
use Base\View;

class Api extends AbstractController
{
    public function getUserMessagesAction()
    {
        $this->view->setRenderType(View::RENDER_TYPE_NATIVE);
        $user_id = (int)$_GET['id'] ?? 0;
        if (!$user_id) {
            return $this->response(['error' => 'no user id']);
        }

        $messages = Message::getListUserMessages($user_id);
        if (!$messages) {
            return $this->response(['error' => 'no messages']);
        }
        return $this->response(['messages' => $messages]);
    }


    public function response(array $data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }
}
