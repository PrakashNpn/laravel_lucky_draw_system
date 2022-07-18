@extends('layouts.app')
@section('content')
    <div class="container">
        @guest
            <div class="rounded-3"
                style="background-color: #e4dedeee;"
            >
                <div class="container-fluid p-4 my-3">
                    <h1 class="display-5 fw-bold" style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif">
                        Lucky Draw System
                    </h1>
                    <p class="col-md-8 fs-4" style="font-family:'Times New Roman', Times, serif">
                        Hey Guys, this is the simple lucky draw system project for
                        practicing laravel. In this project we will cover most of the
                        basic staff and some logical staff of laravel framework. I hope you will like
                        this project. Have a good coding day.
                    </p>
                    {{-- <button class="btn btn-primary" type="button">
                        Register
                    </button> --}}
                    <a href="{{ Route('register') }}" class="btn btn-primary">
                        Register
                    </a>
                    <a href="{{ Route('login') }}" class="btn btn-primary mx-1">
                        Login
                    </a>
                </div>
            </div>
        @endguest
       <div class="my-4">
            <h1>
                Result Of Lucky Draw Winners List This Year
            </h1>
            <hr>
            @if ( count( $prizes ) > 0 )
                @can( 'admin' )
                    <form action="{{ url('/admin/reset/winners') }}" method="POST">
                        @csrf
                        @method( 'GET' )
                        <button type="submit" class="btn btn-primary mb-2">
                            Reset Winner
                        </button>
                    </form>
                @endcan
                <table class="table table-striped table-hover">
                    <tr>
                        <th>#</th>
                        <th>User name</th>
                        <th>Email</th>
                        <th>Winning Number</th>
                        <th>Prize</th>
                    </tr>
                    @foreach ( $prizes as $key => $prize )
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $prize -> user -> name }}</td>
                            <td>{{ $prize -> user -> email }}</td>
                            <td>{{ $prize -> winning_number }}</td>
                            <td>{{ $prize -> prize }}</td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h3>
                    There Is No Lucky Draw Winners Yet
                </h3>
            @endif
        </div>
    </div>

@endsection

