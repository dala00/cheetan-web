<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );

function content( $data )
{
?>
<h1>ライブラリダウンロード</h1>

DBセッション用モデル<br>
<table width="90%" border="0" cellspacing="1" cellpadding="0" class="download">
  <tr>
    <td class="downloadtd" width="60%">
		同梱されているsqlを実行し、cheetan_sessionモデルをAddModel関数でモデルとして追加するだけでDBを使用したセッションになります。<br>
		<font color="red">ちいたん本体のバージョン0.7.1.9以降のみ使用可能</font>
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan_session.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan_session.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2007-05-29</td>
  </tr>
</table>
<br>
  <br>
  <?php
}


function content_eng( $data )
{
?>
<h1>Library Download</h1>

DB Session Model<br>
<table width="90%" border="0" cellspacing="1" cellpadding="0" class="download">
  <tr>
    <td class="downloadtd" width="60%">
		First of all, execute sql file. You can use DB session only to add Model 'cheetan_session'.<br>
		<font color="red">It's enable to use by Cheetan ver. 0.7.1.9〜</font>
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan_session.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan_session.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2007-05-29</td>
  </tr>
</table>
  <?php
}

?>