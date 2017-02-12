@foreach($trainers as $trainer)
<div class="trainer-select">
    <input type="radio" value="{{ $trainer->id }}" id="tr{{ $trainer->id }}" name="marzich" class="add-to-s">
    <label for="tr{{ $trainer->id }}">
        <div class="trainer-inner-content">
            <img src="/images/trainerImages/{{ $trainer->image ? $trainer->image->name : 'profile-icon.png' }}" alt="">
            <div>
                <span>{{ $trainer->first_name }} {{ $trainer->last_name }}</span>
                <p>{{ $trainer->gym ? $trainer->gym->name : 'no gym' }}</p>
            </div>
        </div>
    </label>
</div>
@endforeach