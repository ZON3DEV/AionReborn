<?php

	class Membership extends CActiveRecord {
		public static function model($className = 'Membership') {
			return parent::model( $className );
		}

		function tableName() {
			return 'membership';
		}

		function rules() {
			return array( array( 'name, price', 'required' ), array( 'name', 'length', 'max' => 32 ), array( 'price', 'length', 'max' => 10 ), array( 'membership_type, membership_duration, craftship_type, craftship_duration, apship_type, apship_duration, collectionship_type, collectionship_duration,  price', 'numerical', 'integerOnly' => true ) );
		}

		function attributeLabels() {
			return array( 'id' => 'ID', 'name' => 'Title', 'membership_type' => 'membership type', 'membership_duration' => 'Premium (duration, time.)', 'craftship_type' => 'Craft (type)', 'craftship_duration' => 'Craft (duration, time.)', 'apship_type' => 'AP (type)', 'apship_duration' => 'AP (duration, time.)', 'collectionship_type' => 'Collection (type)', 'collectionship_duration' => 'Collection (duration, time.)', 'price' => 'Price' );
		}
	}

?>