<?php

declare(strict_types=1);

namespace Lightit\Shared\App;

use Illuminate\Support\Carbon;

trait FormattedTimestamps
{
    protected function formatTimestamp(Carbon $timestamp): string
    {
        return $timestamp->toIso8601String();
    }

    protected function timestamps(Timestampable $model): array
    {
        return [
            'created_at' => $this->formatTimestamp($model->created_at),
            'updated_at' => $this->formatTimestamp($model->updated_at),
        ];
    }
}
