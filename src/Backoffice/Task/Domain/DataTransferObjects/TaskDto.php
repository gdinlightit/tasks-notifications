<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\DataTransferObjects;

use Lightit\Backoffice\Task\Domain\Enums\TaskStatus;

readonly class TaskDto
{
    public function __construct(
        public readonly string|null $title,
        public readonly string|null $description,
        public readonly TaskStatus|null $status,
        public readonly int|null $employee_id,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array_filter([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status?->value,
            'employee_id' => $this->employee_id,
        ], fn ($value) => $value !== null);
    }
}
