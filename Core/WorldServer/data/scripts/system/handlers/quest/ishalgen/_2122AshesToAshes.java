/*
 * This file is part of aion-engine <aion-engine.com>
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
package quest.ishalgen;

import com.aionemu.gameserver.model.DialogAction;
import com.aionemu.gameserver.model.gameobjects.Item;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.serverpackets.SM_DIALOG_WINDOW;
import com.aionemu.gameserver.questEngine.handlers.HandlerResult;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;
import com.aionemu.gameserver.services.QuestService;
import com.aionemu.gameserver.utils.PacketSendUtility;

/**
 * @author Cheatkiller
 */
public class _2122AshesToAshes extends QuestHandler {

    private final static int questId = 2122;
    private int[] npcs = {203551, 700148, 730029};

    public _2122AshesToAshes() {
        super(questId);
    }

    @Override
    public void register() {
        qe.registerQuestItem(182203120, questId);
        qe.registerCanAct(getQuestId(), 700148);
        for (int npc : npcs) {
            qe.registerQuestNpc(npc).addOnTalkEvent(questId);
        }
    }

    @Override
    public boolean onDialogEvent(QuestEnv env) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (qs == null) {
            return false;
        }
        int targetId = env.getTargetId();
        DialogAction dialog = env.getDialog();

        if (targetId == 0) {
            if (env.getDialogId() == DialogAction.QUEST_ACCEPT_1.id()) {
                QuestService.startQuest(env);
                PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(0, 0));
                return true;
            }
        }

        if (qs.getStatus() == QuestStatus.START) {
            if (targetId == 203551) {
                switch (dialog) {
                    case QUEST_SELECT: {
                        return sendQuestDialog(env, 1011);
                    }
                    case SELECT_ACTION_1012: {
                        removeQuestItem(env, 182203120, 1);
                        return sendQuestDialog(env, 1012);
                    }
                    case SETPRO1: {
                        return defaultCloseDialog(env, 0, 1);
                    }
                }
            } else if (targetId == 730029) {
                switch (dialog) {
                    case USE_OBJECT: {
                        if (player.getInventory().getItemCountByItemId(182203133) >= 1) {
                            return sendQuestDialog(env, 1352);
                        } else {
                            return sendQuestDialog(env, 1693);
                        }
                    }
                    case SELECT_ACTION_1353: {
                        removeQuestItem(env, 182203133, 1);
                        return sendQuestDialog(env, 1353);
                    }
                    case FINISH_DIALOG: {
                        return closeDialogWindow(env);
                    }
                    case SETPRO2: {
                        return defaultCloseDialog(env, 1, 1, true, false);
                    }
                }
            } else if (targetId == 700148) {
                return true; // just give quest drop on use
            }
        } else if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 203551) {
                if (dialog == DialogAction.USE_OBJECT) {
                    return sendQuestDialog(env, 2375);
                } else {
                    return sendQuestEndDialog(env);
                }
            }
        }
        return false;
    }

    @Override
    public HandlerResult onItemUseEvent(QuestEnv env, Item item) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (qs == null || qs.getStatus() == QuestStatus.NONE) {
            return HandlerResult.fromBoolean(sendQuestDialog(env, 4));
        }
        return HandlerResult.FAILED;
    }
}