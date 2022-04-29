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
package ai.portals;

import ai.ActionItemNpcAI2;
import com.aionemu.gameserver.ai2.AIName;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.services.teleport.TeleportService2;
import com.aionemu.gameserver.utils.PacketSendUtility;

/**
 * @author Alex
 */
@AIName("portal_steel_rose")
public class SteelRosePortalAI2 extends ActionItemNpcAI2 {

    private int itemId = 0;

    @Override
    protected void handleDialogStart(Player player) {
        switch (this.getNpcId()) {
            case 730763:
                itemId = 185000142;
                break;
            case 730767:
                itemId = 0;
                break;
            case 730768:
                itemId = 0;
                break;
			case 730764:
                itemId = 185000148;
                break;	
        }
        if (itemId != 0 && player.getInventory().getItemCountByItemId(itemId) == 0) {
            PacketSendUtility.sendMessage(player, "Для открытия этой двери необходимо иметь [item:" + itemId + "]");
            return;
        }

        handleUseItemStart(player);
    }

    @Override
    protected void handleUseItemFinish(Player player) {
        if (itemId != 0) {
            player.getInventory().decreaseByItemId(itemId, 1);
        }
        switch (this.getNpcId()) {
            case 730763:
                if (player.getWorldId() == 301010000) {
                    TeleportService2.teleportTo(player, 301010000, player.getInstanceId(), 662, 520, 867);
                } else if (player.getWorldId() == 301030000) {
                    TeleportService2.teleportTo(player, 301030000, player.getInstanceId(), 662, 520, 867);
                }
                break;
            case 730767:
                if (player.getWorldId() == 301010000) {
                    TeleportService2.teleportTo(player, 301010000, player.getInstanceId(), 461, 491, 877);
                } else if (player.getWorldId() == 301030000) {
                    TeleportService2.teleportTo(player, 301030000, player.getInstanceId(), 461, 491, 877);
                }
                break;
            case 730768:
                if (player.getWorldId() == 301010000) {
                    TeleportService2.teleportTo(player, 301010000, player.getInstanceId(), 461, 485, 877);
                } else if (player.getWorldId() == 301030000) {
                    TeleportService2.teleportTo(player, 301030000, player.getInstanceId(), 461, 485, 877);
                }
                break;
			case 730764:
                if (player.getWorldId() == 301020000) {
                    TeleportService2.teleportTo(player, 301020000, player.getInstanceId(), 703, 500, 939);
                } else if (player.getWorldId() == 301040000) {
                    TeleportService2.teleportTo(player, 301040000, player.getInstanceId(), 703, 500, 939);
                }
            break;	
        }
    }
}