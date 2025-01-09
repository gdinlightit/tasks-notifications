<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Lightit\Backoffice\Employee\Domain\DataTransferObjects\CreateEmployeeDto;
use Lightit\Backoffice\Employee\Domain\Models\Employee;

class StoreEmployeeRequest extends FormRequest
{
    public const NAME = 'name';

    public const EMAIL = 'email';

    public function rules(): array
    {
        return [
            self::NAME => [
                'sometimes',
                'string',
            ],
            self::EMAIL => [
                'required',
                'string',
                'email',
                Rule::unique(Employee::class, self::EMAIL),
            ],
        ];
    }

    public function toDto(): CreateEmployeeDto
    {
        return new CreateEmployeeDto(
            name: $this->string(self::NAME)->toString(),
            email: $this->string(self::EMAIL)->toString()
        );
    }
}
