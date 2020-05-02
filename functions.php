<?php

// 基本設定
function mytheme_setup() {

	// ページのタイトルを出力
	add_theme_support( 'title-tag' );

	// HTML5対応
	add_theme_support( 'html5', array( 'style', 'script' ) );

	// アイキャッチ画像
	add_theme_support( 'post-thumbnails' );

	// ナビゲーションメニュー
	register_nav_menus( array( 'primary' => 'メイン', ) );

	// 編集画面用のCSS
	add_theme_support( 'editor-styles' );
	add_editor_style( 'editor-style.css');

	// グーテンベルク由来のCSS (theme.min.css)
	add_theme_support( 'wp-block-styles' );

	// 埋め込みコンテンツのレスポンシブ化
	add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'mytheme_setup' );

// ウィジェット
function mytheme_widgets() {

	register_sidebar( array(
		'id' => 'sidebar-1',
		'name' => 'サイドメニュー',
		'before_widget' => '<section id = "%1$s" class="widget %2$s">',
		'after_widget' => '</section>'
	) );
}
add_action( 'widgets_init', 'mytheme_widgets' );

// CSS
function mytheme_enqueue() {

	// Font Awesome
	wp_enqueue_style(
		'mytheme-fontawesome',
		'https://use.fontawesome.com/releases/v5.13.0/css/all.css',
		array(),
		null );

	// テーマのCSS
	wp_enqueue_style( 'mytheme-style', get_stylesheet_uri(), array(),
		filemtime( get_template_directory(). '/style.css' ) );

}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue' );

// Font Awesomeの属性
function mytheme_sri( $html, $handle ) {
	if( $handle === 'mytheme-fontawesome' ) {
		return str_replace(
			'/>',
			'integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous"' . ' />',
			$html
		);
	}
	return $html;
}
add_filter( 'style_loader_tag', 'mytheme_sri', 10, 2 );

// Codeブロックを横スクロールする
function code_scroll_func($content)
{
  $search  = array('<code', '</code>');
  $replace = array('<div class="scroll-box"><code', '</code></div>');
  return str_replace($search, $replace, $content);
}
add_filter('the_content', 'code_scroll_func');