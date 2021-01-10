<?php
namespace Assets;
echo view('partials/UnitList_Head');
$langName = 'nameKey'.ucfirst($_SESSION['lang']);
$langDesc = 'descKey'.ucfirst($_SESSION['lang']);
?>
<table id="chrlist" class="table table-striped table-hover" style="width: 100%;" >
	<thead >
	<tr >
		<th class="sort" >Name</th >
		<th class="sort" >Beschreibung</th >
		<th class="sort" >Seite</th >
	</tr >
	</thead >
	<tbody class="list" >
	<?php asort($toons);
	foreach ($toons as $t) {
		if ($t->image) {
			?>
			<tr >
				<td class="name char-list-name" ><img class="char-portrait-list-img"
				                                      src="/assets/units/<?php echo $t->baseId.'.png'; ?>"
				                                      alt="<?php echo $t->$langName; ?>" width="30" height="30" />
					<div
							class="name" > <?php echo $t->$langName; ?></div >
					</a></td >
				<td class="abbreviation" ><?php echo $t->$langDesc; ?></td >
				<td class="side" ><?php echo $enums[array_search('ForceAlignment'.$t->forceAlignment,
						array_column($enums, 'enum_key'), true)]->$langName;
					?></td >

			</tr >
		<?php }
	} ?>
	</tbody >
</table >

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous" ></script >
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous" ></script >
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous" ></script >
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/jquery.tablesorter.js" ></script >
<script >
    $(document).ready(function () {
        $("#chrlist").tablesorter({
            sortList: [[0, 0]]
        });
    });
</script >
</body >
</html >
