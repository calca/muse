<?php mu_header(); ?>
<body>
<div id="frame">
<!-- head -->
	<div id="head">
	<img src=<?php mu_theme_get_file("img/otticafuse.jpg") ?> alt="ottica fus�" alt="ottica fus�">
	</div>
<!-- end head -->

<!-- menu -->
	<div id="tabs">
  	<ul>
    		<li><a href="/" title="Home">Home</a></li>
    		<li><a href="/prodotti" title="Prodotti">Prodotti</a></li>
    		<li><a href="/negozio" title="Negozio">Negozio</a></li>
    		<li><a href="/dovesiamo" title="Dove Siamo">Dove siamo</a></li>
    		<li><a href="/contatti" title="Contatti">Contatti</a></li>
    	</ul>
	</div>
<!-- end menu-->

<!-- main -->
<div id="main">
<?php mu_page() ?>
</div>
<!-- end main -->
<div id="space"><div id="occhiali"><span>occhiali</span></div></div>
</div>

<?php mu_footer(); ?>
		
