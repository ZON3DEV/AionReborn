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

import com.aionemu.gameserver.model.TeleportAnimation;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.gameobjects.player.TeleportTask;
import com.aionemu.gameserver.services.instance.InstanceService;
import com.aionemu.gameserver.services.teleport.TeleportService2;
import com.aionemu.gameserver.skillengine.SkillEngine;
import com.aionemu.gameserver.skillengine.model.Skill;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.utils.chathandlers.AdminCommand;
import com.aionemu.gameserver.world.World;
import com.aionemu.gameserver.world.WorldMap;
import com.aionemu.gameserver.world.WorldMapInstance;
import com.aionemu.gameserver.world.WorldMapType;

/**
 * Goto command
 * @author Dwarfpicker
 * @rework Imaginary
 */
public class GoTo extends AdminCommand {

    public GoTo() {
        super("goto");
    }

    @Override
    public void execute(Player player, String... params) {
        if (params == null || params.length < 1) {
            PacketSendUtility.sendMessage(player, "syntax //goto <location>");
            return;
        }

        StringBuilder sbDestination = new StringBuilder();
        for (String p : params) {
            sbDestination.append(p).append(" ");
        }

        String destination = sbDestination.toString().trim();

        /**
         * Elysea
         */
        // Sanctum 
        if (destination.equalsIgnoreCase("sanctum") || destination.equalsIgnoreCase("\u042d\u043b\u0438\u0437\u0438\u0443\u043c")) {
            goTo(player, WorldMapType.SANCTUM.getId(), 1322, 1511, 568);
        } // Kaisinel
        else if (destination.equalsIgnoreCase("kaisinel") || destination.equalsIgnoreCase("\u0425\u0440\u0430\u043c \u041a\u0430\u0439\u0441\u0438\u043d\u0435\u043b\u044c")) {
            goTo(player, WorldMapType.KAISINEL.getId(), 2155, 1567, 1205);
        } // Poeta
        else if (destination.equalsIgnoreCase("poeta") || destination.equalsIgnoreCase("\u0424\u043e\u044d\u0442\u0430")) {
            goTo(player, WorldMapType.POETA.getId(), 806, 1242, 119);
        } else if (destination.equalsIgnoreCase("melponeh") || destination.equalsIgnoreCase("\u041b\u0430\u0433\u0435\u0440\u044c \u041c\u0435\u043b\u044c\u0444\u043e\u043d\u0435")) {
            goTo(player, WorldMapType.POETA.getId(), 426, 1740, 119);
        } // Verteron
        else if (destination.equalsIgnoreCase("verteron") || destination.equalsIgnoreCase("\u0411\u0435\u0440\u0442\u0440\u043e\u043d")) {
            goTo(player, WorldMapType.VERTERON.getId(), 1643, 1500, 119);
        } else if (destination.equalsIgnoreCase("cantas") || destination.equalsIgnoreCase("Cantas Coast") || destination.equalsIgnoreCase("\u041f\u043e\u0431\u0435\u0440\u0435\u0436\u044c\u0435 \u041a\u0430\u043d\u0442\u0430\u0441")) {
            goTo(player, WorldMapType.VERTERON.getId(), 2384, 788, 102);
        } else if (destination.equalsIgnoreCase("ardus") || destination.equalsIgnoreCase("Ardus Shrine") || destination.equalsIgnoreCase("\u0425\u0440\u0430\u043c \u042d\u043b\u044c\u0434\u0435\u0441")) {
            goTo(player, WorldMapType.VERTERON.getId(), 2333, 1817, 193);
        } else if (destination.equalsIgnoreCase("pilgrims") || destination.equalsIgnoreCase("Pilgrims Respite") || destination.equalsIgnoreCase("\u041f\u0440\u0438\u0441\u0442\u0430\u043d\u0438\u0449\u0435 \u0441\u0442\u0440\u0430\u043d\u043d\u0438\u043a\u0430")) {
            goTo(player, WorldMapType.VERTERON.getId(), 2063, 2412, 274);
        } else if (destination.equalsIgnoreCase("tolbas") || destination.equalsIgnoreCase("Tolbas Village") || destination.equalsIgnoreCase("\u0414\u0435\u0440\u0435\u0432\u043d\u044f \u0422\u043e\u043b\u044c\u0431\u0430\u0441")) {
            goTo(player, WorldMapType.VERTERON.getId(), 1291, 2206, 142);
        } // Eltnen
        else if (destination.equalsIgnoreCase("eltnen") || destination.equalsIgnoreCase("\u042d\u043b\u0442\u0435\u043d\u0435\u043d")) {
            goTo(player, WorldMapType.ELTNEN.getId(), 343, 2724, 264);
        } else if (destination.equalsIgnoreCase("golden") || destination.equalsIgnoreCase("Golden Bough Garrison") || destination.equalsIgnoreCase("\u041b\u0430\u0433\u0435\u0440\u044c \u0417\u043e\u043b\u043e\u0442\u043e\u0439 \u0432\u0435\u0442\u0432\u0438")) {
            goTo(player, WorldMapType.ELTNEN.getId(), 688, 431, 332);
        } else if (destination.equalsIgnoreCase("eltnen observatory") || destination.equalsIgnoreCase("\u0411\u0430\u0448\u043d\u044f \u042d\u043b\u0442\u0435\u043d\u0435\u043d\u0430")) {
            goTo(player, WorldMapType.ELTNEN.getId(), 1779, 883, 422);
        } else if (destination.equalsIgnoreCase("novan") || destination.equalsIgnoreCase("\u041f\u043e\u0433\u0440\u0430\u043d\u0438\u0447\u043d\u0430\u044f \u0437\u0430\u0441\u0442\u0430\u0432\u0430 \u0440\u0443\u0438\u043d")) {
            goTo(player, WorldMapType.ELTNEN.getId(), 947, 2215, 252);
        } else if (destination.equalsIgnoreCase("agairon") || destination.equalsIgnoreCase("\u0414\u0435\u0440\u0435\u0432\u043d\u044f \u0410\u043a\u0435\u0439\u0440\u043e\u043d")) {
            goTo(player, WorldMapType.ELTNEN.getId(), 1921, 2045, 361);
        } else if (destination.equalsIgnoreCase("kuriullu") || destination.equalsIgnoreCase("\u041d\u0430\u0431\u043b\u044e\u0434\u0430\u0442\u0435\u043b\u044c\u043d\u044b\u0439 \u043f\u043e\u0441\u0442 \u043d\u0430 \u0441\u043a\u0430\u043b\u0435")) {
            goTo(player, WorldMapType.ELTNEN.getId(), 2411, 2724, 361);
        } // Theobomos
        else if (destination.equalsIgnoreCase("theobomos") || destination.equalsIgnoreCase("\u0422\u0435\u043e\u0431\u043e\u043c\u043e\u0441")) {
            goTo(player, WorldMapType.THEOBOMOS.getId(), 1398, 1557, 31);
        } else if (destination.equalsIgnoreCase("jamanok") || destination.equalsIgnoreCase("\u0422\u0430\u0432\u0435\u0440\u043d\u0430 \u0414\u0436\u0430\u043c\u0430\u043d\u043e\u043a")) {
            goTo(player, WorldMapType.THEOBOMOS.getId(), 458, 1257, 127);
        } else if (destination.equalsIgnoreCase("meniherk") || destination.equalsIgnoreCase("Meniherk")) {
            goTo(player, WorldMapType.THEOBOMOS.getId(), 1396, 1560, 31);
        } else if (destination.equalsIgnoreCase("obsvillage") || destination.equalsIgnoreCase("\u0410\u0432\u0430\u043d\u043f\u043e\u0441\u0442 \u0422\u0435\u043e\u0431\u043e\u043c\u043e\u0441\u0430")) {
            goTo(player, WorldMapType.THEOBOMOS.getId(), 2234, 2284, 50);
        } else if (destination.equalsIgnoreCase("josnack") || destination.equalsIgnoreCase("\u041b\u0430\u0433\u0435\u0440\u044c \u041f\u0438\u0433\u043c\u0430\u043b\u0438\u043e\u043d\u0430")) {
            goTo(player, WorldMapType.THEOBOMOS.getId(), 901, 2774, 62);
        } else if (destination.equalsIgnoreCase("anangke") || destination.equalsIgnoreCase("\u0417\u043e\u043d\u0430 \u0440\u0430\u0441\u043a\u043e\u043f\u043e\u043a \u041c\u044d\u0439\u0432\u0430\u0440\u0438\u043d \u0432 \u041d\u0430\u043d\u043a\u044d")) {
            goTo(player, WorldMapType.THEOBOMOS.getId(), 2681, 847, 138);
        } // Heiron
        else if (destination.equalsIgnoreCase("heiron") || destination.equalsIgnoreCase("\u0418\u043d\u0442\u0435\u0440\u0434\u0438\u043a\u0430")) {
            goTo(player, WorldMapType.HEIRON.getId(), 2540, 343, 411);
        } else if (destination.equalsIgnoreCase("heiron observatory") || destination.equalsIgnoreCase("\u0411\u0430\u0448\u043d\u044f \u0418\u043d\u0442\u0435\u0440\u0434\u0438\u043a\u0438")) {
            goTo(player, WorldMapType.HEIRON.getId(), 1423, 1334, 175);
        } else if (destination.equalsIgnoreCase("senemonea") || destination.equalsIgnoreCase("\u041b\u0430\u0433\u0435\u0440\u044c \u0421\u0435\u043d\u0435\u043c\u043e\u043d\u0438\u0438")) {
            goTo(player, WorldMapType.HEIRON.getId(), 971, 686, 135);
        } else if (destination.equalsIgnoreCase("jeiaparan") || destination.equalsIgnoreCase("\u0414\u0435\u0440\u0435\u0432\u043d\u044f \u042e\u0444\u0440\u043e\u0441\u0438\u043d")) {
            goTo(player, WorldMapType.HEIRON.getId(), 1635, 2693, 115);
        } else if (destination.equalsIgnoreCase("changarnerk") || destination.equalsIgnoreCase("\u041b\u0430\u0433\u0435\u0440\u044c \u0427\u0435\u043d\u0433\u0430\u0440\u0443\u043d")) {
            goTo(player, WorldMapType.HEIRON.getId(), 916, 2256, 157);
        } else if (destination.equalsIgnoreCase("kishar") || destination.equalsIgnoreCase("\u0421\u043c\u043e\u0442\u0440\u043e\u0432\u0430\u044f \u0432\u044b\u0448\u043a\u0430 \u041a\u0438\u0448\u0430\u0440\u0442\u044b")) {
            goTo(player, WorldMapType.HEIRON.getId(), 1999, 1391, 118);
        } else if (destination.equalsIgnoreCase("arbolu") || destination.equalsIgnoreCase("\u0414\u0435\u0440\u0435\u0432\u043d\u044f \u0424\u0430\u0441\u0435\u0440\u0442\u0430")) {
            goTo(player, WorldMapType.HEIRON.getId(), 170, 1662, 120);
        }
		/**
         * Asmodae
         */
        // Panium
        else if (destination.equalsIgnoreCase("panium") || destination.equalsIgnoreCase("\u041f\u0430\u043d\u0434\u0435\u043c\u043e\u043d\u0438\u0443\u043c")) {
            goTo(player, WorldMapType.PANDAEMONIUM.getId(), 1679, 1400, 195);
        } // Marchutran
        else if (destination.equalsIgnoreCase("marchutan") || destination.equalsIgnoreCase("\u0425\u0440\u0430\u043c \u041c\u0430\u0440\u043a\u0443\u0442\u0430\u043d\u0430")) {
            goTo(player, WorldMapType.MARCHUTAN.getId(), 1557, 1429, 266);
        } // Ishalgen
        else if (destination.equalsIgnoreCase("ishalgen") || destination.equalsIgnoreCase("\u0418\u0441\u0445\u0430\u043b\u044c\u0433\u0435\u043d")) {
            goTo(player, WorldMapType.ISHALGEN.getId(), 529, 2449, 281);
        } else if (destination.equalsIgnoreCase("anturoon") || destination.equalsIgnoreCase("\u0417\u0430\u0441\u0442\u0430\u0432\u0430 \u0410\u043d\u0442\u0440\u043e\u043d\u0430")) {
            goTo(player, WorldMapType.ISHALGEN.getId(), 940, 1707, 259);
        } // Altgard
        else if (destination.equalsIgnoreCase("altgard") || destination.equalsIgnoreCase("\u0410\u043b\u044c\u0442\u0433\u0430\u0440\u0434")) {
            goTo(player, WorldMapType.ALTGARD.getId(), 1748, 1807, 254);
        } else if (destination.equalsIgnoreCase("basfelt") || destination.equalsIgnoreCase("\u0414\u0435\u0440\u0435\u0430\u0432\u043d\u044f \u041f\u0430\u0441\u0444\u0435\u043b\u044c\u0442")) {
            goTo(player, WorldMapType.ALTGARD.getId(), 1903, 696, 260);
        } else if (destination.equalsIgnoreCase("trader") || destination.equalsIgnoreCase("\u041f\u043e\u0440\u0442 \u043d\u0435\u0433\u043e\u0446\u0438\u0430\u043d\u0442\u043e\u0432")) {
            goTo(player, WorldMapType.ALTGARD.getId(), 2680, 1024, 311);
        } else if (destination.equalsIgnoreCase("impetusiom") || destination.equalsIgnoreCase("\u0421\u0435\u0440\u0434\u0446\u0435 \u0418\u043c\u0444\u0435\u0442\u0438\u0443\u0441\u0430")) {
            goTo(player, WorldMapType.ALTGARD.getId(), 2643, 1658, 324);
        } else if (destination.equalsIgnoreCase("altgard observatory") || destination.equalsIgnoreCase("\u0411\u0430\u0448\u043d\u044f \u0410\u043b\u044c\u0442\u0433\u0440\u0430\u0434")) {
            goTo(player, WorldMapType.ALTGARD.getId(), 1468, 2560, 299);
        } // Morheim
        else if (destination.equalsIgnoreCase("morheim") || destination.equalsIgnoreCase("\u041c\u043e\u0440\u0445\u0435\u0439\u043c")) {
            goTo(player, WorldMapType.MORHEIM.getId(), 308, 2274, 449);
        } else if (destination.equalsIgnoreCase("desert") || destination.equalsIgnoreCase("\u041b\u0430\u0433\u0435\u0440\u044c \u0421\u043e\u043b\u044f\u043d\u043e\u0439 \u043f\u0443\u0441\u0442\u044b\u043d\u0438")) {
            goTo(player, WorldMapType.MORHEIM.getId(), 634, 900, 360);
        } else if (destination.equalsIgnoreCase("slag") || destination.equalsIgnoreCase("\u0418\u0441\u0441\u043b\u0435\u0434\u043e\u0432\u0430\u0442\u0435\u043b\u044c\u0441\u043a\u0430\u044f \u0431\u0430\u0437\u0430 \u043d\u0430 \u0432\u0443\u043b\u043a\u0430\u043d\u0435")) {
            goTo(player, WorldMapType.MORHEIM.getId(), 1772, 1662, 197);
        } else if (destination.equalsIgnoreCase("kellan") || destination.equalsIgnoreCase("\u0425\u0438\u0436\u0438\u043d\u0430 \u0413\u043e\u043d\u0434\u0430\u043b\u044c\u0444\u0443\u043d\u0430")) {
            goTo(player, WorldMapType.MORHEIM.getId(), 1070, 2486, 239);
        } else if (destination.equalsIgnoreCase("alsig") || destination.equalsIgnoreCase("\u0414\u0435\u0440\u0435\u0432\u043d\u044f \u0418\u0440\u0430\u043b\u044c\u0441\u0438\u0433\u0430")) {
            goTo(player, WorldMapType.MORHEIM.getId(), 2387, 1742, 102);
        } else if (destination.equalsIgnoreCase("morheim observatory") || destination.equalsIgnoreCase("\u0421\u0442\u043e\u0440\u043e\u0436\u0435\u0432\u0430\u044f \u0431\u0430\u0448\u043d\u044f \u041c\u043e\u0440\u0445\u0435\u0439\u043c\u0430")) {
            goTo(player, WorldMapType.MORHEIM.getId(), 2794, 1122, 171);
        } else if (destination.equalsIgnoreCase("halabana") || destination.equalsIgnoreCase("\u0417\u0430\u0441\u0442\u0430\u0432\u0430 \u043f\u043e\u0432\u0441\u0442\u0430\u043d\u0446\u0435\u0432")) {
            goTo(player, WorldMapType.MORHEIM.getId(), 2346, 2219, 127);
        } // Brusthonin
        else if (destination.equalsIgnoreCase("brusthonin") || destination.equalsIgnoreCase("\u0411\u0440\u0443\u0441\u0442\u0445\u043e\u043d\u0438\u043d")) {
            goTo(player, WorldMapType.BRUSTHONIN.getId(), 2917, 2421, 15);
        } else if (destination.equalsIgnoreCase("baltasar") || destination.equalsIgnoreCase("\u041f\u043e\u0441\u0435\u043b\u0435\u043d\u0438\u0435 \u0412\u0430\u043b\u044c\u0442\u0430\u0437\u0430\u0440\u0430")) {
            goTo(player, WorldMapType.BRUSTHONIN.getId(), 1413, 2013, 51);
        } else if (destination.equalsIgnoreCase("bollu") || destination.equalsIgnoreCase("\u041f\u043e\u0441\u0442 \u0418\u043e\u043b\u043b\u0443")) {
            goTo(player, WorldMapType.BRUSTHONIN.getId(), 840, 2016, 307);
        } else if (destination.equalsIgnoreCase("edge") || destination.equalsIgnoreCase("\u0418\u0441\u0441\u043b\u0435\u0434\u043e\u0432\u0430\u0442\u0435\u043b\u044c\u0441\u043a\u0430\u044f \u0431\u0430\u0437\u0430 \u0432 \u043a\u0430\u043d\u044c\u043e\u043d\u0435")) {
            goTo(player, WorldMapType.BRUSTHONIN.getId(), 1523, 374, 231);
        } else if (destination.equalsIgnoreCase("bubu") || destination.equalsIgnoreCase("\u041f\u043e\u0441\u0435\u043b\u0435\u043d\u0438\u0435 \u0431\u0443\u043c-\u0431\u0443\u043c")) {
            goTo(player, WorldMapType.BRUSTHONIN.getId(), 526, 848, 76);
        } else if (destination.equalsIgnoreCase("settlers") || destination.equalsIgnoreCase("\u041b\u0430\u0433\u0435\u0440\u044c \u043f\u043e\u0441\u0435\u043b\u0435\u043d\u0446\u0435\u0432")) {
            goTo(player, WorldMapType.BRUSTHONIN.getId(), 2917, 2417, 15);
        } // Beluslan
        else if (destination.equalsIgnoreCase("beluslan") || destination.equalsIgnoreCase("\u0411\u0435\u043b\u0443\u0441\u043b\u0430\u043d")) {
            goTo(player, WorldMapType.BELUSLAN.getId(), 398, 400, 222);
        } else if (destination.equalsIgnoreCase("besfer") || destination.equalsIgnoreCase("\u0414\u0435\u0440\u0435\u0432\u043d\u044f \u0431\u0435\u0436\u0435\u043d\u0446\u0435\u0432")) {
            goTo(player, WorldMapType.BELUSLAN.getId(), 533, 1866, 262);
        } else if (destination.equalsIgnoreCase("kidorun") || destination.equalsIgnoreCase("\u041b\u0430\u0433\u0435\u0440\u044c \u041a\u0438\u0434\u043e\u0440\u0443\u043d")) {
            goTo(player, WorldMapType.BELUSLAN.getId(), 1243, 819, 260);
        } else if (destination.equalsIgnoreCase("red Mane") || destination.equalsIgnoreCase("\u0414\u0435\u0440\u0435\u0432\u043d\u044f \u041a\u0440\u0430\u0441\u043d\u043e\u0439 \u0433\u0440\u0438\u0432\u044b")) {
            goTo(player, WorldMapType.BELUSLAN.getId(), 2358, 1241, 470);
        } else if (destination.equalsIgnoreCase("kistenian") || destination.equalsIgnoreCase("\u041b\u0430\u0433\u0435\u0440\u044c \u0434\u0430\u044d\u0432\u043e\u0432 \u043e\u0433\u043d\u044f")) {
            goTo(player, WorldMapType.BELUSLAN.getId(), 1942, 513, 412);
        } else if (destination.equalsIgnoreCase("hoarfrost") || destination.equalsIgnoreCase("\u0423\u0431\u0435\u0436\u0438\u0449\u0435 \u0421\u043d\u0435\u0436\u043d\u043e\u0433\u043e \u0445\u0432\u043e\u0441\u0442\u0430")) {
            goTo(player, WorldMapType.BELUSLAN.getId(), 2431, 2063, 579);
        }
	    /**
         * Balaurea
         */
        // Inggison
        else if (destination.equalsIgnoreCase("inggison") || destination.equalsIgnoreCase("\u0418\u043d\u0433\u0438\u0441\u043e\u043d")) {
            goTo(player, WorldMapType.INGGISON.getId(), 1335, 276, 590);
        } else if (destination.equalsIgnoreCase("ufob") || destination.equalsIgnoreCase("\u041f\u043e\u0441\u0442 \u043f\u043e\u0434\u0437\u0435\u043c\u043d\u043e\u0439 \u043a\u0440\u0435\u043f\u043e\u0441\u0442\u0438")) {
            goTo(player, WorldMapType.INGGISON.getId(), 382, 951, 460);
        } else if (destination.equalsIgnoreCase("soteria") || destination.equalsIgnoreCase("\u0414\u0435\u0440\u0435\u0432\u043d\u044f \u0421\u043e\u0442\u0435\u0440\u0438\u0438")) {
            goTo(player, WorldMapType.INGGISON.getId(), 2713, 1477, 382);
        } else if (destination.equalsIgnoreCase("hanarkand") || destination.equalsIgnoreCase("\u0417\u0430\u0441\u0442\u0430\u0432\u0430 \u0425\u0430\u043d\u0430\u0440\u043a\u0430\u043d\u0434\u0430")) {
            goTo(player, WorldMapType.INGGISON.getId(), 1892, 1748, 327);
        } // Gelkmaros
        else if (destination.equalsIgnoreCase("gelkmaros") || destination.equalsIgnoreCase("\u041a\u0435\u043b\u044c\u043a\u043c\u0430\u0440\u043e\u0441")) {
            goTo(player, WorldMapType.GELKMAROS.getId(), 1763, 2911, 554);
        } else if (destination.equalsIgnoreCase("subterranea") || destination.equalsIgnoreCase("\u0417\u0430\u0441\u0442\u0430\u0432\u0430 \u043f\u043e\u0434\u0437\u0435\u043c\u043d\u043e\u0433\u043e \u0433\u043e\u0440\u043e\u0434\u0430")) {
            goTo(player, WorldMapType.GELKMAROS.getId(), 2503, 2147, 464);
        } else if (destination.equalsIgnoreCase("rhonnam") || destination.equalsIgnoreCase("\u0414\u0435\u0440\u0435\u0432\u043d\u044f \u0431\u0435\u0436\u0435\u043d\u0446\u0435\u0432 \u0420\u043e\u043c\u0431\u0443\u0441\u0430")) {
            goTo(player, WorldMapType.GELKMAROS.getId(), 845, 1737, 354);
        } // Silentera
        else if (destination.equalsIgnoreCase("silentera") || destination.equalsIgnoreCase("\u0422\u043e\u043d\u043d\u0435\u043b\u044c \u0421\u0438\u043b\u0435\u043d\u0442\u0435\u0440\u0430")) {
            goTo(player, 600010000, 583, 767, 300);
        }
		/**
         * Abyss
         */
        else if (destination.equalsIgnoreCase("reshanta") || destination.equalsIgnoreCase("\u0410\u0440\u044d\u0448\u0443\u0440\u0430\u0442")) {
            goTo(player, WorldMapType.RESHANTA.getId(), 951, 936, 1667);
        } else if (destination.equalsIgnoreCase("teminon") || destination.equalsIgnoreCase("\u041f\u043b\u043e\u0449\u0430\u0434\u044c \u0420\u0430\u0442\u0438\u0441")) {
            goTo(player, WorldMapType.RESHANTA.getId(), 2867, 1034, 1528);
        } else if (destination.equalsIgnoreCase("primum") || destination.equalsIgnoreCase("\u0411\u0430\u0433\u0440\u043e\u0432\u0430\u044f \u043f\u043b\u043e\u0449\u0430\u0434\u044c")) {
            goTo(player, WorldMapType.RESHANTA.getId(), 1078, 2839, 1636);
        } else if (destination.equalsIgnoreCase("abyss1") || destination.equalsIgnoreCase("\u0412\u043e\u0441\u0442\u043e\u0447\u043d\u044b\u0439 \u043e\u0441\u043a\u043e\u043b\u043e\u043a \u0420\u0430\u0442\u0435\u0441\u0435\u0440\u0430\u043d\u0430")) {
            goTo(player, WorldMapType.RESHANTA.getId(), 1596, 2952, 2943);
        } else if (destination.equalsIgnoreCase("abyss2") || destination.equalsIgnoreCase("\u0417\u0430\u043f\u0430\u0434\u043d\u044b\u0439 \u043e\u0441\u043a\u043e\u043b\u043e\u043a \u0420\u0430\u0442\u0435\u0441\u0435\u0440\u0430\u043d\u0430")) {
            goTo(player, WorldMapType.RESHANTA.getId(), 2054, 660, 2843);
        }
		/**
         * Abyss siege
         */
        else if (destination.equalsIgnoreCase("1131") || destination.equalsIgnoreCase("\u0417\u0430\u043f\u0430\u0434\u043d\u0430\u044f \u043a\u0440\u0435\u043f\u043e\u0441\u0442\u044c \u0421\u0438\u044d\u043b\u0438")) {
            goTo(player, WorldMapType.RESHANTA.getId(), 2804, 2609, 1505);
        } else if (destination.equalsIgnoreCase("1132") || destination.equalsIgnoreCase("\u0412\u043e\u0441\u0442\u043e\u0447\u043d\u0430\u044f \u043a\u0440\u0435\u043f\u043e\u0441\u0442\u044c \u0421\u0438\u044d\u043b\u0438")) {
            goTo(player, WorldMapType.RESHANTA.getId(), 2609, 2866, 1507);
        } else if (destination.equalsIgnoreCase("1141") || destination.equalsIgnoreCase("\u041a\u0440\u0435\u043f\u043e\u0441\u0442\u044c \u0441\u0435\u0440\u043d\u043e\u0433\u043e \u0434\u0435\u0440\u0435\u0432\u0430")) {
            goTo(player, WorldMapType.RESHANTA.getId(), 1389, 1195, 1515);
        } else if (destination.equalsIgnoreCase("1211") || destination.equalsIgnoreCase("\u041a\u0440\u0435\u043f\u043e\u0441\u0442\u044c \u0434\u0440\u0435\u0432\u043d\u0435\u0433\u043e \u0433\u043e\u0440\u043e\u0434\u0430 \u0420\u0443")) {
            goTo(player, WorldMapType.RESHANTA.getId(), 2749, 802, 2873);
        } else if (destination.equalsIgnoreCase("1221") || destination.equalsIgnoreCase("\u041a\u0440\u0435\u043f\u043e\u0441\u0442\u044c \u041a\u0440\u043e\u0442\u0430\u043d")) {
            goTo(player, WorldMapType.RESHANTA.getId(), 2056, 1289, 2964);
        } else if (destination.equalsIgnoreCase("1231") || destination.equalsIgnoreCase("\u041a\u0440\u0435\u043f\u043e\u0441\u0442\u044c \u0422\u043a\u0438\u0441\u0430\u0441")) {
            goTo(player, WorldMapType.RESHANTA.getId(), 2490, 2106, 3050);
        } else if (destination.equalsIgnoreCase("1241") || destination.equalsIgnoreCase("\u041a\u0440\u0435\u043f\u043e\u0441\u0442\u044c \u0420\u0430-\u043c\u0438\u0440\u044d\u043d")) {
            goTo(player, WorldMapType.RESHANTA.getId(), 1788, 2268, 2950);
        } else if (destination.equalsIgnoreCase("1251") || destination.equalsIgnoreCase("\u041a\u0440\u0435\u043f\u043e\u0441\u0442\u044c \u0410\u0441\u0442\u0435\u0440\u0438\u044f")) {
            goTo(player, WorldMapType.RESHANTA.getId(), 707, 2971, 2894);
        } else if (destination.equalsIgnoreCase("1011") || destination.equalsIgnoreCase("\u041a\u0440\u0435\u043f\u043e\u0441\u0442\u044c \u0441\u0432\u044f\u0442\u043e\u0441\u0442\u0438")) {
            goTo(player, WorldMapType.RESHANTA.getId(), 2137, 1930, 2322);
        }
		/**
         * Instances
         */
        else if (destination.equalsIgnoreCase("haramel") || destination.equalsIgnoreCase("\u0425\u0440\u0430\u043c\u0435\u043b\u044c")) {
            goTo(player, 300200000, 176, 21, 144);
        } else if (destination.equalsIgnoreCase("nochsana") || destination.equalsIgnoreCase("NTC") || destination.equalsIgnoreCase("\u0422\u0440\u0435\u043d\u0438\u0440\u043e\u0432\u043e\u0447\u043d\u044b\u0439 \u043b\u0430\u0433\u0435\u0440\u044c \u041d\u0430\u0441\u0430\u043d")) {
            goTo(player, 300030000, 513, 668, 331);
        } else if (destination.equalsIgnoreCase("arcanis") || destination.equalsIgnoreCase("Sky Temple of Arcanis") || destination.equalsIgnoreCase("\u041e\u0433\u043d\u0435\u043d\u043d\u0430\u044f \u043a\u043e\u043c\u043d\u0430\u0442\u0430")) {
            goTo(player, 320050000, 177, 229, 536);
        } else if (destination.equalsIgnoreCase("fire temple") || destination.equalsIgnoreCase("FT") || destination.equalsIgnoreCase("\u0421\u0432\u044f\u0442\u0438\u043b\u0438\u0449\u0435 \u043e\u0433\u043d\u044f")) {
            goTo(player, 320100000, 144, 312, 123);
        } else if (destination.equalsIgnoreCase("kromede") || destination.equalsIgnoreCase("Kromede Trial") || destination.equalsIgnoreCase("\u041a\u043e\u0448\u043c\u0430\u0440")) {
            goTo(player, 300230000, 248, 244, 189);
        } // Steel Rake
        else if (destination.equalsIgnoreCase("steel rake") || destination.equalsIgnoreCase("SR") || destination.equalsIgnoreCase("\u041a\u043e\u0440\u0430\u0431\u043b\u044c \u0441\u0442\u0430\u043b\u044c\u043d\u043e\u0433\u043e \u043f\u043b\u0430\u0432\u043d\u0438\u043a\u0430")) {
            goTo(player, 300100000, 237, 506, 948);
        } else if (destination.equalsIgnoreCase("steel rake lower") || destination.equalsIgnoreCase("SR Low")) {
            goTo(player, 300100000, 283, 453, 903);
        } else if (destination.equalsIgnoreCase("steel rake middle") || destination.equalsIgnoreCase("SR Mid")) {
            goTo(player, 300100000, 283, 453, 953);
        } else if (destination.equalsIgnoreCase("indratu") || destination.equalsIgnoreCase("Indratu Fortress") || destination.equalsIgnoreCase("\u041a\u0440\u0435\u043f\u043e\u0441\u0442\u044c \u0418\u043d\u0434\u0440\u0430\u0442\u0430")) {
            goTo(player, 310090000, 562, 335, 1015);
        } else if (destination.equalsIgnoreCase("azoturan") || destination.equalsIgnoreCase("Azoturan Fortress") || destination.equalsIgnoreCase("\u041a\u0440\u0435\u043f\u043e\u0441\u0442\u044c \u0410\u0434\u0436\u043e\u0442\u0443\u0440\u0430\u043d")) {
            goTo(player, 310100000, 458, 428, 1039);
        } else if (destination.equalsIgnoreCase("bio lab") || destination.equalsIgnoreCase("Aetherogenetics Lab") || destination.equalsIgnoreCase("\u0421\u0435\u043a\u0440\u0435\u0442\u043d\u0430\u044f \u043b\u0430\u0431\u043e\u0440\u0430\u0442\u043e\u0440\u0438\u044f \u043f\u043e\u0432\u0441\u0442\u0430\u043d\u0446\u0435\u0432")) {
            goTo(player, 310050000, 225, 244, 133);
        } else if (destination.equalsIgnoreCase("adma") || destination.equalsIgnoreCase("Adma Stronghold") || destination.equalsIgnoreCase("\u0424\u043e\u0440\u0442 \u0410\u0434\u043c\u0430")) {
            goTo(player, 320130000, 450, 200, 168);
        } else if (destination.equalsIgnoreCase("alquimia") || destination.equalsIgnoreCase("Alquimia Research Center") || destination.equalsIgnoreCase("\u041b\u0430\u0431\u043e\u0440\u0430\u0442\u043e\u0440\u0438\u044f \u0410\u043b\u044c\u043a\u0432\u0438\u043c\u0438\u0438")) {
            goTo(player, 320110000, 603, 527, 200);
        } else if (destination.equalsIgnoreCase("draupnir") || destination.equalsIgnoreCase("Draupnir Cave") || destination.equalsIgnoreCase("\u041f\u0435\u0449\u0435\u0440\u0430 \u0414\u0440\u0430\u0443\u043d\u0431\u0438\u0440")) {
            goTo(player, 320080000, 491, 373, 622);
        } else if (destination.equalsIgnoreCase("theobomos lab") || destination.equalsIgnoreCase("Theobomos Research Lab") || destination.equalsIgnoreCase("\u041b\u0430\u0431\u043e\u0440\u0430\u0442\u043e\u0440\u0438\u044f \u0422\u0435\u043e\u0431\u043e\u043c\u043e\u0441\u0430")) {
            goTo(player, 310110000, 477, 201, 170);
        } else if (destination.equalsIgnoreCase("dark poeta") || destination.equalsIgnoreCase("DP") || destination.equalsIgnoreCase("\u0424\u043e\u044d\u0442\u0430 \u0422\u044c\u043c\u044b")) {
            goTo(player, 300040000, 1214, 412, 140);
        } // Lower Abyss
        else if (destination.equalsIgnoreCase("sulfur") || destination.equalsIgnoreCase("Sulfur Tree Nest") || destination.equalsIgnoreCase("\u0413\u043d\u0435\u0437\u0434\u043e \u0421\u0435\u0440\u043d\u043e\u0433\u043e \u0414\u0435\u0440\u0435\u0432\u0430")) {
            goTo(player, 300060000, 462, 345, 163);
        } else if (destination.equalsIgnoreCase("right wing") || destination.equalsIgnoreCase("Right Wing Chamber") || destination.equalsIgnoreCase("\u0422\u0435\u043d\u044c \u043f\u0440\u0430\u0432\u043e\u0433\u043e \u043a\u0440\u044b\u043b\u0430")) {
            goTo(player, 300090000, 263, 386, 103);
        } else if (destination.equalsIgnoreCase("left wing") || destination.equalsIgnoreCase("Left Wing Chamber") || destination.equalsIgnoreCase("\u0422\u0435\u043d\u044c \u043b\u0435\u0432\u043e\u0433\u043e \u043a\u0440\u044b\u043b\u0430")) {
            goTo(player, 300080000, 672, 606, 321);
        } // Upper Abyss
        else if (destination.equalsIgnoreCase("asteria chamber") || destination.equalsIgnoreCase("\u041f\u0440\u043e\u043f\u0430\u0441\u0442\u044c \u0410\u0441\u0442\u0435\u0440\u0438\u0438")) {
            goTo(player, 300050000, 469, 568, 202);
        } else if (destination.equalsIgnoreCase("miren chamber") || destination.equalsIgnoreCase("\u041a\u0440\u0435\u043f\u043e\u0441\u0442\u044c \u0420\u0430-\u041c\u0438\u0440\u044d\u043d\u0430")) {
            goTo(player, 300130000, 527, 120, 176);
        } else if (destination.equalsIgnoreCase("kysis chamber") || destination.equalsIgnoreCase("\u041a\u0440\u0435\u043f\u043e\u0441\u0442\u044c \u0422\u043a\u0438\u0441\u0430\u0441")) {
            goTo(player, 300120000, 528, 121, 176);
        } else if (destination.equalsIgnoreCase("krotan chamber") || destination.equalsIgnoreCase("\u041a\u0440\u0435\u043f\u043e\u0441\u044c \u041a\u0440\u043e\u0442\u0430\u043d")) {
            goTo(player, 300140000, 528, 109, 176);
        } else if (destination.equalsIgnoreCase("roah Chamber") || destination.equalsIgnoreCase("\u041f\u043e\u0434\u0437\u0435\u043c\u043d\u0430\u044f \u043a\u0440\u0435\u043f\u043e\u0441\u0442\u044c \u0420\u0443")) {
            goTo(player, 300070000, 504, 396, 94);
        } // Divine
        else if (destination.equalsIgnoreCase("abyssal splinter") || destination.equalsIgnoreCase("Core") || destination.equalsIgnoreCase("\u0420\u0443\u0438\u043d\u044b \u0425\u0430\u043e\u0441\u0430")) {
            goTo(player, 300220000, 704, 153, 453);
        } else if (destination.equalsIgnoreCase("dredgion") || destination.equalsIgnoreCase("\u0414\u0435\u0440\u0430\u0434\u0438\u043a\u043e\u043d")) {
            goTo(player, 300110000, 414, 193, 431);
        } else if (destination.equalsIgnoreCase("chantra") || destination.equalsIgnoreCase("Chantra Dredgion") || destination.equalsIgnoreCase("\u0414\u0435\u0440\u0430\u0434\u0438\u043a\u043e\u043d \u0414\u0436\u0430\u043d\u0442\u0440\u044b")) {
            goTo(player, 300210000, 414, 193, 431);
        } else if (destination.equalsIgnoreCase("terath") || destination.equalsIgnoreCase("Terath Dredgion") || destination.equalsIgnoreCase("\u0414\u0435\u0440\u0430\u0434\u0438\u043a\u043e\u043d \u0421\u0430\u0434\u0445\u0430")) {
            goTo(player, 300440000, 414, 193, 431);
        } else if (destination.equalsIgnoreCase("taloc") || destination.equalsIgnoreCase("Taloc's Hollow") || destination.equalsIgnoreCase("\u041a\u0430\u0441\u043f\u0430\u0440")) {
            goTo(player, 300190000, 200, 214, 1099);
        } // Udas
        else if (destination.equalsIgnoreCase("udas") || destination.equalsIgnoreCase("Udas Temple") || destination.equalsIgnoreCase("\u0417\u0430\u0431\u0440\u043e\u0448\u0435\u043d\u043d\u044b\u0439 \u0425\u0440\u0430\u043c \u0423\u0434\u0430\u0441")) {
            goTo(player, 300150000, 637, 657, 134);
        } else if (destination.equalsIgnoreCase("udas lower") || destination.equalsIgnoreCase("Udas Lower Temple") || destination.equalsIgnoreCase("\u041f\u043e\u0434\u0437\u0435\u043c\u0435\u043b\u044c\u0435 \u0425\u0440\u0430\u043c\u0430 \u0423\u0434\u0430\u0441")) {
            goTo(player, 300160000, 1146, 277, 116);
        } else if (destination.equalsIgnoreCase("beshmundir") || destination.equalsIgnoreCase("BT") || destination.equalsIgnoreCase("Beshmundir Temple") || destination.equalsIgnoreCase("\u0425\u0440\u0430\u043c \u041f\u0445\u0430\u0441\u0443\u043c\u0430\u043d\u0434\u0438\u0440")) {
            goTo(player, 300170000, 1477, 237, 243);
        } // Padmaraska Cave
        else if (destination.equalsIgnoreCase("padmaraska cave") || destination.equalsIgnoreCase("\u041f\u0435\u0449\u0435\u0440\u0430 \u041c\u0430\u0440\u0438\u0441\u0441\u044b")) {
            goTo(player, 320150000, 385, 506, 66);
        }
		/**
         * Quest Instance Maps
         */
        // TODO : Changer id maps
        else if (destination.equalsIgnoreCase("karamatis") || destination.equalsIgnoreCase("\u041a\u0430\u0440\u0430\u043c\u043c\u0430\u0442\u0438\u0441")) {
            goTo(player, 310010000, 221, 250, 206);
        } else if (destination.equalsIgnoreCase("karamatis1") || destination.equalsIgnoreCase("\u041a\u0430\u0440\u0430\u043c\u043c\u0430\u0442\u0438\u0441 1")) {
            goTo(player, 310020000, 312, 274, 206);
        } else if (destination.equalsIgnoreCase("karamatis2") || destination.equalsIgnoreCase("\u041a\u0430\u0440\u0430\u043c\u043c\u0430\u0442\u0438\u0441 2")) {
            goTo(player, 310120000, 221, 250, 206);
        } else if (destination.equalsIgnoreCase("aerdina") || destination.equalsIgnoreCase("\u0410\u044d\u0440\u0434\u0438\u043d\u0430")) {
            goTo(player, 310030000, 275, 168, 205);
        } else if (destination.equalsIgnoreCase("geranaia") || destination.equalsIgnoreCase("\u0413\u0435\u0440\u0430\u043d\u0430\u0439\u044f")) {
            goTo(player, 310040000, 275, 168, 205);
        } // Stigma quest
        else if (destination.equalsIgnoreCase("sliver") || destination.equalsIgnoreCase("Sliver of Darkness") || destination.equalsIgnoreCase("\u041e\u0441\u0442\u0440\u043e\u0432 \u0442\u044c\u043c\u044b")) {
            goTo(player, 310070000, 247, 249, 1392);
        } else if (destination.equalsIgnoreCase("space") || destination.equalsIgnoreCase("Space of Destiny") || destination.equalsIgnoreCase("\u041e\u0431\u0438\u0442\u0435\u043b\u044c \u0441\u0443\u0434\u044c\u0431\u044b")) {
            goTo(player, 320070000, 246, 246, 125);
        } else if (destination.equalsIgnoreCase("ataxiar1") || destination.equalsIgnoreCase("\u041d\u0430\u0440\u0437\u0430\u0441 1")) {
            goTo(player, 320010000, 221, 250, 206);
        } else if (destination.equalsIgnoreCase("ataxiar") || destination.equalsIgnoreCase("\u041d\u0430\u0440\u0437\u0430\u0441 2")) {
            goTo(player, 320020000, 221, 250, 206);
        } else if (destination.equalsIgnoreCase("bregirun") || destination.equalsIgnoreCase("\u0411\u0440\u0435\u0433\u0438\u0440\u0443\u043d")) {
            goTo(player, 320030000, 275, 168, 205);
        } else if (destination.equalsIgnoreCase("nidalber") || destination.equalsIgnoreCase("\u041d\u0438\u0434\u0430\u043b\u044c\u0431\u0435\u0440")) {
            goTo(player, 320040000, 275, 168, 205);
        }
		/**
         * Arenas
         */
        else if (destination.equalsIgnoreCase("sanctum arena") || destination.equalsIgnoreCase("\u041f\u043e\u0434\u0437\u0435\u043c\u043d\u0430\u044f \u0430\u0440\u0435\u043d\u0430 \u042d\u043b\u0438\u0437\u0438\u0443\u043c\u0430")) {
            goTo(player, 310080000, 275, 242, 159);
        } else if (destination.equalsIgnoreCase("triniel arena") || destination.equalsIgnoreCase("\u041f\u043e\u0434\u0437\u0435\u043c\u043d\u0430\u044f \u0430\u0440\u0435\u043d\u0430 \u0422\u0440\u0438\u043d\u0438\u044d\u043b\u044c")) {
            goTo(player, 320090000, 275, 239, 159);
        } // Empyrean Crucible
        else if (destination.equalsIgnoreCase("crucible1-0")) {
            goTo(player, 300300000, 380, 350, 95);
        } else if (destination.equalsIgnoreCase("crucible1-1")) {
            goTo(player, 300300000, 346, 350, 96);
        } else if (destination.equalsIgnoreCase("crucible5-0")) {
            goTo(player, 300300000, 1265, 821, 359);
        } else if (destination.equalsIgnoreCase("crucible5-1")) {
            goTo(player, 300300000, 1256, 797, 359);
        } else if (destination.equalsIgnoreCase("crucible6-0")) {
            goTo(player, 300300000, 1596, 150, 129);
        } else if (destination.equalsIgnoreCase("crucible6-1")) {
            goTo(player, 300300000, 1628, 155, 126);
        } else if (destination.equalsIgnoreCase("crucible7-0")) {
            goTo(player, 300300000, 1813, 797, 470);
        } else if (destination.equalsIgnoreCase("crucible7-1")) {
            goTo(player, 300300000, 1785, 797, 470);
        } else if (destination.equalsIgnoreCase("crucible8-0")) {
            goTo(player, 300300000, 1776, 1728, 304);
        } else if (destination.equalsIgnoreCase("crucible8-1")) {
            goTo(player, 300300000, 1776, 1760, 304);
        } else if (destination.equalsIgnoreCase("crucible9-0")) {
            goTo(player, 300300000, 1357, 1748, 320);
        } else if (destination.equalsIgnoreCase("crucible9-1")) {
            goTo(player, 300300000, 1334, 1741, 316);
        } else if (destination.equalsIgnoreCase("crucible10-0")) {
            goTo(player, 300300000, 1750, 1255, 395);
        } else if (destination.equalsIgnoreCase("crucible10-1")) {
            goTo(player, 300300000, 1761, 1280, 395);
        } // Arena Of Chaos
        else if (destination.equalsIgnoreCase("arena of chaos1") || destination.equalsIgnoreCase("\u041e\u0440\u043e\u0448\u0430\u0435\u043c\u044b\u0435 \u043f\u043e\u043b\u044f \u043c\u0443-\u043c\u0443")) {
            goTo(player, 300350000, 1332, 1078, 340);
        } else if (destination.equalsIgnoreCase("arena of chaos2") || destination.equalsIgnoreCase("\u0420\u0443\u0445\u043d\u0443\u0432\u0448\u0430\u044f \u0431\u0430\u0448\u043d\u044f \u0432\u0435\u0442\u0440\u0430")) {
            goTo(player, 300350000, 599, 1854, 227);
        } else if (destination.equalsIgnoreCase("arena of chaos3") || destination.equalsIgnoreCase("\u041e\u0434\u0438\u0447\u0430\u0432\u0448\u0438\u0439 \u0441\u0430\u0434")) {
            goTo(player, 300350000, 663, 265, 512);
        } else if (destination.equalsIgnoreCase("arena of chaos4") || destination.equalsIgnoreCase("\u041f\u043b\u043e\u0449\u0430\u0434\u044c \u0441\u0440\u0430\u0436\u0435\u043d\u0438\u044f")) {
            goTo(player, 300350000, 1840, 1730, 302);
        } else if (destination.equalsIgnoreCase("arena of chaos5") || destination.equalsIgnoreCase("\u0428\u0442\u043e\u043b\u044c\u043d\u044f \u0410\u043b\u044c\u043a\u0432\u0438\u043c\u0438\u0438")) {
            goTo(player, 300350000, 1932, 1228, 270);
        } else if (destination.equalsIgnoreCase("arena of chaos6") || destination.equalsIgnoreCase("\u0420\u0430\u0437\u0440\u0443\u0448\u0435\u043d\u043d\u043e\u0435 \u0438\u043c\u0435\u043d\u0438\u0435 \u041a\u0430\u0441\u0443\u0441")) {
            goTo(player, 300350000, 1949, 946, 224);
        }
		/**
         * Miscellaneous
         */
        // Prison
        else if (destination.equalsIgnoreCase("prisonlf") || destination.equalsIgnoreCase("Prison Elyos") || destination.equalsIgnoreCase("\u0422\u044e\u0440\u044c\u043c\u0430 \u042d\u043b\u0438\u0439\u0446\u044b")) {
            goTo(player, 510010000, 256, 256, 49);
        } else if (destination.equalsIgnoreCase("prisondf") || destination.equalsIgnoreCase("Prison Asmos") || destination.equalsIgnoreCase("\u0422\u044e\u0440\u044c\u043c\u0430 \u0410\u0441\u043c\u043e\u0434\u0438\u0430\u043d\u0435")) {
            goTo(player, 520010000, 256, 256, 49);
        } // Test
        else if (destination.equalsIgnoreCase("test dungeon") || destination.equalsIgnoreCase("")) {//don`t work
            goTo(player, 300020000, 104, 66, 25);
        } else if (destination.equalsIgnoreCase("test basic") || destination.equalsIgnoreCase("")) {
            goTo(player, 900020000, 144, 136, 20);
        } else if (destination.equalsIgnoreCase("test server") || destination.equalsIgnoreCase("")) {
            goTo(player, 900030000, 228, 171, 49);
        } else if (destination.equalsIgnoreCase("test giantmonster") || destination.equalsIgnoreCase("")) {
            goTo(player, 900100000, 196, 187, 20);
        } // Unknown
        else if (destination.equalsIgnoreCase("idabpro") || destination.equalsIgnoreCase("")) {
            goTo(player, 300010000, 270, 200, 206);
        } // GM zone
        else if (destination.equalsIgnoreCase("gm") || destination.equalsIgnoreCase("\u0413\u041c")) {
            goTo(player, 120020000, 1442, 1133, 302);
        }
		/**
         * 2.5 Maps
         */
        else if (destination.equalsIgnoreCase("kaisinel academy") || destination.equalsIgnoreCase("\u0421\u0432\u044f\u0449\u0435\u043d\u043d\u0430\u044f \u0430\u0440\u0435\u043d\u0430 \u041a\u0430\u0439\u0441\u0438\u043d\u0435\u043b\u044f")) {
            goTo(player, 110070000, 459, 251, 128);
        } else if (destination.equalsIgnoreCase("marchutan priory") || destination.equalsIgnoreCase("\u0421\u0432\u044f\u0449\u0435\u043d\u043d\u0430\u044f \u0430\u0440\u0435\u043d\u0430 \u041c\u0430\u0440\u043a\u0443\u0442\u0430\u043d\u0430")) {
            goTo(player, 120080000, 577, 250, 94);
        } else if (destination.equalsIgnoreCase("esoterrace") || destination.equalsIgnoreCase("\u0410\u0440\u0430\u043a\u0430")) {
            goTo(player, 300250000, 333, 437, 326);
        }
		/**
         * 3.0 Maps
         */
        else if (destination.equalsIgnoreCase("pernon") || destination.equalsIgnoreCase("\u0424\u0435\u0440\u043d\u043e\u043d")) {
            goTo(player, 710010000, 1069, 1539, 98);
        } else if (destination.equalsIgnoreCase("oriel") || destination.equalsIgnoreCase("\u042d\u043b\u0438\u0430\u043d")) {
            goTo(player, 700010000, 1261, 1845, 98);
        } else if (destination.equalsIgnoreCase("sarpan") || destination.equalsIgnoreCase("\u0421\u0430\u0440\u0444\u0430\u043d")) {
            goTo(player, 600020000, 1374, 1455, 600);
        } else if (destination.equalsIgnoreCase("tiamaranta") || destination.equalsIgnoreCase("\u0422\u0438\u0430\u043c\u0430\u0440\u0430\u043d\u0442\u0430")) {
            goTo(player, 600030000, 40, 1732, 297);
        } else if (destination.equalsIgnoreCase("tiamaranta eye") || destination.equalsIgnoreCase("\u041e\u043a\u043e \u0422\u0438\u0430\u043c\u0430\u0440\u0430\u043d\u0442\u044b")) {
            goTo(player, 600040000, 159, 768, 1202);
        } else if (destination.equalsIgnoreCase("steel rake cabin") || destination.equalsIgnoreCase("Steel Rake Solo") || destination.equalsIgnoreCase("")) {//don`t work
            goTo(player, 300460000, 248, 244, 189);
        } else if (destination.equalsIgnoreCase("aturam") || destination.equalsIgnoreCase("Aturam Sky Fortress") || destination.equalsIgnoreCase("\u0412\u043e\u0437\u0434\u0443\u0448\u043d\u0430\u044f \u043a\u0440\u0435\u043f\u043e\u0441\u0442\u044c \u0410\u0442\u0443\u0440\u0430\u043c")) {
            goTo(player, 300240000, 636, 446, 655);
        } else if (destination.equalsIgnoreCase("elementis") || destination.equalsIgnoreCase("Elementis Forest") || destination.equalsIgnoreCase("\u041b\u0435\u0441 \u0420\u0430\u0442\u0442\u0438\u0441")) {
            goTo(player, 300260000, 176, 612, 231);
        } else if (destination.equalsIgnoreCase("argent") || destination.equalsIgnoreCase("Argent Manor") || destination.equalsIgnoreCase("\u0420\u0435\u0437\u0438\u0434\u0435\u043d\u0446\u0438\u044f \u0414\u043e\u0440\u043a\u0435\u043b\u044c")) {
            goTo(player, 300270000, 1005, 1089, 70);
        } else if (destination.equalsIgnoreCase("rentus") || destination.equalsIgnoreCase("Rentus Base") || destination.equalsIgnoreCase("\u0411\u0430\u0437\u0430 \u0420\u0435\u043d\u0442\u0430\u0441\u0430")) {
            goTo(player, 300280000, 579, 606, 153);
        } else if (destination.equalsIgnoreCase("raksang") || destination.equalsIgnoreCase("\u0422\u0430\u043c\u0430\u0440\u044d\u0441")) {
            goTo(player, 300310000, 665, 735, 1188);
        } else if (destination.equalsIgnoreCase("muada") || destination.equalsIgnoreCase("Muada's Trencher") || destination.equalsIgnoreCase("\u0413\u043d\u0435\u0437\u0434\u043e \u0432\u043b\u0430\u0434\u044b\u043a\u0438 \u043f\u0435\u0441\u0430\u043a\u0430")) {
            goTo(player, 300380000, 492, 553, 106);
        } else if (destination.equalsIgnoreCase("satra") || destination.equalsIgnoreCase("\u0421\u0435\u043a\u0440\u0435\u0442\u043d\u043e\u0435 \u0445\u0440\u0430\u043d\u0438\u043b\u0438\u0449\u0435 \u0421\u0438\u0442\u0440\u044b")) {
            goTo(player, 300470000, 510, 180, 159);
        } else if (destination.equalsIgnoreCase("farm") || destination.equalsIgnoreCase("\u041e\u043a\u043e \u0422\u0438\u0430\u043c\u0430\u0440\u0430\u043d\u0442\u044b 1")) {
            goTo(player, 300400000, 433.27f, 685.31f, 183.4f);
        }
		/**
         * 3.5
         */
        else if (destination.equalsIgnoreCase("dragonlord") || destination.equalsIgnoreCase("\u041f\u0440\u0438\u0441\u0442\u0430\u043d\u0438\u0449\u0435 \u041b\u043e\u0440\u0434\u0430 \u0431\u0430\u043b\u0430\u0443\u0440\u043e\u0432")) {
            goTo(player, 300520000, 506, 516, 242);
        } else if (destination.equalsIgnoreCase("tiamat") || destination.equalsIgnoreCase("Tiamat") || destination.equalsIgnoreCase("\u041a\u0440\u043e\u0432\u0430\u0432\u044b\u0439 \u0442\u0440\u043e\u043d")) {
            goTo(player, 300520000, 495, 528, 417);
        } else if (destination.equalsIgnoreCase("stronghold") || destination.equalsIgnoreCase("Stronghold")) { //3.9
		    goTo(player, 300510000, 1581, 1068, 492);
		}
		/**
         * 3.7 Instances
         */
        else if (destination.equalsIgnoreCase("hexway") || destination.equalsIgnoreCase("")) {
            goTo(player, 300700000, 682, 607, 320);
        } else if (destination.equalsIgnoreCase("shugotomb") || destination.equalsIgnoreCase("")) {
            goTo(player, 300560000, 178, 234, 543);
        } else if (destination.equalsIgnoreCase("unity") || destination.equalsIgnoreCase("Unity Training Grounds")) { //need check zone
            goTo(player, 301100000, 500, 371, 211);
        }
		/**
         * 4.0 fortress
         */
        else if (destination.equalsIgnoreCase("silus") || destination.equalsIgnoreCase("5011") || destination.equalsIgnoreCase("\u0421\u0435\u0432\u0435\u0440\u043d\u044b\u0439 \u041a\u0430\u0442\u0430\u043b\u0430\u043c")) {
            goTo(player, 600050000, 2019, 1752, 308);
        } else if (destination.equalsIgnoreCase("bassen") || destination.equalsIgnoreCase("6011") || destination.equalsIgnoreCase("\u042e\u0436\u043d\u044b\u0439 \u041a\u0430\u0442\u0430\u043b\u0430\u043c")) {
            goTo(player, 600060000, 1472, 740, 67);
        } else if (destination.equalsIgnoreCase("pradeth") || destination.equalsIgnoreCase("6021") || destination.equalsIgnoreCase("\u041a\u0440\u0435\u043f\u043e\u0441\u0442\u044c \u041f\u0430\u0440\u0430\u0434\u0435\u0441")) {
            goTo(player, 600060000, 2586, 2634, 277);
        }
		/**
         * 4.0 Maps
         */
        else if (destination.equalsIgnoreCase("katalamely") || destination.equalsIgnoreCase("\u0412\u043e\u0441\u0441\u0442\u0430\u043d\u043e\u0432\u043b\u0435\u043d\u043d\u0430\u044f \u0411\u0430\u0448\u043d\u044f \u0441\u0432\u0435\u0442\u0430")) {
            goTo(player, 600050000, 398, 2718, 142);
        } else if (destination.equalsIgnoreCase("katalamasmo") || destination.equalsIgnoreCase("\u0412\u043e\u0441\u0441\u0442\u0430\u043d\u043e\u0432\u043b\u0435\u043d\u043d\u0430\u044f \u0411\u0430\u0448\u043d\u044f \u0441\u0432\u0435\u0442\u0430")) {
            goTo(player, 600050000, 361, 383, 281);	
        } else if (destination.equalsIgnoreCase("danaria") || destination.equalsIgnoreCase("\u041f\u043e\u0440\u0442 \u041f\u0430\u043d\u0434\u0430\u0440\u0443\u043d\u0441\u0430")) {
            goTo(player, 600060000, 2545, 1699, 141);
        } else if (destination.equalsIgnoreCase("danariaely") || destination.equalsIgnoreCase("\u041f\u043e\u0440\u0442 \u041f\u0430\u043d\u0434\u0430\u0440\u0443\u043d\u0441\u0430")) {
            goTo(player, 600060000, 63, 1927, 519);		
        } else if (destination.equalsIgnoreCase("danariaasmo") || destination.equalsIgnoreCase("\u041f\u043e\u0440\u0442 \u041f\u0430\u043d\u0434\u0430\u0440\u0443\u043d\u0441\u0430")) {
            goTo(player, 600060000, 58, 1587, 520);				
        } else if (destination.equalsIgnoreCase("idianely") || destination.equalsIgnoreCase("\u041d\u043e\u0432\u044b\u0439 \u0440\u0430\u0439\u043e\u043d \u043f\u043e\u0434\u0437\u0435\u043c\u043d\u043e\u0433\u043e \u041a\u0430\u0442\u0430\u043b\u043c\u0430")) {
            goTo(player, 600070000, 695, 700, 515);
        } else if (destination.equalsIgnoreCase("idianasmo") || destination.equalsIgnoreCase("\u041d\u043e\u0432\u044b\u0439 \u0440\u0430\u0439\u043e\u043d \u043f\u043e\u0434\u0437\u0435\u043c\u043d\u043e\u0433\u043e \u041a\u0430\u0442\u0430\u043b\u043c\u0430")) {
            goTo(player, 600070000, 690, 846, 515);
        } else if (destination.equalsIgnoreCase("iu") || destination.equalsIgnoreCase("\u0417\u0430\u043b \u0434\u043b\u044f \u0432\u0435\u0447\u0435\u0440\u0438\u043d\u043e\u043a")) {
            goTo(player, 600080000, 1510, 1511, 565);
        }
		/**
         * 4.3 Instances
         */
        else if (destination.equalsIgnoreCase("mystic") || destination.equalsIgnoreCase("Danuar Mysticarium")) {
            goTo(player, 300480000, 179, 122, 231);
        } else if (destination.equalsIgnoreCase("idgel") || destination.equalsIgnoreCase("Idgel Research Center") || destination.equalsIgnoreCase("")) {
            goTo(player, 300530000, 571, 472, 102);
        } else if (destination.equalsIgnoreCase("eternal") || destination.equalsIgnoreCase("Eternal Bastion") || destination.equalsIgnoreCase("")) {
            goTo(player, 300540000, 763, 268, 233);
        } else if (destination.equalsIgnoreCase("cube") || destination.equalsIgnoreCase("Void Cube") || destination.equalsIgnoreCase("")) {
            goTo(player, 300580000, 181, 261, 310);
        } else if (destination.equalsIgnoreCase("ophidan") || destination.equalsIgnoreCase("Ophidan Bridge") || destination.equalsIgnoreCase("")) {
            goTo(player, 300590000, 760, 561, 580);
        } else if (destination.equalsIgnoreCase("infinity") || destination.equalsIgnoreCase("Infinity Shard") || destination.equalsIgnoreCase("")) {
            goTo(player, 300800000, 118, 115, 131);
        } else if (destination.equalsIgnoreCase("runadium") || destination.equalsIgnoreCase("Runadium") || destination.equalsIgnoreCase("")) {
            goTo(player, 300900000, 163, 130, 158);
        } else if (destination.equalsIgnoreCase("solo") || destination.equalsIgnoreCase("Solo Q") || destination.equalsIgnoreCase("")) {
            goTo(player, 301000000, 535, 443, 96);
        } else if (destination.equalsIgnoreCase("steelsolo1") || destination.equalsIgnoreCase("Steel Rose Solo 1st Deck") || destination.equalsIgnoreCase("")) {
            goTo(player, 301010000, 283, 452, 902);
        } else if (destination.equalsIgnoreCase("steelsolo2") || destination.equalsIgnoreCase("Steel Rose Solo 2nd Deck") || destination.equalsIgnoreCase("")) {
            goTo(player, 301020000, 236, 506, 948);
        } else if (destination.equalsIgnoreCase("steel1") || destination.equalsIgnoreCase("Steel Rose 1st Deck") || destination.equalsIgnoreCase("")) {
            goTo(player, 301030000, 283, 452, 902);
        } else if (destination.equalsIgnoreCase("steel2") || destination.equalsIgnoreCase("Steel Rose 2nd Deck") || destination.equalsIgnoreCase("")) {
            goTo(player, 301040000, 236, 506, 948);
        } else if (destination.equalsIgnoreCase("steel3") || destination.equalsIgnoreCase("Steel Rose 3rd Deck") || destination.equalsIgnoreCase("")) {
            goTo(player, 301050000, 713, 462, 1015);
        } else if (destination.equalsIgnoreCase("reliquary") || destination.equalsIgnoreCase("Danuar Reliquary") || destination.equalsIgnoreCase("")) {
            goTo(player, 301110000, 256, 257, 241);
        } else if (destination.equalsIgnoreCase("kamar") || destination.equalsIgnoreCase("Kamar Battlefield") || destination.equalsIgnoreCase("")) {
            goTo(player, 301120000, 1374, 1455, 600);
        } else if (destination.equalsIgnoreCase("sauro") || destination.equalsIgnoreCase("Sauro Supply Base") || destination.equalsIgnoreCase("")) {
            goTo(player, 301130000, 641, 176, 195);
        } else if (destination.equalsIgnoreCase("danuar") || destination.equalsIgnoreCase("Danuar Sanctuary") || destination.equalsIgnoreCase("")) {
            goTo(player, 301140000, 388, 1184, 55);
        } else if (destination.equalsIgnoreCase("asteriasolo") || destination.equalsIgnoreCase("Asteria IU Solo")) { //need fix zone
            goTo(player, 301150000, 500, 500, 500);
        } else if (destination.equalsIgnoreCase("asteriaparty") || destination.equalsIgnoreCase("Asteria IU Party")) { //need check zone
            goTo(player, 301160000, 500, 500, 500);
        } else if (destination.equalsIgnoreCase("idgel2") || destination.equalsIgnoreCase("Idgel Research Center (Legion)") || destination.equalsIgnoreCase("")) {
            goTo(player, 301170000, 571, 472, 102);
        } else if (destination.equalsIgnoreCase("cube2") || destination.equalsIgnoreCase("Cube Void (Legion)") || destination.equalsIgnoreCase("")) {
            goTo(player, 301180000, 181, 261, 310);
        } else if (destination.equalsIgnoreCase("mystic2") || destination.equalsIgnoreCase("Danuar Mysticarium (Legion)") || destination.equalsIgnoreCase("")) {
            goTo(player, 301190000, 179, 122, 231);
        } else if (destination.equalsIgnoreCase("asteriaworld") || destination.equalsIgnoreCase("Asteria IU World")) { //need check zone
            goTo(player, 301200000, 500, 500, 500);
        }
		/**
         * 4.3 Instances
         */
        else if (destination.equalsIgnoreCase("ophidan2") || destination.equalsIgnoreCase("Ophidan Bridge War")) {
            goTo(player, 301210000, 773, 553, 576);
        }
		/**
         * All Bases Katalam
         */
        else if (destination.equalsIgnoreCase("71") || destination.equalsIgnoreCase("Base 71") || destination.equalsIgnoreCase("")) {
            goTo(player, 600050000, 225, 835, 216);
        } else if (destination.equalsIgnoreCase("72") || destination.equalsIgnoreCase("Base 72") || destination.equalsIgnoreCase("")) {
            goTo(player, 600050000, 138, 2208, 184);
        } else if (destination.equalsIgnoreCase("73") || destination.equalsIgnoreCase("Base 73") || destination.equalsIgnoreCase("")) {
            goTo(player, 600050000, 1110, 511, 184);
        } else if (destination.equalsIgnoreCase("73") || destination.equalsIgnoreCase("Base 73") || destination.equalsIgnoreCase("")) {
            goTo(player, 600050000, 1110, 511, 184);
        } else if (destination.equalsIgnoreCase("74") || destination.equalsIgnoreCase("Base 74") || destination.equalsIgnoreCase("")) {
            goTo(player, 600050000, 844, 2759, 182);
        } else if (destination.equalsIgnoreCase("75") || destination.equalsIgnoreCase("Base 75") || destination.equalsIgnoreCase("")) {
            goTo(player, 600050000, 1571, 1472, 129);
        } else if (destination.equalsIgnoreCase("76") || destination.equalsIgnoreCase("Base 76") || destination.equalsIgnoreCase("")) {
            goTo(player, 600050000, 1686, 1121, 200);
        } else if (destination.equalsIgnoreCase("77") || destination.equalsIgnoreCase("Base 77") || destination.equalsIgnoreCase("")) {
            goTo(player, 600050000, 1544, 2260, 200);
        } else if (destination.equalsIgnoreCase("78") || destination.equalsIgnoreCase("Base 78") || destination.equalsIgnoreCase("")) {
            goTo(player, 600050000, 1902, 1179, 259);
        } else if (destination.equalsIgnoreCase("79") || destination.equalsIgnoreCase("Base 79") || destination.equalsIgnoreCase("")) {
            goTo(player, 600050000, 2492, 1830, 325);
        }
		/**
         * All Bases Danaria
         */
        else if (destination.equalsIgnoreCase("80") || destination.equalsIgnoreCase("Base 80") || destination.equalsIgnoreCase("")) {
            goTo(player, 600060000, 968, 1168, 373);
        } else if (destination.equalsIgnoreCase("81") || destination.equalsIgnoreCase("Base 81") || destination.equalsIgnoreCase("")) {
            goTo(player, 600060000, 1043, 1811, 362);
        } else if (destination.equalsIgnoreCase("82") || destination.equalsIgnoreCase("Base 82") || destination.equalsIgnoreCase("")) {
            goTo(player, 600060000, 1046, 2248, 276);
        } else if (destination.equalsIgnoreCase("83") || destination.equalsIgnoreCase("Base 83") || destination.equalsIgnoreCase("")) {
            goTo(player, 600060000, 2803, 598, 275);
        } else if (destination.equalsIgnoreCase("84") || destination.equalsIgnoreCase("Base 84") || destination.equalsIgnoreCase("")) {
            goTo(player, 600060000, 2658, 489, 234);
        } else if (destination.equalsIgnoreCase("85") || destination.equalsIgnoreCase("Base 85") || destination.equalsIgnoreCase("")) {
            goTo(player, 600060000, 1814, 803, 153);
        } else if (destination.equalsIgnoreCase("86") || destination.equalsIgnoreCase("Base 86") || destination.equalsIgnoreCase("")) {
            goTo(player, 600060000, 1517, 1129, 92);
        } else if (destination.equalsIgnoreCase("87") || destination.equalsIgnoreCase("Base 87") || destination.equalsIgnoreCase("")) {
            goTo(player, 600060000, 1333, 2330, 183);
        } else if (destination.equalsIgnoreCase("88") || destination.equalsIgnoreCase("Base 88") || destination.equalsIgnoreCase("")) {
            goTo(player, 600060000, 2130, 2473, 268);
        } else if (destination.equalsIgnoreCase("89") || destination.equalsIgnoreCase("Base 89") || destination.equalsIgnoreCase("")) {
            goTo(player, 600060000, 2609, 2209, 249);
        } else if (destination.equalsIgnoreCase("dance") || destination.equalsIgnoreCase("")) {
            goTo(player, 600080000, 1532, 1511, 565);
        }
		/**
         * Instance 4.3
         */
        else if (destination.equalsIgnoreCase("jormungand") || destination.equalsIgnoreCase("\u0412\u0445\u043e\u0434 \u043c\u043e\u0441\u0442 \u0419\u043e\u0440\u043c\u0443\u043d\u0433\u0430\u043d\u0434\u0430")) {
            goTo(player, 600070000, 1058, 966, 566);
        } else if (destination.equalsIgnoreCase("katalamadzh") || destination.equalsIgnoreCase("\u0412\u0445\u043e\u0434 \u041a\u0430\u0442\u0430\u043b\u0430\u043c\u0430\u0434\u0436")) {
            goTo(player, 600070000, 1272, 767, 563);
        } else if (destination.equalsIgnoreCase("rounov") || destination.equalsIgnoreCase("\u0412\u0445\u043e\u0434 \u041f\u0440\u0438\u0431\u0435\u0436\u0438\u0449\u0435 \u0440\u0443\u043d\u043e\u0432")) {
            goTo(player, 600070000, 369, 519, 567);
        } else if (destination.equalsIgnoreCase("runadium") || destination.equalsIgnoreCase("\u0412\u0445\u043e\u0434 \u0420\u0443\u043d\u0430\u0434\u0438\u0443\u043c")) {
            goTo(player, 600070000, 203, 768, 540);
        } else if (destination.equalsIgnoreCase("rose") || destination.equalsIgnoreCase("\u0412\u0445\u043e\u0434 \u0421\u0442\u0430\u043b\u044c\u043d\u043e\u0439 \u0440\u043e\u0437\u044b")) {
            goTo(player, 600060000, 2515, 1728, 137);
        } else {
            PacketSendUtility.sendMessage(player, "\u041d\u0435 \u0443\u0434\u0430\u043b\u043e\u0441\u044c \u043d\u0430\u0439\u0442\u0438 \u0443\u043a\u0430\u0437\u0430\u043d\u043d\u044b\u0439 \u043f\u0443\u043d\u043a\u0442 \u043d\u0430\u0437\u043d\u0430\u0447\u0435\u043d\u0438\u044f!");
        }
    }

    private static void goTo(final Player player, int worldId, float x, float y, float z) {
        WorldMap destinationMap = World.getInstance().getWorldMap(worldId);
        if (destinationMap.isInstanceType()) {
            TeleportService2.teleportTo(player, worldId, getInstanceId(worldId, player), x, y, z, (byte) 0, TeleportAnimation.BEAM_ANIMATION);
        } else {
            TeleportService2.teleportTo(player, worldId, x, y, z, (byte) 0, TeleportAnimation.BEAM_ANIMATION);
        }
    }

    private static int getInstanceId(int worldId, Player player) {
        if (player.getWorldId() == worldId) {
            WorldMapInstance registeredInstance = InstanceService.getRegisteredInstance(worldId, player.getObjectId());
            if (registeredInstance != null) {
                return registeredInstance.getInstanceId();
            }
        }
        WorldMapInstance newInstance = InstanceService.getNextAvailableInstance(worldId);
        InstanceService.registerPlayerWithInstance(newInstance, player);
        return newInstance.getInstanceId();
    }

    public static void setTeleportTask(Player player, int worldId, int x, int y, int z) {
        player.setTeleportTask(new TeleportTask(worldId, 1, x, y, z, 1));
    }

    public static void setTeleportTask(Player player, int instanceId, int worldId, int x, int y, int z) {
        player.setTeleportTask(new TeleportTask(worldId, instanceId, x, y, z, 1));
    }

    public static void ss(Player player, int world_id, int x, int y, int z, boolean text) {
        if (player.getAccessLevel() == 0 && !player.isDeveloper()) {
            Skill skill = SkillEngine.getInstance().getSkill(player, 1801, 1, player);
            skill.useSkill();
            setTeleportTask(player, world_id, x, y, z);
        } else {
            goTo(player, world_id, x, y, z);
            if (text) {

            }
        }
    }

    @Override
    public void onFail(Player player, String message) {
        PacketSendUtility.sendMessage(player, "Syntax : //goto <location>");
    }
}