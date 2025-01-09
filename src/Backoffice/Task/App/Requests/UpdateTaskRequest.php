<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Lightit\Backoffice\Employee\Domain\Models\Employee;
use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDto;
use Lightit\Backoffice\Task\Domain\Enums\TaskStatus;
use Lightit\Backoffice\Task\Domain\Models\Task;

class UpdateTaskRequest extends FormRequest
{
    public const TITLE = 'title';

    public const DESCRIPTION = 'description';

    public const STATUS = 'status';

    public const EMPLOYEE_ID = 'employeeId';

    public function rules(): array
    {
        return [
            self::TITLE => [
                'sometimes',
                'string',
                Rule::unique(Task::class, self::TITLE)->ignore($this->task),
            ],
            self::DESCRIPTION => ['sometimes', 'string', 'max:1024'],
            self::STATUS => [
                'sometimes',
                Rule::enum(type: TaskStatus::class),
            ],
            self::EMPLOYEE_ID => ['sometimes', 'integer', Rule::exists(Employee::class, 'id')],
        ];
    }

    public function toDto(): TaskDto
    {
        return new TaskDto(
            title: $this->has(self::TITLE) ? $this->string(self::TITLE)->toString() : null,
            description: $this->has(self::DESCRIPTION) ? $this->string(self::DESCRIPTION)->toString() : null,
            status: $this->has(self::STATUS) ? $this->enum(self::STATUS, TaskStatus::class) : null,
            employee_id: $this->has(self::EMPLOYEE_ID) ? $this->integer(self::EMPLOYEE_ID) : null,
        );
    }
}
