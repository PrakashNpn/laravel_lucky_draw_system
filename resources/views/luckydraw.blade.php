@extends('layouts.app')
@section('content')
    <div class="container my-4">
        <h1>
            {{ __('Draw The Winning Number And Try Your Luck') }}
        </h1>
        <div class="col-3">
            <form method="POST" action="{{ route('luckydraw.store') }}"
                enctype="multipart/form-data"
            >
                @csrf
                <div class="form-group my-3">
                    <label for="generate_random">
                        <b>
                            {{ __('Generate Randomly :') }}
                        </b>
                    </label>
                    <select id="generate_random" class="form-control form-select" required>
                        <option value="0" disabled selected>{{ __('Please Select') }}</option>
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
                    <input type="text" id="winning_number"
                        name="winning_number" required
                        placeholder="Enter 4-digit Winning Number"
                        class="form-control"
                        readonly=""
                    >
                    <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
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
                {{ __('Your Lucky Draw Winning Number Lists') }}
            </h1>
            <hr>
            @if ( count( $user_winning_numbers ) > 0 )
                <table class="table table-striped table-hover">
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            {{ __('Username') }}
                        </th>
                        <th>
                            {{ __('Winning Number') }}
                        </th>
                        <th>
                            {{ __('Actions') }}
                        </th>
                    </tr>
                   @foreach ( $user_winning_numbers as $key => $user_winning_number )
                       <tr>
                           <td>
                            {{ $key + 1 }}
                            </td>
                            <td>
                                {{ $user -> email }}
                            </td>
                            <td>
                                {{ $user_winning_number -> winning_number }}
                            </td>
                            <td>
                               <form action="/luckydraw/{{ $user_winning_number -> id }}" method="POST">
                                    @csrf
                                    @method( 'DELETE' )
                                    <input type="submit"
                                            class="btn btn-primary btn-sm"
                                            value="Delete"
                                    >
                                </form>
                            </td>
                       </tr>
                   @endforeach
                </table>
            @else
                <h3>
                    {{ __('No winning number yet') }}
                </h3>
            @endif
        </div>
    </div>

    <script>

        var selectedItem = document.getElementById("generate_random");
        selectedItem.addEventListener( 'click' , function()
        {

            var selectedValue = selectedItem.value;
            console.log( selectedValue );

            if( selectedValue == "yes" )
            {
                var winningNumber = document.getElementById("winning_number");
                var randomValue = Math.random().toString().substring(3, 7);
                winningNumber.value = randomValue;
                // console.log(typeof(parseInt(randomValue)));
                winningNumber.setAttribute( "readonly", "true" );
            }
            if( selectedValue == "no" )
            {
                var winningNumber = document.getElementById("winning_number");
                winningNumber.value = "";
                winningNumber.removeAttribute("readonly");
            }

        });

    </script>

@endsection
