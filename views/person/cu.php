<article>
	<form method="post" enctype="multipart/form-data" action="<?php echo X.'person/cu/'.$this->data['id'];?>">
		<table>
			<tr>
				<td>nama</td>
				<td><input type="text" name="nama" value="<?php echo$this->data['nama']?>"></td>
			</tr>
			<tr>
				<td>alamat</td>
				<td><textarea name="alamat"><?php echo$this->data['alamat']?></textarea>
			</tr>
			<tr>
				<td>tanggal lahir</td>
				<td><input type="date" name="tanggal" value="<?php echo$this->data['tanggal']?>"></td>
			</tr>
			<tr>
				<td>jenis kelamin</td>
				<td>laki-laki<input type="radio" name="kelamin" value="L" <?php echo($this->data['kelamin']=='L') ? 'checked="checked"' : '' ;?> >
					perempuan<input type="radio" name="kelamin" value="P" <?php echo($this->data['kelamin']=='P') ? 'checked="checked"' : '' ;?> ></td>
			</tr>
			<tr>
				<td>photo</td>
				<td><input type="file" name="photo">
				<input type="hidden" value="<?php echo$this->data['photo']?>" name="photo1"></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" ></td>
			</tr>
		</table>
	</form>
</article>