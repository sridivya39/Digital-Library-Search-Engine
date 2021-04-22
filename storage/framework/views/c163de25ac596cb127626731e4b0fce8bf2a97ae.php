<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet"> -->
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
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
a {
    color: #fff;
    text-decoration: none;
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
.form-control {
  color: #82375d;
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

    body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color:#fff;
  color: #82375d;
  margin: auto;
  padding: 20px;
  border: 1px solid black;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

#respond {
  margin-top: 40px;
}

#respond input[type='text'],
#respond input[type='email'],
#respond textarea {
  margin-bottom: 10px;
  display: block;
  width: 100%;
  color: #82375d;
  border: 1px solid rgba(0, 0, 0, 0.1);
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  -o-border-radius: 5px;
  -ms-border-radius: 5px;
  -khtml-border-radius: 5px;
  border-radius: 5px;
  line-height: 1.4em;

}
#respond
{
  background-color: #82375d;
  width: 90%;
  border: 2px solid white;
  border-radius: 50px 20px;
  padding: 2%;
  margin: 5%;
}

</style>
</head>
<ul>
<button onclick="goBack()" class='btn btn-link'>Go Back</button>
<li><a href="<?php echo e(url('/main/logout')); ?>"><b>Logout</b></a></li>
</ul>
<script>
        function goBack() {
          window.history.back();
        }
</script>

<p class="heading">Summary</p>

<div class="container box">
<?php if(session()->has('message')): ?>
    <div class="alert alert-success">
        <?php echo e(session()->get('message')); ?>

    </div>
  <?php endif; ?>
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
    //   $path = "/Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/dissertation/".$lhnum."/";
    //   $dir =scandir($path);
    //   foreach($dir as $file){
    //       $fname=$path.$file;
    //   }
    //   if(mime_content_type($fname)=='application/pdf')
    //   {
    //       $name="/dissertation/".$lhnum."/".$file;
    //   }
    }
       
      echo "<tr>
      <td><b>Title :</b> ".$title."
      <br>
      <br>
      <b>Author :</b> ".$lauthor."
      <br>
      <b>Handle Number :</b> ".$lhnum."
      <br>
      <b>University :</b> ".$ldeg."
      <br>
      <br>
      <b>Publisher :</b> ".$lpublisher."
      <br>
      <br>
      <b>Abstract :</b>  ".$labs."
      <br> 
      <br>
      <b>Department :</b> ".$dept."
      <br>
      <br>
      <b>Year :</b>  ".$year."
      <br>
      <br>
      <b>Degree :</b>  ".$degree_name."
      <br>
      <br>
      <b>Degree Level :</b> ".$degree_level."
      <br>
      <br>
      <b>Type :</b> ".$type."
      <br>
      <br>
      <a  href='".$lsourceURL."' target='_blank'>Source URL</a> 
      <br>
      <br>
      <a  href='".$identifierURL ."' target='_blank'>identifier URL</a> 
      <br>
      <br>

      </td>";
      ?>
    
      
       <button id="myBtn" class='btn btn-link'> Add Claim</button>

        

  <?php
      echo"</tr>";
      
      
      echo "</tbody></table>";
  
?>
<hr>
<br><br>
 <h2 style='text-align:center;'>Claims</h2>
 <?php 
//  dd($claiminfo);
 if($claiminfo != ''){
foreach($claiminfo as $key => $data){

?>
    <div id="respond">
      <div style="overflow: hidden;">
        <p style="float: right;" id='<?php echo e($data->claim_id); ?>'>
          <?php
           $email = Auth::user() -> email;
          if($data->vote_flag == 0 && $data->email == $email){
            echo "
              <i onclick='voteToggle(this)' class='fas fa-thumbs-up up' style='font-size:18px; padding: 5px;'></i>
              <b> $data->vote_count </b>
              <i onclick='voteToggle(this)' class='fas fa-thumbs-down down' style='font-size:18px; padding: 5px;'></i> 
            ";
          } elseif ($data->vote_flag == 1 && $data->email == $email){
            echo "
              <i onclick='voteToggle(this)' class='fas fa-thumbs-up up' style='font-size:18px; padding: 5px; color:#00008b;'></i>
              <b> $data->vote_count </b>
              <i onclick='voteToggle(this)' class='fas fa-thumbs-down down' style='font-size:18px; padding: 5px;'></i> 
            ";
          }elseif ($data->vote_flag == -1 && $data->email == $email){
            echo "
              <i onclick='voteToggle(this)' class='fas fa-thumbs-up up' style='font-size:18px; padding: 5px;'></i>
              <b> $data->vote_count </b>
              <i onclick='voteToggle(this)' class='fas fa-thumbs-down down' style='font-size:18px; padding: 5px;  color:#000000;'></i>
            ";
          }elseif($data->email != $email){
            echo "
              <i onclick='voteToggle(this)' class='fas fa-thumbs-up up' style='font-size:18px; padding: 5px;'></i>
              <b> $data->vote_count </b>
              <i onclick='voteToggle(this)' class='fas fa-thumbs-down down' style='font-size:18px; padding: 5px;'></i> 
            ";
          }
          ?>
          
        </p>
      </div>
      <div style="overflow: hidden;">
        <p style="float: left;"><b>Claim #:</b></p>
        <p style="margin-left: 30%;"><?php echo e($data->claim_id); ?></p>
      </div>

      <div style="overflow: hidden;">
        <p style="float: left;"><b>Claim by:</b></p>
        <p style="margin-left: 30%;"><?php echo e($data->username); ?></p>
      </div>

      <div style="overflow: hidden;">
        <p style="float: left;"><b>Claim:</b></p>
        <p style="margin-left: 30%;"><?php echo e($data->description); ?></p>
      </div>

      <div style="overflow: hidden;">
        <p style="float: left;"><b>Can you Reproduce?:</b></p>
        <p style="margin-left: 30%;"><?php echo e($data->can_reproduce); ?></p>
      </div>

      <div style="overflow: hidden;">
        <p style="float: left;"><b>Source Code:</b></p>
        <p style="margin-left: 30%;"><?php echo e($data->source_code); ?></p>
      </div>

      <div style="overflow: hidden;">
        <p style="float: left;"><b>Datasets:</b></p>
        <p style="margin-left: 30%;"><?php echo e($data->datasets); ?></p>
      </div>

      <div style="overflow: hidden;">
        <p style="float: left;"><b>Experiments and results:</b></p>
        <p style="margin-left: 30%;"><?php echo e($data->exp_results); ?></p>
      </div>

      <div style="overflow: hidden;">
        <p style="float: left;"><b>Claimed at:</b></p>
        <p style="margin-left: 30%;"><?php echo e($data->created_at); ?></p>
      </div>

      <div style="overflow: hidden;">
        <p style="float: left;"><b>email:</b></p>
        <p style="margin-left: 30%;"><?php echo e($data->email); ?></p>
      </div>
    </div>
<?php 
}
 
 }
 ?>
</div>

<form action="/main/process_claim" method="POST" role="process_claim">
    <?php echo e(csrf_field()); ?>

<div id="myModal" class="modal">
   <!-- Modal content -->
   <div class="modal-content">
      <span class="close">&times;</span>
      <label>Claim</label>
      <div class="form-group">
      <input type="hidden" name="handle_num" value="<?php echo e($lhnum); ?>"/>
         <input type="text" name="description" class="form-control" />
      </div>
      <br>
      <div class="form-group">
         <label>Can you reproduce this Claim ?</label>
         <br>
         <input type="radio" name="can_reproduce"id="yes" value ="yes" class="btn btn-secondary">
         <label for="yes">Yes</label><br>
         <input type="radio" name="can_reproduce"id="no" value ="no" class="btn btn-secondary">
         <label for="no">No</label><br>
         <input type="radio" name="can_reproduce"id="partially" value ="partially" class="btn btn-secondary">
         <label for="partially">Partially</label><br>
      </div>
      <br>
      <div class="form-group">
         <label>Proof of experiments:</label>
         <br>
         <label>Source Code:</label>
         <input type="text" name="source_code" class="form-control" />
      </div>
      <br>
      <div class="form-group">
         <label>Datasets:</label>
         <input type="text" name="datasets" class="form-control" />
      </div>
      <br>
      <div class="form-group">
         <label>Experiments and results:</label>
         <input type="text" name="exp_results" class="form-control" />
      </div>
      <div class="form-group">
      <div class="modal-footer">
         <br>
         <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </div>
   </div>
</div>
</div>
</form>

<script>

  function voteToggle(x) {
    if(x.classList.contains('down') && (x.style.color == 'rgb(217, 237, 247)' || x.style.color == '')){
      x.previousElementSibling.innerHTML = parseInt(x.previousElementSibling.innerHTML)-1;
      x.previousElementSibling.previousElementSibling.style.color= '#d9edf7';
      x.style.color= '#000000';

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "/voteUpAndDown",
        type:"POST",
        data:{
          vote_flag: 'down',
          claim_number: x.parentNode.id
        }
      });
    }
    if(x.classList.contains('up') && (x.style.color == 'rgb(217, 237, 247)' || x.style.color == '')){
      x.nextElementSibling.innerHTML = parseInt(x.nextElementSibling.innerHTML)+1;
      x.nextElementSibling.nextElementSibling.style.color= '#d9edf7';
      x.style.color= '#00008b';

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "/voteUpAndDown",
        type:"POST",
        data:{
          vote_flag: 'up',
          claim_number: x.parentNode.id
        }
      });
    }
  }

  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks the button, open the modal 
  btn.onclick = function() {
    modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/blog/resources/views/pages/summary.blade.php ENDPATH**/ ?>