<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\Domain\Actions;

use Lightit\Backoffice\Employee\Domain\DataTransferObjects\CreateEmployeeDto;
use Lightit\Backoffice\Employee\Domain\Models\Employee;

class StoreEmployeeAction
{
    public function execute(CreateEmployeeDto $dto): Employee
    {
        return Employee::create($dto->toArray());
    }
}
