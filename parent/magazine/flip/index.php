


 
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="100,000+ Free eBooks in the Genres you Love | Junky Books,ebooks to read,free books online pdf,download books free pdf,pdf book free online,books for free online,free books online,books pdf,free books,free book,junkybooks,read books online,junky books,free who was books,free book download pdf,book for free to read online."/>
	<meta name="keywords" content="ebooks to read, free books online pdf, free ebook pdf, download free ebook pdf, download books free pdf, pdf book free online, books for free online, free books online, books pdf, free books, free book,junky books,read books online,junkybooks,free book download pdf,read books online free"/>
    <meta name="abstract" content="100,000+ Free eBooks in the Genres you Love: book, ebooks, pdfbook, pdf books, books,download books, read books, download free ebook pdf,"/>
	<title>Mindloops Magazine</title>
	<!-- <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png"> -->
	<link rel="stylesheet" type="text/css" href="css/flipbook.style.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	
</head>

<body>
    
	   
	<!-- shop-main-area-start -->
	 <div class="container" id="flipbook"></div>
	<!-- shop-main-area-end -->
	
	
		 
		
		
    <!-- all js here -->
    <!-- jquery latest version -->
    <script src="js/jquery-1.12.4.min.js"></script>
    <!-- popper js -->
    <script src="js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- owl.carousel js -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- meanmenu js -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- wow js -->
    <script src="js/wow.min.js"></script>
    <!-- jquery.parallax-1.1.3.js -->
    <script src="js/jquery.parallax-1.1.3.js"></script>
    <!-- jquery.countdown.min.js -->
    <script src="js/jquery.countdown.min.js"></script>
    <!-- jquery.flexslider.js -->
    <script src="js/jquery.flexslider.js"></script>
    <!-- chosen.jquery.min.js -->
    <script src="js/chosen.jquery.min.js"></script>
    <!-- jquery.counterup.min.js -->
    <script src="js/jquery.counterup.min.js"></script>
    <!-- waypoints.min.js -->
    <script src="js/waypoints.min.js"></script>
    <!-- plugins js -->
    <script src="js/plugins.js"></script>
    <!-- main js -->
    <script src="js/main.js"></script>
	<script src="js/sweetalert.min.js"></script>
	<script src="js/croppie.js"></script>
	<script src="js/flipbook.min.js"></script>
	<script src="js/junkybooks.js"></script> 
	<script type="text/javascript">
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const pageNum = parseInt(urlParams.get('pageNum'));
    const m_id = urlParams.get('m_id');
    var pages;

    // document.getElementById("back-button").setAttribute("href","magazine-description.php?m_id=" + m_id);
    
    var flipbookXHR = new XMLHttpRequest();

    flipbookXHR.open("get","../read-single-magazine.php?m_id=" + m_id);

    flipbookXHR.send();

    flipbookXHR.onload = function(){
// console.log(this.responseText);
        var flipbookJSONdata = JSON.parse(flipbookXHR.responseText);
        var maxpage = flipbookJSONdata[0].m_pageLimit;
        const filepath = flipbookJSONdata[0].m_filePath;
        let url = '../'+filepath;
        $("#flipbook").flipBook({
				 pdfUrl:'../../'+filepath
			});
            fetch(url).then(data=>data.text()).then(data=>{
                // console.log(data)
setTimeout(function(){
            document.querySelector('[title="Print"]').style.display='none'
            document.querySelector('[title="Download pages"]').style.display='none'
            document.querySelector('[title="Download PDF"]').style.display='none'
            document.querySelector('[title="Share"]').style.display='none'     
        },500)
            })
    }


	</script>
	
</body>
</html>