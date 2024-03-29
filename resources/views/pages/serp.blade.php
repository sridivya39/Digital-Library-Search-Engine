<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
mark{
background: white;
color: #82375d;
}
.box{
    width:1200px;
    margin-top:10%;
    
   }
.btn-primary {
    color: #82375d;
    background-color: #e8e6e6;
    border-color: #999;
}
.btn-link {
    color: #82375d;
    background-color: #e8e6e6;
    border-color: #999;
}
   body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #d9edf7;
    background-color: #82375d;
    }
    .head{
    font-family: 'Akaya Telivigala', cursive;
    font-size:50px;
    text-align:center;
    }
    .heading{
    font-family: 'Akaya Telivigala', cursive;
    font-size:100px;
    text-align:center;
    }
    ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #dddddd;
  }

  li {
    float: right;
  }

  li a {
    color: #82375d;
    display: block;
    padding: 8px;
  }
    .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
      color: #d9edf7;
    }
    .dataTables_wrapper .dataTables_filter input {
    border: 1px solid #aaa;
    border-radius: 3px;
    padding: 5px;
    background-color: #e8e6e6;
    color: #82375d;
    margin-left: 3px;
}
.dataTables_wrapper .dataTables_length select {
    border: 1px solid #aaa;
    border-radius: 3px;
    padding: 5px;
    background-color: white;
    color: #82375d;
    padding: 4px;
}
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    background-color: #82375d;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
    box-sizing: border-box;
    display: inline-block;
    min-width: 1.5em;
    padding: 0.5em 1em;
    margin-left: 2px;
    text-align: center;
    text-decoration: none !important;
    cursor: pointer;
    cursor: hand;
    color: white;
    background-color: #82375d;
    border: 1px solid transparent;
    border-radius: 2px;
}
</style>
</head>
<ul>
  <li><a href="/adv_search"><b>Advance Search</b></a></li>
  <li><a href="{{URL::route('MainController')}}"><b>Login</b></a></li>
  <li><a href=/Signup><b>Register</b></a></li>
  <button onclick="goBack()" class='btn btn-link'><b>HOME</b></button>

<script>
function goBack() {
  window.history.back();
}
</script>

</ul>
<p class="heading">Just Question</p>
<body>
<script>
var recognition = new webkitSpeechRecognition();

recognition.onresult = function(event) { 
  var saidText = "";
  for (var i = event.resultIndex; i < event.results.length; i++) {
    if (event.results[i].isFinal) {
      saidText = event.results[i][0].transcript;
    } else {
      saidText += event.results[i][0].transcript;
    }
  }
  // Update Textbox value
  document.getElementById('speechText').value = saidText;
 
  // Search Posts
  searchPosts(saidText);
}

function startRecording(){
  recognition.start();
}

</script>

<div class="container box">
<form action="/search" method="POST" role="search">
    {{ csrf_field() }}
    <div class="input-group" style="margin:20px;">
        <input type="text" class="form-control" name="q"  id='speechText'
            placeholder="Search"> <span class="input-group-btn">
            <div class="form-group" style="margin-left:20px;">
                <input type="submit" name="Submit" class="btn btn-primary" value="Submit" style="font-weight:bold" /> 
                <input type='button' id='start' value='Speak' class="btn btn-primary" style="font-weight:bold" onclick='startRecording();'>
                </form> 
                </div> 
    </div>

  <form action="{{URL::to('/adv_search')}}" method="GET">
  {{ csrf_field() }}
  <br>
  <div class="form-group" style="margin-left:20px;">
                <input type="submit" name="Advanced Search" class="btn btn-primary" value="Advanced Search" style="font-weight:bold" />
                     </form> 
                     </div> 
  <br>
  <form action="{{URL::to('/uploadfile')}}" method="GET">
  {{ csrf_field() }} 
  <div class="form-group" style="margin-left:20px;">
                <input type="submit" name="Add new Data" class="btn btn-primary" value="Add new Data" style="font-weight:bold" />
  </form> 
  </div>
  
</body>

<div class="container box">
<?php
  require '/Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/vendor/autoload.php';
  $q = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $query_string);
  $client = Elasticsearch\ClientBuilder::create()->build();
  $hi = strip_tags($_POST['q']);
  $params = [
    'index' => 'projectdata',
    'body' => [
      'query' => [
        'bool' => [
          'must' => [
            'multi_match' => [
              'query' =>
              $q ?? '',
              'fields' => ['title', 'degree_name', 'contributor_author', 'degree_level', 'description_abstract', 'publisher', 'type', 'contributor_department', 'identifier_uri', 'relation_haspart']
            ]
          ]
        ]
      ],
      'size' => 1000
    ]
  ];

  $response = $client->search($query);
  $total = $response['hits']['total']['value'];
  if ($total == 0){
    echo'<div style="text-align:center;" class="alert alert-danger success-block">';
    // echo '<h5>No Results Found..!</h5>';
     echo '<p class="head">No Results Found..!</p>';
    // echo '<script>alert("Not a valid Search")</script>';
  }
  else{
    $score = $response['hits']['hits'][0]['_score'];

    echo
    "<div>
    <b><i><p style='font-size: 15px;'>Total results found: $total</p></b></i>
    <b><i><p style='font-size: 15px;'>Searched for: $hi </p></b></i>
    </div>";
    echo 
    '<table class="table table-stripped" id="dt1">
    <thead>
    <th>Title</th>
    <th>Download</th>
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
      $dept = (isset($source['_source']['contributor_department']) ? $source['_source']['contributor_department'] : ""); 
      
      $path = "/Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/dissertation/".$lhnum."/";
    
      $dir =scandir($path);
      foreach($dir as $file){
      $fname=$path.$file;
      }
    if(mime_content_type($fname)=='application/pdf')
    {
        $name="/dissertation/".$lhnum."/".$file;
    }

    // <td><a href='".$name."' target='_blank' class='btn btn-primary' download>Download</a>
    
      echo "<tr>
      <td>".$title."
      <br>
      <br>
      <a role='button' class='btn btn-link' href='".$lsourceURL."' target='_blank'><b>Click for more details</b></a> 
      <form action='/summ' method='GET' role='summary'>
      <br>
      <input type='hidden' name='q' value='".$lhnum."' />
      <input type='submit' name='Summary' class='btn btn-primary' value='Summary' style='font-weight:bold' /> 
      </form>
      <br>
      <form method='GET' action='/download'>
        <input type='hidden' name='q' value='".$lhnum."' />
        <td><button class='btn btn-primary' type='submit'>Download</button></td>
      </form>
      </td>";
    ?>
      

    <?php
      echo"</tr>";
      
      }
      echo "</tbody></table>";
    
    }

    ?>
    
</div>


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
  }); 
} );

</script>