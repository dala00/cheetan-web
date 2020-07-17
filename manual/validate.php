<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );

function content( $data )
{
?>
<h1>バリデート</h1>

<p>&nbsp;&nbsp;フォームなどから取得したデータを検証します。コントローラにはバリデータが装備されていて、モデルとバリデータの連結によって非常に簡単にバリデートを行うことができます。バリデートを行うには以下の方法があります。</p>
<ul>
  <li>モデルと連携させて複数データを自動的に行う</li>
  <li>データを個々に検証</li>
</ul>

<h2>モデルと連携させてバリデート</h2>
<p>&nbsp;&nbsp;モデルの$validatefunc変数にバリデート関数を指定しておくことにより、モデルのvalidate関数で一括検証を行います。例えば以下のように宣言しておきます。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>user.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
class CUser extends CModel
{
    var $validatefunc = array( &quot;name&quot; =&gt; &quot;notempty&quot;,
                           &quot;email&quot; =&gt; &quot;email&quot;,
                           &quot;age&quot; =&gt; array(&quot;notempty&quot;,&quot;number&quot;) );
}
?&gt;</pre>
    </td>
  </tr>
</table>

<p> キーにフィールド名、値にバリデータ関数を指定します。こうすることによってvalidate関数で自動的にそれぞれのバリデータ関数が呼ばれて検証を行います。バリデータ関数はフレームワークのvalidate.php内の引数が( 
  $data, $errmsg = &quot;&quot; )になっているものです。必要であれば同じ形式で自由に追加して下さい。バリデータ関数を配列で指定すると、複数のバリデートを順に行うことが出来ます。</p>
<p>次にモデルのバリデート関数を実行します。上記のモデルを使用した簡単なチュートリアルを記しますので参考にご覧下さい。</p>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>regist.html</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>
&lt;form method=&quot;post&quot; action=&quot;regist.php&quot;&gt;
名前&lt;br&gt;
&lt;input type=&quot;text&quot; name=&quot;user/name&quot;&gt;&lt;br&gt;
メールアドレス&lt;br&gt;
&lt;input type=&quot;text&quot; name=&quot;user/email&quot;&gt;&lt;br&gt;
年齢&lt;br&gt;
&lt;input type=&quot;text&quot; name=&quot;user/age&quot;&gt;&lt;br&gt;
&lt;/form&gt;</pre>
    </td>
  </tr>
  <tr> 
    <td>regist.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
    require_once( &quot;config.php&quot; );
    require_once( &quot;cheetan.php&quot; );


function action( &amp;$c )
{
    if( count( $_POST ) )
    {
        if( $c-&gt;ic_user-&gt;validate( $c-&gt;data[&quot;user&quot;] ) )
        {
            //検証成功
            $c-&gt;ic_user-&gt;insert( $c-&gt;data[&quot;user&quot;] );
        }
        else
        {
            $c-&gt;set( &quot;err&quot;, &quot;invalidte!&quot; );
        }
    }
}
?&gt;</pre>
    </td>
  </tr>
</table>

<p> &nbsp;&nbsp;モデルの$validatemsgを以下のように指定しておくことにより、validatemsg関数で検証＋エラーメッセージも流してくれます。</p>
<p>&nbsp;&nbsp;例えばnameだけが引っかかった場合、&quot;名前が入力されていません。&lt;br&gt;&quot;という文字列が返され、名前と年齢が引っかかった場合は&quot;名前が入力されていません。&lt;br&gt;年齢を入力して下さい&lt;br&gt;&quot;という文字列が返されます。</p>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>user.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
class CUser extends CModel
{
    var $validatefunc = array( &quot;name&quot; =&gt; &quot;notempty&quot;,
                           &quot;email&quot; =&gt; &quot;email&quot;,
                           &quot;age&quot; =&gt; array(&quot;notempty&quot;,&quot;number&quot;) );

    var $validatemsg  = array( &quot;name&quot; =&gt; &quot;名前が入力されていません。&lt;br&gt;&quot;,
                           &quot;email&quot; =&gt; &quot;メールアドレスが正しくありません。&lt;br&gt;&quot;,
                           &quot;age&quot; =&gt; array(
                                &quot;年齢を入力して下さい。&lt;br&gt;&quot;,
                                &quot;年齢には数字を入れて下さい。&lt;br&gt;&quot;) );
?&gt;</pre>
    </td>
  </tr>
  <tr> 
    <td>regist.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
    require_once( &quot;config.php&quot; );
    require_once( &quot;cheetan.php&quot; );


function action( &amp;$c )
{
    if( count( $_POST ) )
    {
        $err = $c-&gt;ic_user-&gt;validatemsg( $c-&gt;data[&quot;user&quot;] );
        if( $err == &quot;&quot; )
        {
            //検証成功
            $c-&gt;ic_user-&gt;insert( $c-&gt;data[&quot;user&quot;] );
        }
        else
        {
            $c-&gt;set( &quot;err&quot;, $err );
        }
    }
}
?&gt;</pre>
    </td>
  </tr>
</table>

<p> ちなみにvalidate関数を使用しても、$validatemsgを設定しておけばGetValidateError関数でエラーメッセージを配列で取得できます。</p>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td class="source"> 
      <pre>$c-&gt;ic_user-&gt;validate( $c-&gt;data[&quot;user&quot;] );
$err = $c-&gt;ic_user-&gt;GetValidateError();
$c-&gt;set( &quot;nameerror&quot;, $err[&quot;name&quot;] );</pre>
    </td>
  </tr>
</table>
<h2>データを個々に検証</h2>
<p>&nbsp;&nbsp;コントローラにバリデータが装備されているので、そのバリデータ関数を直接呼びます。バリデータは以下のどちらかの変数として利用します。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td class="source"> 
      <pre>
$c-&gt;validate-&gt;function();
$c-&gt;v-&gt;function();
</pre>
    </td>
  </tr>
</table>

<p>バリデート関数はnotempty( $data, $errmsg = &quot;&quot; )のように引数に任意にエラーメッセージを設定できるようになっており、エラーメッセージが設定されていない場合は検証に成功するとTRUE,失敗するとFALSEが返されます。エラーメッセージが設定されている場合検証に成功すると空文字列、失敗するとエラーメッセージが返るようになっています。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>エラーメッセージを設定しない時</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>if( $c-&gt;v-&gt;notempty( $name ) )
{
    $c-&gt;set( &quot;msg&quot;, &quot;OK!&quot; );
}
else
{
    $c-&gt;set( &quot;msg&quot;, &quot;Please input your name.&quot; );
}</pre>
    </td>
  </tr>
  <tr> 
    <td>エラーメッセージ設定時</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>$err = &quot;&quot;;
$err .= $c-&gt;v-&gt;notempty( $name, &quot;Please input your name.&quot; );
$err .= $c-&gt;v-&gt;email( $email, &quot;Please input right email.&quot; );
if( $err == &quot;&quot; )
{
    Regist( $name, $email )
}
$c-&gt;set( $err );</pre>
    </td>
  </tr>
</table>
<h2>関数</h2>
<ul>
  <li>mixed notempty( mixed data [, string errmsg ] )</li>
</ul>
<p> dataがemptyでないかを検証します。</p>
<br>
<br>

<ul>
  <li>mixed len( string data, int min, int max [, string errmsg ] )</li>
</ul>
<p> 文字列dataの長さがmin以上、max以下であるかを検証します。(validatefuncには指定できません。）</p>
<br>
<br>
<ul>
  <li>mixed number( mixed data [, string errmsg ] )</li>
</ul>
<p> dataが数字であるかを検証します。</p>
<br>
<br>

<ul>
  <li>mixed eisu( string data [, string errmsg ] )</li>
</ul>
<p> dataが英数字のみで形成されているかを検証します。</p>
<br>
<br>

<ul>
  <li>mixed email( string data [, string errmsg ] )</li>
</ul>
<p> dataがメールアドレスの形式になっているかを検証します。</p>
<br>
<br>



<?php
}

function content_eng( $data )
{
?>
<h1>Validation</h1>

<p>&nbsp;&nbsp;Framework validate data from form. Controller has Validater. You 
  can validate easily by using Validater to Model. Way of validation is next two 
  ways.</p>
<ul>
  <li>Validate some data automatically by chaining Model and Validater.</li>
  <li>Validate one data.</li>
</ul>

<h2>Chain Validater to Model.</h2>
<p>&nbsp; Framework validate automatically if you specify array $validatefunc 
  of Model. For example, define $validatefunc as follows</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>user.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
class CUser extends CModel
{
    var $validatefunc = array( &quot;name&quot; =&gt; &quot;notempty&quot;,
                           &quot;email&quot; =&gt; &quot;email&quot;,
                           &quot;age&quot; =&gt; array(&quot;notempty&quot;,&quot;number&quot;) );
}
?&gt;</pre>
    </td>
  </tr>
</table>

<p> Specify field name to key and function name to value. Each function is called 
  by calling function 'validate'. Validation function to specify is functions 
  like 'function( $data, $errmsg =&quot;&quot; )'. You can also add function of 
  this format. If you specify validation functions with array, functions specified 
  is called sequentially.</p>
<p>Next, call function of Model 'validate'. It's tutorial.</p>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>regist.html</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>
&lt;form method=&quot;post&quot; action=&quot;regist.php&quot;&gt;
NAME&lt;br&gt;
&lt;input type=&quot;text&quot; name=&quot;user/name&quot;&gt;&lt;br&gt;
EMAIL&lt;br&gt;
&lt;input type=&quot;text&quot; name=&quot;user/email&quot;&gt;&lt;br&gt;
AGE&lt;br&gt;
&lt;input type=&quot;text&quot; name=&quot;user/age&quot;&gt;&lt;br&gt;
&lt;/form&gt;</pre>
    </td>
  </tr>
  <tr> 
    <td>regist.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
    require_once( &quot;config.php&quot; );
    require_once( &quot;cheetan.php&quot; );


function action( &amp;$c )
{
    if( count( $_POST ) )
    {
        if( $c-&gt;ic_user-&gt;validate( $c-&gt;data[&quot;user&quot;] ) )
        {
            //Succeeded to validate
            $c-&gt;ic_user-&gt;insert( $c-&gt;data[&quot;user&quot;] );
        }
        else
        {
            $c-&gt;set( &quot;err&quot;, &quot;invalidte!&quot; );
        }
    }
}
?&gt;</pre>
    </td>
  </tr>
</table>

<p> &nbsp;&nbsp;You can get error message by specifying array $validatemsg of 
  Model.</p>
<p>&nbsp;&nbsp;For example, string 'Input name.&lt;br&gt;' is returned if 'name' 
  validatin is failed. string 'Input name.&lt;br&gt;Input number to age.&lt;br&gt;' 
  is returned if 'name' and 'age' validation is failed.</p>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>user.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
class CUser extends CModel
{
    var $validatefunc = array( &quot;name&quot; =&gt; &quot;notempty&quot;,
                           &quot;email&quot; =&gt; &quot;email&quot;,
                           &quot;age&quot; =&gt; array(&quot;notempty&quot;,&quot;number&quot;) );

    var $validatemsg  = array( &quot;name&quot; =&gt; &quot;Input name.&lt;br&gt;&quot;,
                           &quot;email&quot; =&gt; &quot;Input right email.&lt;br&gt;&quot;,
                           &quot;age&quot; =&gt; array(
                                  &quot;Input age.&lt;br&gt;&quot;,
                                  &quot;Input number to age.&lt;br&gt;&quot;) );
?&gt;</pre>
    </td>
  </tr>
  <tr> 
    <td>regist.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
    require_once( &quot;config.php&quot; );
    require_once( &quot;cheetan.php&quot; );


function action( &amp;$c )
{
    if( count( $_POST ) )
    {
        $err = $c-&gt;ic_user-&gt;validatemsg( $c-&gt;data[&quot;user&quot;] );
        if( $err == &quot;&quot; )
        {
            //Succeeded to validate
            $c-&gt;ic_user-&gt;insert( $c-&gt;data[&quot;user&quot;] );
        }
        else
        {
            $c-&gt;set( &quot;err&quot;, $err );
        }
    }
}
?&gt;</pre>
    </td>
  </tr>
</table>

<p> You can get array of error message by GetValidate Error if you called validate.</p>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td class="source"> 
      <pre>$c-&gt;ic_user-&gt;validate( $c-&gt;data[&quot;user&quot;] );
$err = $c-&gt;ic_user-&gt;GetValidateError();
$c-&gt;set( &quot;nameerror&quot;, $err[&quot;name&quot;] );</pre>
    </td>
  </tr>
</table>
<h2>Validate one value.</h2>
<p>&nbsp;&nbsp;Call Validater directory from Controller. Way of calling is next 
  two ways.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td class="source"> 
      <pre>
$c-&gt;validate-&gt;function();
$c-&gt;v-&gt;function();
</pre>
    </td>
  </tr>
</table>

<p>You can specify $errmsg like notempty( $data, $errmsg = &quot;&quot; ) in validation 
  function. If you don't specify $errmsg, function returns TRUE or FALSE. If you 
  specify $errmsg, function return empty string when validation is succeeded and 
  return $errmsg when validation is not succeeded.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>When you don't specify $errmsg</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>if( $c-&gt;v-&gt;notempty( $name ) )
{
    $c-&gt;set( &quot;msg&quot;, &quot;OK!&quot; );
}
else
{
    $c-&gt;set( &quot;msg&quot;, &quot;Please input your name.&quot; );
}</pre>
    </td>
  </tr>
  <tr> 
    <td>When you specify $errmsg</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>$err = &quot;&quot;;
$err .= $c-&gt;v-&gt;notempty( $name, &quot;Please input your name.&quot; );
$err .= $c-&gt;v-&gt;email( $email, &quot;Please input right email.&quot; );
if( $err == &quot;&quot; )
{
    Regist( $name, $email )
}
$c-&gt;set( $err );</pre>
    </td>
  </tr>
</table>
<h2>Function</h2>
<ul>
  <li>mixed notempty( mixed data [, string errmsg ] )</li>
</ul>
<p> Validate if data is empty</p>
<br>
<br>

<ul>
  <li>mixed len( string data, int min, int max [, string errmsg ] )</li>
</ul>
<p> Validate if min &lt;= length of data &lt;= max. ( You can't specify this to 
  $validatefunc )</p>
<br>
<br>
<ul>
  <li>mixed number( mixed data [, string errmsg ] )</li>
</ul>
<p> Validate if data is number.</p>
<br>
<br>

<ul>
  <li>mixed eisu( string data [, string errmsg ] )</li>
</ul>
<p> Validate if data consisted by only number and English.</p>
<br>
<br>

<ul>
  <li>mixed email( string data [, string errmsg ] )</li>
</ul>
<p> Validate if data is email format.</p>
<br>
<br>



<?php
}
?>