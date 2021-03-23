<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <h3>Advanced Search</h3>
        <br>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
 </head>
       <body>
       <form action="{{URL::to('/search')}}" method="post" role="search">
		  <div class="form-box">
          <label for="title"><b>Title</b></label>
		  <input type ="text" class="search" name="title" >
          <br>
          <label for="author"><b>Author</b></label>
		<input type ="text" class="search" name="author" > 
          <br>
          <label for="name"><b>University</b></label>
		<input type ="text" class="search" name="university" > 
          <br>
         <label for="unv"><b>Name of the degree</b></label>
		<input type ="text" class="search" name="degree_name" > 
          <br>
        <label for="dpt"><b>Department</b></label>
		<input type ="text" class="search" name="dept" > 
          <br>
        <!-- <label for="dpt"><b>Department</b></label>
		<input type ="text" class="search" name="d" > 
          <br> -->
        <button type="submit">Search</button>
        <button type="submit">Back</button>
        <br>
        <br>
      </form>
                </div>
                </body>

<?php
// require '/usr/local/var/elasticsearch/examples-elasticsearch/vendor/autoload.php';
// require __DIR__.'../vendor/autoload.php';
require '/Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/vendor/autoload.php';
// require 'vendor/autoload.php';
// use Elasticsearch\ClientBuilder;
$client = Elasticsearch\ClientBuilder::create()
//->setHosts($hosts)
->build();
// $advparams = [
//   'index' => 'projectdata',
// //   "id" => "vXVDbXUB4eFHAaQOxlg-",
//   'body'  => [
//       'query'=> [
//          'bool' => [
//              'must' => [
//                  'match' => [
//                      'title' => $title ?? '',
//                  ],
//                  'match' =>[
//                      'contributor_author' => $author ?? '',
//                  ],
//                  'match' => [
//                      'degree_grantor' => $university ?? '',
//                  ],
//                 'match' => [
//                     'degree_name' => $degreename ?? '',
//                 ],
//                 'match' => [
//                     'contributor_department' => $departmentname ?? '',
//                 ],
    
//                  ]
//              ]
//                  ],
//     'size'=> 50
//          ]
// ];
try{
$response = $client->withquery($advParams);
$score = $response['hits']['hits'][0]['_score'];
echo"
    <div>
       <b><i><p style='font-size: 15px;'>Total results found: ".sizeof($response['hits']['hits'][0]['_source'])."</p></b></i>
    </div>"
;
foreach( $response['hits']['hits'] as $source){
    echo "
    <div style='marigin: 10%'>
      <div style='border: 2px solid black; margin: 1%'>
        <b><p style='font-size:20px;'>".$source['_source']['title']."</p></b>
        <i><p class='type'>".$source['_source']['contributor_author']."</p></i>
        <i><p class='type'>".$source['_source']['degree_grantor']."</p></i>
        <p>".$source['_source']['publisher']."</p>
         <a href=".$source['_source']['identifier_sourceurl'].">PDF details</a>   
        <p> ".$source['_source']['description_abstract']." </p>  
      </div>
    </div>";
    // <p> ".$source['_source']['relation_haspart']." </p>
      // foreach($source['relation_haspart'] as $pdf){
      // echo "<p>".$pdf."</p>
      // </div>";
      // }
}      
$doc = $response['hits']['hits'][0]['_source']['title'];
}
catch(Exception $e) {
    // var_dump($e->getMessage());
}
?>
