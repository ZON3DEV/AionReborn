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
public class _12535AGentleRemembrance extends QuestHandler {

    private final static int questId = 12535;

    public _12535AGentleRemembrance() {
        super(questId);
    }

    @Override
    public void register() {
        qe.registerQuestNpc(801008).addOnQuestStart(questId);
        qe.registerQuestNpc(801008).addOnTalkEvent(questId);
        qe.registerQuestNpc(701738).addOnTalkEvent(questId);
    }

    @Override
    public boolean onDialogEvent(QuestEnv env) {
        final Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        int targetId = env.getTargetId();
        DialogAction dialog = env.getDialog();

        if (qs == null || qs.getStatus() == QuestStatus.NONE) {
            if (targetId == 801008) {
                switch (dialog) {
                    case QUEST_SELECT: {
                        return sendQuestDialog(env, 4762);
                    }
                    case QUEST_ACCEPT_SIMPLE: {
                        return sendQuestStartDialog(env);
                    }
                }
            }
        } else if (targetId == 701738) {
            if (env.getDialog() == DialogAction.USE_OBJECT) {
                int var = qs.getQuestVarById(0);
                if (var == 0) {
                    return useQuestObject(env, 0, 1, false, true);
                }
                if (var == 1) {
                    return useQuestObject(env, 1, 2, false, true);
                }
                if (var == 2) {
                    return useQuestObject(env, 2, 3, true, true);
                }
            }
        } else if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 801008) {
                if (dialog == DialogAction.USE_OBJECT) {
                    return sendQuestDialog(env, 10002);
                } else {
                    return sendQuestEndDialog(env);
                }
            }
        }
        return false;
    }
}