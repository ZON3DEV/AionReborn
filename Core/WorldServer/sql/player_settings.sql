-- MySQL dump 10.13  Distrib 5.5.37, for Win32 (x86)
--
-- Host: 192.168.178.55    Database: al_server_gs
-- ------------------------------------------------------
-- Server version	5.7.37-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `player_settings`
--

DROP TABLE IF EXISTS `player_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player_settings` (
  `player_id` int(11) NOT NULL,
  `settings_type` tinyint(1) NOT NULL,
  `settings` blob NOT NULL,
  PRIMARY KEY (`player_id`,`settings_type`) USING BTREE,
  CONSTRAINT `ps_pl_fk` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player_settings`
--

LOCK TABLES `player_settings` WRITE;
/*!40000 ALTER TABLE `player_settings` DISABLE KEYS */;
INSERT INTO `player_settings` (`player_id`, `settings_type`, `settings`) VALUES (115953,-2,'0'),(115953,-1,'0'),(115953,0,'â\r\0\0,S\0\0xœÍ\\Ër»E¶©Ê?¨îþ&Ì»êF·lÉÎ.«dÍ¢DêQ\")F¤,Ë?—_K£ïAc@ù.R,›ÃÁéÓ@wã\rè¿âOâ7ñ»ø.vb+.Ä7±/â(Å³Ø‹¿‹_D%þ*ð}){qï×º÷˜úoñ/ñUü\n¨~ý..Å_ÄŸñYÄI³íÛx^‚äJ¼ÂÿxÞÃÓÒO õÞü&þ–AË-¤ìàí¾¿Ã·ÊÏ.…Dy>=”?À÷¾Ui¨Ü\'øõ\0y~w?0ï+°Ê¥¸Ãï£Îßùò%zÍÓ#âÎÕ:•u¾@nîòø¬\'ÖJ!Ç¼ß\0êÙúT•“¬ªJûr	1 áq–I”óWÈ_‰¦˜¿:‹_êüËb~y­ùëbþú,þùK¹›³¸[/VÊÐåÜ ËmÒÅÝº<^ú³¸@·ÅÜÃYÜ# »bî1âÞÂû[ñ”h?ÂT_f¨{øV­ûy/¡U÷?×ðùŸkx–»ëÊ\'¨Å*U}ûÏH¿‚R_ƒUGxúß×ð=Â»/ð¤j²Â~†ïÏ?ù|>¾örêcTn®@7=KÌ=÷P†qò<@¾¿Ú·_­¤ÿ¼Ðóü5ùñùÿ˜Oœ‡?’ûÿï£âe»²å]D1æ?û˜ÇÅmÊfþ;zVñÚ@ô\\OòpNLöGŸ š¾—ÏÙ\0ßøßÅ$éuõ3Uýšz‚:}ãáT[°Ä¾´ÅZå˜xä<_UÌ÷²i”é]‡Y¾¸WM£ê¨·ãQó\\ª/\\ÌrÅ=f\ZÕqÅ=d\ZÕqÅ=bŒR1D^ÿ¢PÅZ–Sí°ú×T[ÝÂwŸÑåXæuU]#xµvX/\Zø7¯k.®¥¢eÄQg%èàÿK¢J6`mkàWô¦<Ó¼¾Z—MâHNiR}JÚZÔÕcéª`¼ÄsÍkœ‹N‡šçš‹N‡šçš‹N‡JqíqÎ±A?_@Ú\Z~«45£43Á_@öŸØîp3Õå³Ìé‘Y=W g*5§‡‹‡¨³zþ³¬W˜aå´p‘áMVKŽ›‹‡h?ÌÍEŽCtææ\"éˆóí7þ*B—g’…L\\48D]ÈÄyÜ!\Zf<ŸFæ¹Úb.Î£ÑsÅ|ÃŒµN}é[\\XD-KWÂWòÅqÁád!_®.ä‹c„ÃÅ=FWÂ÷\Z9\\	_Üsäp<ßWØ68Týüˆ£&rŽu…ë˜ª}¡_8¿>Âüø\"z›¨½ó)öW@¨ú°Å_eü¼Œ¯AYê×N‘U#‡‰y€9âš‰Ô£55Æ‘“AiÕsª5ÉÌ§Z•P3µZq˜”/%Æ5¼Q#µú{ÂQ„j]áÝ~ÒÖä±†ïß*mq}ôI,qEeVˆóhâÜˆïzvåxÁç£-YZ[\rçÉ’>ÅðMÐºò	mGõä×j©çœÃ¦G´¸Z-V5Dá×‘Ÿ8ŒaP+H*:ŸÑêK/6Tm8àÛ¸Ô¥RNÇ T)î1gj?¡ò¢¯ƒš[Pí7\Zò29nùnYÈ]€».än>ÀÝd¹]}þ[ÜÑ¶\'ó8â»Ç…Ð§\"i­#é$Þu,RîæP†Ë¤û:ýý%“»ä”“F*.OÓ’yÀ¶jõj…cX•[µ·ôÕŸ<Ò±½b[¼ÇìkÊ-¾¥à~o!ïd¡5|Þ±®¬m^ŽÃäãU—ÕX=¬·Ót’£ž•v›N¸[´ÿAQóÖÛ“»Â5·>§Vì®ìïÏØw»ô\ZWÝüõ¼ßº5Àçõá:¬KoËÉzl`~Èçä¿@|ù×éF/?j…ù“ý]Dé•]»+·†³Þ7ÝÖÓ*¾?×YdgI×ð}‡=žj£/ w¯àÝÍGŽ·L~Nnô]èZ7ÇU¦sn~ntÊ²Pg~®îtÖ:ë¬NÓ\Z©–ªeÙŠg2mŸ§°Õzj/÷PØKÏ¡ç»£ÁB´?ÿÛ[´¤ZkÐŽ¾Ì%Æöm*qµlaõ¾ã8Æ<UN28àÔžK\ZW[\\ëÐ5ƒkó×i\\§×2§ˆ^#\Z6OƒF´¬–Ñ\"*ÖN‹álTY+µz?4…©-¦e1Åt,¦µÎ2•µ^£wRc¿\n[p5x(^Ÿ±ãÀÚQZ;ò1$mTòº¤µ5cÒÚºcm-­­;ÖFÒ³5¯ËØz®†HkË>Ã6ZIµµdÏ–®¶–ì35ÖY’«µµd…kþª±L¼¶Îæˆómmc²gã¨ö¬Èå§±ªìNA\nUy(Î#µ’;“BÕŠóJcíTaåP­‡âlÕX{Vèe,Êù¥ñjx•A5²m­Ý‡ÆE&u­góËÀÙ½õú^cãå×é¬>°öl­Õs×²ò½à`yø²øvªóâ]²:;kù†ÕÙYËóˆÚ\"*ŒU×8.Ú;kwÂqñÞy}Z•é×:o\\PeÆõ@ƒ5–‡ŒŽk—zëÂqÑØ{^¨2ýJïy¢Êx¬÷ü!q—”Ã5Ž×kü1`É—·p|yû\0Çë_Þ1Àqå‚¶ˆ¿ÁsÈLü\r^o)3ñ7XŽ›6Ž‹¿ÁóG_\rž?êL¯?x­S‡þà<2x=!9ŸQKU³^½–ªÓg\n8d!9ÏŒQoQ³¾½^šœ•F¯Ïè0\ZùD!9^MÚ¹:3Z{òÞ¡µƒâgkÇ.3§XxÑ˜C¹ŒÙ“‹1™Å¹±?·Zx5žŸ9UAdµ™ÑaåÍúÌüH1Ðb©ø¹”?ïæQ~L×Y[÷A;²ÈXÑ¯S’Ó*¨QË\'½Ù£}qœ2˜EÒ%‡\",Ÿ7”™Q©ôæT>ó«2j£ÚÌ¬¯b©±çêÒXñòžºÀüxïBcò±!-ßÒÑ,™´ñ©-?Ûn,†÷‚É9?×lnªìyôp|ÜÕÚÞÇÏ«\0ÇÏ–e€ËÏs\rŽoh®ëø¸6œæ»Î.ü¼xørme˜ÃÒé–™y¦i¥].ùsø«T^ìQ‰¸:!õº‘AÊ(vhíÓüv+¦&Eííßá*«Ú5ØáÊ+í\rïõ®N¼B[\"AÜ;<°ìpMßûø=¾¥S\r÷âY¤n\"åŽkowÒÕ:²Â¦n%äŽë wö¸*mFF>N5r¼CvÀUõ½p;â\'í¹\ZkÌBßgh0\"jÍš“uü´ºÇ¾woWµÂºÝãŠ›™{äðÄ¨ô¼Ù¹ÌâŸPþïÚ)¾2´»·AO­ì-’7x£¼ïï\\æpÄD§NQi{lóhžJu%…3}ÂÎT¸Óa^r8Ã¤öß±¤*ïðÈ÷¢7‚nŒÓ®„OòÉ¾°6æ1†GÅžÙçYzm€:K²Ásª5ˆëV¹\\ZÏNï/oôó7Ä†>*‘ v?ôQŸ~quªÁ®Qï»Žú4·´oÌJDžÅi¢“;7zïÝøÆX=‡à8T©ÑyÚS¥¾‘v©Ìºé9òçi¬Ä¥>{Þê•+/?§‘j¬¹7PÍðûèRæê,æ|žMË·ˆ¢s;ÏŸ)žÃÎ3ÊI-CÏsÖgqÖEœÓóÆshâ¤ÓlO\"w*iŠ1²êäÞƒ>–:}çûbM¬Gx¯Zê×Ô‰#w‰gAh”œC¥xÞðÍ	´izyeXè~øI·¾þL¿t9œÏô†ýâ\rhs7%–XÛw‹•IÄìê<‘9¥™ãœâb¦5¼¿OÔÓ4‚“Žëd\ZÁIÇgûÓNzZÓÒ˜Xþ[³…¸´Q2MIË¸Óë©”´ŒdeRe£w<•Ë˜¾}‰=ñJ\"ÒvMc§Œ4Rt£¡e0†4c#^K©|¬9<•fO¡J¥ò±™:•Jåã3u¾)•\Zß9á0<CSÀŠŠð&ÐC›eè\nº,C_ÀÐ\'£êþÀašs”›ÉYÏsä¦š¶øNhž!|Îjš“‹5ÑYõi4Z_ëüÒ,Þ¬¤µ•ÉÆ\Zxzî‡=;›«¼®°7ãu–JÇZOXãÕ8þ„½ÜOÇÒl¡Do¹ü9šÝÝ\rÿ¯Ú|$S>7?£N£Kõû\r\Z;¹Ó¯9\n¥<ºÅµ±¸ý8Ó4/á;•bdhüC)çÜâ8GÒèR÷>zT·œŒ§cÌ¡\rë;Úf#è/Ý÷ø´Ö-éÙK°yÞzcçÍ¥KÄF–û«L~¹9ŒaPw[Ì¨ô	©yæ‘†óY¼ÛÕ¦Ž ^°,Ïàó»‰ççñ)^óW–öv…$Ï›Â§xp†±Aídñ—æ´„á¦ìWŒOýK›Ém¡R_WWTßùj[7“š–èc,ey0³ÒZï)·Þ®K©l™&wâû¼òÅ\'ÅOzeôE÷QtV·×\\qš‘yC»Pßb¯ú\ZZ}!«©ûùûÚe,ó:UŸ°œ×è8RúÂ™¹Qœ£-Í`t©ö™0+ÝîÜaþÌ˜ÌìïÍáB6ºË³N¶¼yñüÀÚ¸n&¾›âVIä*•	¤LâRœ2ÉY\'u×$pM„ÛâÛV,µ…¨­ó¥ÒˆG\\ÿ}\nÃào&ø;½WÑakÊL}´µÞ ]R:Wãêù0‘æN½æÍ¼±´ëQë¼™Á®v›“¶!zÊ0µ\\Ê÷Û„ï·	ßo¾ß&|ïüyÐ£èP&•nökS½Rˆÿ»§s'),(115953,1,'k\0\0¶\0\0xœ•TÛNƒ@=¾šøÄw……—¤¶©Ö~>7\Z+Õ¢¦ç¯yX„îÂ@$.3svÎÌììþàÌ°Ç6ððGìã[d¸Ä)ÎðëÑ“!¥ýÞOÆ{‡[,qFTLm†)NpÌˆ[¼ãó/J^[S<ãÞ¬ÎñÊï†2åÊ1l5ô°¡·¶,)¶~ÓX¯i	˜q¥/h	ÌÓÅ×æ/E‰Ö&_`ê³±Qoœ¾ÚÊúâF=Ú‰âŠï¤‡Ï•¹ƒ•üã†îæ«M¿çÿæS¸nÕlKl|ÊÒ#G×Ü±!|ÓÝéÎçÊ~Çd—Sÿ/ZRÚ×Äì°rNÇŠçjoa×üxÚBfàÕ\rKé­PªF§/¡…Hø(9˜búÚ˜Q‰ø¯DbEÑfG¤|ÛuIlÊ©¬œm©¶Àø«¼û%wBu ¥LCÓ9	}!¢#]Ükt¹¿þ iðÅ{øq6«Ÿ'),(115953,2,'’\0\0\0\0\0\0xœŽ1‚@DŸ-	w öˆ6T\n\'š €’à.q•Àé¼š#++³ÅîógfŸ,Ø’2p¥% §â†£ÁbØ±dÃŠµî@Šá$^J5œ\'5ãÀžP[±¦”O‰–Žû\'Å}éEócJûsj\n5Z56Ú®DŽÒKQïVÔ‰\'rF{çæèçàÉÇ,'),(117460,-2,'0'),(117460,-1,'0'),(117460,0,'{\r\0\0ìQ\0\0xœÍ\\Ën+¹e¶òÆì\'Q³ßÀÄƒû:»¬’µ [ò–dÅ’¯¯ïÏå×R¬â»YlÊw`w«yxŠ¬*>Šdë¿âOâñ«ø&vb+.ÄW±¯â(žÄ‹Ø‹¿‹ŸD%þ*p½€”½¸ƒçkHÝ‹Lý·ø—¸?ªƒo¿ŠKññg`|qÒ,Gûôî—s%Þàÿî÷p·ƒôH}ƒ\'¿ˆ¿ePÄr);xºƒë7¸ªòáRHÌÏ§‡ùpÝÃUÕ†ê}‚oPæWxöË¾­\\Š{¼uùÎÏ_\"×Ü=!î\\©ÓÜ¡ÌW(Â!ÿ>ë‰¶RÃñÏ7€z±6Uõ$­ªÚ~€‡\\‚_ºœ»òÊZ†.ç–€®‹¹åYÜ5 ›bîú,îÐm1wswè®˜»=‹»t_ÌÝÅÝz(æîÏâ\0=sgqØvÅìcÄ¾…çwâ9Ñc„©~ž àªúó-ò^B?î®áó|®á^‚%Zø/áûSÕÕ¿_@úÔû\Zô:ÂÝ¸^Ãu„g_à®‚Âþ×ßðþ\nüùÚ+©Q¥¹Ùt/±dtßCÆÉý\0å¾±OolNÿ~¡?æþ&ùñùÿ˜O\\†?’ûÿï£üe»²õ]D>æßû˜ÇùmJgþ3ºWþÚ€÷\\OÊpŽOöàG¿7Ý\0—ÏÙ\0ßøï|’äºö™j‰~K=A›¾õpª/XâÚb«rL<rž¯*æ‹Ç×4JbŸ&ƒþ˜GÎóÕÑü‚GÍs©Ñp1Ë™iT[Ä‘iTWÄ‰1JùYýgðBåk=hNõÃê¯©¾º…kŸ‘åXæeUY#Xµ\rvØ.\Zø›—5çW„’8K@7PƒþXU³[[ßê`þÂ3ÍË«uÝÔØW£$5¦Ô(­EY=Ö®\nf¨<×¼Ä9ït¨y®9ït¨y®9ït¨×£Œ\rÚùÒÖð]¥©ÒÄ~?AÞb¸ÃyÌT–Ï2\'Gfå\\œäP©99œ—8D•óŒ«Þ ¦ÊIá<Ã!š¬”7ç)Ñ~š›ó‡è>ÍÍyÒ#ìwíþºA—g’…Lœ78D]ÈÄYÜ!\Zf>ŸFæ¹Úb.Î¢ÑsÅ|Ç5‹µN}…Üw¸â°ˆz–®„¯*ä‹ý‚ÃÉB¾Ø;8\\]Èû‡‹GŒ®„/5r¸¾xäÈáx¾#®©mpü§ùv\rwËëðŽs…ë–ªw¡oO]!:~Þ&Úî|Žû TkØâ·2~>/AééWNA+‘ÃÄ<ÀqÞ/qF¨æ‡½7	Q&·\Z7Õ\Zä+–S­I¨¸E­U&õËc‰q\rOÔüA­öžp¡ú–\'x¶Ÿô4y¬á{Ã§Êb[\\}K\\OY£bÆ<š87â›^w]c=^ñþhëFšV³–ÃDÂyyIžbø*hù„º£Vò„k³4nÎaÓj\\­«¢ðëÈNÆ0¨õ#å/¨õ¥çª5ði\\ëÒ\\NÆ+ T-°djÿ ò¼¯Ç¨¢Å~m%äóä¸å\'¸e!wý	îº»ùw“åvãõ=ØoùŽ¶?™Çßî Ü‚<åIkíI\'ñ¡}‘zÿ9”á2é¾L?É”®9å¤yŠ+Ó4…ò<b_µÆvµÂ¬*­ÚKzÚOéØÞ°/Þcö†-åŸRðß·PvÒÐ\Z>ØVÖ¶¬?ÆaÊñ¦ëj´¶Ûi:å£‘•v—N¸;´ÿA\rQòÖî±)–r´cÿªûBZãö#E6†¸†ë=Žª»€Èî\rj¿±åÈñ–ÉÏG¬FÞ…öÊ9®2™sÑ«‘)dÊB™ùHÖÉ¬dÖY™¦µ^f¸†ç	ÛrAÏBíl\nÇ°9´ãü°#øôC»Õ7Ø*ïPjí¨A-úy.Ñ³¨Q‰+I+÷[’¹«\"œdp2ÀuzÇjŠ«-®Æ5ÚšÁµ…åë4®Óë|SD¯\r[¦A#ZVÊh«§…Åp:ª¬6[¶Þ•Õd«wpS˜ÚbZÓXLÇbZ‹á´WY\r7zE=…1:®p­—C\rŠ—gt=°º–V×¼ŸI«k^–´ºæýPZ]w¬®¥ÕuÇêHZ]+Ëp–•VÛsíHZmö™²ÃI¬­.{¶~µÕeŸi×N—\\+ª­.+\\5çPeâ¥u¶Dœukë•=ëIµ§E®<ÕPe×ÚS¨ÊCqi¬–*ôU{(Î*ÕS…­”CµŠÓUcõY¡m8”Ñ(g—ÆkãU5ZÔÈj´µz2ç™œ×µžÎ;¬§÷Öx‰Wv^¦ÓúÀê³µZÏa\\ßÊ•ƒåáë6Zà{ªÎówÉÊì¬æùÞ¬³šçµETè«®	pœ·wVï„ãü½óFµ*3²uÞì¡ÊÌ :k[,?[×/õÖ„ã¼±÷¬Pef½g‰ÜøÓ{ö¸ÏÈáš\0ÇË5öp”äëÛ8¾¾}€ãåŽ¯ïà¸úA_ÄûßàÍ:dÆÿo´”ÿ¬=ÇÏ`›\0ÇùßàÙ£ÎÌ°ÏufÔ¼Þ©C{p¼‘œM†¨§ªY«Œ^OÕé]yYEHÎ2c4ZÔ¬mFo”&$§¥Ñ3:ôF>Îh#$g¡Ñ±I:×fF«OÞ:*zq!w,¬»LT±ð¼1‡r5³q•ó1™Å¹¹-¼ÏÇNUàYmfvXyBŸ‰dà-ÖŠ¦üèœGù>]guÝýÈ\"£E¿MIÖO« EU,ŸôâG3ûâ8eGÒ%‡\",_ÊÌ¬Tz1Õ€÷üZ‡Œú¨6÷Õ/5ödZ\Z+#^ÞRøÇÏ÷.4&ïÒ2ñ=ÅÉ$·Hmyøx»±˜|\\[é™J.þ=ïUµÖ¦Áñ‘`àøXX¸|kp|_C‘¬ããzhŠf^ø¨wør=aXÂÒÉ–™(ÒôÁ®”|¸ìÇÏD*Ï³¨F¡ÇÓª¦ùîÖBMŠÚÓ¾ÇõSµ°Ã5UÚÝëÝŒxíµ$qïpW~;Y\rž>÷ñ{|J»ùâE¤Þ¸É!×Þî «b…MÅÏ!×Aïhp½ÙÌLþ8ÕäÛà»R\\/ß·|Ò­½Ç–.q×cjÖ3òy?íîqgëÃÛM¬t$ßbÏï89<1*9ï¶Fnçn‡øgÌ‰ï”)¾2´{ëlƒ–ZÙw\'Þá‰²¾¿c—ÃíÎŸ¢ÚŽ8{«½Q9…3½³Og	Ü©…°,9œaRû­XSå‡÷xòá€{°Q	³:+á“…|r†/lyŒáQ¾gvp–^ ÎPlð<ê\râ¶Už/-g§÷U7úþ+bC•ä vŸóIŸúpmªÁÑ¯²§±¥c\rØû›19Ïâ$Ñ‰•[½çllc´žCpªV‡höJiÄ£ý\'³ÖyNþó$VâRŸ¸nõ8ÉÕ‰Ï?\'‘Z¬9-_ÍðûèRæê,æ|™MÏ·ˆ¼s;ÏŸ¤ÃÎ3ÊI+CÏsÖgqÖEœÓS¶shâ¤S\\Ï\"w\ZgŠ1yÕ‰µG}**uêÌ·Å<šXð\\õ4®©“ &Ÿ™RûÉáRLïx~ä\Ze’ÇGzú¤û_ÿMD¿~9œÏôŽ#ã-Hso,±½ï&:+Ë³«“4æ|bŽsŠ‹™Öðü!ÑRÓ.wÜ*Ó.w|¦=àrOÛZ\ZçÄþl!ÌÛ©”twj;•’Î#Ù<©ºQJcç7©”8Ý—8¯ô<\"­×4vÊHsE7Z³H3;â¥”æ%‡\'ŸÒì©ÓQ©TÞ7SgR©¼¦N.¥Rãw-8ÏÐ0¤¼\"|fŽ¡Í2t]–¡/`èôQurþÞÎ1Í	ÂÍä”ã9ù¦’¶ø[E‡§_²’æòÅ’hŽ¬Æ4š¯¯uy)Ž7+iieyc‰G<÷ÝÆÏNçª¬+Íx™¥¹c©\'lñj&ÂQîˆçB)^(‘[žÿÉî­ÿ÷[>SŽ)_š‘?\'Ñ¥úãÍÜ¹Vò…RÝâêX<Ž~žiZ–0ÊN¥˜<4ÿ¡”sÞ_8\'§‘¥Þw<èYÝr2£Ží1‡6¬¨› ßö1²ðn­{3²—`ó¼\'´ÆÎ‹¦KÄz–ûý!¿ÞÆ0¨·:Ì»@é³íRóÌ#\rç‹ø°ëM+œA¼b]^Àæ÷ËÏãS¼æ÷„öv$Ï›Â§x1ÂØ tÒøës:‡á¦³úWŒMýwu6“÷dJóø¸¶¢ÆÎ7Û¸HjZ£Ï±”•ÁÄ¥µ=ùÓóK4¥yË$¹ÓÜçÕ/>~Òk£¯zŒ2kÐÄ§™<ï¨òâ;ãÕXCë/¤5õæ@þ=å2–y™ª„ÏXÏÏKt)yadnfçHK3Yª&ÌJ÷;÷X>3\'3;ðs¸ÞbY\'{Þ<†x¾ck\\ƒZ¯q•Òœ×S§9VVVü4ÆÊR&q)N™ä¬È:k¸&Âmñi+–ZWÔëù¹ÒˆG\\ÿy\nËào\'ø{/ÞŸMqÓR¤lCO§%0OcllÇmÂŽÛ¤·I;nvÜ&ì¸MØq›°£³ÍAÏÃ<©t³›úõE!þvÂ…Ô'),(117460,1,'Ú\0\0\0b\0\0xœ•‘ËÁ@†?[‰whì©q)—\'`-” ª.E¼Wó§¥éXÈ,fæœïüÿ93OJóà@„Ç5v‰RÅP§¡ÝS&&T|¥lÌ&ÍÎ˜2¡&*ÐmÌˆ\ne)9q}«$y4dË\"­NØk´FªìÈá÷\Zàÿ¨ÌTÏÜ	_Š¹0ÿrŸ«ï‡Å.unhš¦zörç uÉ²ÊXT@ÛA4-¢«S‘hœ\\T;§=1-Ó/(gÏÅÙ\\kºÌÓVËÞÊÿëe}çŸÃ©®U2'),(117460,2,'’\0\0\0\0\0\0xœŽ1‚@DŸ-	w öˆ6T\n\'š €’à.q•Àé¼š#++³ÅîógfŸ,Ø’2p¥% §â†£ÁbØ±dÃŠµî@Šá$^J5œ\'5ãÀžP[±¦”O‰–Žû\'Å}éEócJûsj\n5Z56Ú®DŽÒKQïVÔ‰\'rF{çæèçàÉÇ,');
/*!40000 ALTER TABLE `player_settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-06  2:41:44
