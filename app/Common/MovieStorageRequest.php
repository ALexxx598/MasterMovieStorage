<?php

namespace App\Common;

use Illuminate\Foundation\Http\FormRequest;

class MovieStorageRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @return string|null
     */
    public function getAuthHeader(): ?string
    {
        return $this->header('authorization');
    }

    /**
     * @return string
     */
    public function getAuthMicroserviceHeader(): string
    {
        return $this->header('microservice_authorization');
    }
}
