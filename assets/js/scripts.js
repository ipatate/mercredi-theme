import './lazyload'
import Flickity from 'flickity'
import initNav from './navigation'
import initHeader from './scroll'
import initHero from './hero'
import initCarousel from './carousel'
import initObserver from './observer'
import initMenu from './menu'

function main() {
  // header
  initHeader()
  // nav
  initNav()
  // hero
  initHero()
  // carousel
  initCarousel()

  // initObserver()

  initMenu()

  const productsBlocks = document.querySelectorAll(
    '.gm-products-list-element a',
  )
  if (productsBlocks) {
    for (let index = 0; index < productsBlocks.length; index++) {
      const element = productsBlocks[index]
      element.addEventListener('click', function (e) {
        return e.preventDefault()
      })
    }
  }

  const lazyLoadInstance = new LazyLoad({})
}
document.addEventListener('DOMContentLoaded', () => {
  main()
})

/**
 * init cookie banner
 */
document.addEventListener('DOMContentLoaded', function () {
  if (window.initGdprCookie) {
    window.initGdprCookie.default()

    var link = document.querySelector(".gm-footer-nav a[href='#']")
    if (link) {
      link.addEventListener('click', function (e) {
        e.preventDefault()
        window._gdpr_showModal()
      })
    }
  }
})
