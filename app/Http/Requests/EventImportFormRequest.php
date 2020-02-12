<?php

namespace App\Http\Requests;

class EventImportFormRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'events' => 'required|file|mimetypes:text/plain',
        ];
    }

}