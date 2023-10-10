<!DOCTYPE html>
<html>
<head>
	<!-- <title>Editor</title> -->

<script src="tinymce.min.js"></script>

<script>
	
tinymce.init({

selector: '#myTextarea',
height:350,
// width: 50%;

// placeholder: 'Type here...',

plugins: [

'emoticons template paste textcolor colorpicker textpattern imagetools'
],

theme: 'modern',
toolbar1: 'insertfile undo redo | styleselect | bold italic ',
toolbar2: 'print preview media | forecolor backcolor emoticons | alignleft aligncenter alignright alignjustify',

// toolbar: [
//     {
//       name: 'history', items: [ 'undo', 'redo' ]
//     },
//     {
//       name: 'styles', items: [ 'styleselect' ]
//     },
//     {
//       name: 'formatting', items: [ 'bold', 'italic']
//     },
//     {
//       name: 'alignment', items: [ 'alignleft', 'aligncenter', 'alignright', 'alignjustify' ]
//     },
//     {
//       name: 'indentation', items: [ 'outdent', 'indent' ]
//     }
//   ],
 // toolbar_mode: 'floating',


    // toolbar_mode: 'scrolling',
    // toolbar_location: 'bottom',

image_advtab: true,
// align:center

// removed_menuitems: 'undo, redo',

 // toolbar: false
// menu: {
//     file: { title: 'File', items: 'newdocument restoredraft | preview | print ' },
//     edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },
//     view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen' },
//     insert: { title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },
//     format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat' },
//     tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount' },
//     table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' },
//     help: { title: 'Help', items: 'help' }
//   }

});

</script>

</head>
<body>
<!-- <form action="index.php" method="post">
	<textarea name="myTextarea" id="myTextarea"></textarea>

<input type="submit" name="save" value="save">


</form>

</body> -->
</html>


<?php



if(isset($_POST['save'])){


	echo "Modjkshfk";

$myTextarea = $_POST['myTextarea'];

var_dump($myTextarea);


}

?>