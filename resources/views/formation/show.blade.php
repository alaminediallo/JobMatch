@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Formation</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Formation</li>
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
                        <h3 class="block-title">Formation détail</h3>
                        <div>
                            <a href="{{ route('formation.edit', $formation) }}"
                               class="btn btn-md btn-alt-primary">Modifier cette formation</a>
                        </div>
                    </div>
                    <div class="block-content py-3 space-y-2 fs-5">
                        <div><span class="fw-bold">Id: </span> N°{{ $formation->id }}</div>
                        <div><span class="fw-bold">Nom de la formation: </span> {{ $formation->name }}</div>
                        <div><span class="fw-bold">Institution: </span> {{ $formation->institution }}</div>
                        <div>
                            <span class="fw-bold">Date du début: </span>
                            {{ $formation->date_debut->format('D d, M Y') }}
                        </div>
                        <div>
                            <span class="fw-bold">Date de la fin: </span>
                            {{ $formation->date_fin?->format('D d, M Y') ?? "En cours" }}
                        </div>
                        <div><span class="fw-bold">Description: </span>
                            {{ $formation->description ?? 'Pas de description pour cette formation' }}
                        </div>
                        @if ($formation->diplome)
                            <div>
                                <strong>Aperçu du Diplôme :</strong>
                                <br>
                                <embed src="{{ asset('storage/' . $formation->diplome) }}"
                                       width="100%" height="700" type="application/pdf">
                            </div>
                        @else
                            <div>
                                <strong>Diplôme :</strong>
                                Pas de diplôme reçu pour cette formation
                            </div>

                        @endif

                    </div>
                    <!-- END Job Description -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
@endsection
