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
import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;

//By Evil_dnk
public class _13030CombatMechanic extends QuestHandler {

    private final static int questId = 13030;

    public _13030CombatMechanic() {
        super(questId);
    }

    public void register() {
        qe.registerQuestNpc(801097).addOnQuestStart(questId);
        qe.registerQuestNpc(801097).addOnTalkEvent(questId);
        qe.registerQuestNpc(701685).addOnTalkEvent(questId);
        qe.registerQuestNpc(701686).addOnTalkEvent(questId);
        qe.registerQuestNpc(701687).addOnTalkEvent(questId);
    }

    @Override
    public boolean onDialogEvent(QuestEnv env) {
        Player player = env.getPlayer();
        int targetId = env.getTargetId();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        DialogAction dialog = env.getDialog();

        if (qs == null || qs.getStatus() == QuestStatus.NONE) {
            if (targetId == 801097) {
                if (dialog == DialogAction.QUEST_SELECT) {
                    return sendQuestDialog(env, 4762);
                } else {
                    return sendQuestStartDialog(env);
                }
            }
        } else if (qs.getStatus() == QuestStatus.START) {
            if (targetId == 701685 || targetId == 701686 || targetId == 701687) {
                final Npc npc = (Npc) env.getVisibleObject();
                if (qs.getQuestVarById(0) < 2) {
                    changeQuestStep(env, qs.getQuestVarById(0), qs.getQuestVarById(0) + 1, false);
                    npc.getController().die();
                    return closeDialogWindow(env);
                }
                if (qs.getQuestVarById(0) == 2) {
                    changeQuestStep(env, 2, 3, true);
                    return closeDialogWindow(env);
                }

            }
        } else if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 801097) {
                return sendQuestEndDialog(env);
            }
        }
        return false;
    }
}