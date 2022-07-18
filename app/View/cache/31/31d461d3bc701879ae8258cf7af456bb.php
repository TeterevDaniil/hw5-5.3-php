<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* index.twig */
class __TwigTemplate_a7d2de9f41fedfbd5b9157bef12817a3 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <title>
           Blog
        </title>
    </head>
    <body>
        <h1>
            Блог с использованием шаблонизатора TWIG
        </h1>
    <p>Вы вошли как: ";
        // line 12
        echo twig_escape_filter($this->env, ($context["user"] ?? null), "html", null, true);
        echo "</p>
        <form action=\"/User/logout\">
            <input type=\"submit\" value=\"Выйти\">
        </form>
        <hr>
        <br>
        <a href=\"../SwiftMailer/sendMessage\">
            Отправить почту
        </a>
        
        <hr>
        <br>
            <br>
            <form enctype=\"multipart/form-data\" action=\"/blog/addMessage\" method=\"post\"> <br>
                Сообщение:<br>
                <textarea style=\"width: 250px; height: 200px;\" type=\"text\" name=\"text\"></textarea><br>
                <input type=\"file\" name=\"img\"><br>
                <input type=\"submit\" value=\"Сохранить\"><br>
            </form>
            <br>
            <br>
        <hr>
        <h3>Вывод сообщений</h3>
      
              
            ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["messages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["key"]) {
            // line 38
            echo "            ";
            echo twig_escape_filter($this->env, (($__internal_compile_0 = $context["key"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["admin"] ?? null) : null), "html", null, true);
            echo "
            
               ";
            // line 40
            if (($context["admin"] ?? null)) {
                // line 41
                echo "             <div>
               <a style=\"color:red\" href=\"/admin/deleteMessage/?id=";
                // line 42
                echo twig_escape_filter($this->env, (($__internal_compile_1 = $context["key"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["id"] ?? null) : null), "html", null, true);
                echo "\">Удалить Сообщение</a><br>
             </div>
               ";
            }
            // line 45
            echo "                <p><span><b>Дата отправки сообщения: </b></span>  ";
            echo twig_escape_filter($this->env, (($__internal_compile_2 = $context["key"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["insert_date"] ?? null) : null), "html", null, true);
            echo "</p>
                <p><span> <b>Пользователь: </b> ";
            // line 46
            echo twig_escape_filter($this->env, (($__internal_compile_3 = $context["key"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["name"] ?? null) : null), "html", null, true);
            echo "</p>
                <p><span><b>Текст сообщения: </b>";
            // line 47
            echo twig_escape_filter($this->env, (($__internal_compile_4 = $context["key"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["text"] ?? null) : null), "html", null, true);
            echo "</p>
                    ";
            // line 48
            if ((($__internal_compile_5 = $context["key"]) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["img"] ?? null) : null)) {
                // line 49
                echo "                    <img width=\"200px\" src=\"../img/";
                echo twig_escape_filter($this->env, (($__internal_compile_6 = $context["key"]) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["img"] ?? null) : null), "html", null, true);
                echo "\">
                   ";
            }
            // line 51
            echo "               
                    
                <hr>
                    <br>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['key'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        echo "          
        
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  130 => 56,  120 => 51,  114 => 49,  112 => 48,  108 => 47,  104 => 46,  99 => 45,  93 => 42,  90 => 41,  88 => 40,  82 => 38,  78 => 37,  50 => 12,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "index.twig", "C:\\OpenServer5-4-2\\domains\\HWork5\\app\\View\\Blog\\index.twig");
    }
}
