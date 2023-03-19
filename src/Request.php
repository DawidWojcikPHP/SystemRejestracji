<?php

declare(strict_types=1);

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

class Request
{
    public function __construct(private string $uri, private array $post)
    {
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function postParams(): array
    {
        return $this->post ?? [];
    }
}