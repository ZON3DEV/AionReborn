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
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;

/**
 * @author Romanz
 */
public class _12564TheNovunConnection extends QuestHandler {

    private final static int questId = 12564;

    public _12564TheNovunConnection() {
        super(questId);
    }

    @Override
    public void register() {
        qe.registerQuestNpc(801019).addOnQuestStart(questId);
        qe.registerQuestNpc(801019).addOnTalkEvent(questId);
        qe.registerQuestNpc(206317).addOnAtDistanceEvent(questId);
        qe.registerQuestNpc(730802).addOnTalkEvent(questId);
    }

    @Override
    public boolean onDialogEvent(QuestEnv env) {
        final Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        int targetId = env.getTargetId();
        DialogAction dialog = env.getDialog();

        if (qs == null || qs.getStatus() == QuestStatus.NONE) {
            if (targetId == 801019) {
                switch (dialog) {
                    case QUEST_SELECT: {
                        return sendQuestDialog(env, 4762);
                    }
                    case QUEST_ACCEPT_SIMPLE: {
                        return sendQuestStartDialog(env);
                    }
                }
            }
        } else if (targetId == 730802) {
            switch (dialog) {
                case QUEST_SELECT: {
                    if (qs.getQuestVarById(0) == 1) {
                        return sendQuestDialog(env, 1352);
                    }
                }
                case SETPRO2: {
                    return defaultCloseDialog(env, 1, 2, true, false);
                }
            }
        } else if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 801019) {
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
    public boolean onAtDistanceEvent(QuestEnv env) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (qs != null && qs.getStatus() == QuestStatus.START) {
            if (qs.getQuestVarById(0) == 0) {
                changeQuestStep(env, 0, 1, false);
                return true;
            }
        }
        return false;
    }
}