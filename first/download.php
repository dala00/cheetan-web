<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );

function content( $data )
{
?>
<h1>ダウンロード</h1>

<p> 基本的に<a href="https://sourceforge.jp/projects/cheetan/" target="_blank">sourceforge</a>のCVSにあるものが最新の場合が多いです。</p>
最新バージョン<br>
<table width="90%" border="0" cellspacing="1" cellpadding="0" class="download">
  <tr>
    <td class="downloadtd" width="60%">
		0.8.1.0<br>
		model.phpのquery関数修正<br />
		modelにdescribe関数追加
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.8.1.0.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.8.1.0.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2009-09-14</td>
  </tr>
</table>
<br>
以前のバージョン
<table width="90%" border="0" cellspacing="1" cellpadding="0" class="download">
  <tr>
    <td class="downloadtd" width="60%">
		0.8.0.8<br>
	    MySQLにポート指定追加bugfix<br>
		validateを複数指定できるように仕様拡張
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.8.0.8.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.8.0.8.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2008-02-23</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.7.9.9<br>
		PgSQLのバグfix<br>
	    MySQLにポート指定追加<br>
		modelに一部自動エスケープを追加<br>
		condition指定に配列仕様追加<br>
		view上の変数参照を拡張($data['var'] から $var でアクセス出来るように)
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.9.9.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.9.9.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2008-02-20</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.7.8.2<br>
		PgSQLのバグfix<br>
      PgSQLにポート指定追加<br>
      $db-&gt;add( &quot;pg&quot;, &quot;host&quot;, &quot;user&quot;, &quot;password&quot;, 
      &quot;dbname&quot;, DBKIND_PGSQL, &quot;port&quot; ); <br>
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.8.2.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.8.2.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2007-07-06</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.7.5.6<br>
		SQLロギングを追加<br>
		複数データベース利用時処理のバグ修正<br>
		モデルにSQL実行情報取得関数を追加<br>
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.5.6.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.5.6.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2007-06-01</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.7.1.9<br>
		DB周りを変更。(無駄な接続の排除、escape関数）<br>
		DISPATCHの実行順序変更<br>
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.1.9.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.1.9.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2007-05-29</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.7.0.9<br>
		主にバグ修正。<br>
		pgsqlのfind関数のバグ<br>
		notemptyの修正<br>
		textsqlロックし忘れ<br>
		textsqlに「start,limit」形式指定追加<br>
		メールアドレスのバリデート
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.0.9.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.0.9.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2007-05-13</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.7.0.1<br>
		コンフィグ関数にconfig_view_class関数を追加<br>
		コントローラにSetViewPath関数を追加<br>
		不必要なsql操作クラス(db以下)を削除しても良いように修正
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.0.1.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.0.1.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-11-04</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.6.1.2<br>
		コンフィグ関数にconfig_controller_class関数を追加
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.6.1.2.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.6.1.2.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-10-20</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.5.9.8<br>
		コンポーネントの概念を追加<br>
		コンフィグ関数にafter_action関数を追加
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.5.9.8.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.5.9.8.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-10-14</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.5.7.7<br>
		TextSQLに対応<br>
		データベース周りの修正など
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.5.7.7.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.5.7.7.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-10-7</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.0.0.7<br>
		PostgreSQLに対応
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.0.7.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.0.7.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-9-26</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.0.0.3<br>
		バリデータemail関数のバグ修正<br>
		モデルにfindby,findoneby関数を追加
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.0.3.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.0.3.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-9-20</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.0.0.2<br>
		モデルのバグ修正($order->$limit)
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.0.2.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.0.2.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-9-18</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">0.0.0.1</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.0.1.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.0.1.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-9-10</td>
  </tr>
</table>
  <br>
  <?php
}


function content_eng( $data )
{
?>
<h1>Download</h1>

<p> Archive in CVS at<a href="https://sourceforge.jp/projects/cheetan/" target="_blank">sourceforge</a> is often recent.</p>
Recent version<br>
<table width="90%" border="0" cellspacing="1" cellpadding="0" class="download">
  <tr>
    <td class="downloadtd" width="60%">
		0.8.1.0<br>
		Fixed bug of query function of model.php<br />
		Add describe function for model
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.8.1.0.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.8.1.0.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2009-09-14</td>
  </tr>
</table>
<br>
Previous version<br>
<table width="90%" border="0" cellspacing="1" cellpadding="0" class="download">
  <tr>
    <td class="downloadtd" width="60%">
		0.8.0.8<br>
		Fixed bug of MySQL<br>
		Extended for validation
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.8.0.8.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.8.0.8.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2008-02-23</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.7.9.9<br>
		Fixed bug of PgSQL<br>
        Enable to specify port for MySQL<br>
		Add auto escape to a part of model functions<br>
		Enable to specify condition with array<br>
		Extend way to access view variables.(like $data['var'] -> $var)
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.9.9.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.9.9.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2008-02-20</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.7.8.2<br>
		Fixed bug of PgSQL<br>
      Enable to specify port for PgSQL<br>
      $db-&gt;add( &quot;pg&quot;, &quot;host&quot;, &quot;user&quot;, &quot;password&quot;, 
      &quot;dbname&quot;, DBKIND_PGSQL, &quot;port&quot; ); <br>
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.8.2.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.8.2.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2007-07-06</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.7.5.6<br>
		Add SQL logging<br>
		fixed bug of using the plural connections.<br>
		Add functions of getting SQL executed information to Model.<br>
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.5.6.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.5.6.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2007-06-01</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.7.1.9<br>
		Changed around DB.(function 'escape', delete useless connect）<br>
		Changed dispatch.<br>
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.1.9.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.1.9.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2007-05-29</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.7.0.9<br>
		fixed bug of function find at pgsql.<br>
		function notempty<br>
		fixed bug of textsql( forgot lock )<br>
		enable textsql to specify limit like [start,limit]<br>
		validation of mail address
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.0.9.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.0.9.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2007-05-13</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.7.0.1<br>
		Add config function 'config_view_class'<br>
		Add Controller function 'SetViewPath'<br>
		Modify enable to delete sql files( under db directory ) you don't need.
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.0.1.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.7.0.1.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-11-04</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.6.1.2<br>
		Add config function 'config_controller_class'
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.6.1.2.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.6.1.2.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-10-20</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.5.9.8<br>
		Add component<br>
		Add config function 'after_action'
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.5.9.8.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.5.9.8.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-10-14</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.5.7.7<br>
		correspond to TextSQL<br>
		modified around database
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.5.7.7.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.5.7.7.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-10-7</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.0.0.7<br>
		correspond to PostgreSQL
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.0.7.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.0.7.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-9-26</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.0.0.3<br>
		fixed bug.<br>
		Add functions findby,findoneby to Model.
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.0.3.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.0.3.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-9-20</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">
		0.0.0.2<br>
		fixed bug.
	</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.0.2.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.0.2.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-9-18</td>
  </tr>
  <tr>
    <td class="downloadtd" width="60%">0.0.0.1</td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.0.1.zip">zip</a></td>
    <td class="downloadtd" width="10%" align="center"><a href="archive/cheetan0.0.0.1.tar.gz">tar.gz</a></td>
    <td class="downloadtd" width="20%" align="center">2006-9-10</td>
  </tr>
</table>
  <br>
  <?php
}

?>