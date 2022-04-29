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
package ai.instance.SauroSupplyBase;

import ai.AggressiveNpcAI2;
import com.aionemu.commons.network.util.ThreadPoolManager;
import com.aionemu.commons.utils.Rnd;
import com.aionemu.gameserver.ai2.AIName;
import com.aionemu.gameserver.model.actions.PlayerActions;
import com.aionemu.gameserver.model.gameobjects.Creature;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.skillengine.SkillEngine;
import com.aionemu.gameserver.utils.MathUtil;
import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.concurrent.Future;
import java.util.concurrent.atomic.AtomicBoolean;

/**
 * @author DeathMagnestic
 */
@AIName("rohuka")
public class CaptainRohukaAI2 extends AggressiveNpcAI2 {

    private AtomicBoolean isHome = new AtomicBoolean(true);
    protected List<Integer> percents = new ArrayList<Integer>();
    private Future<?> skillTask;
    private Future<?> skillTask1;

    @Override
    protected void handleAttack(Creature creature) {
        super.handleAttack(creature);
        if (isHome.compareAndSet(true, false)) {
            startSkillTask1();
        }
        checkPercentage(getLifeStats().getHpPercentage());
    }

    private void startSkillTask() {
        skillTask = ThreadPoolManager.getInstance().scheduleAtFixedRate(new Runnable() {
            @Override
            public void run() {
                poison();
            }
        }, 5000, 30000);
    }

    private void cancelTask() {
        if (skillTask != null && !skillTask.isCancelled()) {
            skillTask.cancel(true);
        }
    }

    private void poison() {
        SkillEngine.getInstance().getSkill(getOwner(), 18158, 55, getOwner()).useNoAnimationSkill();
        ThreadPoolManager.getInstance().schedule(new Runnable() {
            @Override
            public void run() {
                SkillEngine.getInstance().getSkill(getOwner(), 18160, 55, getOwner()).useNoAnimationSkill();
            }
        }, 4000);
    }

    private void getRandomTarget() {
        List<Player> players = new ArrayList<Player>();
        for (Player player : getKnownList().getKnownPlayers().values()) {
            if (!PlayerActions.isAlreadyDead(player) && MathUtil.isIn3dRange(player, getOwner(), 23)) {
                players.add(player);
            }
        }
        if (players.isEmpty()) {
            return;
        }
        getAggroList().clear();
        getAggroList().startHate(players.get(Rnd.get(0, players.size() - 1)));
    }

    private void skill1() {
        SkillEngine.getInstance().getSkill(getOwner(), 20427, 55, getOwner()).useNoAnimationSkill();
    }

    private void skill2() {
        SkillEngine.getInstance().getSkill(getOwner(), 19013, 55, getOwner()).useNoAnimationSkill();
    }

    private void skill3() {
        SkillEngine.getInstance().getSkill(getOwner(), 18159, 55, getOwner()).useNoAnimationSkill();
    }

    private void startSkillTask1() {
        skillTask1 = ThreadPoolManager.getInstance().scheduleAtFixedRate(new Runnable() {
            @Override
            public void run() {
                randomskills();
            }
        }, 5000, 35000);
    }

    private void cancelTask1() {
        if (skillTask1 != null && !skillTask1.isCancelled()) {
            skillTask1.cancel(true);
        }
    }

    private synchronized void checkPercentage(int hpPercentage) {
        for (Integer percent : percents) {
            if (hpPercentage <= percent) {
                switch (percent) {
                    case 50:
                        startSkillTask();
                        break;
                    case 30:
                        getRandomTarget();
                        break;
                }
                percents.remove(percent);
                break;
            }
        }
    }

    private void randomskills() {
        int rand = Rnd.get(0, 2);
        switch (rand) {
            case 0:
                skill1();
                break;
            case 1:
                skill2();
                break;
            case 2:
                skill3();
                break;
        }
    }

    private void addPercent() {
        percents.clear();
        Collections.addAll(percents, new Integer[]{50, 30});
    }

    @Override
    protected void handleDied() {
        super.handleDied();
        percents.clear();
        cancelTask();
        cancelTask1();
    }

    @Override
    protected void handleDespawned() {
        super.handleDespawned();
        cancelTask();
        cancelTask1();
    }

    @Override
    protected void handleBackHome() {
        super.handleBackHome();
        isHome.set(true);
    }
}