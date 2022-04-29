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
 * @author Leunam
 */
public class _28035TreacherousBeritra extends QuestHandler 
{

	private final static int questId = 28035;

	public _28035TreacherousBeritra() 
	{
		super(questId);
	}

	@Override
	public void register() 
	{
		qe.registerQuestItem(182213484, questId);
		qe.registerQuestNpc(801047).addOnTalkEvent(questId);
		qe.registerQuestNpc(800529).addOnTalkEvent(questId);
	}

	@Override
	public boolean onDialogEvent(QuestEnv env) 
	{
		Player player = env.getPlayer();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		DialogAction dialog = env.getDialog();
		int targetId = env.getTargetId();

		if (qs == null || qs.getStatus() == QuestStatus.NONE) 
		{
			if (targetId == 0) 
			{ 
				switch (env.getDialog()) 
				{
					case QUEST_ACCEPT_SIMPLE:
						QuestService.startQuest(env);
						return sendQuestStartDialog(env);
				}
			}
		}
		else if (qs != null && qs.getStatus() == QuestStatus.START) 
		{
			switch (targetId) 
			{
				case 801047: 
				{
					switch (env.getDialog())
					{
						case QUEST_SELECT: 
						{
							return sendQuestDialog(env, 1352);
						}
						case SELECT_ACTION_1353: 
						{
							return sendQuestDialog(env, 1353);
						}
						case SETPRO1: 
						{
							return defaultCloseDialog(env, 0, 1);
						}
						case FINISH_DIALOG: 
						{
							return sendQuestSelectionDialog(env);
						}
					}
				}
				case 800529: 
				{
					switch (env.getDialog()) 
					{
						case QUEST_SELECT: 
						{
							return sendQuestDialog(env, 2375);
						}
						case SELECT_QUEST_REWARD: 
						{
							removeQuestItem(env, 182213484, 1);
							changeQuestStep(env, 1, 1, true);
							return sendQuestDialog(env, 5);
						}
					}

				}
			}
		}
		else if (qs.getStatus() == QuestStatus.REWARD) 
		{
			if (targetId == 800529) 
			{ 
				return sendQuestEndDialog(env);
			}
		}
		return false;
	}

	@Override
	public HandlerResult onItemUseEvent(QuestEnv env, Item item) 
	{
		Player player = env.getPlayer();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		if (qs == null || qs.getStatus() == QuestStatus.NONE) 
		{
				return HandlerResult.fromBoolean(sendQuestDialog(env, 1011));
		}
		return HandlerResult.FAILED;
	}
}