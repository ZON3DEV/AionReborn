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
import com.aionemu.gameserver.model.gameobjects.Item;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.HandlerResult;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;
import com.aionemu.gameserver.services.QuestService;

/**
 * @author Evil_dnk
 */
public class _13613TheOfficersOfferRedux extends QuestHandler {

    private final static int questId = 13613;

    public _13613TheOfficersOfferRedux() {
        super(questId);
    }

    public void register() {
        qe.registerQuestItem(182213493, questId);
        qe.registerQuestNpc(801541).addOnTalkEvent(questId);
    }

    @Override
    public boolean onDialogEvent(QuestEnv env) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        DialogAction dialog = env.getDialog();
        int targetId = env.getTargetId();

        if (qs == null || qs.getStatus() == QuestStatus.NONE) {
            if (targetId == 0) {
                if (dialog == DialogAction.QUEST_ACCEPT_SIMPLE) {
                    QuestService.startQuest(env);
                    return closeDialogWindow(env);
                }
                if (dialog == DialogAction.QUEST_REFUSE_SIMPLE) {
                    return closeDialogWindow(env);
                }
            }
        } else if (qs.getStatus() == QuestStatus.START) {
            if (targetId == 801541) {
                if (dialog == DialogAction.QUEST_SELECT) {
                    return sendQuestDialog(env, 2375);
                } else if (dialog == DialogAction.SELECT_QUEST_REWARD) {
                    removeQuestItem(env, 182213493, 1);
                    return defaultCloseDialog(env, 0, 1, true, true);
                }
            }
        } else if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 801541) {
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
            return HandlerResult.fromBoolean(sendQuestDialog(env, 1011));
        }
        return HandlerResult.FAILED;
    }
}