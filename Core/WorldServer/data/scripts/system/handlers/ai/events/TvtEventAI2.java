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
package ai.events;

import com.aionemu.gameserver.ai2.AIName;
import com.aionemu.gameserver.ai2.NpcAI2;
import com.aionemu.gameserver.model.gameobjects.Creature;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.gameobjects.player.RequestResponseHandler;
import com.aionemu.gameserver.network.aion.serverpackets.SM_DIALOG_WINDOW;
import com.aionemu.gameserver.network.aion.serverpackets.SM_QUEST_ACTION;
import com.aionemu.gameserver.services.ecfunctions.tvt.TvtRegistrator;
import com.aionemu.gameserver.services.ecfunctions.tvt.TvtService;
import com.aionemu.gameserver.utils.PacketSendUtility;

@AIName("tvtregistrator")
public class TvtEventAI2 extends NpcAI2 {

    @Override
    protected void handleDialogStart(final Player player) {
        String message = "[Ascension]Do You want register in Tvt?";
	    RequestResponseHandler responseHandler = new RequestResponseHandler(player){

	        public void acceptRequest(Creature requester, Player responder) {

	            TvtRegistrator tvt = TvtService.getInstance().getTvtByLevel(player.getLevel());
                if (!tvt.getHolders().getPlayer(player)) {
                    if (!TvtService.getInstance().regPlayer(player)) {
                        PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(0, 0));
                        return;
                    }
                    PacketSendUtility.sendMessage(player, "[Ascension]Congratulations!You Registered, for More Info Click to NPC - Aernia");
                    PacketSendUtility.sendPacket(player, new SM_QUEST_ACTION(4, 0, tvt.getRemainingTime()));
                   // inRestRoom(player); Maybe Need :)
                    tvt.getHolders().info(player, player.isGM());
                    PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(0, 0));
                    }
                    else {
                    TvtService.getInstance().unRegPlayer(player);
                    PacketSendUtility.sendPacket(player, new SM_QUEST_ACTION(4, 0, 0));
                    PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(0, 0));
                }
	        }
	        public void denyRequest(Creature requester, Player responder){ return; }
	    };
    }
}