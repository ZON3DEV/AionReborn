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
 *  You should have received a copy of the GNU General Public License
 *  along with Aion-Lightning.
 *  If not, see <http://www.gnu.org/licenses/>.
 */
package quest.katalam;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;

/**
 * @author Romanz
 */
public class _22524UnexpectedInformation extends QuestHandler {

    private final static int questId = 22524;
    private final static int[] mobs = {231212};

    public _22524UnexpectedInformation() {
        super(questId);
    }

    @Override
    public void register() {
        qe.registerOnLevelUp(questId);
        for (int mob : mobs) {
            qe.registerQuestNpc(mob).addOnKillEvent(questId);
        }
        qe.registerQuestNpc(800996).addOnTalkEvent(questId);
    }

    @Override
    public boolean onLvlUpEvent(QuestEnv env) {
        return defaultOnLvlUpEvent(env);
    }

    @Override
    public boolean onDialogEvent(QuestEnv env) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        int targetId = env.getTargetId();

        if (qs != null && qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 800996) {
                switch (env.getDialog()) {
                    case USE_OBJECT:
                        return sendQuestDialog(env, 1352);
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
    public boolean onKillEvent(QuestEnv env) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (qs != null && qs.getStatus() == QuestStatus.START) {
            int var = qs.getQuestVarById(0);
            if (var == 0 && env.getTargetId() == 231212) {
                changeQuestStep(env, var, var + 1, false);
                if (var == 1) {
                    qs.setQuestVar(1);
                    changeQuestStep(env, 0, 1, false);
                    updateQuestStatus(env);
                }
                return true;
            }
            if (var == 1 && env.getTargetId() == 231212) {
                changeQuestStep(env, var, var + 1, false);
                if (var == 2) {
                    qs.setQuestVar(2);
                    changeQuestStep(env, 1, 2, false);
                    updateQuestStatus(env);
                }
                return true;
            }
            if (var == 2 && env.getTargetId() == 231212) {
                changeQuestStep(env, var, var + 1, false);
                if (var == 3) {
                    qs.setQuestVar(3);
                    changeQuestStep(env, 2, 3, false);
                    updateQuestStatus(env);
                }
                return true;
            }
            if (var == 3 && env.getTargetId() == 231212) {
                changeQuestStep(env, var, var + 1, false);
                if (var == 4) {
                    qs.setQuestVar(4);
                    changeQuestStep(env, 3, 4, false);
                    updateQuestStatus(env);
                }
                return true;
            }
            if (var == 4 && env.getTargetId() == 231212) {
                changeQuestStep(env, var, var + 1, true);
                if (var == 5) {
                    qs.setQuestVar(5);
                    qs.setStatus(QuestStatus.REWARD);
                    updateQuestStatus(env);
                }
                return true;
            }
        }
        return false;
    }
}