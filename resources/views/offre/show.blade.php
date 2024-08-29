@extends('layouts.backend')

@section('content')
    <!-- Hero Section -->
    <div class="bg-image" style="background-image: url('{{ asset('media/photos/photo12@2x.jpg')}}');">
        <div class="bg-black-75">
            <div class="content content-boxed content-full py-5">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center py-3">
                        <div class="w-100 text-center text-md-start">
                            <h1 class="h2 text-white mb-2">
                                {{ $offre->title }}
                            </h1>
                            <h2 class="h4 fs-sm text-uppercase fw-semibold text-white-75">
                                {{ $offre->category->name }} - {{ $offre->created_at->diffForHumans() }}
                            </h2>
                            <a class="fw-semibold text-primary-light" href="javascript:void(0)">
                                <i class="fab fa-fw fa-leanpub text-white-50"></i>
                                {{ $offre->user->nom_entreprise }}
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                        <a class="block block-rounded block-link-shadow block-transparent bg-black-50 text-center mb-0 mx-auto"
                           href="#">
                            <div class="block-content block-content-full px-5 py-4">
                                <div class="fs-2 fw-semibold text-white">
                                    {{ Number::abbreviate($offre->salaire_proposer) . ' FCFA' }}
                                </div>
                                <div class="fs-sm fw-semibold text-uppercase text-white-50 mt-1 push">Salaire proposé
                                </div>
                                <span class="btn btn-hero btn-primary">
                        <i class="fa fa-arrow-right opacity-50 me-1"></i> {{ __('Apply')}}
                      </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero Section -->

    <!-- Page Content -->
    <div class="content content-boxed">
        <div class="row">
            <div class="col-md-4 order-md-1">
                <!-- Job Summary -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">{{__('Job Summary')}}</h3>
                    </div>
                    <div class="block-content">
                        <ul class="fa-ul list-icons">
                            <li>
                      <span class="fa-li text-primary">
                        <i class="fa fa-briefcase"></i>
                      </span>
                                <div class="fw-semibold">Type d'emploi</div>
                                <div class="text-muted">{{ $offre->type_offre }}</div>
                            </li>
                            <li>
                      <span class="fa-li text-primary">
                        <i class="fa fa-money-check-alt"></i>
                      </span>
                                <div class="fw-semibold">Salaire</div>
                                <div class="text-muted">{{ $offre->salaire_proposer . ' FCFA' }}</div>
                            </li>
                            <li>
                      <span class="fa-li text-primary">
                        <i class="fa fa-clock"></i>
                      </span>
                                <div class="fw-semibold">Date de publication</div>
                                <div class="text-muted">{{ $offre->created_at->diffForHumans() }}</div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END Job Summary -->
            </div>
            <div class="col-md-8 order-md-0">
                <!-- Job Description -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">{{__('Job Description')}}</h3>
                    </div>
                    <div class="block-content">
                        <p>{{ $offre->description }}</p>
                    </div>
                </div>
                <!-- END Job Description -->

                <!-- Similar Jobs -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Entreprise</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div
                                class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div class="me-3">
                                    <div class="d-md-flex gap-md-2 align-items-center justify-content-between">
                                        <p class="fs-lg fw-semibold">
                                            {{ $offre->user->nom_entreprise }}
                                        </p>
                                        <p class="text-muted">
                                            {{ $offre->user->typeEntreprise->name }}
                                        </p>
                                    </div>
                                    <p class="text-muted ">
                                        {{ $offre->user->description_entreprise }}
                                    </p>
                                </div>

                            </div>
                        </div>
                        <ul class="fa-ul list-icons">
                            <li>
                      <span class="fa-li text-primary">
                        <i class="fa fa-map-marker-alt"></i>
                      </span>
                                <div class="fw-semibold">Emplacement</div>
                                <div class="text-muted">{{ $offre->user->adresse }}</div>
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- END Similar Jobs -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
