<?php

namespace Base;

use APP\Model\User;

abstract class AbstractController
{
    /**@var View */
    protected $view;
     /**@var User */
    protected $user;
    protected function redirect(string $url)
    {
        throw new RedirectException($url);
    }
    public function setView(View $view): void
    {
        $this->view = $view;
    }
    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
