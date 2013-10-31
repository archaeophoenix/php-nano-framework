<pre>
<?php
error_reporting(~E_NOTICE);
require_once 'libs/Html.php';
$tag = new Html();
if (isset($_POST['z'])) {
	print_r($_POST);
	foreach ($_POST as $key => $value) {
		${$key} = $value;
	}
}?>
</pre>

<?php
$a = ['satu'=>1,'dua'=>2,'tiga'=>3];
$tag->radio('v',$a,$v,"required");
$tag->select('w',$a,$w,"required");
$tag->checkbox('x',$a,$x);
$tag->input('text','y',$y,"autofocus placeholder='0AAA' multiple pattern='[0-9]{1}[A-Z]{3}' required title='A part number is a digit followed by three uppercase letters.'");
$tag->button('submit','z');
$tag->form();?>