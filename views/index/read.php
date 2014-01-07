<table>
	<tr>
		<td>Username</td>
		<td>Role</td>
		<td colspan="2" align="center">Action</td>
	</tr>
<?php foreach ($datas as $data) {?>
	<tr>
		<td><?php echo $data['username']; ?></td>
		<td><?php echo $data['role']; ?></td>
		<td><a href="<?php echo X."index/coba/".$data['id']; ?>" >edit</a></td>
		<td><?php if($data['role']!='owner'){?><a href="<?php echo X."index/delete/".$data['id']; ?>" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');">delete</a><?php }?></td>
	</tr>
<?php }?>
</table>