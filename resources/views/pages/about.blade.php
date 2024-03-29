<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
@stack("styles")
<script
src="https://code.jquery.com/jquery-3.5.1.js"
integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
crossorigin="anonymous"></script>
@stack("scripts")
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
<style>
mark{
background: orange;
color: black;
}
</style>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<!-- </style> -->
<body>
<div id="app">
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
<div class="container">
<a class="navbar-brand" href="{{ url('/') }}">
Digital Library
<!-- {{ config('app.name', 'Digital Library') }} -->
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<!-- Left Side Of Navbar -->
<ul class="navbar-nav mr-auto">
</ul>
<!-- Right Side Of Navbar -->
<!-- <ul class="navbar-nav ml-auto"> -->
<ul class="navbar-nav ml-auto">
<li class="nav-item">
<a class="nav-link" href="{{ url('/save') }}">Saved Items</a>
</li>
<li class="nav-item">
<a class="nav-link" href="{{ url('/searchist') }}">Search History</a>
</li>
@guest
@if (Route::has('login'))
<li class="nav-item">
<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
</li>
@endif
@if (Route::has('register'))
<li class="nav-item">
<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
</li>
@endif
@else
<!-- <li class="nav-item">
<a class="nav-link" href="{{ url('/dissertations/saved') }}">Saved Item</a>
</li> -->
<!-- <li class="nav-item">
<a class="nav-link" href="{{ url('/profile/saved') }}">Saved Item</a> -->
<!-- </li> -->
<li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
{{ Auth::user()->name }}
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
<!-- User Profile -->
<!-- <a class="dropdown-item" href="{{ url('/profile') }}">Profile</a>
<a class="dropdown-item" href="{{ url('/saved') }}">Saved Item</a> -->
<!-- <a class="dropdown-item" href="{{ url('/profile') }}"
onclick="event.preventDefault();
document.getElementById('profile-form').submit();">
Profile
</a> -->
<!-- Logout -->
<a class="dropdown-item" href="{{ route('logout') }}"
onclick="event.preventDefault();
document.getElementById('logout-form').submit();">
{{ __('Logout') }}
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
<!-- <form id="profile-form" action="{{URL::to('/profile')}}" method="POST" class="d-none">
-->
@csrf
</form>
</div>
</li>
@endguest
</ul>
</div>
</div>
</nav>
<main class="py-4">
@yield('content')
</main>
</div>
<form action="{{URL::to('/search')}}" method="POST" role="search">
{{ csrf_field() }}
<div class="form-box">
<input type ="text" class="search" name="q" placeholder = "Search a book"> 
<img onclick="startSearch()" src="//i.imgur.com/cHidSVu.gif" />
<button class ="search-btn" type="submit"> Search</button>
</form>
<script type="text/javascript">
  function startSearch() {
    if (window.hasOwnProperty('webkitSpeechRecognition')) {
      var recognition = new webkitSpeechRecognition();
      recognition.continuous = false;
      recognition.interimResults = false;
      recognition.lang = "en-US";
      recognition.start();
      recognition.onresult = function(e) {
        document.getElementById('transcript').value
                                 = e.results[0][0].transcript;
        recognition.stop();
        document.getElementById('q').submit();
      };
      recognition.onerror = function(e) {
        recognition.stop();
      }
    }
  }
</script>


</body>
</div>
<br>
<br>
<form action="{{URL::to('/advanced_search')}}" method="POST">
{{ csrf_field() }}
<div class="form-box">
<button class ="search-btn" type="submit"> Advanced Search</button>
</form>
<br>
<br>
<form action="{{URL::to('/uploadfile')}}" method="POST">
{{ csrf_field() }} 
<button class ="search-btn" type="submit"> Add New Data</button>
</form> 
</div>
<br>
<?php
// require '/usr/local/var/elasticsearch/examples-elasticsearch/vendor/autoload.php';
// require __DIR__.'../vendor/autoload.php';
require '/Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/vendor/autoload.php';
// require 'vendor/autoload.php';
// use Elasticsearch\ClientBuilder;
$client = Elasticsearch\ClientBuilder::create()
//->setHosts($hosts)
->build();
$hi = strip_tags($_POST['q']);
$params = [
'index' => 'projectdata',
// "id" => "vXVDbXUB4eFHAaQOxlg-",
'body' => [
'query'=> [
'bool' => [
'must' => [
'multi_match' => [
'query' => 
$q ?? '',
'fields' => ['title', 'degree_name', 'contributor_author','degree_level', 'description_abstract','publisher','type','contributor_department','identifier_uri','relation_haspart']
]
]
]
],
'size'=> 100
]
];
// try{
$response = $client->search($query);
$score = $response['hits']['hits'][0]['_score'];
$total = $response['hits']['total']['value'];
echo"
<div>
<b><i><p style='font-size: 15px;'>Total results found: $total</p></b></i>
<b><i><p style='font-size: 15px;'>Searched for: $hi </p></b></i>
</div>"
;
echo '
<table class="table table-stripped" id="dt1">
<thead>
<th>Title</th>
<th>Author</th>
<th>University</th>
<th>Publisher</th>
<th>Download</th>
<th>Option</th>
<th>like</th>
</thead>
<tbody>';
foreach( $response['hits']['hits'] as $source){
$id = (isset($source['_id'])? $source['_id'] : "");
$title= (isset($source['_source']['title'])? $source['_source']['title'] : "");
$ldeg= (isset($source['_source']['degree_grantor'])? $source['_source']['degree_grantor'] : "");
$lauthor = (isset($source['_source']['contributor_author']) ? $source['_source']['contributor_author'] : "");
$lpublisher= (isset($source['_source']['publisher']) ? $source['_source']['publisher'] : "");
$lsourceURL = (isset($source['_source']['identifier_uri']) ? $source['_source']['identifier_uri'] : ""); 
$lhnum = (isset($source['_source']['handle']) ? $source['_source']['handle'] : ""); 
$lpdf = (isset($source['_source']['relation_haspart']) ? $source['_source']['relation_haspart'] : ""); 
$labs = (isset($source['_source']['description_abstract']) ? $source['_source']['description_abstract'] : ""); 
// if (is_array($lpdf)) 
// {
//     $lpdf1 = $lpdf[0];
// }
// else {
//   $lpdf1=$lpdf;
// }
    $path = "/Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/dissertation/".$lhnum."/";
    $dir =scandir($path);
foreach($dir as $file){
    $fname=$path.$file;
}
// dd($fname);
if(mime_content_type($fname)=='application/pdf')
{
    $name="/dissertation/".$lhnum."/".$file;
}
// dd($name);
echo "<tr>
<td>".$title."<a role='button' class='btn btn-link' href='".$lsourceURL."' target='_blank'>Click for more details</a></td>
<td>".$lauthor."</td>
<td>".$ldeg."</td>
<td>".$lpublisher."</td>
<td><a href= '/dissertation/27717/Swint_EB_D_2012.pdf' target='_blank' download>Download</a></td>";
// {{url('/download')}}'
// <td><a href= '{{URL::to('/') }}/Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/dissertation/27717/Swint_EB_D_2012.pdf' target='_blank'>Download</a></td>";
?>

<td><form method = 'get' action ='/saved'>
<input type='hidden' name='title' value='<? echo $title?>'/><button class='btn btn-primary'>Save</button>
</form></td>
<td><button class='btn btn-primary' id="demo" onclick="myFunction()">Like</button></td>

<?php
echo"</tr>";
}
echo "</tbody></table>";
$doc = $response['hits']['hits'][0]['_source']['title'];
?>
<script src="https://cdn.jsdelivr.net/mark.js/7.0.0/jquery.mark.min.js"></script>
<script>
$(document).ready( function () {
var table = $('#dt1').DataTable( {
"initComplete": function( settings, json ) {
$("body").unmark().mark("{{$query_string}}"); 
}
});
table.on( 'draw.dt', function () {
$("body").unmark().mark("{{$query_string}}");
} ); 
} );
$(document).on("click", ".saved", function(e) {
e.preventDefault();
$(this).url("saved");
$(document).on("click", "like", function(e) {
e.preventDefault();
$(this).text("liked");
$.ajax({
type: "post",
// url: '',
data: {
"_token": "{{ csrf_token() }}",
"id": "Hello"
},
success: function(store) {
},
error: function() {
}
});
});
});
$('.like').on('click', function(){ 
  $.ajax({ 
    type: "GET", 
    url: 'wwww.example.com/articles/slug', 
    data: {slug: 'the slug'}, 
    success: function(store){ 
    }, 
  }); 
}) 
function myFunction() {
    document.getElementById("demo").style.color = "Red";
    // document.getElementById("demo").style.text = "liked";
}
</script>
