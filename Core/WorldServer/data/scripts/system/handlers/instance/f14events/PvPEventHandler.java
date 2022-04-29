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
 *
 *  You should have received a copy of the GNU General Public License
 *  along with Aion-Lightning.
 *  If not, see <http://www.gnu.org/licenses/>.
 */
package system.handlers.instance.f14events;

import com.aionemu.commons.utils.Rnd;
import com.aionemu.gameserver.eventEngine.eventmanager.announcer.Balalaka;
import com.aionemu.gameserver.eventEngine.eventmanager.events.EventRewardHelper;
import com.aionemu.gameserver.eventEngine.eventmanager.events.EventScore;
import com.aionemu.gameserver.eventEngine.eventmanager.events.enums.EventType;
import com.aionemu.gameserver.eventEngine.eventmanager.events.xml.EventStartPosition;
import com.aionemu.gameserver.instance.handlers.EventID;
import com.aionemu.gameserver.model.TeleportAnimation;
import com.aionemu.gameserver.model.gameobjects.Creature;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.stats.container.PlayerLifeStats;
import com.aionemu.gameserver.network.aion.serverpackets.SM_SYSTEM_MESSAGE;
import com.aionemu.gameserver.services.player.PlayerReviveService;
import com.aionemu.gameserver.services.teleport.TeleportService2;
import com.aionemu.gameserver.skillengine.SkillEngine;
import com.aionemu.gameserver.skillengine.model.SkillTargetSlot;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.utils.ThreadPoolManager;
import com.aionemu.gameserver.world.WorldMapInstance;
import java.util.concurrent.ScheduledFuture;

/**
 * Ивент - Один на Один
 *
 * @author flashman
 */
@EventID(eventId = 1)
public class PvPEventHandler extends BaseEventHandler {

    private ScheduledFuture endRoundTask;
    private ScheduledFuture nextRoundTask;
    private boolean isDraw = false;

    private int delayBeforStartNextRound = 2;

    @Override
    public void onInstanceCreate(WorldMapInstance instance) {
        round = 1;
        winNeeded = 3;
        waitingTime = 10;
        battle_time = 300;
        super.onInstanceCreate(instance);
     // for (Npc npc : this.instance.getNpcs()) {
     // npc.getController().onDelete();
     // }
    }

    @Override
    public void onInstanceDestroy() {
        if (this.endRoundTask != null) {
            this.endRoundTask.cancel(true);
            this.endRoundTask = null;
        }
        if (this.nextRoundTask != null) {
            this.nextRoundTask.cancel(true);
            this.nextRoundTask = null;
        }
        this.players = null;
        this.score = null;
    }

    @Override
    public void onEnterInstance(Player player) {
        super.onEnterInstance(player);
        if (instance.isRegistered(player.getObjectId()) && !this.containsPlayer(player.getObjectId())) {
            players.add(player);
        } else {
            return;
        }
        ThreadPoolManager.getInstance().schedule(new Runnable() {
            @Override
            public void run() {
                StartRoundTask();
            }
        }, waitingTime * 1000);
        //  AddProtection(player, waitingTime * 1000);
        SkillEngine.getInstance().applyEffectDirectly(18191, player, player, 10000);
        SkillEngine.getInstance().applyEffectDirectly(10380, player, player, 10000);
        this.HealPlayer(player);
        this.sendSpecMessage("EventManager", "Before the start of the 1st round: " + this.waitingTime + " sec.");
        if (!this.containsInScoreList(player.getObjectId())) {
            this.addToScoreList(player);
        }
    }

    @Override
    public boolean isEnemy(Player attacker, Player target) {
        if (attacker != target) {
            return true;
        }
        return super.isEnemy(attacker, target);
    }

    @Override
    public void onPlayerLogOut(Player player) {
        super.onPlayerLogOut(player);
        if (!eventIsComplete) {
            this.removeFromScoreList(player.getObjectId());
            this.ifOnePlayer();
        }
    }

    @Override
    public void onLeaveInstance(Player player) {
        super.onLeaveInstance(player);
        if (!eventIsComplete) {
            this.removeFromScoreList(player.getObjectId());
            this.ifOnePlayer();
        }
    }

    @Override
    public boolean onDie(Player player, Creature lastAttacker) {
        //if (CustomConfig.NEW_PVP_MODE) {
        //     super.onDie(player, lastAttacker);
        // }
        this.deathPlayer(player, lastAttacker);
        return true;
    }

    @Override
    public boolean onReviveEvent(Player player) {
        PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_REBIRTH_MASSAGE_ME);
        PlayerReviveService.revive(player, 100, 100, false, 0);
        player.getGameStats().updateStatsAndSpeedVisually();
        return true;
    }

    private synchronized void StartRoundTask() {
        if (endRoundTask == null) {
            for (Player p : this.players) {
                // RemoveProtection(p);
                this.HealPlayer(p, false, true);
            }

            if (this.ifOnePlayer()) {
                return;
            }
            endRoundTask = ThreadPoolManager.getInstance().schedule(new Runnable() {
                @Override
                public void run() {
                    NextRound(true);
                }
            }, battle_time * 1000);
            sendSpecMessage("EventManager", "Round: " + round + " - go");
            this.startTimer(this.battle_time);
        }
    }

    private void NextRound(boolean timeIsUp) {
        if (players == null || players.isEmpty()) {
            return;
        }
        if (this.endRoundTask != null) {
            endRoundTask.cancel(true);
            endRoundTask = null;
        }
        round++;

        if (this.ifOnePlayer()) {
            return;
        }

        if (timeIsUp) {
            Player winner = this.timeIsUpEvent();
            if (winner != null) {
                this.getScore(winner.getObjectId()).Wins++;
                if (hasWinner()) {
                    sendSpecMessage("EventManager", "Event completed");
                    DoReward();
                    return;
                } else {
                    this.moveToStartPosition();
                    this.sendSpecMessage("EventManager", "The time of the round is over: " + winner.getName());
                }
            } else {
                this.DoReward();
                return;
            }
        }

        ThreadPoolManager.getInstance().schedule(new Runnable() {
            @Override
            public void run() {
                StartRoundTask();
            }
        }, this.delayBeforStartNextRound * 1000);
    }

    protected void deathPlayer(Player victim, Creature lastAttacker) {
        if (lastAttacker.getActingCreature() instanceof Player && victim != lastAttacker) {
            Player winner = (Player) lastAttacker.getActingCreature();
            EventScore winnerScore = this.getScore(winner.getObjectId());
            EventScore loserScore = this.getScore(victim.getObjectId());
            winnerScore.Kills++;
            winnerScore.Wins++;
            loserScore.Death++;
            loserScore.Loses++;

            PacketSendUtility.sendPacket(winner, new SM_SYSTEM_MESSAGE(1360001, victim.getName()));

            if (this.endRoundTask != null) {
                this.endRoundTask.cancel(true);
                this.endRoundTask = null;
            }

            this.HealPlayer(victim, false, true);
            this.HealPlayer(winner, false, true);
            winner.setTarget(null);
            victim.setTarget(null);

            moveToStartPosition();
            victim.getEffectController().removeAbnormalEffectsByTargetSlot(SkillTargetSlot.DEBUFF);
            winner.getEffectController().removeAbnormalEffectsByTargetSlot(SkillTargetSlot.DEBUFF);
            SkillEngine.getInstance().applyEffectDirectly(18191, victim, victim, 10000);
            SkillEngine.getInstance().applyEffectDirectly(10380, victim, victim, 10000);
            SkillEngine.getInstance().applyEffectDirectly(18191, winner, winner, 10000);
            SkillEngine.getInstance().applyEffectDirectly(10380, winner, winner, 10000);
            /* AddProtection(victim, waitingTime * 1000, 1000);
             AddProtection(winner, waitingTime * 1000, 1000);*/

            this.stopTimer();

            this.sendSpecMessage("EventManager", "Round: " + round + " completed, winner: " + winner.getName());

            ThreadPoolManager.getInstance().schedule(new Runnable() {
                @Override
                public void run() {
                    if (hasWinner()) {
                        sendSpecMessage("EventManager", "I went completed");
                        DoReward();
                        return;
                    }

                    if (nextRoundTask != null) {
                        nextRoundTask.cancel(true);
                        nextRoundTask = null;
                    }
                    for (Player p : players) {
                        HealPlayer(p, false, true);
                    }
                    nextRoundTask = ThreadPoolManager.getInstance().schedule(new Runnable() {
                        @Override
                        public void run() {
                            NextRound(false);
                        }
                    }, 4000);
                }
            }, 5000);
        }
    }

    private void DoReward() {
        if (!eventIsComplete) {
            eventIsComplete = true;
            if (!isDraw) {
                int rank;
                Object[] names = {"", ""};
                for (final Player player : this.players) {
                    EventScore es = this.getScore(player.getObjectId());
                    if (es.isWinner) {
                        rank = 1;
                    } else {
                        rank = 2;
                    }
                    this.sendSpecMessage("EventManager", String.format("You occupied %s a place", rank), player);
                    EventRewardHelper.GiveRewardFor(player, EventType.E_1x1, es, rank);
                    moveToEntry(player);
                    switch (rank) {
                        case 1:
                            names[0] = player.getName();
                            break;
                        case 2:
                            names[1] = player.getName();
                            break;
                    }
                    this.stopTimer(player);
                }
                Balalaka.sayInWorldOrangeTextCenter("EventManager", String.format("I went: PvP completed, won(а): %s, lost(а): %s", names));
            } else {
                for (Player player : this.players) {
                    moveToEntry(player);
                    this.stopTimer(player);
                    EventRewardHelper.GiveRewardFor(player, EventType.E_1x1, this.getScore(player.getObjectId()), 2);
                }
                Balalaka.sayInWorldOrangeTextCenter("EventManager", String.format("I went: PvP completed, draw"));
            }

            this.players.clear();
            if (this.prestartTasks != null) {
                for (ScheduledFuture sf : this.prestartTasks.values()) {
                    sf.cancel(true);
                }
                this.prestartTasks.clear();
            }
            if (this.endRoundTask != null) {
                this.endRoundTask.cancel(true);
            }
            this.prestartTasks = null;
            this.endRoundTask = null;
        }
    }

    private void moveToStartPosition() {
        int i = 0;
        for (Player p : this.players) {
            EventStartPosition point = EventType.E_1x1.getEventTemplate().getStartPositionInfo().getPositions().get(i);
            TeleportService2.teleportTo(p, this.mapId, this.instanceId, point.getX(), point.getY(), point.getZ(), (byte) 0, TeleportAnimation.BEAM_ANIMATION);
            i += 1;
        }
    }

    private boolean hasWinner() {
        for (EventScore es : this.score) {
            if (es.Wins >= winNeeded) {
                es.isWinner = true;
                return true;
            }
        }
        return false;
    }

    private boolean ifOnePlayer() {
        if (this.players.size() == 1) {
            EventScore es = this.score.get(0);
            es.Wins = this.winNeeded;
            es.Loses = 0;
            es.isWinner = true;
            DoReward();
            return true;
        }
        return false;
    }

    private Player timeIsUpEvent() {
        if (players.size() == 2) {
            Player winner;
            PlayerLifeStats pls1 = players.get(0).getLifeStats();
            PlayerLifeStats pls2 = players.get(1).getLifeStats();
            if (pls1.getCurrentHp() > pls2.getCurrentHp()) {
                winner = players.get(0);
            } else if (pls1.getCurrentHp() < pls2.getCurrentHp()) {
                winner = players.get(1);
            } else {
                if (pls1.getMaxHp() > pls2.getMaxHp()) {
                    winner = players.get(0);
                } else if (pls1.getMaxHp() < pls2.getMaxHp()) {
                    winner = players.get(1);
                } else {
                    winner = players.get(Rnd.get(0, players.size() - 1));
                }
            }
            return winner;
        }
        return null;
    }
}