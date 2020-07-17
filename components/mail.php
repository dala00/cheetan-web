<?php
class CMail
{
	function put_email($from,$fromn,$to,$subject,$mesg, $useheader = true )
	{
		if( $useheader )
		{
			$header	= '失礼致します。
PHPフレームワークちいたんからのメールです。


';
			$footer	= '

----------------------------------------
PHPフレームワーク　ちいたん
http://php.cheetan.net/
';
			$mesg	= $header . $mesg . $footer;
		}
		$mailer		= "PHP-" .phpversion();
		$useragent	= 'Cheetan mail';
		$date		= date( 'r' );
		$errmsg		= '';
	
		$reply		= $from;
		$fromn		= mb_convert_encoding( $fromn, 'ISO-2022-JP', 'SJIS' );
		$from		= "=?ISO-2022-JP?B?" . base64_encode( trim( $fromn ) ) ."?=<" . $from . ">";
		$subject	= mb_convert_encoding( $subject, 'ISO-2022-JP', 'SJIS' );
		$subject	= "=?ISO-2022-JP?B?" . base64_encode( trim( $subject ) ) . "?=";
		$mesg		= mb_convert_encoding( $mesg, 'ISO-2022-JP', 'SJIS' );
		$header		= "Date: $date\r\n"
					. "From: $from\r\n"
					. "Reply-To: $reply\r\n"
					. "X-Mailer: $mailer\r\n"
					. "User-Agent: $useragent\r\n"
					. "Content-Type: text/plain;charset=\"ISO-2022-JP\"\r\n"
					. "Content-Transfer-Encoding: 7bit\r\n"
					;

		return mail( $to, $subject, $mesg, $header );
	}
}
?>