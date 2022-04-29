<?php


	class WebshopCategory extends CActiveRecord {
		public static function model($className = 'WebshopCategory') {
			return parent::model( $className );
		}

		function tableName() {
			return 'webshop_category';
		}

		function rules() {
			return array( array( 'name, url, image_id', 'required' ), array( 'name, url, image_id', 'length', 'max' => 32 ), array( 'url', 'match', 'pattern' => '/^[A-Za-z0-9][\w]+$/', 'message' => '{attribute} can contain only latin letters' ) );
		}

		function attributeLabels() {
			return array( 'id' => 'ID', 'name' => 'Title', 'url' => 'Link Address', 'image_id' => 'Image' );
		}

		function getCategories() {
			return Yii::app(  )->db->createCommand(  )->select( 'id, name' )->from( 'webshop_category' )->order( 'name ASC' )->queryAll(  );
		}

		function getIcons() {

			$images = scandir( 'images/webshop' );

			$images = array_slice( $images, 2 );
			$out = array(  );
			$i = 0;

			while ($i < count( $images )) {
				$out[$i]['value'] = $i + 1;
				$out[$i]['imageSrc'] = Power::url( 'images/webshop', $images[$i] );
				++$i;
			}

			echo json_encode( $out );
		}
	}

?>