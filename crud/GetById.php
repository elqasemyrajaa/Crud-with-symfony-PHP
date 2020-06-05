<!--------------------Fetch ONE USER--------------------------------------------------------->
<?php
/**************************Variables****************************************** */
// create & initialize a curl session
$curl = curl_init();
// set our url with curl_setopt()
curl_setopt($curl, CURLOPT_URL, "http://127.0.0.1:8080/api/users");
// return the transfer as a string, also with setopt()
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
// curl_exec() executes the started curl session
// $output contains the output string
$output = curl_exec($curl);
// close curl resource to free up system resources
// (deletes the variable made by curl_init)
curl_close($curl);
/***********************Method CallApi************************************************** */
function callAPI($method, $url, $data){
    $curl = curl_init();
    switch ($method){
       case "POST":
          curl_setopt($curl, CURLOPT_POST, 1);
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
             curl_setopt($curl,CURLOPT_HTTPHEADER,['content-type:application/json']);
          break;
       case "PUT":
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
             curl_setopt($curl,CURLOPT_HTTPHEADER,['content-type:application/json']);			 					
          break;
       default:
          if ($data)
             $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
       'APIKEY: 111111111111111111111',
       'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $result = curl_exec($curl);
    if(!$result){die("Connection Failure");}
    curl_close($curl);
    return $result;
 }?>
 <!--/*********************************Consume Api ******************************************** */
 /*********************************Get By Id**************************************************** */-->
 <h3>Get Data by Id </h3>
<form method="POST">
    <table>
        <tr>
            <td>Identification</td>
            <td> <input type="text" id="id" name="id"/></td>
        </tr>
        <tr>
            <td colspan=2>
                    <input type="submit" id="btnsubmit" name="btnsubmit" value="submit"/>
            </td>
        </tr>
        <th colspan=2>
          <?php 
            if(isset($_REQUEST['btnsubmit'])){
                $id=$_REQUEST['id'];
              if($id==null){
               echo "identification is empty";
              }else{
               $get_data = callAPI('GET', 'http://127.0.0.1:8080/api/users/'.$id, false);
               $response = json_decode($get_data, true);
                echo "<table border=2>";
                echo "<tr><th>ID</th><th>Name </th><th>Adress </th><th>Tel </th></tr>";
                   echo "<tr><td>".$response['id']."</td>";
                   echo "<td>". $response['name']. "</td>";
                   echo "<td>". $response['adress']. "</td>";
                   echo "<td>". $response['tel']. "</td></tr>";
                echo "</table>";
              }
            }
          ?>
          </th>
        <tr>
            
        </tr>
    </table>
</form> <br>
<button style="width:120px;height:50px;background-color:gray;color:white"><a style="color:white;" href="index.php"><<< Menu</a></button>   