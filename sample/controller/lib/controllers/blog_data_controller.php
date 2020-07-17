<?php
class CBlog_dataController extends CAppController {

	function index() {
		$this->set( "datas", $this->blog_data->find( "", "modified DESC" ) );
	}
	
	function add() {
		$errmsg	= "";
		if ($_POST) {
			$errmsg	= $this->blog_data->validatemsg( $this->data["blog"] );
			if( preg_match( '/http:\/\//', $this->data['blog']['body'] ) ) $errmsg .= "You can't write URL.<br>";
			if( $errmsg == "" ) {
				$this->blog_data->insert( $this->data["blog"] );
				$this->redirect( "." );
			}
		}
		
		$this->set( "errmsg", $errmsg );
	}
	
	function edit($id = null) {
		$errmsg	= "";
		if ($_POST) {
			$errmsg	= $this->blog_data->validatemsg( $this->data["blog"] );
			if( preg_match( '/http:\/\//', $this->data['blog']['body'] ) ) $errmsg .= "You can't write URL.<br>";
			if( $errmsg == "" ) {
				$this->blog_data->update( $this->data["blog"] );
				$this->redirect("/");
			}
		}
		$this->set( "errmsg", $errmsg );
		$this->set( "data", $this->blog_data->findone( "id=" . $id ) );
	}
	
	function del($id  = null) {
		if ($_POST) {
			$this->blog_data->del( "id=" . $_POST["id"] );
			$this->redirect( "." );
		}
		$this->set( "data", $this->blog_data->findone( "id=" . $id ) );
	}
}
