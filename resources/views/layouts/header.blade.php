<header><!-- Header -->
    <nav class="navbar">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#">
                        <img src="/images/logo.png" alt="/images/logo.png">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav main-nav" >
                        <li class="active"><a href="{{ url('/') }}">Ապրանքներ</a></li>
                        <li><a href="{{ url('about') }}">Մեր Մասին</a></li>
                        <li><a href="coach.php">Ես մարզիչ եմ</a></li>
                        <li><a href="contact.php">Կապ</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#">
                                <img src="/images/zambyux.png" style="vertical-align: middle;" alt="images/zambyux.png">
                                Զամբյուղ(<span  class="basket_count"></span>)
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header><!-- Header end -->