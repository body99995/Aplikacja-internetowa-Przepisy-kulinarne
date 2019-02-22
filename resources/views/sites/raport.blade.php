

@extends('layouts.app')

@section('title') Statystyki @endsection
@section('content')

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


<div class="naglowek text-center">
    <h1>Statystyki</h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="form-group ">
            <h2>Nowi użytkownicy:</h2> 
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">    
            <select class="form-control" name="new_users" onclick="changeFunc(value)">
                <option selected value="1">Ostatnie 7 dni</option>
                <option value="2">Ostatnie 30 dni</option> 
            </select>

        </div>
    </div>
</div>

<div id="default" style="display: block">
    <table class="table table-hover" >
        <!--<h5>Liczba nowych użytkowników:{$android_users->total()}</h5><br>-->
        <h5>Liczba nowych użytkowników:{{count($android_users_counts)}}</h5><br>
        
        @foreach($android_users as $android_user)
        
        @endforeach
    </table>
    <!--{ $android_users->links() }-->
    
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
</div>

<div id="nodefault" style="display: block">
    <table class="table table-hover" >
        <!--<h5>Liczba nowych użytkowników:{$android_users30days->total(}}</h5><br>-->
        <h5>Liczba nowych użytkowników:{{count($android_users30days_counts)}}</h5><br>
        @foreach($android_users30days as $android_users30day)
        
        @endforeach
    </table>
    <!--{ $android_users30days->links() }-->
    
    <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
</div>

<script type="text/javascript">

    function changeFunc($i) {
        //alert($i);
        if ($i == 1) {
            document.getElementById('nodefault').style.display = 'none';
            document.getElementById('default').style.display = 'block';
            
        } else {
            document.getElementById('default').style.display = 'none';
            document.getElementById('nodefault').style.display = 'block';
        }
    }

</script>


<br><br><br><br><br>


<h2>Liczba przepisów:</h2> 
<table class="table table-hover">
    @foreach($count_recipes as $count_recipe)
    <tr>
        <td>{{$count_recipe->category}}</td> 
        <td>{{$count_recipe->ilosc}}</td>        

    </tr>
    @endforeach
</table>

<br><br><br>



<div class="form-group">     
    <a class="btn btn-info" href="{{url("/console")}}">Wróć</a>
</div>

<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	exportEnabled: true,
	title: {
		text: "Ostatnie 7 dni"
	},
	axisY: {
		title: "Liczba nowych użytkowników"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($android_users, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

var chart2 = new CanvasJS.Chart("chartContainer2", {
        exportEnabled: true,
	title: {
		text: "Ostatnie 30 dni"
	},
	axisY: {
		title: "Liczba nowych użytkowników"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($android_users30days, JSON_NUMERIC_CHECK); ?>
	}]
});
chart2.render();
 document.getElementById('nodefault').style.display = 'none';
};
</script>

@endsection
