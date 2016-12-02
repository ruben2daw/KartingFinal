<section class="col-md-10">
    <?php
    /**
     * Created by PhpStorm.
     * User: ruben_000
     * Date: 26/11/2016
     * Time: 18:37
     */



function buildTable($kartsList){
    $html = '<table  class="table">';
    // header row
    $html .= '<tr>';

    foreach($kartsList as $kart){
        $html .= '<th>' .  $kart . '</th>';
    }
    $html .= '</tr>';
    $html .= '</table>';

    return $html;
}


echo buildTable($kartsList);
    ?>


</section>
