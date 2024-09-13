<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

abstract class Controller
{
    use AuthorizesRequests;

    /**
     * Gérer l'upload d'un fichier et le remplacement de l'ancien fichier si nécessaire.
     */
    protected function handleUploadedFile(
        $request,
        string $fieldName,
        string $directory,
        ?string $existingFile = null
    ): ?string {
        if ($request->hasFile($fieldName)) {
            // Supprimer l'ancien fichier si un nouveau est téléchargé
            if ($existingFile) {
                Storage::disk('public')->delete($existingFile);
            }

            // Générer un nom de fichier unique
            $fileName = $this->generatePdfFileName($request->file($fieldName), $fieldName);

            return $request->file($fieldName)->storeAs($directory, $fileName, 'public');
        }

        return $existingFile;
    }

    /**
     * Générer un nom unique pour le fichier PDF.
     */
    protected function generatePdfFileName(UploadedFile $file, string $fieldName): string
    {
        $timestamp = now()->timestamp;
        $userId = auth()->id();
        $extension = $file->getClientOriginalExtension();

        return Str::slug($fieldName)."_{$userId}_{$timestamp}.{$extension}";
    }
}
