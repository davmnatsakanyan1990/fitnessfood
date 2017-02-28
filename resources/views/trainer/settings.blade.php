@extends('trainer.layouts.index')
@section('content')
    <!-- <div class="responsive-height-block">Important</div> -->
    <main>
        <div class="settings-wrap">
            <form class="form-horizontal" id="profile-form" method="post" action="{{ url('trainer/settings/update') }}"
                  enctype="multipart/form-data">
                <div class="user-prof">
                    <div class="user-prof-inner">
                        <input type="file" name="image" id="imgInp">
                        <label for="imgInp" id="uplod-img-label"></label>
                        <img id="blah"
                             src="/images/trainerImages/{{ $trainer->image ? $trainer->image->name : 'profile-icon.png' }}"
                             alt="settings/face.png">
                    </div>
                    <!-- user prof inner/ -->
                </div>
                <!-- user Prof/ -->
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
                {{ csrf_field() }}
                <div class="form-top"><!-- Form top -->
                    <div>
                        <label for="name" class="control-label">@lang('auth.name')</label>
                        <div>
                            <input type="text"
                                   value="{{ old('name') ? old('name') : $trainer->name }}"
                                   class="form-control" name="name">
                        </div>
                    </div>
                    <div>
                        <label for="email" class="control-label">@lang('auth.email')</label>
                        <div>
                            <input type="text" class="form-control"
                                   value="{{ old('email') ? old('email') : $trainer->email }}" name="email" id="email">
                        </div>
                    </div>
                    <div>
                        <label for="phone" class="control-label">@lang('auth.tel')</label>
                        <div>
                            <input type="text" class="form-control"
                                   value="{{ old('phone') ? old('phone') : $trainer->phone }}" name="phone" id="phone">
                        </div>
                    </div>
                    <div>
                        <label for="email" class="control-label">@lang('global.gym')</label>
                        <select class="form-control" name="gym" style="font-size: 18px; color: #676767;">
                            <option value="">@lang('global.gym')</option>
                            @foreach(\App\Models\Gym::all() as $gym)
                                <option {{ $trainer->gym_id == $gym->id ? 'selected' : '' }} {{ old('gym') && old('gym') == $gym->id ? 'selected' : '' }} value="{{ $gym->id }}">{{ $gym->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Form top end -->

                <div class="pass-change-cont"><!-- Poxel gaxtnabary  -->
                    <label for="" class="control-label">@lang('auth.change_pass')</label>
                    <div>
                        <input name="current_password" type="password" class="form-control"
                               placeholder="@lang('auth.current_pass')">
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" id=""
                               placeholder="@lang('auth.new_pass')">
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password_confirmation" id=""
                               placeholder="@lang('auth.new_pass')">
                    </div>
                </div>
                <div class="buttons-cont">
                    <div>
                        <a style="text-decoration: none" href="{{ url('trainer/profile/'.App::getLocale()) }}">
                            <button type="button">@lang('auth.cancel')</button>
                        </a>
                    </div>

                    <div>
                        <button type="submit">@lang('auth.save')</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Settings wrap/ -->
    </main>
@endsection
@section('scripts')
    <script src="/js/trainer_settings.js" ></script>
@endsection
