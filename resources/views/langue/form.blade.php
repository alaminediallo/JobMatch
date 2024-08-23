@php
    $isEditPage = (bool)$langue->id;
    $title = $isEditPage ? 'Modifier' : 'Ajouter';
@endphp

    <!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Langue</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Langue</li>
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
          action="{{ $isEditPage ? route('langue.update', $langue) : route('langue.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf

        @if($isEditPage)
            @method('PUT')
        @endif

        <div class="block mb-0">
            <div class="block-header block-header-default">
                <a class="btn btn-alt-secondary" href="{{ route('langue.index') }}">
                    <i class="fa fa-arrow-left me-1"></i> Liste
                </a>
            </div>
            <div class="block-content">
                <div class="row justify-content-center push">
                    <div class="col-md-10">

                        <div class="mb-4">
                            <x-input
                                name="name"
                                label="Nom de la langue"
                                placeholder="Entrez le nom de la langue"
                                :value="$langue->name"
                            />
                        </div>
                        <label class="form-label" for="niveau">Niveau<span class="text-danger">*</span></label>
                        <select class="form-select js-select2" name="niveau"
                                data-placeholder="Choisir le rôle de l'utilisateur" id="niveau">
                            @foreach ($niveaux as $value => $label)
                                <option
                                    value="{{ $value }}"
                                    @selected(old('niveau', $niveau) == $value )>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('niveau')
                        <div class="text-danger mt-1 fs-sm">{{ $message }}</div>
                        @enderror
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

