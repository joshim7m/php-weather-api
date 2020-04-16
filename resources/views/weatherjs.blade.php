@extends('layouts.app')

@section('content')
<div class="container" id="weather">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> CLIENT SIDE API</div>

                <div class="card-body">
                  <div class="step-one" v-if="step == 1">
                    <h4 class="pt-5">Enter an Address to get Weather </h4>
                    <form>

                      <input type="text" v-model="userInput" class="form-control" name="location" placeholder="Enter an address ">
                      <button v-on:click.prevennt="getWeather" class="btn btn-primary mt-4" v-show="userInput">Submit</button>
                    </form>
                  </div>

                  <div class="step-two mt-5" v-if="step == 2">

                  {{--   <pre>
                      @{{ res }}
                    </pre> --}}
                     <h4>Address: @{{ location.address }}</h4>
                     <ul>
                       <li>@{{ location.lat }}</li>
                       <li>@{{ location.lon }}</li>
                     </ul>
                  {{-- <pre>
                    {{ print_r($owResponseBody) }}
                  </pre> --}}

                {{--   <pre>
                    @{{ res2 }}
                  </pre> --}}


                  {{-- <img src="{{ $icon_source }}" alt=""> --}}
                    <ul>
                      <li>Icon: @{{ result.icon }}</li>
                      <li>Main: @{{ result.main }}</li>
                      <li>Description: @{{ result.description }}</li>
                      <li>Tempareture: @{{ result.temp }} &deg;C</li>
                      <li>Feels Like: @{{ result.feels_like }} &deg;C</li>
                      <li>Wind Speed: @{{ result.wind_speed }} km/hr</li>
                    </ul>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
  <script>

     var app = new Vue({
      el: '#weather',
      data: {
        step: 1,
        userInput: '',
        //res: {}
        location: {
          address: '',
          lat: '',
          lon: '',
        },
        result: {
          main: '',
          description:'',
          icon: '',
          temp: '',
          feels_like: '',
          wind_speed: '',
        },

      },

      methods: {

        getWeather: function(){
          this.step = 2;
          let vm = this;
          axios.get('https://us1.locationiq.com/v1/search.php?',{
            params: {
              key: '50eef054f315ae',
              q:    this.userInput,
              format: 'json',
            }
          })
          .then(function (response){
              let res = response.data[1];
              vm.location.address = res.display_name;
              vm.location.lat = res.lat;
              vm.location.lon = res.lon;

              // use the lat and long to get wheater informatoin
              //"api.openweathermap.org/data/2.5/weather?lat=lat&lon=lon&appid=api

              const api = '7d68c164873760ed13834944f0069cc1';
              const cors_anywhere = 'https://cors-anywhere.herokuapp.com/';
              const url = `
              ${cors_anywhere}api.openweathermap.org/data/2.5/weather?lat=${res.lat}&lon=${res.lon}&appid=${api}`;

              return axios.get(url);

          })
          .then(function (response){
            let res2 = response.data;
            vm.result.main = res2.weather[0].main;
            vm.result.description = res2.weather[0].description;
            vm.result.icon = res2.weather[0].icon;

            vm.result.temp = res2.main.temp - 273.15;
            vm.result.feels_like = res2.main.feels_like - 273.15;
            vm.result.wind_speed = res2.wind.speed * 18/5;
          })
        }
      }

     });

  </script>
@endsection
