@extends('layouts.app')

@section('content')
    <div class="content"></div>
@endsection

@section('scripts')
    <script>
        var token = '{{ csrf_token() }}';
    </script>
    <script src="/js/basket.js"></script>
@endsection