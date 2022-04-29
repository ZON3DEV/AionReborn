/**
 * This file is part of Aion-Lightning <aion-lightning.org>.
 *
 *  Aion-Lightning is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Aion-Lightning is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details. *
 *
 *  You should have received a copy of the GNU General Public License
 *  along with Aion-Lightning.
 *  If not, see <http://www.gnu.org/licenses/>.
 */
package ai.instance.sauroSupplyBase;

import ai.AggressiveNpcAI2;
import com.aionemu.gameserver.ai2.AIName;
import com.aionemu.gameserver.model.gameobjects.Creature;
import com.aionemu.gameserver.skillengine.SkillEngine;
import com.aionemu.gameserver.utils.ThreadPoolManager;
import java.util.concurrent.Future;

/**
 * @author Alcapwnd
 */
@AIName("fire_cannon")
public class FireCannonAI2 extends AggressiveNpcAI2 {
	
	private Future<?> CannonAttack;
	
	@Override
	protected void handleSpawned() {
		super.handleSpawned();
	}
	
	@Override
	protected void handleAttack(Creature creature) {
		super.handleAttack(creature);
		startSkillTask();
	}
	
	private void startSkillTask() {
		CannonAttack = ThreadPoolManager.getInstance().scheduleAtFixedRate(new Runnable() {
		 @Override
		 public void run() {
			if (isAlreadyDead())
				SkillEngine.getInstance().getSkill(getOwner(), 21201, 65, getTarget()).useNoAnimationSkill();
			  cancelTask();
		    }
	    }, 1, 1000);
    }

	private void cancelTask() {
	    if (CannonAttack != null && !CannonAttack.isCancelled()) {
	  	    CannonAttack.cancel(true);
	    }
    }
	
	@Override
	public int modifyDamage(int damage) {
		return 1;
	}
}