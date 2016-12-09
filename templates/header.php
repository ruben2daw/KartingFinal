<?php
Auth::get()->closeSession(); //Comentario descriptivo
?>



<div class="row">
    <header class="col-md-12">
        <div>
            <h1>KARTING DAW</h1>
        </div>
        <div>
            <?php Auth::get()->showWelcomeMessage();?>
        </div>
    </header>
</div>