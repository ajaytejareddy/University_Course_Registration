<?php 
    include 'dbConnect-con.php';
    include 'session-con.php';

    startSession();

    if(isset($_SESSION['admin'])){
        $uname = $_SESSION['uname'];
        $pwd = $_SESSION['pwd'];

        $con = new Database();

        if(!$con->verifyAdmin($uname,$pwd)){
            header('Location: /FinalProj/');
        }
    }

    function Check(){
        if(isset($_POST['submit'])&&isset($_POST['date'])){
                $date = $_POST['date'];
                $openTime = $_POST['open'];
                $closeTime = $_POST['close'];
                $description = $_POST['description'];
                $max_allowed = $_POST['max_allowed'];
                
                $con = new Database();
                $bool = $con->createSlot($date,$openTime,$closeTime,$max_allowed,$description);
                if(!$bool)
                    echo "<p style='color:red;'>**Error in creating time slot**</p>";
                
                else if($bool)
                    echo "<p style='color:green;'> ** session slot successfully created**</p>";
        }
    }

    function deleteSlot(){
        if(isset($_POST['submit'])&&isset($_POST['dateGet'])){
            $date = $_POST['dateGet'];
            $openTime = $_POST['openTime'];

            //echo $date.$openTime;

            $con = new Database();

            $bool = $con -> delSlot($date,$openTime);
            if(!$bool){
                echo "<p style='color:red;'>**Error in creating time slot**</p>";
                return;
            }

            echo "<p style='color:green;'> ** record successfully deleted **</p>";

        }
    }

    function getTable(){
        echo '<table>';

        $getSlots = (new Database)->getSlots();
        echo "<tr>
        <th>Date</th>
        <th>Opening Time</th>
        <th>Closing Time</th>
        <th>Description</th>
        <th>Modification</th>
        </tr>";

        foreach($getSlots as $slot){
            echo "<tr>";
            echo "<td>$slot[0]</td>";
            echo "<td>$slot[1]</td>";
            echo "<td>$slot[2]</td>";
            echo "<td>$slot[3]</td>";
            echo "<td>
            
            <form method='post'>
            <input type=\"hidden\" name='dateGet' value='$slot[0]' />
            <input type=\"hidden\" name='openTime' value='$slot[1]' />
            <button type='submit' name='submit' value='delete' class=\"button button3\">Delete</button>
            </form>


            
            </td>";
            echo "</tr>";
        }

        echo '</table>';
       // print_r($a);
                

    }

    

?>