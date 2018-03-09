<?php

namespace StockIntel\Aaa;

use Rhubarb\Crown\Application;
use Rhubarb\Leaf\Views\View;

abstract class TwigView extends View
{
    protected $twigVariables;

    /** @var string|bool $autoEscapeStrategy */
    protected $autoEscapeStrategy = false;
    /** @var string|bool $twigCacheLocation */
    protected $twigCacheLocation = false;

    abstract function getTwigFileLocation(): string;

    abstract protected function getTwigVariables(): array;

    protected function printViewContent()
    {
        $loader = new \Twig_Loader_Filesystem(dirname($this->getTwigFileLocation()));
        $twig = new \Twig_Environment($loader,
            [
                'debug' => Application::current()->developerMode,
                'autoescape' => $this->autoEscapeStrategy,
                'cache' => $this->twigCacheLocation,
                'auto-reload' => true
            ]
        );

        $template = $twig->load(basename($this->getTwigFileLocation()));

        print $template->render($this->getTwigVariables());
    }

    protected function addTwigVariable($variableName, $variableValue)
    {
        $this->twigVariables[$variableName] = $variableValue;
    }
}