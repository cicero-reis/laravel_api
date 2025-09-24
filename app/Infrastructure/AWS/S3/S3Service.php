<?php

namespace App\Infrastructure\AWS\S3;

use App\Core\Repositories\S3\S3RepositoryInterface;
use App\Infrastructure\AWS\S3\S3RepositoryInterface as S3S3RepositoryInterface;

class S3Service
{
    private $s3Repository;

    public function __construct(S3S3RepositoryInterface $s3Repository)
    {
        $this->s3Repository = $s3Repository;
    }

    public function upload(string $path, $file, array $options = []): string
    {
        return $this->s3Repository->upload($path, $file, $options);
    }

    public function getUrl(string $path): string
    {
        return $this->s3Repository->getUrl($path);
    }
}
