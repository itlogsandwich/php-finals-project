<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        // 1. Validation (CRITICAL STEP)
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,pdf,txt|max:10240', // max 10MB
            // 'filename' is also sent by the client, but the file object is most important
        ]);

        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            
            // Generate a unique file name
            $filename = time() . '_' . $uploadedFile->getClientOriginalName();
            
            try {
                // Store the file in the 'public/uploads' disk (you need to run 'php artisan storage:link' for this to be web accessible)
                $path = $uploadedFile->storeAs('uploads', $filename, 'public');

                return response()->json([
                    'message' => 'File uploaded successfully',
                    'path' => Storage::url($path),
                    'filename' => $filename
                ], 200);

            } catch (\Exception $e) {
                // Log the error for debugging
                \Log::error('File upload failed: ' . $e->getMessage());
                
                return response()->json([
                    'message' => 'Failed to store file on server.',
                    'error' => $e->getMessage()
                ], 500);
            }
        }

        // Should not be reached if validation is correct, but for safety
        return response()->json(['message' => 'No file received.'], 400);
    }
}
