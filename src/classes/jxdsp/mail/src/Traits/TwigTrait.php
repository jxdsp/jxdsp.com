<?php

namespace jxdsp\Mail\Traits;

use Symfony\Bridge\Twig\Mime\BodyRenderer;
use Symfony\Component\Mime\Message;
use Twig\Environment;
use Twig\Extra\CssInliner\CssInlinerExtension;
use Twig\Extra\Inky\InkyExtension;
use Twig\Loader\FilesystemLoader;

trait TwigTrait
{
    public function twigBodyRenderer(Message $email)
    {
        $twigBodyRenderer = new BodyRenderer($this->twigEnvironment());
        $twigBodyRenderer->render($email);
    }

    public function twigEnvironment(): Environment
    {

        $twigEnv = new Environment($this->twigFilesystemLoader());
        $twigEnv->setExtensions([new CssInlinerExtension(), new InkyExtension()]);

        return $twigEnv;
    }

    public function twigFilesystemLoader(): FilesystemLoader
    {
        $styleDir = [
            dirname(__DIR__, 6) . '/.cache/webFrontEnd/static/dist/bootstrap/dist/css/'
        ];
        $templateDir = [
            dirname(__DIR__) . '/emailTemplates/',
        ];

        $twigTemplateDirectory = new FilesystemLoader($templateDir);
        $twigTemplateDirectory->setPaths($styleDir, 'styles');

        return $twigTemplateDirectory;
    }
}
