@extends('layouts.liste-datatable')

@section('content')

    <div class="content">
        <!-- Affichage des messages de succès ou d'erreur -->
        <x-alert type="success" session-name="message"/>
        <x-alert type="danger" session-name="error"/>

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title fs-lg">
                    <i class="fa fa-briefcase text-muted me-1"></i>
                    {{ __('Your current jobs')}}
                </h3>
                <div>
                    <a href="{{ route('offre.create') }}" class="btn btn-md btn-primary">Ajouter une nouvelle offre</a>
                </div>
            </div>
            <div class="block-content block-content-full overflow-x-auto">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                    <thead>
                    <tr>
                        <th>Titre du poste</th>
                        <th>Type de l'offre</th>
                        <th>Salaire proposé</th>
                        <th>Date de fin</th>
                        <th style="width: 15%;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($offres as $offre)
                        <tr>
                            <td class="fw-semibold">
                                <a href="{{ route('offre.show', $offre) }}" class="text-primary link-fx">
                                    {{ $offre->title }}
                                </a>
                            </td>
                            <td>{{ Str::title($offre->type_offre) }}</td>
                            <td>{{ $offre->salaire_proposer . " FCFA" }}</td>
                            <td>{{ $offre->date_fin->format('d M Y') }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('offre.edit', $offre) }}"
                                       class="btn btn-md btn-alt-secondary js-bs-tooltip-enabled"
                                       data-bs-toggle="tooltip" aria-label="Modifier"
                                       data-bs-original-title="Modifier">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    {{--                                    <a href="{{ route('offre.candidatures', $offre) }}"--}}
                                    <a href=""
                                       class="btn btn-md btn-alt-info js-bs-tooltip-enabled"
                                       data-bs-toggle="tooltip" aria-label="Voir les candidatures"
                                       data-bs-original-title="Voir les candidatures">
                                        <i class="fa fa-users"></i>
                                    </a>
                                    <form action="{{ route('offre.destroy', $offre) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" id="delete-button"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?')"
                                                class="btn btn-md btn-alt-danger js-bs-tooltip-enabled"
                                                data-bs-toggle="tooltip" aria-label="Supprimer"
                                                data-bs-original-title="Supprimer">
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
        <!-- END Dynamic Table Responsive -->
    </div>
    <!-- END Page Content -->
@endsection
