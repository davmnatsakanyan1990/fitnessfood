@if(count($trainers) > 0)
@foreach($trainers as $trainer)
    <div class="col-sm-3">
        <div class="trainer-select">
            <input type="radio" value="{{ $trainer->id }}" id="tr{{ $trainer->id }}" name="trainer" class="add-to-s">
            <label for="tr{{ $trainer->id }}">
                <div class="trainer-inner-content">
                    <img src="/images/trainerImages/{{ $trainer->image ? $trainer->image->name : 'profile-icon.png' }}" alt="">
                    <div>
                        <span>{{ $trainer->name }}</span>
                        <p>{{ $trainer->gym ? $trainer->gym->name : '' }}</p>
                    </div>
                </div>
            </label>
        </div>
    </div>
@endforeach
@else
<p class="text-center" style="padding: 7px; margin-top: 70px">@lang('global.nothing was found')</p>
@endif