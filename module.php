<?php

/**
 * webtrees: online genealogy
 * Copyright (C) 2025 webtrees development team
 */

/**
 * http://gustine.eu/mode_emploi/gustine-history.php
 * MR 2022-08 FrenchHistory.php complété avec les changements de frontières et quelques faits scientifiques.
 ┌──────────────────────────────────────┐
 │ MR 2024-11 adaptation à webtrees 2.2 │
 └──────────────────────────────────────┘
 * MR 2025-12 prise en compte de l’usage éventuel de la syntaxe markdown (Panneau de contrôle > Gérer les arbres généalogiques > Préférences)
 */

declare(strict_types=1);

use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\Module\ModuleHistoricEventsTrait;
use Fisharebest\Webtrees\Module\ModuleHistoricEventsInterface;
use Fisharebest\Webtrees\Registry;
use Illuminate\Support\Collection;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class GustineHistory
 */
class GustineHistory extends AbstractModule implements ModuleCustomInterface, ModuleHistoricEventsInterface
{
	use ModuleCustomTrait;
	use ModuleHistoricEventsTrait;

	public function title(): string
	{
		return 'Faits historiques de France et d’ailleurs 🇪🇺';
	}

	public function description(): string
	{
		return 'Variante de FrenchHistory.php pour webtrees 2.2';
	}

	public function customModuleAuthorName(): string {
		return 'gustine@ovh.fr';
	}

	public function customModuleVersion(): string {
		return '2025.12.29';
	}

	public function customModuleLatestVersionUrl(): string
	{
		return 'https://gustine.eu/mode_emploi/gustine-history/latest-version22.txt';
	}

	public function customModuleSupportUrl(): string {
		return 'https://gustine.eu/mode_emploi/gustine-history.php';
	}

	public function isEnabledByDefault(): bool
	{
		return false;
	}

	public function historicEventsAll(string $language_tag): Collection
	{
		$request = Registry::container()->get(ServerRequestInterface::class);
		$tree = $request->getAttribute('tree');
		if ($tree->getPreference('FORMAT_TEXT') === 'markdown') {
			// Cas où on utilise la syntaxe markdown pour les notes. Les liens sont de la forme « [Wikipédia…](https://fr.wikipedia.org/wiki/Traité_de_Brétigny) ».
			$debut = " [Wikipédia…]("; $fin = ")";
			}
		else {
			// Cas où on utilise du texte brut. Les liens sont de la forme « https://fr.wikipedia.org/wiki/Traité_de_Brétigny ».
			$debut = " "; $fin = " ";
			}

		switch ($language_tag) {
			case 'fr':
			case 'fr-CA':
				return new Collection([
					# 🗓 Politique : rois de France, présidents, empereurs
					# 🗓 Histoire : événements importants (traités, lois)
					"1 EVEN Philippe VI de Valois roi de France\n2 TYPE 🗓 Politique\n2 DATE 1 FEB 1328",
					"1 EVEN Guerre de Cent Ans\n2 TYPE 🗓 Histoire\n2 DATE 24 MAY 1337",
					"1 EVEN Jean II « le Bon » roi de France\n2 TYPE 🗓 Politique\n2 DATE 22 AUG 1350\n2 NOTE il est fait prisonnier à la bataille de Poitiers en 1356 par Édouard de Woodstock dit le « Prince Noir », fils aîné d’Édouard III d’Angleterre. Il sera libéré en 1360 contre rançon.\n3 CONT Le traité de Brétigny attribue aux Anglais une grande partie du sud-ouest de la France.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Traité_de_Brétigny" . $fin,
					"1 EVEN Charles V « le Sage » roi de France\n2 TYPE 🗓 Politique\n2 DATE 8 APR 1364",
					"1 EVEN Charles VI « le Fol » roi de France\n2 TYPE 🗓 Politique\n2 DATE 16 SEP 1380",
					"1 EVEN Charles VII « le Victorieux » roi de France\n2 TYPE 🗓 Politique\n2 DATE 21 OCT 1422\n2 NOTE Jeanne d’Arc est brûlée à Rouen le 30 mai 1431.",
					"1 EVEN Louis XI « le Prudent » roi de France\n2 TYPE 🗓 Politique\n2 DATE 22 JUL 1461",
					"1 EVEN Charles VIII « l’Affable » roi de France\n2 TYPE 🗓 Politique\n2 DATE 30 AUG 1483",
					"1 EVEN Louis XII « le Père du Peuple » roi de France\n2 TYPE 🗓 Politique\n2 DATE 7 APR 1498",
					"1 EVEN François Ier roi de France\n2 TYPE 🗓 Politique\n2 DATE 1 JAN 1515",
					"1 EVEN Famine en Languedoc\n2 TYPE 🗓 Histoire\n2 DATE 1528",
					"1 EVEN Henri II roi de France\n2 TYPE 🗓 Politique\n2 DATE 1 MAR 1547",
					"1 EVEN Calaisis\n2 TYPE 🗓 Histoire\n2 DATE JAN 1558\n2 NOTE les troupes du duc de Guise lieutenant général du roi Henri II, reprennent la ville de Calais, dernière possession anglaise en territoire français.\n3 CONT La ville repasse brièvement sous contrôle espagnol de 1595 à 1597.",
					"1 EVEN François II roi de France\n2 TYPE 🗓 Politique\n2 DATE 10 JUL 1559",
					"1 EVEN Charles IX roi de France\n2 TYPE 🗓 Politique\n2 DATE 5 DEC 1560",
					"1 EVEN Henri III roi de France\n2 TYPE 🗓 Politique\n2 DATE 30 MAY 1574",
					"1 EVEN Henri IV « le Grand roi » de France\n2 TYPE 🗓 Politique\n2 DATE 1 AUG 1589\n2 NOTE l’édit de Nantes promulgué en avril 1598 accorde aux protestants des droits religieux, civils et politiques dans certaines parties du royaume.",
					"1 EVEN Louis XIII « le Juste » roi de France\n2 TYPE 🗓 Politique\n2 DATE 14 MAY 1610\n2 NOTE l’édit de grâce d’Alès du 28 juin 1629 révoque le versant militaire de l’édit de Nantes qui permettait aux protestants de conserver des places fortes militaires, mais il maintient la liberté de culte dans tout le royaume, sauf à Paris.",
					"1 EVEN Calendrier\n2 TYPE 🗓 Histoire\n2 DATE 04 OCT 1582\n2 NOTE passage du calendrier julien au calendrier grégorien, sauf dans les provinces qui ne sont pas encore françaises telles que l’Alsace, la Lorraine… \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Passage_au_calendrier_grégorien" . $fin,
					"1 EVEN Louis XIV « le Grand » roi de France\n2 TYPE 🗓 Politique\n2 DATE 14 MAY 1643\n2 NOTE en 1667, l’ordonnance de Saint-Germain-en-Laye (code Louis) impose la tenue des registres d’état civil en deux exemplaires dont l’un est déposé au greffe. Les parrains, marraines et témoins doivent signer les actes.\n3 CONT L’édit de Fontainebleau, enregistré le 22 octobre 1685, révoque le versant religieux de l’édit de Nantes en interdisant le protestantisme sur le territoire français (excepté en Alsace où l’édit de Nantes n’a jamais été appliqué).",
					"1 EVEN Traités de Westphalie\n2 TYPE 🗓 Histoire\n2 DATE 24 OCT 1648\n2 NOTE conclusion de la guerre de Trente Ans et de la guerre de Quatre-Vingts Ans. Annexion officielle par Louis XIV des Trois-Évêchés (Metz, Toul et Verdun déjà sous tutelle depuis 1552), de la Décapole (Colmar, Obernai, Rosheim mais pas Mulhouse)… \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Traités_de_Westphalie" . $fin,
					"1 EVEN Famine dans l’est de la France\n2 TYPE 🗓 Histoire\n2 DATE FROM 1650 TO 1652",
					"1 EVEN Traité des Pyrénées\n2 TYPE 🗓 Histoire\n2 DATE 07 NOV 1659\n2 NOTE Louis XIV récupère le comté d’Artois (sauf Aire et Saint-Omer qui ne reviendront français qu’en 1678), et du Roussillon, la frontière avec l’Espagne est définitivement fixée. \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Traité_des_Pyrénées" . $fin,
					"1 EVEN Traité d’Aix-la-Chapelle\n2 TYPE 🗓 Histoire\n2 DATE 02 MAY 1668\n2 NOTE fin de la guerre de Dévolution, Louis XIV enlève à l’Espagne les villes de Lille, Douai et Armentières. \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Traité_d'Aix-la-Chapelle_(1668)" . $fin,
					"1 EVEN Traités de Nimègue\n2 TYPE 🗓 Histoire\n2 DATE 10 AUG 1678\n2 NOTE fin de la guerre de Hollande opposant Louis XIV et ses alliés (Charles II d’Angleterre, Charles XI de Suède…) à Guillaume III d’Orange-Nassau stathouder des provinces de Hollande et Léopold Ier empereur du Saint-Empire notamment. La Franche-Comté devient française ainsi que Cassel, Bailleul, Cambrai, Valenciennes… \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Traité_de_Nimègue" . $fin,
					"1 EVEN Calendrier\n2 TYPE 🗓 Histoire\n2 DATE 05 FEB 1682\n2 NOTE passage du calendrier julien au calendrier grégorien en Alsace (elle n’était pas française en 1582). \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Passage_au_calendrier_grégorien" . $fin,
					"1 EVEN Famine en France\n2 TYPE 🗓 Histoire\n2 DATE FROM 1693 TO 1694\n2 NOTE 1 300 000 morts en plus de la mortalité normale (règne de Louis XIV).\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Grande_famine_de_1693-1694" . $fin,
					"1 EVEN Royaume de Valence 🇪🇸\n2 TYPE 🗓 Histoire\n2 DATE 27 JUN 1707\n2 NOTE Philippe V d’Espagne promulgue les décrets de Nueva Planta qui placent le royaume de Valence sous l’autorité du royaume de Castille. La Généralité est supprimée et le castillan est instauré comme langue unique de l’administration. \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Décrets_de_Nueva_Planta" . $fin,
					"1 EVEN Famine en France\n2 TYPE 🗓 Histoire\n2 DATE 1709\n2 NOTE 600 000 morts en plus de la mortalité normale (règne de Louis XIV).\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Grande_famine_de_1709" . $fin,
					"1 EVEN Artois\n2 TYPE 🗓 Histoire\n2 DATE 29 AUG 1710\n2 NOTE après six semaines de siège, Béthune devient néerlandaise jusqu’au traité d’Utrecht en 1713. \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Guerre_de_Succession_d'Espagne" . $fin,
					"1 EVEN Traités d’Utrecht\n2 TYPE 🗓 Histoire\n2 DATE 1713\n2 NOTE fin de la guerre de Succession d’Espagne. Les traités, signés entre la France de Louis XIV et la Grande-Bretagne de la reine Anne puis entre l’Espagne et la Grande-Bretagne, fixent notamment le tracé de la frontière franco-belge. La principauté d’Orange est annexée à la France.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Traités_d'Utrecht_(1713)" . $fin,
					"1 EVEN Louis XV « le Bien-Aimé » roi de France\n2 TYPE 🗓 Politique\n2 DATE 1 SEP 1715\n 2 NOTE en 1736, un édit royal déclare que les deux registres d’état civil ont le même caractère authentique et doivent donc recevoir les signatures des parties.",
					"1 EVEN Traité de Vienne\n2 TYPE 🗓 Histoire\n2 DATE 18 NOV 1738\n2 NOTE la Lorraine est attribuée à Louis XV qui la donne en viager à son beau-père, Stanislas Leszczyński. Elle sera formellement annexée par la France en 1766 à la mort de ce dernier. \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Traité_de_Vienne_(1738)" . $fin,
					"1 EVEN Calendrier\n2 TYPE 🗓 Histoire\n2 DATE 16 FEB 1760\n2 NOTE passage du calendrier julien au calendrier grégorien en Lorraine (elle n’était pas française en 1582). \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Passage_au_calendrier_grégorien" . $fin,
					"1 EVEN Traité de Versailles\n2 TYPE 🗓 Histoire\n2 DATE 15 MAY 1768\n2 NOTE la république de Gênes cède la Corse à Louis XV. \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Traité_de_Versailles_(1768)" . $fin,
					"1 EVEN Louis XVI roi de France\n2 TYPE 🗓 Politique\n2 DATE 10 MAY 1774\n2 NOTE l’édit de Versailles ou édit de tolérance, signé le 7 novembre 1787, permet aux non catholiques de bénéficier de l’état civil sans devoir se convertir.\n3 CONT Le 5 mai 1789, Louis XVI ouvre les états généraux. Le 13 septembre 1791, il accepte la Constitution élaborée par les membres de la Constituante et fait passer la France à une monarchie constitutionnelle. Il est guillotiné le 21 janvier 1793.",
					"1 EVEN Première République\n2 TYPE 🗓 Histoire\n2 DATE 22 SEP 1792\n2 NOTE après que le décret du 20 septembre 1792 ait retiré l’état civil aux curés pour le confier aux maires, le calendrier républicain est institué à compter du 22 septembre (1er vendémiaire an I) lendemain de l’abolition de la monarchie. Mais il n’entre en vigueur que le 15 vendémiaire an II (6 octobre 1793).\n3 CONT La période comprise entre la mise en place du Tribunal révolutionnaire de Paris en avril 1793 et la chute de Robespierre le 26 juillet 1794 est connue sous le terme de Terreur.",
					"1 EVEN Directoire\n2 TYPE 🗓 Histoire\n2 DATE 26 OCT 1795\n2 NOTE du 1er vendémiaire an VII au 7 thermidor an VIII (du 22 septembre 1798 au 26 juillet 1800), les mariages ont lieu au chef-lieu de canton.\n3 CONT La loi Jourdan-Debrel du 19 fructidor an VI impose une « conscription universelle et obligatoire » de tous les Français âgés de 20 à 25 ans.",
					"1 EVEN Belgique 🇧🇪\n2 TYPE 🗓 Histoire\n2 DATE OCT 1795\n2 NOTE la République française annexe le Hainaut qui devient département de Jemmapes, la Flandre Orientale département de l’Escaut, la Flandre Occidentale département de la Lys.",
					"1 EVEN Ligurie 🇮🇹\n2 TYPE 🗓 Histoire\n2 DATE 1797\n2 NOTE l’armée de la République française avance en Italie et proclame une République ligurienne « sœur » à Gênes. \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/République_de_Gênes" . $fin,
					"1 EVEN Consulat\n2 TYPE 🗓 Histoire\n2 DATE 9 NOV 1799\n2 NOTE le coup d’État du 18 brumaire an VIII exécuté par Napoléon Bonaparte marque la fin du Directoire et de la Révolution française.",
					"1 EVEN Napoléon Ier empereur des Français\n2 TYPE 🗓 Politique\n2 DATE 18 MAY 1804\n2 NOTE le décret impérial du 29 décembre 1804 met en place le conseil de révision et le tirage au sort des conscrits. Il est possible de se faire remplacer moyennant finances.",
					"1 EVEN Ligurie 🇮🇹\n2 TYPE 🗓 Histoire\n2 DATE 1805\n2 NOTE la République ligurienne est annexée à l’Empire français. Savone est chef-lieu du département de Montenotte. En 1814, la République de Gênes sera rétablie puis annexée par le royaume de Sardaigne.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/République_ligurienne" . $fin,
					"1 EVEN Louis XVIII roi de France\n2 TYPE 🗓 Politique\n2 DATE 22 JUN 1815\n2 NOTE exilé sous la Révolution française et le Premier Empire, il revient en France lors de la Restauration qui suit la chute de l’empereur Napoléon Ier le 6 avril 1814. Il est renversé durant les Cent-Jours, puis revient à nouveau au pouvoir après la bataille de Waterloo le 18 juin 1815.",
					"1 EVEN Charles X roi de France\n2 TYPE 🗓 Politique\n2 DATE 16 SEP 1824",
					"1 EVEN Louis-Philippe Ier roi des Français\n2 TYPE 🗓 Histoire\n2 DATE 9 AUG 1830\n2 NOTE la loi du 4 mars 1831 renforce l’interdiction de la traite négrière mais il faudra attendre 1848 pour que l’esclavage soit définitivement aboli.\n3 CONT Louis-Philippe est le dernier roi en France mais sous le titre de « roi des Français ».",
					"1 EVEN Royaume de Belgique 🇧🇪\n2 TYPE 🗓 Histoire\n2 DATE 1 JUN 1831\n2 NOTE Léopold de Saxe-Cobourg-Gotha, oncle de la reine Victoria, devient Léopold Ier, premier roi des Belges.",
					"1 EVEN Algérie française\n2 TYPE 🗓 Histoire\n2 DATE 14 JUN 1834\n2 NOTE la conquête de l’Algérie par la France débute à Sidi-Ferruch par le débarquement de l’armée d’Afrique commandée par le comte de Bourmont. Alger tombe le 5 juillet.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Conquête_de_l'Algérie_par_la_France" . $fin,
					"1 EVEN Abolition de l’esclavage\n2 TYPE 🗓 Histoire\n2 DATE 27 APR 1848\n2 NOTE sous l’impulsion de Victor Schœlcher, le gouvernement provisoire de la IIe République abolit l’esclavage dans tous les territoires français.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Abolition_de_l'esclavage" . $fin,
					"1 EVEN IIe République\n2 TYPE 🗓 Politique\n2 DATE 4 NOV 1848\n2 NOTE Louis-Napoléon Bonaparte 1er est le premier chef d’État français élu au suffrage universel masculin, le 10 décembre 1848, et le premier à porter le titre de président de la République française.",
					"1 EVEN Algérie française\n2 TYPE 🗓 Histoire\n2 DATE 09 DEC 1848 \n2 NOTE création de trois départements d’Algérie (hors Sahara) : Oran à l’ouest, Alger au centre et Constantine à l’est. \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Départements_en_Algérie_française" . $fin,
					"1 EVEN Napoléon III empereur des Français\n2 TYPE 🗓 Politique\n2 DATE 4 DEC 1852\n2 NOTE il est capturé lors de la bataille de Sedan le 2 septembre 1870. Il meurt en exil en Angleterre en janvier 1873.",
					"1 EVEN Traité de Turin\n2 TYPE 🗓 Histoire\n2 DATE 24 MAR 1860\n2 NOTE le duché de Savoie et le comté de Nice sont réunis à la France. \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Traité_de_Turin_(1860)" . $fin,
					"1 EVEN Royaume d’Italie 🇮🇹\n2 TYPE 🗓 Histoire\n2 DATE 17 MAR 1861\n2 NOTE le royaume de Sardaigne devient le royaume d’Italie et Victor-Emmanuel II son premier roi. \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Royaume_de_Sardaigne" . $fin,
					"1 EVEN Guerre franco-allemande\n2 TYPE 🗓 Histoire\n2 DATE 19 JUL 1870\n2 NOTE Napoléon III déclare la guerre au royaume de Prusse le 19 juillet 1870. Il capitule le 2 septembre.\n3 CONT Le 18 janvier 1871, les États allemands s’unissent en un Empire allemand dont le roi Guillaume Ier devient empereur. L’armistice général intervient le 15 février 1871.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Guerre_franco-allemande_de_1870" . $fin,
					"1 EVEN IIIe République\n2 TYPE 🗓 Histoire\n2 DATE 4 SEP 1870\n2 NOTE Napoléon III ayant été fait prisonnier à Sedan le 2 septembre 1870, Léon Gambetta proclame la République le 4.\n3 CONT Adolphe Thiers négocie le traité de paix avec Bismarck et réprime l’insurrection de la Commune. En août 1871, il devient président de la République.",
					"1 EVEN Traité de Francfort\n2 TYPE 🗓 Histoire\n2 DATE 10 MAY 1871\n2 NOTE toute l’Alsace, sauf le Territoire de Belfort, est annexée par l’Allemagne ainsi qu’une partie de la Lorraine. \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Traité_de_Francfort" . $fin,
					"1 EVEN Loi relative à la séparation des Églises et de l’État\n2 TYPE 🗓 Histoire\n2 DATE 09 DEC 1905\n2 NOTE Émile Loubet est alors président de la République française.",
					"1 EVEN Première Guerre mondiale\n2 TYPE 🗓 Histoire\n2 DATE 28 JUL 1914\n2 NOTE l’Autriche-Hongrie déclare la guerre à la Serbie le 28 juillet 1914. Le gouvernement français décrète la mobilisation générale le 2 août (Raymond Poincaré est président depuis 1913). L’Allemagne déclare la guerre à la Russie le 1er août, à la France le 3.\n3 CONT L’armistice est signé le 11 novembre 1918.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Première_Guerre_mondiale" . $fin,
					"1 EVEN Traité de Versailles\n2 TYPE 🗓 Histoire\n2 DATE 28 JUN 1919\n2 NOTE l’Alsace-Lorraine redevient française. \n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Traité_de_Versailles" . $fin,
					"1 EVEN Front populaire\n2 TYPE 🗓 Histoire\n2 DATE 03 MAY 1936\n2 NOTE il introduit de nombreuses réformes en matière économique et sociale : les congés payés, la réduction du temps de travail avec la semaine de quarante heures et l’établissement des conventions collectives.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Front_populaire_(France)" . $fin,
					"1 EVEN Guerre civile d’Espagne 🇪🇸\n2 TYPE 🗓 Histoire\n2 DATE FROM 17 JUL 1936 TO 01 APR 1939\n2 NOTE elle oppose les républicains loyaux au gouvernement de la IIe République aux nationalistes menés par le général putschiste Franco.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Guerre_d'Espagne" . $fin,
					"1 EVEN Seconde Guerre mondiale\n2 TYPE 🗓 Histoire\n2 DATE 3 SEP 1939\n2 NOTE le 3 septembre 1939, la France du président Albert Lebrun et le Royaume-Uni du roi Édouard VIII déclarent la guerre au Troisième Reich d’Adolf Hitler qui vient d’envahir la Pologne.\n3 CONT Du 10 juillet 1940 au 9 août 1944, durant l’occupation du pays par le Troisième Reich, le maréchal Philippe Pétain assure le gouvernement de la France (régime de Vichy).\n3 CONT L’armistice est signé le 8 mai 1945.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Seconde_Guerre_mondiale" . $fin,
					"1 EVEN Droit de vote des femmes\n2 TYPE 🗓 Histoire\n2 DATE 21 APR 1944\n2 NOTE en France, le droit de vote n’est accordé aux femmes qu’en 1944, elles l’exerceront pour la première fois en 1945.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Droit_de_vote_des_femmes#France" . $fin,
					"1 EVEN Création de la Sécurité sociale\n2 TYPE 🗓 Histoire\n2 DATE 19 OCT 1945\n2 NOTE instituée par une ordonnance du Gouvernement provisoire de la République française dirigé par Charles de Gaulle.",
					"1 EVEN IVe République\n2 TYPE 🗓 Histoire\n2 DATE 24 OCT 1946\n2 NOTE le président de la République est élu par le Parlement composé par la réunion des deux chambres, pour une durée de sept ans. Vincent Auriol est élu le 16 janvier 1947. Son rôle est essentiellement représentatif.",
					"1 EVEN Traité de Rome 🇪🇺\n2 TYPE 🗓 Histoire\n2 DATE 25 MAR 1957\n2 NOTE création de la Communauté économique européenne et du Marché commun européen. René Coty est alors président (1954-1959) de la République.",
					"1 EVEN Ve République\n2 TYPE 🗓 Histoire\n2 DATE 5 OCT 1958\n2 NOTE Charles de Gaulle est élu président le 8 janvier 1959. Le référendum de 1962 introduit l’élection du président de la République au suffrage universel direct. Le premier scrutin de ce type a lieu en 1965 et se conclut par la réélection du Général.",
					"1 EVEN Algérie française\n2 TYPE 🗓 Histoire\n2 DATE 18 MAR 1962\n2 NOTE les accords d’Évian mettent fin à la guerre d’Algérie. L’indépendance est proclamée le 3 juillet.",
					"1 EVEN Loi Lucien Neuwirth\n2 TYPE 🗓 Histoire\n2 DATE 19 DEC 1967\n2 NOTE l’usage des contraceptifs est autorisé en France, notamment la contraception orale.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Loi_Neuwirth" . $fin,
					"1 EVEN Évènements de mai-juin 1968\n2 TYPE 🗓 Histoire\n2 DATE MAY 1968\n2 NOTE la plus importante grève générale du XXe siècle en France, paralyse complètement le pays pendant plusieurs semaines. Charles de Gaulle président de la république depuis 1965 démissionne en avril 1969 après l’échec du référendum sur la réforme du Sénat et la régionalisation. Georges Pompidou lui succède en juin jusqu’à son décès en 1974.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Mai_68" . $fin,
					"1 EVEN Loi Simone Veil\n2 TYPE 🗓 Histoire\n2 DATE 17 JAN 1975\n2 NOTE l’interruption volontaire de grossesse est dépénalisée sous la présidence (1974-1981) de Valéry Giscard d’Estaing.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Loi_Veil" . $fin,
					"1 EVEN Loi Robert Badinter\n2 TYPE 🗓 Histoire\n2 DATE 18 SEP 1981\n2 NOTE abolition de la peine de mort en France sous la présidence (1981-1995) de François Mitterrand.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Peine_de_mort_en_France" . $fin,
					"1 EVEN Chute du mur de Berlin 🇪🇺\n2 TYPE 🗓 Histoire\n2 DATE 09 NOV 1989\n2 NOTE symbole de la chute des régimes communistes en Europe de l’Est et de la fin de la guerre froide.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Chute_du_mur_de_Berlin" . $fin,
					"1 EVEN Traité de Maastricht 🇪🇺\n2 TYPE 🗓 Histoire\n2 DATE 07 FEB 1992\n2 NOTE traité fondateur de l’Union européenne. François Mitterrand est alors président (1981-1995) de la République. Il sera révisé par le traité de Lisbonne entré en vigueur en décembre 2009 sous la présidence (2007-2012) de Nicolas Sarkozy.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Traité_de_Maastricht" . $fin,
					"1 EVEN Passage à l’euro 🇪🇺\n2 TYPE 🗓 Histoire\n2 DATE 01 JAN 2002\n2 NOTE les monnaies nationales (dont le franc) disparaissent dans les onze pays de la zone euro créée le 1er janvier 1999. Jacques Chirac est alors président (1995-2007) de la République.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Euro" . $fin,
					"1 EVEN Mariage pour tous\n2 TYPE 🗓 Histoire\n2 DATE 17 MAY 2013\n2 NOTE la loi portée par Christiane Taubira autorise le mariage civil entre deux personnes de même sexe. François Hollande est alors président (2012-2017) de la République.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Mariage_entre_personnes_de_même_sexe_en_France" . $fin,
					"1 EVEN Pandémie de Covid-19\n2 TYPE 🗓 Histoire\n2 DATE FROM 17 MAR 2020 TO 2023\n2 NOTE crise sanitaire mondiale entraînant confinements, restrictions et campagnes de vaccination. Emmanuel Macron est alors président (2017-2027) de la République.\n3 CONT" . $debut . "https://fr.wikipedia.org/wiki/Pandémie_de_Covid-19_en_France" . $fin,

					# Sciences : 🔭 Astronomie | ⚛️ Physique | ⚡ Électricité | 🧬 Biologie | 🚗 Automobile | 🚂 Chemin de fer | ✍️ Écriture | 🎬 Cinéma | ✈️ Aviation | 🚀 Astronautique | 💻 Informatique | 🏥 Médecine
					"1 EVEN Astronomie 🔭\n2 TYPE 🗓 Sciences\n2 DATE 1609\n2 NOTE Johannes Kepler énonce les deux premières lois du mouvement des planètes.",
					"1 EVEN Astronomie 🔭\n2 TYPE 🗓 Sciences\n2 DATE 1610\n2 NOTE Galilée met au point sa lunette astronomique.",
					"1 EVEN Physique ⚛️\n2 TYPE 🗓 Sciences\n2 DATE 1644\n2 NOTE Evangelista Torricelli met en évidence la pression atmosphérique et invente le baromètre à tube de mercure. En 1648, Blaise Pascal montre que la pression varie avec l’altitude (expérience du Puy-de-Dôme).",
					"1 EVEN Physique ⚛️\n2 TYPE 🗓 Sciences\n2 DATE 1662\n2 NOTE Robert Boyle formule la loi des gaz parfaits.",
					"1 EVEN Physique ⚛️\n2 TYPE 🗓 Sciences\n2 DATE 1673\n2 NOTE Christian Huygens et son jeune assistant Denis Papin mettent au point un dispositif constitué d’un cylindre métallique équipé d’un piston, considéré comme étant à l’origine du moteur à combustion interne.",
					"1 EVEN Physique ⚛️\n2 TYPE 🗓 Sciences\n2 DATE 1685\n2 NOTE Isaac Newton formule la loi universelle de la gravitation.",
					"1 EVEN Physique ⚛️\n2 TYPE 🗓 Sciences\n2 DATE 1690\n2 NOTE Christian Huygens publie son Traité de la Lumière dans lequel il expose une théorie ondulatoire de la lumière.",
					"1 EVEN Astronomie 🔭\n2 TYPE 🗓 Sciences\n2 DATE 1705\n2 NOTE Edmond Halley postule que les comètes qui étaient apparues dans le ciel en 1531, 1607 et 1682 sont en fait une seule et même comète voyageant sur une orbite elliptique qu’elle décrit en 76 ans. Il prédit qu’elle reviendra en 1758 (1759 en réalité).",
					"1 EVEN Physique ⚛️\n2 TYPE 🗓 Sciences\n2 DATE 1714\n2 NOTE Daniel Gabriel Fahrenheit invente le thermomètre à mercure.",
					"1 EVEN Électricité ⚡\n2 TYPE 🗓 Sciences\n2 DATE 1750\n2 NOTE Benjamin Franklin propose de faire voler un cerf-volant au cours d’un orage pour démontrer la nature électrique des orages. L’expérience sera menée en 1752, conduisant à l’invention du paratonnerre.",
					"1 EVEN Biologie 🧬\n2 TYPE 🗓 Sciences\n2 DATE 1753\n2 NOTE Carl von Linné publie « Species plantarum » décrivant 8000 espèces de végétaux selon sa nomenclature des espèces vivantes.",
					"1 EVEN Automobile 🚗\n2 TYPE 🗓 Sciences\n2 DATE 1769\n2 NOTE le fardier à vapeur de Joseph Cugnot est le premier véhicule automobile fonctionnel.",
					"1 EVEN Astronomie 🔭\n2 TYPE 🗓 Sciences\n2 DATE 1781\n2 NOTE William Herschel (1738-1822) découvre Uranus.",
					"1 EVEN Vaccination antivariolique 🏥\n2 TYPE 🗓 Sciences\n2 DATE 1796\n2 NOTE Edward Jenner réalise la première vaccination contre la variole, posant les bases de l’immunologie moderne.",
					"1 EVEN Chemin de fer 🚂\n2 TYPE 🗓 Sciences\n2 DATE 1804\n2 NOTE première circulation sur des rails, au pays de Galles, d’une locomotive à vapeur construite par Richard Trevithick.",
					"1 EVEN Stéthoscope 🏥\n2 TYPE 🗓 Sciences\n2 DATE 1816\n2 NOTE René Laennec invente le stéthoscope à l’hôpital Necker à Paris.",
					"1 EVEN Chemin de fer 🚂\n2 TYPE 🗓 Sciences\n2 DATE 30 JUN 1827\n2 NOTE ouverture de la ligne Saint-Étienne-Andrézieux première concession de chemin de fer en France.",
					"1 EVEN Écriture Braille ✍️\n2 TYPE 🗓 Sciences\n2 DATE 1829\n2 NOTE parution du premier ouvrage utilisant le système d’écriture tactile à points saillants inventé par Louis Braille.",
					"1 EVEN Astronomie 🔭\n2 TYPE 🗓 Sciences\n2 DATE 1846\n2 NOTE Johann Galle découvre Neptune, selon les calculs d’Urbain Le Verrier.",
					"1 EVEN Anesthésie 🏥\n2 TYPE 🗓 Sciences\n2 DATE 1846\n2 NOTE première démonstration publique d’une anesthésie à l’éther par William Morton à Boston.",
					"1 EVEN Antisepsie 🏥\n2 TYPE 🗓 Sciences\n2 DATE 1867\n2 NOTE Joseph Lister introduit l’antisepsie chirurgicale avec l’acide phénique.",
					"1 EVEN Automobile 🚗\n2 TYPE 🗓 Sciences\n2 DATE 1889\n2 NOTE René Panhard et Émile Levassor installent le premier moteur à quatre temps (celui de Daimler) sur une voiture à quatre places.",
					"1 EVEN Cinéma 🎬\n2 TYPE 🗓 Sciences\n2 DATE 19 MAR 1895\n2 NOTE tournage par Louis Lumière du premier film « Sortie de l’usine Lumière à Lyon ».",
					"1 EVEN Rayons X 🏥\n2 TYPE 🗓 Sciences\n2 DATE 8 NOV 1895\n2 NOTE Wilhelm Röntgen découvre les rayons X, révolutionnant le diagnostic médical.",
					"1 EVEN Transports ✈️\n2 TYPE 🗓 Sciences\n2 DATE 02 JUL 1900\n2 NOTE le comte Ferdinand von Zeppelin fait voler son dirigeable au-dessus du lac de Constance.",
					"1 EVEN Groupes sanguins 🏥\n2 TYPE 🗓 Sciences\n2 DATE 1900\n2 NOTE Karl Landsteiner découvre les groupes sanguins A, B et O, permettant les transfusions sécurisées.",
					"1 EVEN Aviation ✈️\n2 TYPE 🗓 Sciences\n2 DATE 23 SEP 1913\n2 NOTE Roland Garros accomplit la première traversée de la Méditerranée en avion.",
					"1 EVEN Pénicilline 🏥\n2 TYPE 🗓 Sciences\n2 DATE 1928\n2 NOTE Alexander Fleming découvre la pénicilline, premier antibiotique, révolutionnant le traitement des infections bactériennes.",
					"1 EVEN Aviation ✈️\n2 TYPE 🗓 Sciences\n2 DATE 12 MAY 1930\n2 NOTE Jean Mermoz relie Saint-Louis (Sénégal) et le Brésil en 21 heures à bord d’un Latécoère 28.",
					"1 EVEN Structure de l’ADN 🏥\n2 TYPE 🗓 Sciences\n2 DATE 25 APR 1953\n2 NOTE James Watson et Francis Crick publient la structure en double hélice de l’ADN dans la revue Nature.",
					"1 EVEN Astronautique 🚀\n2 TYPE 🗓 Sciences\n2 DATE 4 OCT 1957\n2 NOTE les Soviétiques lancent le premier satellite artificiel, Spoutnik 1.",
					"1 EVEN Astronautique 🚀\n2 TYPE 🗓 Sciences\n2 DATE 12 APR 1961\n2 NOTE Youri Gagarine est le premier homme dans l’espace, à bord de son vaisseau spatial Vostok 1.",
					"1 EVEN Première greffe cardiaque 🏥\n2 TYPE 🗓 Sciences\n2 DATE 3 DEC 1967\n2 NOTE Christiaan Barnard réalise la première transplantation cardiaque humaine au Cap, en Afrique du Sud.",
					"1 EVEN Astronautique 🚀\n2 TYPE 🗓 Sciences\n2 DATE 21 JUL 1969\n2 NOTE Neil Armstrong effectue le premier pas de l’homme sur la Lune.",
					"1 EVEN Informatique 💻\n2 TYPE 🗓 Sciences\n2 DATE 1972\n2 NOTE Kernighan et Ritchie inventent le langage C. Naissance de la disquette de 8 pouces. Invention de la messagerie électronique et envoi du premier courriel sur ARPAnet.",
					"1 EVEN Premier bébé éprouvette 🏥\n2 TYPE 🗓 Sciences\n2 DATE 25 JUL 1978\n2 NOTE naissance de Louise Brown au Royaume-Uni, premier bébé conçu par fécondation in vitro (FIV).",
					"1 EVEN Informatique grand public 💻\n2 TYPE 🗓 Sciences\n2 DATE 1981\n2 NOTE apparition de l’IBM PC en 1981. Lancement commercial du Minitel en 1982 (le service fonctionnera jusqu’au 30 juin 2012). Les premiers disques compacts sont commercialisés en France en 1983.",
					"1 EVEN Chemin de fer 🚂\n2 TYPE 🗓 Sciences\n2 DATE 1981\n2 NOTE ouverture de la première ligne TGV entre Paris et Lyon. En 1983, mise en service à Lille du premier métro entièrement automatique au monde (VAL).",
					"1 EVEN Identification du virus VIH 🏥\n2 TYPE 🗓 Sciences\n2 DATE 1983\n2 NOTE Luc Montagnier et son équipe de l’Institut Pasteur identifient le virus responsable du SIDA.",
					"1 EVEN Informatique 💻\n2 TYPE 🗓 Sciences\n2 DATE 1989\n2 NOTE Tim Berners-Lee expose les principes du système hypertexte qui deviendra le World Wide Web. Le premier serveur entrera en service au CERN l’année suivante.",
					"1 EVEN Séquençage du génome humain 🏥\n2 TYPE 🗓 Sciences\n2 DATE 26 JUN 2000\n2 NOTE achèvement du premier séquençage complet du génome humain."
				]);

			default:
				return new Collection();
		}
	}
};
return Registry::container()->get(GustineHistory::class);
