@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="content">
        <div
            class="d-md-flex justify-content-md-between align-items-md-center py-3 pt-md-3 pb-md-0 text-center text-md-start">
            <div>
                <h1 class="h3 mb-1">Dashboard
                    @if($role === 'admin')
                        Administrateur
                    @elseif($role === 'recruteur')
                        Recruteur
                    @elseif($role === 'candidat')
                        Candidat
                    @endif
                </h1>
                <p class="fw-medium mb-0 text-muted">
                    Bienvenue, {{ $data['userFullName'] }}!
                </p>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row items-push">

            @switch($role)
                @case('admin')
                    <!-- Admin Dashboard -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                            <div class="block-content block-content-full flex-grow-1">
                                <div class="item rounded-3 bg-body mx-auto my-3">
                                    <i class="fa fa-users fa-lg text-primary"></i>
                                </div>
                                <div class="fs-1 fw-bold">{{ $data['totalUsers'] }}</div>
                                <a class="link-fx text-primary d-inline-block" href="{{ route('user.index') }}">
                                    {{ $data['totalUsers'] > 1 ? 'Utilisateurs inscrits' : 'Utilisateur inscrit' }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                            <div class="block-content block-content-full flex-grow-1">
                                <div class="item rounded-3 bg-body mx-auto my-3">
                                    <i class="fa fa-user-tie fa-lg text-primary"></i>
                                </div>
                                <div class="fs-1 fw-bold">{{ $data['totalRecruteurs'] }}</div>
                                <div class="text-muted mb-3">
                                    {{ $data['totalRecruteurs'] > 1 ? 'Recruteurs inscrits' : 'Recruteur inscrit' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                            <div class="block-content block-content-full flex-grow-1">
                                <div class="item rounded-3 bg-body mx-auto my-3">
                                    <i class="fa fa-user-friends fa-lg text-primary"></i>
                                </div>
                                <div class="fs-1 fw-bold">{{ $data['totalCandidats'] }}</div>
                                <div class="text-muted mb-3">
                                    {{ $data['totalCandidats'] > 1 ? 'Candidats inscrits' : 'Candidat inscrit' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                            <div class="block-content block-content-full flex-grow-1">
                                <div class="item rounded-3 bg-body mx-auto my-3">
                                    <i class="fa fa-briefcase fa-lg text-primary"></i>
                                </div>
                                <div class="fs-1 fw-bold">{{ $data['totalOffres'] }}</div>
                                <div class="text-muted mb-3">
                                    {{ $data['totalOffres'] > 1 ? "Offres d'emploi" : "Offre d'emploi" }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4">
                        <a class="block block-rounded block-link-shadow text-center h-100 mb-0"
                           href="{{ route('offre.index') }}">
                            <div class="block-content py-4">
                                <div class="fs-3 fw-semibold text-warning mb-1">{{ $data['offresEnAttentes'] }}</div>
                                <p class="fw-semibold fs-sm text-muted mb-0">
                                    {{ $data['offresEnAttentes'] > 1 ? 'Offres en attente' : 'Offre en attente' }}
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-4">
                        <a class="block block-rounded block-link-shadow text-center h-100 mb-0"
                           href="javascript:void(0)">
                            <div class="block-content py-4">
                                <div
                                    class="fs-3 fw-semibold text-success mb-1">{{ $data['offresValidees'] }}</div>
                                <p class="fw-semibold fs-sm text-muted mb-0">
                                    {{ $data['offresValidees'] > 1 ? 'Offres validées' : 'Offre validée' }}
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-4">
                        <a class="block block-rounded block-link-shadow text-center h-100 mb-0"
                           href="javascript:void(0)">
                            <div class="block-content py-4">
                                <div class="fs-3 fw-semibold text-danger mb-1">{{ $data['offresRejetees'] }}</div>
                                <p class="fw-semibold fs-sm text-muted  mb-0">
                                    {{ $data['offresRejetees'] > 1 ? 'Offres Rejetées' : 'Offre Rejetée' }}
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-6 col-lg-3">
                        <a class="block block-rounded block-link-shadow text-center h-100 mb-0"
                           href="javascript:void(0)">
                            <div class="block-content py-4">
                                <div class="fs-3 fw-semibold text-primary mb-1">{{ $data['totalCandidatures'] }}</div>
                                <p class="fw-semibold fs-sm text-muted mb-0">
                                    {{ $data['totalCandidatures'] > 1 ? 'Candidatures' : 'Candidature' }}
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-3">
                        <a class="block block-rounded block-link-shadow text-center h-100 mb-0"
                           href="{{ route('offre.index') }}">
                            <div class="block-content py-4">
                                <div
                                    class="fs-3 fw-semibold text-warning mb-1">{{ $data['candidaturesEnAttentes'] }}</div>
                                <p class="fw-semibold fs-sm text-muted mb-0">
                                    {{ $data['candidaturesEnAttentes'] > 1 ? 'Candidatures en attente' : 'Candidature en attente' }}
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-3">
                        <a class="block block-rounded block-link-shadow text-center h-100 mb-0"
                           href="javascript:void(0)">
                            <div class="block-content py-4">
                                <div
                                    class="fs-3 fw-semibold text-success mb-1">{{ $data['candidaturesAcceptees'] }}</div>
                                <p class="fw-semibold fs-sm text-muted mb-0">
                                    {{ $data['candidaturesAcceptees'] > 1 ? 'Candidatures Acceptées' : 'Candidature Acceptée' }}
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-3">
                        <a class="block block-rounded block-link-shadow text-center h-100 mb-0"
                           href="javascript:void(0)">
                            <div class="block-content py-4">
                                <div class="fs-3 fw-semibold text-danger mb-1">{{ $data['candidaturesRejetees'] }}</div>
                                <p class="fw-semibold fs-sm text-muted  mb-0">
                                    {{ $data['candidaturesRejetees'] > 1 ? 'Candidatures Rejetées' : 'Candidature Rejetée' }}
                                </p>
                            </div>
                        </a>
                    </div>
                    <!-- More statistics for admin -->
                    @break

                @case('recruteur')
                    <!-- Recruteur Dashboard -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                            <div class="block-content block-content-full flex-grow-1">
                                <div class="item rounded-3 bg-body mx-auto my-3">
                                    <i class="fa fa-briefcase fa-lg text-primary"></i>
                                </div>
                                <div class="fs-1 fw-bold">{{ $data['offresRecruteur'] }}</div>
                                <a class="link-fx text-primary d-inline-block"
                                   href="{{ route('offre.index') }}">
                                    {{ $data['offresRecruteur'] > 1 ? "Offres d'emploi" : "Offre d'emploi" }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                            <div class="block-content block-content-full flex-grow-1">
                                <div class="item rounded-3 bg-body mx-auto my-3">
                                    <i class="fa fa-file-alt fa-lg text-primary"></i>
                                </div>
                                <div class="fs-1 fw-bold">{{ $data['candidaturesReçues'] }}</div>
                                <div class="text-muted mb-3">
                                    {{ $data['candidaturesReçues'] > 1 ? 'Candidatures reçues' : 'Candidature reçue' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                            <div class="block-content block-content-full flex-grow-1">
                                <div class="item rounded-3 bg-body mx-auto my-3">
                                    <i class="fa fa-hourglass-half fa-lg text-warning"></i>
                                </div>
                                <div class="fs-1 fw-bold">{{ $data['offresEnAttente'] }}</div>
                                <div class="text-muted mb-3">
                                    {{ $data['offresEnAttente'] > 1 ? 'Offres en attente' : 'Offre en attente' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                            <div class="block-content block-content-full flex-grow-1">
                                <div class="item rounded-3 bg-body mx-auto my-3">
                                    <i class="fa fa-hourglass-half fa-lg text-warning"></i>
                                </div>
                                <div class="fs-1 fw-bold">{{ $data['candidaturesEnAttente'] }}</div>
                                <div class="text-muted mb-3">
                                    {{ $data['candidaturesEnAttente'] > 1 ? 'Candidatures en attente' : 'Candidature en attente' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <a class="block block-rounded block-link-shadow text-center h-100 mb-0"
                           href="javascript:void(0)">
                            <div class="block-content py-4">
                                <div
                                    class="fs-3 fw-semibold text-success mb-1">{{ $data['candidaturesAcceptees'] }}</div>
                                <p class="fw-semibold fs-sm text-muted mb-0">
                                    {{ $data['candidaturesAcceptees'] > 1 ? 'Candidatures Acceptées' : 'Candidature Acceptée' }}
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-4">
                        <a class="block block-rounded block-link-shadow text-center h-100 mb-0"
                           href="javascript:void(0)">
                            <div class="block-content py-4">
                                <div class="fs-3 fw-semibold text-danger mb-1">{{ $data['candidaturesRejetees'] }}</div>
                                <p class="fw-semibold fs-sm text-muted mb-0">
                                    {{ $data['candidaturesRejetees'] > 1 ? 'Candidatures Rejetées' : 'Candidature Rejetée' }}
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-4">
                        <a class="block block-rounded block-link-shadow text-center h-100 mb-0"
                           href="javascript:void(0)">
                            <div class="block-content py-4">
                                <div class="fs-3 fw-semibold text-warning mb-1">{{ $data['offresExpirees'] }}</div>
                                <p class="fw-semibold fs-sm text-muted mb-0">
                                    {{ $data['offresExpirees'] > 1 ? 'Offres Expirées' : 'Offre Expirée' }}
                                </p>
                            </div>
                        </a>
                    </div>
                    <!-- More statistics for recruteur -->
                    @break

                    <!-- Candidat Dashboard -->
                @case('candidat')
                    <div class="col-sm-6 col-xl-3">
                        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                            <div class="block-content block-content-full flex-grow-1">
                                <div class="item rounded-3 bg-body mx-auto my-3">
                                    <i class="fa fa-paper-plane fa-lg text-primary"></i>
                                </div>
                                <div class="fs-1 fw-bold">{{ $data['candidaturesSoumises'] }}</div>
                                <div class="text-muted mb-3">
                                    {{ $data['candidaturesSoumises'] > 1 ? 'Candidatures soumises' : 'Candidature soumise' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                            <div class="block-content block-content-full flex-grow-1">
                                <div class="item rounded-3 bg-body mx-auto my-3">
                                    <i class="fa fa-hourglass-half fa-lg text-warning"></i>
                                </div>
                                <div class="fs-1 fw-bold">{{ $data['candidaturesEnAttente'] }}</div>
                                <div class="text-muted mb-3">
                                    {{ $data['candidaturesEnAttente'] > 1 ? 'Candidatures en attente' : 'Candidature en attente' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                            <div class="block-content block-content-full flex-grow-1">
                                <div class="item rounded-3 bg-body mx-auto my-3">
                                    <i class="fa fa-file-circle-check fa-lg text-success"></i>
                                </div>
                                <div class="fs-1 fw-bold">{{ $data['candidaturesAcceptees'] }}</div>
                                <div class="text-muted mb-3">
                                    {{ $data['candidaturesAcceptees'] > 1 ? 'Candidatures acceptées' : 'Candidature acceptée' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                            <div class="block-content block-content-full flex-grow-1">
                                <div class="item rounded-3 bg-body mx-auto my-3">
                                    <i class="fa fa-file-circle-xmark fa-lg text-danger"></i>
                                </div>
                                <div class="fs-1 fw-bold">{{ $data['candidaturesRejetees'] }}</div>
                                <div class="text-muted mb-3">
                                    {{ $data['candidaturesRejetees'] > 1 ? 'Candidatures rejetées' : 'Candidature rejetée' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- More statistics for candidat -->
                    @break

            @endswitch
        </div>
    </div>
    <!-- END Page Content -->
@endsection
