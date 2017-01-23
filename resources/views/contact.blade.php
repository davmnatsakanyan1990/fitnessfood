@extends('layouts.app')
@section('content')
    <main>
        <div class="container"><!-- Container -->
            <div class="row"><!-- Map Row -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3046.4943965553452!2d44.57132771494331!3d40.22030847938846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406aa2fe98977919%3A0xb195cb0255136032!2sHamazasp+Babajanyan+Statue!5e0!3m2!1sru!2s!4v1485086897884" width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div><!-- Map Row -->

            <div class="row cols-3-row"><!-- 3 cols row -->

                <div class="col-sm-4 text-center">
                    <div class="cont-for-img">
                        <img src="images/contact/1.png" alt="">
                    </div>
                    <p>Т: 077 700323</p>
                </div>

                <div class="col-sm-4 text-center">
                    <div class="cont-for-img">
                        <img src="images/contact/2.png" alt="">
                    </div>
                    <p>
                        4/1 Автозаводский проезд 1,
                        <br>
                        Москва, Россия 115280
                    </p>
                </div>

                <div class="col-sm-4 text-center">
                    <div class="cont-for-img">
                        <img src="images/contact/3.png" alt="">
                    </div>
                    <p>contact@fitnesscook.am</p>
                </div>
            </div><!-- 3 cols row -->

            <div class="row form-row"><!-- Form row -->
                <h2>Միացեք մեզ</h2>
                <div class="text-center">
                    <ul class="list-inline">
                        <li><a href="#"><img src="images/social/share.png" alt="share.png"></a></li>
                        <li><a href="#"><img src="images/social/1.png" alt="social/1.png"></a></li>
                        <li><a href="#"><img src="images/social/2.png" alt="social/2.png"></a></li>
                        <li><a href="#"><img src="images/social/3.png" alt="social/3.png"></a></li>
                        <li><a href="#"><img src="images/social/4.png" alt="social/4.png"></a></li>
                        <li><a href="#"><img src="images/social/5.png" alt="social/4.png"></a></li>
                    </ul>
                </div>

                <form class="contact-page-form">
                    <div class="col-sm-6">
                        <input class="form-control" type="text" placeholder="Անուն">
                    </div>

                    <div class="col-sm-6">
                        <input class="form-control" type="text" placeholder="Էլ. հասցե">
                    </div>

                    <div class="col-sm-12">
                        <textarea name="nam" id="" placeholder="Հաղորդագրություն"></textarea>
                    </div>
                    <div class="submit-div col-sm-12">
                        <button type="submit">ՈՒՂԱՐԿԵԼ<span class="fa fa-envelope"></span></button>
                    </div>
                </form>
            </div><!-- Form row end-->
        </div><!-- Container end -->
    </main>
@endsection