<?php

	class NewsCategory extends CActiveRecord {
		function getDbConnection() {
			return Yii::app(  )->db;
		}

		function tableName() {
			return 'news_category';
		}

		public static function model($className = 'NewsCategory') {
			return parent::model( $className );
		}

		function rules() {
			return array( array( 'name, alt_name, title', 'required' ), array( 'name, alt_name, image_id', 'length', 'max' => 32 ), array( 'title', 'length', 'max' => 128 ), array( 'description, keywords', 'length', 'max' => 255 ), array( 'alt_name', 'match', 'pattern' => '/^[A-Za-z0-9][\w]+$/', 'message' => '{attribute} может содержать только латинские буквы' ), array( 'alt_name', 'unique' ) );
		}

		function attributeLabels() {
			return array( 'id' => 'ID', 'name' => 'Name', 'alt_name' => 'Alias', 'image_id' => 'Image', 'title' => 'Title', 'description' => 'Meta-tag Description', 'keywords' => 'Meta-tag Keywords' );
		}

		function getCategories() {
			return Yii::app(  )->db->createCommand(  )->select( 'id, name' )->from( 'news_category' )->order( 'name ASC' )->queryAll(  );
		}

		function getIcons() {
			
			$images = scandir( 'images/news' );
			
			$images = array_slice( $images, 2 );
			$out = array(  );
			$i = 0;

			while ($i < count( $images )) {
				$out[$i]['value'] = $i + 1;
				$out[$i]['imageSrc'] = Power::url( 'images/news', $images[$i] );
				++$i;
			}

			echo json_encode( $out );
		}
	}

?>