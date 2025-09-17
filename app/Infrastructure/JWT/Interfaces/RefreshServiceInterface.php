<?php

namespace App\Infrastructure\JWT\Interfaces;

interface RefreshServiceInterface
{
    public function execute(): ?string;
}
