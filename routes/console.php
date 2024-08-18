<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('make:module {name?}', function (?string $name = null) {
    // Récupérer le nom du module, ou le demander à l'utilisateur s'il n'est pas fourni
    $moduleName = $this->argument('name') ?? $this->ask('What is the name of the module?');

    // Vérifier si le nom du module a été fourni
    if (! $moduleName) {
        $this->error('A module name is required.');

        return 1; // Retourne un code d'erreur
    }

    $viewPath = resource_path('views/'.$moduleName);

    // Créer le dossier du module
    if (File::exists($viewPath)) {
        $this->error("The module '$moduleName' already exists.");

        return 1; // Retourne un code d'erreur
    }

    File::makeDirectory($viewPath, 0755, true);

    // Créer les fichiers de vue avec une <div> dans chacun
    $views = ['add', 'edit', 'form', 'show', 'index'];

    foreach ($views as $view) {
        // $content = <<< HTML
        // @extends('layouts.app')
        // @section('content')
        // @endsection
        // HTML;

        //        if ($view == 'add' || $view == 'edit') {
        //        }

        $filePath = "$viewPath/$view.blade.php";
        File::put($filePath, '<div></div>');
        $this->info("Created view file: $filePath");
    }

    $this->info("The module '$moduleName' has been created successfully.");

    return 0; // Retourne un code de succès
});
