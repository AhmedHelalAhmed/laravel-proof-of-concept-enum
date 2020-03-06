<?php
namespace App\Enums;
use MyCLabs\Enum\Enum;

/**
 * Class SystemSettingsEnum
 * @package App\Enums
 * settings usually put in config directory in laravel
 * but this simple application for enum
 */
class SystemSettingsEnum extends Enum
{
    /**
     * from https://newsapi.org/register/success
     */
    const NEWS_API_KEY = '6d2689db733b460d8aea70dc456ddf07';
    /**
     *
     */
    const NEWS_API_URL='https://newsapi.org/v1';

    const ARTICLES_NUMBER=3;
}
