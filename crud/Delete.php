<h3>Delete User </h3>
<form method="POST">
    <table>
        <tr>
            <td>Identification</td>
            <td> <input type="text" id="id" name="id"/></td>
        </tr>
        <tr>
            <td colspan=2>
                   <button id="delete" name="delete">Delete</button>
            </td>
        </tr>
        <tr>
            <th colspan=2>
            <?php
            if(isset($_REQUEST['delete'])){
                $id=$_REQUEST['id'];
                if($id==null){
                    echo 'Identification Empty';
                }else{
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                        CURLOPT_URL => "http://127.0.0.1:8080/api/users/".$id,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "DELETE",
                        CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/json"
                        ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        echo 'delete success';
                }
            }
          ?>
      </th>
   </tr>
</table>
</form><br>
<button style="width:120px;height:50px;background-color:gray;color:white"><a style="color:white;" href="index.php"><<< Menu</a></button>