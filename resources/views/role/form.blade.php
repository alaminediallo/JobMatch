@php
    $isEditPage = (bool)$role->id;
    $title = $isEditPage ? 'Modifier' : 'Ajouter';
@endphp

    <!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Rôle</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Rôle</li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">

    <form class="js-validation" action="{{ $isEditPage ? route('role.update', $role) : route('role.store') }}"
          method="POST">
        @csrf

        @if($isEditPage)
            @method('PUT')
        @endif

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title ">{{ $title }} un rôle</h3>
                <div>
                    <a href="{{ route('role.index') }}" class="btn btn-md btn-alt-primary">Liste des rôles</a>
                </div>
            </div>
            <div class="block-content block-content-full">

                <!-- Third Party Plugins -->
                {{--                <h2 class="content-heading">Role</h2>--}}
                <div class="row justify-content-center py-sm-1 py-md-3">
                    <div class="col-sm-14 col-md-12">
                        <div class="mb-4">
                            <x-input
                                name="name"
                                label="Nom du rôle"
                                placeholder="Entrez le nom du rôle"
                                :value="$role->name"
                            />
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="user_ids">Assigner ce rôle à (optionnel)</label>
                            <select class="js-select2 form-select" id="user_ids"
                                    name="user_ids[]" style="width: 100%;"
                                    data-placeholder="Choisir un ou plusieurs utilisateurs" multiple>
                                <option></option>
                                <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                @foreach ($users as $user)
                                    <option
                                        value="{{ $user->id }}" @selected($role->users->contains($user->id))
                                    >{{ $user->name . " " . ($user->prenom ?? '') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_ids')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{--                    <h2 class="content-heading">Permissions</h2>--}}
                    <div class="row justify-content-center py-sm-1 py-md-3">
                        <div class="col-sm-14 col-md-12">
                            <div class="mb-4">
                                <label for="permissions" class="form-label">Permissions</label>
                                <div class="d-flex gap-4 mb-2">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll">Tous cocher</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="uncheckAll">
                                        <label class="form-check-label" for="uncheckAll"
                                        >Tous décocher</label>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach ($permissions as $permission)
                                        <div class="col-md-3 my-2">
                                            <div class="form-check">
                                                <input class="form-check-input permission-checkbox" type="checkbox"
                                                       value="{{ $permission->id }}"
                                                       id="permission{{ $permission->id }}" name="permissions[]"
                                                    @checked($role->permissions->contains($permission->id))>
                                                <label class="form-check-label"
                                                       for="permission{{ $permission->id }}">
                                                    {{ Str::title($permission->name) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('permissions')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Submit -->
            <div class="block-content block-content-full block-content-sm bg-body-light">
                <button type="submit" class="btn btn-md btn-alt-primary">
                    <i class="fa fa-check opacity-50 me-1">
                    </i> {{ $isEditPage ? 'Modifier' : 'Enregistrer'  }}
                </button>
                <button type="reset" class="btn btn-md btn-alt-secondary">
                    <i class="fa fa-sync-alt opacity-50 me-1"></i> Effacer
                </button>
            </div>
            <!-- END Submit -->
        </div>
    </form>
    <!-- jQuery Validation -->
</div>
<!-- END Page Content -->

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkAll = document.getElementById('checkAll');
            const uncheckAll = document.getElementById('uncheckAll');
            const checkboxes = document.querySelectorAll('.permission-checkbox');

            checkAll.addEventListener('change', function () {
                if (checkAll.checked) {
                    checkboxes.forEach(checkbox => checkbox.checked = true);
                    uncheckAll.checked = false; // Uncheck "Tous décocher"
                }
            });

            uncheckAll.addEventListener('change', function () {
                if (uncheckAll.checked) {
                    checkboxes.forEach(checkbox => checkbox.checked = false);
                    checkAll.checked = false; // Uncheck "Tous cocher"
                }
            });

            // Ensure only one of "Tous cocher" or "Tous décocher" can be checked at a time
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    if (checkbox.checked) {
                        uncheckAll.checked = false;
                    } else {
                        checkAll.checked = false;
                    }
                });
            });
        });
    </script>
@endpush
