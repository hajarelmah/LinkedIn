<//?php   
  $image = isset($_FILES["image"]) ? $_FILES["image"] : ""; 
$dir = "img/";
$file = basename($_FILES["image"]["name"]);
$path = $dir . $file;

    

    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

    $filename=$dir.date("his").".".$ext;
    $check = getimagesize($image["tmp_name"]);
    $ok = $check && in_array($ext, ["jpg", "png", "jpeg", "gif"]) && !file_exists($path);  
    
    if ($ok) move_uploaded_file($image["tmp_name"],$filename);
     
 
    echo json_encode(['imagename' => $filename]);

    ?>

    <?php   
$image = isset($_FILES["image"]) ? $_FILES["image"] : ""; 
$doc = isset($_FILES["doc"]) ? $_FILES["doc"] : ""; 
$video = isset($_FILES["video"]) ? $_FILES["video"] : ""; 

$dir = "uploads/";

// Gérer le téléchargement d'images
if (!empty($image)) {
    $imagePath = handleFileUpload($image, $dir);
    echo json_encode(['imagename' => $imagePath]);
} 
// Gérer le téléchargement de documents
elseif (!empty($doc)) {
    $docPath = handleFileUpload($doc, $dir);
    echo json_encode(['docname' => $docPath]);
} 
// Gérer le téléchargement de vidéos
elseif (!empty($video)) {
    $videoPath = handleFileUpload($video, $dir);
    echo json_encode(['videoname' => $videoPath]);
} else {
    echo json_encode(['error' => 'No file uploaded.']);
}

function handleFileUpload($file, $dir) {
    $fileName = basename($file["name"]);
    $filePath = $dir . $fileName;

    $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $allowedExtensions = ["jpg", "png", "jpeg", "gif", "pdf", "doc", "docx", "txt", "mp4", "avi", "mov"];

    // Vérifier si le fichier est valide et n'existe pas déjà
    if (in_array($ext, $allowedExtensions) && !file_exists($filePath)) {
        // Déplacer le fichier téléchargé vers le répertoire
        move_uploaded_file($file["tmp_name"], $filePath);
        return $filePath;
    } else {
        return null;
    }
}
?>

