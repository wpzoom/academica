/**
 * Academica theme navigation.
 *
 * Handles mobile menu toggle and dropdown submenus.
 */
( function() {
	var nav = document.querySelector( '.main-navbar' );
	if ( ! nav ) {
		return;
	}

	var toggle = nav.querySelector( '.menu-toggle' );
	var menu   = nav.querySelector( '.navbar-menu' );

	if ( ! toggle || ! menu ) {
		return;
	}

	/**
	 * Mobile menu toggle.
	 */
	toggle.addEventListener( 'click', function() {
		var expanded = nav.classList.toggle( 'toggled' );
		toggle.setAttribute( 'aria-expanded', expanded );
	} );

	/**
	 * Close mobile menu on resize to desktop.
	 */
	window.addEventListener( 'resize', function() {
		if ( nav.classList.contains( 'toggled' ) && toggle.offsetParent === null ) {
			nav.classList.remove( 'toggled' );
			toggle.setAttribute( 'aria-expanded', 'false' );
		}
	} );

	/**
	 * Mobile submenu toggles.
	 *
	 * Bind click directly to each .dropdown-menu-toggle element
	 * so SVG clicks are reliably captured.
	 */
	var dropdownToggles = menu.querySelectorAll( '.dropdown-menu-toggle' );

	var toggleSubNav = function( e ) {
		if ( ! nav.classList.contains( 'toggled' ) ) {
			return;
		}

		e.preventDefault();
		e.stopPropagation();

		var li = this.closest( 'li' );
		if ( ! li ) {
			return;
		}

		var subMenu = li.querySelector( ':scope > .sub-menu, :scope > .children' );

		li.classList.toggle( 'sfHover' );

		if ( subMenu ) {
			subMenu.classList.toggle( 'toggled-on' );
		}
	};

	for ( var i = 0; i < dropdownToggles.length; i++ ) {
		dropdownToggles[ i ].addEventListener( 'click', toggleSubNav );
		dropdownToggles[ i ].addEventListener( 'keypress', function( e ) {
			if ( 'Enter' === e.key || ' ' === e.key ) {
				toggleSubNav.call( this, e );
			}
		} );
	}

	/**
	 * Keyboard accessibility for desktop dropdowns.
	 *
	 * Toggle sfHover class on focus/blur so submenus appear
	 * during keyboard navigation.
	 */
	var menuLinks = menu.querySelectorAll( '.sf-menu a' );

	for ( var j = 0; j < menuLinks.length; j++ ) {
		menuLinks[ j ].addEventListener( 'focus', function() {
			var el = this.closest( 'li' );
			while ( el ) {
				el.classList.add( 'sfHover' );
				el = el.parentNode.closest ? el.parentNode.closest( 'li' ) : null;
			}
		} );

		menuLinks[ j ].addEventListener( 'blur', function() {
			var el = this.closest( 'li' );
			while ( el ) {
				el.classList.remove( 'sfHover' );
				el = el.parentNode.closest ? el.parentNode.closest( 'li' ) : null;
			}
		} );
	}
} )();
