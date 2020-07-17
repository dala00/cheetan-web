<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );

function content( $data )
{
?>
<h1>コンフィグファイル</h1>

<p>&nbsp;&nbsp;ちいたんではコントローラーのアクションを実行する前に、フレームワークからいくつかの設定用関数が呼ばれます。それによりデータベースやモデル、セッションといった機能の設定を行います。ユーザーが設定関数を宣言していなかった場合、デフォルトの動作が行われるため必要なければ設定を行わなくても動作します。</p>

<h2>関数宣言</h2>

<p>&nbsp;&nbsp;設定関数はconfig.phpファイルにまとめて宣言することを推奨しています。各々のページでcheetan.phpをrequireする前にconfig.phpをrequireします。特定のページのみに別の動作を行わせたい時は、config.php内の関数を以下のように宣言し、ページではconfig.phpをrequireする前に関数を宣言します。
</p>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
  	<td>config.php</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>if( !function_exists( &quot;config_function&quot; ) )
{
    function config_function()
    {
        return true;
    }
}
</pre>
	</td>
  </tr>
  <tr>
  	<td>onepage.php</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>&lt;?php
function config_function()
{
    return false;
}
    require_once( &quot;config.php&quot; );
    require_once( &quot;cheetan.php&quot; );</pre>
	</td>
  </tr>
</table>

<h2>設定関数</h2>

<ul>
  <li>function is_session()</li>
</ul>

<p>&nbsp;&nbsp;セッションを使用するかどうかを設定します。デフォルト(関数を宣言しない時)はセッションを使用するので
使用したくない時は関数を宣言し、falseを返してください。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function is_session()
{
    return false;
}
</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<ul>
  <li>function config_controller_class()</li>
</ul>

<p>&nbsp;&nbsp;コントローラクラスをオーバーライドしたい時に宣言します。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function config_controller_class()
{
    class CMyController extends CController
    {

    }
    return 'CMyController';
}
</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<ul>
  <li>function config_view_class()</li>
</ul>

<p>&nbsp;&nbsp;ビュークラスをオーバーライドしたい時に宣言します。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function config_view_class()
{
    class CMyView extends CView
    {

    }
    return 'CMyView';
}
</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<ul>
  <li>function config_database( CDatabase &amp;db )</li>
</ul>

<p>&nbsp;&nbsp;データベースの設定を行います。以下の関数を利用してデータベースを設定します。</p>
<p>function CDatabase::add( string settingname, string host, string user, string 
  password, string dbname)</p>
<p>&nbsp;&nbsp;host以降は特に説明は必要ないでしょう。
settingnameは複数の接続を利用したい時の識別子です。
モデルやデータベースのクエリー関数で指定できます。
特に一つしか使わない場合は名前を指定しないとデフォルトの設定として呼び出されます。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function config_database( &amp;$db )
{
    $db-&gt;add( &quot;&quot;, &quot;localhost&quot;, &quot;user&quot;, &quot;password&quot;, &quot;dbname&quot; );
    $db-&gt;add( &quot;special&quot;, &quot;192.168.0.100&quot;, &quot;user&quot;, &quot;password&quot;, &quot;dbname&quot; );
}
</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<ul>
  <li>function config_models( CController &amp;controller )</li>
</ul>

<p>&nbsp;&nbsp;コントローラーにモデルを読み込みます。以下の関数を利用してモデルの設定を行います。</p>
<p>function CController::AddModel( string filepath [, string name ] )</p>
<p>filepathはモデルを宣言してあるファイルを指定します。デフォルトではファイル名の一文字目のみを大文字にして頭に「C」をつけたクラスを宣言します。（user.phpの場合CUser）そしてファイル名と同じテーブルを参照します。</p>
<p>通常コントローラの$m配列とメンバ変数、ファイル名と同じ名前で保存されますが、nameを指定することによってその名前に変更できます。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function config_models( &amp;$controller )
{
    $controller-&gt;db-&gt;query( &quot;SET NAMES ujis&quot; ); //if you need
    $controller-&gt;AddModel( dirname(__FILE__) . &quot;/models/user.php&quot; );
}
</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<ul>
  <li>function config_components( CController &amp;controller )</li>
</ul>

<p>&nbsp;&nbsp;コントローラーにコンポーネントを読み込みます。以下の関数を利用してコンポーネントの設定を行います。</p>
<p>function CController::AddComponent( string filepath [, string cname [, string 
  name ] ] )</p>
<p>filepathはコンポーネントを宣言してあるファイルを指定します。デフォルトではファイル名の一文字目のみを大文字にして頭に「C」をつけたクラスを宣言します。（user.phpの場合CUser）そしてファイル名と同じテーブルを参照します。クラス名はcnameによって変更できます。また、nameを指定すれば$c[name]とコントローラのname変数に保存するよう指定できます。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function config_components( &amp;$controller )
{
    $controller-&gt;AddComponent( dirname(__FILE__) . &quot;/components/mail.php&quot; );
    $controller-&gt;AddComponent( 'Smarty/Smarty.class.php', 'Smarty', 'smarty' );
    $controller-&gt;SetViewExt( '.tpl' );
}
</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<ul>
  <li>function is_secure( CController &amp;controller )</li>
  <li>function check_secure( CController &amp;controller )</li>
</ul>

<p>&nbsp;&nbsp;ユーザー認証用の設定関数check_secureを呼び出すかどうかをis_secureで設定します。デフォルト(is_secure関数を宣言しない時）はcheck_secureは呼び出されません。認証を行いたい時はtrueを返します。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function is_secure( &amp;$controller )
{
    return true;
}

function check_secure( &amp;$controller )
{
    if( empty( $_SESSION[&quot;user&quot;] ) )
    {
        $controller-&gt;redirect( &quot;login.php&quot; );
    }
}</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<ul>
  <li>function config_controller( CController &amp;controller )</li>
</ul>

<p>&nbsp;&nbsp;アクションが呼ばれる直前に呼ばれる関数です。
特に何をするべきという関数ではありませんので必要に応じて使用します。
下記サンプルでは共通テンプレートファイルを設定しています。
</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function config_controller( &amp;$controller )
{
    $controller-&gt;SetTemplateFile( &quot;template.html&quot; );
}</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<ul>
  <li>function after_action( CController &amp;controller )</li>
</ul>

<p>&nbsp;&nbsp;アクションが呼ばれた直後に呼ばれる関数です。 特に何をするべきという関数ではありませんので必要に応じて使用します。 smartyで出力を行っています。 
</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function after_action( &amp;$controller )
{
    $view = $controller-&gt;GetViewFile();
    $controller-&gt;smarty-&gt;display( $view );
    exit();
}</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>



<?php
}

function content_eng( $data )
{
?>
<h1>Config file</h1>

<p>&nbsp;&nbsp;Some function for config is called before function 'action' is called by framework.
You set up database, Model, session etc by these functions.
Default movement is occur if you don't define functions.</p>

<h2>Deine functions</h2>

<p>&nbsp;&nbsp;It's recommended to define all config function in config.php. You can require it in each php file. Require config.php before 
require cheetan.php.
Define config function like as follows if you want change function in specific page.
</p>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
  	<td>config.php</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>if( !function_exists( &quot;config_function&quot; ) )
{
    function config_function()
    {
        return true;
    }
}
</pre>
	</td>
  </tr>
  <tr>
  	<td>onepage.php</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>&lt;?php
function config_function()
{
    return false;
}
    require_once( &quot;config.php&quot; );
    require_once( &quot;cheetan.php&quot; );</pre>
	</td>
  </tr>
</table>

<h2>Config function</h2>

<ul>
  <li>function is_session()</li>
</ul>

<p>&nbsp;&nbsp;Specify if you use session. Return false if you don't want to use session because framework use session in default.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function is_session()
{
    return false;
}
</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<ul>
  <li>function config_controller_class()</li>
</ul>

<p>&nbsp;&nbsp;Define when you want to override CController class.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function config_controller_class()
{
    class CMyController extends CController
    {

    }
    return 'CMyController';
}
</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<ul>
  <li>function config_view_class()</li>
</ul>

<p>&nbsp;&nbsp;Define when you want to override CView class.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function config_view_class()
{
    class CMyView extends CView
    {

    }
    return 'CMyView';
}
</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<ul>
  <li>function config_database( CDatabase &amp;db )</li>
</ul>

<p>&nbsp;&nbsp;Set up database. Call next function to set up database.</p>
<p>function CDatabase::add( string settingname, string host, string user, string 
  password, string dbname)</p>
<p>&nbsp;&nbsp;'settingname' is name of connection. You can specify it when you 
  call function of Model or database. If you use only one connection, you don't 
  have to specify name.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function config_database( &amp;$db )
{
    $db-&gt;add( &quot;&quot;, &quot;localhost&quot;, &quot;user&quot;, &quot;password&quot;, &quot;dbname&quot; );
    $db-&gt;add( &quot;special&quot;, &quot;192.168.0.100&quot;, &quot;user&quot;, &quot;password&quot;, &quot;dbname&quot; );
}
</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<ul>
  <li>function config_models( CController &amp;controller )</li>
</ul>

<p>&nbsp;&nbsp;Regist model to controller. Use function as follows.</p>
<p>function CController::AddModel( string filepath [, string name ] )</p>
<p>'filepath' is file path of Model definition. Framework define class like 'user.php' 
  =&gt; 'CUser' and refer to table named 'user'.</p>
<p>You can access CUser with array '$m' and $user in Controller in default. You 
  can change variable name by specifying 'name'.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function config_models( &amp;$controller )
{
    $controller-&gt;db-&gt;query( &quot;SET NAMES ujis&quot; ); //if you need
    $controller-&gt;AddModel( dirname(__FILE__) . &quot;/models/user.php&quot; );
}
</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<ul>
  <li>function config_components( CController &amp;controller )</li>
</ul>

<p>&nbsp;&nbsp;Regist Components to Controller. Use function as follows</p>
<p>function CController::AddComponent( string filepath [, string cname [, string 
  name ] ] )</p>
<p>Specify cname if you don't want to define default class name( like mail.php 
  =&gt; CMail ). Specify name if you don't want to define default name of variable( 
  like mail.php =&gt; $c[mail] and $mail )</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function config_components( &amp;$controller )
{
    $controller-&gt;AddComponent( dirname(__FILE__) . &quot;/components/mail.php&quot; );
    $controller-&gt;AddComponent( 'Smarty/Smarty.class.php', 'Smarty', 'smarty' );
    $controller-&gt;SetViewExt( '.tpl' );
}
</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<ul>
  <li>function is_secure( CController &amp;controller )</li>
  <li>function check_secure( CController &amp;controller )</li>
</ul>

<p>&nbsp;&nbsp;Set up if framework call function 'check_secure' by function 'is_secure'. 
  Frame work does not call check_secure by default. If you want to make framework 
  called 'check_secure', return true in 'is_secure'.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function is_secure( &amp;$controller )
{
    return true;
}

function check_secure( &amp;$controller )
{
    if( empty( $_SESSION[&quot;user&quot;] ) )
    {
        $controller-&gt;redirect( &quot;login.php&quot; );
    }
}</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<ul>
  <li>function config_controller( CController &amp;controller )</li>
</ul>

<p>&nbsp;&nbsp;It's function called before action.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function config_controller( &amp;$controller )
{
    $controller-&gt;SetTemplateFile( &quot;template.html&quot; );
}</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>


<ul>
  <li>function after_action( CController &amp;controller )</li>
</ul>

<p>&nbsp;&nbsp;It's function called after action.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td class="source"> 
      <pre>function after_action( &amp;$controller )
{
    $view = $controller-&gt;GetViewFile();
    $controller-&gt;smarty-&gt;display( $view );
    exit();
}</pre>
	</td>
  </tr>
</table>
<br>
<br>
<br>
<br>



<?php
}

?>