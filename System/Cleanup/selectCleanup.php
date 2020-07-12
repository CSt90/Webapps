<?php
    session_start();
    include '../db_connect_conf.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Cleanup</title>
        <link rel="stylesheet" type="text/css" href="css/selectCleanup.css">
		<link rel="stylesheet" type="text/css" href="css/confirmPrompt.css">
        <link rel="stylesheet" type="text/css" href="../jqui/jquery-ui.css">
        <script src="../jsq/jquery-3.1.0.min.js"></script>
        <script src="../jqui/jquery-ui.min.js"></script>
    </head>
    <body>
        <div id='custom-popup' style='visibility:hidden'>
            <div id='pw-block' class='short'> <!-- change class to long when change password is clicked -->
                <div class='pw-row'>
                    <label id='pw-label' for='pw-input'> Password: </label>
                    <input class='pw-input' id='pw-input' type='password' placeholder='Type here' tabindex='-1'>
                    <a type='button' class='show-hide-chars' href='#'></a>
                </div>
                <div class='btn-row'>
                    <a class='confirm-btn' id='pw-confirm' type='button' href='#'> Confirm </a>
                    <a class='cancel-btn' id='pw-cancel' type='button' href='#'> Cancel </a>
                </div>
                <a id='change-pw-btn' type='button' href='#'> Change password </a>
                <span id='pw-status'> Password changed. </span>
                <div id='change-pw-block'>
                    <div class='pw-row'>
                        <label id='pw-label' for='pw-input'> Old password: </label>
                        <input class='pw-input' id='old-pw-input' type='password' placeholder='Type here'>
                        <a type='button' class='show-hide-chars' href='#'></a>
                    </div>
                    <div id='new-pw-row'>
                        <label id='pw-label' for='pw-input'> New password: </label>
                        <!-- type must  change to text if eye is clicked -->
                        <input class='pw-input' id='new-pw-input' title='Between 4 and 20 characters' type='password' placeholder='Type here'>
                        <a type='button' class='show-hide-chars' href='#'></a>
                    </div>
                    <div class='btn-row'>
                        <a class='confirm-btn' id='new-pw-confirm' type='button' href='#'> Confirm </a>
                        <a class='cancel-btn' id='new-pw-cancel' type='button' href='#'> Cancel </a>
                    </div>
                </div>
            </div>
        </div>
		<div id='home-logo' ><a href='../home.php'></a></div>
		<img id='bg' src='../background/waves_beach.jpg'></img>
		<div id='ctitle'><span> Delete reservations made by </span></div>
        <section id='container'>
            <form id='get-invoice' type='get' action='cleanup.php' target='_blank'>
                <div id='form-top-inputs'>
                    <div id='office-dropdown-block'>
						<label for='office-dropdown-block'> Office </label>
                        <?php
                            $q = 'SELECT idOffice, OName FROM office';
                            $res = mysqli_query($conn, $q);
                            echo "<select id='drop_office' name='dropdown-office' value='-1' required><option value=''>Select</option>";
							echo "<option value='-10'>All Offices</option>";
                            while($row = mysqli_fetch_array($res)) {
                              echo "<option value=".$row['idOffice'].">".$row['OName']."</option>";
                            }
                            echo "</select>";
                        ?>
                    </div>
                    <!-- not required, but if not filled in, all reservations will be shown instead -->
                    <div id='date-from-block' class='date-block'>
                        <label id='from-date-label'> Date from </label>
                        <input type='text' name='fromDate' id='fromDate' placeholder='Select date' required>
                    </div>
                    <div id='date-to-block' class='date-block'>
                        <label id='until-date-label'> Date until </label>
                        <input type='text' name='toDate' id='toDate'placeholder='Select date'>
                    </div>
                </div>
				<div id='btn-box'>
					<div id='cleanup'> Cleanup </div>
				</div>
				<div id='confirm-prompt' >
					<div id='prompt-block'>
						<p id='prompt-q'></p>
						<div id='backup'> Backup </div>
						<label id='submit-label'> Yes <button id='confirm' type='submit'></button></label>
						<div id='cancel'> Cancel </div>
					</div>
				</div>
            </form>
        </section>
    </body>
    <script src="js/selectInvoices.js"></script>
	<script src="js/cleanupPopupActions.js"></script>
</html>
<?php mysqli_close($conn); ?>
