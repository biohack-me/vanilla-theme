<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
<head>
	<script type="text/javascript" src="http://use.typekit.com/rvc0gsq.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<meta name="description" content="Biohack.me is a forum for the discussion of anything of relevance to the biohacking/grinder/wetware hacker community.">
   <?php $this->RenderAsset('Head'); ?>

	<script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-5024722-14']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
</head>
<body id="<?php echo $BodyIdentifier; ?>" class="<?php echo $this->CssClass; ?>">
	
	<div id="sitenav">
		<ul>
			<li><a href="http://discuss.biohack.me">discuss</a></li>
			<li><a href="http://collaborate.biohack.me">collaborate</a></li>
			<li><a href="http://chat.biohack.me">chat</a></li>
			<!--<li><a href="http://publish.biohack.me">publish</a></li>-->
			<!--<li>build</li>-->
			<li>&middot;</li>
			<li><a href="http://biohack.me/disclaimer.html">disclaimer</a></li>
		</ul>
	</div>
	<style>
		/* SITENAV */
		#sitenav ul {
			margin:0;
			padding:15px 0;
			text-align:center;
			font-weight:bold;
		}
		#sitenav li {
			display:inline-block;
			padding:6px 10px;
			color:#666;
			color:rgba(255,255,255,0.4);
		}
		#sitenav li a {
			color:#000;
			color:rgba(255,255,255,0.4);
			display:inline-block;
			text-decoration:none;
			padding:6px 10px;
			margin:-6px -10px;
		}
		#sitenav li a:hover {
			color:rgba(255,255,255,0.9);
		}
	</style>
		
   <div id="Frame">
      <div id="Head">
			<div id="HeadBeta">
         	<div class="Menu">
					<p>We&rsquo;re <a href="http://collaborate.biohack.me/">grinders</a>. We hack our bodies with artifacts from the future-present. </p>
         	   <!-- <h1><a class="Title" href="<?php echo Url('/'); ?>"><?php echo Gdn_Theme::Logo(); ?></a></h1> -->
         	   <?php
				      $Session = Gdn::Session();
						if ($this->Menu) {
							$this->Menu->AddLink('Dashboard', T('Dashboard'), '/dashboard/settings', array('Garden.Settings.Manage'));
							// $this->Menu->AddLink('Dashboard', T('Users'), '/user/browse', array('Garden.Users.Add', 'Garden.Users.Edit', 'Garden.Users.Delete'));
							$this->Menu->AddLink('Activity', T('Activity'), '/activity');
				         $Authenticator = Gdn::Authenticator();
							if ($Session->IsValid()) {
								$Name = $Session->User->Name;
								$CountNotifications = $Session->User->CountNotifications;
								if (is_numeric($CountNotifications) && $CountNotifications > 0)
									$Name .= ' <span>'.$CountNotifications.'</span>';
									
								$this->Menu->AddLink('User', $Name, '/profile/{UserID}/{Username}', array('Garden.SignIn.Allow'), array('class' => 'UserNotifications'));
								$this->Menu->AddLink('SignOut', T('Sign Out'), Gdn::Authenticator()->SignOutUrl(), FALSE, array('class' => 'NonTab SignOut'));
							} else {
								$Attribs = array();
								if (SignInPopup() && strpos(Gdn::Request()->Url(), 'entry') === FALSE)
									$Attribs['class'] = 'SignInPopup';
									
								$this->Menu->AddLink('Entry', T('Sign In'), Gdn::Authenticator()->SignInUrl(), FALSE, array('class' => 'NonTab'), $Attribs);
							}
							echo $this->Menu->ToString();
						}
					?>
         	   <div class="Search"><?php
						$Form = Gdn::Factory('Form');
						$Form->InputPrefix = '';
						echo 
							$Form->Open(array('action' => Url('/search'), 'method' => 'get')),
							// $Form->TextBox('Search', array('type' => 'search')),
							'<input type="search" id="Form_Search" name="Search" class="InputBox" placeholder="Search">',
							// $Form->Button('Go', array('Name' => '')),
							$Form->Close();
					?></div>
         	</div>
			</div>
      </div>
      <div id="Body">
         <div id="Content"><?php $this->RenderAsset('Content'); ?></div>
         <div id="Panel"><?php $this->RenderAsset('Panel'); ?></div>
			<div class="clear"></div>
      </div>
      <div id="Foot">
			<?php
				$this->RenderAsset('Foot');
			?>
		</div>
   </div>

	<?php $this->FireEvent('AfterBody'); ?>
</body>
</html>
