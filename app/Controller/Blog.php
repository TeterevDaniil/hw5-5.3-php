<?php

namespace APP\Controller;

use App\Model\Message;
use APP\Model\User;
use Base\AbstractController;
use Base\View;


class Blog extends AbstractController
{
    function indexAction()
    {
        $this->view->setRenderType(View::RENDER_TYPE_NATIVE);
        if (!$this->user) {
            $this->redirect('/user/register');
        }

        $messages = Message::getListMessages();
        if ($messages) {
            $this->data = Message::getUserMessages($messages);
        }
        return $this->view->render('Blog/index.phtml', [
            'user' => $this->user,
            'message' => $this->data
        ]);
    }

    function twigAction()
    {
        if (!$this->user) {
            $this->redirect('/user/register');
        }
        $this->view->setRenderType(View::RENDER_TYPE_TWIG);
        $messages = Message::getListMessages();

        if ($messages) {
            $data = Message::getUserMessages($messages);
        }

        return $this->view->render('index.twig', [
            'messages' => $data,
            'user' => $this->user->getName(),
            'admin' => $this->user->isAdmin()
        ]);
    }

    public function addMessageAction()
    {
        $this->view->setRenderType(View::RENDER_TYPE_NATIVE);
        $success = true;
        if (!$this->user->getId()) {
            $this->redirect('/login');
        }
        $text = (string) $_POST['text'];

        if (!$text) {
            $this->view->assign('error', 'Сообщение не может быть пустым');
            $success = false;
        }

        if ($success == true) {
            $message = (new Message())
                ->setText($text)
                ->setUser_id($this->user->getId());
            if (isset($_FILES['img']['tmp_name'])) {
                $message->loadFile($_FILES['img']['tmp_name']);
            }
            $message->saveMessage();
            $this->redirect('/blog');
        }
        $messages = Message::getListMessages();
        if ($messages) {
            $this->data = Message::getUserMessages($messages);
        }
        return $this->view->render('Blog/index.phtml', ['user' => User::getById((int)$this->user->getId()),
        'message' => $this->data]);
    }
}
