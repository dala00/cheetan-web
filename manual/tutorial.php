<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );

function content( $data )
{
?>
<h1>チュートリアル</h1>

<p>&nbsp;&nbsp;ブログを作成する例を見ながら、以下を参考にちいたんフレームワークの何を、どのように使用するかを決定しましょう。</p>

<h2>データベースを使う</h2>

<p>&nbsp;&nbsp;現在ちいたんフレームワークはmysql, postgresql, textsqlに対応しています(その他にも柔軟に対応可能）。 
  チュートリアルではmysqlでの説明をします。データベースの初期化は、フレームワークによって呼ばれる関数config_databaseによって設定します。 
  以下に例を示します。どのファイルからも参照できるようにconfig.phpというコンフィグファイルを作成してそこに関数を書きます。</p>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
  	<td>config.php</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>
&lt;?php
function config_database( &amp;$db )
{
    $db-&gt;add( &quot;&quot;, &quot;localhost&quot;, &quot;user&quot;, &quot;password&quot;, &quot;dbname&quot; );
}
?&gt;</pre>
    </td>
  </tr>
</table>

  
<h2>モデルを使う</h2>
<p>モデルはテーブルを扱うクラスです。これを用意するだけでソースを書く必要が無くなります。試してみましょう。
まずブログ用に以下の様なテーブルを作成します。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td class="source">
      <pre>
CREATE TABLE `blog_data` (
  `id` int(11) NOT NULL auto_increment,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `modified` timestamp NOT NULL
  default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
);</pre>
	</td>
  </tr>
</table>

<p>次にモデルを作成します。わかりやすいようにmodelsフォルダ内にでも入れておきましょう。</p>

<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
  	<td>models/blog_data.php</td>
  </tr>
  <tr>
    <td class="source">
      <pre>&lt;?php
class CBlog_data extends CModel
{
}
?&gt;</pre>
	</td>
  </tr>
</table>

<p>あれ、何も書いてない…そうなんです。これだけでデータベースの読み書きが出来てしまいます。 どのように行うかは後のお楽しみ。びっくりするほど簡単です。では、このモデルを使用するために、config.php内にフレームワークから呼ばれる関数を追加しましょう。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
  	<td>config.php追加分</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>function config_models( &amp;$controller )
{
    $controller-&gt;AddModel( dirname(__FILE__) . &quot;/models/blog_data.php&quot; );
}</pre>
    </td>
  </tr>
</table>

<h2>ビューを使う</h2>
<p>ビューは表示部分です。実際のHTMLを書きます。
HTMLを書くにはなんとこれだけの方法が用意されています。</p>
<ul>
<li>PHPファイルに直接書く</li>
<li>smartyの用にPHPファイルとテンプレートを分ける（構文解析が無い分恐らく高速）</li>
<li>全ファイル共通のテンプレートを用意し、コンテンツ部分をPHPファイルに直接書く</li>
<li>全ファイル共通のテンプレートを用意し、PHPファイルとテンプレートを分ける</li>
</ul>
<p>
詳しくはマニュアルのビューにて解説しています。今回は４番目の全ファイル共通のテンプレートを用意し、
PHPファイルとテンプレートを分ける方法を使用します。
</p>
<p>まず全ファイル共通テンプレートを用意しましょう。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
  	<td>template.html</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>&lt;!DOCTYPE HTML PUBLIC &quot;-//W3C//DTD HTML 4.01 Transitional//EN&quot;&gt;
&lt;html&gt;
&lt;head&gt;
&lt;meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=EUC-JP&quot;&gt;
&lt;title&gt;ちいたんブログ&lt;/title&gt;
&lt;link href=&quot;style.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;?php print $this-&gt;content(); ?&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>
    </td>
  </tr>
</table>
<p>とまあ、こんなものでしょうか。DreamWeaverそのままですが。
今回の場合$this->content();のところに各ページのコンテンツが表示されます。</p>
<p>続いてブログを書き込むページを用意します。共通テンプレートを使用しているので中身だけです。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
  	<td>add.html</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>&lt;form method=&quot;post&quot; action=&quot;add.php&quot;&gt;
タイトル&lt;br&gt;
&lt;input type=&quot;text&quot; name=&quot;blog/title&quot;&gt;&lt;br&gt;
内容&lt;br&gt;
&lt;textarea cols=40 rows=8 name=&quot;blog/body&quot;&gt;&lt;/textarea&gt;&lt;br&gt;
&lt;input type=&quot;submit&quot; value=&quot;書き込み&quot;&gt;
&lt;/form&gt;</pre>
    </td>
  </tr>
</table>

<h2>コントローラーを使う</h2>
<p>コントローラーにより今まで作成したモデル、ビュー全てを連結し、動作させます。
ファイルは何の指定もなければビューの拡張子をphpに変えたものです。
まずは先ほどビューで作成したフォームにより、データを保存するプログラムがどれだけ少ないかご覧下さい。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
  	<td>add.php</td>
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
        $c-&gt;blog_data-&gt;insert( $c-&gt;data[&quot;blog&quot;] );
    }
}
?&gt;</pre>
	</td>
  </tr>
</table>
<p>blog_dataというモデルがここで使用されているのがおわかりでしょうか。 ビューでインプットの名前にblog/title等という変な名前を指定していたのは、 
  blog/で指定されているデータをコントローラ側で$data["blog"]の配列に 自動的に挿入するためでした。</p>
<p>
こうやって必要なデータだけを配列に集め、insertします。</p>

<h2>一覧表示</h2>
<p>では書き込んだデータを一覧表示してみましょう。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
  	<td>view.php</td>
  </tr>
  <tr>
    <td class="source">
      <pre>&lt;?php
    require_once( &quot;config.php&quot; );
    require_once( &quot;cheetan.php&quot; );

function action( &amp;$c )
{
    $c-&gt;set( &quot;datas&quot;, $c-&gt;blog_data-&gt;find() );
}
?&gt;</pre>
	</td>
  </tr>
  <tr>
  	<td>view.html</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>&lt;?php foreach( $data[&quot;datas&quot;] as $data ){ ?&gt;
&lt;table&gt;
  &lt;tr&gt;
    &lt;td&gt;&lt;?php print $data[&quot;title&quot;]; ?&gt;&lt;/td&gt;
    &lt;td&gt;&lt;?php print str_replace( &quot;\n&quot;, &quot;&lt;br&gt;&quot;, $data[&quot;body&quot;] ); ?&gt;&lt;/td&gt;
    &lt;td&gt;&lt;?php print $data[&quot;modified&quot;]; ?&gt;&lt;/td&gt;
  &lt;/tr&gt;
&lt;/table&gt;
&lt;?php } ?&gt;</pre>
	</td>
  </tr>
</table>
<p>このようにset関数によりビュー内で値を$dataとして参照することが出来ます。</p>

<h2>データの編集</h2>
<p>ではデータを編集してみましょう。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
  	<td>edit.php</td>
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
        $c-&gt;blog_data-&gt;update( $c-&gt;data[&quot;blog&quot;] );
    }
    $c-&gt;set( &quot;data&quot;, $c-&gt;blog_data-&gt;find( &quot;id=&quot; . $_GET[&quot;id&quot;] ) );
}
?&gt;</pre>
	</td>
  </tr>
  <tr>
  	<td>edit.html</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>&lt;form method=&quot;post&quot; action=&quot;edit.php&quot;&gt;
タイトル&lt;br&gt;
&lt;input type=&quot;text&quot; name=&quot;blog/title&quot;
 value=&quot;&lt;?php print $data[&quot;data&quot;][&quot;title&quot;]; ?&gt;&quot;&gt;&lt;br&gt;
内容&lt;br&gt;
&lt;textarea cols=40 rows=6 name=&quot;blog/body&quot;&gt;
&lt;?php print $data[&quot;data&quot;][&quot;body&quot;]; ?&gt;&lt;/textarea&gt;&lt;br&gt;
&lt;input type=&quot;hidden&quot; name=&quot;blog/id&quot;
 value=&quot;&lt;?php print $data[&quot;data&quot;][&quot;id&quot;]; ?&gt;&quot;&gt;
&lt;input type=&quot;submit&quot; value=&quot;更新&quot;&gt;
&lt;/form&gt;
</pre>
	</td>
  </tr>
</table>

<h2>データの削除</h2>
<p>ではデータを削除してみましょう。もうある程度予想がつきますね。</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
  	<td>del.php</td>
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
        $c-&gt;blog_data-&gt;del( &quot;id=&quot; . $_POST[&quot;id&quot;] );
    }
    $c-&gt;set( &quot;data&quot;, $c-&gt;blog_data-&gt;find( &quot;id=&quot; . $_GET[&quot;id&quot;] ) );
}
?&gt;</pre>
	</td>
  </tr>
  <tr>
  	<td>del.html</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>&lt;form method=&quot;post&quot; action=&quot;edit.php&quot;&gt;
削除してもよろしいですか？&lt;br&gt;
タイトル&lt;br&gt;
&lt;?php print $data[&quot;data&quot;][&quot;title&quot;]; ?&gt;&lt;br&gt;
内容&lt;br&gt;
&lt;?php print $data[&quot;data&quot;][&quot;body&quot;]; ?&gt;&lt;br&gt;
&lt;input type=&quot;hidden&quot; name=&quot;id&quot; value=&quot;&lt;?php print $data[&quot;data&quot;][&quot;id&quot;]; ?&gt;&quot;&gt;
&lt;input type=&quot;submit&quot; value=&quot;削除&quot;&gt;
&lt;/form&gt;
</pre>
	</td>
  </tr>
</table>

<h2>まとめ</h2>
<p>
これで一通りブログっぽくなりました。このように非常に簡単にアプリケーションを作成することが出来ます。
もうフレームワークを使わないプログラムややモデルのないフレームワークなんて使う気になれませんよね？
</p>
<p>大きなプログラムを作る時はCakePHP、小さなプログラムを作る時はちいたん。これが世界標準になるでしょう。(僕の）</p>
<p>&nbsp;</p>
<p>ちいたんフレームワークにはもうちょっと便利な機能が用意されています。是非マニュアルを参考に色々と試してみてください。<br>

<h2>サンプル</h2>
今回のチュートリアルを形にしたものは<a href="sample/blog.php">こちら</a>

  <br>
  <br>
</p>
<?php
}



function content_eng( $data )
{
?>
<h1>Tutorial</h1>

<p>&nbsp;&nbsp;This is a tutorial of creating blog.</p>

<h2>Use database.</h2>

<p>&nbsp;&nbsp;Cheetan can deal with mysql, postgresql, textsql by default. You 
  can use any sql by easy modify. I use mysql in this tutorial. You set up database 
  in function 'config_database' which is called by framework. Example is as follows. 
  You usually write this function in config.php in order to refer from other sources.</p>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
  	<td>config.php</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>
&lt;?php
function config_database( &amp;$db )
{
    $db-&gt;add( &quot;&quot;, &quot;localhost&quot;, &quot;user&quot;, &quot;password&quot;, &quot;dbname&quot; );
}
?&gt;</pre>
    </td>
  </tr>
</table>

  
<h2>Use Model</h2>
<p>Model is class for deal width table. You can deal with table without write 
  source by use Model. Let's try. First of all, create table for blog like this.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
    <td class="source">
      <pre>
CREATE TABLE `blog_data` (
  `id` int(11) NOT NULL auto_increment,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `modified` timestamp NOT NULL
  default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
);</pre>
	</td>
  </tr>
</table>

<p>Next, create Model. I put it in models directory in this example.</p>

<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
  	<td>models/blog_data.php</td>
  </tr>
  <tr>
    <td class="source">
      <pre>&lt;?php
class CBlog_data extends CModel
{
}
?&gt;</pre>
	</td>
  </tr>
</table>

<p>Oh, nothing is written...? Yes. You can deal with table by only this code. 
  Look at latter explanation to know how to use this. It's very easy. Then, write 
  next function called by framework for regist this model in config.php.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
  	<td>config.php</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>function config_models( &amp;$controller )
{
    $controller-&gt;AddModel( dirname(__FILE__) . &quot;/models/blog_data.php&quot; );
}</pre>
    </td>
  </tr>
</table>

<h2>Use View</h2>
<p>View is a part of actual HTML code. This framework provide you next four way 
  to write HTML.</p>
<ul>
  <li>Write in PHP file directly</li>
  <li>Separate PHP file and template like smarty.( It's faster than smarty because 
    of no parsing. )</li>
  <li>Prepare common template for all pages and write in PHP file directly.</li>
  <li>Prepare common template for all pages and separate PHP file and template 
    file.</li>
</ul>
<p> Look at the part to know detail. I use the fourth way in this tutorial.</p>
<p>First, create common template</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
  	<td>template.html</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>&lt;!DOCTYPE HTML PUBLIC &quot;-//W3C//DTD HTML 4.01 Transitional//EN&quot;&gt;
&lt;html&gt;
&lt;head&gt;
&lt;meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=EUC-JP&quot;&gt;
&lt;title&gt;Cheetan blog&lt;/title&gt;
&lt;link href=&quot;style.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;?php print $this-&gt;content(); ?&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>
    </td>
  </tr>
</table>
<p>Each pages contents is displayed at $this->content(); in this case.</p>
<p>Next, create page to post blog data. You only write as follows because common 
  template is used.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
  	<td>add.html</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>&lt;form method=&quot;post&quot; action=&quot;add.php&quot;&gt;
title&lt;br&gt;
&lt;input type=&quot;text&quot; name=&quot;blog/title&quot;&gt;&lt;br&gt;
body&lt;br&gt;
&lt;textarea cols=40 rows=8 name=&quot;blog/body&quot;&gt;&lt;/textarea&gt;&lt;br&gt;
&lt;input type=&quot;submit&quot; value=&quot;write&quot;&gt;
&lt;/form&gt;</pre>
    </td>
  </tr>
</table>

<h2>Use Controller</h2>
<p>Controller chain Model and View you created and make them work. Filename of 
  Controller is 'filename of view'.php First of all look at how small source code 
  to save post data.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
  	<td>add.php</td>
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
        $c-&gt;blog_data-&gt;insert( $c-&gt;data[&quot;blog&quot;] );
    }
}
?&gt;</pre>
	</td>
  </tr>
</table>
<p>You can see Model blog_data is used here. Framework automatically put them 
  in array '$data[&quot;blog&quot;]' that post data which name is specified like 
  'blog/'.</p>
<p> Like this, you collect necessary data in array and call funtion 'insert'.</p>

<h2>Display posts</h2>
<p>Let's display list of posts.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
  	<td>view.php</td>
  </tr>
  <tr>
    <td class="source">
      <pre>&lt;?php
    require_once( &quot;config.php&quot; );
    require_once( &quot;cheetan.php&quot; );

function action( &amp;$c )
{
    $c-&gt;set( &quot;datas&quot;, $c-&gt;blog_data-&gt;find() );
}
?&gt;</pre>
	</td>
  </tr>
  <tr>
  	<td>view.html</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>&lt;?php foreach( $data[&quot;datas&quot;] as $data ){ ?&gt;
&lt;table&gt;
  &lt;tr&gt;
    &lt;td&gt;&lt;?php print $data[&quot;title&quot;]; ?&gt;&lt;/td&gt;
    &lt;td&gt;&lt;?php print str_replace( &quot;\n&quot;, &quot;&lt;br&gt;&quot;, $data[&quot;body&quot;] ); ?&gt;&lt;/td&gt;
    &lt;td&gt;&lt;?php print $data[&quot;modified&quot;]; ?&gt;&lt;/td&gt;
  &lt;/tr&gt;
&lt;/table&gt;
&lt;?php } ?&gt;</pre>
	</td>
  </tr>
</table>
<p>You can refer value in View as $data by function 'set'.</p>

<h2>Edit post</h2>
<p>Let's edit data.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
  	<td>edit.php</td>
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
        $c-&gt;blog_data-&gt;update( $c-&gt;data[&quot;blog&quot;] );
    }
    $c-&gt;set( &quot;data&quot;, $c-&gt;blog_data-&gt;find( &quot;id=&quot; . $_GET[&quot;id&quot;] ) );
}
?&gt;</pre>
	</td>
  </tr>
  <tr>
  	<td>edit.html</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>&lt;form method=&quot;post&quot; action=&quot;edit.php&quot;&gt;
title&lt;br&gt;
&lt;input type=&quot;text&quot; name=&quot;blog/title&quot;
 value=&quot;&lt;?php print $data[&quot;data&quot;][&quot;title&quot;]; ?&gt;&quot;&gt;&lt;br&gt;
body&lt;br&gt;
&lt;textarea cols=40 rows=6 name=&quot;blog/body&quot;&gt;
&lt;?php print $data[&quot;data&quot;][&quot;body&quot;]; ?&gt;&lt;/textarea&gt;&lt;br&gt;
&lt;input type=&quot;hidden&quot; name=&quot;blog/id&quot;
 value=&quot;&lt;?php print $data[&quot;data&quot;][&quot;id&quot;]; ?&gt;&quot;&gt;
&lt;input type=&quot;submit&quot; value=&quot;modify&quot;&gt;
&lt;/form&gt;
</pre>
	</td>
  </tr>
</table>

<h2>Delete data</h2>
<p>Let's delete data.</p>
<table width="100%" border="0" cellspacing="0" cellpadding="8">
  <tr>
  	<td>del.php</td>
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
        $c-&gt;blog_data-&gt;del( &quot;id=&quot; . $_POST[&quot;id&quot;] );
    }
    $c-&gt;set( &quot;data&quot;, $c-&gt;blog_data-&gt;find( &quot;id=&quot; . $_GET[&quot;id&quot;] ) );
}
?&gt;</pre>
	</td>
  </tr>
  <tr>
  	<td>del.html</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>&lt;form method=&quot;post&quot; action=&quot;edit.php&quot;&gt;
Can I delete data?&lt;br&gt;
title&lt;br&gt;
&lt;?php print $data[&quot;data&quot;][&quot;title&quot;]; ?&gt;&lt;br&gt;
body&lt;br&gt;
&lt;?php print $data[&quot;data&quot;][&quot;body&quot;]; ?&gt;&lt;br&gt;
&lt;input type=&quot;hidden&quot; name=&quot;id&quot; value=&quot;&lt;?php print $data[&quot;data&quot;][&quot;id&quot;]; ?&gt;&quot;&gt;
&lt;input type=&quot;submit&quot; value=&quot;del&quot;&gt;
&lt;/form&gt;
</pre>
	</td>
  </tr>
</table>

<h2>End</h2>
<p> You could create blog. You can create application easily like this. You must 
  enable to create program without framework.</p>
<p>&nbsp;</p>
<p>Other useful functions are prepared in Cheetan. Try others with the manual.<br>

<h2>Sample</h2>
Access <a href="sample/blog.php">here</a> to view or get sample.

  <br>
  <br>
</p>
<?php
}

?>