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

import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;

public class _13618SeekAndInterpret extends QuestHandler {

    private final static int questId = 13618;

    public _13618SeekAndInterpret() {
        super(questId);
    }

    @Override
    public void register() {
        qe.registerQuestNpc(801543).addOnQuestStart(questId);
        qe.registerQuestNpc(801543).addOnTalkEvent(questId);
        qe.registerQuestNpc(730822).addOnTalkEvent(questId);
        qe.registerQuestNpc(730826).addOnTalkEvent(questId);
    }

    @Override
    public boolean onDialogEvent(final QuestEnv env) {
        final Player player = env.getPlayer();
        final QuestState qs = player.getQuestStateList().getQuestState(questId);
        int targetId = 0;
        if (env.getVisibleObject() instanceof Npc) {
            targetId = ((Npc) env.getVisibleObject()).getNpcId();
        }
        if (qs == null || qs.getStatus() == QuestStatus.NONE) {
            if (targetId == 801543) {
                switch (env.getDialog()) {
                    case QUEST_SELECT: {
                        return sendQuestDialog(env, 1011);
                    }
                    default:
                        return sendQuestStartDialog(env);
                }
            }
        }
        if (qs == null) {
            return false;
        }
        if (qs.getStatus() == QuestStatus.START) {
            switch (targetId) {
                case 730822: {
                    switch (env.getDialog()) {
                        case USE_OBJECT: {
                            return useQuestObject(env, 0, 1, false, 0);
                        }
                    }
                    break;
                }
                case 730826: {
                    switch (env.getDialog()) {
                        case USE_OBJECT: {
                            return useQuestObject(env, 1, 2, false, 0);
                        }
                    }
                    break;
                }
            }
        } else if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 801543) {
                if (env.getDialogId() == 1009) {
                    return sendQuestDialog(env, 3);
                } else {
                    return sendQuestEndDialog(env);
                }
            }
        }
        return false;
    }
}