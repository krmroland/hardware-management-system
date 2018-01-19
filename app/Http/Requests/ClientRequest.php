<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
             'phoneNumber' => [
                'nullable',
                'digits:10',
                'regex:/07\d{8}/',
             ],
             'name' => 'required|min:3|max:40',
        ];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->clientExists()) {
                $validator->errors()->add('name', 'A client with the same name and phone number already exists');
            }
        });
    }

    protected function clientExists()
    {
        return $this->baseModel()->where(['name' => $this->name])
                     ->where(['phoneNumber' => $this->phoneNumber])

                     ->exists();
    }

    protected function baseModel()
    {
        if ($client = $this->client) {
            return $client->query()->where('id', '!=', $client->id);
        }
        if (in_array($uri = $this->route()->uri(), ['customers', 'suppliers'])) {
            $model = ucfirst(str_singular($uri));

            return resolve("\App\\$model")->query();
        }
    }
}
