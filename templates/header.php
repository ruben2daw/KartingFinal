<?php
Auth::get()->closeSession();
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