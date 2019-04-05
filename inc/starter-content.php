<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Tabor
 * @link        https://themebeans.com/themes/tabor
 */

/**
 * Starter content for the home page.
 */
function tabor_home_starter_content() {

	$content = __(
		'
		<h5>Hi, I\'m</h5>
		<h1>Rich</h1>
		<h1>Tabor</h1>
		[typed text="ThemeBeans Founder, Designer"]', 'tabor'
	);

	$allowed_html = array(
		'h1' => array(),
		'h5' => array(),
	);

	return wp_kses( $content, $allowed_html );
}

/**
 * Starter content for the about page.
 */
function tabor_about_starter_content() {

	$content = __(
		'

		I\'m Rich Tabor, and I’ve always had a knack for creating stuff:  has websites, themes, psd freebies, and the like. I started my career as a web designer for a small town marketing firm in North Georgia and soon found myself smack dab in the middle of New York City working on iOS, Android and web creations.

		These days I’m back in the mountains, enjoying life and running a few ventures and taking on the occasional client with the agency I recently founded in early 2016, <a href="http://layup.media/">Layup Media</a>.

		In between all of this I drafted up <a title="Free PSD and Design Resources by Rich Tabor" href="http://purtypixels.com/" target="_blank" rel="noopener">PurtyPixels</a> with the goal of practicing photoshop and the essence of delivery (in the form of photoshop goods). It has been a fun and successful venture with 1.6 million downloaded files.

		Then I started designing, creating, delivering, marketing (and everything tabor_about_starter_contentin between) WordPress themes under at <a title="ThemeBeans - Professional WordPress Themes by Rich Tabor" href="http://themebeans.com/" target="_blank" rel="noopener">ThemeBeans</a>.

		Aside from crafting &amp; publishing digital goods, I enjoying traveling, photography, music, reading &amp; hitting the gym.  All in all, I love what I do &amp; I couldn’t ask for more.

		Want to <a title="Contact Rich Tabor" href="http://richtabor.dev/contact/">get in touch</a>?

		', 'tabor'
	);

	$allowed_html = array(
		'a' => array(
			'alt'    => array(),
			'href'   => array(),
			'target' => array(),
		),
	);

	return wp_kses( $content, $allowed_html );
}

/**
 * Starter content for the contact page.
 */
function tabor_content_starter_content() {

	$content = __(
		'

		Looks like you’d like to get in touch. We’re all busy people, so I want to respect your valuable time and hope you grant me the same in return. Just to manage your expectations, here are a couple things to know:
		<h2>Contact me if</h2>
		<ul>
		 	<li>You need a custom <a href="https://themebeans.com">WordPress theme</a> or plugin</li>
		 	<li>You need <a href="https://richtabor.com/work">design or development help</a> on your project</li>
		 	<li>You would like me to consult on a project with you</li>
		 	<li>You would like to interview me on your podcast</li>
		 	<li>You simply want to connect with me</li>
		</ul>
		With that said, I’m so thankful that you stopped by and I’d love to hear from you —  feel free to email me at <em>hi</em><em> at richtabor dot com</em>. And if you want to find me elsewhere on the web, I ramble on <a href="https://twitter.com/richard_tabor">Twitter</a> and post work to <a href="https://dribbble.com/richtabor">Dribbble</a>.

		', 'tabor'
	);

	$allowed_html = array(
		'a'  => array(
			'alt'    => array(),
			'href'   => array(),
			'target' => array(),
		),
		'h3' => array(),
		'ul' => array(),
		'li' => array(),
		'em' => array(),
	);

	return wp_kses( $content, $allowed_html );
}
