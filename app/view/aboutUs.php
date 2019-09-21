<?php $title="A propos"; ?>

<?php ob_start(); ?>

<section class = "deco_section bounce-in-top">
    <h1>
        <span> <img src="public/images/book.png" alt="image d'un livre"></span>
         Historique </h1>
    <p>L'association Orcandie a été créée en 1989 par des parents de jeunes enfants atteints de handicap divers et variés.
        Dans une volonté de rompre l'isolement de leurs enfants et de leur permettre de pratiquer du sport à leur échelle,
        ils créent cette association en septembre 1989.</p>
    <p>
        La pratique de la natation étant accessible à tous (handicap physiques et sensoriels), dans un premier temps,
        elle est la seule activité qu'offre l'association mais en 1999, sous le mandat d'
        Annick C., l'association commence à proposer divers évènements dans le but d'améliorer la convivialité entre les membres.

    </p>


</section>

<section class="admin bounce-in-top">
    <h1 class="text-center">
        <span> <img src="public/images/chart.png" alt="image de nageur"></span>
       Membres
    </h1>

    <p> Chez Orcandie, tous les membres de notre équipe partagent  les valeurs d’engagement
        et de collectif propres au monde associatif, et tous ont un rapport plus ou moins éloigné avec le monde du handicap.
        Les encadrants, bénevoles au service des personnes handicapées sont des jeunes hommes et femmes dynamiques
        et dévoués à la cause.
</section>

<section class = "deco_section bounce-in-top">
    <h1>
        <span> <img src="public/images/skydive.png" width="60" alt="image de nageur"></span>
        Activités
    </h1>

    <p>La natation est l'activité de base de l'association. Les séances se tiennent tous les samedis de 12h00 à 13h00,
        hors période de vacances scolaires. Les bassins sont alors privatisés de même que les vestiaires.<br>
        Suite à ces séances, les participants ont la possibilité de déjeuner sur place, à la brasserie du centre aquatique.</p>

    <p> Tous les 2-3mois, la présidente de l'association et son équipe se chargent d'organiser des soirées à thème,
    s'adaptant au mieux à la période en cours, on peut citer le traditionnel repas de Noël, l'incontournable soirée crêpes de Février et
    l'indispensable barbecue qui clôture l'année en Juin.</p>

    <p> Depuis 2014, avec l'aide des bénévoles, un voyage est proposé chaque année pendant le weekend précédant la pentecôte.
    C'est ainsi que plusieurs villes ont été visitées intramuros telles que Annecy, strasbourg, la baie de Somme mais ont aussi figuré sur la liste
    internationale, les villes de Bruges et Marrakech.</p>


</section>



<?php $content = ob_get_clean();

require 'template.php'?>
