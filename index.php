<?php
	require_once( "config.php" );
	require_once( "cheetan/cheetan.php" );


function action( &$c )
{
	$capacity	= 0;
	if( $dh = opendir( "cheetan" ) )
	{
		while( ( $filename = readdir( $dh ) ) !== false )
		{
			if( is_file( "cheetan/$filename" ) )
			{
				$capacity	+= filesize( "cheetan/$filename" );
			}
		}
		closedir( $dh );
	}
	
	$capacity_mysql	= $capacity;
	
	if( $dh = opendir( "cheetan/db" ) )
	{
		while( ( $filename = readdir( $dh ) ) !== false )
		{
			if( is_file( "cheetan/db/$filename" ) )
			{
				$capacity	+= filesize( "cheetan/db/$filename" );
			}
		}
		closedir( $dh );
	}
	
	$capacity_mysql	+= filesize( 'cheetan/db/common.php' );
	$capacity_mysql	+= filesize( 'cheetan/db/mysql.php' );
	
	$c->set( "capacity", (int)( $capacity / 1024 ) );
	$c->set( 'capacity_mysql', (int)( $capacity_mysql / 1024 ) );
}


function content( $data )
{
?>
<h1>PHPフレームワーク　ちいたん</h1>

<p>&nbsp;&nbsp;ちいたんとは<b>世界最軽量</b>のPHP用MVCフレームワークです。</p>
<p>&nbsp;&nbsp;ちなみに私は普段<a href="http://cakephp.org/">CakePHP</a>を使用していますが、
それを使用するほど大きなプロジェクトではなく、でも多少手のかかる物の場合に使えるフレームワークがほしい…
そんなときに使えるフレームワークを目指して作成しました。
</p>
<p>&nbsp;&nbsp;ちなみにちいたんというのは制作者の奥さんの愛称です。 </p>
<p>&nbsp;&nbsp;ライセンスはMITです。 </p>
<h2>当サイトについて</h2>

<p>
  当サイト（元々 http://php.cheetan.net ）はドメイン失効により消滅し、最初のリリースから14年後、2020年のある日にふと思い立って復旧させた記念サイトです。データベース関連は紛失のため復旧していないため、機能自体動作していません。
</p>

<section>
  <h3>作者のちいたんリポジトリ</h3>
  <p>
    <a href="https://github.com/dala00/cheetan" target="_blank">https://github.com/dala00/cheetan</a>
  </p>
</section>

<section>
  <h3>PHP7に対応</h3>
  <p>
    PHP7に対応してくださった方がいたようです。<br>
    <a href="https://github.com/symfoware/cheetan" target="_blank">https://github.com/symfoware/cheetan</a>
  </p>
  <p>
    そのあたりのことを書いていただいたブログです。<br>
    <a href="https://symfoware.blog.fc2.com/blog-entry-2355.html" target="_blank">
      軽量PHPフレームワーク「ちいたん」 PHP 7系対応 - Symfoware
    </a>
  </p>
  <p>
    さらにマニュアルも作っていただいているようです。<br>
    <a href="https://symfo.web.fc2.com/etc/cheetan/userguide/index.html" target="_blank">ちいたん ユーザガイド</a>
  </p>
</section>

<section>
  <h3>当サイトのソースコード</h3>
  <p>
    当サイトのソースコードはGitHubで公開しています。（PSRも無かった時代のものでひどい作りになっていますのでご容赦下さい）<br>
    <a href="https://github.com/dala00/cheetan-web" target="_blank">https://github.com/dala00/cheetan-web</a>
  </p>
  <p>
    作者の方でアップデートを行うことはありませんので、もしもっとちゃんと作り直したい、他にも機能を追加したい、OSSの練習をしたいなどあればもう何でも自由にプルリクエストを送っていただいて大丈夫です。フレームワークを変えてもいいし、PHPでなくてもかまいません。
  </p>
</section>

<h2>新着情報</h2>

<p>&nbsp;&nbsp;バージョン0.8.1.0公開。model.phpのquery関数バグFIXです。</p>

<p>&nbsp;&nbsp;CakePHP風のアクションメソッドを利用するコントローラー仕様の拡張パックを作成致しました。プロジェクトにてご確認下さい。
</p>

<p>&nbsp;&nbsp;バージョン0.8.0.8公開。mysqlのポート指定バグ修正、バリデート仕様拡張。具体的な内容はバリデートマニュアルをご確認下さい。
</p>

<p> &nbsp;&nbsp;バージョン0.7.9.9公開。MySQLのポート指定＋バグfix、仕様拡張を行いました。具体的な内容はダウンロードページをご覧下さい。 
  <br>
  <font color="#FF0000">CDBMysqlのconnectメソッドにバグがありました。$confirは$configの間違いです。</font></p>
<p>
&nbsp;&nbsp;プロジェクトを登録できるようになりました。SourceForgeの様なサーバースペースはありませんが、公開することが出来ます。
コンポーネントやサンプルプログラムなど、公開できるものがございましたらぜひご利用下さい。
登録には<a href="user/regist.php">ユーザー登録</a>が必要です。
</p>

<br><br>


<h2>このサイト</h2>

<p>&nbsp;&nbsp;このサイトはちいたん（奥さんの方ではありません）を利用して作られています。 ちなみに、<font color="blue">現在のちいたんフレームワークの総容量は(非圧縮で）<b> 
  <?php print $data["capacity"]; ?>Kバイト</b></font>です。MySQLのみを使用して余分なファイル(db/mysql.php, db/common.php以外)を削除すると、
  <font color="blue"><b><?php echo $data['capacity_mysql']; ?>Kバイト</b></font>になります。</p>

<h2>ちいたん(PHPフレームワークの方）の特徴</h2>

<h3>・最小ソースコードはこれだけです。</h3>

<p>お客様のサーバーにsmarty設置させるのもまどろっこしい。構文解析なんて勘弁！</p>
<table width="100%" border="0" cellspacing="4" cellpadding="0">
  <tr>
    <td>１ファイルの場合</td>
    <td>テンプレート使用の場合</td>
  </tr>
  <tr>
    <td class="source">
      <pre>
&lt;?php
    require_once( "cheetan.php" );

function action( &amp;$c )
{
    $c-&gt;set( &quot;msg&quot;, &quot;Hello, World!&quot; );
}
?&gt;
&lt;html&gt;
&lt;body&gt;
&lt;h1&gt;&lt;?php print $data[&quot;msg&quot;]; ?&gt;&lt;/h1&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>
	</td>
    <td class="source"> 
      <pre>----hello.php----
&lt;?php
    require_once( &quot;cheetan.php&quot; );

function action( &amp;$c )
{
    $c-&gt;set( &quot;msg&quot;, &quot;Hello, World!&quot; );
}
?&gt;


----hello.html----
&lt;html&gt;
&lt;body&gt;
&lt;h1&gt;&lt;?php print $data[&quot;msg&quot;]; ?&gt;&lt;/h1&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>
	</td>
  </tr>
</table>

<h3>・テンプレートも使えます。</h3>

<p>全てのページで同じテンプレートを使いたい時</p>


<table width="100%" border="0" cellspacing="4" cellpadding="0">
  <tr>
    <td>１ファイルの場合</td>
    <td>テンプレート使用の場合</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>----temp.html----
&lt;html&gt;
&lt;body&gt;
&lt;?php contents( $data ); ?&gt;
&lt;/body&gt;
&lt;/html&gt;


----hello.php----

&lt;?php
    require_once( "cheetan.php" );

function action( &amp;$c )
{
    $c-&gt;SetTemplateFile( &quot;temp.html&quot; );
    $c-&gt;set( &quot;msg&quot;, &quot;Hello, World!&quot; );
}

function contents( $data )
{
?&gt;
&lt;h1&gt;&lt;?php print $data[&quot;msg&quot;] ); ?&gt;&lt;/h1&gt;
&lt;?php
}
?&gt;</pre>
	</td>
    <td class="source"> 
      <pre>----temp.html----
&lt;html&gt;
&lt;body&gt;
&lt;?php $this-&gt;content(); ?&gt;
&lt;/body&gt;
&lt;/html&gt;


----hello.php----
&lt;?php
    require_once( &quot;cheetan.php&quot; );

function action( &amp;$c )
{
    $c-&gt;SetTemplateFile( &quot;temp.html&quot; );
    $c-&gt;set( &quot;msg&quot;, &quot;Hello, World!&quot; );
}
?&gt;


----hello.html----
&lt;h1&gt;&lt;?php print $data[&quot;msg&quot;]; ?&gt;&lt;/h1&gt;
</pre>
	</td>
  </tr>
</table>
<h3>・モデルも完備。</h3>
<p>データベースへの保存もこれだけ。</p>
<table width="100%" border="0" cellspacing="4" cellpadding="0">
  <tr> 
    <td class="source"> 
      <pre>
----config.php----
function config_database( &amp;$db )
{
    $db-&gt;add( &quot;&quot;, &quot;localhost&quot;, &quot;user&quot;, &quot;password&quot;, &quot;db&quot; );
}

function config_models( &amp;$controller )
{
    $controller-&gt;AddModel( &quot;user.php&quot; );
}


----user.php----
class CUser extends CModel
{

}


----test.php----
&lt;?php
    require_once( &quot;config.php&quot; );
    require_once( "cheetan.php" );

function action( &amp;$c )
{
    if( count( $_POST ) )
    {
        $c-&gt;user-&gt;insert( $c-&gt;data[&quot;user&quot;] );
    }
}
?&gt;
&lt;form method=&quot;post&quot; action=&quot;test.php&quot;&gt;
名前&lt;br&gt;
&lt;input type=&quot;text&quot; name=&quot;user/name&quot;&gt;&lt;br&gt;
メールアドレス&lt;br&gt;
&lt;input type=&quot;text&quot; name=&quot;user/email&quot;&gt;
&lt;/form&gt;

</pre>
    </td>
  </tr>
</table>
<br>
<?php
}





function content_eng( $data )
{
?>
<h1>PHP framework　'Cheetan'</h1>

<p>&nbsp;&nbsp;Cheetan is MVC framework which is <b>lightest in the world(?)</b> for PHP.</p>
<p>&nbsp;&nbsp;By the way, I usually use <a href="http://cakephp.org/">CakePHP</a>.
 But I want framework that I able to use when the project isn't so large-scale but is a little tired...
 So I developed such a framework.
</p>
<p>&nbsp;&nbsp;By the way, 'Cheetan' is a nickname of developer's wife.</p>
<p>&nbsp;&nbsp;Cheetan is licensed under the MIT license.</p>

<h2>Information</h2>

<p>
  This site once disappeared because domain expired. This is just a revived (2020) memorial site.
</p>

<section>
  <h3>Cheetan repository</h3>
  <p>
    <a href="https://github.com/dala00/cheetan" target="_blank">https://github.com/dala00/cheetan</a>
  </p>
</section>

<section>
  <h3>PHP7</h3>
  <p>
    Someone upgraded for PHP7<br>
    <a href="https://github.com/symfoware/cheetan" target="_blank">https://github.com/symfoware/cheetan</a>
  </p>
  <p>
    The blog article about it.<br>
    <a href="https://symfoware.blog.fc2.com/blog-entry-2355.html" target="_blank">
      軽量PHPフレームワーク「ちいたん」 PHP 7系対応 - Symfoware
    </a>
  </p>
  <p>
    He created a manual site. Thanks.<br>
    <a href="https://symfo.web.fc2.com/etc/cheetan/userguide/index.html" target="_blank">ちいたん ユーザガイド</a>
  </p>
</section>

<section>
  <h3>Source code of this site</h3>
  <p>
    Source code of this site is available on GitHub. (I'm sorry it's so dirty because even no PSR in 2006)<br>
    <a href="https://github.com/dala00/cheetan-web" target="_blank">https://github.com/dala00/cheetan-web</a>
  </p>
  <p>
    Feel free to contribute.
  </p>
</section>

<h2>News</h2>

<p>&nbsp;&nbsp;Version0.8.1.0 released. Buf fix of query function of model.php</p>

<p>&nbsp;&nbsp;Action method controller project is released. Try.
</p>

<p>&nbsp;&nbsp;Version0.8.0.8 released. Fixed bug of MySQL port specify. Extended validation.
</p>
<p>
&nbsp;&nbsp;Version0.7.9.9 released. Fixed bug of PgSQL. Extended some methods.
</p>
<p>
&nbsp;&nbsp;Project registration system is released. There is no server space like sourceforge, 
but you can release your project here.
Use if you have any projects like components or sample program.
You need to <a href="user/regist.php">user regist</a> to regist projects.
</p>

<br><br>



<h2>This site</h2>

<p>&nbsp;&nbsp;This site is made with Cheetan ( which is not my wife ).
<font color="blue">Sum of capacity of framework is <b> 
  <?php print $data["capacity"]; ?>KByte</b></font>( In non-compression ).</p>

<h2>Characteristic</h2>

<h3>・The shortest source is as follows.</h3>

<p>It takes time to make customer installed Smarty. I hate to perse!</p>
<table width="100%" border="0" cellspacing="4" cellpadding="0">
  <tr>
    <td>Case of one file</td>
    <td>Case of php code and template file</td>
  </tr>
  <tr>
    <td class="source">
      <pre>
&lt;?php
    require_once( "cheetan.php" );

function action( &amp;$c )
{
    $c-&gt;set( &quot;msg&quot;, &quot;Hello, World!&quot; );
}
?&gt;
&lt;html&gt;
&lt;body&gt;
&lt;h1&gt;&lt;?php print $data[&quot;msg&quot;]; ?&gt;&lt;/h1&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>
	</td>
    <td class="source"> 
      <pre>----hello.php----
&lt;?php
    require_once( &quot;cheetan.php&quot; );

function action( &amp;$c )
{
    $c-&gt;set( &quot;msg&quot;, &quot;Hello, World!&quot; );
}
?&gt;


----hello.html----
&lt;html&gt;
&lt;body&gt;
&lt;h1&gt;&lt;?php print $data[&quot;msg&quot;]; ?&gt;&lt;/h1&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>
	</td>
  </tr>
</table>

<h3>・You can use common template.</h3>

<p>Case of use common template at all pages.</p>


<table width="100%" border="0" cellspacing="4" cellpadding="0">
  <tr>
    <td>Case of one file</td>
    <td>Case of php code and template file</td>
  </tr>
  <tr>
    <td class="source"> 
      <pre>----temp.html----
&lt;html&gt;
&lt;body&gt;
&lt;?php contents( $data ); ?&gt;
&lt;/body&gt;
&lt;/html&gt;


----hello.php----

&lt;?php
    require_once( "cheetan.php" );

function action( &amp;$c )
{
    $c-&gt;SetTemplateFile( &quot;temp.html&quot; );
    $c-&gt;set( &quot;msg&quot;, &quot;Hello, World!&quot; );
}

function contents( $data )
{
?&gt;
&lt;h1&gt;&lt;?php print $data[&quot;msg&quot;] ); ?&gt;&lt;/h1&gt;
&lt;?php
}
?&gt;</pre>
	</td>
    <td class="source"> 
      <pre>----temp.html----
&lt;html&gt;
&lt;body&gt;
&lt;?php $this-&gt;content(); ?&gt;
&lt;/body&gt;
&lt;/html&gt;


----hello.php----
&lt;?php
    require_once( &quot;cheetan.php&quot; );

function action( &amp;$c )
{
    $c-&gt;SetTemplateFile( &quot;temp.html&quot; );
    $c-&gt;set( &quot;msg&quot;, &quot;Hello, World!&quot; );
}
?&gt;


----hello.html----
&lt;h1&gt;&lt;?php print $data[&quot;msg&quot;]; ?&gt;&lt;/h1&gt;
</pre>
	</td>
  </tr>
</table>
<h3>・You can use Model.</h3>
<p>It's only this source code that to save to database.</p>
<table width="100%" border="0" cellspacing="4" cellpadding="0">
  <tr> 
    <td class="source"> 
      <pre>
----config.php----
function config_database( &amp;$db )
{
    $db-&gt;add( &quot;&quot;, &quot;localhost&quot;, &quot;user&quot;, &quot;password&quot;, &quot;db&quot; );
}

function config_models( &amp;$controller )
{
    $controller-&gt;AddModel( &quot;user.php&quot; );
}


----user.php----
class CUser extends CModel
{

}


----test.php----
&lt;?php
    require_once( &quot;config.php&quot; );
    require_once( "cheetan.php" );

function action( &amp;$c )
{
    if( count( $_POST ) )
    {
        $c-&gt;user-&gt;insert( $c-&gt;data[&quot;user&quot;] );
    }
}
?&gt;
&lt;form method=&quot;post&quot; action=&quot;test.php&quot;&gt;
name&lt;br&gt;
&lt;input type=&quot;text&quot; name=&quot;user/name&quot;&gt;&lt;br&gt;
email&lt;br&gt;
&lt;input type=&quot;text&quot; name=&quot;user/email&quot;&gt;
&lt;/form&gt;

</pre>
    </td>
  </tr>
</table>
<br>
<?php
}
?>
