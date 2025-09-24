<?php

namespace App\Infrastructure\AWS\S3;

interface S3RepositoryInterface
{
    public function upload(string $path, $file, array $options = []): string;

    public function delete(string $path): bool;

    public function getUrl(string $path): string;
}
