<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );

function content( $data )
{
?>
<h1>コンセプト</h1>

<p>&nbsp;&nbsp;ちいたんはいつでもどこでも気軽に使える超簡単で便利な世界最軽量PHP用MVCフレームワークです。</p>
<p>&nbsp;&nbsp;普段作者はCakePHPを好んで使用していますが、小さなプログラムを作ってしかもお客さんに配布する時、
どうしてもCakePHPを丸ごと渡す気にはなれません。</p>
<p>&nbsp;&nbsp;そんな時世界最軽量フレームワークであるちいたんを使用すれば、気兼ねなくフレームワークを使用でき、
お客さんに何も難しいことは考えず簡単に配布することが可能です。 
</p>

<h2>軽いだけじゃない</h2>

<p>&nbsp;&nbsp;小さければいいのか、というともちろんそうではありません。 その辺に氾濫している「モデルがない？」とか「PEAR等に依存性が激しい」というフレームワークとは違います。 
</p>
<p>&nbsp;&nbsp;モデル、ビュー、コントローラは当然、サニタイザ、バリデータなど最低限必要な物は組み込まれています。
しかもCakePHPを参考に作成されているので、コードを最小限にするための工夫がなされています。</p>

<h2>奥さんの方</h2>

<p>&nbsp;&nbsp;ちいたんという名前作者の奥さんの愛称です。
奥さんの方のちいたんは身長146cm見た目はちっちゃい子供のようでいつも変なかわいらしい動きをしている女の子です。</p>
<br>
  <br>
  <?php
}


function content_eng( $data )
{
?>
<h1>Concept</h1>

<p>&nbsp;&nbsp;Cheetan is MVC framework for PHP which is very easy and useful that you can use anytime anywhere.</p>
<p>&nbsp;&nbsp;I usually use CakePHP. But I don't think to use it when I develop small-scale program and provide it to customer.</p>
<p>&nbsp;&nbsp;Such a time, you can provide it lightheartedly if you use Cheetan because it's very light. 
</p>

<h2>Not only light</h2>

<p>&nbsp;&nbsp;Only light is best? Not. Cheetan is differ from framework which 
  is flooded like &quot;no model?&quot;, &quot;must use pear&quot; etc...</p>
<p>&nbsp;&nbsp;Cheetan has things you need like Model, View, Controller, sanitizer 
  and validater etc. Moreover it has ideas to make your source code light because 
  it has been developed by refer to CakePHP.</p>

<h2>Wife</h2>

<p>&nbsp;&nbsp;Cheetan is nickname of my wife. She is 146 cm tall. She looks like 
  small child. She is always doing strange and cute moving.</p>
<br>
  <br>
  <?php
}

?>