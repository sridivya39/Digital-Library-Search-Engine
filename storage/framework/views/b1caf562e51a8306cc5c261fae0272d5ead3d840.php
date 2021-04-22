<!DOCTYPE html>
<html>
 <head>
  <!--<title>Simple Login System in Laravel</title>-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin-top:10%;
    border:1px solid #ccc;
   }
   body{
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #d9edf7;
    background-color: #82375d;
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
.heading{
  font-family: 'Akaya Telivigala', cursive;
  font-size:100px;
  text-align:center;
}
  </style>
 </head>
 <ul>
<button onclick="goBack()" class='btn btn-link'>Go Back</button>
<li><a href="<?php echo e(url('/deleteAll')); ?>"><b>DELETE ALL</b></a></li>
</ul>

<script>
        function goBack() {
          window.history.back();
        }
</script>
 <p class="heading">Favorites</p>
 
<div class="container">
<?php if($message ?? ''): ?>
    <div class="alert alert-success">
     <?php echo e($message ?? ''); ?>

    </div>

  <?php endif; ?>


  <?php
  
require '/Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/vendor/autoload.php';
$q = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $hnum_array);
$client = Elasticsearch\ClientBuilder::create()->build();
$params = [
  'index' => 'projectdata',
  'body' => [
    'query' => [
      'bool' => [
        'must' => [
          "terms"=> [
            "handle"=> $q
          ]
        ]
      ]
    ]
  ]
];
$response = $client->search($params);
echo '
<table class="table table-stripped" id="dt1">
<thead>
<th>Title</th>
<th>Author</th>
<th>Year</th>
<th>Details</th>
<th>Delete</th>
</thead>';
foreach( $response['hits']['hits'] as $source){
  
  $title= (isset($source['_source']['title'])? $source['_source']['title'] : "");
  $author = (isset($source['_source']['contributor_author']) ? $source['_source']['contributor_author'] : ""); 
  $year = (isset($source['_source']['date_issued']) ? $source['_source']['date_issued'] : ""); 
  $lhnum = (isset($source['_source']['handle']) ? $source['_source']['handle'] : ""); 
 
  echo "<tr>
  <td>".$title."</td>
  <td>".$author."</td>
  <td>".$year."</td>
  
  <form action='/summary' method='GET' role='summary'>
  <input type='hidden' name='q' value='".$lhnum."' />
      <td><input type='submit' name='Summary' class='btn btn-primary' value='Summary' style='font-weight:bold' /> </td>
      </form>
      <form action='/delete/{$lhnum}' method='GET' role='delete'>
          <td><input type='submit' name='Delete' class='btn btn-primary' value='Delete' style='font-weight:bold' /> </td>
          </form>
  </tr>";
}
echo "</table>";

?>
</div>


<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/blog/resources/views/pages/favouritelist.blade.php ENDPATH**/ ?>