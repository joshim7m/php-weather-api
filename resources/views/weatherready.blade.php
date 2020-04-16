@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Weather Information</div>

                <div class="card-body">
                  <h4>{{ $address }}</h4>
                  {{-- <pre>
                    {{ print_r($owResponseBody) }}
                  </pre> --}}
                  @php 

                    $url = 'http://openweathermap.org/img/w/';
                    $code = $owResponseBody->weather[0]->icon;
                    $ext = '.png';

                    $icon_source = $url.$code.$ext;

                  @endphp

                  <img src="{{ $icon_source }}" alt="">
                    <ul>
                      <li>Description: {{ $owResponseBody->weather[0]->description }}</li>
                      <li>Icon: {{ $owResponseBody->weather[0]->icon }}</li>
                      <li>Tempareture: {{ $owResponseBody->main->temp - 273.15 }} &deg;C</li>
                      <li>Feels Like: {{ $owResponseBody->main->feels_like - 273.15 }} &deg;C</li>
                      <li>Wind Speed: {{ $owResponseBody->wind->speed * 18/5 }} m/s</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
