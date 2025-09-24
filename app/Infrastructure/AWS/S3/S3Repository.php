<?php

namespace App\Infrastructure\AWS\S3;

use Illuminate\Support\Facades\Storage;

class S3Repository implements S3RepositoryInterface
{
    public function upload(string $path, $file, array $options = []): string
    {
        Storage::disk('s3')->put($path, $file, $options);

        return $this->getUrl($path);
    }

    public function delete(string $path): bool
    {
        return Storage::disk('s3')->delete($path);
    }

    public function getUrl(string $path): string
    {
        return Storage::disk('s3')->url($path);
    }
}
