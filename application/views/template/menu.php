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
                     <!--<a class="dropdown-item" href="">Settings</a>-->
                     <a class="dropdown-item" href="<?php echo base_url();?>home/logout">Logout</a>
                  </div>
               </div>
               <ul class="navigation">
				<li><a href="<?php echo base_url();?>">Home</a></li>
				<?php $nem_menu = array();
				foreach ($modul as $k) {
					$new_m = array();
					foreach ($akses as $key) {
						if($key->modul_id == $k->id_modul) {
							$new_m[] = array($key->link,$key->nama_akses);
						}
					}
					if($new_m != NULL) {
					$nem_menu[$k->nama_modul] = $new_m;
					}
				} 
				$num_mod =1;
				foreach ($nem_menu as $k => $v) {
				?>
					<li class="navigation__sub">
					<a data-toggle="collapse" href="#xmod<?php echo $num_mod;?>" role="button" aria-expanded="false" aria-controls="xmod<?php echo $num_mod;?>"><?php echo $k;?> <i class="zmdi zmdi-chevron-down zmdi-hc-fw"></i></a>
						<div class="collapse xmenu" id="xmod<?php echo $num_mod;?>">
						<ul style="padding-left: 10px;">
						<?php foreach ($v as $vv) { ?>
							<li><a href="<?php echo base_url().$vv[0];?>"><?php echo $vv[1];?></a></li>	
						<?php } ?>
						</ul><br>
						</div>
                    </li>
				<?php $num_mod++; } ?>
               </ul>
            </div>
         </aside>