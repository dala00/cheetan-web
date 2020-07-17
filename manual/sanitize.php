<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );

function content( $data )
{
?>
<h1>サニタイズ</h1>

<p>&nbsp;&nbsp;コントローラとビューにはサニタイザが装備されています。 機能が自動化されておらず中途半端のため、 とりあえずのマニュアルなので詳しい方法は書きませんが、下記に記す方法でサニタイザ(CSanitizeクラス)にアクセスできますので、 
  ライブラリのsanitize.php内の関数を参照して下さい。 例は全てhtmlspecialcharsを施す場合です。</p>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>コントローラで使用したい場合</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>
function action( &amp;$c )
{
    $email = $c-&gt;sanitize-&gt;html( $_POST[&quot;email&quot;] );
    $email = $c-&gt;s-&gt;html( $_POST[&quot;email&quot;] );
    $email = $c-&gt;s-&gt;post(&quot;email&quot;);
}</pre>
    </td>
  </tr>
</table>
<br>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>ビューで使用したい場合</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;h3&gt;&lt;?php print $sanitize-&gt;html( $data[&quot;email&quot;] ); ?&gt;&lt;/h3&gt;
&lt;h3&gt;&lt;?php print $s-&gt;html( $data[&quot;email&quot;] ); ?&gt;&lt;/h3&gt;</pre>
    </td>
  </tr>
</table>


<?php
}


function content_eng( $data )
{
?>
<h1>Sanitizing</h1>

<p>&nbsp;&nbsp;Controller has sanitizer. This manual is temporary because function 
  of sanitizing is not completed to create. It's not automatically. But you can 
  access Sanitizer(CSanitize) by next way. Please see functions in sanitize.php. 
  Next is example to call htmlspecialchars all.</p>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>in Controller</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>
function action( &amp;$c )
{
    $email = $c-&gt;sanitize-&gt;html( $_POST[&quot;email&quot;] );
    $email = $c-&gt;s-&gt;html( $_POST[&quot;email&quot;] );
    $email = $c-&gt;s-&gt;post(&quot;email&quot;);
}</pre>
    </td>
  </tr>
</table>
<br>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>in View</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;h3&gt;&lt;?php print $sanitize-&gt;html( $data[&quot;email&quot;] ); ?&gt;&lt;/h3&gt;
&lt;h3&gt;&lt;?php print $s-&gt;html( $data[&quot;email&quot;] ); ?&gt;&lt;/h3&gt;</pre>
    </td>
  </tr>
</table>


<?php
}

?>