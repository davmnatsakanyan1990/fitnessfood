@extends('layouts.app')
@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="profile-top">
                    <a href="{{ url('trainer/settings') }}">
                        <img src="/images/profile/astxik.png" alt="profile/astxik.png">
                    </a>
                    <div>
                        <img src="/images/trainerImages/{{ $trainer->image ? $trainer->image : 'profile-icon.png' }}" alt="profile/face.png">
                        <h2>{{ $trainer->first_name }} {{ $trainer->last_name }}</h2>
                    </div>
                </div><!-- Profile top end -->
            </div><!-- Row end -->

            <div class="row for-table"><!--Row For table -->           
                <table class="table">
                  <thead>
                    <tr>
                      <th>Գնորդի Անունը</th>
                      <th class="text-center">%</th>
                      <th class="text-center">Քանակը</th>
                      <th class="text-right">Ընդհանուր</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="name-td">Աննա</td>
                      <td class="text-center">10 %</td>
                      <td class="text-center">8</td>
                      <td class="text-right">5600դր</td>
                    </tr>
                    
                  </tbody>
                </table>
            </div><!-- Row For table end -->
           

            <div class="row stanal"><!-- Stanal row -->
                <div class="col-md-4 col-md-offset-8 col-sm-6 col-sm-offset-6 stanal-info"><!-- Stanal info -->
                    <ul class="list-inline">
                        <li>Ընդհանուր</li>
                        <li>5600դր</li>
                    </ul>
                    <ul class="list-inline">
                        <li>Տոկոսագումարը</li>
                        <li>560դր</li>
                    </ul>
                    <hr>
                    <form action="#" class="kkapnvenq">
                        <input type="number" placeholder="Հեռ.">
                    </form>
                    <p>
                        Ձեզ հետ կկապնվի մեր օպերատորը
                        գումարի փոախանցման հարցով
                    </p>
                    <div class="text-center">
                        <button>ՍՏԱՆԱԼ</button>
                    </div>

                </div><!-- Stanal info end-->
            </div><!-- Stanal row end-->
        </div><!-- Container end -->
    </main>
@endsection