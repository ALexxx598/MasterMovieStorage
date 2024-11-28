<?php

namespace App\Exceptions;

use App\StorageDomain\Media\Exception\UnknownMediaRestrictionException;
use App\StorageDomain\Media\Exception\UnsupportedMediaType;
use App\StorageDomain\Media\Exception\ValidationMediaException;
use App\StorageDomain\Media\Exception\ValidatorCreationFailedException;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * @param \Illuminate\Http\Request $request
     * @param Throwable $e
     * @return JsonResponse|Response
     * @throws Throwable
     */
    public function render($request, Throwable $e): JsonResponse|Response
    {
        return match (true) {
            $e instanceof UnknownMediaRestrictionException => $this->mapUnknownMediaRestrictionException($e),
            $e instanceof UnsupportedMediaType => $this->mapUnsupportedMediaType($e),
            $e instanceof ValidationMediaException => $this->mapValidationMediaException($e),
            $e instanceof ValidatorCreationFailedException => $this->mapValidatorCreationFailedException($e),
            $e instanceof AuthenticationException => $this->mapAuthenticationException($e),
            default => parent::render($request, $e),
        };
    }

    /**
     * @param Exception|Throwable $e
     * @return JsonResponse
     */
    private function mapByDefault(Exception|Throwable $e): JsonResponse
    {
        return response()->json(
            [
                'message' => $e->getMessage(),
                'error_code' => $e->getCode(),
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    /**
     * @param UnknownMediaRestrictionException $e
     * @return JsonResponse
     */
    private function mapUnknownMediaRestrictionException(UnknownMediaRestrictionException $e): JsonResponse
    {
        return response()->json([
            'message' => $e->getMessage(),
            'error' => ErrorCodes::MEDIA_UNKNOWN_RESTRICTION()->value,
            'error_code' => ErrorCodes::MEDIA_UNKNOWN_RESTRICTION,
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param UnsupportedMediaType $e
     * @return JsonResponse
     */
    private function mapUnsupportedMediaType(UnsupportedMediaType $e): JsonResponse
    {
        return response()->json([
            'message' => $e->getMessage(),
            'error' => ErrorCodes::MEDIA_UNSUPPORTED_TYPE()->value,
            'error_code' => ErrorCodes::MEDIA_UNSUPPORTED_TYPE,
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param ValidationMediaException $e
     * @return JsonResponse
     */
    private function mapValidationMediaException(ValidationMediaException $e): JsonResponse
    {
        return response()->json([
            'message' => $e->getMessage(),
            'error' => ErrorCodes::MEDIA_VALIDATION()->value,
            'error_code' => ErrorCodes::MEDIA_VALIDATION,
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param ValidatorCreationFailedException $e
     * @return JsonResponse
     */
    private function mapValidatorCreationFailedException(ValidatorCreationFailedException $e): JsonResponse
    {
        return response()->json([
            'message' => $e->getMessage(),
            'error' => ErrorCodes::MEDIA_VALIDATION_CREATION()->value,
            'error_code' => ErrorCodes::MEDIA_VALIDATION_CREATION,
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    private function mapAuthenticationException(AuthenticationException $e): JsonResponse
    {
        return response()->json([
            'message' => $e->getMessage(),
            'error' => ErrorCodes::UNAUTHORIZED()->value,
            'error_code' => ErrorCodes::UNAUTHORIZED,
        ], Response::HTTP_BAD_REQUEST);
    }
}
