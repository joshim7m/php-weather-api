@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                   <h4 class="pt-5">Enter an Address to get Weather </h4>
                <form action="{{ route('weather.result') }}" method="post">
                  {{ @csrf_field() }}

                  <input type="text" class="form-control" name="location" placeholder="Enter an address ">
                  <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
