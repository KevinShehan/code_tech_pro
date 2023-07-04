<?php
//register supplier
session_start();
include('config/dbconnection.php');
include('pages/header.php');
include('Top_nav.php');
include('Side_nav.php');
?>




<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3">
                Quotation Add
				<div class="heading" id="print-content" style="display: none;">
					<img src="Assets/images/Picture1.png" alt="" width="30%">
					<h3 style="text-align: center;"> Quotation</h3>


					<div> Name </div>
					<div> Address</div>

					<div> Name </div>
					<div> Address</div>

					<div>
						Date
					</div>
					<div>
						Valid Until
					</div>



					<div>This is valid only given period</div>

					<div class="div text-end">
						<div> .......................... </div>
						<div class="font-weight-bold">Signature </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>






<?php
include('pages/footer.php');
?>