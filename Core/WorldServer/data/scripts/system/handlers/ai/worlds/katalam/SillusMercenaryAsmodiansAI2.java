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
package ai.worlds.katalam;

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
@AIName("sillusmercenaryasmodians")
public class SillusMercenaryAsmodiansAI2 extends NpcAI2
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
			if(!player.getInventory().decreaseByItemId(itemId, 16)) {
    			return true;
			}
			spawn(273406, 2041.7103f, 1732.4125f, 318.5482f, (byte) 72);
		    spawn(273406, 2000.2998f, 1723.874f, 318.2682f, (byte) 110);
			spawn(273406, 2035.0809f, 1728.9347f, 321.11688f, (byte) 90);
			spawn(273406, 2031.0507f, 1735.508f, 321.11685f, (byte) 62);
			spawn(273406, 2030.9891f, 1738.3469f, 321.116853f, (byte) 61);
			spawn(273406, 2007.6718f, 1728.527f, 320.59552f, (byte) 89);
			spawn(273406, 2011.7115f, 1734.3593f, 320.59552f, (byte) 118);
			spawn(273406, 2011.7196f, 1738.1825f, 320.59552f, (byte) 118);
			spawn(273406, 2156.5964f, 1873.645f, 311.00815f, (byte) 106);
			spawn(273406, 2162.449f, 1878.4044f, 311.00815f, (byte) 0);
			spawn(273406, 2168.4036f, 1852.5221f, 315.4597f, (byte) 8);
			spawn(273406, 2158.8525f, 1852.9214f, 315.45972f, (byte) 31);
			spawn(272363, 2015.0033f, 1747.0857f, 308.87418f, (byte) 92);
			spawn(272363, 2026.6425f, 1745.1782f, 308.3147f, (byte) 88);
			spawn(272363, 2021.2678f, 1733.473f, 308.875f, (byte) 89);
			spawn(272363, 2015.2781f, 1759.6329f, 309.41937f, (byte) 93);
			spawn(272363, 2158.7136f, 1862.3315f, 305.57477f, (byte) 8);
			spawn(272363, 2141.4326f, 1860.9662f, 309.52914f, (byte) 3);
			spawn(272363, 2142.9177f, 1854.8298f, 310.26578f, (byte) 5);
			announceMercenaries();
			PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_5011_Mercenary_Chief_01);
		} else if (dialogId == 10001) {
			if(!player.getInventory().decreaseByItemId(itemId, 8)) {
    			return true;
			}
			spawn(272367, 1991.21f, 1785.4397f, 332.03583f, (byte) 93);
			spawn(272367, 2021.3014f, 1792.7091f, 331.75714f, (byte) 96);
			spawn(272367, 2102.6382f, 1853.7145f, 332.03583f, (byte) 107);
			spawn(272367, 2122.2085f, 1879.7305f, 332.05743f, (byte) 109);
			announceMercenaries();
			PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_5011_Mercenary_Chief_02);
		} else if (dialogId == 10002) {
			if(!player.getInventory().decreaseByItemId(itemId, 12)) {
    			return true;
			}
			spawn(273406, 1991.21f, 1785.4397f, 332.03583f, (byte) 93);
			spawn(273406, 2021.3014f, 1792.7091f, 331.75714f, (byte) 96);
			spawn(273406, 2102.6382f, 1853.7145f, 332.03583f, (byte) 107);
			spawn(273406, 2122.2085f, 1879.7305f, 332.05743f, (byte) 109);
			spawn(272363, 2116.2556f, 1867.1548f, 315.9235f, (byte) 107);
			spawn(272363, 2111.3452f, 1862.3365f, 316.33527f, (byte) 104);
			spawn(272363, 2002.7399f, 1782.1903f, 315.8388f, (byte) 95);
			spawn(272363, 2012.3264f, 1784.7289f, 315.3684f, (byte) 94);
			announceMercenaries();
			PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_5011_Mercenary_Chief_03);
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