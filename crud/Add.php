<!--------------------ADD User--------------------------------------------------------->
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
 /*********************************Add User **************************************************** */-->
 <form method="POST">
 <h3>Add New User</h3>
    <table>
        <tr>
            <td>Name</td>
            <td> <input type="text" id="name" name="name"/></td>
        </tr>
        <tr>
            <td>Adress</td>
            <td> <input type="text" id="adress" name="adress"/></td>
        </tr>
        <tr>
            <td>Tel</td>
            <td> <input type="text" id="tel" name="tel"/></td>
        </tr>
        <tr>
            <td colspan=2>
                   <button id="add" name="add">Add</button>
            </td>
        </tr>
        <th colspan=2>
            <?php
                if(isset($_REQUEST['add'])){
                    $name=$_REQUEST['name'];
                    $adress=$_REQUEST['adress'];
                    $tel=$_REQUEST['tel'];
                    if($name==null && $adress==null && $tel==null){
                        echo 'empty .please fill the informations';
                    }else{
                        $user=array("name"=>$name,"adress"=>$adress,"tel"=>$tel);
                        $object=json_encode($user);
                        callAPI('POST','http://127.0.0.1:8080/api/users',$object);
                        echo 'ADD success';
                    }
                }
            ?>
        </th>
    </table>
 </form><br>
 <button style="width:120px;height:50px;background-color:gray;color:white"><a style="color:white;" href="index.php"><<< Menu</a></button>
