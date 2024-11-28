<?php

namespace App\Http\Controllers;

use App\Http\Request\Media\MediaGetPathRequest;
use App\Http\Request\Media\MediaUploadRequest;
use App\Http\Request\Media\MediaValidatePathRequest;
use App\Http\Resource\Media\MediaUploadResource;
use App\StorageDomain\Media\MediaTypeEnum;
use App\StorageDomain\Media\Payload\MediaUploadPayload;
use App\StorageDomain\Media\Service\MediaServiceInterface;
use BestMovie\Common\BestMovieMicroservice\Service\BestMovieServiceInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Mockery\Exception;
use Throwable;

class MediaController extends Controller
{
    /**
     * @param MediaServiceInterface $mediaService
     * @param BestMovieServiceInterface $bestMovieService
     */
    public function __construct(
        private MediaServiceInterface $mediaService,
        private BestMovieServiceInterface $bestMovieService,
    ) {
    }

    /**
     * @param MediaUploadRequest $request
     * @return JsonResponse
     * @throws \App\StorageDomain\Media\Exception\UnsupportedMediaType
     * @throws AuthenticationException
     */
    public function upload(MediaUploadRequest $request): JsonResponse
    {
        try {
            $user = $this->bestMovieService->refreshUser($request->getAuthHeader(), $request->getUserId());

            if (!$user->isOk() || !$user->isAdmin()) {
                throw new AuthenticationException();
            };
        } catch (Exception|Throwable $e) {
            throw new AuthenticationException();
        }

        $payload = MediaUploadPayload::make(
            userId: $request->getUserId(),
            type: MediaTypeEnum::tryFrom($request->getMediaType()),
            file: $request->getMediaFile()
        );

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'data' => MediaUploadResource::make($this->mediaService->upload($payload))
        ], Response::HTTP_CREATED);
    }

    /**
     * @param MediaGetPathRequest $request
     * @return JsonResponse
     */
    public function getPath(MediaGetPathRequest $request): JsonResponse
    {
        return response()->json([
            'status' => Response::HTTP_CREATED,
            'data' => [
                'url' => $this->mediaService->getFileUrl($request->getPath()),
            ]
        ], Response::HTTP_CREATED);
    }

    /**
     * @param MediaValidatePathRequest $request
     * @return JsonResponse
     */
    public function validatePath(MediaValidatePathRequest $request): JsonResponse
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $this->mediaService->validatePath($request->getPath()),
        ], Response::HTTP_OK);
    }
}
