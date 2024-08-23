@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Langue</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Langue</li>
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
                        <h3 class="block-title">Langue détail</h3>
                    </div>
                    <div class="block-content py-3 space-y-2">
                        <div><span class="fw-bold"> Id: </span> N°{{ $langue->id }}</div>
                        <div><span class="fw-bold"> Nom: </span> {{ $langue->name }}</div>
                        <div><span class="fw-bold"> Niveau: </span>
                            @foreach($langue->users as $user)
                                <span class="">{{ ucfirst($user->pivot->niveau) }}</span>
                            @endforeach
                        </div>

                    </div>
                    <!-- END Job Description -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
@endsection
