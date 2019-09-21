<?php $title="Contact"; ?>

<?php ob_start(); ?>

<section>
    <h1 class="pt-2 pb-3"> LOCALISATION </h1>
    <div id="localisation">
        <div id="localisation_text">
            <p id="localisation_info">La piscine de MaisonLaffitte nous accueille tous les samedis,<br> de 12 à 14 heures</p>
        </div>
        <div id="localisation_map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5749.771237997021!2d2.139865559933102!3d48.9516380191889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66191a7e21a81%3A0x344d2be7037c65f2!2sCentre%20Aquatique!5e0!3m2!1sfr!2sfr!4v1567274857997!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="">

            </iframe>
        </div>
    </div>
</section>

<?php

$content = ob_get_clean();

require 'template.php';?>

