@extends('layouts.app')
@section('content')
    <div class="container my-4">
        <h1>
            {{ __('Draw The Winner') }}
        </h1>
        <div class="col-3">
            <form method="POST" action="{{ route('adminluckydraw.store') }}">
                @csrf
                <div class="form-group my-3">
                    <label for="prizeType">
                        <b>
                            {{ __('Select Prize *') }}
                        </b>
                    </label>
                    <select id="prize"
                            name="prize"
                            class="form-control form-select" required>
                        <option value="" selected disabled>{{ __('Please Select') }}</option>

                        @foreach ($prize_types as $prize_type)
                            <option>
                                {{ $prize_type -> prize_type }}
                            </option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group my-3">
                    <label for="generate_random">
                        <b>
                            {{ __('Generate Randomly :') }}
                        </b>
                    </label>
                    <select id="generate_random" name="generate_random"
                            class="form-control form-select" required>
                        <option value="" selected disabled>{{ __('Please Select') }}</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="form-group my-3">
                    <label for="winning_number">
                        <b>
                            {{ __('Winning Number :') }}
                        </b>
                    </label>
                    <input type="text" id="winning_number" required
                        name="winning_number"
                        placeholder="Please Enter 4-digit Number"
                        class="form-control"
                        readonly=""
                    >
                </div>
                <div class="form-group">
                    <input type="submit"
                            class="btn btn-primary form-control"
                            value="Draw"
                    >
                </div>
            </form>
        </div>
        <div class="my-4">
            <h1>
                {{ __('All Users Lucky Draw Winning Number Lists') }}
            </h1>
            <hr>
            @if ( count( $users ) > 0 )
                <div class=" row mb-2 " >
                    <div class=" col-md-6 " >
                        <form action="{{ url('/admin/reset/winningnumbers') }}"
                            method="POST"
                        >
                            @csrf
                            @method( 'GET' )
                            <button type="submit"
                                    class=" btn btn-primary "
                            >
                                {{ __('Reset all winning number') }}
                            </button>
                        </form>
                    </div>
                    <div class=" col-md-6 " >
                        <form action="{{ url('/admin/reset/users') }}"
                            method="POST"
                            style= " float: right; "
                        >
                            @csrf
                            @method( 'GET' )
                            <button type="submit"
                                    class=" btn btn-primary "
                            >
                                {{ __('Reset all users') }}
                            </button>
                        </form>
                    </div>
                </div>
                <div class="table-responsive shadow-sm"
                    style="background: #d1e7dd;">
                    <table class="table table-success table-striped table-hover table-bordered">
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                {{ __('Username') }}
                            </th>
                            @if ( $max_winning_numbers )
                                @foreach ( $max_winning_numbers as $key => $winning_number )
                                    <th>
                                        {{ __('Winning Number') }} {{ $key + 1  }}
                                    </th>
                                @endforeach
                            @endif
                        </tr>
                        @foreach ( $users as $key => $user )
                            <tr>
                                <td>
                                    {{ $key + 1 }}
                                </td>
                                <td>
                                    {{ $user -> name }}
                                </td>
                                @foreach ( $all_winning_numbers as $all_winning_number )
                                    @if ( $user->id == $all_winning_number -> user_id )
                                        <td>
                                            {{ $all_winning_number -> winning_number }}
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                <h3>
                    {{ __('There is no user and no winning number yet ') }}
                </h3>
            @endif
        </div>
    </div>

    <script>

        var selectedItem = document.getElementById("generate_random");
        selectedItem.addEventListener( 'click' , function()
        {
            var selectedValue = selectedItem.value;
            console.log(selectedValue);
            if(selectedValue == "yes")
            {
                var winningNumber = document.getElementById("winning_number");
                winningNumber.setAttribute( "readonly" , "true" );
            }
            if(selectedValue == "no")
            {
                var winningNumber   = document.getElementById("winning_number");
                winningNumber.value = "";
                winningNumber.removeAttribute("readonly");
            }

        });

    </script>

@endsection
