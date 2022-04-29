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
package ai;

import com.aionemu.commons.utils.Rnd;
import com.aionemu.gameserver.ai2.AIName;
import com.aionemu.gameserver.model.Race;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.gameobjects.player.RewardType;
import com.aionemu.gameserver.network.aion.serverpackets.SM_DIALOG_WINDOW;
import com.aionemu.gameserver.services.item.ItemService;
import com.aionemu.gameserver.utils.PacketSendUtility;

@AIName("coinfountain")
public class CoinFountainAI2 extends ActionItemNpcAI2 {

	int quest;
	
	@Override
	protected void handleUseItemFinish(Player player) {
  	quest = player.getRace() == Race.ASMODIANS ? 2717 : 1717;
  	if (player.getCommonData().getLevel() >= 25) {
        PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(getObjectId(), 1011, quest));
	}
  	else
  		PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(getObjectId(), 1011));
    }
	
	@Override
	public boolean onDialogSelect(Player player, int dialogId, int questId, int extendedRewardIndex) {
		if (dialogId == 10000) {
			if (hasItem(player, 186000147)) {
				PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(getOwner().getObjectId(), 5, quest));
				return true;
			}
			else {
				PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(getObjectId(), 1011));
				return true;
			}
		}
		else if (dialogId == 27) {
			if (hasItem(player, 186000147)) {
				player.getInventory().decreaseByItemId(186000147, 1);
				addCoins(player);
				player.getCommonData().addExp(1000, RewardType.QUEST);
				PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(getOwner().getObjectId(), 1008, quest));
				return true;
			}
		}
		PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(getObjectId(), 0));
		return true;
	}
	
	private boolean hasItem(Player player, int itemId) {
    return player.getInventory().getItemCountByItemId(itemId) > 0;
	}
	
	private void addCoins(Player player) {
    int rnd = Rnd.get(0, 100);
        if (rnd < 10) {
    	    ItemService.addItem(player, 186000242, 1);
		}
    else
    	ItemService.addItem(player, 182005205, 1);
	}
}