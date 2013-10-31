<?php 
echo str_pad("In put/as \ das/asd.plas",1);
if(isset($_POST['y'])){
	require 'libs/Valid.php';
	require 'libs/Post.php';
	$form =  new Post();
	$form->set('test')
		 ->valid('numeric')
		 ->set('test2')
		 ->valid('minlength',2)
		 ->exception();
	$all=$form->get();
	$test=$form->get('test');
	echo "<pre>";
	print_r($form);
	print_r($all);
	echo "</pre>";
	echo $test;
}
?>
<fieldset>
<legend>asd</legend>
<form method="post" action="?">
	<input type="text" name="test">
	<input type="text" name="test2">
	<input type="checkbox" name="test2">
	<input type="submit" name="y">
</form>
</fieldset>
<?php $string = 'Abcdefghijklmnopqrstuvwxyz0123456789 ';

echo preg_match("/^ABC/i", $string)."<br>";
echo preg_match("/ \z/i", $string)."<br>";
$string = 'beg';
echo preg_match("/b[aoiu]g/", $string, $matches); ?>