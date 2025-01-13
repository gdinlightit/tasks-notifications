<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\Domain\DataTransferObjects;

readonly class CreateEmployeeDto
{
    public function __construct(
        public readonly string|null $name,
        public readonly string|null $email,
    ) {
    }
}
