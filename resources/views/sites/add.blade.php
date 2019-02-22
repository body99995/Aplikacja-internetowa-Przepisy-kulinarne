@extends('layouts.app')

@section('title') Dodawanie przepisu @endsection
@section('content')



<div class="naglowek text-center">
    <h1>Dodawanie przepisu</h1>
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
<form action="{{ url('/save')}}" method="post" enctype="multipart/form-data"> 

    <input type="hidden" name="_token" value="{{csrf_token()}}">


    <div class="form-group">
        <label for="nazwaField">Nazwa przpisu</label>
        <input type="text" class="form-control" name="nazwa" placeholder="Nazwa dodawanego przpisu" required="required" title="Min 2 znaki" />
    </div>


    <div class="form-group">
        <label for="kategoria">Kategoria</label> 
        
        
        <select  class="form-control" name="kategoria" placeholder="Wybierz kategorię dania" required="required">
                <option value="" disabled selected>Wybierz kategorię dania</option>
		<option>Ciastka</option>
		<option>Drinki</option>
                <option>Napoje</option>
                <option>Przystawki</option>
                <option>Zupy</option>
	</select>
    </div>

    <div class="form-group">
        <label for="opisField">Opis przepisu</label>
        <textarea class="form-control" id="opisField" name="opis" placeholder="Podaj opis dania" required="required"  minlength="5"></textarea>
    </div>

    <div class="form-group">
        <label for="skladnikiField">Składniki</label>
        <textarea class="form-control" id="skladnikiField" name="skladniki" placeholder="Podaj składniki dania" required="required"  minlength="5"></textarea>
    </div>

    <div class="form-group">
        <label for="sposobField">Sposób przyrządzenia</label>
        <textarea class="form-control" id="sposobField" name="sposob_przyrzadznia" placeholder="Sposób przyrządzenia dania" required="required"  minlength="5"></textarea>
    </div>

    
 <!--   <div class="form-group">
        <label for="zdjecie_glowne">Zdjęcie Główne</label>
        <input type="file" id="zdjecie_glowne" name="zdjecie_glowne" required="required" accept=".png, .jpg, .jpeg" onchange="PreviewImage();" />
        <img src="" id="profile-img-tag" width="200px" />
        
        <script type="text/javascript">

    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("zdjecie_glowne").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("profile-img-tag").src = oFREvent.target.result;
        };
    };

</script>
    </div>-->
 
 
 
 
    
 
 
 <div class="form-group">
        <label for="zdjecie_glowne">Zdjęcie Główne</label>
        <input type="file" id="zdjecie_glowne" name="zdjecie_glowne" required="required" accept=".png, .jpg, .jpeg" />
        <div id="dvPreview"></div>

    </div>
    
    
    <div class="form-group">
        <label for="zdjecieDodatkowe">Zdjęcia Dodatkowe*</label>
        <input type="file" id="zdjecieDodatkowe1" name="fot1" accept=".png, .jpg, .jpeg" /> <div id="dvPreview1"></div>
        <input type="file" id="zdjecieDodatkowe2" name="fot2" accept=".png, .jpg, .jpeg" /> <div id="dvPreview2"></div>
        <input type="file" id="zdjecieDodatkowe3" name="fot3" accept=".png, .jpg, .jpeg" /> <div id="dvPreview3"></div>
    </div>

    
    <div class="form-group">
        <label for="URL_filmu">Adres filmu*</label>
        <input type="url" name="URL_filmu" class="form-control" placeholder="Podaj URL" title="Min 2 znaki"/>
    </div>
    
    



    <div class="form-group">
        <button class="btn btn-primary" >Zapisz przepis</button> 
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
            }
            else {
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
            }
            else {
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
            }
            else {
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
            }
            else {
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

@endsection
