<div class="page-loader">
            <div class="page-loader__spinner">
               <svg viewBox="25 25 50 50">
                  <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
               </svg>
            </div>
         </div>
         <header class="header">
            <div class="navigation-trigger hidden-xl-up" data-ma-action="aside-open" data-ma-target=".sidebar">
               <div class="navigation-trigger__inner">
                  <i class="navigation-trigger__line"></i>
                  <i class="navigation-trigger__line"></i>
                  <i class="navigation-trigger__line"></i>
               </div>
            </div>
            <div class="header__logo hidden-sm-down">
               <h1><a href="<?php echo base_url();?>">Mellydia</a></h1>
            </div>
         </header>
         <aside class="sidebar">
            <div class="scrollbar-inner">
               <div class="user">
                  <div class="user__info" data-toggle="dropdown">
                     <img class="user__img" src="<?php echo base_url();?>assets/demo/img/profile-pics/4.jpg" alt="">
                     <div>
                        <div class="user__name"><?php echo ucwords($login->nama_admin);?></div>
                        <!--<div class="user__email">Owner</div>-->
                     </div>
                  </div>
                  <div class="dropdown-menu">
                     <a class="dropdown-item" href="">Settings</a>
                     <a class="dropdown-item" href="<?php echo base_url();?>home/logout">Logout</a>
                  </div>
               </div>
               <ul class="navigation">
				<li><a href="<?php echo base_url();?>">Home</a></li>
				<?php foreach ($modul as $k) { ?>
					<li class="navigation__sub">
					<a data-toggle="collapse" href="#xmod<?php echo $k->id_modul;?>" role="button" aria-expanded="false" aria-controls="xmod<?php echo $k->id_modul;?>"><?php echo $k->nama_modul;?> <i class="zmdi zmdi-chevron-down zmdi-hc-fw"></i></a>
						<div class="collapse xmenu" id="xmod<?php echo $k->id_modul;?>">
						<ul style="padding-left: 10px;">
						<?php foreach ($akses as $key) {
							if($key->modul_id == $k->id_modul) { ?>
							<li><a href="<?php echo base_url().$key->link;?>"><?php echo $key->nama_akses;?></a></li>	
						<?php }
						} ?>
						</ul><br>
						</div>
                    </li>
				<?php } ?>
                  <!--<li><a href="home.html"><i class="zmdi zmdi-home"></i> Home</a></li>
				  <li><a href="bahan.html"><i class="zmdi zmdi-widgets"></i> Bahan Baku</a></li>
				  <li><a href="produksi.html"><i class="zmdi zmdi-group-work"></i> Produksi</a></li>
				  <li><a href="penjualan.html"><i class="zmdi zmdi-swap-alt"></i> Penjualan</a></li>
				  <li class="navigation__sub">
                            <a href=""><i class="zmdi zmdi-collection-item"></i> Sample Pages</a>

                            <ul>
                                <li><a href="profile-about.html">Profile</a></li>
                                <li><a href="messages.html">Messages</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="new-contact.html">New Contact</a></li>
                                <li><a href="groups.html">Groups</a></li>
                                <li><a href="pricing-tables.html">Pricing Tables</a></li>
                                <li><a href="invoice.html">Invoice</a></li>
                                <li><a href="todo-lists.html">Todo Lists</a></li>
                                <li><a href="notes.html">Notes</a></li>
                                <li><a href="search-results.html">Search Results</a></li>
                                <li><a href="issue-tracker.html">Issue Tracker</a></li>
                                <li><a href="faq.html">FAQ</a></li>
                                <li><a href="team.html">Team</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="blog-details.html">Blog Details</a></li>
                                <li><a href="questions-answers.html">Questions &amp; Answers</a></li>
                                <li><a href="questions-answers-details.html">Questions &amp; Answers Details</a></li>
                                <li><a href="login.html">Login &amp; SignUp</a></li>
                                <li><a href="lockscreen.html">Lockscreen</a></li>
                                <li><a href="404.html">404</a></li>
                                <li><a href="empty.html">Empty Page</a></li>
                            </ul>
                        </li>-->
               </ul>
            </div>
         </aside>