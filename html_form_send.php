<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Contact Us | INS</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script src="html_form_send.php"></script>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
    <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.html"><img src="images/logo.png" width="120" height="90"></a>
                   </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.html"><strong>Home</strong></a></li>
                                <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>About Us</strong></a>
                        <ul class="dropdown-menu">
                        <li><a href="our-company.html"><strong>Our Company</strong> </a>
                          <li><a href="ins2020.html"><strong>INS 2020</strong> </a></li>
                        </ul>
                    </li>                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>Services</strong></a>
                        <ul class="dropdown-menu">
                            <li><a href="solutions.html"><strong>Solutions</strong> </a></li>
                            <li><a href="partners.html"><strong>Partners</strong></a></li>
                        </ul>
                    </li>
                    <li><a href="news.html"><strong>NEWS ROOM</strong></a></li>
                    <li class="active"><a href="contact-us.html"><strong>Contact Us</strong></a></li>
                    <li><a href="career.html"><strong>Careers</strong></a></li>
                </ul>
            </div>
        </div>
    </header><!--/header-->

    <section id="title" class="emerald">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1>CONTACT US</h1>
</div>
                <div class="col-sm-6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!--/#title-->    
			<div class="about-section w3-layouts">
				<div class="container">
					<div class="about-grids">
						
							<div class="col-md-8 about-grid wow fadeInRight animated animated" data-wow-delay="0.4s">
<?php
	if(isset($_REQUEST['name'])){ $name = $_REQUEST['name']; } //required
	if(isset($_REQUEST['Company'])){ $email_from = $_REQUEST['Company']; }
	if(isset($_REQUEST['CompanySize'])){ $companysize = $_REQUEST['CompanySize']; }
	if(isset($_REQUEST['email'])){ $email = $_REQUEST['email']; } // required
	if(isset($_REQUEST['telephone'])){ $telephone = $_REQUEST['telephone']; } // required
	if(isset($_REQUEST['comments'])){ $comments = $_REQUEST['comments']; } // required
								
	if(!empty($email)) {

		// validation expected data exists
		if(empty($name) || empty($telephone) || empty($comments)) {
			$error_message = "Name, Telephone and Comments are required fields.";
			errorAlert($error_message); 

		}else{

			$error_message = "";

			$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
			$string_exp = "/^[A-Za-z .'-]+$/";

			  if(!preg_match($email_exp,$email)) {
				$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
				  errorAlert($error_message); 
			  }else if(!preg_match($string_exp,$name)) {
				$error_message .= 'The Name you entered does not appear to be valid.<br />';
				  errorAlert($error_message); 
			  }else if(strlen($comments) < 2) {
				$error_message .= 'The Comments you entered do not appear to be valid.<br />';
				  errorAlert($error_message); 
			  }else{
				  
				// CHANGE THE TWO LINES BELOW
				$email_to = "info@insconsulting.com.au";
				$email_subject = "New Email From INS Consulting";
				  
				$email_message = "Form details below.\n\n";

				function clean_string($string) {
					$bad = array("content-type","bcc:","to:","cc:","href");
					return str_replace($bad,"",$string);
				}

				$email_message .= "Name: ".clean_string($name)."\n";
				$email_message .= "Company: ".clean_string($email_from)."\n";
				$email_message .= "CompanySize: ".clean_string($companysize)."\n";
				$email_message .= "Email: ".clean_string($email)."\n";
				$email_message .= "Telephone: ".clean_string($telephone)."\n";
				$email_message .= "Services Interested In: ".clean_string($comments)."\n";


				// create email headers
				$sender = $name . "<" . $email . ">";
				$headers = 'From: ' . $sender . "\r\n" . 'Reply-To: ' . $sender . "\r\n" . 'X-Mailer: PHP/' . phpversion();
				  
				mail($email_to, $email_subject, $email_message, $headers);  

				echo '<h2 class="title"><p>Thank you for filling out our form.</p>
				<p>A team member from INS consulting will contact you shortly.</p>
 
				<p>In the meantime check out our website to find out more about our company & services</p>
				<p>Thank you.</p></h2>';

			  }

		}

	}else{
		$error_message = "An email address is required.";
		errorAlert($error_message);
	}

	function errorAlert($received_error) {
		// your error code can go here
		echo '<h2>An error occurred submitting your form:</h2><br>';
		echo '<h2>' . $received_error . "</h5><br>";
		echo '<h2>Please go back and fix these, thank you.</h2>';
	}
?>

</div>
					<div class="col-md-4 about-grid1 wow fadeInLeft animated animated" data-wow-delay="0.4s">

							</div>
						</div>
				</div>
	</div>
						

				<div style="clear: both"></div>

<section id="bottom" class="list-group-item">
        <div class="container">
            <div class="row"><!--/.col-md-3--><!--/.col-md-3--><!--/.col-md-3-->

              <div class="col-md-3 col-sm-6"> 
                <h6><strong>Address:</strong> </h6>
                <h6><strong>INS Consulting </strong></h6>
                <h6>                    <strong>Footscary |
                  Victoria | 3011</strong></h6>
				  <h6>                    <strong><a href="tel:03 9448 8168">03 9448 8168</a> </strong><strong>|
					<a href="mailto:support@insconsulting.com.au">support@insconsulting.com.au</a></strong></strong></h6>
              </div> 
                <!--/.col-md-3-->
            </div>
        </div>
    </section><!--/#bottom-->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h6>&copy; 2017 INS Consulting. All Rights Reserved.
                    </h6>
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="index.html"><strong>Home</strong></a></li>
                        <li><a href="our-company.html"><strong>Our Company</strong></a></li>
                        <li><a href="solutions.html"><strong>Solutions</strong></a></li>
                        <li><a href="contact-us.html"><strong>Contact Us</strong></a></li>
                        <li><a
                        href="career.html"><strong>Careers</strong></a></li>
                        <li><a  id="gototop" class="gototop" href="#"><i class="icon-chevron-up"></i></a></li><!--#gototop-->
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>