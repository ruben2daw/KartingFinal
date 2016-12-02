<section class="col-md-10">
    <?php
        /**
         * Created by PhpStorm.
         * User: ruben_000
         * Date: 26/11/2016
         * Time: 20:43
         */

        echo "NUEVAS PROMOCIONES";

        $objeto = new PromosDAO;
        $listaPromo= $objeto->getAll();

        foreach ($listaPromo as $promociones) {
            echo "$promociones <br>";
        }
    ?>
</section>
