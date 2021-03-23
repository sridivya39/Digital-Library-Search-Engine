<?php
echo
"<div>
<b><i><p style='font-size: 15px;'>Total results found: $total</p></b></i>

</div>"
;
echo 
'<table class="table table-stripped" id="dt1">
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
    $path = "/Applications/XAMPP/xamppfiles/htdocs/sridivyamajeti/laravel/dissertation".$lhnum."/";
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
<td>".$lpublisher."</td>
<td><a href= $name target='_blank' download>Download</a></td>";
?>

<td><form method = 'get' action ='/saved'>
<input type='hidden' name='title' value='<? echo $title?>'/><button class='btn btn-primary'>Save</button>
</form></td>
<td><button class='btn btn-primary' id="demo" onclick="myFunction()">Like</button></td>

<?php
echo"</tr>";

}
echo "</tbody></table>";


// $doc = $response['hits']['hits'][0]['_source']['title'];
?>
<script src="https://cdn.jsdelivr.net/mark.js/7.0.0/jquery.mark.min.js"></script>
<script>
$(document).ready( function () {
var table = $('#dt1').DataTable( {
"initComplete": function( settings, json ) {
$("body").unmark().mark("{{$param ?? ''}}"); 
}
});
table.on( 'draw.dt', function () {
$("body").unmark().mark("{{$param ?? ''}}");
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



<!-- // <b><p style ='font-size:15px;'>Searched for: $q ??''</p></b> -->
