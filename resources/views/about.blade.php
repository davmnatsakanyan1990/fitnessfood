@extends('layouts.app')

@section('content')

    <div class="responsive-height-block"><!-- Important --></div>
    <main class="about-main">
        <div class="container">
            <div class="row">
                <div class="col-md-3 side-bar">
                    <div class="side-bar-cont">
                        <div class="filter-navmenu-wrap">
                            <ul class="" role="tablist">
                                @foreach($page->subPages as $k=>$subPage)
                                <li role="presentation" class="{{ $k == 0 ? 'active' : '' }}">
                                    <a href="#tab{{ $k }}" role="tab" data-toggle="tab">{{ json_decode($subPage->title)->$locale }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="delivery-block">
                            <div class="car-bef">
                                <p>Առաքումն</p>
                                <span>Անվճար</span>
                            </div>
                            <article>3000 դրամ և ավելի գնումների դեպքում</article>
                        </div>

                        <!-- Partner Banner -->
                        <div class="partner-block">
                            <img src="{{ asset('images/menuam.png') }}">
                            <p>Առաքման պաշտոնական գործընկեր</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 content editable">
                    <div class="tab-content">
                        @foreach($page->subpages as $k=>$subPage)
                        <div role="tabpanel" class="tab-pane {{ $k == 0 ? 'active' : '' }}" id="tab{{ $k }}">

                            {!!  json_decode($subPage->content)->$locale  !!}

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')

   <script src="/js/about-us.js"></script>
@endsection