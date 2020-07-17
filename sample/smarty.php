<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );

function content( $data )
{
?>
<h1>Smartyを使う</h1>

<p>コントローラークラスをオーバーライドするサンプルです。action関数内は全く変更せずにSmartyを使用することが出来ます。
ちなみに動作サンプルはチュートリアルのブログをSmarty仕様にしたものです。template_cディレクトリの属性を変更するのを忘れないようにして下さい。</p>
<br>
<table width="90%" border="0" cellspacing="1" cellpadding="0" class="download">
  <tr>
    <td class="downloadtd" width="60%">
		<a href="sample/smarty/">動作サンプル</a>
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/smartyblog.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/smartyblog.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2007-06-17</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		Controller, Viewファイルのみセット
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/smarty_libs.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/smarty_libs.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2007-06-17</td>
  </tr>
</table>
<br>
<br>

<br>
<?php
}


function content_eng( $data )
{
?>
<h1>Tutorial blog</h1>

<p>Sample of overriding Controller class and use Smarty. You can use Smarty without changing source in function 'action'.
Sample is tutorial blog with Smarty. Don't forget to change permission of template_c directory.</p>
<br>
<table width="90%" border="0" cellspacing="1" cellpadding="0" class="download">
  <tr>
    <td class="downloadtd" width="60%">
		<a href="sample/smarty/">view sample</a>
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/smartyblog.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/smartyblog.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2007-06-17</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		only Controller and View file
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/smarty_libs.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/smarty_libs.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2007-06-17</td>
  </tr>
</table>
<br>
<br>

<br>
  <?php
}

?>