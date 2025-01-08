<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\Domain\DataTransferObjects;

readonly class EmployeeDto
{
    public function __construct(
        public readonly string|null $name,
        public readonly string|null $email,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'email' => $this->email,
        ], fn ($value) => $value !== null);
    }
}
