<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\BaseRequest;

class NewsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
        ];
    }
}
