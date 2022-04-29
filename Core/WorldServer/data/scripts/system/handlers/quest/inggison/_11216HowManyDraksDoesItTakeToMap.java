/**
 * This file is part of aion-lightning <aion-lightning.com>.
 *
 *  aion-lightning is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  aion-lightning is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with aion-lightning.  If not, see <http://www.gnu.org/licenses/>.
 */
package quest.inggison;

import com.aionemu.gameserver.model.DialogAction;
import com.aionemu.gameserver.model.gameobjects.Item;
import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.HandlerResult;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;
import com.aionemu.gameserver.services.QuestService;

/**
 * @author DeathMagnestic
 */
public class _11216HowManyDraksDoesItTakeToMap extends QuestHandler {

    private final static int questId = 11216;

    public _11216HowManyDraksDoesItTakeToMap() {
        super(questId);
    }

    @Override
    public void register() {
        qe.registerQuestItem(182206825, questId);
        qe.registerQuestNpc(799017).addOnTalkEvent(questId);
        qe.registerQuestNpc(700624).addOnTalkEvent(questId);
        qe.registerQuestNpc(700625).addOnTalkEvent(questId);
        qe.registerQuestNpc(700626).addOnTalkEvent(questId);
        qe.registerQuestNpc(700627).addOnTalkEvent(questId);
    }

    @Override
    public boolean onDialogEvent(final QuestEnv env) {
        final Player player = env.getPlayer();
        int targetId = 0;
        final QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (env.getVisibleObject() instanceof Npc) {
            targetId = ((Npc) env.getVisibleObject()).getNpcId();
        }

        if (qs == null || qs.getStatus() == QuestStatus.NONE) {
            if (targetId == 0) {
                if (env.getDialog() == DialogAction.QUEST_ACCEPT_1) {
                    removeQuestItem(env, 182206825, 1);
                    QuestService.startQuest(env);
                    return closeDialogWindow(env);
                }
            }
        }
        if (qs == null) {
            return false;
        }

        int var = qs.getQuestVarById(0);
        if (qs != null && qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 799017) {
                switch (env.getDialog()) {
                    case USE_OBJECT:
                        return sendQuestDialog(env, 10002);
                    case SELECT_QUEST_REWARD:
                        return sendQuestDialog(env, 5);
                    default:
                        return sendQuestEndDialog(env);
                }
            }
        } else if (qs.getStatus() == QuestStatus.START) {
            switch (targetId) {
                case 700624: {
                    switch (env.getDialog()) {
                        case USE_OBJECT: {
                            if (player.getInventory().getItemCountByItemId(182206827) == 0) {
                                giveQuestItem(env, 182206827, 1);
                            }
                        }
                    }
                    break;
                }
                case 700625: {
                    switch (env.getDialog()) {
                        case USE_OBJECT: {
                            if (player.getInventory().getItemCountByItemId(182206828) == 0) {
                                giveQuestItem(env, 182206828, 1);
                            }
                        }
                    }
                    break;
                }
                case 700626: {
                    switch (env.getDialog()) {
                        case USE_OBJECT: {
                            if (player.getInventory().getItemCountByItemId(182206829) == 0) {
                                giveQuestItem(env, 182206829, 1);
                            }
                        }
                    }
                    break;
                }
                case 700627: {
                    switch (env.getDialog()) {
                        case USE_OBJECT: {
                            if (player.getInventory().getItemCountByItemId(182206830) == 0) {
                                giveQuestItem(env, 182206830, 1);
                            }
                        }
                    }
                    break;
                }
                case 799017: {
                    switch (env.getDialog()) {
                        case QUEST_SELECT:
                            if (var == 0) {
                                return sendQuestDialog(env, 1011);
                            } else if (var == 1) {
                                return sendQuestDialog(env, 1352);
                            }
                        case SELECT_ACTION_1012:
                            return defaultCloseDialog(env, 0, 1);
                        case CHECK_USER_HAS_QUEST_ITEM:
                            return checkQuestItems(env, 1, 2, true, 5, 10001);
                    }
                    break;
                }
            }
        }
        return false;
    }

    @Override
    public HandlerResult onItemUseEvent(QuestEnv env, Item item) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (qs == null || qs.getStatus() == QuestStatus.NONE) {
            return HandlerResult.fromBoolean(sendQuestDialog(env, 4));
        }
        return HandlerResult.FAILED;
    }
}