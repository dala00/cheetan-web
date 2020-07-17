<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );

function content( $data )
{
?>
<h1>仕様、注意事項</h1>

<h2>defineの宣言位置</h2>
<p>&nbsp;&nbsp;defineの値をaction関数等、フレームワークから呼ばれる関数内で使用したい時（や使用方法によってはビュー内でも）は、 
  cheetan.phpを読み込む前にdefineを宣言して下さい。（action関数内で宣言してaction関数内で使用したい場合は気にする必要はありません。）
(嘘かも…）
</p>
<?php
}



function content_eng( $data )
{
?>
<h1>Notice</h1>



<?php
}
?>