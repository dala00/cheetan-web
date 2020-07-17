<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );

function content( $data )
{
?>
<h1>ビュー</h1>

<p>&nbsp;&nbsp;実際に表示するHTMLの記述にはいくつかの方法があります。状況に応じて好きなものを選択することが可能です。</p>
<ul>
<li>PHPファイルに直接書く</li>
<li>smartyの用にPHPファイルとテンプレートを分ける（構文解析が無い分恐らく高速）</li>
<li>全ファイル共通のテンプレートを用意し、コンテンツ部分をPHPファイルに直接書く</li>
<li>全ファイル共通のテンプレートを用意し、PHPファイルとテンプレートを分ける</li>
</ul>

<h2>PHPファイルに直接書く</h2>
<p>&nbsp;&nbsp;小さな個人用プログラムの場合はこちらが一番楽でしょう。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>test.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
    require_once( &quot;cheetan.php&quot; );

function action( &amp;$c )
{
    $c-&gt;set( &quot;msg&quot;, &quot;Hello&quot; );
}
?&gt;
&lt;html&gt;
&lt;body&gt;
&lt;h1&gt;&lt;?php print $data[&quot;msg&quot;]; ?&gt;&lt;/h1&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>
    </td>
  </tr>
</table>
<h2>PHPファイルとテンプレートを分ける</h2>
<p>&nbsp;&nbsp;smartyのようにPHPのアクション部分と表示部分を分割します。構文解析は無いので速いです。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>test.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
    require_once( &quot;cheetan.php&quot; );

function action( &amp;$c )
{
    $c-&gt;set( &quot;msg&quot;, &quot;Hello&quot; );
}
?&gt;</pre>
    </td>
  </tr>
  <tr> 
    <td>test.html</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;html&gt;
&lt;body&gt;
&lt;h1&gt;&lt;?php print $data[&quot;msg&quot;]; ?&gt;&lt;/h1&gt;
&lt;!-- この形式の場合以下も可能 --&gt;
&lt;h2&gt;&lt;?php echo $msg; ?&gt;&lt;/h2&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>
    </td>
  </tr>
</table>
<p>何も設定を行わなければ同じフォルダ内の拡張子を.htmlに変更したものが使用されます。違うものを指定したい場合はコントローラのSetViewFile( 
  string filename )を使用して下さい。</p>
<h2>全ファイル共通のテンプレート+PHPファイルに直接書く</h2>

<p>全てのページに共通のテンプレートファイルを使用することが出来ます。これにより各々のページにはコンテンツ部分のみを記述すればよいので作業が簡略化します。テンプレートファイルを指定するには、コントローラもしくはコンフィグ関数の中からSetTemplateFile( 
  string filename)により指定して下さい。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>template.html</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;html&gt;
&lt;body&gt;
&lt;?php contents( $data ); ?&gt;
&lt;!-- 共通テンプレートを使用する場合以下の形でsetした変数参照可能 --&gt;
&lt;?php echo $msg; ?&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>
    </td>
  </tr>
  <tr> 
    <td>test.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
    require_once( &quot;cheetan.php&quot; );

function action( &amp;$c )
{
    $c-&gt;set( &quot;msg&quot;, &quot;Hello&quot; );
}
function contents( $data )
{
?&gt;
&lt;h1&gt;&lt;?php print $data{&quot;msg&quot;]; ?&gt;&lt;/h1&gt;
&lt;?php
}
?&gt;</pre>
    </td>
  </tr>
</table>
<h2>全ファイル共通のテンプレート+PHPファイルとテンプレートを分ける</h2>
<p> 全てのページに共通のテンプレートファイルを使用し、なおかつアクション部分と表示部分を分けることが出来ます。上記とtemplate.htmlの書き方が微妙に違うので注意して下さい。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>template.html</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;html&gt;
&lt;body&gt;
&lt;?php $this-&gt;content( $data ); ?&gt;
&lt;!-- 共通テンプレートを使用する場合以下の形でsetした変数参照可能 --&gt;
&lt;?php echo $msg; ?&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>
    </td>
  </tr>
  <tr> 
    <td>test.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
    require_once( &quot;cheetan.php&quot; );

function action( &amp;$c )
{
    $c-&gt;set( &quot;msg&quot;, &quot;Hello&quot; );
}
?&gt;</pre>
    </td>
  </tr>
  <tr> 
    <td>test.html</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;h1&gt;&lt;?php print $data[&quot;msg&quot;]; ?&gt;&lt;/h1&gt;<br>&lt;!-- この形式の場合以下も可能 --&gt;
&lt;h2&gt;&lt;?php echo $msg; ?&gt;&lt;/h2&gt;

</pre>
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
<h1>View</h1>

<p>&nbsp;&nbsp;You can choice way to write HTML from next four ways.</p>
<ul>
  <li>Write in PHP file</li>
  <li>Separate PHP file and template like smarty.( Faster than smarty because 
    of no parsing )</li>
  <li>Prepare Common template for all pages, and write in PHP file.</li>  
  <li>Prepare Common template for all pages, and Separate PHP file and template.</li>
</ul>

<h2>Write in PHP file</h2>
<p>&nbsp;&nbsp;It's comfortable to create small personal program.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>test.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
    require_once( &quot;cheetan.php&quot; );

function action( &amp;$c )
{
    $c-&gt;set( &quot;msg&quot;, &quot;Hello&quot; );
}
?&gt;
&lt;html&gt;
&lt;body&gt;
&lt;h1&gt;&lt;?php print $data[&quot;msg&quot;]; ?&gt;&lt;/h1&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>
    </td>
  </tr>
</table>
<h2>Separate PHP file and template.</h2>
<p>&nbsp;&nbsp;You can separate action part of PHP and display part like smarty.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>test.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
    require_once( &quot;cheetan.php&quot; );

function action( &amp;$c )
{
    $c-&gt;set( &quot;msg&quot;, &quot;Hello&quot; );
}
?&gt;</pre>
    </td>
  </tr>
  <tr> 
    <td>test.html</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;html&gt;
&lt;body&gt;
&lt;h1&gt;&lt;?php print $data[&quot;msg&quot;]; ?&gt;&lt;/h1&gt;
&lt;!-- in this case, you can use following expression --&gt;
&lt;h2&gt;&lt;?php echo $msg; ?&gt;&lt;/h2&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>
    </td>
  </tr>
</table>
<p>If you specify nothing, template file name will become 'your php file name.html'. 
  Use function 'SetViewFile( string filename )' of Controller if you want to specify 
  file name.</p>
<h2>Prepare common template for all pages and wirte in PHP file</h2>

<p>You can use common template for all pages. Write only HTML of contents by this 
  way. Specify template file name by function 'SetTemplateFile( string filename 
  ) of Controller if you want to use this way.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>template.html</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;html&gt;
&lt;body&gt;
&lt;?php contents( $data ); ?&gt;
&lt;!-- in common template, you can use following expression --&gt;
&lt;?php echo $msg; ?&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>
    </td>
  </tr>
  <tr> 
    <td>test.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
    require_once( &quot;cheetan.php&quot; );

function action( &amp;$c )
{
    $c-&gt;set( &quot;msg&quot;, &quot;Hello&quot; );
}
function contents( $data )
{
?&gt;
&lt;h1&gt;&lt;?php print $data{&quot;msg&quot;]; ?&gt;&lt;/h1&gt;
&lt;?php
}
?&gt;</pre>
    </td>
  </tr>
</table>
<h2>Prepare common template for all pages and separate PHP file and template.</h2>
<p> You can use common template for all pages and separate file of action part 
  and display part. Way of write of template.html is differ from former way a 
  little.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr> 
    <td>template.html</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;html&gt;
&lt;body&gt;
&lt;?php $this-&gt;content( $data ); ?&gt;<br>&lt;!-- in common template, you can use following expression --&gt;
&lt;?php echo $msg; ?&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>
    </td>
  </tr>
  <tr> 
    <td>test.php</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;?php
    require_once( &quot;cheetan.php&quot; );

function action( &amp;$c )
{
    $c-&gt;set( &quot;msg&quot;, &quot;Hello&quot; );
}
?&gt;</pre>
    </td>
  </tr>
  <tr> 
    <td>test.html</td>
  </tr>
  <tr> 
    <td class="source"> 
      <pre>&lt;h1&gt;&lt;?php print $data{&quot;msg&quot;]; ?&gt;&lt;/h1&gt;<br>&lt;!-- in this case, you can use following expression --&gt;
&lt;h2&gt;&lt;?php echo $msg; ?&gt;&lt;/h2&gt;
</pre>
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