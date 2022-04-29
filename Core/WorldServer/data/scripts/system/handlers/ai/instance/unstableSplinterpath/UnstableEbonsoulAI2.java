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
package ai.instance.unstableSplinterpath;

import ai.AggressiveNpcAI2;
import com.aionemu.gameserver.ai2.AIName;
import com.aionemu.gameserver.model.gameobjects.Creature;
import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.network.aion.serverpackets.SM_ATTACK_STATUS.TYPE;
import com.aionemu.gameserver.skillengine.SkillEngine;
import com.aionemu.gameserver.utils.MathUtil;
import com.aionemu.gameserver.utils.ThreadPoolManager;
import java.util.concurrent.Future;
import java.util.concurrent.atomic.AtomicBoolean;

/**
 * @author Ritsu, Luzien
 * @edit Cheatkiller
 */
@AIName("unstableebonsoul")
public class UnstableEbonsoulAI2 extends AggressiveNpcAI2 {

    private AtomicBoolean isHome = new AtomicBoolean(true);
    private Future<?> skillTask;

    @Override
    protected void handleAttack(Creature creature) {
        super.handleAttack(creature);
        checkPercentage(getLifeStats().getHpPercentage());
        regen();
    }

    private void checkPercentage(int hpPercentage) {
        if (hpPercentage <= 95 && isHome.compareAndSet(true, false)) {
            startSkillTask();
        }
    }

    private void startSkillTask() {
        final Npc rukril = getPosition().getWorldMapInstance().getNpc(219551);
        skillTask = ThreadPoolManager.getInstance().scheduleAtFixedRate(new Runnable() {
            @Override
            public void run() {
                if (isAlreadyDead()) {
                    cancelTask();
                } else {
                    if (getPosition().getWorldMapInstance().getNpc(284023) == null) {
                        SkillEngine.getInstance().getSkill(getOwner(), 19159, 55, getOwner()).useNoAnimationSkill();
                        spawn(284023, getOwner().getX() + 2, getOwner().getY() - 2, getOwner().getZ(), (byte) 0);
                    }
                    if (rukril != null && !rukril.getLifeStats().isAlreadyDead()) {
                        SkillEngine.getInstance().getSkill(rukril, 19266, 55, rukril).useNoAnimationSkill();
                        spawn(284022, rukril.getX() + 2, rukril.getY() - 2, rukril.getZ(), (byte) 0);
                    }
                }
            }
        }, 5000, 70000); //re-check delay
    }

    private void cancelTask() {
        if (skillTask != null && !skillTask.isCancelled()) {
            skillTask.cancel(true);
        }
    }

    private void regen() {
        Npc rukril = getPosition().getWorldMapInstance().getNpc(219551);
        if (rukril != null && !rukril.getLifeStats().isAlreadyDead() && MathUtil.isIn3dRange(getOwner(), rukril, 5)) {
            if (!getOwner().getLifeStats().isFullyRestoredHp()) {
                getOwner().getLifeStats().increaseHp(TYPE.HP, 10000);
            }
        }
    }

    @Override
    protected void handleDied() {
        super.handleDied();
        cancelTask();
    }

    @Override
    protected void handleBackHome() {
        super.handleBackHome();
        cancelTask();
        isHome.set(true);
        getEffectController().removeEffect(19266);
    }
}