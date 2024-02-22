/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */
const init = () => {
	const navBtn = document.getElementById('nav-btn');
	const toggleNav = () => {
		document.body.classList.toggle('nav-open');
	};
	navBtn.addEventListener('click', toggleNav);
};
document.addEventListener('DOMContentLoaded', init);
