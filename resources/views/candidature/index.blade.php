@extends('layouts.liste-datatable')

@php
    $isRecruteur = auth()->user()->isRecruteur() ?? false;
@endphp

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
                    @if ($isRecruteur)
                        Candidatures reçues pour {{ $offre->title }}
                    @else
                        Vos candidatures
                    @endif
                </h3>
            </div>
            <div class="block-content block-content-full overflow-x-auto">
                @if ($candidatures->isEmpty())
                    <p>Aucune candidature reçue pour cette offre pour le moment.</p>
                @else
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                        <thead>
                        <tr>
                            @if($isRecruteur)
                                <th>Nom complet du candidat</th>
                            @else
                                <th>Titre de l'offre</th>
                            @endif
                            <th>Date de soumission</th>
                            <th>Lettre de motivation</th>
                            <th>CV</th>
                            <th>Statut</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($candidatures as $candidature)
                            <tr>
                                <td class="fw-semibold">
                                    @if($isRecruteur)
                                        <a href="{{ route('candidature.show', [$offre, $candidature]) }}"
                                           class="text-primary link-fx">
                                            {{ $candidature->user->name . ' ' . $candidature->user->prenom }}
                                        </a>
                                    @else
                                        <a href="{{ route('candidature.show', [$candidature->offre, $candidature]) }}"
                                           class="text-primary link-fx">
                                            {{ $candidature->offre->title }}
                                        </a>
                                    @endif
                                </td>
                                <td style="width: 15%;">{{ $candidature->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ Storage::url($candidature->lettre_motivation) }}" target="_blank"
                                       class="d-inline-block mt-2">Voir la lettre de motivation
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ Storage::url($candidature->cv) }}" target="_blank"
                                       class="d-inline-block mt-2">Voir le CV
                                    </a>
                                </td>
                                <td class="text-center">
                                    <span class="badge px-2 {{ $candidature->statut->badgeClass() }}">
                                        {{ $candidature->statut->value }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <!-- END Dynamic Table Responsive -->
    </div>
    <!-- END Page Content -->
@endsection
