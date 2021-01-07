<?php
include 'db_connect_conf.php';
    class exdate{
        var $id;
        var $exD;
        var $itName;
        var $pop;
        var $delidate;
        var $docid;
        var $days;
        var $color;
        var $fontColor;

        function __construct($id, $exD, $itName, $pop, $delidate, $docid, $days){
            $this->$id;
            $this->$exD;
            $this->$itName;
            $this->$pop;
            $this->$delidate;
            $this->$docid;
            $this->$days;
        }

        function colorize_line($days, $color, $fontColor){
            if ($days > 62) {
                $this->$color = 'white';
                $this->$fontColor = 'black';
            } elseif ($days < 0) {
                $this->$color = 'black';
                $this->$fontColor = 'white';
            } elseif ($days <= 31) {
                $this->$color = '#e83838';
                $this->$fontColor = 'black';
            } elseif ($days <= 62) {
                $this->$color = '#f5834e';
                $this->$fontColor = 'black';
            }
        }

        function printTableLine($id, $exD, $itName, $pop, $delidate, $docid, $days, $color, $fontColor){
            echo `
            <td>
                <div class="entry_id">$id</div>
            </td>
            <td><input type="date" name="exdate[]" class="exdate" value="$exD" disabled "style='color:$fontColor'"></td>
            <td><input type="text" name="item[]" class="item" value="$itName" disabled "style='color:$fontColor'"></td>
            <td><input type="text" name="volume[]" class="volume" value="$pop" disabled "style='color:$fontColor'" ></td>
            <td><input type="date" name="del_date[]" class="delivery_date" value="$delidate" disabled "style='color:$fontColor'"></td>
            <td><input type="text" name="docid[]" class="document_id" value="$docid" disabled "style='color:$fontColor'"></td>
            <td><span class="edit">Επεξεργασία</span></td>
            <td><span class="del">Διαγραφή</span></td>`;
        }
        
    }

?>