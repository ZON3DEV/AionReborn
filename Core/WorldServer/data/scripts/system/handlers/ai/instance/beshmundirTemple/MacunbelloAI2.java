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
package ai.instance.beshmundirTemple;

import ai.AggressiveNpcAI2;
import com.aionemu.commons.network.util.ThreadPoolManager;
import com.aionemu.gameserver.ai2.AIName;
import com.aionemu.gameserver.ai2.NpcAI2;
import com.aionemu.gameserver.ai2.manager.WalkManager;
import com.aionemu.gameserver.model.EmotionType;
import com.aionemu.gameserver.model.gameobjects.Creature;
import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.utils.*;
import java.util.concurrent.atomic.AtomicBoolean;

@AIName("macunbello")
public class MacunbelloAI2 extends AggressiveNpcAI2 {

    private AtomicBoolean isAggred = new AtomicBoolean(false);
    private AtomicBoolean isStartedEvent = new AtomicBoolean(false);

    @Override
    protected void handleAttack(Creature creature) {
        super.handleAttack(creature);
        if (isAggred.compareAndSet(false, true)) {
            getPosition().getWorldMapInstance().getDoors().get(467).setOpen(true);
        }
        checkPercentage(getLifeStats().getHpPercentage());
    }

    private void checkPercentage(int hpPercentage) {
        if (hpPercentage <= 95) {
            if (isStartedEvent.compareAndSet(false, true)) {
                startRushWalkEvent();
            }
        }
        if (hpPercentage <= 75) {
            if (isStartedEvent.compareAndSet(false, true)) {
                startRushWalkEvent();
            }
        }
        if (hpPercentage <= 55) {
            if (isStartedEvent.compareAndSet(false, true)) {
                startRushWalkEvent();
            }
        }
        if (hpPercentage <= 35) {
            if (isStartedEvent.compareAndSet(false, true)) {
                startRushWalkEvent();
            }
        }
        if (hpPercentage <= 15) {
            if (isStartedEvent.compareAndSet(false, true)) {
                startRushWalkEvent();
            }
        }
    }

    private void startRushWalkEvent() {
        startWalk((Npc) spawn(281698, 1007.0455f, 109.74506f, 242.70596f, (byte) 30), "3001700000"); //Macunbello's Right Hand.
        startWalk((Npc) spawn(281698, 952.0972f, 109.84658f, 242.70837f, (byte) 30), "3001700001"); //Macunbello's Right Hand.
    }

    private void startWalk(final Npc npc, final String walkId) {
        ThreadPoolManager.getInstance().schedule(new Runnable() {
            @Override
            public void run() {
                npc.getSpawn().setWalkerId(walkId);
                WalkManager.startWalking((NpcAI2) npc.getAi2());
                npc.setState(1);
                PacketSendUtility.broadcastPacket(npc, new SM_EMOTION(npc, EmotionType.START_EMOTE2, 0, npc.getObjectId()));
            }
        }, 2000);
    }
}