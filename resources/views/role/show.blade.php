@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Rôle</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Role</li>
                        <li class="breadcrumb-item active" aria-current="page">show</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content content-boxed">
        <div class="row">
            <div class="col-md-12">
                <!-- Job Description -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Rôle détail</h3>
                    </div>
                    <div class="block-content py-3 space-y-2">
                        <div><span class="fw-bold"> Id: </span> {{ $role->id }}
                        </div>
                        <div><span class="fw-bold"> Nom: </span> {{ $role->name }}</div>
                        <div class="d-flex gap-2">
                            <div class="fw-bold flex-shrink-0"> Utilisateur assigné:</div>
                            <div>
                                @forelse($role->users as $user)
                                    <a class="badge bg-primary p-2 fs-6 mb-2">
                                        {{ (Str::ucfirst($user->name . ' ' . $user->prenom)) }}
                                    </a>
                                @empty
                                    <span>Pas d'utilisateur pour ce rôle.</span>
                                @endforelse
                            </div>
                        </div>
                        <div class="row">
                            <div class="fw-bold">Permissions:</div>
                            @foreach ($permissions as $permission)
                                <div class="col-md-3 my-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                               value="{{ $permission->id }}"
                                               id="permission{{ $permission->id }}" name="permissions[]"
                                               @checked($role->permissions->contains($permission->id)) disabled>
                                        <label class="form-check-label"
                                               for="permission{{ $permission->id }}">
                                            {{ Str::title($permission->name) }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- END Job Description -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
@endsection
