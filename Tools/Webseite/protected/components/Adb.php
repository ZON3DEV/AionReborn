<?php

	class Adb extends Controller {
		function url($type, $id, $view = 1, $showAnchor = TRUE) {
			if ($id == 'null') {
				return '-';
			}


			if ($type == 'item') {
				$url = 'http://aiona.net/items/ ' . $id;
			} 
			else {
				if ($type == 'npc') {
					$url = 'http://aiona.net/npc/' . $id;
				} 
				else {
					if ($type == 'quest') {
						$url = 'http://aiona.net/quest/' . $id;
					} 
					else {
						if ($type == 'skill') {
							$url = 'http://aiona.net/skill/' . $id;
						} 
						else {
							if ($type == 'title') {
								$url = '/title/' . $id;
							} 
							else {
								if ($type == 'world') {
									$url = 'http://aiona.net/world/' . $id;
								}
							}
						}
					}
				}
			}


			if ($showAnchor == FALSE) {
				$id = NULL;
			}


			if ($view == 1) {
				$url = '<a class="aion-item-icon-large" href="' . $url . '">' . $id . '</a>';
			} 
			else {
				if ($view == 2) {
					$url = '<a href="' . $url . '">' . $id . '</a>';
				} 
				else {
					if ($view == 3) {
						$url = '<a class="aion-icon" href="' . $url . '">' . $id . '</a>';
					}
				}
			}

			return $url;
		}
	}

?>