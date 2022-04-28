<?php

namespace Drupal\demo;

use Symfony\Component\EventDispatcher\Event;
use Drupal\Core\Config\Config;

class ContactEvent extends Event
{
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function SetConfig()
    {
        return $this->config;
    }

}