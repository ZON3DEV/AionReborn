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
package quest.idian_depths;

import com.aionemu.gameserver.model.DialogAction;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;
import com.aionemu.gameserver.services.QuestService;

/**
 * @author Evil_dnk
 */
public class _13617TomboftheElder extends QuestHandler {

    private final static int questId = 13617;

    public _13617TomboftheElder() {
        super(questId);
    }

    public void register() {
        qe.registerQuestNpc(730822).addOnQuestStart(questId);
        qe.registerQuestNpc(730822).addOnTalkEvent(questId);
        qe.registerQuestNpc(801543).addOnTalkEvent(questId);
        qe.registerQuestNpc(233041).addOnKillEvent(questId);
    }

    @Override
    public boolean onDialogEvent(QuestEnv env) {
        Player player = env.getPlayer();
        int targetId = env.getTargetId();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        DialogAction dialog = env.getDialog();

        if (qs == null || qs.getStatus() == QuestStatus.NONE) {
            if (targetId == 730822) {
                if (dialog == DialogAction.QUEST_SELECT) {
                    return sendQuestDialog(env, 1011);
                } else if (dialog == DialogAction.QUEST_ACCEPT_SIMPLE) {
                    QuestService.addNewSpawn(player.getWorldId(), player.getInstanceId(), 233041, player.getX() - 2, player.getY() - 2, player.getZ(), (byte) 0);
                    QuestService.startQuest(env);
                    updateQuestStatus(env);
                    return closeDialogWindow(env);
                } else {
                    return sendQuestStartDialog(env);
                }
            }
        } else if (qs.getStatus() == QuestStatus.START) {
            if (targetId == 801543) {
                if (dialog == DialogAction.QUEST_SELECT) {
                    if (qs.getQuestVarById(0) == 1) {
                        return sendQuestDialog(env, 1352);
                    }
                } else if (dialog == DialogAction.SELECT_QUEST_REWARD) {
                    changeQuestStep(env, 1, 2, true);
                    return sendQuestDialog(env, 5);
                }
            }
        } else if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 801543) {
                return sendQuestEndDialog(env);
            }
        }
        return false;
    }

    public boolean onKillEvent(QuestEnv env) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (qs != null && qs.getStatus() == QuestStatus.START) {
            switch (env.getTargetId()) {
                case 233041:
                    if (qs.getQuestVarById(0) == 0) {
                        qs.setQuestVarById(0, qs.getQuestVarById(0) + 1);
                        updateQuestStatus(env);
                        return true;
                    }
            }
        }
        return false;
    }
}