
@extends('layouts.app')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">


    <h2>Register</h2>
    <form method="POST" action= {{ route('sign_up') }}  enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
            <label class="form-label" for="inputImage">Select Image:</label>
            <input 
                type="file" 
                name="image" 
                id="inputImage"
                class="form-control @error('image') is-invalid @enderror">

            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Password Confirmation:</label>
            <input type="password" class="form-control" id="password_confirmation"
                   name="password_confirmation">
        </div>
        @if (Session::get('role') == 'developer')
            <div class="form-group">
                <label for="password_confirmation">GitHub Account:</label>
                <input type="url" class="form-control" id="password_confirmation"
                       name="password_confirmation">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Portfolio Website:</label>
                <input type="url" class="form-control" id="password_confirmation"
                       name="password_confirmation">
            </div>

        @endif

        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

@endsection 
 
 
 
 
