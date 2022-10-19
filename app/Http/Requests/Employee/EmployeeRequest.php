<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'upload_file' => ['nullable', 'image', 'mimes:png,gif,jpeg', 'max:10000'],
            'team_id' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'not_regex:/^[root]/', Rule::unique('employees')->ignore($this->id)],
            'gender' => ['required'],
            'birthday' => ['required'],
            'address' => ['required'],
            'salary' => ['required'],
            'position' => ['required'],
            'type_of_work' => ['required'],
            'status' => ['required'],
        ];

        if (!$this->has("upload_file") && !session()->has('create_avatar')) {
            $rules['upload_file'] = ['required', 'image', 'mimes:png,gif,jpeg', 'max:10000'];
        }

        if ($this->has("upload_file")) {
            $file = $this->upload_file;
            $ext = $file->extension();
            $file_name = time() . '-' . 'employee.' . $ext;
            session()->put('create_avatar',$file_name);
            $file->storeAs(config('constants.path.PATH_UPLOAD_EMPLOYEE'), $file_name);

        }

        return $rules;
    }
}
