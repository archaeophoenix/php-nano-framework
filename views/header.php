<html>
<head>
	<title></title>
</head>
<body>
<?php $style='style="text-decoration:none;color: #000"';
if(Session::get('log')==true){?>
	<a href="<?php echo X;?>" <?php echo(!isset($_GET['x']))?$style:''; ?> >index</a>
	<a href="<?php echo X.'person';?>" <?php echo($_GET['x']=='person')?$style:''; ?> >person</a>
<?php if(Session::get('role')=='owner'){?>
	<a href="<?php echo X."index/coba";?>" <?php echo($_GET['x']=='index/coba')?$style:''; ?> >input</a>
	<a href="<?php echo X."index/read";?>" <?php echo($_GET['x']=='index/read')?$style:''; ?> >read</a>
<?php }?>
	<a href="<?php echo X;?>index/logout">logout</a>
<?php }?>