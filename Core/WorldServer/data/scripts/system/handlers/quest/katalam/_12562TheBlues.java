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

/**
 * @author Romanz
 */
public class _12562TheBlues extends QuestHandler {

    private final static int questId = 12562;

    public _12562TheBlues() {
        super(questId);
    }

    @Override
    public void register() {
        qe.registerQuestItem(182213335, questId);
        qe.registerQuestNpc(800561).addOnQuestStart(questId);
        qe.registerQuestNpc(800561).addOnTalkEvent(questId);
    }

    @Override
    public boolean onDialogEvent(QuestEnv env) {
        final Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        int targetId = env.getTargetId();
        DialogAction dialog = env.getDialog();

        if (qs == null || qs.getStatus() == QuestStatus.NONE) {
            if (targetId == 800561) {
                switch (dialog) {
                    case QUEST_SELECT: {
                        return sendQuestDialog(env, 1011);
                    }
                    case QUEST_ACCEPT_SIMPLE: {
                        return sendQuestStartDialog(env, 182213335, 1);
                    }
                }
            }
        } else if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 800561) {
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
        if (qs != null && qs.getStatus() == QuestStatus.START) {
            return HandlerResult.fromBoolean(useQuestItem(env, item, 0, 1, true));
        }
        return HandlerResult.FAILED;
    }
}