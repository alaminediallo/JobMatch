@php
    $isEditPage = (bool)$experience->id;
    $title = $isEditPage ? 'Modifier' : 'Ajouter';
@endphp

    <!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Experience</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Experience</li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content content-full content-boxed">

    <!-- New Post -->
    <form class="js-validation"
          action="{{ $isEditPage ? route('experience.update', $experience) : route('experience.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf

        @if($isEditPage)
            @method('PUT')
        @endif

        <div class="block mb-0">
            <div class="block-header block-header-default">
                <a class="btn btn-alt-secondary" href="{{ route('experience.index') }}">
                    <i class="fa fa-arrow-left me-1"></i> Liste
                </a>
            </div>
            <div class="block-content">
                <div class="row justify-content-center push">
                    <div class="col-md-10">
                        <div class="mb-4">
                            <x-input
                                name="titre_post"
                                label="Titre du post"
                                placeholder="Entrez le titre de vôtre post"
                                :value="$experience->titre_post"
                            />
                        </div>
                        <div class="mb-4">
                            <x-input
                                name="entreprise"
                                label="Nom de l'entreprise"
                                placeholder="Entrez le nom de l'entreprise"
                                :value="$experience->entreprise"
                            />
                        </div>
                        <div class="d-md-flex gap-md-2">
                            <div class="col-md-6 mb-4 col-12">
                                <label class="form-label" for="date_debut">Date début <span class="text-danger">*</span></label>
                                <input type="text" class="js-flatpickr form-control"
                                       id="date_debut" name="date_debut"
                                       placeholder="Date du début" data-alt-input="true" data-date-format="Y-m-d"
                                       data-alt-format="j F Y"
                                       value="{{old('date_debut', $experience->date_debut?->format('Y-m-d'))}}">
                            </div>
                            <div class="col-md-6 mb-4 col-12">
                                <label class="form-label" for="date_fin">Date fin</label>
                                <input type="text" class="js-flatpickr form-control"
                                       id="date_fin" name="date_fin"
                                       placeholder="Date de fin" data-alt-input="true" data-date-format="Y-m-d"
                                       data-alt-format="j F Y"
                                       value="{{old('date_fin', $experience->date_fin?->format('Y-m-d'))}}">
                            </div>
                        </div>
                        <div>
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control @error('description')is-invalid @enderror"
                                      id="description" rows="4" name="description"
                                      placeholder="Petite description de vôtre experience !"
                            >{{ old('description', $experience->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content bg-body-light">
            <div class="row justify-content-center push">
                <div class="col-md-10">
                    <button type="submit" class="btn btn-md btn-alt-primary">
                        <i class="fa fa-check opacity-50 me-1">
                        </i> {{ $isEditPage ? 'Modifier' : 'Enregistrer'  }}
                    </button>
                </div>
            </div>
        </div>

    </form>
    <!-- END New Post -->
</div>
<!-- END Page Content -->

@section('css-plugins')
    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    {{--    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css') }}">
@endsection

@section('js')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <!-- Page JS Helpers (Select2 plugin) -->

    <script>
        // Initialisation de Select2 sur le nouveau champ select
        setTimeout(() => {
            $('.js-flatpickr').flatpickr();
        }, 100); // Ajout d'un délai pour s'assurer que le DOM est entièrement prêt
    </script>
@endsection
