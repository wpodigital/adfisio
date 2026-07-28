<?php
// Setup Theme
add_action( 'after_setup_theme', 'ad_fisioterapia_setup' );
function ad_fisioterapia_setup() {
	load_theme_textdomain( 'ad_fisioterapia', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'navigation-widgets' ) );
	add_theme_support( 'woocommerce' );

	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1380;
	}

	register_nav_menus(
		array(
			'main-menu'   => esc_html__( 'Main Menu', 'ad_fisioterapia' ),
			'mobile-menu' => esc_html__( 'Mobile Menu', 'ad_fisioterapia' ),
		)
	);
}

// Admin Notes
add_action( 'admin_notices', 'ad_fisioterapia_notice' );
function ad_fisioterapia_notice() {
	$user_id   = get_current_user_id();
	$admin_url = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$param     = count( $_GET ) ? '&' : '?';

	if ( ! get_user_meta( $user_id, 'ad_fisioterapia_notice_dismissed_8', true ) && current_user_can( 'manage_options' ) ) {
		echo '<div class="notice notice-info"><p>';
		echo '<a href="' . esc_url( $admin_url . $param . 'dismiss' ) . '" class="alignright" style="text-decoration:none"><big>' . esc_html__( 'Ⓧ', 'blankslate' ) . '</big></a>';
		echo wp_kses_post( __( '<big><strong>📝 Thank you for using BlankSlate!</strong></big>', 'blankslate' ) );
		echo '<br /><br />';
		echo '<a href="https://wordpress.org/support/theme/blankslate/reviews/#new-post" class="button-primary" target="_blank">' . esc_html__( 'Review', 'blankslate' ) . '</a> ';
		echo '<a href="https://github.com/tidythemes/blankslate/issues" class="button-primary" target="_blank">' . esc_html__( 'Feature Requests & Support', 'blankslate' ) . '</a> ';
		echo '<a href="https://calmestghost.com/donate" class="button-primary" target="_blank">' . esc_html__( 'Donate', 'blankslate' ) . '</a>';
		echo '</p></div>';
	}
}

// Admin Init
add_action( 'admin_init', 'ad_fisioterapia_notice_dismissed' );
function ad_fisioterapia_notice_dismissed() {
	$user_id = get_current_user_id();
	if ( isset( $_GET['dismiss'] ) ) {
		add_user_meta( $user_id, 'ad_fisioterapia_notice_dismissed_8', 'true', true );
	}
}

// Load Styles & Scripts
add_action( 'wp_enqueue_scripts', 'ad_fisioterapia_enqueue' );
function ad_fisioterapia_enqueue() {
	$child_uri  = get_stylesheet_directory_uri();
	$parent_uri = get_template_directory_uri();

	wp_enqueue_script( 'jquery' );

	// Parent theme CSS
	wp_enqueue_style(
		'blankslate-parent-style',
		$parent_uri . '/style.css',
		array(),
		wp_get_theme( get_template() )->get( 'Version' )
	);

	// Child theme CSS
	wp_enqueue_style(
		'ad-fisioterapia-style',
		get_stylesheet_uri(),
		array( 'blankslate-parent-style' ),
		wp_get_theme()->get( 'Version' )
	);

	// Extra CSS
	wp_enqueue_style(
		'ad_fisioterapia',
		$child_uri . '/assets/css/build/main.min.css',
		array( 'ad-fisioterapia-style' ),
		'1.0'
	);

	// JS
	wp_enqueue_script(
		'bootstrap-bundle',
		$child_uri . '/assets/css/src/bootstrap/dist/js/bootstrap.bundle.min.js',
		array( 'jquery' ),
		'1.0',
		true
	);

	wp_enqueue_script(
		'ad_fisioterapia',
		$child_uri . '/assets/js/build/app.min.js',
		array( 'jquery' ),
		'1.0',
		true
	);
}

// Load Styles & Scripts to Admin
add_action( 'admin_enqueue_scripts', 'ad_fisioterapia_admin_styles' );
function ad_fisioterapia_admin_styles() {
	wp_enqueue_style(
		'ad_fisioterapia_admin',
		get_stylesheet_directory_uri() . '/assets/css/build/main.min.css',
		array(),
		'1.0'
	);
}

// Footer
add_action( 'wp_footer', 'ad_fisioterapia_footer' );
function ad_fisioterapia_footer() {
	?>
	<script>
		jQuery(document).ready(function($) {
			var deviceAgent = navigator.userAgent.toLowerCase();

			if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
				$("html").addClass("ios");
				$("html").addClass("mobile");
			}

			if (deviceAgent.match(/(Android)/)) {
				$("html").addClass("android");
				$("html").addClass("mobile");
			}

			if (navigator.userAgent.search("MSIE") >= 0) {
				$("html").addClass("ie");
			} else if (navigator.userAgent.search("Chrome") >= 0) {
				$("html").addClass("chrome");
			} else if (navigator.userAgent.search("Firefox") >= 0) {
				$("html").addClass("firefox");
			} else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
				$("html").addClass("safari");
			} else if (navigator.userAgent.search("Opera") >= 0) {
				$("html").addClass("opera");
			}
		});
	</script>
	<?php
}

// Document Title
add_filter( 'document_title_separator', 'ad_fisioterapia_document_title_separator' );
function ad_fisioterapia_document_title_separator( $sep ) {
	$sep = esc_html( '|' );
	return $sep;
}

// Title
add_filter( 'the_title', 'ad_fisioterapia_title' );
function ad_fisioterapia_title( $title ) {
	if ( $title === '' ) {
		return esc_html( '...' );
	}
	return wp_kses_post( $title );
}

// Schema Declaration
function ad_fisioterapia_schema_type() {
	$schema = 'https://schema.org/';

	if ( is_single() ) {
		$type = 'Article';
	} elseif ( is_author() ) {
		$type = 'ProfilePage';
	} elseif ( is_search() ) {
		$type = 'SearchResultsPage';
	} else {
		$type = 'WebPage';
	}

	echo 'itemscope itemtype="' . esc_url( $schema ) . esc_attr( $type ) . '"';
}

// Nav Link Attributes
add_filter( 'nav_menu_link_attributes', 'ad_fisioterapia_schema_url', 10 );
function ad_fisioterapia_schema_url( $atts ) {
	$atts['itemprop'] = 'url';
	return $atts;
}

// WP Open
if ( ! function_exists( 'ad_fisioterapia_wp_body_open' ) ) {
	function ad_fisioterapia_wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

add_action( 'wp_body_open', 'ad_fisioterapia_skip_link', 5 );
function ad_fisioterapia_skip_link() {
	echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'ad_fisioterapia' ) . '</a>';
}

// Read More Link
add_filter( 'the_content_more_link', 'ad_fisioterapia_read_more_link' );
function ad_fisioterapia_read_more_link() {
	if ( ! is_admin() ) {
		return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'ad_fisioterapia' ), '<span class="screen-reader-text"> ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
	}
	return null;
}

// Excerpt More
add_filter( 'excerpt_more', 'ad_fisioterapia_excerpt_read_more_link' );
function ad_fisioterapia_excerpt_read_more_link( $more ) {
	if ( ! is_admin() ) {
		global $post;
		if ( isset( $post->ID ) ) {
			return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">' . sprintf( __( '...%s', 'ad_fisioterapia' ), '<span class="screen-reader-text"> ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
		}
	}
	return $more;
}

// Image Size Threshold
add_filter( 'big_image_size_threshold', '__return_false' );
add_filter( 'intermediate_image_sizes_advanced', 'ad_fisioterapia_image_insert_override' );
function ad_fisioterapia_image_insert_override( $sizes ) {
	unset( $sizes['medium_large'] );
	unset( $sizes['1536x1536'] );
	unset( $sizes['2048x2048'] );
	return $sizes;
}

// Widgets Init
add_action( 'widgets_init', 'ad_fisioterapia_widgets_init' );
function ad_fisioterapia_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar Widget Area', 'ad_fisioterapia' ),
			'id'            => 'primary-widget-area',
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Last News', 'ad_fisioterapia' ),
			'id'            => 'last-news',
			'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Last Reviews', 'ad_fisioterapia' ),
			'id'            => 'last-reviews',
			'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Logo', 'ad_fisioterapia' ),
			'id'            => 'footer_logo',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Menu', 'ad_fisioterapia' ),
			'id'            => 'footer_menu',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Contact', 'ad_fisioterapia' ),
			'id'            => 'footer_contact',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Kit', 'ad_fisioterapia' ),
			'id'            => 'footer_kit',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Legal Menu', 'ad_fisioterapia' ),
			'id'            => 'footer_legal',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);
}

// WP Head
add_action( 'wp_head', 'ad_fisioterapia_pingback_header' );
function ad_fisioterapia_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

// Before Comments
add_action( 'comment_form_before', 'ad_fisioterapia_enqueue_comment_reply_script' );
function ad_fisioterapia_enqueue_comment_reply_script() {
	if ( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

// Custom Pings
function ad_fisioterapia_custom_pings( $comment ) {
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<?php echo wp_kses_post( get_comment_author_link( $comment ) ); ?>
	</li>
	<?php
}

// Comments counter
add_filter( 'get_comments_number', 'ad_fisioterapia_comment_count', 0 );
function ad_fisioterapia_comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$get_comments     = get_comments( 'status=approve&post_id=' . $id );
		$comments_by_type = separate_comments( $get_comments );
		$only_comments    = isset( $comments_by_type['comment'] ) ? $comments_by_type['comment'] : array();
		return count( $only_comments );
	}
	return $count;
}

function custom_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

function autoreferential_canonical_for_pagination( $canonical ) {
	if ( is_paged() ) {
		$paged       = max( 1, get_query_var( 'paged' ) );
		$current_url = trailingslashit( get_pagenum_link( $paged ) );
		return esc_url( $current_url );
	}
	return $canonical;
}
add_filter( 'wpseo_canonical', 'autoreferential_canonical_for_pagination' );

function custom_comment_form_fields( $fields ) {
	unset( $fields['url'] );

	$comment_field = isset( $fields['comment'] ) ? $fields['comment'] : '';
	unset( $fields['comment'] );

	$fields = array(
		'author'  => isset( $fields['author'] ) ? $fields['author'] : '',
		'email'   => '<p class="comment-form-email"><label for="email">Email <span class="required">*</span></label><input id="email" name="email" type="email" value="" size="30" maxlength="100" required="required"></p>',
		'comment' => $comment_field,
	);

	return $fields;
}
add_filter( 'comment_form_fields', 'custom_comment_form_fields' );

function custom_comment_form_defaults( $defaults ) {
	$defaults['title_reply']  = __( 'Deja tu comentario' );
	$defaults['label_submit'] = __( 'Enviar comentario' );
	return $defaults;
}
add_filter( 'comment_form_defaults', 'custom_comment_form_defaults' );

function filtrar_notificaciones_comentarios( $emails, $comment_id ) {
	$usuario_a_excluir = 'redaccion@acceseo.com';
	$emails            = array_diff( $emails, array( $usuario_a_excluir ) );
	return $emails;
}
add_filter( 'comment_notification_recipients', 'filtrar_notificaciones_comentarios', 10, 2 );

add_action(
	'wp_head',
	function() {
		if ( is_admin() ) {
			return;
		}

		global $post;
		if ( isset( $post ) && (int) $post->ID === 13871 ) {
			return;
		}
		?>
		<script>
			window.aichatbotApiKey = "d4e69d8e-bcf3-4380-9f0d-ba90d056c630";
			window.aichatbotProviderId = "f9e9c5e4-6d1a-4b8c-8d3f-3f9e9c5e46d1";
		</script>
		<script src="https://script.chatlab.com/aichatbot.js" id="d4e69d8e-bcf3-4380-9f0d-ba90d056c630" defer></script>
		<?php
	},
	99
);

// Ajutes schema BRUNO
add_filter(
	'rocket_exclude_defer_js',
	function( $excluded_files ) {
		$excluded_files[] = 'ld+json';
		return $excluded_files;
	}
);

// Cambiar h4 posts de noticias a p
add_filter(
	'the_content',
	function( $content ) {
		$pattern = '~<h4\b([^>]*)\bclass=(["\'])([^"\']*)\2([^>]*)>(.*?)</h4>~is';

		$content = preg_replace_callback(
			$pattern,
			function( $m ) {
				$before  = $m[1];
				$quote   = $m[2];
				$classes = $m[3];
				$after   = $m[4];
				$inner   = $m[5];

				$classList = preg_split( '/\s+/', trim( $classes ) );

				if ( in_array( 'uagb-post__title', $classList, true ) && in_array( 'uagb-post__text', $classList, true ) ) {
					return '<p' . $before . 'class=' . $quote . $classes . $quote . $after . '>' . $inner . '</p>';
				}

				return $m[0];
			},
			$content
		);

		return $content;
	},
	20
);

// =====================================
// CPT PRODUCTO
// =====================================
function ad_registrar_cpt_producto() {
	$labels = array(
		'name'               => 'Productos',
		'singular_name'      => 'Producto',
		'menu_name'          => 'Productos',
		'name_admin_bar'     => 'Producto',
		'add_new'            => 'Añadir nuevo',
		'add_new_item'       => 'Añadir nuevo producto',
		'edit_item'          => 'Editar producto',
		'new_item'           => 'Nuevo producto',
		'view_item'          => 'Ver producto',
		'all_items'          => 'Todos los productos',
		'search_items'       => 'Buscar productos',
		'not_found'          => 'No se han encontrado productos',
		'not_found_in_trash' => 'No se han encontrado productos en la papelera',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'has_archive'        => 'productos',
		'rewrite'            => array(
			'slug'       => 'productos',
			'with_front' => false,
		),
		'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'menu_icon'          => 'dashicons-products',
		'menu_position'      => 20,
	);

	register_post_type( 'producto', $args );
}
add_action( 'init', 'ad_registrar_cpt_producto', 5 );

// =====================================
// TAXONOMÍA PRODUCTO_CAT
// =====================================
function ad_registrar_taxonomia_producto_cat() {
	$labels = array(
		'name'              => 'Categorías de producto',
		'singular_name'     => 'Categoría de producto',
		'search_items'      => 'Buscar categorías de producto',
		'all_items'         => 'Todas las categorías de producto',
		'parent_item'       => 'Categoría padre',
		'parent_item_colon' => 'Categoría padre:',
		'edit_item'         => 'Editar categoría de producto',
		'update_item'       => 'Actualizar categoría de producto',
		'add_new_item'      => 'Añadir nueva categoría de producto',
		'new_item_name'     => 'Nuevo nombre de categoría de producto',
		'menu_name'         => 'Categorías de producto',
	);

	$args = array(
		'hierarchical'       => true,
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_admin_column'  => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array(
			'slug'         => 'categoria-producto',
			'with_front'   => false,
			'hierarchical' => true,
		),
	);

	register_taxonomy( 'producto_cat', array( 'producto' ), $args );
}
add_action( 'init', 'ad_registrar_taxonomia_producto_cat', 5 );

// =====================================
// META BOX PRODUCTO: RATING + URL
// =====================================
function ad_producto_meta_box() {
	add_meta_box(
		'ad_producto_detalles',
		'Detalles del producto',
		'ad_producto_meta_box_callback',
		'producto',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'ad_producto_meta_box' );

function ad_producto_meta_box_callback( $post ) {
	wp_nonce_field( 'ad_guardar_producto_meta', 'ad_producto_meta_nonce' );

	$producto_rating = get_post_meta( $post->ID, 'producto_rating', true );
	$producto_url    = get_post_meta( $post->ID, 'producto_url', true );
	?>
	<p>
		<label for="producto_rating"><strong>Puntuación (1 a 5)</strong></label><br>
		<select name="producto_rating" id="producto_rating">
			<option value="">Selecciona una puntuación</option>
			<option value="1" <?php selected( $producto_rating, '1' ); ?>>1 estrella</option>
			<option value="2" <?php selected( $producto_rating, '2' ); ?>>2 estrellas</option>
			<option value="3" <?php selected( $producto_rating, '3' ); ?>>3 estrellas</option>
			<option value="4" <?php selected( $producto_rating, '4' ); ?>>4 estrellas</option>
			<option value="5" <?php selected( $producto_rating, '5' ); ?>>5 estrellas</option>
		</select>
	</p>

	<p>
		<label for="producto_url"><strong>Enlace externo del producto</strong></label><br>
		<input
			type="url"
			name="producto_url"
			id="producto_url"
			value="<?php echo esc_attr( $producto_url ); ?>"
			style="width:100%;"
			placeholder="https://ejemplo.com/producto"
		>
	</p>
	<?php
}

function ad_guardar_producto_meta( $post_id ) {
	if ( ! isset( $_POST['ad_producto_meta_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['ad_producto_meta_nonce'], 'ad_guardar_producto_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['post_type'] ) && 'producto' === $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	if ( isset( $_POST['producto_rating'] ) ) {
		$rating = sanitize_text_field( wp_unslash( $_POST['producto_rating'] ) );
		$rating = in_array( $rating, array( '1', '2', '3', '4', '5' ), true ) ? $rating : '';
		update_post_meta( $post_id, 'producto_rating', $rating );
	}

	if ( isset( $_POST['producto_url'] ) ) {
		update_post_meta( $post_id, 'producto_url', esc_url_raw( wp_unslash( $_POST['producto_url'] ) ) );
	}
}
add_action( 'save_post', 'ad_guardar_producto_meta' );

// Redirect single producto posts to their external URL (no WordPress product detail page)
function ad_redirect_producto_to_external_url() {
	if ( is_singular( 'producto' ) ) {
		$producto_url = get_post_meta( get_the_ID(), 'producto_url', true );
		if ( ! empty( $producto_url ) ) {
			wp_redirect( esc_url_raw( $producto_url ), 301 );
			exit;
		}
	}
}
add_action( 'template_redirect', 'ad_redirect_producto_to_external_url' );

// Flush una sola vez
function ad_flush_rewrite_producto_cat_once() {
	if ( get_option( 'ad_flush_producto_cat_done' ) ) {
		return;
	}

	ad_registrar_cpt_producto();
	ad_registrar_taxonomia_producto_cat();
	flush_rewrite_rules();

	update_option( 'ad_flush_producto_cat_done', 1 );
}
add_action( 'init', 'ad_flush_rewrite_producto_cat_once', 99 );

//-------------------- NO TOCAR, PRIMIA SOLUTIONS------------------------------------------
// Habilitar campos de Yoast SEO en la API REST de WordPress para n8n Content Generator V4
function register_yoast_meta_in_rest() {
	register_rest_field(
		'post',
		'yoast_description',
		array(
			'get_callback'    => function( $post ) {
				return get_post_meta( $post->ID, '_yoast_wpseo_metadesc', true );
			},
			'update_callback' => function( $value, $post ) {
				return update_post_meta( $post->ID, '_yoast_wpseo_metadesc', sanitize_text_field( $value ) );
			},
			'schema'          => array(
				'type'        => 'string',
				'description' => 'Meta description for Yoast SEO',
			),
		)
	);

	register_rest_field(
		'post',
		'yoast_keyword',
		array(
			'get_callback'    => function( $post ) {
				return get_post_meta( $post->ID, '_yoast_wpseo_focuskw', true );
			},
			'update_callback' => function( $value, $post ) {
				return update_post_meta( $post->ID, '_yoast_wpseo_focuskw', sanitize_text_field( $value ) );
			},
			'schema'          => array(
				'type'        => 'string',
				'description' => 'Focus keyword for Yoast SEO',
			),
		)
	);
}
add_action( 'rest_api_init', 'register_yoast_meta_in_rest' );

//BRUNO
//ELIMINAR JQUERY MIGRATE
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );

function remove_jquery_migrate( $scripts ) {

	if ( empty( $scripts->registered['jquery'] ) || is_admin() ) {
		return;
	}

	$deps = & $scripts->registered['jquery']->deps;

	$deps = array_diff( $deps, [ 'jquery-migrate' ] );
}
//NUNITO SANS FONT OVERRIDE
add_action( 'wp_enqueue_scripts', 'add_font_override_css', 999 );
function add_font_override_css() {
    $child_uri = get_stylesheet_directory_uri();
    
    // Crear un CSS override que se carga después del main.min.css
    wp_register_style(
        'font-overrides',
        false, // No es un archivo, usaremos inline
        array( 'ad_fisioterapia' ) // Se carga después del CSS principal
    );
    wp_enqueue_style( 'font-overrides' );
    
    // CSS inline para anular las fuentes problemáticas
    wp_add_inline_style( 'font-overrides', '
        /* Eliminar descarga redundante de NunitoSans-Normal.ttf */
        /* El navegador ignorará esta fuente si ya tiene Nunito Sans */
        @font-face {
            font-family: "BodyNormal";
            src: local("Nunito Sans"), local("NunitoSans-Normal");
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }
        
        /* Asegurar que todo use Nunito Sans */
        body, .body-normal, p, h1, h2, h3, h4, h5, h6 {
            font-family: "Nunito Sans", "BodyNormal", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
        }
    ' );
}

// BRUNO: Limitar preconnects — keep max 4, only truly critical origins
add_filter( 'wp_resource_hints', function ( $urls, $relation_type ) {

    if ( 'preconnect' !== $relation_type ) {
        return $urls;
    }

    // Only allow preconnects to these essential origins (max 4)
    $allowed_origins = array(
        'www.adfisioterapiavalencia.com',
        'fonts.gstatic.com',
        'fonts.googleapis.com',
        'www.googletagmanager.com',
    );

    return array_filter(
        $urls,
        function ( $url ) use ( $allowed_origins ) {

            $href = is_array( $url ) ? $url['href'] : $url;
            $host = wp_parse_url( $href, PHP_URL_HOST );

            if ( empty( $host ) ) {
                return false;
            }

            return in_array( $host, $allowed_origins, true );
        }
    );

}, 10, 2 );

add_action( 'wp_enqueue_scripts', function () {

    global $wp_styles;

    if ( empty( $wp_styles ) ) {
        return;
    }

    foreach ( $wp_styles->registered as $handle => $style ) {

        if (
            ! empty( $style->src ) &&
            strpos( $style->src, 'fonts.googleapis.com' ) !== false
        ) {
            wp_dequeue_style( $handle );
            wp_deregister_style( $handle );
        }
    }

}, 999 );

// ─── RENDER-BLOCKING CSS OPTIMIZATION ───────────────────────────────────────
// Dequeue dashicons on frontend (only needed in wp-admin)
add_action( 'wp_enqueue_scripts', function () {
    if ( ! is_user_logged_in() ) {
        wp_dequeue_style( 'dashicons' );
        wp_deregister_style( 'dashicons' );
    }
}, 999 );

// Defer non-critical CSS using media="print" technique
// These stylesheets are not needed for initial render / above-the-fold content
add_filter( 'style_loader_tag', function ( $html, $handle, $href ) {

    // List of handles that can be deferred (not critical for first paint)
    // Covers common handle names used by AOS, WP-PageNavi, Spectra/UAG, Swiper, Slick
    $defer_handles = array(
        'aos-css',                    // AOS animate-on-scroll
        'aos',                        // AOS alternate handle
        'starter-templates-aos',      // AOS via starter templates
        'wp-pagenavi',                // WP-PageNavi pagination (below fold)
        'starter-templates-swiper',   // Swiper via Spectra
        'uagb-swiper-css',            // Swiper via Spectra/UAG
        'swiper',                     // Swiper generic handle
        'starter-templates-slick',    // Slick via Spectra
        'uagb-slick-css',             // Slick via Spectra/UAG
        'spectra-frontend-css',       // Spectra frontend
        'starter-starter-templates-css', // Spectra
        'starter-templates-css',         // Spectra dist/style.css
        'starter-starter-templates-default-css', // Spectra default
        'uagb-block-positioning-css', // Spectra block positioning
        'wp-block-library',           // WP core blocks CSS (not critical)
        'wp-block-library-theme',     // WP core blocks theme CSS
        'global-styles',              // WP global styles (theme.json)
        'jestarter-starter-fa',       // Font Awesome (icons load via preloaded woff2)
        'jestarter-starter-fa5',      // Font Awesome 5 alternate handle
        'starter-starter-fa',         // Font Awesome via starter templates
    );

    // Also defer based on URL patterns for handles we might not know
    $defer_url_patterns = array(
        '/aos.css',
        '/aos.min.css',
        'pagenavi-css.css',
        'swiper-bundle.min.css',
        'slick.min.css',
        'spectra-block-positioning',
        '/uag-css-',                  // Spectra/UAG per-page generated CSS
        '/eb-reusable-',              // Essential Blocks reusable block CSS
        '/eb-style/',                 // Essential Blocks per-page styles
        'style-blocks.css',           // WP core dist/style-blocks.css
        'animate.min.css',            // Animate.css (only for scroll animations)
        'font-awesome5.css',          // Font Awesome 5 CSS (woff2 is preloaded)
        'font-awesome.css',           // Font Awesome CSS alternate
        'eb-style-',                  // Essential Blocks generated styles
        '/starter-templates/dist/style.css', // Spectra dist/style.css
    );

    $should_defer = in_array( $handle, $defer_handles, true );

    if ( ! $should_defer && ! empty( $href ) ) {
        foreach ( $defer_url_patterns as $pattern ) {
            if ( strpos( $href, $pattern ) !== false ) {
                $should_defer = true;
                break;
            }
        }
    }

    if ( $should_defer ) {
        // Replace media="all" with media="print" and add onload to switch back
        $html = str_replace(
            "media='all'",
            "media='print' onload=\"this.media='all'\"",
            $html
        );
        // Also handle double-quoted variant
        $html = str_replace(
            'media="all"',
            'media="print" onload="this.media=\'all\'"',
            $html
        );
    }

    // Max Mega Menu: only needed for desktop (>1269px).
    // Set media="(min-width:1270px)" so it does not block render on mobile/tablet.
    if ( ! empty( $href ) && strpos( $href, 'maxmegamenu' ) !== false ) {
        $html = str_replace(
            "media='all'",
            "media='(min-width:1270px)'",
            $html
        );
        $html = str_replace(
            'media="all"',
            'media="(min-width:1270px)"',
            $html
        );
    }

    return $html;
}, 10, 3 );

// Defer AOS CSS and JS — only needed after page load for scroll animations
add_action( 'wp_enqueue_scripts', function () {
    // If AOS is enqueued, we mark it for deferral (handled by style_loader_tag filter above)
    // Also defer the AOS JS initialization
    if ( wp_script_is( 'aos', 'enqueued' ) || wp_script_is( 'aos-js', 'enqueued' ) ) {
        // AOS JS is already in footer typically, but ensure it
        wp_script_add_data( 'aos', 'strategy', 'defer' );
        wp_script_add_data( 'aos-js', 'strategy', 'defer' );
    }
}, 1000 );

// ─── PRELOAD FONT AWESOME WOFF2 ─────────────────────────────────────────────
// The font file is discovered late (after CSS parse). Preloading eliminates the
// extra round-trip from the critical chain: HTML→CSS→font becomes HTML→font.
// We detect the font URL dynamically from the registered font-awesome CSS handle.
add_action( 'wp_head', function () {
    global $wp_styles;

    if ( empty( $wp_styles->registered ) ) {
        return;
    }

    // Find the Font Awesome CSS src to derive the fonts/ path
    $fa_src = '';
    foreach ( $wp_styles->registered as $handle => $style ) {
        if ( ! empty( $style->src ) && strpos( $style->src, 'font-awesome5' ) !== false ) {
            $fa_src = $style->src;
            break;
        }
        if ( ! empty( $style->src ) && strpos( $style->src, 'font-awesome' ) !== false ) {
            $fa_src = $style->src;
        }
    }

    if ( ! empty( $fa_src ) ) {
        // The woff2 lives in ../fonts/fa-solid-900.woff2 relative to css/font-awesome5.css
        $font_url = str_replace(
            array( 'css/font-awesome5.css', 'css/font-awesome.css' ),
            'fonts/fa-solid-900.woff2',
            $fa_src
        );
        // Remove query string if present
        $font_url = strtok( $font_url, '?' );
        echo '<link rel="preload" href="' . esc_url( $font_url ) . '" as="font" type="font/woff2" crossorigin>' . "\n";
    }
}, 2 );

// ─── FIX NON-COMPOSITED ANIMATIONS ──────────────────────────────────────────
// Promote Animate.css and accordion animated elements to GPU compositor layer.
// This avoids "non-composited animations" Lighthouse warning by ensuring
// animations run on transform/opacity (composited) instead of layout properties.
add_action( 'wp_head', function () {
    echo '<style id="composited-animations-fix">' .
        '.animated,[class*="animate__"],.eb-accordion-wrapper .eb-accordion-content-wrapper{will-change:transform,opacity;transform:translateZ(0)}' .
        '.eb-accordion-wrapper .eb-accordion-content-wrapper{overflow:hidden;transition:max-height .35s ease,opacity .35s ease}' .
        '</style>' . "\n";
}, 3 );

//BRUNO