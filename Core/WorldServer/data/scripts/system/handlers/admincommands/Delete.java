/**
 * This file is part of aion-unique <aion-unique.org>.
 *
 * aion-unique is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * aion-unique is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with aion-unique. If not, see <http://www.gnu.org/licenses/>.
 */
package admincommands;

import com.aionemu.gameserver.dataholders.DataManager;
import com.aionemu.gameserver.model.gameobjects.Gatherable;
import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.templates.spawns.siegespawns.SiegeSpawnTemplate;
import com.aionemu.gameserver.model.templates.spawns.SpawnTemplate;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.utils.chathandlers.AdminCommand;
import java.io.IOException;

/**
 * @author Luno, modified Bobobear
 */
public class Delete extends AdminCommand {

	public Delete() {
		super("delete");
	}

	@Override
	public void execute(Player admin, String... params) {
		Npc npc = null;
		Gatherable gather = null;
		SpawnTemplate spawn = null;

		if (admin.getTarget() != null && admin.getTarget() instanceof Npc) {
			npc = (Npc) admin.getTarget();
        }
		if (admin.getTarget() != null && admin.getTarget() instanceof Gatherable) {
			gather = (Gatherable) admin.getTarget();
        }
		if (npc == null && gather == null) {
			PacketSendUtility.sendMessage(admin, "you need to target an Npc or Gatherable type.");
			return;
		}

		if (npc != null) {
			spawn = npc.getSpawn();
		}
		else {
			spawn = gather.getSpawn();
        }
		if (spawn.hasPool()) {
			PacketSendUtility.sendMessage(admin, "Can't delete pooled spawn template");
			return;
		}
		if (spawn instanceof SiegeSpawnTemplate) {
			PacketSendUtility.sendMessage(admin, "Can't delete siege spawn template");
			return;
		}

		if (npc != null) {
			npc.getController().onDelete();
		}
		else {
			gather.getController().onDelete();
		}
		try {
			DataManager.SPAWNS_DATA2.saveSpawn(admin, (npc != null ? npc : gather), true);
		}
		catch (IOException e) {
			e.printStackTrace();
			PacketSendUtility.sendMessage(admin, "Could not remove spawn");
			return;
		}
		PacketSendUtility.sendMessage(admin, "Spawn removed");
	}

	@Override
	public void onFail(Player admin, String message) {
		// TODO Auto-generated method stub
	}
}