<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="wrapper" class="hfeed">

    <header id="header" role="banner">

        <div class="container container-header">

            <div id="branding">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img
                        src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.svg"
                        alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                </a>
            </div>

            <nav id="menu"
                 role="navigation"
                 itemscope
                 itemtype="https://schema.org/SiteNavigationElement">

                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'main-menu',
                        'link_before'    => '<span itemprop="name">',
                        'link_after'     => '</span>',
                    )
                );
                ?>

            </nav>

            <nav id="menu-mobile" class="navbar" role="navigation">

                <a class="navbar-brand" href="#"></a>

                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Abrir menú">

                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 16 16"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">

                        <path
                            d="M2 3h12M2 8h12M2 13h12"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            fill="none" />

                    </svg>

                </button>

                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'mobile-menu',
                        'link_before'    => '<span itemprop="name">',
                        'link_after'     => '</span>',
                    )
                );
                ?>

            </nav>

        </div>

    </header>

    <div id="container">

        <main id="content" role="main">