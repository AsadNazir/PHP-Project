$name = $_REQUEST['name'];
$breed = $_REQUEST['breed'];
$gender = $_REQUEST['gender'];
$age = $_REQUEST['age'];
if(isset($_REQUEST['dairy']))
{
$dairy = "yes";
}
else
{
$dairy = "no";
}
$weight = $_REQUEST['weight'];
$height= $_REQUEST['height'];
$color = $_REQUEST['color'];

$output_dir = "Images/upload";
$RandomNum = time();
$ImageName = str_replace(' ', '-', strtolower($_FILES['image']['name']));
$ImageType = $_FILES['image']['type'];

$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
$ImageExt = str_replace('.', '', $ImageExt);
$ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
$NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;
$ret[$NewImageName] = $output_dir . $NewImageName;

if (!file_exists($output_dir)) {
@mkdir($output_dir, 0777);
}

move_uploaded_file($_FILES["image"]["tmp_name"], $output_dir . "/" . $NewImageName);

$sql = "INSERT INTO cows( name, breed, gender, age, dairy, weight, height, color, image) VALUES ('$name', '$breed',
'$gender', '$age', '$dairy', '$weight', '$height', '$color', '$NewImageName')";

if (mysqli_query($conn, $sql)) {
// echo json_encode('updated');
echo "
<script>alert('YES');</script>";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}