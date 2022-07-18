@if ( count( $errors ) > 0 )

    @foreach ( $errors -> All() as $error )

        <div class="alert alert-danger alert-dismissible fade show container mt-2" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

            </button>
        </div>

    @endforeach

@endif

@if ( session( 'success' ) )

    <div class="alert alert-success alert-dismissible fade show container mt-2" role="alert">
        {{ session( 'success' ) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

        </button>
    </div>

@endif

@if ( session( 'error' ) )

    <div class="alert alert-danger alert-dismissible fade show container mt-2" role="alert">
        {{ session( 'error' ) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

        </button>
    </div>

@endif
