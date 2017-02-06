<footer>
    <div class="container-fluid">
        <div class="row text-center">
            <div class="footer-social">
                <ul class="list-inline rrssb-buttonss">
                    {{--<li><a href="#"><img src="/images/social/share.png" alt="share.png"></a></li>--}}
                    <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="popup">
                            <img src="/images/social/1.png" alt="social/1.png">
                        </a>
                    </li>
                    <li><a href="https://twitter.com/intent/tweet?text={{ url()->current() }}" class="popup">
                            <img src="/images/social/2.png" alt="social/2.png">
                        </a>
                    </li>
                    <li><a  href="https://plus.google.com/share?url={{ url()->current() }}" class="popup">
                            <img src="/images/social/3.png" alt="social/3.png">
                        </a>
                    </li>
                    <li><a  href="http://vk.com/share.php?url={{ url()->current() }}" class="popup">
                            <img src="/images/social/4.png" alt="social/4.png">
                        </a>
                    </li>
                    <li><a href="http://instagram.com/dbox"><img src="/images/social/5.png" alt="social/4.png"></a></li>
                </ul>
            </div>
            <div class="footer-nav">
                <ul class="list-inline">
                    <li><a href="{{ url('/'.App::getLocale()) }}">@lang('global.products')</a></li>
                    <li><a href="{{ url('about/'.App::getLocale()) }}">@lang('global.about us')</a></li>
                    <li><a href="{{ url('trainer/login/'.App::getLocale()) }}">@lang('global.I am trainer')</a></li>
                    <li><a href="{{ url('contact/'.App::getLocale()) }}">@lang('global.contact')</a></li>
                </ul>
            </div>
            <p>
                Fitness Cook <br>
                4/1 1st Avtozavodskiy proezd, Moscow, Russia 115280 <br>
                Tel: +7(495) 668-08-42
            </p>
            <article class="all-rights">
                2016 Fitness Cook. All Right Reserved
            </article>
        </div><!-- Footer main row -->
    </div>	<!-- Container-fluid -->
</footer>