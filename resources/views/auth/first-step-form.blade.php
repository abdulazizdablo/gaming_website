@extends('layouts.app')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <body>

        <form method="post" action={{ route('register.store') }}>
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Are you developer</h5>
                            <p class="card-text">You can easily upload your developed games and and could be bought</p>
                        </div>
                        <div class="form-check">
                            <input required name="role" class="form-check-input" type="radio"value="developer"
                                id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Developer
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Or a game loving user</h5>
                            <p class="card-text">create account to get latest news on games and buy the best of them</p>
                        </div>
                        <div class="form-check">
                            <input required name="role" class="form-check-input" type="radio" value="user"
                                id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                User
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" name="form-submit">
        </form>
    </body>

    </html>
@endsection
