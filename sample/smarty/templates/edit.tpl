<form method="post" action="edit.php?id={$data.id}">
<font color="red">{$errmsg|smarty:nodefaults}</font>
TITLE<br>
<input type="text" name="blog/title" value="{$data.title|escape}"><br>
BODY<br>
<textarea cols=40 rows=6 name="blog/body">{$data.body|escape}</textarea><br>
<input type="hidden" name="blog/id" value="{$data.id}">
<input type="submit" value="UPDATE">
</form>
<a href=".">back</a>
