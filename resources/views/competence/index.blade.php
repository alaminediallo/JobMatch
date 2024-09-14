@extends('layouts.liste-datatable')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Liste des competences</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Competence</li>
                        <li class="breadcrumb-item active" aria-current="page">Liste</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <div class="content">

        <!-- Affichage des messages de succès ou d'erreur -->
        <x-alert type="success" session-name="message"/>
        <x-alert type="danger" session-name="error"/>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Competences
                </h3>
                <div>
                    <a href="{{ route('competence.create') }}" class="btn btn-md btn-primary">Ajouter une competence</a>
                </div>
            </div>
            <div class="block-content block-content-full overflow-x-auto">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                    <thead>
                    <tr>
                        <th style="width: 10%">Id</th>
                        <th>Nom</th>
                        <th style="width: 20%;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($competences as $competence)
                        <tr>
                            <td>
                                {{ $competence->id }}
                            </td>
                            <td class="fw-semibold">
                                {{ $competence->name }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('competence.edit', $competence) }}"
                                       class="btn btn-md btn-alt-secondary js-bs-tooltip-enabled"
                                       data-bs-toggle="tooltip" aria-label="Modifier"
                                       data-bs-original-title="Modifier">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('competence.destroy', $competence) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette competence ?')"
                                                class="btn btn-md btn-alt-danger js-bs-tooltip-enabled"
                                                data-bs-toggle="tooltip" aria-label="Supprimer"
                                                data-bs-original-title="Supprimer">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Responsive -->
    </div>
    <!-- END Page Content -->
@endsection
