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
package ai.instance.tiamatStrongHold;

import com.aionemu.commons.network.util.ThreadPoolManager;
import com.aionemu.gameserver.ai2.AI2Actions;
import com.aionemu.gameserver.ai2.AIName;
import com.aionemu.gameserver.ai2.NpcAI2;
import com.aionemu.gameserver.model.DialogAction;
import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.serverpackets.SM_DIALOG_WINDOW;
import com.aionemu.gameserver.services.NpcShoutsService;
import com.aionemu.gameserver.skillengine.SkillEngine;
import com.aionemu.gameserver.utils.PacketSendUtility;

/**
 * @author Cheatkiller
 */
@AIName("kharun")
public class KharunAI2 extends NpcAI2 {

    @Override
    protected void handleDialogStart(Player player) {
        PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(getObjectId(), 1011));
    }

    @Override
    public boolean onDialogSelect(Player player, int dialogId, int questId, int extendedRewardIndex) {
        if (dialogId == DialogAction.SETPRO1.id()) {
            AI2Actions.deleteOwner(this);
            startKharunEvent();
        }
        PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(getObjectId(), 0));
        return true;
    }

    private void startKharunEvent() {
        ThreadPoolManager.getInstance().schedule(new Runnable() {
            @Override
            public void run() {
                Npc aethericField = getPosition().getWorldMapInstance().getNpc(730613);
                Npc strongholdDoor = getPosition().getWorldMapInstance().getNpc(730612);
                Npc Kharun = (Npc) spawn(800335, getOwner().getX(), getOwner().getY(), getOwner().getZ(), (byte) 60);
                Kharun.setTarget(aethericField);
                SkillEngine.getInstance().getSkill(Kharun, 20943, 60, aethericField).useNoAnimationSkill();
                NpcShoutsService.getInstance().sendMsg(Kharun, 1500597, Kharun.getObjectId(), 0, 1000);
                NpcShoutsService.getInstance().sendMsg(Kharun, 1500598, Kharun.getObjectId(), 0, 5000);
                strongholdDoor.getController().die();
                aethericField.getController().onDelete();
            }
        }, 3000);
    }
}