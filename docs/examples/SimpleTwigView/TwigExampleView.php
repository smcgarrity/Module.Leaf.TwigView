<?php

namespace Rhubarb\Leaf\TwigView\Docs\Examples\SimpleTwigView;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\TwigView\TwigView;

class TwigExampleView extends TwigView
{

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            $passwordInput = new Textbox('Password'),
            $forgotPassword = new Button('ForgotPassword')
        );

        $passwordInput->addCssClassName('c-input');
    }

    function getTwigFileLocation(): string
    {
        return './TwigExample.twig';
    }

    protected function getTwigVariables(): array
    {
        return [
            'Title' => HtmlPageSettings::singleton()->pageTitle,
            'Surname' => $this->model->restModel->Surname,
            'Forename' => $this->model->restModel->Forename,
            'Password' => $this->leaves['Password'],
            'ForgotPassword' => $this->leaves['ForgotPassword'],
        ];
    }

}