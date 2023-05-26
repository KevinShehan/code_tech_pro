<?php
require('pages/Header.php');
require('Top_nav.php');
require('Side_nav.php');
?>

<!-- offcanvas -->
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <span><i class="bi bi-table me-2"></i></span> Supplier Report
                    </div>
                    <div class="card-body">
                        <table></table>

                        <button class="btn" onclick="printPage()">Print</button>

                        <script>
                            function printPage() {
                                window.print();
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require('pages/Footer.php');
?>