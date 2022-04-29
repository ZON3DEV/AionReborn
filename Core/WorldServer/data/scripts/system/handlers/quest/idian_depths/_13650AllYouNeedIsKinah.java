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

/**
 *
 * @author xXMashUpXx
 *
 */
public class _13650AllYouNeedIsKinah extends QuestHandler {

    private final static int questId = 13650;

    public _13650AllYouNeedIsKinah() {
        super(questId);
    }

    @Override
    public boolean onLvlUpEvent(QuestEnv env) {
        return defaultOnLvlUpEvent(env);
    }

    @Override
    public void register() {
        qe.registerOnLevelUp(questId);
        qe.registerQuestNpc(800523).addOnQuestStart(questId); //Seleon.
        qe.registerQuestNpc(800523).addOnTalkEvent(questId); //Seleon.
        qe.registerQuestNpc(800523).addOnTalkEvent(questId); //Seleon.
    }

    @Override
    public boolean onDialogEvent(QuestEnv env) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        DialogAction dialog = env.getDialog();
        int targetId = env.getTargetId();
        if (qs == null || qs.getStatus() == QuestStatus.NONE) {
            if (targetId == 800523) { //Seleon.
                switch (dialog) {
                    case QUEST_SELECT: {
                        return sendQuestDialog(env, 1011);
                    }
                    case QUEST_ACCEPT_1:
                    case QUEST_ACCEPT_SIMPLE:
                        return sendQuestStartDialog(env);
                    default:
                        break;
                }
            }
        } else if (qs.getStatus() == QuestStatus.START) {
            switch (targetId) {
                case 800523: { //Seleon.
                    switch (dialog) {
                        case QUEST_SELECT: {
                            return sendQuestDialog(env, 2375);
                        }
                        case SELECT_QUEST_REWARD: {
                            changeQuestStep(env, 0, 0, true);
                            return sendQuestEndDialog(env);
                        }
                        default:
                            break;
                    }
                }
            }
        } else if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 800523) { //Seleon.
                return sendQuestEndDialog(env);
            }
        }
        return false;
    }
}