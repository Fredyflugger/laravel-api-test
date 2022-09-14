<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;
// Описываем, что мы хотим фильтровать и как
class NotebooksFilter extends ApiFilter {
    protected $safeParams = [
        'name' => ['eq'],
        'company' => ['eq'],
        'phone' => ['eq'],
        'email' => ['eq'],
        'birthDate' => ['eq', 'gt', 'lt', 'gte', 'lte']
    ];
    // переназначаем называние из БД в camelCase для JSON
    protected $columnMap = [
        'birthDate' => 'birth_date'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>='
    ];
}