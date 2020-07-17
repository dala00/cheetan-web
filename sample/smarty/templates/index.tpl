<p>
<a href="add.php">Write new</a>
</p>

{foreach from=$datas item=data}
<table border=1 cellpadding=8 cellspacing=0>
  <tr>
    <td>
    	{$data.title|escape}&nbsp;
    	<a href="edit.php?id={$data.id}">Edit</a>&nbsp;
    	<a href="del.php?id={$data.id}">Del</a>
    </td>
  </tr>
  <tr>
    <td>{$data.body|escape|nl2br}</td>
  </tr>
  <tr>
    <td>{$data.modified|Inittime}</td>
  </tr>
</table>
<br>
{/foreach}
