@php
    $isEditPage = (bool)$formation->id;
    $title = $isEditPage ? 'Modifier' : 'Ajouter';
@endphp

    <!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Formation</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Formation</li>
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
          action="{{ $isEditPage ? route('formation.update', $formation) : route('formation.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf

        @if($isEditPage)
            @method('PUT')
        @endif

        <div class="block mb-0">
            <div class="block-header block-header-default">
                <a class="btn btn-alt-secondary" href="{{ route('formation.index') }}">
                    <i class="fa fa-arrow-left me-1"></i> Liste
                </a>
            </div>
            <div class="block-content">
                <div class="row justify-content-center push">
                    <div class="col-md-10">
                        <div class="mb-4">
                            <x-input
                                name="name"
                                label="Nom de la formation"
                                placeholder="Entrez le nom de la formation"
                                :value="$formation->name"
                            />
                        </div>
                        <div class="mb-4">
                            <x-input
                                name="institution"
                                label="Nom de l'institution"
                                placeholder="Entrez le nom de l'institution"
                                :value="$formation->institution"
                            />
                        </div>
                        <div class="d-md-flex gap-md-2">
                            <div class="col-md-6 mb-4 col-12">
                                <x-input
                                    name="date_debut"
                                    label="Date début"
                                    placeholder="Date du début"
                                    class="js-flatpickr"
                                    :value="$formation->date_debut?->format('Y-m-d')"
                                    data-alt-input="true" data-date-format="Y-m-d"
                                    data-alt-format="j F Y"
                                />
                            </div>
                            <div class="col-md-6 mb-4 col-12">
                                <x-input
                                    name="date_fin"
                                    label="Date fin"
                                    placeholder="Date de fin"
                                    class="js-flatpickr"
                                    :value="$formation->date_fin?->format('Y-m-d')"
                                    data-alt-input="true" data-date-format="Y-m-d"
                                    data-alt-format="j F Y"
                                    :required="false"
                                />
                            </div>
                        </div>
                        <div class="mb-4">
                            <x-input
                                type="file"
                                name="diplome"
                                label="Diplôme (PDF)"
                                :required="false"
                            />

                            @if ($isEditPage && $formation->diplome)
                                <a href="{{ asset('storage/' . $formation->diplome) }}" target="_blank"
                                   class="d-inline-block mt-2">Voir le diplôme actuel</a>
                            @endif

                        </div>
                        <!-- Zone d'aperçu du PDF -->
                        <div class="mb-4">
                            <embed id="pdf-preview" src="#" type="application/pdf"
                                   style="display:none; width:100%; height:500px;">
                        </div>
                        <div>
                            <x-textarea
                                name="description"
                                label="Description"
                                placeholder="Qu'avez-vous appris de nouveau ?"
                            >{{ old('description', $formation->description) }}</x-textarea>
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

        document.getElementById('diplome').addEventListener('change', function (event) {
            const preview = document.getElementById('pdf-preview');
            const [file] = event.target.files;

            if (file && file.type === "application/pdf") {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block'; // Afficher l'aperçu
            } else if (file.type !== "application/pdf") {
                preview.src = "#"
                preview.style.display = 'none'; // Cacher l'aperçu
            }
        });
    </script>
@endsection
