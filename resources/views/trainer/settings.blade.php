@extends('layouts.app')
@section('content')
    <main>
        <div class="settings-wrap">
            <div class="user-prof">
                <a href="#" class="user-prof-inner">
                    <img src="/images/trainerImages/{{ $trainer->image ? $trainer->image : 'profile-icon.png' }}" alt="settings/face.png">
                </a><!-- user prof inner/ -->
            </div><!-- user Prof/ -->
            @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ session('error') }}</li>

                    </ul>
                </div>
            @endif
            @if(session('message'))
                <div class="alert alert-success">
                    <ul>
                        <li>{{ session('message') }}</li>

                    </ul>
                </div>
            @endif
            <form class="form-horizontal" id="profile-form" method="post" action="{{ url('trainer/settings/update') }}">
                {{ csrf_field() }}
                <div class="form-top"><!-- Form top -->
                    <div>
                        <label for="name" class="control-label">Անուն</label>
                        <div>
                            <input type="text" value="{{ old('first_name') ? old('first_name') : $trainer->first_name }}" class="form-control" name="first_name">
                        </div>
                    </div>
                    <div>
                        <label for="" class="control-label">Ազգանուն</label>
                        <div>
                            <input type="text" value="{{ old('last_name') ? old('last_name') : $trainer->last_name }}" class="form-control" name="last_name" id="">
                        </div>
                    </div>
                    <div>
                        <label for="email"  class="control-label">Էլ-հասցե</label>
                        <div>
                            <input type="text" class="form-control" value="{{ old('email') ? old('email') : $trainer->email }}" name="email" id="email">
                        </div>
                    </div>
                </div><!-- Form top end -->

                <div class="pass-change-cont"><!-- Poxel gaxtnabary  -->
                    <label for="" class="control-label">Փոխել Գաղտնաբառը</label>
                    <div>
                        <input name="current_password" type="password" class="form-control" placeholder="Ընթացիկ Գաղտնաբառը">
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" id="" placeholder="Նոր Գաղտնաբառը">
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password_confirmation" id="" placeholder="Նոր Գաղտնաբառը">
                    </div>
                </div>

                <div class="buttons-cont">
                    <div>
                        <a style="text-decoration: none" href="{{ url('trainer/profile') }}"><button type="button">Չեղարկել</button></a>
                    </div>

                    <div>
                        <button type="submit">Հաստատել</button>
                    </div>
                </div>

            </form>


        </div><!-- Settings wrap/ -->
    </main>
@endsection