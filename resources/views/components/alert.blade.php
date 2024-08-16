@props(['type' => 'success', 'sessionName' => 'message'])

<div class="row">
    <div class="col-md-12">
        @if(session()->has($sessionName))
            <div id="alert" role="alert"
                {{ $attributes->merge(['class' => 'alert alert-'.$type.' alert-dismissible fade show']) }}>
                {{ session($sessionName) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>
