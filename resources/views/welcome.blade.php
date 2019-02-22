<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Przepisy Kulinarne</title>
        
        <meta name="Description" content="Najlpesze przepisy kulinarne z całego świata w postaci aplikacji na telefon z Androidem. Przepisy na Ciasta, Drinki, Napoje, Przystawki">
	<meta name="keywords" content="Przepisy, sposób przyrządzenia, android, telefon, aplikacja, drinki, ciastka, napoje, koktajle, przystawki, zupy">

        <link rel="shortcut icon" href="http://icons.iconarchive.com/icons/webalys/kameleon.pics/96/Food-Dome-icon.png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/product.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style1.css') }}" rel="stylesheet">




        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <style>
            .mySlides {display:none;}
        </style>


        <style type="text/css">

            #section1{
                background:url(image/tlo1.jpg) repeat 0 0 fixed;
                background-repeat: no-repeat;
                background-position: top center;
                width: 100%;
                height: 750px;
                left: 0px;
                top: 0px;
                z-index: 0;
                background-size:cover;

            }

            #section2{
                background: url(image/tlo2.jpg) repeat 0 0 fixed;
                height: 400px;
                background-position: top center;
                width: 100%;
                background-size:cover;


            }

            #section3{
                background: url(image/tlo3.jpg) repeat 0 0 fixed;
                height: 400px;
                background-position: top center;
                width: 100%;
                background-size:cover;

            }

            #section4{
                background: url(image/tlo4.jpeg) repeat 0 0 fixed;
                height: 400px;
                background-position: top center;
                width: 100%;
                background-size:cover;

            }
        </style>
    </head>
    <body>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

        <nav class="site-header sticky-top py-1">
            <div class="container d-flex flex-column flex-md-row justify-content-between">
                <a class="py-2" href="{{ url('/') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="d-block mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
                </a>
                <a class="py-2 d-none d-md-inline-block" href="#sect1">O nas</a>
                <a class="py-2 d-none d-md-inline-block" href="#sect2">Kategorie</a>
                <a class="py-2 d-none d-md-inline-block" href="#sect3">Aplikacja</a>
                <a class="py-2 d-none d-md-inline-block" href="#sect4">Kontakt</a>

                @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    <a class="py-2 d-none d-md-inline-block" href="{{ url('/console') }}">Konsola</a>
                    @else
                    <a class="py-2 d-none d-md-inline-block" href="{{ route('login') }}">Zaloguj</a>
                    <!--<a class="py-2 d-none d-md-inline-block" href="{{ route('register') }}">Rejestracja</a>-->
                    @endauth

                    @endif
                </div>
        </nav>
        <div class="C-1" id="section1">
            <p class="C-1-text" style="color:white; text-shadow: 2px 2px 2px #000;" >Przepisy Kulinarne</p>
            <p class="C-3-text" style="color:white; text-shadow: 2px 2px 2px #000;">Z całego świata</p>

        </div>

        <div class="black-box C-1" id="sect1">
            <p class="C-3-text">Portal ten jest stworzony w celu popularyzacji i nauki przyrządzania smacznych i pięknie wyglądajacych różnego rodzaju dań i napojów.</p>  

        </div>

        <div  id="section2"></div>

        <div class="black-box C-1" id="sect2">
            <!--<p class="C-3-text">Produkty</p>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="https://placehold.it/300x150" alt="Obrazek w karcie">
                        <div class="card-body">
                            <p class="card-text">Treść naszej karty, czyli jakiś opis czy cokolwiek chcemy w niej zamieścić.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="https://placehold.it/300x150" alt="Obrazek w karcie">
                        <div class="card-body">
                            <p class="card-text">Treść naszej karty, czyli jakiś opis czy cokolwiek chcemy w niej zamieścić.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="https://placehold.it/300x150" alt="Obrazek w karcie">
                        <div class="card-body">
                            <p class="card-text">Treść naszej karty, czyli jakiś opis czy cokolwiek chcemy w niej zamieścić.</p>
                        </div>
                    </div>
                </div>
            </div>-->

            <div class="container-fluid">
                <h1 class="text-center mb-3">Kategorie</h1>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner row w-100 mx-auto">
                        <div class="carousel-item col-md-4 active">
                            <div class="card">
                                <img class="card-img-top img-fluid" src="https://polki.pl/foto/4_3_LARGE/biszkoptowy-tort-z-truskawkami-2367919.jpg" alt="Ciastka">
                                <div class="card-body">
                                    <h4 class="card-title">Ciastka</h4>
                                    <p class="card-text">Najpopularniejsze przepisy na ciasta, torty i inne słodkości do wykonania przez każdego w domu.</p> 
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item col-md-4">
                            <div class="card">
                                <img class="card-img-top img-fluid" src="https://images.lifealth.com/uploads/2018/04/Best-healthy-mocktail-drinks-to-cool-down-in-summers.jpg" alt="Drinki">
                                <div class="card-body">
                                    <h4 class="card-title">Drinki</h4>
                                    <p class="card-text">Przepisy i sposoby wykonania najbardziej znanych na świecie drinków, które musisz spróbować.</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item col-md-4">
                            <div class="card">
                                <img class="card-img-top img-fluid" src="https://allforeko.pl/images/news/fotolia_115577904_m.jpg" alt="Napoje">
                                <div class="card-body">
                                    <h4 class="card-title">Napoje</h4>
                                    <p class="card-text">Zdrowe i orzeźwiające napoje na bazie owoców i warzyw, które warto wprowadzić do swojej diety.</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item col-md-4">
                            <div class="card">
                                <img class="card-img-top img-fluid" src="http://targsmaku.pl/uploads/recipe/55/6e/de/556eded6e69a4628c85e935be15af6d4.jpeg" alt="Przystawki">
                                <div class="card-body">
                                    <h4 class="card-title">Przystawki</h4>
                                    <p class="card-text">Przepisy na proste, smaczne i świetnie wyglądające przystawki idealne na każdą imprezę.</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item col-md-4">
                            <div class="card">
                                <img class="card-img-top img-fluid" src="https://polki.pl/foto/4_3_LARGE/zupa-gulaszowa-2356472.jpg" alt="Zupy">
                                <div class="card-body">
                                    <h4 class="card-title">Zupy</h4>
                                    <p class="card-text">Znane i lubiane przez wszystkich zupy to coś bez czego nie może obejść się prawdziwy smakosz.</p>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>


        </div>

        <div  id="section3"></div>

        <div class="black-box C-1" id="sect3">
            <p class="C-3-text">Stawiamy na ciągły rozwój naszego portalu z waszą pomocą </p>  
            <p class="C-3-text">To wy razem z nami tworzycie ten portal poprzez ocenianie dań i wyrażanie własnych opinii korzystając z naszej aplikacji na telefon: </br></br>
                <a class="btn btn-info C-3-text" href="{{url('/download/Przepisy_kulinarne.apk')}}">Pobierz aplikację na Androida</a></p> 



        </div>

        <div  id="section4"></div>

        <div class="black-box C-1" id="sect4">

            <div>
                <div class="jumbotron jumbotron-sm">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <h1 class="h1">
                                    W czym możemy Ci pomóc?<small><br>Formularz kontaktowy</small></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="well well-sm">
                                <form action="mailto:biuro@przepisy-kulinarne.cba.pl" method="post" enctype="text/plain">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">
                                                    Imię i nazwisko </label>
                                                <input type="text" class="form-control" id="name" placeholder="" required="required" />
                                            </div>
                                            <div class="form-group">
                                                <label for="email">
                                                    E-mail</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                                    </span>
                                                    <input type="email" class="form-control" id="email" placeholder="" required="required" /></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="subject">
                                                    Kategoria</label>
                                                <select id="subject" name="subject" class="form-control" required="required">
                                                    <optgroup label="Wybierz kategorię wiadomości:">
                                                        <option value="customer">Obsługa klienta</option>
                                                        <option value="support">Problemy techniczne</option>
                                                        <option value="other">Inne</option>
                                                    </optgroup>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">
                                                    Wiadomość</label>
                                                <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                                          placeholder=""></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                                                Wyślij wiadomość</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <form>
                                <legend><span class="glyphicon glyphicon-globe"></span> Dane teleadresowe:</legend>
                                <address>
                                    <strong>www.przepisy-kulinarne.cba.pl</strong> <br><br>

                                    <abbr title="E-mail">
                                        E:</abbr>
                                    <a href="mailto:#">biuro@przepisy-kulinarne.cba.pl</a>
                                </address>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
$(document).ready(function () {
    $("#myCarousel").on("slide.bs.carousel", function (e) {
        var $e = $(e.relatedTarget);
        var idx = $e.index();
        var itemsPerSlide = 3;
        var totalItems = $(".carousel-item").length;

        if (idx >= totalItems - (itemsPerSlide - 1)) {
            var it = itemsPerSlide - (totalItems - idx);
            for (var i = 0; i < it; i++) {
                // append slides to end
                if (e.direction == "left") {
                    $(".carousel-item")
                            .eq(i)
                            .appendTo(".carousel-inner");
                } else {
                    $(".carousel-item")
                            .eq(0)
                            .appendTo($(this).find(".carousel-inner"));
                }
            }
        }
    });
});

                </script>
                </body>
                </html>
