<?php
/**
 * 樣式
 */

function tunalog_register_styles() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'tunalog-style', get_stylesheet_uri() . '?v=' . time(), array(), $theme_version );

	if ( get_theme_mod( 'highlight_js', 'enabled' ) == 'enabled' ) {
		wp_enqueue_style( 'tunalog-highlight-style', get_template_directory_uri() . '/assets/css/highlight.css' . '?v=' . time(), array(), $theme_version);
	}
}
add_action( 'wp_enqueue_scripts', 'tunalog_register_styles' );

/**
 * 小工具
 */

function tunalog_sidebar_registration() {

	$shared_args = array(
		'before_title'  => '<h2 class="widget__title">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget__content">',
		'after_widget'  => '</div></div>',
	);

    // 側邊欄。
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => '側邊欄',
				'id'          => 'sidebar-1',
				'description' => '可供展開的側邊欄位。',
			)
		)
	);

	// 文末上方。
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => '文末上方',
				'id'          => 'pageend-1',
				'description' => '內文結束的留言區塊上方欄位。',
			)
		)
	);

	// 文末下方。
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => '文末下方',
				'id'          => 'pageend-2',
				'description' => '文章頁面最底部的欄位。',
			)
		)
	);

	// 頁腳左側。
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => '頁腳左側',
				'id'          => 'footer-1',
				'description' => '每個頁面的頁腳左側欄位。',
			)
		)
	);

	// 頁腳中間。
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => '頁腳中間',
				'id'          => 'footer-2',
				'description' => '每個頁面的頁腳中間欄位。',
			)
		)
    );

    // 頁腳右側。
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => '頁腳右側',
				'id'          => 'footer-3',
				'description' => '每個頁面的頁腳右側欄位。',
			)
		)
	);
}
add_action( 'widgets_init', 'tunalog_sidebar_registration' );

/**
 * 特色圖片輔助樣式
 */

function add_featured_image_body_class( $classes ) {
	global $post;
	if ( isset ( $post->ID ) && get_the_post_thumbnail( $post->ID)  ) {
		$classes[] = 'has-featured-image';
	}
    return $classes;
}
add_filter( 'body_class', 'add_featured_image_body_class' );

/**
 * 主題支援特色圖片
 */


set_post_thumbnail_size( 1200, 9999 );

/**
 * 主題支援
 */

add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'align-wide' );

/**
 * 自訂尺寸
 */

add_image_size( 'tunalog-fullscreen', 1980, 9999 );
add_image_size( 'tunalog-fullsize', 0, 0, false );

/**
 * 主題自訂功能
 */

class Tunalog_Customize {

	public static function register( $wp_customize ) {

		/**
		 * 內文設定
		 */

		$wp_customize->add_section(
			'content_options',
			array(
				'title'      => "內文設定",
				'priority'   => 40,
				'capability' => 'edit_theme_options',
			)
		);

		/* 頁腳動力提供者 ---------------------------------------------------- */

		$wp_customize->add_setting(
			'social_friendly',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'enabled',
				'sanitize_callback' => array( __CLASS__, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'social_friendly',
			array(
				'type'     => 'radio',
				'section'  => 'content_options',
				'priority' => 10,
				'label'    => '社群網路預覽友善（OG）',
				'description' => '啟用此功能後，會讓你的文章連結預覽在社群網站（如：Facebook、Twitter）上有著更好的視覺體驗。但如果你已經有安裝其他類似 SEO 友善的擴充套件，則請將此功能關閉。',
				'choices'  => array(
					'enabled'     => '啟用',
					'disabled'    => '停用',
				),
			)
		);

		/* 頁腳動力提供者 ---------------------------------------------------- */

		$wp_customize->add_setting(
			'display_by',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'enabled_all',
				'sanitize_callback' => array( __CLASS__, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'display_by',
			array(
				'type'     => 'radio',
				'section'  => 'content_options',
				'priority' => 10,
				'label'    => '頁腳動力提供者',
				'description' => '你可以在頁腳選擇要不要顯示這個佈景主題的名稱，好讓更多人知道這個神奇蹦蹦超棒異域主題！拜託啦。',
				'choices'  => array(
					'enabled_all' => '顯示「以套用 Tunalog 佈景主題的 WordPress 發表」',
					'enabled'     => '顯示「驕傲地採用 WordPress 發表」',
					'disabled'    => '停用',
				),
			)
		);

		/* 頁腳版權聲明 ---------------------------------------------------- */

		$wp_customize->add_setting(
			'display_copyright',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'enabled',
				'sanitize_callback' => array( __CLASS__, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'display_copyright',
			array(
				'type'     => 'radio',
				'section'  => 'content_options',
				'priority' => 10,
				'label'    => '頁腳版權聲明',
				'description' => '是否在頁腳顯示網站名稱與版權聲明年份？',
				'choices'  => array(
					'enabled'  => '啟用',
					'disabled' => '停用',
				),
			)
		);

		/* 標頭與頁尾寬度 ---------------------------------------------------- */

		$wp_customize->add_setting(
			'header_width',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'standard',
				'sanitize_callback' => array( __CLASS__, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'header_width',
			array(
				'type'     => 'radio',
				'section'  => 'content_options',
				'priority' => 10,
				'label'    => '標頭與頁尾寬度',
				'description' => '標頭的網站名稱與頁尾的寬度是否要跟文章內容一樣等寬？',
				'choices'  => array(
					'standard' => '與內容同寬',
					'wide'     => '更寬',
				),
			)
		);

		/* 內文左右對齊 ---------------------------------------------------- */

		$wp_customize->add_setting(
			'text_justify',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'disabled',
				'sanitize_callback' => array( __CLASS__, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'text_justify',
			array(
				'type'     => 'radio',
				'section'  => 'content_options',
				'priority' => 10,
				'label'    => '內文左右對齊',
				'description' => '文章的內容可以左右對齊達到最佳的排版視覺效果，但在字數較少的行數上會有較為明顯的字體間距反而有可能適得其反。',
				'choices'  => array(
					'enabled'        => '啟用',
					'enabled_mobile' => '僅在行動裝置啟用',
					'disabled'       => '停用',
				),
			)
		);

		/* 程式碼標註 ---------------------------------------------------- */

		$wp_customize->add_setting(
			'highlight_js',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'enabled',
				'sanitize_callback' => array( __CLASS__, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'highlight_js',
			array(
				'type'     => 'radio',
				'section'  => 'content_options',
				'priority' => 10,
				'label'    => '程式碼標註',
				'description' => '是否要透過 Highlight.js 螢光標記程式碼區塊？',
				'choices'  => array(
					'enabled'    => '啟用',
					'disabled' => '停用',
				),
			)
		);

		/* 作者資訊位置 ---------------------------------------------------- */

		$wp_customize->add_setting(
			'display_vcard',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'end',
				'sanitize_callback' => array( __CLASS__, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'display_vcard',
			array(
				'type'     => 'radio',
				'section'  => 'content_options',
				'priority' => 10,
				'label'    => '作者資訊位置',
				'description' => '發文作者的個人資訊（頭像、名稱與簡介）應出現在內文中的何處？',
				'choices'  => array(
					'start'    => '文首',
					'end'      => '文末',
					'disabled' => '隱藏',
				),
			)
		);

		/* 程式碼區塊寬度 --------- */

		$wp_customize->add_setting(
			'codeblock_width',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'standard',
				'sanitize_callback' => array( __CLASS__, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'codeblock_width',
			array(
				'type'     => 'radio',
				'section'  => 'content_options',
				'priority' => 10,
				'label'    => '程式碼區塊寬度',
				'description' => '在內文中的程式碼區塊應該以何種寬度呈現？等寬會與內文同寬，而全螢幕會延伸到整個螢幕的寬度。',
				'choices'  => array(
					'standard' => '等寬',
					'full'     => '全螢幕',
				),
			)
		);

		/* 留言樣式 --------- */

		$wp_customize->add_setting(
			'comment_style',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'standard',
				'sanitize_callback' => array( __CLASS__, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'comment_style',
			array(
				'type'     => 'radio',
				'section'  => 'content_options',
				'priority' => 10,
				'label'    => '留言樣式',
				'description' => '留言的區域應以何種樣式呈現？區塊會帶有底色以呈現成明顯的區塊樣式。',
				'choices'  => array(
					'standard' => '標準',
					'block'    => '區塊',
				),
			)
		);

		/**
		 * 列表設定
		 */

		$wp_customize->add_section(
			'home_options',
			array(
				'title'      => "列表設定",
				'priority'   => 40,
				'capability' => 'edit_theme_options',
			)
		);

		/* 首頁特色圖片預覽 ---------------------------------------------------- */

		$wp_customize->add_setting(
			'featured_picture_visibility',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'disabled',
				'sanitize_callback' => array( __CLASS__, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'featured_picture_visibility',
			array(
				'type'     => 'radio',
				'section'  => 'home_options',
				'priority' => 10,
				'label'    => '首頁特色圖片預覽',
				'description' => '是否要在文章列表中顯示其文章的特色圖片？',
				'choices'  => array(
					'enabled'    => '顯示於文繞圖',
					'enabled_background'    => '以背景圖片呈現',
					'disabled' => '停用',
				),
			)
		);

		/* 發文者名稱 ---------------------------------------------------- */

		$wp_customize->add_setting(
			'display_author',
			array(
				'capability'        => 'edit_theme_options',
				'default'           => 'enabled',
				'sanitize_callback' => array( __CLASS__, 'sanitize_select' ),
			)
		);

		$wp_customize->add_control(
			'display_author',
			array(
				'type'     => 'radio',
				'section'  => 'home_options',
				'priority' => 10,
				'label'    => '發文者名稱',
				'description' => '在列表中的文章是否要顯示作者名稱？若部落格有多個作者這將會幫上不小的忙。',
				'choices'  => array(
					'enabled'  => '顯示',
					'disabled' => '隱藏',
				),
			)
		);

	}

	public static function sanitize_select( $input, $setting ) {
		$input   = sanitize_key( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	public static function sanitize_checkbox( $checked ) {
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}
}
add_action( 'customize_register', array( 'Tunalog_Customize', 'register' ) );

/**
 * 作者卡片
 */

require('singular-vcard.php');

/**
 * 動態 Highlight 載入器
 */

function tunalog_dynamic_highlight_loader() {
	if( !is_singular() ) {
		return;
	}
	if ( get_theme_mod( 'highlight_js', 'enabled' ) != 'enabled' ) {
		return;
	}
	echo '<script src="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.17.1/build/highlight.min.js"></script>';

	$languages = array( '1c', 'abnf', 'accesslog', 'actionscript', 'ada', 'angelscript', 'applescript', 'arcade', 'arduino', 'armasm', 'asciidoc', 'aspectj', 'autohotkey', 'autoit', 'avrasm', 'awk', 'axapta', 'basic', 'bnf', 'brainfuck', 'cal', 'capnproto', 'ceylon', 'clean', 'clojure-repl', 'clojure', 'cmake', 'coq', 'cos', 'cpp', 'crmsh', 'crystal', 'csp', 'd', 'dart', 'delphi', 'django', 'dns', 'dockerfile', 'dos', 'dsconfig', 'dts', 'dust', 'ebnf', 'elixir', 'elm', 'erb', 'erlang-repl', 'erlang', 'excel', 'fix', 'flix', 'fortran', 'fsharp', 'gams', 'gauss', 'gcode', 'gherkin', 'glsl', 'gml', 'go', 'golo', 'gradle', 'groovy', 'haml', 'handlebars', 'haskell', 'haxe', 'hsp', 'htmlbars', 'hy', 'inform7', 'irpf90', 'isbl', 'jboss-cli', 'julia-repl', 'julia', 'lasso', 'ldif', 'leaf', 'lisp', 'livecodeserver', 'livescript', 'llvm', 'lsl', 'mathematica', 'matlab', 'maxima', 'mel', 'mercury', 'mipsasm', 'mizar', 'mojolicious', 'monkey', 'moonscript', 'n1ql', 'nimrod', 'nix', 'nsis', 'ocaml', 'openscad', 'oxygene', 'parser3', 'pf', 'pgsql', 'pony', 'powershell', 'processing', 'profile', 'prolog', 'protobuf', 'puppet', 'purebasic', 'q', 'qml', 'r', 'reasonml', 'rib', 'roboconf', 'routeros', 'rsl', 'ruleslanguage', 'sas', 'scala', 'scheme', 'scilab', 'smali', 'smalltalk', 'sml', 'sqf', 'stan', 'stata', 'step21', 'stylus', 'subunit', 'taggerscript', 'tap', 'tcl', 'tex', 'thrift', 'tp', 'twig', 'vala', 'vbnet', 'vbscript-html', 'vbscript', 'verilog', 'vhdl', 'vim', 'x86asm', 'xl', 'xquery', 'zephir' );

	foreach( $languages as $value ) {
		if ( strpos( get_post()->post_content, 'language-' . $value ) !== false ) {
			echo '<script src="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.17.1/build/languages/' . $value . '.min.js"></script>';
		}
	}
	echo '<script>hljs.initHighlightingOnLoad();</script>';
}