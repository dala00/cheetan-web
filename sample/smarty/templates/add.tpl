<form method="post" action="add.php">
<font color="red">{$errmsg|smarty:nodefaults}</font>
TITLE<br>
<input type="text" name="blog/title"><br>
BODY<br>
<textarea cols=40 rows=8 name="blog/body"></textarea><br>
<input type="submit" value="WRITE">
</form>