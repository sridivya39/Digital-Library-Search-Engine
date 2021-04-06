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

}
</style>
</head>
<div class="container box">
<?php
  require '/Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/vendor/autoload.php';
  // $q = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $query_string);
  $client = Elasticsearch\ClientBuilder::create()->build();
  $params = [
    'index' => 'projectdata',
    'body' => [
      'query' => [
        'bool' => [
          'must' => [
            'multi_match' => [
              'query' => $q ?? '',
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
    foreach( $response['hits']['hits']as $source){
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
      $year = (isset($source['_source']['date_issued']) ? $source['_source']['date_issued'] : "");
      $degree_name = (isset($source['_source']['degree_name']) ? $source['_source']['degree_name'] : "");
      $degree_level = (isset($source['_source']['degree_level']) ? $source['_source']['degree_level'] : "");
      $type =  (isset($source['_source']['type']) ? $source['_source']['type'] : "");
      $identifierURL =  (isset($source['_source']['identifier_uri']) ? $source['_source']['identifier_uri'] : "");
      $path = "/Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/dissertation/".$lhnum."/";
      $dir =scandir($path);
      foreach($dir as $file){
          $fname=$path.$file;
      }
      if(mime_content_type($fname)=='application/pdf')
      {
          $name="/dissertation/".$lhnum."/".$file;
      }
    }
       
      echo "<tr>
      <td><b>Title :</b> ".$title."
      <br>
      <b>Author :</b> ".$lauthor."
      <br>
      <b>University :</b> ".$ldeg."
      <br>
      <b>Publisher :</b> ".$lpublisher."
      <br>
      <b>Abstract :</b>  ".$labs."
      <br>
      <b>Department :</b> ".$dept."
      <br>
      <b>Year :</b>  ".$year."
      <br>
      <b>Degree :</b>  ".$degree_name."
      <br>
      <b>Degree Level :</b> ".$degree_level."
      <br>
      <b>Type :</b> ".$type."
      <br>
      <b>Source URL:</b> ".$lsourceURL ."
      <br>
      <b>Identifier URL:</b> ".$identifierURL ."
      <br>

      </td>";
      ?>
    
       <button onclick="goBack()" class='btn btn-link'>Go Back</button>

        <script>
        function goBack() {
          window.history.back();
        }
        </script>
  <?php
      echo"</tr>";
      
      
      echo "</tbody></table>";
  
?>
</div>