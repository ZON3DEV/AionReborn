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
package quest.danaria;

import com.aionemu.gameserver.model.DialogAction;
import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.serverpackets.SM_DIALOG_WINDOW;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;
import com.aionemu.gameserver.utils.PacketSendUtility;

/**
 *
 * @author xXMashUpXx
 *
 */
public class _23561ThoroughSenseofJustice1 extends QuestHandler {

    private final static int questId = 23561;

    public _23561ThoroughSenseofJustice1() {
        super(questId);
    }

    @Override
    public void register() {
        qe.registerQuestNpc(801141).addOnQuestStart(questId); //Meyecherk.
        qe.registerQuestNpc(800959).addOnTalkEvent(questId); //Devrinerk.
        qe.registerQuestNpc(800981).addOnTalkEvent(questId); //Crerunerk.
        qe.registerQuestNpc(800958).addOnTalkEvent(questId); //Saparinerk.
        qe.registerQuestNpc(801144).addOnTalkEvent(questId); //Opirinerk.
    }

    @Override
    public boolean onDialogEvent(QuestEnv env) {
        final Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        int targetId = 0;
        if (env.getVisibleObject() instanceof Npc) {
            targetId = ((Npc) env.getVisibleObject()).getNpcId();
        }
        if (qs == null || qs.getStatus() == QuestStatus.NONE) {
            if (targetId == 801141) { //Meyecherk.
                if (env.getDialog() == DialogAction.QUEST_SELECT) {
                    return sendQuestDialog(env, 1011);
                } else {
                    return sendQuestStartDialog(env);
                }
            }
        }
        if (qs == null) {
            return false;
        }
        if (qs.getStatus() == QuestStatus.START) {
            switch (targetId) {
                case 800959: { //Devrinerk.
                    switch (env.getDialog()) {
                        case QUEST_SELECT: {
                            return sendQuestDialog(env, 1352);
                        }
                        case SETPRO1: {
                            qs.setQuestVarById(0, qs.getQuestVarById(0) + 1);
                            updateQuestStatus(env);
                            PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(env.getVisibleObject().getObjectId(), 10));
                            return true;
                        }
                        default:
                            break;
                    }
                }
                case 800981: { //Crerunerk.
                    switch (env.getDialog()) {
                        case QUEST_SELECT: {
                            return sendQuestDialog(env, 1693);
                        }
                        case SETPRO2: {
                            qs.setQuestVarById(0, qs.getQuestVarById(0) + 1);
                            updateQuestStatus(env);
                            PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(env.getVisibleObject().getObjectId(), 10));
                            return true;
                        }
                        default:
                            break;
                    }
                }
                case 800958: { //Saparinerk.
                    switch (env.getDialog()) {
                        case QUEST_SELECT: {
                            return sendQuestDialog(env, 2034);
                        }
                        case SETPRO3: {
                            qs.setQuestVarById(0, qs.getQuestVarById(0) + 1);
                            updateQuestStatus(env);
                            PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(env.getVisibleObject().getObjectId(), 10));
                            return true;
                        }
                        default:
                            break;
                    }
                }
                case 801144: { //Opirinerk.
                    switch (env.getDialog()) {
                        case QUEST_SELECT: {
                            return sendQuestDialog(env, 2375);
                        }
                        case SELECT_QUEST_REWARD: {
                            qs.setQuestVar(3);
                            qs.setStatus(QuestStatus.REWARD);
                            updateQuestStatus(env);
                            return sendQuestEndDialog(env);
                        }
                        default:
                            return sendQuestEndDialog(env);
                    }
                }
            }
        } else if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 801144) { //Opirinerk.
                switch (env.getDialog()) {
                    case SELECT_QUEST_REWARD: {
                        return sendQuestDialog(env, 5);
                    }
                    default:
                        return sendQuestEndDialog(env);
                }
            }
        }
        return false;
    }
}