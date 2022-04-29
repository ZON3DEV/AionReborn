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

import com.aionemu.gameserver.model.DialogAction;
import com.aionemu.gameserver.model.gameobjects.Item;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.HandlerResult;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;
import com.aionemu.gameserver.services.QuestService;

/**
 * @author Romanz
 *
 */
public class _13060StrangeWater extends QuestHandler {

    private final static int questId = 13060;

    public _13060StrangeWater() {
        super(questId);
    }

    @Override
    public void register() {
        qe.registerQuestItem(182213452, questId);
        qe.registerQuestNpc(801096).addOnTalkEvent(questId);
        qe.registerQuestNpc(801095).addOnTalkEvent(questId);
        qe.registerQuestNpc(800936).addOnTalkEvent(questId);
        qe.registerQuestNpc(800937).addOnTalkEvent(questId);
        qe.registerQuestNpc(800938).addOnTalkEvent(questId);
    }

    @Override
    public boolean onDialogEvent(QuestEnv env) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        DialogAction dialog = env.getDialog();
        int targetId = env.getTargetId();

        if (qs == null || qs.getStatus() == QuestStatus.NONE) {
            if (targetId == 0) {
                if (dialog == DialogAction.QUEST_ACCEPT_1) {
                    QuestService.startQuest(env);
                    return closeDialogWindow(env);
                }
            }
        } else if (qs.getStatus() == QuestStatus.START) {
            if (targetId == 801096) {
                switch (dialog) {
                    case QUEST_SELECT: {
                        if (qs.getQuestVarById(0) == 0) {
                            return sendQuestDialog(env, 1352);
                        } else if (qs.getQuestVarById(0) == 2) {
                            return sendQuestDialog(env, 2034);
                        }
                    }
                    case SETPRO1: {
                        removeQuestItem(env, 182213452, 1);
                        return defaultCloseDialog(env, 0, 1);
                    }
                    case SETPRO3: {
                        return defaultCloseDialog(env, 2, 3);
                    }
                }
            } else if (targetId == 801095) {
                switch (dialog) {
                    case QUEST_SELECT: {
                        return sendQuestDialog(env, 1693);
                    }
                    case SETPRO2: {
                        return defaultCloseDialog(env, 1, 2);
                    }
                }
            } else if (targetId == 800936 || targetId == 800937 || targetId == 800938) {
                switch (dialog) {
                    case QUEST_SELECT: {
                        return sendQuestDialog(env, 2375);
                    }
                    case SELECT_QUEST_REWARD: {
                        changeQuestStep(env, 3, 3, true); // reward
                        return sendQuestDialog(env, 5);
                    }
                }
            }
        } else if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 800936 || targetId == 800937 || targetId == 800938) {
                return sendQuestEndDialog(env);
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