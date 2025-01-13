<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\App\Transformers;

use Flugg\Responder\Transformers\Transformer;

use Lightit\Backoffice\Employee\Domain\Models\Employee;
use Lightit\Shared\App\FormattedTimestamps;

class EmployeeTransformer extends Transformer
{
    use FormattedTimestamps;

    public function transform(Employee $employee): array
    {
        return [
            'id' => $employee->id,
            'name' => $employee->name,
            'email' => $employee->email,
            ...$this->timestamps($employee),
        ];
    }
}
