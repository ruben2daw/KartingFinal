<?php 

$pageDAO = new PageDAO();
$content="";
$page=null;
$msg="";

$select=$pageDAO->getOptionPage();

if(isset($_GET['id'])){
	$page=$pageDAO->getById($_GET['id']);
	$content=$page->getContent();
	}
	
if($_POST){
	$page->setContent($_POST['content']);
	$msg=$pageDAO->update($page);
}

?>
<section class="col-md-10">

  <script src="../resources/js/tinymce/tinymce.min.js"></script>
  <script src="../resources/js/loadtiny.js"></script>
  <script>
    function reload(value){
 	    window.location="<?php echo $_SERVER['PHP_SELF'];?>?option=page&id="+value;
    }
   </script>
<h2>Editar página</h2>

	<form action="#" method="post" enctype="multipart/form-data">
		Selecciona página:
		<select name="page" onchange="javascript:reload(this.value);">
			<option></option>
			<?php echo $select; ?>
		</select>			
		
		<br><br>
		<textarea name='content'><?php echo $content;?></textarea>			
		<br><br>
		<input name="id" type="hidden" value="<?php echo $_GET['id'];?>">
		<input type="submit" value="Send">
	</form>
		

	
	<h3 style="color:red;"><?php echo $msg;?></h3>
</section>
