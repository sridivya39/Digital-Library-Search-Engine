<?php
require '/Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/vendor/autoload.php';
$client = Elasticsearch\ClientBuilder::create()->build();
// $hi = strip_tags($_POST[$q ?? '']);
$params = [
'index' => 'projectdata',
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
$response = $client->search($query ?? ''  );
// $score = $response['hits']['hits'][0]['_score'];
$total = $response['hits']['total']['value'];
echo
"
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

    $path = "/Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel//dissertation/".$lhnum."/";
    $dir =scandir($path);
foreach($dir as $file){
    $fname=$path.$file;
}
if(mime_content_type($fname)=='application/pdf')
{
    $name="/dissertation/".$lhnum."/".$file;
}


echo "<tr>
<td>".$title."<a role='button' class='btn btn-link' href='".$lsourceURL."' target='_blank'>Click for more details</a></td>
<td>".$lauthor."</td>
<td>".$ldeg."</td>
<td>".$lpublisher."</td>";
?>

<?php
echo"</tr>";

}
echo "</tbody></table>";


$doc = $response['hits']['hits'][0]['_source']['title'];

?>
