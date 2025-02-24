<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    public function serveFile(File $file)
    {
        if (Storage::disk('private')->exists($file->path)) {
            $filePath = Storage::disk('private')->path($file->path);

            return new StreamedResponse(function () use ($filePath) {
                $stream = fopen($filePath, 'rb');
                fpassthru($stream);
                fclose($stream);
            }, 200, [
                'Content-Type' => Storage::disk('private')->mimeType($file->path),
                'Content-Disposition' => 'inline; filename="' . $file->name . '"'
            ]);
        }
        abort(404);
    }
}
