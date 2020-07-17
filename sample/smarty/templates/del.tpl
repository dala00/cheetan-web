<form method="post" action="del.php">
Delete OK?<br>
TITLE<br>
{$data.title|escape}<br>
BODY<br>
{$data.body|escape|nl2br}<br>
<input type="hidden" name="id" value="{$data.id}">
<input type="submit" value="DELETE">
<a href=".">back</a>
</form>