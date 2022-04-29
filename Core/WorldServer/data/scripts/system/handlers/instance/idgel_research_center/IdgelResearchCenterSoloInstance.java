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
package instance.idgel_research_center;

import com.aionemu.commons.utils.Rnd;
import com.aionemu.gameserver.instance.handlers.GeneralInstanceHandler;
import com.aionemu.gameserver.instance.handlers.InstanceID;
import com.aionemu.gameserver.model.DescriptionId;
import com.aionemu.gameserver.model.EmotionType;
import com.aionemu.gameserver.model.gameobjects.Creature;
import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.StaticDoor;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.instance.InstanceScoreType;
import com.aionemu.gameserver.model.instance.instancereward.IdgelResearchCenterReward;
import com.aionemu.gameserver.model.instance.playerreward.IdgelPlayerReward;
import com.aionemu.gameserver.model.instance.playerreward.InstancePlayerReward;
import com.aionemu.gameserver.network.aion.serverpackets.SM_DIE;
import com.aionemu.gameserver.network.aion.serverpackets.SM_EMOTION;
import com.aionemu.gameserver.network.aion.serverpackets.SM_INSTANCE_SCORE;
import com.aionemu.gameserver.network.aion.serverpackets.SM_SYSTEM_MESSAGE;
import com.aionemu.gameserver.services.abyss.AbyssPointsService;
import com.aionemu.gameserver.services.item.ItemService;
import com.aionemu.gameserver.services.player.PlayerReviveService;
import com.aionemu.gameserver.services.teleport.TeleportService2;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.utils.ThreadPoolManager;
import com.aionemu.gameserver.world.WorldMapInstance;
import com.aionemu.gameserver.world.knownlist.Visitor;

import java.util.List;
import java.util.Map;
import java.util.concurrent.Future;

/**
 * @author Brera,Eloann
 */
@InstanceID(300530000)
public class IdgelResearchCenterSoloInstance extends GeneralInstanceHandler {

    private long startTime;
    private Future<?> instanceTimer;
    private boolean isInstanceDestroyed;
    private Map<Integer, StaticDoor> doors;
    private IdgelResearchCenterReward instanceReward;

    protected IdgelPlayerReward getPlayerReward(Player player) {
        Integer object = player.getObjectId();
        if (instanceReward.getPlayerReward(object) == null) {
            addPlayerToReward(player);
        }
        return (IdgelPlayerReward) instanceReward.getPlayerReward(object);
    }

    private void addPlayerToReward(Player player) {
        instanceReward.addPlayerReward(new IdgelPlayerReward(player.getObjectId()));
    }

    @SuppressWarnings("unused")
    private boolean containPlayer(Integer object) {
        return instanceReward.containPlayer(object);
    }

    @Override
    public void onDie(Npc npc) {
        int points = 0;
        int npcId = npc.getNpcId();
        Player player = npc.getAggroList().getMostPlayerDamage();
        switch (npcId) {
            case 230119: 
                points = 20;
                break;
            case 230117: 
                points = 80;
                break;
            case 230110: 
            case 230120: 
                points = 200;
                break;
            case 230112: 
                points = 350;
                break;
            case 230106:
            case 230107: 
            case 230113: 
            case 230114: 
            case 230115: 
            case 230116: 
                points = 400;
                break;
            case 230108: 
                stopInstance(player);
                break;
            case 230111: 
                points = 500;
                break;
            case 230121: 
                points = 600;
                break;
            case 233266: 
                points = 500;
                break;
        }
        if (instanceReward.getInstanceScoreType().isStartProgress()) {
            instanceReward.addNpcKill();
            instanceReward.addPoints(points);
            sendPacket(npc.getObjectTemplate().getNameId(), points);
        }
    }

    private int getTime() {
        long result = System.currentTimeMillis() - startTime;
        if (result < 60000) {
            return (int) (60000 - result);
        } else if (result < 600000) { // 10 Minutes.
            return (int) (600000 - (result - 60000));
        }
        return 0;
    }

    private void sendPacket(final int nameId, final int point) {
        instance.doOnAllPlayers(new Visitor<Player>() {
            @Override
            public void visit(Player player) {
                if (nameId != 0) {
                    PacketSendUtility.sendPacket(player, new SM_SYSTEM_MESSAGE(1400237, new DescriptionId(nameId * 2 + 1), point));
                }
                PacketSendUtility.sendPacket(player, new SM_INSTANCE_SCORE(getTime(), instanceReward, null));
            }
        });
    }

    /**
     * Basic Ranks: Inside the "Idgel Research Center" you will score points by
     * killing monsters and finishing the instance fast, Depending on the rank
     * you acquire you will receive a compensation. A higher rank gives you a
     * package containing advance crafting materials.
     */
    private int checkRank(int totalPoints) {
        int rank = 0;
        if (totalPoints > 5000) { // S Rank.
            rank = 1;
        } else if (totalPoints > 3500) { // A Rank.
            rank = 2;
        } else if (totalPoints > 2700) { // B Rank.
            rank = 3;
        } else if (totalPoints > 2200) { // C Rank.
            rank = 4;
        } else if (totalPoints > 1600) { // D Rank.
            rank = 5;
        } else if (totalPoints > 500) { // F Rank.
            rank = 6;
        } else {
            rank = 8;
        }
        return rank;
    }

    @Override
    public void onEnterInstance(final Player player) {
        if (instanceTimer == null) {
            startTime = System.currentTimeMillis();
            instanceTimer = ThreadPoolManager.getInstance().schedule(new Runnable() {
                @Override
                public void run() {
                    openFirstDoors();
                    sendMsg(1401852); // Start of Idgel's Laboratory
                    instanceReward.setInstanceScoreType(InstanceScoreType.START_PROGRESS);
                    sendPacket(0, 0);
                }
            }, 60000);
        }
        stopInstanceAfterTime(player);
        sendPacket(0, 0);
    }

    public void stopInstanceAfterTime(final Player player) {
        instanceTimer = ThreadPoolManager.getInstance().schedule(new Runnable() {
            @Override
            public void run() {
                stopInstance(player);
                spawn(730730, 571.1385f, 444.94006f, 102.65536f, (byte) 30); // Exit from Idgel's Lab
            }
        }, 660000); // 10 Minutes
    }

    protected void stopInstance(Player player) {
        stopInstanceTask();
        instanceReward.setRank(checkRank(instanceReward.getPoints()));
        instanceReward.setInstanceScoreType(InstanceScoreType.END_PROGRESS);
        doReward(player);
        sendPacket(0, 0);
    }

    private void stopInstanceTask() {
        if (instanceTimer != null) {
            instanceTimer.cancel(true);
        }
    }

    @Override
    public void doReward(Player player) {
        for (Player p : instance.getPlayersInside()) {
            InstancePlayerReward playerReward = getPlayerReward(p);
            float rewardSillus = (0.1f * instanceReward.getPoints()) / 300;
            float rewardCeramium = (0.1f * instanceReward.getPoints()) / 500;
            float rewardAp = (playerReward.getPoints() / 5) * 2;
            if (!instanceReward.isRewarded()) {
                instanceReward.setRewarded();
                instanceReward.setScoreAP((int) rewardAp);
                AbyssPointsService.addAp(player, (int) rewardAp); // Abyss Points.
                if (instanceReward.getPoints() >= 2700) {
                    instanceReward.setSillus((int) rewardSillus);
                    ItemService.addItem(player, 186000239, (int) rewardSillus); // Sillus Fortress Emblem.
                    instanceReward.setCeramium((int) rewardCeramium);
                    ItemService.addItem(player, 186000242, (int) rewardCeramium); // Ceramium Medal.
                }
                if (instanceReward.getPoints() >= 5000) {
                    instanceReward.setFavorable(1);
                    ItemService.addItem(player, 188052543, 1);
                }
            }
        }
    }

    protected void openFirstDoors() {
        openDoor(32);
    }

    @Override
    public void handleUseItemFinish(Player player, Npc npc) {
        switch (npc.getNpcId()) {
            case 700642: // Legion Cannon.
                Npc boss = getNpc(230121); 
                boss.getEffectController().removeEffect(19406);
            break;
        }
    }

    @Override
    public void onInstanceCreate(WorldMapInstance instance) {
        super.onInstanceCreate(instance);
        instanceReward = new IdgelResearchCenterReward(mapId, instanceId);
        instanceReward.setInstanceScoreType(InstanceScoreType.PREPARING);
        doors = instance.getDoors();
        int rnd = Rnd.get(1, 8);
        switch (rnd) {
            case 1:
                spawn(230106, 667.11957f, 467.81067f, 102.64f, (byte) 60); 
                spawn(230107, 590.27264f, 502.82306f, 102.68871f, (byte) 84); 
                spawn(230108, 477.51736f, 467.72284f, 102.63731f, (byte) 119); 
                spawn(230110, 495.81985f, 513.019f, 109.685974f, (byte) 4);
                spawn(230111, 503.42288f, 435.17093f, 102.64236f, (byte) 38); 
                spawn(230112, 480.6027f, 430.0258f, 102.64236f, (byte) 6); 
                spawn(230113, 625.61334f, 432.30984f, 97.20597f, (byte) 68); 
                spawn(230116, 611.28925f, 502.32315f, 102.68871f, (byte) 65); 
                break;
            case 2:
                spawn(230107, 667.11957f, 467.81067f, 102.64f, (byte) 60); 
                spawn(230108, 590.27264f, 502.82306f, 102.68871f, (byte) 84); 
                spawn(230110, 477.51736f, 467.72284f, 102.63731f, (byte) 119); 
                spawn(230111, 495.81985f, 513.019f, 109.685974f, (byte) 4); 
                spawn(230112, 503.42288f, 435.17093f, 102.64236f, (byte) 38);
                spawn(230113, 480.6027f, 430.0258f, 102.64236f, (byte) 6);
                spawn(230116, 625.61334f, 432.30984f, 97.20597f, (byte) 68); 
                spawn(230106, 611.28925f, 502.32315f, 102.68871f, (byte) 65); 
                break;
            case 3:
                spawn(230108, 667.11957f, 467.81067f, 102.64f, (byte) 60); 
                spawn(230110, 590.27264f, 502.82306f, 102.68871f, (byte) 84); 
                spawn(230111, 477.51736f, 467.72284f, 102.63731f, (byte) 119); 
                spawn(230112, 495.81985f, 513.019f, 109.685974f, (byte) 4); 
                spawn(230113, 503.42288f, 435.17093f, 102.64236f, (byte) 38); 
                spawn(230116, 480.6027f, 430.0258f, 102.64236f, (byte) 6); 
                spawn(230106, 625.61334f, 432.30984f, 97.20597f, (byte) 68); 
                spawn(230107, 611.28925f, 502.32315f, 102.68871f, (byte) 65); 
                break;
            case 4:
                spawn(230110, 667.11957f, 467.81067f, 102.64f, (byte) 60); 
                spawn(230111, 590.27264f, 502.82306f, 102.68871f, (byte) 84);
                spawn(230112, 477.51736f, 467.72284f, 102.63731f, (byte) 119); 
                spawn(230113, 495.81985f, 513.019f, 109.685974f, (byte) 4); 
                spawn(230116, 503.42288f, 435.17093f, 102.64236f, (byte) 38); 
                spawn(230106, 480.6027f, 430.0258f, 102.64236f, (byte) 6); 
                spawn(230107, 625.61334f, 432.30984f, 97.20597f, (byte) 68); 
                spawn(230108, 611.28925f, 502.32315f, 102.68871f, (byte) 65); 
                break;
            case 5:
                spawn(230111, 667.11957f, 467.81067f, 102.64f, (byte) 60); 
                spawn(230112, 590.27264f, 502.82306f, 102.68871f, (byte) 84); 
                spawn(230113, 477.51736f, 467.72284f, 102.63731f, (byte) 119); 
                spawn(230116, 495.81985f, 513.019f, 109.685974f, (byte) 4); 
                spawn(230106, 503.42288f, 435.17093f, 102.64236f, (byte) 38); 
                spawn(230107, 480.6027f, 430.0258f, 102.64236f, (byte) 6); 
                spawn(230108, 625.61334f, 432.30984f, 97.20597f, (byte) 68); 
                spawn(230110, 611.28925f, 502.32315f, 102.68871f, (byte) 65); 
                break;
            case 6:
                spawn(230112, 667.11957f, 467.81067f, 102.64f, (byte) 60); 
                spawn(230113, 590.27264f, 502.82306f, 102.68871f, (byte) 84);
                spawn(230116, 477.51736f, 467.72284f, 102.63731f, (byte) 119); 
                spawn(230106, 495.81985f, 513.019f, 109.685974f, (byte) 4); 
                spawn(230107, 503.42288f, 435.17093f, 102.64236f, (byte) 38); 
                spawn(230108, 480.6027f, 430.0258f, 102.64236f, (byte) 6); 
                spawn(230110, 625.61334f, 432.30984f, 97.20597f, (byte) 68); 
                spawn(230111, 611.28925f, 502.32315f, 102.68871f, (byte) 65);
                break;
            case 7:
                spawn(230113, 667.11957f, 467.81067f, 102.64f, (byte) 60); 
                spawn(230116, 590.27264f, 502.82306f, 102.68871f, (byte) 84); 
                spawn(230106, 477.51736f, 467.72284f, 102.63731f, (byte) 119); 
                spawn(230107, 495.81985f, 513.019f, 109.685974f, (byte) 4); 
                spawn(230108, 503.42288f, 435.17093f, 102.64236f, (byte) 38); 
                spawn(230110, 480.6027f, 430.0258f, 102.64236f, (byte) 6); 
                spawn(230111, 625.61334f, 432.30984f, 97.20597f, (byte) 68); 
                spawn(230112, 611.28925f, 502.32315f, 102.68871f, (byte) 65);
                break;
            case 8:
                spawn(230116, 667.11957f, 467.81067f, 102.64f, (byte) 60); 
                spawn(230106, 590.27264f, 502.82306f, 102.68871f, (byte) 84); 
                spawn(230107, 477.51736f, 467.72284f, 102.63731f, (byte) 119); 
                spawn(230108, 495.81985f, 513.019f, 109.685974f, (byte) 4);
                spawn(230110, 503.42288f, 435.17093f, 102.64236f, (byte) 38); 
                spawn(230111, 480.6027f, 430.0258f, 102.64236f, (byte) 6); 
                spawn(230112, 625.61334f, 432.30984f, 97.20597f, (byte) 68); 
                spawn(230113, 611.28925f, 502.32315f, 102.68871f, (byte) 65); 
                break;
        }
    }

    protected List<Npc> getNpcs(int npcId) {
        if (!isInstanceDestroyed) {
            return instance.getNpcs(npcId);
        }
        return null;
    }

    private void despawnNpc(Npc npc) {
        if (npc != null) {
            npc.getController().onDelete();
        }
    }

    @Override
    public void onInstanceDestroy() {
        isInstanceDestroyed = true;
        instanceReward.clear();
    }

    protected void openDoor(int doorId) {
        StaticDoor door = doors.get(doorId);
        if (door != null) {
            door.setOpen(true);
        }
    }

    @Override
    public void onExitInstance(Player player) {
        if (instanceReward.getInstanceScoreType().isEndProgress()) {
            TeleportService2.moveToInstanceExit(player, mapId, player.getRace());
        }
    }

    @Override
    public void onPlayerLogOut(Player player) {
        TeleportService2.moveToInstanceExit(player, mapId, player.getRace());
    }

    @Override
    public boolean onReviveEvent(Player player) {
        PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_REBIRTH_MASSAGE_ME);
        PlayerReviveService.revive(player, 100, 100, false, 0);
        player.getGameStats().updateStatsAndSpeedVisually();
        return TeleportService2.teleportTo(player, mapId, instanceId, 558f, 511f, 102f, (byte) 0);
    }

    @Override
    public boolean onDie(final Player player, Creature lastAttacker) {
        PacketSendUtility.broadcastPacket(player, new SM_EMOTION(player, EmotionType.DIE, 0, player.equals(lastAttacker) ? 0 : lastAttacker.getObjectId()), true);
        PacketSendUtility.sendPacket(player, new SM_DIE(player.haveSelfRezEffect(), player.haveSelfRezItem(), 0, 8));
        return true;
    }
}