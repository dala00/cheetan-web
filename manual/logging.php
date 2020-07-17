<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );

function content( $data )
{
?>
<h1>ロギング</h1>

<p>&nbsp;&nbsp;以下のようにデバッグ時に実行したSQLのログを取得することが出来ます。</p>

<p>
<table class="cheetan_sql_log_demo"><tr><th width="60%">SQL</th><th width="10%">ERROR</th><th width="10%">ROWS</th><th width="10%">TIME</th></tr><tr><td>SELECT * FROM user  WHERE status=1 LIMIT 5</td><td></td><td>5</td><td>0.01205</td></tr></table>
</p>

<p>&nbsp;&nbsp;まずちいたんをデバッグモードにします。</p>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>デバッグモードの設定</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>
function config_controller( &amp;$c )
{
    $c-&gt;SetDebug( true );
}</pre>
    </td>
  </tr>
</table>

<p>
あとは「cheetan_sql_log」にログがセットされますので、それを任意の場所に表示するだけです。
</p>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>ログの表示</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php echo $data['cheetan_sql_log']; ?&gt;
</pre>
    </td>
  </tr>
</table>

<p>
ちなみに、出力されるテーブルにはcheetan_sql_logというクラスが割り当てられていますので、CSSを作成すれば以下のように整形することが可能です。
<table class="cheetan_sql_log"><tr><th width="60%">SQL</th><th width="10%">ERROR</th><th width="10%">ROWS</th><th width="10%">TIME</th></tr><tr><td>SELECT * FROM user  WHERE status=1 LIMIT 5</td><td></td><td>5</td><td>0.01205</td></tr></table>
</p>


<?php
}


function content_eng( $data )
{
?>
<h1>Logging</h1>

<p>&nbsp;&nbsp;You can see sql log like as follows.</p>

<p>
<table class="cheetan_sql_log_demo"><tr><th width="60%">SQL</th><th width="10%">ERROR</th><th width="10%">ROWS</th><th width="10%">TIME</th><tr><td>SELECT * FROM user  WHERE status=1 LIMIT 5</td><td></td><td>5</td><td>0.01205</td></tr></table>
</p>

<p>&nbsp;&nbsp;First of all, make framework to debug mode.</p>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>Set debug mode.</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>
function config_controller( &amp;$c )
{
    $c-&gt;SetDebug( true );
}</pre>
    </td>
  </tr>
</table>

<p>
Log is set to 'cheetan_sql_log'. So, display anywhere as you like.
</p>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>Display log</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php echo $data['cheetan_sql_log']; ?&gt;
</pre>
    </td>
  </tr>
</table>

<p>
class 'cheetan_sql_log' is assigned to log table. You can change design of the log table if you create CSS.
<table class="cheetan_sql_log"><tr><th width="60%">SQL</th><th width="10%">ERROR</th><th width="10%">ROWS</th><th width="10%">TIME</th></tr><tr><td>SELECT * FROM user  WHERE status=1 LIMIT 5</td><td></td><td>5</td><td>0.01205</td></tr></table>
</p>


<?php
}

?>