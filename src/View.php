<?php

namespace Base;

class View
{

    const RENDER_TYPE_NATIVE = 1;
    const RENDER_TYPE_TWIG = 2;
    private $templatePath = '';
    private $data = [];
    private $renderType;
    private $_twig;
    public function __construct($path = '', int $renderType = self::RENDER_TYPE_NATIVE)
    {
        $this->templatePath = PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'app/View';
        $this->renderType = $renderType;
    }

    public function setRenderType(int $renderType)
    {
        if (!in_array($renderType, [self::RENDER_TYPE_NATIVE, self::RENDER_TYPE_TWIG])) {
        }
        $this->_renderType = $renderType;
    }

    public function assign(string $name, $value)
    {
        $this->data[$name] = $value;
        $this->$name = $value;
    }

    public function render(string $tpl, array $data): string
    {

        switch ($this->_renderType) {
            case self::RENDER_TYPE_NATIVE:
                extract($data);
                ob_start();
                include $this->templatePath . DIRECTORY_SEPARATOR . $tpl;
                return ob_get_clean();
                break;

            case self::RENDER_TYPE_TWIG:
                $loader = new \Twig\Loader\FilesystemLoader($this->templatePath . DIRECTORY_SEPARATOR . 'Blog');
                $twig = new \Twig\Environment($loader, [
                     'cache' => $this->templatePath.'\cache',
                ]);
                echo $twig->render($tpl, $data);
                return ob_get_clean();
                break;
        }
    }
}
