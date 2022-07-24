<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('gras', [$this, 'mettre_en_gras'],
                ['is_safe' => ['html']
                ]),
            new TwigFilter('italic', [$this, 'mettre_en_italique'],
                ['is_safe' => ['html']
                ]),
            new TwigFilter('mailTo', [$this, 'mailTo'],
                ['is_safe' => ['html']
                ]),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('function_name', [$this, 'doSomething']),
        ];
    }

    public function mettre_en_gras($value)
    {
        return '<strong>' . $value . '</strong>';
    }


    public function mettre_en_italique($value)
    {
        return '<i>' . $value . '</i>';
    }

    public function mailTo(string $text)
    {
        if (preg_match_all('/[\p{L}0-9_.-]+@[0-9\p{L}.-]+\.[a-z.]{2,6}\b/u', $text, $mails)) {
            foreach ($mails[0] as $mail) {
                $text = str_replace($mail, '<a href="mailto:' . $mail . '">' . $mail . '</a>', $text);
            }

        }
