/*
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
package quest.rentus_base;

import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.model.DialogAction;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;

/**
 * @author Ritsu
 *
 */
public class _30553ComradesInArms extends QuestHandler
{
	private final static int questId=30553;
	public _30553ComradesInArms()
	{
		super(questId);
	}
	@Override
	public void register()
	{
		qe.registerQuestNpc(205438).addOnQuestStart(questId); //Lition
		qe.registerQuestNpc(205438).addOnTalkEvent(questId);
		qe.registerQuestNpc(701097).addOnTalkEvent(questId); 
		qe.registerQuestNpc(799541).addOnTalkEvent(questId); //rodelion

	}
	@Override
	public boolean onDialogEvent(QuestEnv env)
	{
		Player player=env.getPlayer();
		QuestState qs=player.getQuestStateList().getQuestState(questId);
		int targetId=env.getTargetId();
		DialogAction dialog=env.getDialog();
		if(qs==null || qs.getStatus() ==QuestStatus.NONE || qs.canRepeat())
		{
			switch(targetId)
			{
				case 205438:
				{
					switch(dialog)
					{
						case QUEST_SELECT:
							return sendQuestDialog(env,4762);
						default:
							return sendQuestStartDialog(env);
					}
				}
			}
		}
		else if(qs.getStatus() ==QuestStatus.START)
		{

			switch(targetId)
			{
				case 205438:
				{
					switch(dialog)
					{
						case SELECT_QUEST_REWARD:
							return defaultCloseDialog(env, 1, 1, true, true);
					}
				}
				case 701097:
				{
					Npc npc = (Npc) env.getVisibleObject();
					npc.getController().onDelete();
					return true;
				}
				case 799541:
				{
					switch(dialog)
					{
						case QUEST_SELECT:
							return sendQuestDialog(env,1011);
						case SET_SUCCEED:
						{
							return defaultCloseDialog(env, 0, 1, true, false);//reward
						}
					}
				}
			}
		}
		else if(qs.getStatus() == QuestStatus.REWARD)
		{
			switch(targetId)
			{
				case 205438:
				{

					return sendQuestEndDialog(env);

				}
			}
		}
		return false;
	}
}