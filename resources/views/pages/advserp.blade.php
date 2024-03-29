<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    background-color: #82375d;
    }

  </style>
 </head>
  <br />
<p class="heading">Just Question</p>
<body>

<div class="container box">
<form action="/search" method="POST" role="search">
    {{ csrf_field() }}
    <div class="input-group" style="margin:20px;">
        <input type="text" class="form-control" name="q"
            placeholder="Search"> <span class="input-group-btn">
            <div class="form-group" style="margin-left:20px;">
                <input type="submit" name="Submit" class="btn btn-primary" value="Submit" style="font-weight:bold" />
                </form> 
                </div> 
    </div>

  <form action="{{URL::to('/uploadfile')}}" method="POST">
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
  // $hi = strip_tags($_POST['q']);
  $params = [
    'index' => 'projectdata',
    'body' => [
      'query' => [
        'bool' => [
          'must' => [
            'multi_match' => [
              'query' => $q,
              'fields' => ['handle','contributor_author','title','type','subject','description_abstract','degree_grantor'.
              'contributor_department','contributor_committeemember','contributor_committeechair','publisher']
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
    // echo '<script>alert("Not a valid Search")</script>';echo '<script>alert("Not a valid Search")</script>';
  }
  else{
    $score = $response['hits']['hits'][0]['_score'];

    echo
    "<div>
    <b><i><p style='font-size: 15px;'>Total results found: $total</p></b></i>
    
    </div>";
    echo 
    '<table class="table table-stripped" id="dt1">
    <thead>
    <th>Title</th>
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
      
      $path = "/Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/dissertation/".$lhnum."/";
      $dir =scandir($path);
      foreach($dir as $file){
          $fname=$path.$file;
      }
      if(mime_content_type($fname)=='application/pdf')
      {
          $name="/dissertation/".$lhnum."/".$file;
      }
      
      echo "<tr>
      <td>".$title."<a role='button' class='btn btn-link' href='".$lsourceURL."' target='_blank'>Click for more details</a>
      <a role='button' class='btn btn-link' href='/summary' target='_blank'>Summary</a></td>
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