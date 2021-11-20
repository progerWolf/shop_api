<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;
use App\Interfaces\UploadFileServiceInterface;
use Illuminate\Http\JsonResponse;

class UploadFileController extends Controller
{
    public function __construct(
        private UploadFileServiceInterface $uploadFileService
    ) { }

    public function uploadImageFile(UploadImageRequest $request, $dir = 'files'): JsonResponse
    {
        $file = $this->uploadFileService->upload($request->file('file'), $dir);

        return response()->json(['data' => ['filePath' => $file]]);
    }
}
