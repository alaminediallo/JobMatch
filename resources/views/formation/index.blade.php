@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Liste des formation</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Formations</li>
                        <li class="breadcrumb-item active" aria-current="page">Liste</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <div class="content">
        <x-alert type="success" session-name="message"/>
        <x-alert type="danger" session-name="error"/>

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Formation</h3>
                <div>
                    <a href="{{ route('formation.create') }}" class="btn btn-md btn-primary">Ajouter une formation</a>
                </div>
            </div>
            <div class="block-content block-content-full overflow-x-auto">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                    <thead>
                    <tr>
                        <th style="width: 25%;">Nom</th>
                        <th style="width: 25%;">Institution</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($formations as $formation)
                        <tr>
                            <td>{{ $formation->name }}</td>
                            <td>{{ $formation->institution }}</td>
                            <td>{{ $formation->date_debut->format('d-m-Y') }}</td>
                            <td>{{ $formation->date_fin?->format('d-m-Y') ?? 'En cours' }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('formation.show', $formation) }}"
                                       class="btn btn-md btn-alt-info js-bs-tooltip-enabled"
                                       data-bs-toggle="tooltip" aria-label="Voir"
                                       data-bs-original-title="Voir">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('formation.edit', $formation) }}"
                                       class="btn btn-md btn-alt-secondary">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('formation.destroy', $formation) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?')"
                                                class="btn btn-md btn-alt-danger">
                                            <i class="fa fa-times"></i>
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
    </div>
@endsection
