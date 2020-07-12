<?php
    session_start();
	//include '../db_connect_conf.php';
    
    if (isset($_POST['currval'])){
        $currval = $_POST['currval'];
?>
    <select id='drop_ctype' required>
        <option value='-' <?php echo ($currval === '-' ? 'selected' : '')?>> - </option>
        <option value='€' <?php echo ($currval === '€' ? 'selected' : '')?>> € </option>
        <option value='%' <?php echo ($currval === '%' ? 'selected' : '')?>> % </option>
    </select>
<?php
    }
?>