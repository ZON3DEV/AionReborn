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

import com.aionemu.gameserver.ai2.AIName;
import com.aionemu.gameserver.ai2.NpcAI2;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.serverpackets.SM_DIALOG_WINDOW;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.world.World;
import com.aionemu.gameserver.world.knownlist.Visitor;
import com.aionemu.gameserver.network.aion.serverpackets.SM_SYSTEM_MESSAGE;

/**
 * @author Brera, Ritual
 */
@AIName("silonamercenaryelyos")
public class SilonaMercenaryElyosAI2 extends NpcAI2
{
	private int itemId = 186000236;
    @Override
    protected void handleDialogStart(Player player) {
    	long count = player.getInventory().getItemCountByItemId(itemId);
    	if(count < 8){
    		PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(getObjectId(), 27));
    		return;
    	}
    	PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(getObjectId(), 10));
    }
    
	@Override
    public boolean onDialogSelect(Player player, int dialogId, int questId, int extendedRewardIndex) {
    	if(dialogId == 1352 || dialogId == 1693 || dialogId == 2034){
			PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(getObjectId(), dialogId));
			return true;
    	}

		if (dialogId == 10000) {
			if(!player.getInventory().decreaseByItemId(itemId, 14)) {
    			return true;
			}
            spawn(272576, 1599.2748f, 910.92035f, 53.5f, (byte) 23); 
            spawn(272576, 1585.2769f, 921.29706f, 53.581066f, (byte) 18); 
            spawn(272576, 1535.5685f, 804.60486f, 93.432f, (byte) 30); 
            spawn(272576, 1512.3474f, 821.4114f, 93.44656f, (byte) 9); 
		    spawn(272820, 1496.2777f, 901.2098f, 68.430786f, (byte) 42); 
            spawn(272820, 1551.4484f, 903.64246f, 70.36379f, (byte) 8); 
            spawn(272820, 1514.3641f, 863.8583f, 107.63131f, (byte) 92); 
            spawn(272820, 1513.1644f, 919.59576f, 80.2405f, (byte) 36); 
			announceMercenaries();
			PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_6011_Mercenary_Chief_01);
		} else if (dialogId == 10001) {
			if(!player.getInventory().decreaseByItemId(itemId, 10)) {
    			return true;
			}
			spawn(272586, 1639.0613f, 982.8706f, 55.894577f, (byte) 37); 
            spawn(272586, 1634.7057f, 981.8072f, 55.5f, (byte) 35); 
            spawn(272586, 1636.3159f, 984.11444f, 55.50544f, (byte) 35);
            spawn(272586, 1521.8398f, 920.99414f, 53.75f, (byte) 35); 
            spawn(272586, 1516.6506f, 919.58185f, 53.51453f, (byte) 35); 
            spawn(272586, 1518.8091f, 922.89966f, 53.675568f, (byte) 35); 
			announceMercenaries();
			PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_6011_Mercenary_Chief_02);
		} else if (dialogId == 10002) {
			if(!player.getInventory().decreaseByItemId(itemId, 10)) {
    			return true;
			}
			spawn(272837, 1623.2288f, 1014.32184f, 54.903088f, (byte) 46); 
            spawn(272837, 1616.7952f, 1006.62463f, 55.38566f, (byte) 46); 
            spawn(272837, 1618.6987f, 1014.48865f, 55.05079f, (byte) 46); 
            spawn(272837, 1615.7753f, 1011.0701f, 55.183117f, (byte) 46); 
            spawn(272837, 1511.2913f, 953.0544f, 55.146603f, (byte) 55); 
            spawn(272837, 1483.1779f, 976.3054f, 52.570473f, (byte) 64); 
            spawn(272837, 1496.0297f, 906.3323f, 52.992584f, (byte) 41); 
			announceMercenaries();
			PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_6011_Mercenary_Chief_03);
		}
        return true;
    }
	
	private void announceMercenaries() {
		World.getInstance().doOnAllPlayers(new Visitor<Player>() {
			@Override
			public void visit(Player player) {
				PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_Mercenary_Chief_Fail_01);
			}
		});
	}
}