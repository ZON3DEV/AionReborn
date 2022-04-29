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
package ai.worlds.danaria;

import ai.ActionItemNpcAI2;
import com.aionemu.gameserver.ai2.AIName;
import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.serverpackets.SM_SYSTEM_MESSAGE;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.world.knownlist.Visitor;

/**
 * @author Brera, Ritual
 */
@AIName("outersoutheasterngatecontrolasmodians")
public class OuterSouthEasternGateControlAsmodiansAI2 extends ActionItemNpcAI2
{
	@Override
	protected void handleDialogStart(Player player) {
		super.handleDialogStart(player);
	}
	
	@Override
	protected void handleUseItemFinish(Player player) {
		switch(getNpcId()) {
			case 701784: 
				despawnNpc(273289); 
				PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_LDF5b_6021_Out_Door_02_Despawn);
			break;
		}
		//AI2Actions.deleteOwner(this);
	}
	
	private void despawnNpc(final int npcId) {
		getKnownList().doOnAllNpcs(new Visitor<Npc>() {
			@Override
			public void visit(Npc npc) {
				if (npc.getNpcId() == npcId) {
					npc.getController().onDelete();
				}
			}
		});
	}
}