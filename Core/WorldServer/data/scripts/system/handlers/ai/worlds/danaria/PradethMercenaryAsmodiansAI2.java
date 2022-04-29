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
@AIName("pradethmercenaryasmodians")
public class PradethMercenaryAsmodiansAI2 extends NpcAI2
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
			if(!player.getInventory().decreaseByItemId(itemId, 12)) {
    			return true;
			}
			spawn(273096, 2628.9766f, 2791.371f, 253.86087f, (byte) 61);  
            spawn(273096, 2611.1191f, 2772.6743f, 253.83484f, (byte) 30);  
            spawn(273096, 2689.5513f, 2598.0747f, 253.83484f, (byte) 119);  
            spawn(273096, 2705.4612f, 2614.9175f, 253.83865f, (byte) 90);  
			spawn(273126, 2575.6929f, 2610.3667f, 253.65619f, (byte) 75); 
            spawn(273126, 2581.2778f, 2605.1582f, 253.65619f, (byte) 75); 
            spawn(273126, 2739.7441f, 2775.4817f, 253.72882f, (byte) 15); 
            spawn(273126, 2734.1306f, 2780.7148f, 253.72882f, (byte) 15); 
			spawn(273111, 2717.3767f, 2738.2834f, 265.75882f, (byte) 33); 
            spawn(273111, 2698.919f, 2755.3105f, 265.75632f, (byte) 1); 
            spawn(273111, 2599.8613f, 2648.6938f, 265.75552f, (byte) 92); 
            spawn(273111, 2639.0042f, 2612.565f, 265.77414f, (byte) 59); 
			announceMercenaries();
			PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_6021_Mercenary_Chief_01);
		} else if (dialogId == 10001) {
			if(!player.getInventory().decreaseByItemId(itemId, 20)) {
    			return true;
			}
			spawn(273111, 2667.2795f, 2592.56f, 268.32513f, (byte) 106);
            spawn(273111, 2629.799f, 2770.936f, 265.8121f, (byte) 45); 
            spawn(273111, 2579.392f, 2672.4946f, 265.81476f, (byte) 75);
            spawn(273111, 2621.6184f, 2632.5005f, 265.81476f, (byte) 76); 
            spawn(273111, 2736.454f, 2669.858f, 265.80414f, (byte) 106); 
            spawn(273111, 2775.1433f, 2654.893f, 262.82587f, (byte) 106);
            spawn(273111, 2684.618f, 2557.8318f, 262.82587f, (byte) 106); 
            spawn(273111, 2627.3955f, 2578.351f, 262.82587f, (byte) 76); 
            spawn(273111, 2522.8257f, 2675.4504f, 262.82587f, (byte) 76); 
            spawn(273111, 2522.1343f, 2711.6804f, 262.82587f, (byte) 47); 
            spawn(273111, 2541.5078f, 2731.549f, 259.10098f, (byte) 41); 
            spawn(273111, 2632.497f, 2829.7847f, 262.82587f, (byte) 46); 
            spawn(273111, 2793.8599f, 2712.1128f, 262.82587f, (byte) 15); 
			announceMercenaries();
			PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_6021_Mercenary_Chief_02);
		} else if (dialogId == 10002) {
			if(!player.getInventory().decreaseByItemId(itemId, 12)) {
    			return true;
			}
            spawn(273316, 2596.982f, 2737.708f, 266.19125f, (byte) 46); 
            spawn(273316, 2611.173f, 2752.241f, 266.19125f, (byte) 45); 
            spawn(273316, 2705.3672f, 2636.0967f, 266.20126f, (byte) 106); 
            spawn(273316, 2718.9968f, 2651.4675f, 266.20126f, (byte) 105); 
			announceMercenaries();
			PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_6021_Mercenary_Chief_03);
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