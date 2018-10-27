<div id="sponsor" class="sponsor-section content-hidden">
    <div class="content-wrap">
        <h1 class="sponsor-tittle">
            nuestros sponsors
        </h1>

        <?php

        $sponsors = ControladorSponsors::ctrMostrarSponsors(null, null);

        foreach ($sponsors as $key => $value){
            echo'
            <div class="brand">
                <img src="'.$value['img'].'" alt="" class="brand-logo">
                <h2 class="brand-name">
                <h3 class="content-hidden">'.$value['nombre'].'</h3>
                </h2>
            </div>';
        }

        ?>
    </div>
</div>
