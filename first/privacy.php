<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );

function content( $data )
{
?>
<h2 style="margin-top:0px;">プライバシーポリシー</h2>

<h3>公開</h3>
メールアドレス、パスワードは第三者に公開することはありません。
<h3>メールアドレス</h3>
何かしらの連絡を行う為にのみ使用させて頂きます。不要な連絡は避けるよう、ユーザーには選択の機能を提供します。
<h3>安全管理</h3>
情報が守られるよう、必要且つ適切な安全管理を行います。
<br>
  <br>
  <?php
}





function content_eng( $data )
{
?>
<h1>Privacy policy</h1>


<h3>publicity</h3>
I never make mail address and password public.
<h3>mail address</h3>
I use this for something to inform. You can select if you receive.
<h3>safe</h3>
I save your informations.
<br>
  <br>
  <?php
}
?>