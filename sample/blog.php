<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );

function content( $data )
{
?>
<h1>チュートリアルブログ</h1>

<p>チュートリアルのブログです。</p>
<br>
<table width="90%" border="0" cellspacing="1" cellpadding="0" class="download">
  <tr>
    <td class="downloadtd" width="60%">
		<a href="sample/blog/">動作サンプル</a>
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/tutorialblog.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/tutorialblog.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-10-9</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		TextSQLバージョン<br>
		ダウンロードしてblog_data.txtの属性を書き込み可にすればそのまま使用できます。
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/tutorialblog_t.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/tutorialblog_t.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-10-9</td>
  </tr>
</table>
<br>
  <br>
  <?php
}


function content_eng( $data )
{
?>
<h1>Tutorial blog</h1>

<p>Blog of tutorial.</p>
<br>
<table width="90%" border="0" cellspacing="1" cellpadding="0" class="download">
  <tr>
    <td class="downloadtd" width="60%">
		<a href="sample/blog/">view sample</a>
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/tutorialblog.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/tutorialblog.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-10-9</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		TextSQL version<br>
		Change blog_data.txt to writable.<br>
		You have to do is only it.
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/tutorialblog_t.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/tutorialblog_t.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-10-9</td>
  </tr>
</table>
<br>
  <br>
  <?php
}

?>