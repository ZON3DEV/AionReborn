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
package instance;

import com.aionemu.gameserver.instance.handlers.GeneralInstanceHandler;
import com.aionemu.gameserver.instance.handlers.InstanceID;
import com.aionemu.gameserver.model.EmotionType;
import com.aionemu.gameserver.model.gameobjects.Creature;
import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.items.storage.Storage;
import com.aionemu.gameserver.network.aion.serverpackets.SM_DIE;
import com.aionemu.gameserver.network.aion.serverpackets.SM_EMOTION;
import com.aionemu.gameserver.services.item.ItemService;
import com.aionemu.gameserver.services.teleport.TeleportService2;
import com.aionemu.gameserver.skillengine.SkillEngine;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.world.WorldMapInstance;
import com.aionemu.commons.network.util.ThreadPoolManager;
import com.aionemu.gameserver.network.aion.serverpackets.SM_QUEST_ACTION;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.world.knownlist.Visitor;
import java.util.Map;

/**
 * @author Eloann
 */
@InstanceID(300030000)
public class NochsanaTrainingsCamp extends GeneralInstanceHandler {

    public void onEnterInstance(final Player player) {
        switch (player.getRace()) {
            case ELYOS:
                ItemService.addItem(player, 182202179, 1); //Elyos Training Siege Weapon
                break;
            case ASMODIANS:
                ItemService.addItem(player, 182205676, 1); //Asmodian Training Siege Weapon
                break;
        }
    }


    @Override
    public void handleUseItemFinish(Player player, Npc npc) {
        switch (npc.getNpcId()) {
            case 700437: //Nochsana Artifact
                SkillEngine.getInstance().getSkill(npc, 1872, 10, player).useNoAnimationSkill();
            break;
        }
    }
	
    @Override
    public void onDie(Npc npc) {
        int npcId = npc.getNpcId();
        switch (npcId) {
            case 256693: // Nochsana General
                spawn(700438, 330.36572f, 263.899f, 384.71622f, (byte) 27); // Nochsana Abyss Gate exit portal
            break;
        }
    }	

    public void removeItems(Player player) {
        Storage storage = player.getInventory();
        storage.decreaseByItemId(182205676, storage.getItemCountByItemId(182205676));
		storage.decreaseByItemId(182202179, storage.getItemCountByItemId(182202179));
    }
	

    @Override
    public void onLeaveInstance(Player player) {
        removeItems(player);
    }

    @Override
    public void onPlayerLogOut(Player player) {
        removeItems(player);
        TeleportService2.moveToInstanceExit(player, mapId, player.getRace());
    }

    @Override
    public boolean onDie(final Player player, Creature lastAttacker) {
        PacketSendUtility.broadcastPacket(player, new SM_EMOTION(player, EmotionType.DIE, 0, player.equals(lastAttacker) ? 0 : lastAttacker.getObjectId()), true);
        PacketSendUtility.sendPacket(player, new SM_DIE(false, false, 0, 8));
        return true;
    }
}