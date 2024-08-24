@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Experience</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Experience</li>
                        <li class="breadcrumb-item active" aria-current="page">show</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content content-boxed">
        <div class="row">
            <div class="col-md-12">
                <!-- Job Description -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Experience détail</h3>
                        <div>
                            <a href="{{ route('experience.edit', $experience) }}"
                               class="btn btn-md btn-alt-primary">Modifier cette experience</a>
                        </div>
                    </div>
                    <div class="block-content py-3 space-y-2 fs-5">
                        <div><span class="fw-bold">Id: </span> N°{{ $experience->id }}</div>
                        <div><span class="fw-bold">Titre du post: </span> {{ $experience->titre_post }}</div>
                        <div><span class="fw-bold">Entreprise: </span> {{ $experience->entreprise }}</div>
                        <div>
                            <span class="fw-bold">Date du début: </span>
                            {{ $experience->date_debut->format('D d, M Y') }}
                        </div>
                        <div>
                            <span class="fw-bold">Date de la fin: </span>
                            {{ $experience->date_fin?->format('D d, M Y') ?? "En cours" }}
                        </div>
                        <div><span class="fw-bold">Description: </span>
                            {{ $experience->description ?? 'Pas de description pour cette experience' }}
                        </div>

                    </div>
                    <!-- END Job Description -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
@endsection
