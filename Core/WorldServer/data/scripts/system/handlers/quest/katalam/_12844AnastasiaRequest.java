/*
 * This file is part of aion-engine <aion-engine.net>
 *
 * aion-engine is private software: you can redistribute it and or modify
 * it under the terms of the GNU Lesser Public License as published by
 * the Private Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * aion-engine is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser Public License for more details.
 *
 * You should have received a copy of the GNU Lesser Public License
 * along with aion-engine.  If not, see <http://www.gnu.org/licenses/>.
 */
package quest.katalam;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.serverpackets.SM_DIALOG_WINDOW;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;
import com.aionemu.gameserver.services.QuestService;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.world.zone.ZoneName;

/**
 * @author Romanz
 */
public class _12844AnastasiaRequest extends QuestHandler {

    private final static int questId = 12844;

    public _12844AnastasiaRequest() {
        super(questId);
    }

    @Override
    public void register() {
        qe.registerQuestNpc(801230).addOnTalkEvent(questId);
        qe.registerOnEnterZone(ZoneName.get("WZ_WEATHERZONELDF5A_WEATHER2_600050000"), questId);
        qe.registerOnKillInWorld(600050000, questId);
    }

    @Override
    public boolean onKillInWorldEvent(QuestEnv env) {
        Player player = env.getPlayer();
        if (env.getVisibleObject() instanceof Player && player != null && player.isInsideZone(ZoneName.get("WZ_WEATHERZONELDF5A_WEATHER2_600050000"))) {
            if ((env.getPlayer().getLevel() >= (((Player) env.getVisibleObject()).getLevel() - 5)) && (env.getPlayer().getLevel() <= (((Player) env.getVisibleObject()).getLevel() + 9))) {
                return defaultOnKillRankedEvent(env, 0, 1, true); // reward
            }
        }
        return false;
    }

    @Override
    public boolean onDialogEvent(QuestEnv env) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        int targetId = env.getTargetId();

        if (qs != null && qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 801230) {
                switch (env.getDialog()) {
                    case USE_OBJECT:
                        return sendQuestDialog(env, 10002);
                    case SELECT_QUEST_REWARD:
                        return sendQuestDialog(env, 5);
                    default:
                        return sendQuestEndDialog(env);
                }
            }
        }
        return false;
    }

    @Override
    public boolean onEnterZoneEvent(QuestEnv env, ZoneName zoneName) {
        if (zoneName == ZoneName.get("WZ_WEATHERZONELDF5A_WEATHER2_600050000")) {
            Player player = env.getPlayer();
            if (player == null) {
                return false;
            }
            QuestState qs = player.getQuestStateList().getQuestState(questId);
            if (qs == null || qs.getStatus() == QuestStatus.NONE || qs.canRepeat()) {
                QuestService.startQuest(env);
                PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(0, 0));
                return true;

            }
        }
        return false;
    }
}