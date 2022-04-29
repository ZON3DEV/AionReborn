<?php
	class DefaultController extends Controller {
		function actionIndex() {
			$model = Yii::app(  )->gs->cache( 300 )->createCommand( 'SELECT COUNT(*) AS `all`,
			(SELECT COUNT(*) FROM players WHERE exp <= 307558) AS `9`,
			(SELECT COUNT(*) FROM players WHERE exp > 527287631 AND exp <= 527287631) AS `50`,
			(SELECT COUNT(*) FROM players WHERE exp > 871508583 AND exp <= 871508583) AS `55`,
			(SELECT COUNT(*) FROM players WHERE exp > 1328622680 AND exp <= 1328622680) AS `60`,
			(SELECT COUNT(*) FROM players WHERE exp > 1926765410 AND exp <= 1926765410) AS `65`,
			(SELECT COUNT(*) FROM players WHERE exp > 2750093321 AND exp <= 2750093321) AS `70`,
			(SELECT COUNT(*) FROM players WHERE exp > 3881237613 AND exp <= 3881237613) AS `75`,
			(SELECT COUNT(*) FROM players WHERE exp > 5402990050 AND exp <= 5402990050) AS `80`,
			(SELECT COUNT(*) FROM players WHERE race = "ASMODIANS") AS `asmo`,
			(SELECT COUNT(*) FROM players WHERE race = "ELYOS") AS `ely`,
			(SELECT COUNT(*) FROM players WHERE player_class = "GLADIATOR") AS `GLADIATOR`,
			(SELECT COUNT(*) FROM players WHERE player_class = "TEMPLAR") AS `TEMPLAR`,
			(SELECT COUNT(*) FROM players WHERE player_class = "ASSASSIN") AS `ASSASSIN`,
			(SELECT COUNT(*) FROM players WHERE player_class = "RANGER") AS `RANGER`,
			(SELECT COUNT(*) FROM players WHERE player_class = "SORCERER") AS `SORCERER`,
			(SELECT COUNT(*) FROM players WHERE player_class = "SPIRIT_MASTER") AS `SPIRIT_MASTER`,
			(SELECT COUNT(*) FROM players WHERE player_class = "CLERIC") AS `CLERIC`,
			(SELECT COUNT(*) FROM players WHERE player_class = "CHANTER") AS `CHANTER`,
			(SELECT COUNT(*) FROM players WHERE player_class = "BARD") AS `BARD`,
			(SELECT COUNT(*) FROM players WHERE player_class = "GUNNER") AS `GUNNER`,
			(SELECT COUNT(*) FROM players WHERE player_class = "RIDER") AS `RIDER`,
			(SELECT COUNT(*) FROM players WHERE player_class = "PAINTER") AS `PAINTER`,

			(SELECT COUNT(*) FROM legion_members m LEFT JOIN players p ON p.id=m.player_id WHERE p.race = "ASMODIANS" AND m.rank = "BRIGADE_GENERAL") AS leg_asmo,
			(SELECT COUNT(*) FROM legion_members m LEFT JOIN players p ON p.id=m.player_id WHERE p.race = "ELYOS" AND m.rank = "BRIGADE_GENERAL") AS leg_ely

			FROM players' )->queryRow(  );

			$this->render( '/stats', array( 'model' => $model ) );
		}
	}

?>