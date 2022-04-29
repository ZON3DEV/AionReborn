<?php

	class SiegeController extends Controller {
		function actionIndex() {
			$this->render( '/siege' );
		}

		function actionXml() {
			$model = Yii::app(  )->gs->cache( 300 )->createCommand(  )->select( 's.id, race, legion_id, l.name' )->from( 'siege_locations s' )->leftJoin( 'legions l', 'l.id = s.legion_id' )->queryAll(  );
			
			header( 'Content-type: text/xml' );
			echo '<?xml version="1.0" encoding="UTF-8" ?>
		<updateLayer>
			<World name="" serverURL="">';
			foreach ($model as $data) {

				echo '
					<Abyss id="' . $data['id'] . '" name="' . $this->name( $data['id'] ) . '">
						<race>' . $this->race( $data['race'] ) . '</race>
						<legion>' . $data['name'] . '</legion>
						<status>Invulnerable</status>
						<nextStatus>Invulnerable</nextStatus>
						<effect>' . $this->effect( $data['id'] ) . '</effect>
					</Abyss>
				
					<Artifact id="' . $data['id'] . '" name="' . $this->name( $data['id'] ) . '">
						<race>' . $this->race( $data['race'] ) . '</race>
						<legion>' . $data['name'] . '</legion>
					</Artifact>';
			}

			echo '</World>
		</updateLayer>';
		}

		function race($var) {
			if ($var == 'ELYOS') {
				return 'Elyos';
			}


			if ($var == 'ASMODIANS') {
				return 'Asmodians';
			}


			if ($var == 'BALAUR') {
				return 'Balaur';
			}

		}

		function name($var) {
			if ($var == 1011) {
				return 'Divine Fortress';
			}


			if ($var == 1012) {
				return 'Aetheric Renewal';
			}


			if ($var == 1013) {
				return 'Abyssal Aura';
			}


			if ($var == 1014) {
				return 'Abyssal Aura';
			}


			if ($var == 1015) {
				return 'Restorative Grasp';
			}


			if ($var == 1016) {
				return 'Abyssal Fury';
			}


			if ($var == 1017) {
				return 'Fiery Staccato';
			}


			if ($var == 1018) {
				return 'Fiery Staccato';
			}


			if ($var == 1019) {
				return 'Fiery Staccato';
			}


			if ($var == 1020) {
				return 'Daevic Innervation';
			}


			if ($var == 1131) {
				return 'Siel\'s Western Fortress';
			}


			if ($var == 1132) {
				return 'Siel\'s Eastern Fortress';
			}


			if ($var == 1133) {
				return 'Abyssal Aura';
			}


			if ($var == 1134) {
				return 'Abyssal Aura';
			}


			if ($var == 1135) {
				return 'Abyssal Aegis';
			}


			if ($var == 1141) {
				return 'Sulfur Fortress';
			}


			if ($var == 1142) {
				return 'Abyssal Aura';
			}


			if ($var == 1143) {
				return 'Abyssal Aegis';
			}


			if ($var == 1144) {
				return 'Tenebrous Cloak';
			}


			if ($var == 1145) {
				return 'Kerubic Metamorphosis';
			}


			if ($var == 1146) {
				return 'Daevic Efflux';
			}


			if ($var == 1211) {
				return 'Roah Fortress';
			}


			if ($var == 1212) {
				return 'Abyssal Fury';
			}


			if ($var == 1213) {
				return 'Restorative Grasp';
			}


			if ($var == 1214) {
				return 'Aion\'s Rebuke';
			}


			if ($var == 1215) {
				return 'Tenebrous Cloak';
			}


			if ($var == 1221) {
				return 'Krotan Refuge';
			}


			if ($var == 1222) {
				return 'Abyssal Fury';
			}


			if ($var == 1223) {
				return 'Daevic Efflux';
			}


			if ($var == 1224) {
				return 'Flaming Hell';
			}


			if ($var == 1231) {
				return 'Kysis Fortress';
			}


			if ($var == 1232) {
				return 'Abyssal Fury';
			}


			if ($var == 1233) {
				return 'Restorative Grasp';
			}


			if ($var == 1241) {
				return 'Miren Fortress';
			}


			if ($var == 1242) {
				return 'Abyssal Fury';
			}


			if ($var == 1243) {
				return 'Abyssal Aegis';
			}


			if ($var == 1251) {
				return 'Asteria Fortress';
			}


			if ($var == 1252) {
				return 'Daevic Innervation';
			}


			if ($var == 1253) {
				return 'Anacros Malady';
			}


			if ($var == 1254) {
				return 'Verdandi\'s Prank';
			}


			if ($var == 2011) {
				return 'Temple of Scales';
			}


			if ($var == 2012) {
				return 'Glimmering Aura';
			}


			if ($var == 2013) {
				return 'Mookie Revenge';
			}


			if ($var == 2021) {
				return 'Altar of Avarice';
			}


			if ($var == 2022) {
				return 'Spectral Mist';
			}


			if ($var == 2023) {
				return 'Cyclone of Void';
			}


			if ($var == 2111) {
				return '';
			}


			if ($var == 3011) {
				return 'Vorgaltem Citadel';
			}


			if ($var == 3012) {
				return 'Alukina\'s Mischief';
			}


			if ($var == 3013) {
				return 'Glimmering Aura';
			}


			if ($var == 3021) {
				return 'Crimson Temple';
			}


			if ($var == 3022) {
				return 'Spectral Mist';
			}


			if ($var == 3023) {
				return 'Cyclone of Void';
			}

			return $var;
		}

		function effect($var) {
			if ($var == 1011) {
				return 'DP Recovery';
			}


			if ($var == 1131) {
				return 'Boost Critical Hit Chance';
			}


			if ($var == 1132) {
				return 'Increase  Accuracy and Magical Accuracy';
			}


			if ($var == 1141) {
				return 'Increase MAX HP';
			}


			if ($var == 1241) {
				return 'Increase the natural flight time recovery rate';
			}


			if ($var == 1231) {
				return 'Increase Natural MP Recovery';
			}


			if ($var == 1251) {
				return 'Increase Natural HP Recovery';
			}


			if (( $var == 2021 || $var == 3011 )) {
				return 'Increases all Elemental Defenses and Physical Defense';
			}


			if ($var == 3011) {
				return 'Increases all Elemental Defenses and Physical Defense';
			}


			if (( $var == 1211 || $var == 1221 )) {
				return 'Increase Physical Attack and Magic Boost';
			}


			if (( $var == 2011 || $var == 3021 )) {
				return 'Increases Physical Defense and Magic Boost';
			}

			return $var;
		}
	}

?>