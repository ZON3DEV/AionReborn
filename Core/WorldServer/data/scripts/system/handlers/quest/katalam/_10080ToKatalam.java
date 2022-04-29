/*
 * This file is part of aion-lightning <aion-lightning.com>.
 *
 *  aion-lightning is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  aion-lightning is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with aion-lightning.  If not, see <http://www.gnu.org/licenses/>.
 */
package quest.katalam;

import com.aionemu.gameserver.model.DialogAction;
import com.aionemu.gameserver.model.TeleportAnimation;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;
import com.aionemu.gameserver.services.teleport.TeleportService2;

/**
 * @author Romanz
 */
public class _10080ToKatalam extends QuestHandler {

    private final static int questId = 10080;

    public _10080ToKatalam() {
        super(questId);
    }

    @Override
    public void register() {
        int[] npcIds = {800165, 205543, 800526, 800527};
        qe.registerOnLevelUp(questId);
        qe.registerOnEnterWorld(questId);
        for (int npcId : npcIds) {
            qe.registerQuestNpc(npcId).addOnTalkEvent(questId);
        }
    }

    @Override
    public boolean onLvlUpEvent(QuestEnv env) {
        return defaultOnLvlUpEvent(env);
    }

    @Override
    public boolean onDialogEvent(QuestEnv env) {
        final Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        int targetId = env.getTargetId();
        DialogAction dialog = env.getDialog();

        if (qs != null && qs.getStatus() == QuestStatus.START) {
            if (targetId == 800165) {
                switch (dialog) {
                    case QUEST_SELECT: {
                        if (qs.getQuestVarById(0) == 0) {
                            return sendQuestDialog(env, 1011);
                        }
                    }
                    case SETPRO1: {
                        return defaultCloseDialog(env, 0, 1);
                    }
                }
            } else if (targetId == 205543) {
                switch (dialog) {
                    case QUEST_SELECT: {
                        if (qs.getQuestVarById(0) == 1) {
                            return sendQuestDialog(env, 1352);
                        }
                    }
                    case SETPRO2: {
                        TeleportService2.teleportTo(player, 600050000, player.getInstanceId(), 273, 2457, 161.1f, (byte) 30, TeleportAnimation.BEAM_ANIMATION);
                        return defaultCloseDialog(env, 1, 2);
                    }
                }
            } else if (targetId == 800526) {
                switch (dialog) {
                    case QUEST_SELECT: {
                        if (qs.getQuestVarById(0) == 3) {
                            return sendQuestDialog(env, 2034);
                        }
                    }
                    case SET_SUCCEED: {
                        return defaultCloseDialog(env, 3, 3, true, false);
                    }
                }
            }
        } else if (qs != null && qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 800527) {
                if (dialog == DialogAction.USE_OBJECT) {
                    return sendQuestDialog(env, 10002);
                } else {
                    return sendQuestEndDialog(env);
                }
            }
        }
        return false;
    }

    @Override
    public boolean onEnterWorldEvent(QuestEnv env) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);

        if (qs != null && qs.getStatus() == QuestStatus.START) {
            if (player.getWorldId() == 600050000) {
                int var = qs.getQuestVarById(0);
                if (var == 2) {
                    playQuestMovie(env, 821);
                    changeQuestStep(env, 2, 3, false);
                    return true;
                }
            }
        }
        return false;
    }
}