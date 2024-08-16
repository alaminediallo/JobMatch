@extends('layouts.liste-datatable')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Liste des rôles</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Role</li>
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

        <!-- Dynamic Table Responsive -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Liste des rôles
                </h3>
                <div>
                    <a href="{{ route('role.create') }}" class="btn btn-md btn-primary">Ajouter un rôle</a>
                </div>
            </div>
            <div class="block-content block-content-full overflow-x-auto">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                    <thead>
                    <tr>
                        <th style="width: 15%;">Name</th>
                        <th>Permission</th>
                        <th style="width: 35%">Utilisateur</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td class="fw-semibold">
                                <a href="{{ route('role.show', $role) }}" class="text-primary link-fx">
                                    {{ $role->name }}
                                </a>
                            </td>
                            <td>
                                <div class="truncated-text">
                                    @foreach ($role->permissions as $permission)
                                        {{ (Str::ucfirst($permission->name)) }}
                                        @unless($loop->last)
                                            {{ ', ' }}
                                        @endunless
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div class="truncated-text">
                                    @foreach ($role->users as $user)
                                        {{ (Str::ucfirst($user->name . ' ' . $user->prenom)) }}
                                        @unless($loop->last)
                                            {{ ', ' }}
                                        @endunless
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('role.edit', $role) }}"
                                       type="button" class="btn btn-md btn-alt-secondary js-bs-tooltip-enabled"
                                       data-bs-toggle="tooltip" aria-label="Modifier"
                                       data-bs-original-title="Modifier" data-bs-placement="top">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    @if ($role->etat)
                                        <a href="{{ route('role.activer', $role) }}"
                                           type="button" class="btn btn-md btn-alt-info js-bs-tooltip-enabled"
                                           data-bs-toggle="tooltip" aria-label="Désactiver"
                                           data-bs-original-title="Désactiver" data-bs-placement="top">
                                            <i class="fa fa-thumbs-up"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('role.activer', $role) }}" type="button"
                                           class="btn btn-md btn-alt-warning js-bs-tooltip-enabled"
                                           data-bs-toggle="tooltip" aria-label="Activer"
                                           data-bs-original-title="Activer" data-bs-placement="top">
                                            <i class="fa fa-thumbs-down"></i>
                                        </a>
                                    @endif

                                    @unless($role->etat)
                                        <form action="{{ route('role.destroy', $role) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" type="button" onclick="event.preventDefault();
                                            if(confirm('Êtes-vous sûr de vouloir supprimer ?')){
                                            this.closest('form').submit();}"
                                               class="btn btn-md btn-alt-danger js-bs-tooltip-enabled"
                                               data-bs-toggle="tooltip" aria-label="Supprimer"
                                               data-bs-original-title="Supprimer" data-bs-placement="top">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </form>
                                    @endunless
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Dynamic Table Responsive -->
    </div>
    <!-- END Page Content -->
@endsection
