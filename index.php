<?php 
/*
RLPanel v2.0 | Coypright $CURRENT_YEAR, George Tsatsis.

RLPanel contains hardcoded locations and is specifically made to work with RLAPI and RLME's database ONLY. We will not provide support.
*/
/* Start the PHP Session */
session_start();

/* Is this a development environment? */
$testEnv = false; // Used to toggle test options on/off

/* Session Debugging */
if($testEnv == true){
$_SESSION['discordUserName'] = "Test";
$_SESSION['discordAvatar'] = "https://cdn.discordapp.com/avatars/367747734373007362/cd38202282ba4a7335d10ce2bb75ca99.png?size=128";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="RATELIMITED Dashboard" />
	<meta name="author" content="" />
	<meta content="The RATELIMITED User Dashboard allows for editing the meta tags of your images, managing your account on RATELIMITED and more!" property="og:description">
    <meta content="RATELIMITED &middot; Dashboard" property="og:title">
    <meta content="RATELIMITED Dashboard" property="og:site_name">
    <link rel="icon" href="https://ratelimited.me/logo_dark.png" />
    <meta content='https://ratelimited.me/logo_dark.png' property='og:image'>
    <meta content='image/png' property='og:image:type'>
    <meta content='1821' property='og:image:width'>
    <meta content='2082' property='og:image:height'>
    <meta name="theme-color" content="#2c3e50">

	<link rel="icon" href="assets/images/favicon.ico">

	<title>RLPanel | Dashboard</title>

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.3.min.js"></script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>

<?php
/* Load up Composer */
require 'vendor/autoload.php';

if($_SERVER['HTTP_USER_AGENT'] == "Mozilla/5.0 (compatible; Discordbot/2.0; +https://discordapp.com)"){
	die();
}
/* Force Authentication */
if(!isset($_SESSION['loggedInAs']) || empty($_SESSION['loggedInAs']) || !array_key_exists('loggedInAs', $_SESSION)){
	require 'libs/discordAuth.inc.php';
}

/* Requirements */
require 'api/statsDetails.inc.php';
require 'libs/authLib.inc.php';
require 'api/fileTablesListing.inc.php';
include_once (dirname(__FILE__) . '/__AntiAdBlock.php');
?>

<body class="page-body" data-url="http://neon.dev">

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-103855982-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-103855982-1');
</script>

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
	
	<div class="sidebar-menu">

		<div class="sidebar-menu-inner">
			
			<header class="logo-env">

				<!-- logo -->
				<div class="logo">
					<a href="index.html">
						<img src="assets/images/logo@2x.png" width="120" alt="" />
					</a>
				</div>

				<!-- logo collapse icon -->
				<div class="sidebar-collapse">
					<a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
						<i class="entypo-menu"></i>
					</a>
				</div>

								
				<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
				<div class="sidebar-mobile-menu visible-xs">
					<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
						<i class="entypo-menu"></i>
					</a>
				</div>

			</header>
			
									
			<ul id="main-menu" class="main-menu">
				<!-- add class "multiple-expanded" to allow multiple submenus to open -->
				<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
				<li class="has-sub">
					<a href="index.html">
						<i class="entypo-gauge"></i>
						<span class="title">Dashboard</span>
					</a>
					<ul>
						<li>
							<a href="index.php">
								<span class="title">User Dashboard</span>
							</a>
						</li>
						<?php if($userIsAdmin == true){
							echo "<li>
							<a href=\"dashboard-2.html\">
								<span class=\"title\">Dashboard 2</span>
							</a>
						</li>
						<li>
							<a href=\"dashboard-3.html\">
								<span class=\"title\">Dashboard 3</span>
							</a>
						</li>";}?>
					</ul>
				</li>
				<?php
				if($userIsAdmin == true){echo "<li class=\"has-sub\">
					<a href=\"forms-main.html\">
						<i class=\"entypo-doc-text\"></i>
						<span class=\"title\">Token Management Tools</span>
					</a>
					<ul>
						<li>
							<a href=\"https://panel.ratelimited.me/tokenGenerationTool.php\">
								<span class=\"title\">Token Generator</span>
							</a>
						</li>
						<li>
							<a href=\"forms-advanced.html\">
								<span class=\"title\">Advanced Plugins</span>
							</a>
						</li>
						<li>
							<a href=\"forms-wizard.html\">
								<span class=\"title\">Form Wizard</span>
							</a>
						</li>
						<li>
							<a href=\"forms-validation.html\">
								<span class=\"title\">Data Validation</span>
							</a>
						</li>
						<li>
							<a href=\"forms-masks.html\">
								<span class=\"title\">Input Masks</span>
							</a>
						</li>
						<li>
							<a href=\"forms-sliders.html\">
								<span class=\"title\">Sliders</span>
							</a>
						</li>
						<li>
							<a href=\"forms-file-upload.html\">
								<span class=\"title\">File Upload</span>
							</a>
						</li>
						<li>
							<a href=\"forms-wysiwyg.html\">
								<span class=\"title\">Editors</span>
							</a>
						</li>
					</ul>
				</li>
				<li class=\"has-sub\">
					<a href=\"tables-main.html\">
						<i class=\"entypo-window\"></i>
						<span class=\"title\">Tables</span>
					</a>
					<ul>
						<li>
							<a href=\"tables-main.html\">
								<span class=\"title\">Basic Tables</span>
							</a>
						</li>
						<li>
							<a href=\"tables-datatable.html\">
								<span class=\"title\">Data Tables</span>
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href=\"charts.html\">
						<i class=\"entypo-chart-bar\"></i>
						<span class=\"title\">Charts</span>
					</a>
				</li>
			</ul>";}?>
			
		</div>

	</div>

<!-- Hey, George, This is where you should start work! -->
	<div class="main-content">
				
		<div class="row">
		
			<!-- Profile Info and Notifications -->
			<div class="col-md-6 col-sm-8 clearfix">
		
				<ul class="user-info pull-left pull-none-xsm">
		
					<!-- Profile Info -->
					<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
		
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?php if(!empty($_SESSION['discordAvatar'])){echo $_SESSION['discordAvatar'];}else{echo "http://via.placeholder.com/120x120";} ?>" alt="" class="img-circle" width="44" />
							<?php if(!empty($_SESSION['discordUserName'])){echo $_SESSION['discordUserName'];}else{echo "Error in username parsing.";} ?>
						</a>
		
						<ul class="dropdown-menu">
		
							<!-- Reverse Caret -->
							<li class="caret"></li>
		
							<!-- Profile sub-links -->
							<li>
								<a href="#">
									<i class="entypo-user"></i>
									Edit Profile
								</a>
							</li>
		
							<li>
								<a href="#">
									<i class="entypo-mail"></i>
									Inbox
								</a>
							</li>
		
							<li>
								<a href="#">
									<i class="entypo-calendar"></i>
									Calendar
								</a>
							</li>
		
							<li>
								<a href="#">
									<i class="entypo-clipboard"></i>
									Tasks
								</a>
							</li>
						</ul>
					</li>
		
				</ul>
				
				<ul class="user-info pull-left pull-right-xs pull-none-xsm">
		
					<!-- Raw Notifications -->
					<li class="notifications dropdown">
		
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="entypo-attention"></i>
						</a>
		
						<ul class="dropdown-menu">
							<li class="top">
								<p class="small">
									<a href="#" class="pull-right">Mark all Read</a>
									You have <strong>no</strong> new notifications.
								</p>
							</li>
							
							<li>
								<ul class="dropdown-menu-list scroller">
									<li class="unread notification-success">
										<a href="#">
											<i class="entypo-user-add pull-right"></i>
											
											<span class="line">
												<strong>You know this is still WIP, right?</strong>
											</span>
											
											<span class="line small">
												30 seconds ago
											</span>
										</a>
									</li>
								</ul>
							</li>
							
							<li class="external">
								<a href="#">View all notifications</a>
							</li>
						</ul>
		
					</li>
		
					<!-- Message Notifications -->
					<li class="notifications dropdown">
		
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="entypo-mail"></i>
						</a>
		
						<ul class="dropdown-menu">
							<li>
								<form class="top-dropdown-search">
									
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Search anything..." name="s" />
									</div>
									
								</form>
								
								<ul class="dropdown-menu-list scroller">
									<li class="active">
										<a href="#">
											<span class="image pull-right">
												<img src="assets/images/thumb-1@2x.png" width="44" alt="" class="img-circle" />
											</span>
											
											<span class="line">
												<strong>George Tsatsis</strong>
												- yesterday
											</span>
											
											<span class="line desc small">
												Just stop looking in these, this is way too WIP for you to be looking!
											</span>
										</a>
									</li>
								</ul>
							</li>
							
							<li class="external">
								<a href="#">All Messages</a>
							</li>
						</ul>
		
					</li>
		
					<!-- Task Notifications -->
					<li class="notifications dropdown">
		
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="entypo-list"></i>
						</a>
		
						<ul class="dropdown-menu">
							<li class="top">
								<p>You have 0 pending tasks</p>
							</li>
							
							<li>
								<ul class="dropdown-menu-list scroller">
									<li>
										<a href="#">
											<span class="task">
												<span class="desc">This is unhealthy for me, I should sleep :/</span>
												<span class="percent">27%</span>
											</span>
										
											<span class="progress">
												<span style="width: 27%;" class="progress-bar progress-bar-success">
													<span class="sr-only">27% Complete</span>
												</span>
											</span>
										</a>
									</li>
								</ul>
							</li>
							
							<li class="external">
								<a href="#">See all tasks</a>
							</li>
						</ul>
		
					</li>
		
				</ul>
		
			</div>
		
		
			<!-- Raw Links -->
			<div class="col-md-6 col-sm-4 clearfix hidden-xs">
		
				<ul class="list-inline links-list pull-right">
		
					<!-- Language Selector -->
					<li class="dropdown language-selector">
		
						Language: &nbsp;
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
							<img src="assets/images/flags/flag-uk.png" width="16" height="16" />
						</a>
		
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="#">
									<img src="assets/images/flags/flag-de.png" width="16" height="16" />
									<span>Deutsch</span>
								</a>
							</li>
							<li class="active">
								<a href="#">
									<img src="assets/images/flags/flag-uk.png" width="16" height="16" />
									<span>English</span>
								</a>
							</li>
							<li>
								<a href="#">
									<img src="assets/images/flags/flag-fr.png" width="16" height="16" />
									<span>François</span>
								</a>
							</li>
							<li>
								<a href="#">
									<img src="assets/images/flags/flag-al.png" width="16" height="16" />
									<span>Shqip</span>
								</a>
							</li>
							<li>
								<a href="#">
									<img src="assets/images/flags/flag-es.png" width="16" height="16" />
									<span>Español</span>
								</a>
							</li>
						</ul>
		
					</li>
		
					<li class="sep"></li>
		
					<li>
						<a href="extra-login.html">
							Log Out <i class="entypo-logout right"></i>
						</a>
					</li>
				</ul>
		
			</div>
		
		</div>
		
		<hr />
		
			<script type="text/javascript">

		jQuery(document).ready(function($)
		{
			<?php
				if($testEnv == true){
					echo"
			// Sample Toastr Notification
			setTimeout(function()
			{
				var opts = {
					\"closeButton\": true,
					\"debug\": false,
					\"positionClass\": rtl() || public_vars.\$pageContainer.hasClass('right-sidebar') ? \"toast-top-left\" : \"toast-top-right\",
					\"toastClass\": \"black\",
					\"onclick\": null,
					\"showDuration\": \"300\",
					\"hideDuration\": \"1000\",
					\"timeOut\": \"5000\",
					\"extendedTimeOut\": \"1000\",
					\"showEasing\": \"swing\",
					\"hideEasing\": \"linear\",
					\"showMethod\": \"fadeIn\",
					\"hideMethod\": \"fadeOut\"
				};
		
				toastr.success(\"You have been awarded with 1 year free subscription. Enjoy it!\", \"Account Subcription Updated\", opts);
			}, 3000);";}?>
		});
		</script>
		
		
		<div class="row">
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-red">
					<div class="icon"><i class="entypo-users"></i></div>
					<div class="num" data-start="0" data-end="<?=$getRegisteredUsersCount;?>" data-postfix="" data-duration="1500" data-delay="0">0</div>
		
					<h3>Registered Users</h3>
					<p>Total registrations (Approved)</p>
				</div>
		
			</div>
		
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-green">
					<div class="icon"><i class="entypo-upload"></i></div>
					<div class="num" data-start="0" data-end="<?=$getTotalFilesUploadedCount;?>" data-postfix="" data-duration="1500" data-delay="600">0</div>
		
					<h3>Total Files Uploaded</h3>
					<p>Files uploaded since RLAPI was released. Does not include OwOAPI stats.</p>
				</div>
		
			</div>
			
			<div class="clear visible-xs"></div>
		
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-aqua">
					<div class="icon"><i class="entypo-upload"></i></div>
					<div class="num" data-start="0" data-end="<?=$filesTotalByUserRowCount;?>" data-postfix="" data-duration="1500" data-delay="1200">0</div>
		
					<h3>Total Files Uploaded By You</h3>
					<p>This is the total of files you have uploaded</p>
				</div>
		
			</div>
		
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-blue">
					<div class="icon"><i class="entypo-rss"></i></div>
					<div class="num" data-start="0" data-end="<?= $getSignupsPendingCount ?>" data-postfix="" data-duration="1500" data-delay="1800">0</div>
		
					<h3>Pending Signups</h3>
					<p>on our site right now.</p>
				</div>
		
			</div>
		</div>
		
		<br />
		
		<div class="row">
			<div class="col-sm-12">
					<script type="text/javascript">
		jQuery( document ).ready( function( $ ) {
			var $table1 = jQuery( '#table-1' );
			
			// Initialize DataTable
			$table1.DataTable( {
				"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				"bStateSave": true
			});
			
			// Initalize Select Dropdown after DataTables is created
			$table1.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
				minimumResultsForSearch: -1
			});
		} );
		</script>
		</br>
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>Filename</th>
					<th>Original Filename</th>
					<th>Timestamp</th>
					<th>MD5 Hash</th>
					<th>SHA1 Hash</th>
				</tr>
			</thead>
			<tbody>
			<?php
			                              foreach($getAllFilesByUserRows as $files){
                                        echo "<tr>";
                                        echo "<td><a href=\"https://ratelimited.me/" . $files['filename'] . "\">" . $files['filename'] . "</a></td>";
                                        echo "<td>" . $files['originalfilename'] . "</td>";
                                        echo "<td>" . gmdate("Y-m-d\TH:i:s\Z", $files['timestamp']) . "</td>";
                                        echo "<td>" . $files['md5hash'] . "</td>";
                                        echo "<td>" . $files['sha1hash'] . "</td>";
                                        }
                                        ?>
			</tbody>
			<tfoot>
				<tr>
					<th>Filename</th>
					<th>Original Filename</th>
					<th>Timestamp</th>
					<th>MD5 Hash</th>
					<th>SHA1 Hash</th>
				</tr>
			</tfoot>
		</table>
		
			</div>
		
		
		<!-- Footer -->
		<footer class="main">
			
			&copy; <?php echo date("Y"); ?> <strong>RATELIMITED</strong>
		
		</footer>
<!-- Hey, George, This is where you should end work! -->
	</div>

	
	
</div>


	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="assets/js/datatables/datatables.css">
	<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="assets/js/select2/select2.css">

	<!-- Bottom scripts (common) -->
	<script src="assets/js/gsap/TweenMax.min.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>


	<!-- Imported scripts on this page -->
	<script src="assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
	<script src="assets/js/jquery.sparkline.min.js"></script>
	<script src="assets/js/rickshaw/vendor/d3.v3.js"></script>
	<script src="assets/js/rickshaw/rickshaw.min.js"></script>
	<script src="assets/js/raphael-min.js"></script>
	<script src="assets/js/morris.min.js"></script>
	<script src="assets/js/toastr.js"></script>
	<script src="assets/js/datatables/datatables.js"></script>
	<script src="assets/js/select2/select2.min.js"></script>

	<!-- JavaScripts initializations and stuff -->
	<script src="assets/js/neon-custom.js"></script>


	<!-- Demo Settings -->
	<script src="assets/js/neon-demo.js"></script>

</body>
</html>
