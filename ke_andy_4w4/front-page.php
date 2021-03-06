<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theme4w4ed
 */

get_header();
?>
	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>
			<header class="page-header">
			<section id="annonce"></section>
			<h1 class='page-title'>Accueil</h1>
				<?php
				// the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<section class="list-cours">
				<?php
				/* Start the Loop */
				$precedent = "XXXXXXX";
				$ctrl_radio = '';
				while ( have_posts() ) :
					the_post();
					// 582-1J1 Animation et interactivité en jeu (75h)
					convertir_tableau($tPropriété);
					if ($precedent != $tPropriété['typeCours']): ?>

					  	<?php if ($precedent != "XXXXXXX"): ?>

							</section>
						<?php endif;?>
						<?php if (in_array( $precedent, ['Web', 'Jeu', 'Spécifique', 'Conception', 'Image 2d/3d'])): ?>	
							<section class="ctrl-carrousel">
								<?php echo $ctrl_radio;
									$ctrl_radio = '';
								?>
							</section>
						<?php endif;?>
						<h2><?php echo $tPropriété['typeCours'] ?></h2>
						<section <?php echo class_bloc($tPropriété['typeCours']) ?>>
					<?php endif;?>	
					<?php 
					if ( in_array( $tPropriété['typeCours'], ['Web', 'Jeu', 'Spécifique', 'Conception', 'Image 2d/3d']) ): 
						get_template_part( 'template-parts/content', 'carrousel' );
						$ctrl_radio .= '<input type="radio" name="rad-'. $tPropriété['typeCours'] .'">';

						elseif ($tPropriété['typeCours'] == "Projet"):
							get_template_part( 'template-parts/content', 'galerie' );

					 else:
						get_template_part( 'template-parts/content', 'bloc' );
					endif; 
					$precedent = $tPropriété['typeCours'];
				endwhile; ?>
			</section>

			 <!-- FORMULAIRE AJOUT D'UN NOUVEL ARTICLE DANS LA CATEGORIE 'Nouvelles' -->

			 <section class="admin-rapide">
				<h3>Ajouter une nouvelle</h3>
					<input type="text" name="title" placeholder="Titre">
					<textarea name="content" placeholder="Contenu"></textarea>
					<button id="bout-rapide">Créer une nouvelle</button>
			 </section>

			<section class="nouvelles">
<!-- 				<button id="bouton_nouvelles">Dernières nouvelles</button> -->
				<section></section>
			</section>
		<?php endif; ?>
	

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();

function convertir_tableau(&$tPropriété){
	$titre_grand = get_the_title();  
	$tPropriété['session'] = substr($titre_grand, 4,1);
	$tPropriété['nbHeure'] = substr($titre_grand,-4,3 );
	$tPropriété['titre'] = substr($titre_grand,8, -6);
	$tPropriété['sigle'] = substr($titre_grand,0, 7);
	$tPropriété['typeCours'] = get_field('type_de_cours'); 
}

function class_bloc($type_de_cours)
{
	if (in_array($type_de_cours, ['Web', 'Jeu', 'Spécifique', 'Conception', 'Image 2d/3d']))
	{
		return ('class="carrousel-2"');
	}

	elseif ($type_de_cours == "Projet")
	{
		return ('class="galerie"');
	}

	else
	{
		return('class="bloc"');
	}
}
