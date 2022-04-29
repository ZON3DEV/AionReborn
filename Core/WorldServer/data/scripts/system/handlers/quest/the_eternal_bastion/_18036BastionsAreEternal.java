/*
 * This file is part of aion-engine <aion-engine.com>
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
package quest.the_eternal_bastion;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.model.DialogAction;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;

//By Evil_dnk

public class _18036BastionsAreEternal extends QuestHandler {

    private final static int questId = 18036;

    public _18036BastionsAreEternal() {
        super(questId);
    }

    @Override
    public void register() {
        qe.registerQuestNpc(801037).addOnQuestStart(questId);
        qe.registerQuestNpc(801037).addOnTalkEvent(questId);
        qe.registerQuestNpc(802008).addOnTalkEvent(questId);
    }

    @Override
    public boolean onDialogEvent(QuestEnv env) {
        Player player = env.getPlayer();
        int targetId = env.getTargetId();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        DialogAction dialog = env.getDialog();

        if (qs == null || qs.getStatus() == QuestStatus.NONE) {
            if (targetId == 801037) {
                if (dialog == DialogAction.QUEST_SELECT) {
                    return sendQuestDialog(env, 4762);
                }
                else {
                    return sendQuestStartDialog(env);
                }
            }
        }
        else if (qs.getStatus() == QuestStatus.START) {
            if (targetId == 802008) {
                if (dialog == DialogAction.QUEST_SELECT)
                       return sendQuestDialog(env, 1011);

                if (dialog == DialogAction.SETPRO1)
                {
                            changeQuestStep(env, 0, 1, true);
                            updateQuestStatus(env);
                         return closeDialogWindow(env);
                   }
                }
        }
        else if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 801037) {
                return sendQuestEndDialog(env);
            }
        }
        return false;
    }
}