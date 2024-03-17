<?php

namespace App\Http\Requests;

use App\Traits\HttpResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class CompnayUpdateRequest extends FormRequest
{
    use HttpResponseTrait;

    /** Determine if the user is authorized to make this request. */
    public function authorize(): bool
    {
        return true;
    }

    /* Get the validation rules that apply to the request. */
    public function rules(): array
    {

        $companyId = $this->route('company');
     
        return [
            'name' => [
                'required',
                'min:3',
                'string',
                Rule::unique('companies')->ignore($companyId, 'company_id'), // Ignore the current record with ID $companyId
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        /* validation error message */
        if ($validator->errors()) {
            $errors = $validator->errors()->getMessages();
            $errors_formated = array();
            foreach ($errors as $value) {
                array_push($errors_formated, $value);
            }
        }

        throw new ValidationException(
            $validator,
            $this->HttpErrorResponse($errors_formated, 422)
        );
    }
}
