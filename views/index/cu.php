<article>
	<form action="<?php echo X.'index/cu/'.$this->data['id']?>" method="post">
		<table>
			<tr>
				<td>user</td>
				<td><input type="text" name="username" value="<?php echo$this->data['username']?>" ></td>
			</tr>
			<tr>
				<td>pass</td>
				<td><input type="password" name="password" value="" ></td>
			</tr>
			<tr>
				<td>role</td>
				<td><select name="role"><option value="default" <?php echo($this->data['role']=='default')? "selected='selected'":'';?> >default</option><option value="admin" <?php echo($this->data['role']=='admin')? "selected='selected'":'';?> >admin</option><option value="owner" <?php echo($this->data['role']=='owner')? "selected='selected'":'';?> >owner</option></select></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" ></td>
			</tr>
		</table>
	</form>
</article>