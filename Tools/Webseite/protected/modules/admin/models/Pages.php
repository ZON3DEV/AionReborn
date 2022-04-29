<?php

	class Pages extends CActiveRecord {
	  public static	function model($className = 'Pages') {
			return parent::model( $className );
		}

		function tableName() {
			return 'pages';
		}

		function rules() {
			return array( array( 'name, title, text', 'required' ), array( 'name, title', 'length', 'max' => 128 ), array( 'description, keywords', 'length', 'max' => 255 ), array( 'name', 'match', 'pattern' => '/^[A-Za-z0-9][\w]+$/', 'message' => '{attribute} can contain only latin letter' ), array( 'name', 'unique' ) );
		}

		function attributeLabels() {
			return array( 'id' => 'ID', 'name' => 'Link Address', 'title' => 'Page Title', 'text' => 'Text', 'description' => 'Tag Description', 'keywords' => 'Tag Keywords' );
		}
	}

?>