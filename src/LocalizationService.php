<?php

namespace BrandStudio\Localization;

use App;
use Request;

class LocalizationService
{

    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function setLocale(string $locale = null)
    {
        if (!$locale) {
            $locale = Request::segment($this->config['segment']);
        }

        if ($this->validateLocale($locale)) {
            App::setLocale($locale);
        } else {
            return '';
        }

        return App::getLocale();
    }

    private function validateLocale(string $locale = null) : bool
    {
        return in_array($locale, is_string($this->config['locales']) ? array_keys(config($this->config['locales'])) : $this->config['locales']);
    }

}
