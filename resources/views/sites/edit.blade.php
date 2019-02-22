@extends('layouts.app')

@section('title') Edycja przepisu @endsection
@section('content')

<div class="naglowek text-center">
     <h1>Edycja przepisu</h1>
</div>



@if (count($errors)>0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if ($message = Session::get('success'))

<div class="alert alert-success alert-block">

    <button type="button" class="close" data-dismiss="alert">×</button>

    <strong>{{ $message }}</strong>

</div>
<img src="/upload/{{Session::get('path') }}" width="200"/>
<img src="/upload/{{Session::get('path1') }}" width="200" alt="X"/>
<img src="/upload/{{Session::get('path2') }}" width="200" alt="X"/>
<img src="/upload/{{Session::get('path3') }}" width="200" alt="X"/>

@endif

<form action="{{route('sites.update', $site->id)}}" method="post" enctype="multipart/form-data"> 

    <input type="hidden" name="_method" value="PUT">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="nazwaField">Nazwa przpisu</label>
        <input type="text" class="form-control" value="{{$site->name}}" name="nazwa" placeholder="Nazwa dodawanego przpisu" required="required"  title="Min 2 znaki" />
    </div>


    <div class="form-group">
        <label for="kategoria">Kategoria</label> 


        <select  class="form-control" name="kategoria" placeholder="Wybierz kategorię dania" >
            <!--option value="" disabled selected>{{$site->kategoria}}</option>-->
            <option value="Ciastka"{{ ( $site->category == 'Ciastka') ? ' selected' : '' }}>Ciastka</option>
            <option value="Drinki"{{ ( $site->category == 'Drinki') ? ' selected' : '' }}>Drinki</option>
            <option value="Napoje"{{ ( $site->category == 'Napoje') ? ' selected' : '' }}>Napoje</option>
            <option value="Przystawki"{{ ( $site->category == 'Przystawki') ? ' selected' : '' }}>Przystawki</option>
            <option value="Zupy"{{ ( $site->category == 'Zupy') ? ' selected' : '' }}>Zupy</option>


        </select>
    </div>

    <div class="form-group">
        <label for="opisField">Opis przepisu</label>
        <textarea class="form-control" id="opisField" name="opis" placeholder="Podaj opis dania" required="required"  minlength="5">{{$site->description}}</textarea>
    </div>

    <div class="form-group">
        <label for="skladnikiField">Składniki</label>
        <textarea class="form-control" id="skladnikiField"  name="skladniki" placeholder="Podaj składniki dania" required="required"  minlength="5">{{$site->components}}</textarea>
    </div>

    <div class="form-group">
        <label for="sposobField">Sposób przyrządzenia</label>
        <textarea class="form-control" id="sposobField" name="sposob_przyrzadznia" placeholder="Sposób przyrządzenia dania" required="required"  minlength="5">{{$site->way_of_preparation}}</textarea>
    </div>

    </br>
    <div class="form-group">
        <label for="zdjecie_glowne">Zdjęcie Główne</label>
        <div id="dvPreview">
            <img src="/upload/{{$site->main_photo }}" width="200"/></br></br>
        </div>
        <label for="zdjecie_glowne">Aby zmienić Zdjęcie Główne</label>
        <input type="file" id="zdjecie_glowne" name="zdjecie_glowne" accept=".png, .jpg, .jpeg" />

    </div>

    <!--
<div class="form-group">
    <label for="zdjecieDodatkowe">Zdjęcia Dodatkowe*</label>
    <img src="/upload/{{$site->fot1 }}" width="200"/>
    <label for="zdjecie_glowne">Aby zmienić</label>
    <input type="file" id="zdjecieDodatkowe1" name="fot1" accept=".png, .jpg, .jpeg" /> <a class="btn btn-danger" href="{{route('sites.edit', $site)}}">Usuń zdjęcie</a> <br>
    <img src="/upload/{{$site->fot2 }}" width="200"/>
    <label for="zdjecie_glowne">Aby zmienić</label>
    <input type="file" id="zdjecieDodatkowe2" name="fot2" accept=".png, .jpg, .jpeg" /> <br>
    <img src="/upload/{{$site->fot3 }}" width="200"/>
    <label for="zdjecie_glowne">Aby zmienić</label>
    <input type="file" id="zdjecieDodatkowe3" name="fot3" accept=".png, .jpg, .jpeg" />
</div> -->

    </br>
    <div class="form-group">
        <label for="zdjecieDodatkowe">Zdjęcia Dodatkowe*</label>

        </br>
        @if($site->photo1 )
        <div id="dvPreview1">
            <img src="/upload/{{$site->photo1 }}" width="200"/>
        </div>
        <label for="zdjecie_glowne">Aby zmienić</label>       
        @else
        <div id="dvPreview1"></div>
        <label for="zdjecie_glowne">Wybierz zdjęcie</label>       
        @endif
        <input type="file" id="zdjecieDodatkowe1" name="fot1" accept=".png, .jpg, .jpeg" /> <a class="btn btn-danger" id="fot1usun">Usuń zdjęcie</a> <br>
        </br>

        @if($site->photo2 )
        <div id="dvPreview2">
            <img src="/upload/{{$site->photo2 }}" width="200"/>
        </div>
        <label for="zdjecie_glowne">Aby zmienić</label>
        @else
        <div id="dvPreview2"></div>
        <label for="zdjecie_glowne">Wybierz zdjęcie</label>
        @endif
        <input type="file" id="zdjecieDodatkowe2" name="fot2" accept=".png, .jpg, .jpeg" /> <a class="btn btn-danger" id="fot2usun">Usuń zdjęcie</a> <br>
        </br>

        @if($site->photo3 )
        <div id="dvPreview3">
            <img src="/upload/{{$site->photo3 }}" width="200"/>
        </div>
        <label for="zdjecie_glowne">Aby zmienić</label>
        @else
        <div id="dvPreview3"></div>
        <label for="zdjecie_glowne">Wybierz zdjęcie</label>
        @endif
        <input type="file" id="zdjecieDodatkowe3" name="fot3" accept=".png, .jpg, .jpeg" /> <a class="btn btn-danger" id="fot3usun">Usuń zdjęcie</a> 
    </div>

    </br>
    <div class="form-group">
        <label for="URL_filmu">Adres filmu*</label>
        <input type="url" value="{{$site->URL_video}}" name="URL_filmu" class="form-control" placeholder="Podaj URL" title="Min 2 znaki"/>
    </div>


    </br>
    <div class="form-group">
        <button class="btn btn-primary" >Zmień przepis</button> 
        <a class="btn btn-info" href="{{url("/console")}}">Wróć</a>
    </div>
    *Opcjonalne
    </br></br>
</form>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
$(function () {
    $("#zdjecie_glowne").change(function () {
        $("#dvPreview").html("");
        var regex = /^([a-zA-Zęółśążźćń0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
        if (regex.test($(this).val().toLowerCase())) {
            if ($.browser.msie && parseFloat(jQuery.browser.version) <= 9.0) {
                $("#dvPreview").show();
                $("#dvPreview")[0].filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = $(this).val();
            } else {
                if (typeof (FileReader) != "undefined") {
                    $("#dvPreview").show();
                    $("#dvPreview").append("<img width='200px'/>");
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#dvPreview img").attr("src", e.target.result);
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            }
        }
    });
});
</script>

<script language="javascript" type="text/javascript">
    $(function () {
        $("#zdjecieDodatkowe1").change(function () {
            $("#dvPreview1").html("");
            var regex = /^([a-zA-Zęółśążźćń0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            if (regex.test($(this).val().toLowerCase())) {
                if ($.browser.msie && parseFloat(jQuery.browser.version) <= 9.0) {
                    $("#dvPreview1").show();
                    $("#dvPreview1")[0].filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = $(this).val();
                } else {
                    if (typeof (FileReader) != "undefined") {
                        $("#dvPreview1").show();
                        $("#dvPreview1").append("<img width='200px'/>");
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $("#dvPreview1 img").attr("src", e.target.result);
                        }
                        reader.readAsDataURL($(this)[0].files[0]);
                    } else {
                        alert("This browser does not support FileReader.");
                    }
                }
            }
        });
    });
</script>

<script language="javascript" type="text/javascript">
    $(function () {
        $("#zdjecieDodatkowe2").change(function () {
            $("#dvPreview2").html("");
            var regex = /^([a-zA-Zęółśążźćń0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            if (regex.test($(this).val().toLowerCase())) {
                if ($.browser.msie && parseFloat(jQuery.browser.version) <= 9.0) {
                    $("#dvPreview2").show();
                    $("#dvPreview2")[0].filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = $(this).val();
                } else {
                    if (typeof (FileReader) != "undefined") {
                        $("#dvPreview2").show();
                        $("#dvPreview2").append("<img width='200px'/>");
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $("#dvPreview2 img").attr("src", e.target.result);
                        }
                        reader.readAsDataURL($(this)[0].files[0]);
                    } else {
                        alert("This browser does not support FileReader.");
                    }
                }
            }
        });
    });
</script>

<script language="javascript" type="text/javascript">
    $(function () {
        $("#zdjecieDodatkowe3").change(function () {
            $("#dvPreview3").html("");
            var regex = /^([a-zA-Zęółśążźćń0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            if (regex.test($(this).val().toLowerCase())) {
                if ($.browser.msie && parseFloat(jQuery.browser.version) <= 9.0) {
                    $("#dvPreview3").show();
                    $("#dvPreview3")[0].filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = $(this).val();
                } else {
                    if (typeof (FileReader) != "undefined") {
                        $("#dvPreview3").show();
                        $("#dvPreview3").append("<img width='200px'/>");
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $("#dvPreview3 img").attr("src", e.target.result);
                        }
                        reader.readAsDataURL($(this)[0].files[0]);
                    } else {
                        alert("This browser does not support FileReader.");
                    }
                }
            }
        });
    });
</script>

<script language="javascript" type="text/javascript">
    $(function () {
        $("#fot1usun").click(function () {
            $("#dvPreview1").html("");

            $("#dvPreview1").show();
            $("#dvPreview1").append("<img width='200px'/>"); //nadpisanie znacznika <img
            $("#dvPreview1 img").attr("src", ''); //dodanie do znacznika img atrybutu src

            $("#dvPreview1").append("<input type='text'  name='usun1' value='usun' hidden readonly/>"); //dodanie ukrytego inputa służącego do weryfikacji usunięcia zdjęcia
            $("#zdjecieDodatkowe1").val(''); //resetowanie wybranego w input fille zdjęcia
        }
        );
    });

    $(function () {
        $("#fot2usun").click(function () {
            $("#dvPreview2").html("");

            $("#dvPreview2").show();
            $("#dvPreview2").append("<img width='200px'/>"); //nadpisanie znacznika <img
            $("#dvPreview2 img").attr("src", ''); //dodanie do znacznika img atrybutu src

            $("#dvPreview2").append("<input type='text'  name='usun1' value='usun' hidden readonly/>"); //dodanie ukrytego inputa służącego do weryfikacji usunięcia zdjęcia
            $("#zdjecieDodatkowe2").val(''); //resetowanie wybranego w input fille zdjęcia
        }
        );
    });

    $(function () {
        $("#fot3usun").click(function () {
            $("#dvPreview3").html("");

            $("#dvPreview3").show();
            $("#dvPreview3").append("<img width='200px'/>"); //nadpisanie znacznika <img
            $("#dvPreview3 img").attr("src", ''); //dodanie do znacznika img atrybutu src

            $("#dvPreview3").append("<input type='text'  name='usun1' value='usun' hidden readonly/>"); //dodanie ukrytego inputa służącego do weryfikacji usunięcia zdjęcia
            $("#zdjecieDodatkowe3").val(''); //resetowanie wybranego w input fille zdjęcia
        }
        );
    });
</script>
@endsection
