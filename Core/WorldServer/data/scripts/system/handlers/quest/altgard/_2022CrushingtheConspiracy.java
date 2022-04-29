/*
 * This file is part of Aion-Lightning.
 *
 *  Aion-Lightning is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Aion-Lightning is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details. *
 *  You should have received a copy of the GNU General Public License
 *  along with Aion-Lightning.
 *  If not, see <http://www.gnu.org/licenses/>.
 */
package quest.altgard;

import com.aionemu.gameserver.model.DialogAction;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;
import com.aionemu.gameserver.services.QuestService;
import com.aionemu.gameserver.services.teleport.TeleportService2;

/**
 * @author HGabor85
 * @reworked vlog, apozema
 * @modified Gigi
 * @Reworked G-Robson26
 */
public class _2022CrushingtheConspiracy extends QuestHandler {

	private final static int questId = 2022;
	private final static int[] npcs = {203557, 700140, 700141};

	public _2022CrushingtheConspiracy() {
		super(questId);
	}

	@Override
	public void register() {
		qe.registerOnEnterZoneMissionEnd(questId);
		qe.registerOnLevelUp(questId);
		qe.registerOnDie(questId);
		qe.registerOnEnterWorld(questId);
		for (int npc : npcs) {
			qe.registerQuestNpc(npc).addOnTalkEvent(questId);
		}
		qe.registerQuestNpc(214103).addOnKillEvent(questId);
		qe.registerOnMovieEndQuest(154, questId);
	}

	@Override
	public boolean onDialogEvent(QuestEnv env) {
		Player player = env.getPlayer();
		int targetId = env.getTargetId();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		if (qs == null) {
			return false;
		}
		int var = qs.getQuestVarById(0);

		if (qs.getStatus() == QuestStatus.START) {
			switch (targetId) {
				case 203557: { // Suthran
					if (env.getDialog() == DialogAction.QUEST_SELECT && var == 0) {
						return sendQuestDialog(env, 1011);
					} else if (env.getDialog() == DialogAction.SETPRO1) {
						TeleportService2.teleportTo(player, 220030000, 2462.5815f, 2550.077f, 316.12088f);
						changeQuestStep(env, 0, 1, false);
						return closeDialogWindow(env);
					} else if (env.getDialogId() == DialogAction.SELECT_ACTION_1013.id()) {
						playQuestMovie(env, 66);
						return sendQuestDialog(env, 1013);
					}
					break;
				}
				case 700140: { // Abyss Gate Guardian Stone
					if (var == 2) {
						if (env.getDialog() == DialogAction.USE_OBJECT) {
							QuestService.addNewSpawn(320030000, player.getInstanceId(), 214103, (float) 258.96942, (float) 239.16132, (float) 217.90526, (byte) 94);
							return useQuestObject(env, 2, 3, false, false);
						}
					}
				}
				case 700141: { // Abyss Gate
					if (var == 4) {
						if (env.getDialog() == DialogAction.USE_OBJECT) {
							changeQuestStep(env, 4, 4, true);
							return playQuestMovie(env, 154);
						}
					}
				}
			}
		} else if (qs.getStatus() == QuestStatus.REWARD) {
			if (targetId == 203557) { // Suthran
				if (env.getDialog() == DialogAction.USE_OBJECT) {
					return sendQuestDialog(env, 1352);
				} else {
					return sendQuestEndDialog(env);
				}
			}
		}
		return false;
	}

	@Override
	public boolean onEnterWorldEvent(QuestEnv env) {
		Player player = env.getPlayer();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		if (qs == null) {
			return false;
		}
		if (qs.getStatus() == QuestStatus.START) {
			int var = qs.getQuestVars().getQuestVars();
			if (var == 1 && player.getWorldId() == 320030000) {
				changeQuestStep(env, 1, 2, false);
				return true;
			}
		}
		return false;
	}

	@Override
	public boolean onKillEvent(QuestEnv env) {
		return defaultOnKillEvent(env, 214103, 3, 4);
	}

	@Override
	public boolean onDieEvent(QuestEnv env) {
		Player player = env.getPlayer();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		if (qs != null && qs.getStatus() == QuestStatus.START) {
			int var = qs.getQuestVars().getQuestVars();
			if (var == 2) {
				changeQuestStep(env, 2, 1, false);
				return true;
			}
		}
		return false;
	}

	@Override
	public boolean onMovieEndEvent(QuestEnv env, int movieId) {
		if (movieId == 154) {
			TeleportService2.teleportTo(env.getPlayer(), 220030000, 1664.7611f, 1749.524f, 260.10562f);
			return true;
		}
		return false;
	}

	@Override
	public boolean onZoneMissionEndEvent(QuestEnv env) {
		return defaultOnZoneMissionEndEvent(env);
	}

	@Override
	public boolean onLvlUpEvent(QuestEnv env) {
		return defaultOnLvlUpEvent(env, 2200, true);
	}
}