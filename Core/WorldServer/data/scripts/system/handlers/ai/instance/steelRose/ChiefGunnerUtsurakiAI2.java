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
package ai.instance.steelRose;

import ai.AggressiveNpcAI2;
import com.aionemu.gameserver.ai2.AIName;
import com.aionemu.gameserver.model.actions.PlayerActions;
import com.aionemu.gameserver.model.gameobjects.Creature;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.utils.ThreadPoolManager;
import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.Future;
import java.util.concurrent.atomic.AtomicBoolean;

/**
 * @author DeathMagnestic
 */
@AIName("gunnerutsuraki")
public class ChiefGunnerUtsurakiAI2 extends AggressiveNpcAI2 {

    private AtomicBoolean isStartedEvent = new AtomicBoolean(false);
    private Future<?> phaseTask;

    @Override
    protected void handleAttack(Creature creature) {
        super.handleAttack(creature);
        checkPercentage(getLifeStats().getHpPercentage());
    }

    private void checkPercentage(int hpPercentage) {
        if (hpPercentage <= 75) {
            if (isStartedEvent.compareAndSet(false, true)) {
                startPhaseTask();
            }
        }
    }

    private void startPhaseTask() {
        phaseTask = ThreadPoolManager.getInstance().scheduleAtFixedRate(new Runnable() {
            @Override
            public void run() {
                if (isAlreadyDead()) {
                    cancelPhaseTask();
                } else {
                    List<Player> players = getLifedPlayers();
                    if (!players.isEmpty()) {
                        int size = players.size();
                        if (players.size() < 7) {
                            for (Player p : players) {
                                spawnBomb(p);
                            }
                        }
                    }
                }
            }

        }, 3000, 15000);
    }

    private void spawnBomb(Player player) {
        final float x = player.getX();
        final float y = player.getY();
        final float z = player.getZ();
        if (x > 0 && y > 0 && z > 0) {
            ThreadPoolManager.getInstance().schedule(new Runnable() {
                @Override
                public void run() {
                    if (!isAlreadyDead()) {
                        spawn(231018, x, y, z, (byte) 0);
                    }
                }
            }, 3000);
        }
    }

    private List<Player> getLifedPlayers() {
        List<Player> players = new ArrayList<Player>();
        for (Player player : getKnownList().getKnownPlayers().values()) {
            if (!PlayerActions.isAlreadyDead(player)) {
                players.add(player);
            }
        }
        return players;
    }

    private void cancelPhaseTask() {
        if (phaseTask != null && !phaseTask.isDone()) {
            phaseTask.cancel(true);
        }
    }

    @Override
    protected void handleBackHome() {
        cancelPhaseTask();
        isStartedEvent.set(false);
        super.handleBackHome();
    }
}