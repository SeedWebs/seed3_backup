<header id="masthead" class="bg-white/90 backdrop-blur-sm drop-shadow sticky top-0 py-3 lg:py-4">
	<div class="container lg:flex lg:justify-between">
		<div class="flex justify-between items-center">
			<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="flex items-center gap-2 text-lg">
				<img src="<?php
echo esc_url( get_theme_file_uri( 'assets/logo.svg' ) ); ?>" alt="<?php bloginfo('name'); ?>" class="w-6 h-6 md:w-8 md:h-8">
				<span><?php bloginfo('name'); ?></span>
			</a>
			<button id="nav-btn" class="border border-slate-600 rounded px-2 py-1 lg:hidden text-sm">
				MENU
			</button>
		</div>
		<nav id="nav" class="transition duration-300 max-h-0 overflow-hidden [&_a]:block [&_a]:p-2 lg:[&_ul]:flex lg:[&_ul]:gap-5 lg:[&_a]:p-1 lg:max-h-none lg:flex ">
			<?php wp_nav_menu(['theme_location' => 'menu-1']);?>
		</nav>
	</div>
</header>
<style>
	@media screen and (max-width: 1023px){
		.nav-open #nav {
		max-height: 100vh;
		padding-top: 1rem;
		transition: padding 0.5s ease, max-height 0.2s ease;
		}
	}
</style>