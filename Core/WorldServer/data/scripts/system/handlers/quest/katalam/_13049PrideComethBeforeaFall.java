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
package quest.katalam;

import com.aionemu.gameserver.model.DialogAction;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;

//By Evil_dnk
public class _13049PrideComethBeforeaFall extends QuestHandler {

    private static final int questId = 13049;

    public _13049PrideComethBeforeaFall() {
        super(questId);
    }

    @Override
    public void register() {
        qe.registerQuestNpc(801058).addOnQuestStart(questId);
        qe.registerQuestNpc(801058).addOnTalkEvent(questId);
        qe.registerQuestNpc(801275).addOnTalkEvent(questId);
        qe.registerQuestNpc(801140).addOnTalkEvent(questId);
    }

    @Override
    public boolean onDialogEvent(QuestEnv env) {
        Player player = env.getPlayer();
        int targetId = env.getTargetId();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        DialogAction dialog = env.getDialog();

        if (qs == null || qs.getStatus() == QuestStatus.NONE) {
            if (targetId == 801058) {
                if (dialog == DialogAction.QUEST_SELECT) {
                    return sendQuestDialog(env, 1011);
                } else {
                    return sendQuestStartDialog(env);
                }
            }
        } else if (qs.getStatus() == QuestStatus.START) {
            if (targetId == 801275) {
                if (dialog == DialogAction.QUEST_SELECT) {
                    return sendQuestDialog(env, 1352);
                }
                if (dialog == DialogAction.SETPRO1) {
                    return defaultCloseDialog(env, 0, 1);
                }
            }
            if (targetId == 801140) {
                if (dialog == DialogAction.QUEST_SELECT) {
                    return sendQuestDialog(env, 1693);
                }
                if (dialog == DialogAction.SETPRO2) {
                    return defaultCloseDialog(env, 1, 2);
                }
            }
            if (targetId == 801058) {
                if (dialog == DialogAction.QUEST_SELECT) {
                    return sendQuestDialog(env, 2375);
                }
                if (dialog == DialogAction.SELECT_QUEST_REWARD) {
                    changeQuestStep(env, 2, 3, true); // reward
                    return sendQuestDialog(env, 5);
                }
            }
        } else if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 801058) {
                return sendQuestEndDialog(env);
            }
        }
        return false;
    }
}