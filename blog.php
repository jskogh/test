<?php include("incl/header.php"); 
	/* get blog content and display it with a title and a content */
	$db = new PDO("mysql:host=localhost;dbname=blog", "root", "root");
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$stm = $db->prepare("SELECT * FROM post");
	$html = "";
if($stm->execute()){
    while($row = $stm->fetch()){
        $html .= "<h2>" . $row["title"] . "</h2>";
        $html .= "<p>" . $row["text"] . "</p>";
        $html .= "<p class='date_text'>" . $row["date"] . "</p>";
        $html .= "<hr>" ;

        if(!empty($row["img"])){
            $html .= "<img src='{$row["img"]}' />";
            $html .= '<img src="' . $row["img"] . '"/>';
        }
    }

}
else{
    //If error, print the log!
    print_r($stm->errorInfo());
}
	
?>
	
<div id="blog">
	
	<div id="blog_name">
		<h1> johanna skogh </h1>
	</div>
	
	<div id="blog_content">
		<?php echo $html ?>
	
	</div>
	
	<div id="blog_sidebar">
	
	</div>
	
</div>