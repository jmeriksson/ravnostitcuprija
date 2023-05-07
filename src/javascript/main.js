import "./swiper"
import "./dog-archive"

document.addEventListener('DOMContentLoaded', () => {
	const BODY = document.querySelector('body')
	const MOBILE_MENU_TOGGLE = document.querySelector('#js-navigation__mobile-menu-toggle')
	const MOBILE_MENU = document.querySelector('#js-mobile-menu')
	const SEARCH_TOGGLE = document.querySelector('#js-search-bar-toggle');
	/**
	 * Toggle mobile menu on hamburger icon click.
	 */
	MOBILE_MENU_TOGGLE.addEventListener('click', event => {
		event.preventDefault()
		BODY.classList.toggle('mobile-menu-is-open')
	})

	SEARCH_TOGGLE.addEventListener('click', event => {
		event.preventDefault()
		BODY.classList.toggle('search-bar-is-open')
	})

	MOBILE_MENU.addEventListener('touchstart', handleMobileMenuTouchStart, false)
	MOBILE_MENU.addEventListener('touchmove', handleMobileMenuTouchMove, false)

	var xDown = null
	var yDown = null

	function getTouches(event) {
		return event.touches || event.originalEvent.touches
	}

	function handleMobileMenuTouchStart(event) {
		const firstTouch = getTouches(event)[0];
		xDown = firstTouch.clientX
		yDown = firstTouch.clientY
	}

	function handleMobileMenuTouchMove(event) {
		if ( ! xDown || ! yDown ) {
			return
		}

		var xUp = event.touches[0].clientX
		var yUp = event.touches[0].clientY

		var xDiff = xDown - xUp
		var yDiff = yDown - yUp

		if (Math.abs(xDiff) > Math.abs(yDiff)) {
			console.log(xDiff)
			if(xDiff < -12) {
				// Swipe right
				BODY.classList.toggle('mobile-menu-is-open')
			} else {
				// Swipe left
			}
		} else {
			if (yDiff > 0) {
				// Swipe down
			} else {
				// Swipe up
			}
		}
		xDown = null
		yDown = null
	}
})