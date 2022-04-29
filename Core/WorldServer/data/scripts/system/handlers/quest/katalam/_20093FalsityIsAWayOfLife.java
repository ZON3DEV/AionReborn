/**
 * This file is part of Aion-Lightning <aion-lightning.org>.
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
package quest.katalam;

import com.aionemu.gameserver.dataholders.DataManager;
import com.aionemu.gameserver.model.DialogAction;
import com.aionemu.gameserver.model.TeleportAnimation;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.SystemMessageId;
import com.aionemu.gameserver.network.aion.serverpackets.SM_PLAY_MOVIE;
import com.aionemu.gameserver.network.aion.serverpackets.SM_SYSTEM_MESSAGE;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;
import com.aionemu.gameserver.services.QuestService;
import com.aionemu.gameserver.services.instance.InstanceService;
import com.aionemu.gameserver.services.teleport.TeleportService2;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.world.WorldMapInstance;

/**
 * @author Romanz
 */
public class _20093FalsityIsAWayOfLife extends QuestHandler {

    private final static int questId = 20093;

    private final static int[] mobs = {230397, 230401, 230396};

    public _20093FalsityIsAWayOfLife() {
        super(questId);
    }

    @Override
    public void register() {
        int[] npcIds = {800835, 800839, 800846, 800847, 701558, 800848, 800529, 801328};
        qe.registerOnDie(questId);
        qe.registerOnLogOut(questId);
        qe.registerOnEnterWorld(questId);
        qe.registerOnLevelUp(questId);
        for (int npcId : npcIds) {
            qe.registerQuestNpc(npcId).addOnTalkEvent(questId);
        }
        for (int mob : mobs) {
            qe.registerQuestNpc(mob).addOnKillEvent(questId);
        }
    }

    @Override
    public boolean onLvlUpEvent(QuestEnv env) {
        return defaultOnLvlUpEvent(env, 20092);
    }

    @Override
    public boolean onDialogEvent(QuestEnv env) {
        final Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        int targetId = env.getTargetId();
        DialogAction dialog = env.getDialog();

        if (qs != null && qs.getStatus() == QuestStatus.START) {
            if (targetId == 800835) {
                switch (dialog) {
                    case QUEST_SELECT: {
                        if (qs.getQuestVarById(0) == 0) {
                            return sendQuestDialog(env, 1011);
                        }
                    }
                    case SETPRO1: {
                        WorldMapInstance newInstance = InstanceService.getNextAvailableInstance(300900000);
                        InstanceService.registerPlayerWithInstance(newInstance, player);
                        TeleportService2.teleportTo(player, 300900000, newInstance.getInstanceId(), 148.9f, 145.53f, 124.35f, (byte) 30, TeleportAnimation.BEAM_ANIMATION);
                        return defaultCloseDialog(env, 0, 1);
                    }
                }
            } else if (targetId == 800839) {
                switch (dialog) {
                    case QUEST_SELECT: {
                        if (qs.getQuestVarById(0) == 4) {
                            return sendQuestDialog(env, 1693);
                        }
                    }
                    case SETPRO3: {
                        PacketSendUtility.sendPacket(player, new SM_PLAY_MOVIE(0, 856));
                        QuestService.addNewSpawn(300900000, player.getInstanceId(), 800846, 137.46175f, 158.90384f, 120.7332f, (byte) 113);
                        return defaultCloseDialog(env, 4, 5);
                    }
                }
            } else if (targetId == 800846) {
                switch (dialog) {
                    case QUEST_SELECT: {
                        if (qs.getQuestVarById(0) == 5) {
                            return sendQuestDialog(env, 2034);
                        }
                    }
                    case SETPRO4: {
                        return defaultCloseDialog(env, 5, 6);
                    }
                }
            } else if (targetId == 701558) {
                switch (dialog) {
                    case USE_OBJECT: {
                        if (qs.getQuestVarById(0) == 6) {
                            return sendQuestDialog(env, 2375);
                        }
                        if (qs.getQuestVarById(0) == 11) {
                            return sendQuestDialog(env, 3398);
                        }
                    }
                    case SETPRO5: {
                        QuestService.addNewSpawn(300900000, player.getInstanceId(), 230401, 117.04766f, 136.02901f, 112.17429f, (byte) 0);
                        QuestService.addNewSpawn(300900000, player.getInstanceId(), 230401, 117.97054f, 144.2601f, 112.17429f, (byte) 0);
                        QuestService.addNewSpawn(300900000, player.getInstanceId(), 230401, 119.47871f, 140.32776f, 112.17429f, (byte) 0);
                        QuestService.addNewSpawn(300900000, player.getInstanceId(), 800847, 106.22953f, 141.24696f, 112.17429f, (byte) 0);
                        return defaultCloseDialog(env, 6, 7);
                    }
                    case SETPRO8: {
                        QuestService.addNewSpawn(300900000, player.getInstanceId(), 800848, 137.369f, 114.9515f, 127.71536f, (byte) 50);
                        TeleportService2.teleportTo(player, 300900000, 135.21936f, 116.472466f, 127.71536f, (byte) 50, TeleportAnimation.BEAM_ANIMATION);
                        PacketSendUtility.sendPacket(player, new SM_PLAY_MOVIE(0, 858));
                        return defaultCloseDialog(env, 11, 12);
                    }
                }
            } else if (targetId == 800847) {
                switch (dialog) {
                    case QUEST_SELECT: {
                        if (qs.getQuestVarById(0) == 10) {
                            return sendQuestDialog(env, 3057);
                        }
                    }
                    case SETPRO7: {
                        return defaultCloseDialog(env, 10, 11);
                    }
                }
            } else if (targetId == 800848) {
                switch (dialog) {
                    case QUEST_SELECT: {
                        if (qs.getQuestVarById(0) == 12) {
                            return sendQuestDialog(env, 3739);
                        }
                    }
                    case SETPRO9: {
                        TeleportService2.teleportTo(player, 600050000, 415.59286f, 423.9f, 288.5f, (byte) 10, TeleportAnimation.BEAM_ANIMATION);
                        return defaultCloseDialog(env, 12, 13);
                    }
                }
            } else if (targetId == 800529) {
                switch (dialog) {
                    case QUEST_SELECT: {
                        if (qs.getQuestVarById(0) == 13) {
                            return sendQuestDialog(env, 4080);
                        }
                    }
                    case SETPRO10: {
                        return defaultCloseDialog(env, 13, 14, true, false);
                    }
                }
            }
        } else if (qs != null && qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 801328) {
                if (dialog == DialogAction.USE_OBJECT) {
                    return sendQuestDialog(env, 5);
                } else {
                    return sendQuestEndDialog(env);
                }
            }
        }
        return false;
    }

    @Override
    public boolean onKillEvent(QuestEnv env) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (qs != null && qs.getStatus() == QuestStatus.START) {
            int var = qs.getQuestVarById(0);
            if (var >= 1 && (env.getTargetId() == 230397 || env.getTargetId() == 230396)) {
                changeQuestStep(env, var, var + 1, false);
                if (var == 4) {
                    qs.setQuestVar(4);
                    changeQuestStep(env, 3, 4, false);
                    updateQuestStatus(env);
                }
                return true;
            }
            if (var == 7 && env.getTargetId() == 230401) {
                changeQuestStep(env, var, var + 1, false);
                if (var == 8) {
                    qs.setQuestVar(8);
                    changeQuestStep(env, 7, 8, false);
                    updateQuestStatus(env);
                }
                return true;
            }
            if (var == 8 && env.getTargetId() == 230401) {
                changeQuestStep(env, var, var + 1, false);
                if (var == 9) {
                    qs.setQuestVar(9);
                    changeQuestStep(env, 8, 9, false);
                    updateQuestStatus(env);
                }
                return true;
            }
            if (var == 9 && env.getTargetId() == 230401) {
                changeQuestStep(env, var, var + 1, false);
                if (var == 10) {
                    qs.setQuestVar(10);
                    changeQuestStep(env, 9, 10, false);
                    updateQuestStatus(env);
                }
                return true;
            }
        }
        return false;
    }

    @Override
    public boolean onAtDistanceEvent(QuestEnv env) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (qs != null && qs.getStatus() == QuestStatus.START) {
            if (qs.getQuestVarById(0) == 5) {
                changeQuestStep(env, 5, 6, false);
                return true;
            }
        }
        return false;
    }

    @Override
    public boolean onEnterWorldEvent(QuestEnv env) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (qs != null && qs.getStatus() == QuestStatus.START) {
            int var = qs.getQuestVarById(0);
            if (player.getWorldId() == 300900000) {
                if (var == 1) {
                    QuestService.addNewSpawn(300900000, player.getInstanceId(), 800839, 150.91753f, 145.64671f, 125.15871f, (byte) 43);
                    return true;
                }
            }
        }
        return false;
    }

    @Override
    public boolean onDieEvent(QuestEnv env) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (qs != null && qs.getStatus() == QuestStatus.START) {
            int var = qs.getQuestVarById(0);
            if (var >= 1) {
                qs.setQuestVar(0);
                updateQuestStatus(env);
                PacketSendUtility.sendPacket(player, new SM_SYSTEM_MESSAGE(SystemMessageId.QUEST_FAILED_$1, DataManager.QUEST_DATA.getQuestById(questId).getName()));
                return true;
            }
        }
        return false;
    }

    @Override
    public boolean onLogOutEvent(QuestEnv env) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (qs != null && qs.getStatus() == QuestStatus.START) {
            int var = qs.getQuestVarById(0);
            if (var >= 1) {
                qs.setQuestVar(0);
                updateQuestStatus(env);
                return true;
            }
        }
        return false;
    }
}