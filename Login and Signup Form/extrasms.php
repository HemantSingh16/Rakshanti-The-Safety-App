 { 
  //sending sms to trusted contacts
  $sql = "SELECT PhoneNo FROM contacts where R_id=$U_ID AND response_status=1";
  $result = mysqli_query($con, $sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
  $mobile= $row["PhoneNo"];
 // echo "$mobile";
 $fields = array(
  "message" => "Hi,I am in trouble,please help me by reaching to below location:",
  "language" => "english",
  "route" => "q",
  "numbers" => "$mobile",
);

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_SSL_VERIFYHOST => 0,
CURLOPT_SSL_VERIFYPEER => 0,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => json_encode($fields),
CURLOPT_HTTPHEADER => array(
  "authorization:tupYfBn2xwq7h0ZC5kOa9l8VEizvHGjKFMrRXAygsSUNQDP64eGncSO9JQsWHh1BuyTaDoAYpE5jxlZ0",
  "accept: */*",
  "cache-control: no-cache",
  "content-type: application/json"
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
echo $response;
}
}


}