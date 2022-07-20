<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollRequest extends FormRequest
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
        return [
            'poll-title' => 'required|string|min:5|max:30',
            'poll-op-1' => 'required|string|min:1|max:30',
            'poll-op-2' => 'required|string|min:1|max:30',
            'poll-op-3' => 'required|string|min:1|max:30',
            'poll-date-start' => 'required|date|before:poll-date-end',
            'poll-date-end' => 'required|date|after:poll-date-start',
        ];
    }

    public function attributes()
    {
        return [
            'poll-title' => 'Título da Enquete',
            'poll-op-1' => 'Opção 1',
            'poll-op-2' => 'Opção 2',
            'poll-op-3' => 'Opção 3',
            'poll-date-start' => 'Data de Início',
            'poll-date-end' => 'Data de Término',
        ];
    }
}
