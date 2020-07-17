<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );

function content( $data )
{
?>
<h1>モデル</h1>

<p>&nbsp;&nbsp;データベースのテーブルをモデルによって簡単に操作します。</p>

<h2>モデルの作成</h2>
<p>&nbsp;&nbsp;以下が最小構成のモデルです。「テーブル名.php」で作成し、テーブル名の一文字目を大文字にして以下を小文字にし、Cをつけたものをクラス名とします。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>user.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
class CUser extends CModel
{
}
?&gt;</pre>
    </td>
  </tr>
</table>
<h2>モデルの登録</h2>
<p>&nbsp;&nbsp;フレームワークから呼ばれるconfig_models関数内でモデルを登録します。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>config.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>function config_database( &amp;$db )
{
    $db-&gt;add(&quot;&quot;, &quot;localhost&quot;, &quot;user&quot;, &quot;password&quot;, &quot;dbname&quot;);
    $db-&gt;add(&quot;special&quot;, &quot;192.168.0.100&quot;, &quot;user&quot;, &quot;password&quot;, &quot;dbname&quot;);
    $db-&gt;add(&quot;pg&quot;,&quot;localhost&quot;,&quot;user&quot;,&quot;password&quot;,&quot;dbname&quot;,DBKIND_PGSQL,'5432');
}</pre>
    </td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>function config_models( &amp;$controller )
{
    $controller-&gt;AddModel( &quot;user.php&quot; );
    $controller-&gt;AddModel( &quot;specialuser.php&quot;, &quot;special&quot; );
    $controller-&gt;AddModel( &quot;test.php&quot;, &quot;pg&quot; );
}</pre>
    </td>
  </tr>
</table>
<h2>使用方法</h2>
<p>モデルはコントローラにて呼び出します。呼び出し方は以下の二つの方法があります。上の方法はコントローラのメンバ変数と競合しない場合のみ設定されています。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>
$c-&gt;user-&gt;function();
$c-&gt;m[&quot;user&quot;]-&gt;function();
</pre>
    </td>
  </tr>
</table>
<h2>引数に使用するcondition</h2>
<p>いくつかのメソッドの引数にconditionがありますが、文字列によるSQLの記述の他に、変数による指定も出来ます。今のところ、結合は全てANDです。これを使った場合、valueは自動的にエスケープされます。例えば以下の例はどちらも同じ機能になります。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>$c-&gt;user-&gt;find(&quot;id=1&quot;);
$c-&gt;user-&gt;find(array('id' =&gt; 1));</pre>
    </td>
  </tr>
</table>
<h2>関数</h2>

<ul>
  <li>array find( [ mixed condition [, string order [, string limit [, string 
    group]]] )</li>
</ul>
<p> テーブルの中から指定されたものを配列として取得します。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>
$results = $c-&gt;user-&gt;find( &quot;id=$id&quot;, &quot;age DESC&quot; );
</pre>
      </td>
  </tr>
</table>
<br>
<br>
<br>

<ul>
  <li>array findone( [ string condition [, string order ]] )</li>
</ul>
<p> テーブルの中からconditionとorderで指定されたものを先頭の一つだけ取得します。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>
$result = $c-&gt;user-&gt;findone( &quot;id=$id&quot;, &quot;age DESC&quot; );</pre>
    </td>
  </tr>
</table>
<br>
<br>
<br>
<ul>
  <li>array findquery( string query [, string condition [, string order [, string 
    limit [, string group ]]]] )</li>
</ul>
<p> リレーションを使用したい場合はこちらを利用します。適合したレコードを配列にして取得します。queryにはWHEREより前のクエリ文を指定します。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>$query = &quot;SELECT user.*, office.name FROM user&quot;
       . &quot; LEFT JOIN user.office_id=office.id&quot;;
$results = $c-&gt;user-&gt;findquery( $query, &quot;age=24&quot;, &quot;age DESC&quot; );</pre>
    </td>
  </tr>
</table>
<br>
<br>
<br>

<ul>
  <li>int getcount( [ string condition [, string limit ]] )</li>
</ul>
<p> テーブルの中のconditionとlimitで当てはまる要素の数を取得します。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>
$count = $c-&gt;user-&gt;getcount( &quot;id=$id&quot;, &quot;10&quot; );</pre>
    </td>
  </tr>
</table>
<br>
<br>
<br>

<ul>
  <li>bool insert( array datas )</li>
</ul>
<p> キーに要素名を指定して値を入れた配列を指定すると、その通りにINSERTを行います。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>
$data[&quot;name&quot;] = $name;
$data[&quot;email&quot;] = $email;
$c-&gt;user-&gt;insert( $data );</pre>
    </td>
  </tr>
</table>
<br>
<br>
<br>

<ul>
  <li>bool update( array datas )</li>
</ul>
<p> キーに要素名を指定して値を入れた配列を指定すると、その通りにUPDATEを行います。
モデルのメンバ変数$id(デフォルトは&quot;id&quot;）と同じキーを見つけ、自動的にその場所をUPDATEします。
$idが見つからなかった場合はfalseを返し処理を中止します。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>
$data[&quot;id&quot;] = $id;
$data[&quot;name&quot;] = $name;
$data[&quot;email&quot;] = $email;
$c-&gt;user-&gt;update( $data );</pre>
    </td>
  </tr>
</table>
<br>
<br>
<br>

<ul>
  <li>bool updateby( array datas, string condition )</li>
</ul>
<p> updateの様に自動的に条件を指定するのではなく、明示的にconditionで条件を指定できます。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>
$data[&quot;name&quot;] = $name;
$data[&quot;email&quot;] = $email;
$c-&gt;user-&gt;updateby( $data, &quot;age=25&quot; );</pre>
    </td>
  </tr>
</table>
<br>
<br>
<br>

<ul>
  <li>bool del( string condition )</li>
</ul>
<p> conditionで指定されたレコードを削除します。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>
$c-&gt;user-&gt;del( &quot;age=25&quot; );</pre>
    </td>
  </tr>
</table>
<br>
<br>
<br>

<ul>
  <li>result query( string query )</li>
</ul>
<p> 直接sqlにクエリを送信します。テーブル名は自動的には設定されませんので完全なクエリを指定します。</p>
<br>
<br>
<br>

<ul>
  <li>int GetLastInsertId()</li>
</ul>
<p> 最後に挿入したIDを返します。(mysqlのみ)</p>
<br>
<br>
<br>

<ul>
  <li>int GetAffectedRows()</li>
</ul>
<p> SQLで影響を受けた行の数を返します。</p>
<br>
<br>
<br>

<ul>
  <li>string GetLastError()</li>
</ul>
<p> 最後に得たエラーを返します。</p>
<br>
<br>
<br>

<ul>
  <li>string to_datetime( int time )</li>
</ul>
<p> 指定されたUNIXタイムスタンプをDATETIMEの様式にフォーマットします。<br>
(例：2006-09-19 12:24:46）</p>
<br>
<br>
<br>

<ul>
  <li>string escape( string str )</li>
</ul>
<p> 文字列をクエリ用にエスケープします。</p>
<br>
<br>
<br>

<ul>
  <li>bool validate( array datas )</li>
  <li>string validatemsg( array datas )</li>
  <li>array GetValidateError()</li>
</ul>
<p> これらはバリデート用関数です。詳しくは
バリデートのマニュアルをご覧下さい。</p>
<br>
<br>
<br>

<h2>変数</h2>
<ul>
  <li>var $id</li>
</ul>
<p> $idで指定された値(デフォルト:&quot;id&quot;）でテーブルの主要な要素を指定します。update関数などで使用されます。</p>
<br>
<br>

<ul>
  <li>var $name</li>
</ul>
<p> $nameで指定された(デフォルト:&quot;&quot;）データベース接続を使用してクエリを実行します。</p>
<br>
<br>

<div class="point">var $table</div>
<p> 何も指定されていない時(デフォルト)はファイル名のデータベースを自動的に指定します。
これを設定すると、指定されたテーブルにアクセスするようになります。</p>
<br>

<div class="point">var $controller</div>
<p>
コントローラを参照できます。
</p>
<?php
}



function content_eng( $data )
{
?>
<h1>Model</h1>

<p>&nbsp;&nbsp;You can deal with database easily by using Model.</p>

<h2>Create Model</h2>
<p>&nbsp;&nbsp;Minimum Model is as follows. Create file named 「table name.php」. 
  Class name is ucfirst( strtolower( table name ) ).</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>user.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
class CUser extends CModel
{
}
?&gt;</pre>
    </td>
  </tr>
</table>
<h2>Regist Model</h2>
<p>&nbsp;&nbsp;You can regist model in function 'config_models' called by framework.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>config.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>function config_database( &amp;$db )
{
    $db-&gt;add( &quot;&quot;, &quot;localhost&quot;, &quot;user&quot;, &quot;password&quot;, &quot;dbname&quot; );
    $db-&gt;add( &quot;special&quot;, &quot;192.168.0.100&quot;, &quot;user&quot;, &quot;password&quot;, &quot;dbname&quot; );
    $db-&gt;add( &quot;pg&quot;, &quot;localhost&quot;, &quot;user&quot;, &quot;password&quot;, &quot;dbname&quot;, DBKIND_PGSQL, '5432' );
}</pre>
    </td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>function config_models( &amp;$controller )
{
    $controller-&gt;AddModel( &quot;user.php&quot; );
    $controller-&gt;AddModel( &quot;specialuser.php&quot;, &quot;special&quot; );
    $controller-&gt;AddModel( &quot;test.php&quot;, &quot;pg&quot; );
}</pre>
    </td>
  </tr>
</table>
<h2>How to use</h2>

<p>You can call Model from Controller. Way to call is next two ways. First way 
  is set up when the name is not competed with other variable name.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td class="source">
      <pre>
$c-&gt;user-&gt;function();
$c-&gt;m[&quot;user&quot;]-&gt;function();
</pre>
	</td>
  </tr>
</table>


<h2>Function</h2>
<ul>
  <li>array find( [ string condition [, string order [, string limit [, string 
    group ]]] )</li>
</ul>
<p> You get elements specified by argument from table.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>
$results = $c-&gt;user-&gt;find( &quot;id=$id&quot;, &quot;age DESC&quot; );</pre>
    </td>
  </tr>
</table>
<br>
<br>
<br>

<ul>
  <li>array findone( [ string condition [, string order ]] )</li>
</ul>
<p> You get first element from elements found by function 'find'.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>
$result = $c-&gt;user-&gt;findone( &quot;id=$id&quot;, &quot;age DESC&quot; );</pre>
    </td>
  </tr>
</table>
<br>
<br>
<br>
<ul>
  <li>array findquery( string query [, string condition [, string order [, string 
    group ] )</li>
</ul>
<p> Use this when you want to find related data. 'query' is message before 'WHERE'.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>$query = &quot;SELECT user.*, office.name FROM user&quot;
       . &quot; LEFT JOIN user.office_id=office.id&quot;;
$results = $c-&gt;user-&gt;findquery( $query, &quot;age=24&quot;, &quot;age DESC&quot; );</pre>
    </td>
  </tr>
</table>
<br>
<br>
<br>

<ul>
  <li>int getcount( [ string condition [, string limit ]] )</li>
</ul>
<p> You get elements count found.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>
$count = $c-&gt;user-&gt;getcount( &quot;id=$id&quot;, &quot;10&quot; );</pre>
    </td>
  </tr>
</table>
<br>
<br>
<br>

<ul>
  <li>bool insert( array datas )</li>
</ul>
<p> Insert data to table by array. Array is consisted as follows ( $array[key] 
  = value ).</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>
$data[&quot;name&quot;] = $name;
$data[&quot;email&quot;] = $email;
$c-&gt;user-&gt;insert( $data );</pre>
    </td>
  </tr>
</table>
<br>
<br>
<br>

<ul>
  <li>bool update( array datas )</li>
</ul>
<p> You can update data by array. Array is same as one of 'insert'. But specify 
  key 'id' ( which is default key. You can specify id name by Model's member variable 
  $id. ). Update condition will become &quot;id='$id'&quot;. Framework terminate 
  function if id key is not exist in array.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>
$data[&quot;id&quot;] = $id;
$data[&quot;name&quot;] = $name;
$data[&quot;email&quot;] = $email;
$c-&gt;user-&gt;update( $data );</pre>
    </td>
  </tr>
</table>
<br>
<br>
<br>

<ul>
  <li>bool updateby( array datas, string condition )</li>
</ul>
<p> You can specify condition when update.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>
$data[&quot;name&quot;] = $name;
$data[&quot;email&quot;] = $email;
$c-&gt;user-&gt;updateby( $data, &quot;age=25&quot; );</pre>
    </td>
  </tr>
</table>
<br>
<br>
<br>

<ul>
  <li>bool del( string condition )</li>
</ul>
<p> Delete record by condition.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr> 
    <td class="source"> 
      <pre>
$c-&gt;user-&gt;del( &quot;age=25&quot; );</pre>
    </td>
  </tr>
</table>
<br>
<br>
<br>

<ul>
  <li>result query( string query )</li>
</ul>
<p> You can specify query.</p>
<br>
<br>
<br>

<ul>
  <li>int GetLastInsertId()</li>
</ul>
<p> Get last inserted ID. ( only mysql )</p>
<br>
<br>
<br>

<ul>
  <li>int GetAffectedRows()</li>
</ul>
<p> Get affected rows num.</p>
<br>
<br>
<br>

<ul>
  <li>string GetLastError()</li>
</ul>
<p> Get last error.</p>
<br>
<br>
<br>

<ul>
  <li>string to_datetime( int time )</li>
</ul>
<p> Change UNIX timestamp to DATETIME format.<br>
  (ex.：2006-09-19 12:24:46）</p>
<br>
<br>
<br>

<ul>
  <li>string escape( string str )</li>
</ul>
<p> Escape string for query.</p>
<br>
<br>
<br>

<ul>
  <li>bool validate( array datas )</li>
  <li>string validatemsg( array datas )</li>
  <li>array GetValidateError()</li>
</ul>
<p> These are function for validation. See manual of validation to know detail.</p>
<br>
<br>
<br>

<h2>Variable</h2>
<ul>
  <li>var $id</li>
</ul>
<p> $id( default is 'id' ) is a primary key used by function 'update' etc.</p>
<br>
<br>

<ul>
  <li>var $name</li>
</ul>
<p> Model use database connection specifid by $name.</p>
<br>
<br>

<ul>
  <li>var $table</li>
</ul>
<p> You can specify table name when you don't want to default table name.</p>
<br>
<br>


<?php
}
?>