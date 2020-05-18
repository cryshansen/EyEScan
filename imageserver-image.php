
<?php
  // Create some random text-encoded data for a QR code.
// header('content-type: image/png');
  $url = 'https://chart.googleapis.com/chart?';
  $chd = 't:';
  for ($i = 0; $i < 150; ++$i) {
    $data = rand(0, 100000);
    $chd .= $data . ',';
  }
  //subtracts the last comma
  $chd = substr($chd, 0, -1);
  echo "<br/>";
echo $url;
  // Add image type, image size, and data to params.
  $qrcode = array(
    'cht' => 'lc',
	'chtt'=>'This is | my chart',
    'chs' => '300x300',
	'chxt'=>'x',
    'chd' => 't:40,20,50,20,100'
	);
	
$test_url=http_build_query($qrcode);
echo "<br/>";

echo $test_url;
echo "<br clear='all'/>";
  // Send the request, and print out the returned bytes.
  $context = stream_context_create(
    array('http' => array(
      'method' => 'POST',
      'content' => http_build_query($qrcode))));
	  //print_r( $context);
  fpassthru(fopen($url, 'r', false, $context));
?>
